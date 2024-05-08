<?php
include "connection.php";

$sql = "UPDATE SBIT2J_CART SET CART_QTY = :quantity, CART_TOTAL = :total WHERE ID = :id";
$stmt = oci_parse($conn, $sql);
oci_bind_by_name($stmt, ':quantity', $_POST['quantity']);
oci_bind_by_name($stmt, ':total', $_POST['total']);
oci_bind_by_name($stmt, ':id', $_POST['id']);

$result = oci_execute($stmt);

if ($result) {
    $response = array(
        'success' => true
    );
    echo json_encode($response);
}
