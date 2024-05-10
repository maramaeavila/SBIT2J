<?php
<<<<<<< HEAD
$user = "system";
$pass = "Kevs#123";
$port = "1521";
$service_name = "orcl";
=======
$user = "maru";
$pass = "1234";
>>>>>>> 5328065d711dce9d6dfa89eb120f29a199626a86
$host = "localhost";
$tns = "(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST={$host})(PORT={$port}))(CONNECT_DATA=(SERVICE_NAME={$service_name})))";
$conn = oci_connect($user, $pass, $tns);

if (!$conn) {
    $error = oci_error();
    echo "Connection failed: " . $error['message'];
    exit;
} else {
    // "Connected to Oracle DB!<br>";
}
