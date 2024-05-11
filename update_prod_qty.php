<?php
include "connection.php";

if(isset($_POST['updateqty'])) {
    foreach($_POST['prodID'] as $prodID) {
        if(isset($_POST['smallqty'][$prodID]) && isset($_POST['mediumqty'][$prodID]) && isset($_POST['largeqty'][$prodID])) {
            $smallQtyToAdd = $_POST['smallqty'][$prodID];
            $mediumQtyToAdd = $_POST['mediumqty'][$prodID];
            $largeQtyToAdd = $_POST['largeqty'][$prodID];

            $sql = "UPDATE SBIT2J_PRODUCTSTBL SET SMALLQTY = SMALLQTY + :smallqty, MEDIUMQTY = MEDIUMQTY + :mediumqty, LARGEQTY = LARGEQTY + :largeqty WHERE P_ID = :prodID";
            $statement = oci_parse($conn, $sql);
            oci_bind_by_name($statement, ':smallqty', $smallQtyToAdd);
            oci_bind_by_name($statement, ':mediumqty', $mediumQtyToAdd);
            oci_bind_by_name($statement, ':largeqty', $largeQtyToAdd);
            oci_bind_by_name($statement, ':prodID', $prodID);
            
           oci_execute($statement);
           
            
        }
        
    }
    header("Location: indexadmin.php?error=successUpdate");
    exit();
    
}


if (isset($_POST['Update'])){
    $status = $_POST['status'];
    $orderID = $_POST['orderid'];

    $sql = "UPDATE SBIT2J_ORDER_BY_USER SET STATUS = :status WHERE ORDER_ID = :orderid";

    $stmt = oci_parse($conn, $sql);
    oci_bind_by_name($stmt, ':status', $status);
    oci_bind_by_name($stmt, ':orderid', $orderID);

    $result = oci_execute($stmt);

    if($result) {
        header("location: indexadmin.php?error=successUpdateStatus");
    } else {
        echo "<script> alert('Update failed');</script>";
    }
}
