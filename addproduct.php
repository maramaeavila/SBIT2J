<?php
include "connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $productname = isset($_POST['productname']) ? $_POST['productname'] : "";
    $catgender = isset($_POST['catgender']) ? $_POST['catgender'] : "";
    $category = isset($_POST['category']) ? $_POST['category'] : "";
    $size = isset($_POST['size']) ? $_POST['size'] : "";
    $productprice = isset($_POST['productprice']) ? $_POST['productprice'] : "";
    $productdescription = isset($_POST['productdescription']) ? $_POST['productdescription'] : "";

    if (isset($_FILES["xproductimage"]) && $_FILES["xproductimage"]["error"] == 0) {
        $targetDirectory = "../imgs/products";
        $targetFile = $targetDirectory . basename($_FILES["xproductimage"]["name"]);
        $filename = $_FILES["xproductimage"]["name"];
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $check = getimagesize($_FILES["xproductimage"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        if ($_FILES["productimage"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        if (
            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif"
        ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["productimage"]["tmp_name"], $targetFile)) {
                echo "The file " . htmlspecialchars(basename($_FILES["productimage"]["name"])) . " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        echo "No file uploaded.";
    }

    $sql_max_product_id = "SELECT MAX(P_ID) AS MAX_ID FROM SBIT2J_PRODUCTSTBL";
    $stmt_max_product_id = oci_parse($conn, $sql_max_product_id);
    oci_execute($stmt_max_product_id);
    $max_id_row = oci_fetch_assoc($stmt_max_product_id);

    if ($max_id_row['MAX_ID'] !== null) {

        $next_product_id = $max_id_row['MAX_ID'] + 1;
    } else {
        $next_product_id = 1001;
    }

    $productqty = 0;

    $sql_insert_product = "INSERT INTO SBIT2J_PRODUCTSTBL (P_ID, P_NAME, P_CATGENDER, P_CATEGORY, P_PRICE, P_SIZE, P_IMAGE, P_DESCRIPTION, SMALLQTY, MEDIUMQTY, LARGEQTY) 
                           VALUES (:prod_id, :prod_name, :prod_catgender, :prod_category, :prod_price, :prod_size, :prod_image, :prod_description, :smallqty, :mediumqty, :largeqty)";
    $stmt_insert_product = oci_parse($conn, $sql_insert_product);
    oci_bind_by_name($stmt_insert_product, ':prod_id', $next_product_id);
    oci_bind_by_name($stmt_insert_product, ':prod_name', $productname);
    oci_bind_by_name($stmt_insert_product, ':prod_catgender', $catgender);
    oci_bind_by_name($stmt_insert_product, ':prod_category', $category);
    oci_bind_by_name($stmt_insert_product, ':prod_price', $productprice);
    oci_bind_by_name($stmt_insert_product, ':prod_size', $size);
    oci_bind_by_name($stmt_insert_product, ':prod_image', $filename);
    oci_bind_by_name($stmt_insert_product, ':prod_description', $productdescription);
    oci_bind_by_name($stmt_insert_product, ':smallqty', $productqty);
    oci_bind_by_name($stmt_insert_product, ':mediumqty', $productqty);
    oci_bind_by_name($stmt_insert_product, ':largeqty', $productqty);

    oci_execute($stmt_insert_product);

    echo '<script>alert("Product added successfully");</script>';
    header("refresh:0;url=indexadmin.php");
    exit;
}
