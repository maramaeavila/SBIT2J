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


        <?php
        }
        ?>
    </form>

    <?php
    if (isset($_POST['return'])) {

        $username = $_POST['username'];
        $size = $_POST['size'];
        $qty = $_POST['qty'];
        $prod_id = $_POST['prod_id'];

        $update_sql = "";
        switch ($size) {
            case "Small":
                $update_sql = "UPDATE SBIT2J_PRODUCTSTBL SET SMALLQTY = SMALLQTY - $qty WHERE P_ID = '$prod_id'";
                break;
            case "Medium":
                $update_sql = "UPDATE SBIT2J_PRODUCTSTBL SET MEDIUMQTY = MEDIUMQTY - $qty WHERE P_ID = '$prod_id'";
                break;
            case "Large":
                $update_sql = "UPDATE SBIT2J_PRODUCTSTBL SET LARGEQTY = LARGEQTY - $qty WHERE P_ID = '$prod_id'";
                break;
            default:
                break;
        }

        $statement = oci_parse($conn, $update_sql);
        $success = oci_execute($statement);
        if ($success) {
            header("location: index.php");
        } else {
            echo "Error updating product quantities.";
        }


        oci_close($conn);
    }
    ?>

</body>

</html>