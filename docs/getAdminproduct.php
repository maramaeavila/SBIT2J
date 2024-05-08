<?php
include "connection.php";

if (isset($_POST['prod_id']) && !empty($_POST['prod_id'])) {
    $prod_id = $_POST['prod_id'];

    $sql = "SELECT PROD_ID, PROD_NAME, PROD_CATGENDER, PROD_CATEGORY, PROD_PRICE, PROD_SIZE, PROD_DESCRIPTION FROM products WHERE PROD_ID = :prod_id";
    $stmt = oci_parse($conn, $sql);
    oci_bind_by_name($stmt, ':prod_id', $prod_id);
    oci_execute($stmt);
    $product = oci_fetch_assoc($stmt);

    unset($product['PROD_IMAGE']);

    echo json_encode($product);
} else {
    echo json_encode(array('error' => 'Product ID is not provided'));
}
