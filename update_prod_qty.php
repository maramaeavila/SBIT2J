<?php
include "connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $productId = $_POST['productId'];
    $productQty = $_POST['productQty'];

    $sql = "UPDATE SBIT2J_PRODUCTSTBL SET P_QTY = P_QTY + :productQty WHERE P_ID = :productId";
    $stmt = oci_parse($conn, $sql);
    oci_bind_by_name($stmt, ':productQty', $productQty);
    oci_bind_by_name($stmt, ':productId', $productId);

    if (oci_execute($stmt)) {
        $response = array('success' => true, 'message' => 'Product quantity updated successfully');
    } else {
        $response = array('success' => false, 'message' => 'Error updating product quantity');
    }

    oci_close($conn);

    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    http_response_code(405);
    echo json_encode(array('success' => false, 'message' => 'Only POST requests are allowed'));
}
