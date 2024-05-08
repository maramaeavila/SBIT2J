<?php
include "connection.php";

if (isset($_POST['password'])) {
    $password = $_POST['password'];
    $username = $_POST['username'];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "UPDATE SBIT2J_USERACCOUNT SET password=:passwordx WHERE username=:usernamex";

    $stid = oci_parse($conn, $sql);
    oci_bind_by_name($stid, ':usernamex', $username);
    oci_bind_by_name($stid, ':passwordx', $hashed_password);

    $success = oci_execute($stid);

    if ($success) {
        echo "Password was successfully changed";
    } else {
        echo "Error: Unable to change password";
    }
} else {
    echo "Error: Password not provided";
}
