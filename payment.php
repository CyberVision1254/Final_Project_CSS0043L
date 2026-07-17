<?php
session_start();

if (!isset($_SESSION['islogged'])) { header('Location: login.php?redirect=checkout.php'); exit(); }
if (!isset($_SESSION['checkout'])) { header('Location: checkout.php'); exit(); }

require_once('db.php');

$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
if (empty($cart)) { header('Location: cart.php'); exit(); }

$ids          = implode(',', array_map('intval', array_keys($cart)));
$result       = mysqli_query($conn, "SELECT * FROM products WHERE id IN ($ids)");
$productsById = array();
while ($row = mysqli_fetch_assoc($result)) {
    $productsById[$row['id']] = $row;
}

$items = array();
$total = 0;
foreach ($cart as $id => $qty) {
    if (!isset($productsById[$id])) continue;
    $p   = $productsById[$id];
    $qty = min((int)$qty, (int)$p['stock_qty']);
    if ($qty <= 0) continue;
    $subtotal = $p['price'] * $qty;
    $total   += $subtotal;
    $items[]  = array('product' => $p, 'qty' => $qty, 'subtotal' => $subtotal);
}

if (empty($items)) { header('Location: cart.php'); exit(); }

$errors = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $method    = 'Cash on Delivery';

    $uid           = (int)$_SESSION['user_id'];
    $checkout      = $_SESSION['checkout'];
    $address_esc   = mysqli_real_escape_string($conn, $checkout['shipping_address']);
    $contact_esc   = mysqli_real_escape_string($conn, $checkout['contact_number']);
    $method_esc    = mysqli_real_escape_string($conn, $method);


    mysqli_begin_transaction($conn);
    $orderFailed = false;
    $failReason  = '';

    $order_sql = "INSERT INTO orders (user_id, shipping_address, contact_number, payment_method, total_amount, status)
                  VALUES ($uid, '$address_esc', '$contact_esc', '$method_esc', $total, 'Pending')";

    if (mysqli_query($conn, $order_sql)) {
        $order_id = mysqli_insert_id($conn);

        foreach ($items as $row) {
            if ($orderFailed) break;

            $p         = $row['product'];
            $pid       = (int)$p['id'];
            $pname_esc = mysqli_real_escape_string($conn, $p['name']);
            $uprice    = (float)$p['price'];
            $qty       = (int)$row['qty'];

            $itemOk = mysqli_query($conn, "INSERT INTO order_items (order_id, product_id, product_name, unit_price, quantity)
                                           VALUES ($order_id, $pid, '$pname_esc', $uprice, $qty)");
            if (!$itemOk) {
                $orderFailed = true;
                $failReason  = "Couldn't save an item on your order: " . mysqli_error($conn);
                break;
            }

            mysqli_query($conn, "UPDATE products SET stock_qty = stock_qty - $qty WHERE id = $pid AND stock_qty >= $qty");

            if (mysqli_affected_rows($conn) === 0) {
                $orderFailed = true;
                $failReason  = "\"" . $p['name'] . "\" just sold out while you were checking out. Please review your cart and try again.";
                break;
            }
        }

        if (!$orderFailed) {
            $name_esc = mysqli_real_escape_string($conn, $_SESSION['fullname']);
            $desc_esc = mysqli_real_escape_string($conn, "$name_esc placed order #$order_id for ₱" . number_format($total, 2) . " ($method).");
            $auditOk  = mysqli_query($conn, "INSERT INTO audit_log (user_id, actor_name, actor_role, action, description)
                                             VALUES ($uid, '$name_esc', 'buyer', 'PLACE_ORDER', '$desc_esc')");
            if (!$auditOk) {
                $orderFailed = true;
                $failReason  = "Something went wrong finalizing your order: " . mysqli_error($conn);
            }
        }

    } else {
        $orderFailed = true;
        $failReason  = "Something went wrong placing your order: " . mysqli_error($conn);
    }

    if ($orderFailed) {
        mysqli_rollback($conn);
        $errors[] = $failReason;
    } else {
        mysqli_commit($conn);
        unset($_SESSION['cart'], $_SESSION['checkout']);
        mysqli_close($conn);
        header('Location: order_confirmation.php?order=' . $order_id);
        exit();
    }
}

$title       = "CyberVision - Payment";
$currentPage = "cart";
require('include/header.php');
?>

<div class="cv-page-head">
    <div class="cv-page-head-inner">
        <h1><i class="bi bi-credit-card"></i> Payment</h1>
        <p>Cash on Delivery only &mdash; you will pay the courier when your order arrives.</p>
    </div>
</div>

<div class="cv-store-wrap">

    <?php if (!empty($errors)): ?>
        <div class="cv-alert cv-alert-danger mb-4">
            <?php foreach ($errors as $e): ?><p><i class="bi bi-exclamation-circle"></i> <?= htmlspecialchars($e) ?></p><?php endforeach; ?>
        </div>
    <?php endif; ?>

    <div class="row g-4">
        <div class="col-md-7">
            <div class="cv-card">
                <p class="cv-card-title">Payment Method</p>
                <form action="payment.php" method="post" novalidate id="paymentForm">

                    <label class="cv-pay-option">
                        <input type="radio" name="payment_method" value="Cash on Delivery" checked>
                        <i class="bi bi-cash-coin" style="color:var(--cv-accent);font-size:1.2rem;"></i>
                        Cash on Delivery
                    </label>

                    <div style="margin-top:16px;">
                        <div class="cv-alert cv-alert-warning">
                            <i class="bi bi-truck"></i> You will pay the courier in cash when your order arrives.
                        </div>
                    </div>

                    <button type="submit" name="submit" class="btn-cv w-100 justify-content-center mt-2" style="padding:13px;font-size:1rem;">
                        <i class="bi bi-bag-check"></i> Place Order &mdash; &#8369;<?= number_format($total, 2) ?>
                    </button>

                </form>
            </div>
        </div>

        <div class="col-md-5">
            <div class="cv-order-summary">
                <p class="cv-card-title">Order Summary</p>
                <?php foreach ($items as $row): $p = $row['product']; ?>
                    <div class="cv-summary-row">
                        <span><?= htmlspecialchars($p['name']) ?> &times; <?= (int)$row['qty'] ?></span>
                        <span>&#8369;<?= number_format($row['subtotal'], 2) ?></span>
                    </div>
                <?php endforeach; ?>
                <div class="cv-summary-total">
                    <span>Total</span>
                    <span>&#8369;<?= number_format($total, 2) ?></span>
                </div>
                <p style="font-size:0.82rem;color:var(--cv-muted);margin-top:14px;">
                    <i class="bi bi-geo-alt"></i> <?= htmlspecialchars($_SESSION['checkout']['shipping_address']) ?>
                </p>
            </div>
        </div>
    </div>
</div>

<?php mysqli_close($conn); require('include/footer.php'); ?>