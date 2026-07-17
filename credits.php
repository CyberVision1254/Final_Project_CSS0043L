<?php
session_start();

$credits = [

    'A34 Executive Chair' => ['store' => 'Furniture Manila', 'url' => ''],
    'YS901A Executive Chair' => ['store' => 'Furniture Manila', 'url' => ''],
    'Clarion High-Back Executive Office Chair' => ['store' => 'Furniture Manila', 'url' => ''],
    'B75 Executive Chair' => ['store' => 'Furniture Manila', 'url' => ''],
    'CX300H Executive Chair' => ['store' => 'Furniture Manila', 'url' => ''],
    'Avius 746 Executive Chair' => ['store' => 'Furniture Manila', 'url' => ''],
    'Virello Executive Chair – Reclining Chair w/ Adjustable Headrest' => ['store' => 'Furniture Manila', 'url' => ''],
    'Apollo Reclining Executive Chair' => ['store' => 'Furniture Manila', 'url' => ''],
    'Orion Reclining Executive Office Chair with Footrest' => ['store' => 'Furniture Manila', 'url' => ''],
    'Titan Reclining Executive Chair' => ['store' => 'Furniture Manila', 'url' => ''],


    'Cradle Comfort Ergonomic Office Chair' => ['store' => 'Stance Philippines', 'url' => ''],
    'Cradle Comfort Lite Ergonomic Office Chair' => ['store' => 'Stance Philippines', 'url' => ''],
    'Stance Aero Form Ergonomic Office Chair' => ['store' => 'Stance Philippines', 'url' => ''],
    'Cradle Flexi Prestige Edition' => ['store' => 'Stance Philippines', 'url' => ''],
    'Cradle Flexi Ergonomic Office Chair' => ['store' => 'Stance Philippines', 'url' => ''],
    'Cradle Pro Ergonomic Office Chair' => ['store' => 'Stance Philippines', 'url' => ''],
    'Stance Halo Ergonomic Office Chair' => ['store' => 'Stance Philippines', 'url' => ''],
    'Stance BetterWork Pro Ergonomic Office Chair' => ['store' => 'Stance Philippines', 'url' => ''],
    'Stance Stylite Ergonomic Office Chair' => ['store' => 'Stance Philippines', 'url' => ''],
    'Novo Thorne Ergonomic Office Chair' => ['store' => 'Stance Philippines', 'url' => ''],


    'TTRacing Maxx Pro Gaming Chair' => ['store' => 'TTRacing Philippines', 'url' => ''],
    'TTRacing Maxx Pro Air Threads Fabric Gaming Chair' => ['store' => 'TTRacing Philippines', 'url' => ''],
    'TTRacing Maxx Gaming Chair' => ['store' => 'TTRacing Philippines', 'url' => ''],
    'TTRacing Maxx Air Threads Fabric Gaming Chair' => ['store' => 'TTRacing Philippines', 'url' => ''],
    'DXRACER DRIFTING Series' => ['store' => 'DXRACER', 'url' => ''],
    'DXRACER CRAFT Series' => ['store' => 'DXRACER', 'url' => ''],
    'DXRACER MARTIAN Series' => ['store' => 'DXRACER', 'url' => ''],
    'DXRACER TANK Series' => ['store' => 'DXRACER', 'url' => ''],
    'DXRACER BLADE Series' => ['store' => 'DXRACER', 'url' => ''],
    'DXRACER FORMULA Series' => ['store' => 'DXRACER', 'url' => ''],
];


$byStore = [];
foreach ($credits as $product => $info) {
    $storeName = $info['store'] ?: 'Unknown Source';
    if (!isset($byStore[$storeName]['url'])) {
        $byStore[$storeName]['url'] = $info['url'];
    }
    $byStore[$storeName]['products'][] = $product;
}

$title = "CyberVision - Credits";
$currentPage = "credits";


require("include/header.php");
?>

<section class="cv-credits-hero">
    <span class="cv-credits-eyebrow">Credits</span>
    <h1>Every Chair, Properly <span>Credited</span>.</h1>
    <p>This website was developed by CyberVision for educational purposes only. All chair images, product names, trademarks, and descriptions remain the property of their respective manufacturers and retailers. They are displayed solely for academic demonstration and not for commercial use. No copyright infringement is intended, and no actual purchases can be made through this website.</p>
</section>

<div class="cv-credits-grid">
    <?php foreach ($byStore as $storeName => $data): ?>
        <details class="cv-store-card">
            <summary class="cv-store-card-head">
                <div class="cv-store-name">
                    <?php if (!empty($data['url'])): ?>
                        <a href="<?= htmlspecialchars($data['url']) ?>" target="_blank" rel="noopener" onclick="event.stopPropagation()"><?= htmlspecialchars($storeName) ?></a>
                    <?php else: ?>
                        <?= htmlspecialchars($storeName) ?>
                    <?php endif; ?>
                </div>
                <div class="cv-store-meta">
                    <span class="cv-store-count"><?= count($data['products']) ?> product<?= count($data['products']) > 1 ? 's' : '' ?></span>
                    <span class="cv-store-arrow"></span>
                </div>
            </summary>
            <ul class="cv-store-products">
                <?php foreach ($data['products'] as $product): ?>
                    <li><?= htmlspecialchars($product) ?></li>
                <?php endforeach; ?>
            </ul>
        </details>
    <?php endforeach; ?>
</div>

<?php require("include/footer.php"); ?>