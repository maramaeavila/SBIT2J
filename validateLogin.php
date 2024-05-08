<?php
include "connection.php";
session_start();

$sql = "SELECT * FROM SBIT2J_USERACCOUNT WHERE username=:usernamex";
$stid = oci_parse($conn, $sql);
oci_bind_by_name($stid, ':usernamex', $_POST['uname']);
$res = oci_execute($stid);

$row = oci_fetch_assoc($stid);

if ($row) {
    if (password_verify($_POST['pword'], $row['PASSWORD'])) {
        $_SESSION['username'] = $row['USERNAME'];
        $_SESSION['utype'] = $row['USERTYPE'];
        if ($row['USERTYPE'] == 2) {
            echo "successadmin";
        } else {
            echo "success";
        }
    } else {
        echo "Invalid Password!";
    }
} else {
    echo "Account not exists!";
}
