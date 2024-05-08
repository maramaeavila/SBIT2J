<?php
include "connection.php";

$sql = "SELECT COUNT(*) AS ux FROM SBIT2J_USERACCOUNT WHERE username=:usernamex";

$stid = oci_parse($conn, $sql);
oci_bind_by_name($stid, ':usernamex', $_POST['username']);
oci_execute($stid);
$row = oci_fetch_assoc($stid);

if ($row['UX'] > 0) {
    echo "Username already exists";
} else {

    $sql = "INSERT INTO SBIT2J_USERACCOUNT(username, name, usertype, email, contactnumber, address, city, password)
                        VALUES(:username,:name,:usertype,:email,:contactno,:address,:city,:password)    ";
    $statement = oci_parse($conn, $sql);
    $usertype = 1;
    $password = $_POST['password'];
    $pw = password_hash($password, PASSWORD_DEFAULT);
    oci_bind_by_name($statement, ':username', $_POST['username']);
    oci_bind_by_name($statement, ':name', $_POST['name']);
    oci_bind_by_name($statement, ':usertype', $usertype);
    oci_bind_by_name($statement, ':email', $_POST['email']);
    oci_bind_by_name($statement, ':contactno', $_POST['contactno']);
    oci_bind_by_name($statement, ':address', $_POST['address']);
    oci_bind_by_name($statement, ':city', $_POST['city']);
    oci_bind_by_name($statement, ':password', $pw);

    $result = oci_execute($statement);

    echo "success";
}
