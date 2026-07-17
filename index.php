<?php
session_start();
require_once('db.php');

$title       = "CyberVision - Premium Office Chairs";
$currentPage = "home";

$catIcons = array(
    'Ergonomic Chairs'         => 'bi-person-workspace',
    'Executive Chairs'         => 'bi-briefcase',
    'Gaming Chairs'            => 'bi-controller',
);

$sql    = "SELECT DISTINCT category FROM products WHERE is_active = 1 ORDER BY category";
$result = mysqli_query($conn, $sql);

$categories = array();
while ($row = mysqli_fetch_assoc($result)) {
    $categories[] = $row['category'];
}

$catImages = array();
foreach ($categories as $cat) {
    $imgSql  = "SELECT image FROM products WHERE category = ? AND is_active = 1 AND image IS NOT NULL AND image != '' LIMIT 1";
    $imgStmt = mysqli_prepare($conn, $imgSql);
    mysqli_stmt_bind_param($imgStmt, "s", $cat);
    mysqli_stmt_execute($imgStmt);
    $imgResult = mysqli_stmt_get_result($imgStmt);
    $imgRow    = mysqli_fetch_assoc($imgResult);
    $catImages[$cat] = $imgRow ? $imgRow['image'] : null;
    mysqli_stmt_close($imgStmt);
}

$heroSql    = "SELECT image FROM products WHERE is_active = 1 AND image IS NOT NULL AND image != '' ORDER BY price DESC LIMIT 1";
$heroResult = mysqli_query($conn, $heroSql);
$heroRow    = mysqli_fetch_assoc($heroResult);
$heroImage  = $heroRow ? $heroRow['image'] : null;

$featuredSql    = "SELECT * FROM products WHERE is_active = 1 ORDER BY price DESC LIMIT 4";
$featuredResult = mysqli_query($conn, $featuredSql);
$featured       = array();
while ($row = mysqli_fetch_assoc($featuredResult)) {
    $featured[] = $row;
}

require('include/header.php');
?>


<section class="cv-hero">
    <div class="cv-hero-inner">
        <div class="cv-hero-left">
            <span class="cv-hero-eyebrow"><i class="bi bi-arrow-repeat"></i> Premium Office Chairs</span>
            <h1>Sit Better.<br><span>Work Better.</span></h1>
            <p>CyberVision offers a curated selection of office chairs ranging from all-day ergonomic workhorses to executive leather seats and gaming rigs. Find the chair that fits the way you work.</p>
            <div class="cv-hero-btns">
                <a href="store.php" class="btn-hero-primary">
                    Shop Chairs <i class="bi bi-arrow-right"></i>
                </a>
                <a href="about.php" class="btn-hero-outline">
                    About Us
                </a>
            </div>
            <div class="cv-hero-trust">
                <span class="cv-hero-trust-item"><i class="bi bi-shield-check"></i> Premium Quality</span>
                <span class="cv-hero-trust-item"><i class="bi bi-truck"></i> Delivery Available</span>
                <span class="cv-hero-trust-item"><i class="bi bi-patch-check"></i> Trusted by Professionals</span>
            </div>
        </div>

        <?php if ($heroImage): ?>
            <div class="cv-hero-image">
                <img src="<?= htmlspecialchars($heroImage) ?>" alt="Featured chair">
            </div>
        <?php endif; ?>

        <div class="cv-hero-features">
            <div class="cv-hero-feature">
                <div class="cv-hero-feature-icon"><i class="bi bi-person-arms-up"></i></div>
                <div class="cv-hero-feature-text">
                    <strong>Ergonomic Design</strong>
                    <span>Supports posture and reduces fatigue.</span>
                </div>
            </div>
            <div class="cv-hero-feature">
                <div class="cv-hero-feature-icon"><i class="bi bi-gem"></i></div>
                <div class="cv-hero-feature-text">
                    <strong>Premium Materials</strong>
                    <span>Built with high-quality materials for durability.</span>
                </div>
            </div>
            <div class="cv-hero-feature">
                <div class="cv-hero-feature-icon"><i class="bi bi-shield-check"></i></div>
                <div class="cv-hero-feature-text">
                    <strong>Built to Last</strong>
                    <span>Tested for strength, made for everyday use.</span>
                </div>
            </div>
        </div>
    </div>
</section>


<div class="cv-info-strip">
    <div class="cv-info-strip-inner">
        <div class="cv-info-strip-item">
            <div class="cv-info-icon"><i class="bi bi-award"></i></div>
            <h5>Premium Quality</h5>
            <p>Every chair is selected for comfort, build quality, and durability</p>
        </div>
        <div class="cv-info-strip-item">
            <div class="cv-info-icon"><i class="bi bi-truck"></i></div>
            <h5>Delivery Available</h5>
            <p>Nationwide delivery for all orders placed through the site</p>
        </div>
        <div class="cv-info-strip-item">
            <div class="cv-info-icon"><i class="bi bi-headset"></i></div>
            <h5>Customer Support</h5>
            <p>We're here to help with orders, questions, and anything in between</p>
        </div>
    </div>
</div>


