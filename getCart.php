<?php
session_start();
include "connection.php";

$sql = "SELECT * FROM SBIT2J_CART INNER JOIN SBIT2J_PRODUCTSTBL ON SBIT2J_CART.ID = SBIT2J_PRODUCTSTBL.P_ID WHERE CART_PRODNAME = :prodname";
$statement = oci_parse($conn, $sql);

oci_bind_by_name($statement, ':prodname', $_SESSION['CART_PRODNAME']);
$result = oci_execute($statement);

if ($result) {
    $records = array();
    while ($row = oci_fetch_assoc($statement)) {
        $records[] = $row;
    }
    $response = array(
        'success' => true,
        'data' => $records
    );
    echo json_encode($response);
}
