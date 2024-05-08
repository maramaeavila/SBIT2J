<?php
require_once 'connection.php';

if (!empty($_GET)) {

    $_SESSION['product'] = $_GET['item_name'];
    $_SESSION['txn_id'] = $_GET['tx'];
    $_SESSION['amount'] = $_GET['amt'];
    $_SESSION['currency'] = $_GET['cc'];
    $_SESSION['status'] = $_GET['st'];
    $_SESSION['payer_id'] = $_GET['payer_id'];
    $_SESSION['payer_email'] = $_GET['payer_email'];
    $_SESSION['payer_name'] = $_GET['first_name'] . ' ' . $_GET['last_name'];

    $product = "Payment";
    $txn_id = $_SESSION['txn_id'];
    $payer_id = $_SESSION['payer_id'];
    $payer_name = $_SESSION['payer_name'];
    $payer_firstname = $_GET['first_name'];
    $payer_lastname = $_GET['last_name'];
    $payer_email = $_GET['payer_email'];
    $amount = $_SESSION['amount'];
    $created_at = date('y-m-d h:i:s');

    $item_ids_string = $_GET['item_name'];
    $item_ids_array = explode(',', $item_ids_string);
    $item_ids = array_map('intval', $item_ids_array);

    $status = 0;

    try {
        foreach ($item_ids as $item_id) {
            $sql_update_product = "UPDATE SBIT2J_CART SET STATUS = :prod_status WHERE ID = :prod_id";

            $stmt_update_product = oci_parse($conn, $sql_update_product);

            oci_bind_by_name($stmt_update_product, ':prod_status', $status);
            oci_bind_by_name($stmt_update_product, ':prod_id', $item_id);

            if (oci_execute($stmt_update_product)) {
                echo "ID $item_id updated successfully.<br>";
            } else {
                echo "Error updating ID $item_id.<br>";
            }
        }

        header("Location: account.php");
        exit;
    } catch (Exception $e) {
        echo "Exception: " . $e->getMessage();
    }
}
