<?php
include "connection.php";
session_start();

$sql = "SELECT * 
            FROM orders 
            LEFT JOIN order_details
            ON order_details.order_id = orders.id
            ";
