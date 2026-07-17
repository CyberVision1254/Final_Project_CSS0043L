<?php
session_start();
if (!isset($_SESSION['islogged']) || !isset($_SESSION['isadmin'])) { header('Location: ../login.php'); exit(); }
require_once('../db.php');

$title    = "Dashboard";
$adminNav = "dashboard";

$total_products = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as c FROM products WHERE is_active=1"))['c'];
$low_stock      = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as c FROM products WHERE is_active=1 AND stock_qty<=5"))['c'];
$total_buyers   = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as c FROM users WHERE role='buyer'"))['c'];
$total_admins   = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as c FROM users WHERE role='admin'"))['c'];
$total_orders   = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as c FROM orders"))['c'];
$total_revenue  = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COALESCE(SUM(total_amount),0) as s FROM orders"))['s'];

$audit_result = mysqli_query($conn, "SELECT * FROM audit_log ORDER BY date_created DESC LIMIT 10");
require('include/header.php');
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-0" style="color:var(--cv-text);">Dashboard</h4>
        <p class="mb-0 small" style="color:var(--cv-muted);">Quick overview of CyberVision.</p>
    </div>
    <span class="cv-nav-greeting" style="border:1px solid var(--cv-border);border-radius:999px;padding:8px 16px;background:var(--cv-panel);">
        <i class="bi bi-person-circle" style="color:var(--cv-accent);"></i>
        <span style="color:var(--cv-text);"><?= htmlspecialchars($_SESSION['fullname']) ?></span>
    </span>
</div>


<div class="row row-cols-2 row-cols-md-3 g-3 mb-4">
    <?php
    $stats = array(
        array('label'=>'Active Chairs',     'value'=>$total_products, 'warn'=>false),
        array('label'=>'Low Stock', 'value'=>$low_stock,      'warn'=>$low_stock > 0),
        array('label'=>'Buyers',            'value'=>$total_buyers,   'warn'=>false),
        array('label'=>'Admin Users',       'value'=>$total_admins,   'warn'=>false),
        array('label'=>'Orders Placed',     'value'=>$total_orders,   'warn'=>false),
        array('label'=>'Total Revenue',     'value'=>'&#8369;'.number_format($total_revenue,2), 'warn'=>false, 'accent'=>true),
    );
    foreach ($stats as $s):
        $valueColor = $s['warn'] ? '#F87171' : (isset($s['accent']) ? 'var(--cv-accent)' : 'var(--cv-text)');
        $cardStyle  = $s['warn'] ? 'border-color:#F87171;' : '';
    ?>
        <div class="col">
            <div class="cv-card h-100" style="<?= $cardStyle ?>">
                <div class="mb-1" style="font-size:0.72rem;letter-spacing:0.06em;text-transform:uppercase;color:var(--cv-muted);"><?= $s['label'] ?></div>
                <div class="fw-bold" style="font-size:1.6rem;color:<?= $valueColor ?>;">
                    <?= $s['value'] ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php if ($low_stock > 0): ?>
<div class="cv-alert cv-alert-warning">
    <p><i class="bi bi-exclamation-triangle"></i> <?= $low_stock ?> chair<?= $low_stock > 1 ? 's are' : ' is' ?> running low on stock (5 or fewer units).</p>
</div>
<?php endif; ?>

<div class="cv-card">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <p class="cv-card-title mb-0">Recent Activity</p>
        <a href="reports.php" class="btn-cv-outline" style="padding:6px 14px;font-size:0.82rem;">View Full Audit Log &rarr;</a>
    </div>
    <div class="cv-table-wrap">
        <table class="cv-table">
            <thead>
                <tr><th>Date / Time</th><th>User</th><th>Action</th><th>Details</th></tr>
            </thead>
            <tbody>
                <?php
                $counter = 0;
                while ($log = mysqli_fetch_assoc($audit_result)):
                    $counter++;
                ?>
                    <tr>
                        <td class="small" style="color:var(--cv-muted);"><?= date("M d, Y g:i A", strtotime($log['date_created'])) ?></td>
                        <td><?= htmlspecialchars($log['actor_name']) ?></td>
                        <td>
                            <span style="background:rgba(45,224,219,0.1);color:var(--cv-accent);border:1px solid var(--cv-border);border-radius:999px;padding:3px 10px;font-size:0.74rem;font-weight:600;">
                                <?= htmlspecialchars($log['action']) ?>
                            </span>
                        </td>
                        <td class="small" style="color:var(--cv-muted);"><?= htmlspecialchars($log['description']) ?></td>
                    </tr>
                <?php endwhile; ?>
                <?php if ($counter == 0): ?>
                    <tr><td colspan="4" class="text-center" style="padding:24px;color:var(--cv-muted);">No activity recorded yet.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php mysqli_close($conn); require('include/footer.php'); ?>