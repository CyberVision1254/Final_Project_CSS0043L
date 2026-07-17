<?php
$logoExists = file_exists(__DIR__ . "/../../images/Cybervisionlogo.png");
$logoSrc = "../images/Cybervisionlogo.png";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <title><?= $title ?> | CyberVision Admin</title>
</head>
<body>


<div class="cv-group-bar">
    <?php if ($logoExists): ?><img src="<?= $logoSrc ?>" alt="CyberVision"><?php endif; ?>
    <strong>CyberVision</strong>
</div>

<div class="container-fluid p-0">
    <div class="row g-0">

        <div class="col-md-2 admin-sidebar d-flex flex-column">
            <div class="p-3 border-bottom" style="border-color:var(--cv-border)!important;">
                <a href="../index.php" class="text-decoration-none fw-bold d-flex align-items-center gap-2" style="color:var(--cv-text);">
                    <?php if ($logoExists): ?>
                        <img src="<?= $logoSrc ?>" alt="CyberVision" style="height:26px;width:auto;">
                    <?php endif; ?>
                    <span style="font-family:'Poppins',sans-serif;">CyberVision</span>
                </a>
                <div style="font-size:0.72rem;color:var(--cv-muted);margin-top:2px;">Admin Panel</div>
            </div>

            <div class="px-3 py-2 border-bottom" style="border-color:var(--cv-border)!important;">
                <div style="font-size:0.72rem;color:var(--cv-muted);">Logged in as:</div>
                <div class="fw-bold" style="font-size:0.84rem;color:var(--cv-text);">
                    <i class="bi bi-person-circle" style="color:var(--cv-accent);"></i> <?= htmlspecialchars($_SESSION['fullname'] ?? '') ?>
                </div>
            </div>

            <nav class="nav flex-column p-2 mt-1 flex-grow-1">
                <a class="nav-link mb-1 <?= (isset($adminNav) && $adminNav == 'dashboard') ? 'active' : '' ?>" href="index.php">
                    <i class="bi bi-speedometer2 me-2"></i> Dashboard
                </a>
                <a class="nav-link mb-1 <?= (isset($adminNav) && $adminNav == 'inventory') ? 'active' : '' ?>" href="inventory.php">
                    <i class="bi bi-box-seam me-2"></i> Inventory &amp; Pricing
                </a>
                <a class="nav-link mb-1 <?= (isset($adminNav) && $adminNav == 'orders') ? 'active' : '' ?>" href="orders.php">
                    <i class="bi bi-receipt me-2"></i> Orders
                </a>
                <a class="nav-link mb-1 <?= (isset($adminNav) && $adminNav == 'users') ? 'active' : '' ?>" href="users.php">
                    <i class="bi bi-people me-2"></i> Admin Users
                </a>
                <a class="nav-link mb-1 <?= (isset($adminNav) && $adminNav == 'reports') ? 'active' : '' ?>" href="reports.php">
                    <i class="bi bi-bar-chart-line me-2"></i> Reports
                </a>
                <hr class="sidebar-divider my-2">
                <a class="nav-link mb-1" style="color:#F87171;" href="logout.php">
                    <i class="bi bi-box-arrow-left me-2"></i> Logout
                </a>
                <a class="nav-link" style="color:var(--cv-muted);font-size:0.8rem;" href="../index.php">
                    <i class="bi bi-arrow-left-circle me-2"></i> View Live Site
                </a>
            </nav>
        </div>


        <div class="col-md-10 admin-main p-4">