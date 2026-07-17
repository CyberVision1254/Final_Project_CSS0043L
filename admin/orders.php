<?php
session_start();
if (!isset($_SESSION['islogged']) || !isset($_SESSION['isadmin'])) { header('Location: ../login.php'); exit(); }
require_once('../db.php');

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$csrf_token = $_SESSION['csrf_token'];

$message = "";
$type    = "";

// Simplified status set
$valid_statuses = array('Pending', 'Completed', 'Cancelled');

// Handle status update
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!hash_equals($csrf_token, $_POST['csrf_token'] ?? '')) {
        $message = "Your session expired or this form was submitted incorrectly. Please try again.";
        $type    = "danger";
    } else {
        $order_id   = (int)($_POST['order_id'] ?? 0);
        $new_status = $_POST['status'] ?? '';

        if ($order_id <= 0 || !in_array($new_status, $valid_statuses, true)) {
            $message = "Invalid order or status.";
            $type    = "danger";
        } else {
            $old_row = mysqli_fetch_assoc(mysqli_query($conn, "SELECT status FROM orders WHERE id=$order_id"));
            if (!$old_row) {
                $message = "Order not found.";
                $type    = "danger";
            } else {
                $status_esc = mysqli_real_escape_string($conn, $new_status);
                $updateOk = mysqli_query($conn, "UPDATE orders SET status='$status_esc' WHERE id=$order_id");
                if ($updateOk) {
                    $uid   = (int)$_SESSION['user_id'];
                    $aname = mysqli_real_escape_string($conn, $_SESSION['fullname']);
                    $desc  = mysqli_real_escape_string($conn, $_SESSION['fullname'] . " changed order #$order_id status: {$old_row['status']} \xe2\x86\x92 $new_status.");
                    mysqli_query($conn, "INSERT INTO audit_log (user_id,actor_name,actor_role,action,description) VALUES ($uid,'$aname','admin','UPDATE_ORDER','$desc')");
                    $message = "Order #$order_id status updated to \"$new_status\".";
                    $type    = "success";
                } else {
                    $message = "Database error while updating the order: " . mysqli_error($conn);
                    $type    = "danger";
                }
            }
        }
    }
}

