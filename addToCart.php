<?php
include "connection.php";
session_start();

$username = $_SESSION['username'];

$sql_max_product_id = "SELECT MAX(ID) AS MAX_ID FROM SBIT2J_CART";
$stmt_max_product_id = oci_parse($conn, $sql_max_product_id);
oci_execute($stmt_max_product_id);
$max_id_row = oci_fetch_assoc($stmt_max_product_id);

if ($max_id_row['MAX_ID'] !== null) {
    $next_product_id = $max_id_row['MAX_ID'] + 1;
} else {
    $next_product_id = 1;
}

$sql_insert_cart = "INSERT INTO SBIT2J_CART (ID, CART_PRODID, CART_PRODNAME, CART_PRICE, CART_SIZE, CART_QTY, CART_TOTAL, CART_PRODIMAGE, USERNAME)
                    VALUES (:id, :productid, :productname, :cartprice, :cartsize, :cartqty, :carttotal, :cartimage, :username)";
$stmt_insert_cart = oci_parse($conn, $sql_insert_cart);
oci_bind_by_name($stmt_insert_cart, ':id', $next_product_id);
oci_bind_by_name($stmt_insert_cart, ':productid', $_POST['productId']);
oci_bind_by_name($stmt_insert_cart, ':productname', $_POST['name']);
oci_bind_by_name($stmt_insert_cart, ':cartprice', $_POST['price']);
oci_bind_by_name($stmt_insert_cart, ':cartsize', $_POST['size']);
oci_bind_by_name($stmt_insert_cart, ':cartqty', $_POST['quantity']);
oci_bind_by_name($stmt_insert_cart, ':carttotal', $_POST['total']);
oci_bind_by_name($stmt_insert_cart, ':cartimage', $_POST['image']);
oci_bind_by_name($stmt_insert_cart, ':username', $username);

$result_insert_cart = oci_execute($stmt_insert_cart);

if ($result_insert_cart) {
    echo "success";
} else {
    echo "Error inserting into SBIT2J_CART";
}
