<?php
$user = "system ";
$pass = "1234";
$host = "localhost";
$conn = oci_connect($user, $pass, $host);

if (!$conn) {
    $error = oci_error();
    echo "Connection failed: " . $error['message'];
    exit;
} else {
    // echo "Connected to Oracle DB!<br>";
}
