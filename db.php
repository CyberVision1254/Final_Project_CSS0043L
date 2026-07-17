<?php

$host     = "localhost";
$user     = "root";
$password = "";
$dbname   = "cybervision";


$conn = mysqli_connect($host, $user, $password, $dbname);


if (!$conn) {
    die("Connection error: " . mysqli_connect_error());
}
?>
