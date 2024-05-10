<?php
require_once 'connection.php';
session_start();
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

        header("Location: success.php");
        exit;
    } catch (Exception $e) {
        echo "Exception: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/thankyou.css?=<?php echo time(); ?>">

    <title>THANK YOU</title>
</head>
<style>
    * {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
    }

    .menu__link {
        width: 100px;
        height: 30px;
        cursor: pointer;
    }

    .menu__link:hover {
        background-color: black;
        color: white;
    }


    .formthank {
        height: 900px;
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }

    .complete-text {
        margin-bottom: 10px;
        font-weight: bold;
        font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
    }
</style>

<body>
    <form action="" method="POST" class="formthank">

        <h1 class="complete-text">PURCHASED COMPLETE</h1>
        <input type="submit" name="return" class="menu__link" value="BACK HOME">

        <?php
        $sql = "SELECT * FROM SBIT2J_CART";
        $statement = oci_parse($conn, $sql);
        oci_execute($statement);
        while ($row = oci_fetch_assoc($statement)) {
        ?>
            <input type="hidden" name="username" value="<?php echo $row['USERNAME'] ?>">
            <input type="hidden" name="size" value="<?php echo $row['CART_SIZE'] ?>">
            <input type="hidden" name="qty" value="<?php echo $row['CART_QTY'] ?>">
            <input type="hidden" name="prod_name" value="<?php echo $row['CART_PRODNAME'] ?>">
            <input type="hidden" name="prod_id" value="<?php echo $row['CART_PRODID'] ?>">
            
            <input type="hidden" name="prod_id_array[]" value="<?php echo $row['CART_PRODID']   ?>">
            <input type="hidden" name="prod_name_array[]" value="<?php echo $row['CART_PRODNAME'] ?>">
            <input type="hidden" name="price_array[]" value="<?php echo $row['CART_PRICE'] ?>">
            <input type="hidden" name="size_array[]" value="<?php echo $row['CART_SIZE'] ?>">
            <input type="hidden" name="qty_array[]" value="<?php echo $row['CART_QTY'] ?>">
            <input type="hidden" name="subtotal_array[]" value="<?php echo $row['CART_TOTAL'] ?>">
            <input type="hidden" name="img_array[]" value="<?php echo $row['CART_PRODIMAGE'] ?>">



           <?php 
           ?>
        <?php
        }
        ?>
    </form>

    <?php
        if(isset($_POST['return'])) {
            if(isset($_SESSION['username'])) {
                $username = $_SESSION['username'];
                $orderid = uniqid();
                $sql = "SELECT * FROM SBIT2J_CART WHERE USERNAME = :username";
                $statement = oci_parse($conn, $sql);
                oci_bind_by_name($statement, ":username", $username); 
            
                oci_execute($statement);
            
                $prod_ids = array();
                $prod_names = array();
                $prices = array();
                $sizes = array();
                $qtys = array();
                $totals = array();
                $images = array();
            
                while ($row = oci_fetch_assoc($statement)) {
                    $prod_ids[] = $row['CART_PRODID'];
                    $prod_names[] = $row['CART_PRODNAME'];
                    $prices[] = $row['CART_PRICE'];
                    $sizes[] = $row['CART_SIZE'];
                    $qtys[] = $row['CART_QTY'];
                    $totals[] = $row['CART_TOTAL'];
                    $images[] = $row['CART_PRODIMAGE'];
                }
            
                $prod_ids_str = implode(",", $prod_ids);
                $prod_names_str = implode(",", $prod_names);
                $prices_str = implode(",", $prices);
                $sizes_str = implode(",", $sizes);
                $qtys_str = implode(",", $qtys);
                $totals_str = implode(",", $totals);
                $images_str = implode(",", $images);
            
                $sql_insert = "INSERT INTO SBIT2J_ORDER_BY_USER (ORDER_ID ,USERNAME, EACH_P_ID, EACH_P_NAME, EACH_P_PRICE, EACH_P_SIZE, EACH_P_IQTY, EACH_P_TOTAL, EACH_P_IMG, STATUS) 
                            VALUES (:orderid, :username, :prod_ids, :prod_names, :prices, :sizes, :qtys, :totals, :images, 'Pending')";
                $stmt_insert = oci_parse($conn, $sql_insert);
            
                oci_bind_by_name($stmt_insert, ":orderid", $orderid);

                oci_bind_by_name($stmt_insert, ":username", $username);
                oci_bind_by_name($stmt_insert, ":prod_ids", $prod_ids_str);
                oci_bind_by_name($stmt_insert, ":prod_names", $prod_names_str);
                oci_bind_by_name($stmt_insert, ":prices", $prices_str);
                oci_bind_by_name($stmt_insert, ":sizes", $sizes_str);
                oci_bind_by_name($stmt_insert, ":qtys", $qtys_str);
                oci_bind_by_name($stmt_insert, ":totals", $totals_str);
                oci_bind_by_name($stmt_insert, ":images", $images_str);
            
                oci_execute($stmt_insert);
            
                echo "Data inserted successfully!";
            }
            
            
            // udating the quantity from SBIT2J_PRODUCTSTBL
            foreach ($prod_ids as $index => $prod_id) {
                $qty = $qtys[$index];
                $size = $sizes[$index];
    
                $update_sql = "UPDATE SBIT2J_PRODUCTSTBL 
                               SET ";
    
                switch ($size) {
                    case "Small":
                        $update_sql .= "SMALLQTY = SMALLQTY - :qty ";
                        break;
                    case "Medium":
                        $update_sql .= "MEDIUMQTY = MEDIUMQTY - :qty ";
                        break;
                    case "Large":
                        $update_sql .= "LARGEQTY = LARGEQTY - :qty ";
                        break;
                    default:
                        break;
                }
    
                $update_sql .= "WHERE P_ID = :prod_id";
    
                $statement = oci_parse($conn, $update_sql);
                oci_bind_by_name($statement, ":qty", $qty);
                oci_bind_by_name($statement, ":prod_id", $prod_id);
    
                $success = oci_execute($statement);
    
                if (!$success) {
                    echo "Error updating product quantities.";
                    oci_close($conn);
                    exit;
                }
            }
             // Clear cart items for based the usernmae
            $clear_cart_sql = "DELETE FROM SBIT2J_CART WHERE USERNAME = :username";
            $clear_cart_statement = oci_parse($conn, $clear_cart_sql);
            oci_bind_by_name($clear_cart_statement, ":username", $username);
            $clear_cart_success = oci_execute($clear_cart_statement);

            if (!$clear_cart_success) {
                echo "Error clearing cart items.";
                oci_close($conn);
                exit;
            }


            header("location: index.php");
            oci_close($conn);
        }
    
        
            
  
    ?>

</body>

</html>