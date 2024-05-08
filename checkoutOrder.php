<?php
include "connection.php";
session_start();

$sql = "INSERT INTO orders (name, email, contactnumber, address, city, username, createdat)
            VALUES (:name, :email, :contactnumber, :address, :city, :username, SYSDATE) RETURNING id INTO :id";
$stmt = oci_parse($conn, $sql);
oci_bind_by_name($stmt, ':name', $_POST['name']);
oci_bind_by_name($stmt, ':email', $_POST['email']);
oci_bind_by_name($stmt, ':contactnumber', $_POST['contactnumber']);
oci_bind_by_name($stmt, ':address', $_POST['address']);
oci_bind_by_name($stmt, ':city', $_POST['city']);
oci_bind_by_name($stmt, ':username', $_SESSION['username']);

oci_bind_by_name($stmt, ":id", $id, 32);

$result = oci_execute($stmt);

if ($result) {
    $order_detail_sql = "INSERT INTO order_details (order_id, product_id, quantity)
                                SELECT :order_id, productid, quantity FROM cart 
                                WHERE username = :username";
    $stmt_order_details = oci_parse($conn, $order_detail_sql);
    oci_bind_by_name($stmt_order_details, ':order_id', $id);
    oci_bind_by_name($stmt_order_details, ':username', $_SESSION['username']);

    $result_order_details = oci_execute($stmt_order_details);

    if ($result_order_details) {
        $delete_sql = "DELETE FROM cart WHERE username = :username";
        $stmt_delete = oci_parse($conn, $delete_sql);
        oci_bind_by_name($stmt_delete, ':username', $_SESSION['username']);
        $result_delete = oci_execute($stmt_delete);

        if ($result_delete) {
            $response = array(
                'success' => true,
                'message' => 'Order created'
            );
            echo json_encode($response);
        } else {
            $response = array(
                'success' => false,
                'message' => 'Something went wrong.'
            );
            echo json_encode($response);
        }
    } else {
        $response = array(
            'success' => false,
            'message' => 'Something went wrong.'
        );
        echo json_encode($response);
    }
} else {
    $response = array(
        'success' => false,
        'message' => 'Something went wrong.'
    );
    echo json_encode($response);
}
