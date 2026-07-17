<?php
session_start();
require_once('db.php');

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$sql  = "SELECT * FROM products WHERE id = ? AND is_active = 1";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result  = mysqli_stmt_get_result($stmt);
$product = mysqli_fetch_assoc($result);
mysqli_stmt_close($stmt);

if (!$product) {
    mysqli_close($conn);
    header("Location: store.php");
    exit;
}

$title       = "CyberVision - " . $product['name'];
$currentPage = "store";

$catIcons = array(
    'Ergonomic Chairs'         => 'bi-person-workspace',
    'Executive Chairs'         => 'bi-briefcase',
    'Gaming Chairs'            => 'bi-controller',
);
$icon = isset($catIcons[$product['category']]) ? $catIcons[$product['category']] : 'bi-person-workspace';

$relatedSql  = "SELECT * FROM products WHERE category = ? AND id != ? AND is_active = 1 LIMIT 4";
$relatedStmt = mysqli_prepare($conn, $relatedSql);
mysqli_stmt_bind_param($relatedStmt, "si", $product['category'], $id);
mysqli_stmt_execute($relatedStmt);
$relatedResult = mysqli_stmt_get_result($relatedStmt);
$related = array();
while ($row = mysqli_fetch_assoc($relatedResult)) {
    $related[] = $row;
}
mysqli_stmt_close($relatedStmt);

mysqli_close($conn);

$outOfStock = (int)$product['stock_qty'] <= 0;

$longDescription = !empty($product['long_description'])
    ? $product['long_description']
    : $product['description'];

require('include/header.php');
?>

