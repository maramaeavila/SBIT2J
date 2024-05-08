<?php

include "connection.php";

$sql = "SELECT * FROM SBIT2J_PRODUCTSTBL WHERE P_ID = :prod_id";
$statement = oci_parse($conn, $sql);

oci_bind_by_name($statement, ':prod_id', $_GET['prod_id']);
$result = oci_execute($statement);

if ($result) {
    $record = oci_fetch_assoc($statement);
    $response = array(
        'success' => true,
        'data' => $record
    );
    echo json_encode($response);
}
