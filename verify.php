<?php
session_start();
require_once('db.php');

$token = isset($_GET['token']) ? $_GET['token'] : '';
$email = isset($_GET['email']) ? $_GET['email'] : '';

if (empty($token) || empty($email)) {
    $_SESSION['errors'] = array("Invalid verification link.");
    header('Location: login.php');
    exit();
}

$token_esc = mysqli_real_escape_string($conn, $token);
$email_esc = mysqli_real_escape_string($conn, $email);

$result = mysqli_query($conn, "SELECT id, is_verified FROM users WHERE email = '$email_esc' AND verify_token = '$token_esc' LIMIT 1");

if ($result && mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);

    if ($user['is_verified'] == 1) {
        $_SESSION['success'] = "Your account is already verified. You can log in.";
    } else {
        mysqli_query($conn, "UPDATE users SET is_verified = 1, verify_token = NULL WHERE id = " . (int)$user['id']);
        $_SESSION['success'] = "Your email has been verified! You can now log in.";
    }
} else {
    $_SESSION['errors'] = array("This verification link is invalid or has expired.");
}

mysqli_close($conn);
header('Location: login.php');
exit();
?>