<?php
include "connection.php";

if (isset($_POST['addProduct'])) {


<<<<<<< HEAD
    $productname =  $_POST['productname'];
    $catgender = $_POST['catgender'];
    $category =  $_POST['category'];
    $size =  $_POST['size'];
    $productprice =  $_POST['productprice'];
    $productdescription =  $_POST['productdescription'];
    $prod_image = $_POST['productimage'];


    $sql_max_product_id = "SELECT MAX(P_ID) AS MAX_ID FROM SBIT2J_PRODUCTSTBL";
    $stmt_max_product_id = oci_parse($conn, $sql_max_product_id);
    oci_execute($stmt_max_product_id);
    $max_id_row = oci_fetch_assoc($stmt_max_product_id);

    if ($max_id_row['MAX_ID'] !== null) {

        $next_product_id = $max_id_row['MAX_ID'] + 1;
    } else {
        $next_product_id = 1001;
    }

    $sql = "INSERT INTO SBIT2J_PRODUCTSTBL (P_ID, P_NAME, P_CATGENDER, P_CATEGORY, P_PRICE, P_SIZE, P_IMAGE, P_DESCRIPTION, SMALLQTY, MEDIUMQTY, LARGEQTY) 
        VALUES (:prod_id, :prod_name, :prod_catgender, :prod_category, :prod_price, :prod_size, :prod_image, :prod_description, 0, 0, 0)";

    $stmt_insert_product = oci_parse($conn, $sql);

    oci_bind_by_name($stmt_insert_product, ':prod_id', $next_product_id);
    oci_bind_by_name($stmt_insert_product, ':prod_name', $productname);
    oci_bind_by_name($stmt_insert_product, ':prod_catgender', $catgender);
    oci_bind_by_name($stmt_insert_product, ':prod_category', $category);
    oci_bind_by_name($stmt_insert_product, ':prod_price', $productprice);
    oci_bind_by_name($stmt_insert_product, ':prod_size', $size);
    oci_bind_by_name($stmt_insert_product, ':prod_image', $prod_image);
    oci_bind_by_name($stmt_insert_product, ':prod_description', $productdescription);

    oci_execute($stmt_insert_product);

    header("location: indexadmin.php?error=successAddproduct");
=======
        $productname =  $_POST['productname'] ;
        $catgender = $_POST['catgender'] ;
        $category =  $_POST['category'] ;
        $size =  $_POST['size'] ;
        $productprice =  $_POST['productprice'] ;
        $productdescription =  $_POST['productdescription'];
        $prod_image = $_POST['productimage'];


        $sql_max_product_id = "SELECT MAX(P_ID) AS MAX_ID FROM SBIT2J_PRODUCTSTBL";
        $stmt_max_product_id = oci_parse($conn, $sql_max_product_id);
        oci_execute($stmt_max_product_id);
        $max_id_row = oci_fetch_assoc($stmt_max_product_id);

        if ($max_id_row['MAX_ID'] !== null) {

            $next_product_id = $max_id_row['MAX_ID'] + 1;
        } else {
            $next_product_id = 1001;
        }

        $sql = "INSERT INTO SBIT2J_PRODUCTSTBL (P_ID, P_NAME, P_CATGENDER, P_CATEGORY, P_PRICE, P_SIZE, P_IMAGE, P_DESCRIPTION, SMALLQTY, MEDIUMQTY, LARGEQTY) 
        VALUES (:prod_id, :prod_name, :prod_catgender, :prod_category, :prod_price, :prod_size, :prod_image, :prod_description, 0, 0, 0)";
        
        $stmt_insert_product = oci_parse($conn, $sql);

        oci_bind_by_name($stmt_insert_product, ':prod_id', $next_product_id);
        oci_bind_by_name($stmt_insert_product, ':prod_name', $productname);
        oci_bind_by_name($stmt_insert_product, ':prod_catgender', $catgender);
        oci_bind_by_name($stmt_insert_product, ':prod_category', $category);
        oci_bind_by_name($stmt_insert_product, ':prod_price', $productprice);
        oci_bind_by_name($stmt_insert_product, ':prod_size', $size);
        oci_bind_by_name($stmt_insert_product, ':prod_image', $prod_image);
        oci_bind_by_name($stmt_insert_product, ':prod_description', $productdescription);
   
        oci_execute($stmt_insert_product);

        header("location: indexadmin.php?error=successAddproduct");

>>>>>>> b55041397144f244cc4faf012827ad5ac7a67d4c
}
