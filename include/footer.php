<?php
$logoExists = file_exists(__DIR__ . "/../images/Cybervisionlogo.png");
?>
<footer class="cv-footer">
    <div class="cv-footer-inner">
        <div>
            <?php if ($logoExists): ?>
                <img src="images/Cybervisionlogo.png" alt="CyberVision Logo" class="cv-footer-brand-img" style="height:100px;width:auto;margin-bottom:10px;display:block;">
            <?php endif; ?>
            <div class="cv-footer-brand-name">CyberVision</div>
            <p>Discover office chairs designed for comfort and productivity, from ergonomic and executive models to gaming chairs.</p>
        </div>
        <div>
            <h6>Quick Links</h6>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="store.php">Store</a></li>
                <li><a href="cart.php">Cart</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="credits.php">Credits</a></li>
                <li><a href="login.php">Login</a></li>
                <li><a href="registration.php">Register</a></li>
            </ul>
        </div>
        <div>
            <h6>CyberVision</h6>
            <p>Final Project</p>
            <h6 style="margin-top:20px;">Chair Categories</h6>
            <ul>    
                <li><a href="store.php#Ergonomic+Chairs">Ergonomic Chairs</a></li>
                <li><a href="store.php#Executive+Chairs">Executive Chairs</a></li>
                <li><a href="store.php#Gaming+Chairs">Gaming Chairs</a></li>
            </ul>
        </div>
    </div>
    <div class="cv-footer-bottom">
        <p>&copy; <?= date('Y') ?> CyberVision</p>
        <p class="cv-disclaimer">
            <strong>Disclaimer:</strong> Disclaimer: This website was created for educational purposes only as part of a final project requirement. No real products are sold, and no real transactions are processed. The chairs featured on this website are not our own products. All product images, names, trademarks, and descriptions belong to their respective retailers or manufacturers and are used solely for academic, non-commercial demonstration purposes. Please visit our Credits page for the full credits.
        </p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>