$orders_result = mysqli_query($conn, "
    SELECT o.*, u.full_name AS buyer_name, u.email AS buyer_email,
           (SELECT COALESCE(SUM(oi.quantity),0) FROM order_items oi WHERE oi.order_id = o.id) AS item_count
    FROM orders o
    LEFT JOIN users u ON u.id = o.user_id
    ORDER BY o.date_created DESC
");

// Summary stats
$stat_total   = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as c FROM orders"))['c'];
$stat_pending = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as c FROM orders WHERE status='Pending'"))['c'];
$stat_revenue = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COALESCE(SUM(total_amount),0) as s FROM orders WHERE status != 'Cancelled'"))['s'];

// Order detail view
$viewingOrder = null;
$orderItems   = null;
if (isset($_GET['view'])) {
    $view_id = (int)$_GET['view'];
    $viewingOrder = mysqli_fetch_assoc(mysqli_query($conn, "
        SELECT o.*, u.full_name AS buyer_name, u.email AS buyer_email
        FROM orders o
        LEFT JOIN users u ON u.id = o.user_id
        WHERE o.id=$view_id
    "));
    if ($viewingOrder) {
        $orderItems = mysqli_query($conn, "SELECT * FROM order_items WHERE order_id=$view_id");
    }
}

$title    = "Orders";
$adminNav = "orders";
require('include/header.php');

function statusBadge($status) {
    $colors = array(
        'Pending'   => array('bg' => 'rgba(124,140,163,0.14)', 'fg' => 'var(--cv-muted)', 'bd' => 'var(--cv-border)'),
        'Completed' => array('bg' => 'rgba(34,197,94,0.14)',   'fg' => '#86EFAC',         'bd' => 'rgba(34,197,94,0.35)'),
        'Cancelled' => array('bg' => 'rgba(220,38,38,0.14)',   'fg' => '#FCA5A5',         'bd' => 'rgba(220,38,38,0.35)'),
    );
    $c = $colors[$status] ?? $colors['Pending'];
    return '<span style="background:' . $c['bg'] . ';color:' . $c['fg'] . ';border:1px solid ' . $c['bd'] . ';border-radius:999px;padding:3px 10px;font-size:0.74rem;font-weight:600;">' . htmlspecialchars($status) . '</span>';
}
?>

<div class="mb-4">
    <h4 class="fw-bold mb-0" style="color:var(--cv-text);"><i class="bi bi-receipt" style="color:var(--cv-accent);"></i> Orders</h4>
    <p class="small mb-0" style="color:var(--cv-muted);">Review incoming orders and update their fulfillment status.</p>
</div>

<?php if ($message): ?>
    <div class="cv-alert cv-alert-<?= $type ?> mb-4"><?= htmlspecialchars($message) ?></div>
<?php endif; ?>

<div class="row row-cols-2 row-cols-md-3 g-3 mb-4">
    <div class="col">
        <div class="cv-card h-100">
            <div class="mb-1" style="font-size:0.72rem;letter-spacing:0.06em;text-transform:uppercase;color:var(--cv-muted);">Total Orders</div>
            <div class="fw-bold" style="font-size:1.6rem;color:var(--cv-text);"><?= $stat_total ?></div>
        </div>
    </div>
    <div class="col">
        <div class="cv-card h-100" style="<?= $stat_pending > 0 ? 'border-color:#F87171;' : '' ?>">
            <div class="mb-1" style="font-size:0.72rem;letter-spacing:0.06em;text-transform:uppercase;color:var(--cv-muted);">Pending</div>
            <div class="fw-bold" style="font-size:1.6rem;color:<?= $stat_pending > 0 ? '#F87171' : 'var(--cv-text)' ?>;"><?= $stat_pending ?></div>
        </div>
    </div>
    <div class="col">
        <div class="cv-card h-100">
            <div class="mb-1" style="font-size:0.72rem;letter-spacing:0.06em;text-transform:uppercase;color:var(--cv-muted);">Revenue</div>
            <div class="fw-bold" style="font-size:1.6rem;color:var(--cv-accent);">&#8369;<?= number_format($stat_revenue, 2) ?></div>
        </div>
    </div>
</div>

<?php if ($viewingOrder): ?>
<div class="cv-card mb-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <p class="cv-card-title mb-0">Order #<?= (int)$viewingOrder['id'] ?> <?= statusBadge($viewingOrder['status']) ?></p>
        <a href="orders.php" class="btn-cv-outline" style="padding:6px 14px;font-size:0.82rem;">Close &times;</a>
    </div>
    <div class="row g-3 mb-3">
        <div class="col-md-3">
            <div style="font-size:0.72rem;text-transform:uppercase;color:var(--cv-muted);">Buyer</div>
            <div style="color:var(--cv-text);"><?= htmlspecialchars($viewingOrder['buyer_name'] ?? 'Unknown') ?></div>
            <div class="small" style="color:var(--cv-muted);"><?= htmlspecialchars($viewingOrder['buyer_email'] ?? '') ?></div>
        </div>
        <div class="col-md-3">
            <div style="font-size:0.72rem;text-transform:uppercase;color:var(--cv-muted);">Contact</div>
            <div class="small" style="color:var(--cv-text);"><?= htmlspecialchars($viewingOrder['contact_number']) ?></div>
        </div>
        <div class="col-md-3">
            <div style="font-size:0.72rem;text-transform:uppercase;color:var(--cv-muted);">Shipping Address</div>
            <div class="small" style="color:var(--cv-text);"><?= htmlspecialchars($viewingOrder['shipping_address']) ?></div>
        </div>
        <div class="col-md-3">
            <div style="font-size:0.72rem;text-transform:uppercase;color:var(--cv-muted);">Payment</div>
            <div class="small" style="color:var(--cv-text);">
                <?= htmlspecialchars($viewingOrder['payment_method']) ?>
            </div>
        </div>
    </div>

    <div class="cv-table-wrap mb-3">
        <table class="cv-table">
            <thead><tr><th>Chair</th><th>Qty</th><th>Unit Price</th><th>Subtotal</th></tr></thead>
            <tbody>
                <?php if ($orderItems): while ($it = mysqli_fetch_assoc($orderItems)): ?>
                    <tr>
                        <td style="color:var(--cv-text);"><?= htmlspecialchars($it['product_name']) ?></td>
                        <td><?= (int)$it['quantity'] ?></td>
                        <td>&#8369;<?= number_format($it['unit_price'], 2) ?></td>
                        <td style="color:var(--cv-accent);font-weight:600;">&#8369;<?= number_format($it['unit_price'] * $it['quantity'], 2) ?></td>
                    </tr>
                <?php endwhile; endif; ?>
            </tbody>
        </table>
    </div>

    <form action="orders.php?view=<?= (int)$viewingOrder['id'] ?>" method="post" class="d-flex align-items-center gap-2 flex-wrap">
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf_token) ?>">
        <input type="hidden" name="order_id" value="<?= (int)$viewingOrder['id'] ?>">
        <label class="cv-form-label mb-0">Update status:</label>
        <select name="status" class="cv-form-control" style="width:auto;">
            <?php foreach ($valid_statuses as $s): ?>
                <option value="<?= htmlspecialchars($s) ?>" <?= $viewingOrder['status'] === $s ? 'selected' : '' ?>><?= htmlspecialchars($s) ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit" name="submit" class="btn-cv">Save</button>
        <span class="ms-auto fw-bold" style="color:var(--cv-accent);font-size:1.1rem;">Total: &#8369;<?= number_format($viewingOrder['total_amount'], 2) ?></span>
    </form>
</div>
<?php endif; ?>

<div class="cv-card">
    <p class="cv-card-title">All Orders</p>

    <div class="cv-table-wrap">
        <table class="cv-table">
            <thead>
                <tr><th>#</th><th>Order</th><th>Date</th><th>Buyer</th><th>Items</th><th>Total</th><th>Status</th><th></th></tr>
            </thead>
            <tbody>
                <?php
                $counter = 1;
                while ($o = mysqli_fetch_assoc($orders_result)):
                ?>
                    <tr>
                        <td><?= $counter++ ?></td>
                        <td class="fw-semibold" style="color:var(--cv-text);">#<?= (int)$o['id'] ?></td>
                        <td class="small" style="color:var(--cv-muted);"><?= date("M d, Y g:i A", strtotime($o['date_created'])) ?></td>
                        <td>
                            <div style="color:var(--cv-text);"><?= htmlspecialchars($o['buyer_name'] ?? 'Unknown') ?></div>
                            <div class="small" style="color:var(--cv-muted);"><?= htmlspecialchars($o['buyer_email'] ?? '') ?></div>
                        </td>
                        <td><?= (int)$o['item_count'] ?></td>
                        <td style="color:var(--cv-accent);font-weight:600;">&#8369;<?= number_format($o['total_amount'], 2) ?></td>
                        <td><?= statusBadge($o['status']) ?></td>
                        <td>
                            <a href="orders.php?view=<?= (int)$o['id'] ?>" class="btn-cv-outline" style="padding:5px 12px;font-size:0.8rem;">
                                <i class="bi bi-eye"></i> View
                            </a>
                        </td>
                    </tr>
                <?php endwhile; ?>
                <?php if (mysqli_num_rows($orders_result) == 0): ?>
                    <tr><td colspan="8" class="text-center" style="padding:24px;color:var(--cv-muted);">No orders found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php mysqli_close($conn); require('include/footer.php'); ?>