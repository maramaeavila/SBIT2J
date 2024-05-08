<?php

include "connection.php";

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    $sql = "DELETE FROM SBIT2J_CART WHERE Id = :id";
    $statement = oci_parse($conn, $sql);

    oci_bind_by_name($statement, ':id', $id);

    $result = oci_execute($statement);

    if ($result) {
        $response = array(
            'success' => true,
        );
        echo json_encode($response);
    } else {
        $response = array(
            'success' => false,
            'message' => 'Failed to delete item from the cart.',
        );
        echo json_encode($response);
    }
} else {
    $response = array(
        'success' => false,
        'message' => 'ID parameter is missing.',
    );
    echo json_encode($response);
}