<section class="cv-section">
    <div class="cv-section-inner">
        <p class="cv-section-label">Browse</p>
        <h2 class="cv-section-title">Shop by Chair Type</h2>
        <p class="cv-section-sub">Find exactly what you need from our chair categories.</p>

        <div class="cv-category-tiles">
            <?php foreach ($categories as $cat):
                $icon = isset($catIcons[$cat]) ? $catIcons[$cat] : 'bi-person-workspace';
                $img  = $catImages[$cat];
            ?>
                <a href="store.php?cat=<?= urlencode($cat) ?>" class="cv-category-tile">
                    <div class="cv-category-tile-thumb">
                        <?php if ($img): ?>
                            <img src="<?= htmlspecialchars($img) ?>" alt="<?= htmlspecialchars($cat) ?>" onerror="this.style.display='none';this.nextElementSibling.style.display='flex';">
                            <i class="bi <?= $icon ?>" style="display:none;"></i>
                        <?php else: ?>
                            <i class="bi <?= $icon ?>"></i>
                        <?php endif; ?>
                    </div>
                    <div class="cv-category-tile-label">
                        <i class="bi <?= $icon ?>"></i>
                        <span><?= htmlspecialchars($cat) ?></span>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>


<section class="cv-section cv-comfort-section">
    <div class="cv-section-inner">
        <div class="cv-comfort-grid">
            <div class="cv-comfort-intro">
                <p class="cv-section-label">Designed for Performance</p>
                <h2>Engineered for Comfort.<br><span>Built for Productivity.</span></h2>
            </div>
            <div class="cv-comfort-card">
                <div class="cv-comfort-icon"><i class="bi bi-arrows-angle-expand"></i></div>
                <h5>Adjustable Comfort</h5>
                <p>Customizable to fit your ideal position.</p>
            </div>
            <div class="cv-comfort-card">
                <div class="cv-comfort-icon"><i class="bi bi-wind"></i></div>
                <h5>Breathable Materials</h5>
                <p>Stay cool and comfortable even on long hours.</p>
            </div>
            <div class="cv-comfort-card">
                <div class="cv-comfort-icon"><i class="bi bi-shield-check"></i></div>
                <h5>Lumbar Support</h5>
                <p>Designed to support your lower back naturally.</p>
            </div>
        </div>
    </div>
</section>


<?php if (!empty($featured)): ?>
<section class="cv-section cv-section-light">
    <div class="cv-section-inner">
        <p class="cv-section-label">Handpicked</p>
        <h2 class="cv-section-title">Featured Chairs</h2>
        <p class="cv-section-sub">A few standout picks from across our lineup.</p>

        <div class="cv-product-grid">
            <?php foreach ($featured as $p):
                $icon       = isset($catIcons[$p['category']]) ? $catIcons[$p['category']] : 'bi-person-workspace';
                $outOfStock = (int)$p['stock_qty'] <= 0;
            ?>
                <div class="cv-product-card">
                    <a href="product.php?id=<?= (int)$p['id'] ?>" class="cv-product-link">
                        <div class="cv-product-thumb">
                            <?php if (!empty($p['image'])): ?>
                                <img src="<?= htmlspecialchars($p['image']) ?>" alt="<?= htmlspecialchars($p['name']) ?>" onerror="this.style.display='none';this.nextElementSibling.style.display='flex';">
                                <i class="bi <?= $icon ?>" style="display:none;"></i>
                            <?php else: ?>
                                <i class="bi <?= $icon ?>"></i>
                            <?php endif; ?>
                        </div>
                    </a>
                    <div class="cv-product-body">
                        <div class="cv-product-cat"><?= htmlspecialchars($p['category']) ?></div>
                        <a href="product.php?id=<?= (int)$p['id'] ?>" class="cv-product-link">
                            <div class="cv-product-name"><?= htmlspecialchars($p['name']) ?></div>
                        </a>
                        <div class="cv-product-desc"><?= htmlspecialchars($p['description']) ?></div>
                        <div class="cv-product-footer">
                            <span class="cv-product-price">&#8369;<?= number_format($p['price'], 2) ?></span>
                            <form action="cart_action.php" method="post">
                                <input type="hidden" name="action" value="add">
                                <input type="hidden" name="id" value="<?= (int)$p['id'] ?>">
                                <input type="hidden" name="redirect" value="index.php">
                                <button type="submit" name="submit" class="btn-cv" <?= $outOfStock ? 'disabled' : '' ?>>
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
            <?php endforeach; ?>
        </div>

        <div class="cv-section-cta">
            <a href="store.php" class="btn-cv-outline">View Full Store <i class="bi bi-arrow-right"></i></a>
        </div>
    </div>
</section>
<?php endif; ?>


<section class="cv-section">
    <div class="cv-section-inner">
        <div class="row g-4">
            <div class="col-md-6">
                <p class="cv-section-label">Our Focus</p>
                <h2 class="cv-section-title">One Product.<br>Done Right.</h2>
                <p class="cv-section-sub">At CyberVision, we focus exclusively on chairs because specialization leads to better quality. Whether you're setting up a home office or furnishing a 50-person workspace, you'll find the perfect seating solution with us.</p>
                <a href="store.php" class="btn-cv mt-2">Browse the Store <i class="bi bi-arrow-right"></i></a>
            </div>
            <div class="col-md-6">
                <p class="cv-section-label">The Team</p>
                <h2 class="cv-section-title">Built by CyberVision</h2>
                <p class="cv-section-sub">Welcome to CyberVision. Register an account, browse our collection of chairs, add your favorites to your cart, and experience the complete checkout process. The website is fully functional, but purchases are for demonstration purposes only.</p>
                <a href="about.php" class="btn-cv-outline mt-2">Meet the Team</a>
            </div>
        </div>
    </div>
</section>

<?php mysqli_close($conn); require('include/footer.php'); ?>