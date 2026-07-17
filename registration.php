<?php
session_start();

$form_data  = isset($_SESSION['form_data']) ? $_SESSION['form_data'] : array();
unset($_SESSION['form_data']);
$logoExists = file_exists(__DIR__ . "/images/Cybervisionlogo.png");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <title>Register</title>
</head>
<body>

<div class="cv-auth-page">
    <div class="cv-auth-body">
        <div class="cv-auth-box wide">

            <div class="cv-auth-logo">
                <?php if ($logoExists): ?>
                    <img src="images/Cybervisionlogo.png" alt="CyberVision">
                <?php endif; ?>
                <span class="cv-auth-logo-name">CyberVision</span>
            </div>

            <h2 class="cv-auth-title">Create an Account</h2>
            <p class="cv-auth-sub">Register to start shopping at CyberVision.</p>

            <?php if (isset($_SESSION['errors'])): ?>
                <div class="cv-alert cv-alert-danger">
                    <?php foreach ($_SESSION['errors'] as $error): ?>
                        <p><i class="bi bi-exclamation-circle"></i> <?= htmlspecialchars($error) ?></p>
                    <?php endforeach; ?>
                </div>
                <?php unset($_SESSION['errors']); ?>
            <?php endif; ?>

            <form id="registerForm" action="checkregistration.php" method="post">

                <div class="cv-mb">
                    <label class="cv-form-label">Complete Name</label>
                    <input type="text" name="full_name" class="cv-form-control"
                           value="<?= htmlspecialchars($form_data['full_name'] ?? '') ?>"
                           required minlength="2" maxlength="100"
                           pattern="[A-Za-zÀ-ÖØ-öø-ÿ.\-'\s]+"
                           title="Please enter a valid name (letters, spaces, hyphens and apostrophes only).">
                </div>

                <div class="cv-mb">
                    <label class="cv-form-label">Email Address</label>
                    <input type="email" name="email" class="cv-form-control"
                           value="<?= htmlspecialchars($form_data['email'] ?? '') ?>"
                           required maxlength="150"
                           title="Please enter a valid email address.">
                </div>

                <div class="cv-form-row cv-mb">
                    <div>
                        <label class="cv-form-label">Password</label>
                        <input type="password" name="password" id="password" class="cv-form-control"
                               required minlength="8" maxlength="72"
                               pattern="(?=.*[A-Za-z])(?=.*\d).{8,}"
                               title="At least 8 characters, including at least one letter and one number.">
                        <p class="cv-form-hint">At least 8 characters, with letters and numbers.</p>
                    </div>
                    <div>
                        <label class="cv-form-label">Confirm Password</label>
                        <input type="password" name="confirm_password" id="confirm_password" class="cv-form-control"
                               required minlength="8" maxlength="72"
                               title="Please re-enter the same password.">
                    </div>
                </div>

                <div class="cv-mb">
                    <label class="cv-form-label">Complete Address</label>
                    <textarea name="address" class="cv-form-control"
                              required minlength="10" maxlength="255"
                              title="Please enter your complete address (at least 10 characters)."><?= htmlspecialchars($form_data['address'] ?? '') ?></textarea>
                </div>

                <div class="cv-mb">
                    <label class="cv-form-label">Contact Number</label>
                    <input type="tel" name="contact_number" class="cv-form-control"
                           placeholder="e.g. 0917 123 4567"
                           value="<?= htmlspecialchars($form_data['contact_number'] ?? '') ?>"
                           required
                           pattern="(09|\+639)\d{9}"
                           title="Please enter a valid PH mobile number, e.g. 09171234567 or +639171234567">
                </div>

                <button type="submit" name="submit" class="btn-cv w-100 justify-content-center" style="padding:12px;">
                    Create Account
                </button>
            </form>

            <p class="cv-auth-switch">
                Already have an account? <a href="login.php">Log in here</a>
            </p>

        </div>
    </div>
    <div class="cv-auth-footer">
        <strong>Disclaimer:</strong> This website was created for educational purposes only and is a requirement for our final project.
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
<script>
var passwordInput = document.getElementById('password');
var confirmInput  = document.getElementById('confirm_password');

function checkPasswordsMatch() {
    if (confirmInput.value !== passwordInput.value) {
        confirmInput.setCustomValidity('Passwords do not match.');
    } else {
        confirmInput.setCustomValidity('');
    }
    confirmInput.reportValidity();
}

confirmInput.addEventListener('input', checkPasswordsMatch);
passwordInput.addEventListener('input', function () {
    if (confirmInput.value) {
        checkPasswordsMatch();
    }
});

document.getElementById('registerForm').addEventListener('submit', function (e) {
    var contactInput = document.querySelector('input[name="contact_number"]');
    contactInput.value = contactInput.value.replace(/\s+/g, '');

    checkPasswordsMatch();
});
</script>

</body>
</html>