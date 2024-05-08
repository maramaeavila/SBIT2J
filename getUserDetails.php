<?php
include "connection.php";
session_start();

$sql = "SELECT name, email, contactnumber, address, city FROM SBIT2J_USERACCOUNT WHERE username = :username";
$stmt = oci_parse($conn, $sql);

oci_bind_by_name($stmt, ':username', $_SESSION['username']);

$result = oci_execute($stmt);

if ($result) {
    $record = oci_fetch_assoc($stmt);
    $response = array(
        'success' => true,
        'data' => $record
    );
    echo json_encode($response);
} else {
    $response = array(
        'success' => false,
        'message' => 'Something went wrong.'
    );
    echo json_encode($response);
}
