<?php
session_start();
require_once('../db.php');

if (isset($_SESSION['islogged'])) {
    $name_esc = mysqli_real_escape_string($conn, $_SESSION['fullname']);
    $uid      = (int)$_SESSION['user_id'];
    $role_esc = mysqli_real_escape_string($conn, $_SESSION['role']);
    mysqli_query($conn, "INSERT INTO audit_log (user_id,actor_name,actor_role,action,description)
                         VALUES ($uid,'$name_esc','$role_esc','LOGOUT','$name_esc logged out.')");
}

mysqli_close($conn);

if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

session_destroy();

header('Location: ../login.php');
exit();
?>