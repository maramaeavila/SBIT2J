<?php
$user = "maru";
$pass = "1234";
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
