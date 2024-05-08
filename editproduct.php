<?php
include "connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['xproductid'])) {
    $product_id = $_POST['xproductid'];
    $productname = isset($_POST['xproductname']) ? $_POST['xproductname'] : "";
    $catgender = isset($_POST['xcatgender']) ? $_POST['xcatgender'] : "";
    $category = isset($_POST['xcategory']) ? $_POST['xcategory'] : "";
    $size = isset($_POST['xsize']) ? $_POST['xsize'] : "";
    $productprice = isset($_POST['xproductprice']) ? $_POST['xproductprice'] : "";
    $productdescription = isset($_POST['xproductdescription']) ? $_POST['xproductdescription'] : "";

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

    $sql_update_product = "UPDATE SBIT2J_PRODUCTSTBL SET P_NAME = :prod_name, P_CATGENDER = :prod_catgender, P_CATEGORY = :prod_category, P_SIZE = :prod_size, P_PRICE = :prod_price, P_DESCRIPTION = :prod_description, P_IMAGE = :prod_image WHERE P_ID = :prod_id";
    $stmt_update_product = oci_parse($conn, $sql_update_product);
    oci_bind_by_name($stmt_update_product, ':prod_id', $product_id);
    oci_bind_by_name($stmt_update_product, ':prod_name', $productname);
    oci_bind_by_name($stmt_update_product, ':prod_catgender', $catgender);
    oci_bind_by_name($stmt_update_product, ':prod_category', $category);
    oci_bind_by_name($stmt_update_product, ':prod_size', $size);
    oci_bind_by_name($stmt_update_product, ':prod_price', $productprice);
    oci_bind_by_name($stmt_update_product, ':prod_image', $filename);
    oci_bind_by_name($stmt_update_product, ':prod_description', $productdescription);
    oci_execute($stmt_update_product);


    echo '<script>alert("Product updated successfully");</script>';
    header("refresh:0;url=indexadmin.php");
    exit;
}
