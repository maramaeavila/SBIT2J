<?php
include "connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['xproductidx'])) {
    $product_id = $_POST['xproductidx'];

    $sql_delete_product = "DELETE FROM SBIT2J_PRODUCTSTBL WHERE P_ID = :prod_id";
    $stmt_delete_product = oci_parse($conn, $sql_delete_product);
    oci_bind_by_name($stmt_delete_product, ':prod_id', $product_id);
    oci_execute($stmt_delete_product);

    echo '<script>alert("Product deleted successfully");</script>';
    header("refresh:0;url=indexadmin.php");
    exit;
}