<div class="cv-pd-wrap">

    <a href="store.php" class="cv-back-link"><i class="bi bi-arrow-left"></i> Back to Store</a>

    <div class="cv-pd-layout">


        <div class="cv-pd-gallery">
            <div class="cv-pd-main">
                <div class="cv-pd-main-image" id="cv-pd-main-image">
                    <?php if (!empty($product['image'])): ?>
                        <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" onerror="this.style.display='none';this.nextElementSibling.style.display='flex';">
                        <i class="bi <?= $icon ?>" style="display:none;"></i>
                    <?php else: ?>
                        <i class="bi <?= $icon ?>"></i>
                    <?php endif; ?>
                </div>
            </div>
        </div>

  
        <div class="cv-pd-info">
            <div class="cv-pd-category"><?= htmlspecialchars($product['category']) ?></div>
            <h1 class="cv-pd-title"><?= htmlspecialchars($product['name']) ?></h1>

            <?php if ($outOfStock): ?>
                <span class="cv-badge-out">Out of Stock</span>
            <?php elseif ((int)$product['stock_qty'] <= 5): ?>
                <span class="cv-badge-low">Only <?= (int)$product['stock_qty'] ?> left</span>
            <?php endif; ?>

            <div class="cv-pd-price">&#8369;<?= number_format($product['price'], 2) ?></div>

            <p class="cv-pd-desc"><?= htmlspecialchars($product['description']) ?></p>

            <div class="cv-pd-features">
                <div class="cv-pd-feature">
                    <i class="bi bi-arrows-angle-expand"></i>
                    <span>Adjustable<br>Design</span>
                </div>
                <div class="cv-pd-feature">
                    <i class="bi bi-activity"></i>
                    <span>Lumbar<br>Support</span>
                </div>
                <div class="cv-pd-feature">
                    <i class="bi bi-wind"></i>
                    <span>Breathable<br>Materials</span>
                </div>
                <div class="cv-pd-feature">
                    <i class="bi bi-arrow-repeat"></i>
                    <span>Tilt<br>Function</span>
                </div>
            </div>

            <div class="cv-pd-purchase-box">
                <form action="cart_action.php" method="post" class="cv-pd-purchase-form">
                    <input type="hidden" name="action" value="add">
                    <input type="hidden" name="id" value="<?= (int)$product['id'] ?>">
                    <input type="hidden" name="redirect" value="product.php?id=<?= (int)$product['id'] ?>">

                    <div class="cv-pd-qty-block">
                        <label for="cv-pd-qty">Quantity</label>
                        <div class="cv-pd-qty">
                            <button type="button" class="cv-pd-qty-btn" id="cv-pd-qty-minus" aria-label="Decrease quantity">&minus;</button>
                            <input type="number" name="quantity" id="cv-pd-qty" class="cv-pd-qty-input" value="1" min="1"
                                   max="<?= (int)$product['stock_qty'] ?>" <?= $outOfStock ? 'disabled' : '' ?>>
                            <button type="button" class="cv-pd-qty-btn" id="cv-pd-qty-plus" aria-label="Increase quantity">+</button>
                        </div>
                    </div>

                    <button type="submit" name="submit" class="btn-cv cv-pd-addcart-btn" <?= $outOfStock ? 'disabled' : '' ?>>
                        <?php if ($outOfStock): ?>
                            Unavailable
                        <?php else: ?>
                            <i class="bi bi-cart-plus"></i> Add to Cart
                        <?php endif; ?>
                    </button>
                </form>
            </div>
        </div>
    </div>

 
    <div class="cv-pd-trust-strip">
        <div class="cv-pd-trust-item">
            <div class="cv-pd-trust-icon"><i class="bi bi-truck"></i></div>
            <div>
                <h6>Free Delivery</h6>
                <p>Within Metro Manila</p>
            </div>
        </div>
        <div class="cv-pd-trust-item">
            <div class="cv-pd-trust-icon"><i class="bi bi-shield-check"></i></div>
            <div>
                <h6>1 Year Warranty</h6>
                <p>Parts &amp; Labor</p>
            </div>
        </div>
        <div class="cv-pd-trust-item">
            <div class="cv-pd-trust-icon"><i class="bi bi-arrow-repeat"></i></div>
            <div>
                <h6>7 Days Return</h6>
                <p>Hassle-free</p>
            </div>
        </div>
        <div class="cv-pd-trust-item">
            <div class="cv-pd-trust-icon"><i class="bi bi-headset"></i></div>
            <div>
                <h6>Customer Support</h6>
                <p>We're here to help</p>
            </div>
        </div>
    </div>


    <div class="cv-pd-tabs-wrap">
        <div class="cv-pd-tabs">
            <button type="button" class="cv-pd-tab-btn active" data-tab="description">Description</button>
            <button type="button" class="cv-pd-tab-btn" data-tab="specs">Specifications</button>
            <button type="button" class="cv-pd-tab-btn" data-tab="reviews">Reviews</button>
            <button type="button" class="cv-pd-tab-btn" data-tab="shipping">Shipping &amp; Returns</button>
        </div>

        <div class="cv-pd-tab-panel active" data-panel="description">
            <?php foreach (preg_split('/\n\s*\n/', trim($longDescription)) as $para): ?>
                <?php $para = trim($para); ?>
                <?php if ($para !== ''): ?>
                    <p><?= nl2br(htmlspecialchars($para)) ?></p>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>

        <div class="cv-pd-tab-panel" data-panel="specs">
            <div class="cv-pd-spec-table">
                <div class="cv-pd-spec-row"><span>Category</span><span><?= htmlspecialchars($product['category']) ?></span></div>
                <div class="cv-pd-spec-row"><span>Warranty</span><span>1 Year (Parts &amp; Labor)</span></div>
                <div class="cv-pd-spec-row"><span>Stock</span><span><?= $outOfStock ? 'Out of stock' : (int)$product['stock_qty'] . ' available' ?></span></div>
            </div>
        </div>

        <div class="cv-pd-tab-panel" data-panel="reviews">
            <p class="cv-pd-empty-note">No reviews yet for this product.</p>
        </div>

        <div class="cv-pd-tab-panel" data-panel="shipping">
            <p>Orders are processed within 1&ndash;2 business days. Delivery is available nationwide, with faster delivery windows for Metro Manila addresses. Returns are accepted within 7 days of delivery for items in original condition &mdash; contact support to start a return.</p>
        </div>
    </div>

    <?php if (!empty($related)): ?>
        <div class="cv-related">
            <h4>More in <?= htmlspecialchars($product['category']) ?></h4>
            <div class="cv-product-grid">
                <?php foreach ($related as $r):
                    $rOutOfStock = (int)$r['stock_qty'] <= 0;
                    $rIcon = isset($catIcons[$r['category']]) ? $catIcons[$r['category']] : 'bi-person-workspace';
                ?>
                    <div class="cv-product-card">
                        <a href="product.php?id=<?= (int)$r['id'] ?>" class="cv-product-link">
                            <div class="cv-product-thumb">
                                <?php if (!empty($r['image'])): ?>
                                    <img src="<?= htmlspecialchars($r['image']) ?>" alt="<?= htmlspecialchars($r['name']) ?>" onerror="this.style.display='none';this.nextElementSibling.style.display='flex';">
                                    <i class="bi <?= $rIcon ?>" style="display:none;"></i>
                                <?php else: ?>
                                    <i class="bi <?= $rIcon ?>"></i>
                                <?php endif; ?>
                            </div>
                        </a>
                        <div class="cv-product-body">
                            <div class="cv-product-cat"><?= htmlspecialchars($r['category']) ?></div>
                            <a href="product.php?id=<?= (int)$r['id'] ?>" class="cv-product-link">
                                <div class="cv-product-name"><?= htmlspecialchars($r['name']) ?></div>
                            </a>
                            <div class="cv-product-desc"><?= htmlspecialchars($r['description']) ?></div>
                            <div class="cv-product-footer">
                                <span class="cv-product-price">&#8369;<?= number_format($r['price'], 2) ?></span>
                                <form action="cart_action.php" method="post">
                                    <input type="hidden" name="action" value="add">
                                    <input type="hidden" name="id" value="<?= (int)$r['id'] ?>">
                                    <input type="hidden" name="redirect" value="product.php?id=<?= (int)$product['id'] ?>">
                                    <button type="submit" name="submit" class="btn-cv" <?= $rOutOfStock ? 'disabled' : '' ?>>
                                        <?php if ($rOutOfStock): ?>
                                            Unavailable
                                        <?php else: ?>
                                            <i class="bi bi-cart-plus"></i> Add to Cart
                                        <?php endif; ?>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

  
    var qtyInput = document.getElementById('cv-pd-qty');
    var qtyMinus = document.getElementById('cv-pd-qty-minus');
    var qtyPlus  = document.getElementById('cv-pd-qty-plus');

    if (qtyInput && qtyMinus && qtyPlus) {
        qtyMinus.addEventListener('click', function () {
            var val = parseInt(qtyInput.value, 10) || 1;
            if (val > 1) qtyInput.value = val - 1;
        });
        qtyPlus.addEventListener('click', function () {
            var val = parseInt(qtyInput.value, 10) || 1;
            var max = parseInt(qtyInput.getAttribute('max'), 10);
            if (!max || val < max) qtyInput.value = val + 1;
        });
    }

    function toggleWishlist(btn) {
        btn.classList.toggle('active');
        var icon = btn.querySelector('i');
        if (icon) {
            icon.classList.toggle('bi-heart');
            icon.classList.toggle('bi-heart-fill');
        }
    }
    var wishlistMain = document.getElementById('cv-pd-wishlist-btn');
    if (wishlistMain) wishlistMain.addEventListener('click', function () { toggleWishlist(wishlistMain); });

  
    var tabButtons = document.querySelectorAll('.cv-pd-tab-btn');
    var tabPanels  = document.querySelectorAll('.cv-pd-tab-panel');

    tabButtons.forEach(function (btn) {
        btn.addEventListener('click', function () {
            tabButtons.forEach(function (b) { b.classList.remove('active'); });
            tabPanels.forEach(function (p) { p.classList.remove('active'); });

            btn.classList.add('active');
            var target = btn.getAttribute('data-tab');
            var panel = document.querySelector('.cv-pd-tab-panel[data-panel="' + target + '"]');
            if (panel) panel.classList.add('active');
        });
    });

});
</script>

<?php require('include/footer.php'); ?>