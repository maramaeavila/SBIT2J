<?php
include "connection.php";

if (isset($_POST['prod_id']) && !empty($_POST['prod_id'])) {
    $prod_id = $_POST['prod_id'];

    $sql = "SELECT P_ID, P_NAME, P_CATGENDER, P_CATEGORY, P_SIZE, P_PRICE, P_DESCRIPTION, P_IMAGE FROM SBIT2J_PRODUCTSTBL WHERE P_ID = :prod_id";
    $stmt = oci_parse($conn, $sql);
    oci_bind_by_name($stmt, ':prod_id', $prod_id);
    oci_execute($stmt);
    $product = oci_fetch_assoc($stmt);

    if ($product) {

        $product['P_IMAGE'] = './uploads/' . $product['P_IMAGE'];

        echo json_encode($product);
    } else {
        echo json_encode(array('error' => 'Product not found'));
    }
} else {
    echo json_encode(array('error' => 'Product ID is not provided'));
}
