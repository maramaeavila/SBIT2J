<!DOCTYPE html>
<html lang="en">

<?php
session_start();

include "connection.php";

if (!isset($_GET['error'])) {
    echo "";
} else {
    if ($_GET['error'] == "successUpdate") {
        echo "<script> alert('Quantities updated successfully! '); </script>";
    } elseif ($_GET['error'] == "successUpdateStatus") {
        echo "<script> alert('Success Updating Status successfully! '); </script>";
    } elseif ($_GET['error'] == "successAddproduct") {
        echo "<script> alert('Success Adding products'); </script>";
    }
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />

    <style>
        #adminnav .nav-pills li a:hover {
            background-color: white;
            color: #252925 !important;
        }

        section {
            display: none;
        }

        #contentArea {
            height: 100%;
            width: 150vh;
            margin-top: 10% !important;
            margin-left: 2% !important;
        }

        #contentArea th {
            background-color: #252925;
            color: white;
        }

        #contentArea td img {
            width: 100px;
            height: 100px;
        }
    </style>
</head>

<body>
    <div id="adminnav" class="container-fluid">
        <div class="row flex-nowrap">
            <div class="bg-dark col-auto col-md-4 col-lg-2 min-vh-100 d-flex flex-column justify-content-between">
                <div class="bg-dark p-2">
                    <div class="mt-5">
                        <img src="./imgs/logo.png"><br>
                    </div>
                    <ul class="nav nav-pills flex-column mt-5">
                        <li class="nav-item py-2 py-sm-0">
                            <a href="#product_update" class="nav-link text-white">
                                <i class="fa-solid fa-pen-to-square"></i><span class="fs-4 ms-3 d-none d-sm-inline">Product Update</span>
                            </a>
                        </li>
                        <li class="nav-item py-2 py-sm-0">
                            <a href="#orders_update" class="nav-link text-white">
                                <i class="fa-solid fa-boxes-packing"></i><span class="fs-4 ms-3 d-none d-sm-inline">Orders List</span>
                            </a>
                        </li>
                        <li class="nav-item py-2 py-sm-0">
                            <a href="#inventory" class="nav-link text-white">
                                <i class="fa-solid fa-boxes-stacked"></i><span class="fs-4 ms-3 d-none d-sm-inline">Add Stock</span>
                            </a>
                        </li>
                        <li class="nav-item py-2 py-sm-0">
                            <a href="#customers" class="nav-link text-white">
                                <i class="fa-solid fa-users"></i><span class="fs-4 ms-3 d-none d-sm-inline">Customers Info</span>
                            </a>
                        </li>

                        <li class="nav-item py-2 py-sm-0">
                            <a href="#pending_order" class="nav-link text-white">
                                <i class="fa-solid fa-bag-shopping"></i></i><span class="fs-4 ms-3 d-none d-sm-inline">Pending Orders</span>
                            </a>
                        </li>

                        <li class="nav-item py-2 py-sm-0">
                            <a href="#complete_order" class="nav-link text-white">
                                <i class="fa-solid fa-peso-sign"></i> <span class="fs-4 ms-3 d-none d-sm-inline"></i>Complete Orders</span>
                            </a>
                        </li>


                    </ul>
                </div>
                <div class="p-5">
                    <a href="logout.php" class="text-white">
                        <i class="fa-solid fa-right-from-bracket"></i><span class="fs-4 ms-3 d-none d-sm-inline">Logout</span>
                    </a>
                </div>
            </div>

            <!-- Content area -->
            <div class="p-3" id="contentArea">
                <section id="product_update">
                    <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#exampleModal">ADD PRODUCT</button>
                    <div style="max-height: 500px; overflow-y: auto;">
                        <table class="table table-hover table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Product ID</th>
                                    <th>Product Name</th>
                                    <th>Category</th>
                                    <th>Product Category</th>
                                    <th>Size</th>
                                    <th>Price</th>
                                    <th>Image</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT * FROM SBIT2J_PRODUCTSTBL";

                                $statement = oci_parse($conn, $sql);
                                oci_execute($statement);
                                $rowCount = 0;
                                while ($row = oci_fetch_assoc($statement)) {
                                    echo "<tr>
                                        <td width='10%'>{$row['P_ID']}</td>
                                        <td>{$row['P_NAME']}</td>
                                        <td>{$row['P_CATGENDER']}</td>
                                        <td>{$row['P_CATEGORY']}</td>
                                        <td>{$row['P_SIZE']}</td>
                                        <td>{$row['P_PRICE']}</td>
                                        <td><img src='./uploads/{$row['P_IMAGE']}' width='100' height='100'></td>
                                        <td>{$row['P_DESCRIPTION']}</td>
                                        <td width='10%'>
                                            <button type='button' class='btn btn-secondary edit-btn' data-product-id='{$row['P_ID']}' data-toggle='modal' data-target='#editproduct'>Edit</button>
                                        </td>
                                    </tr>";
                                    $rowCount++;
                                }
                                ?>
                            </tbody>
                            <?php if ($rowCount > 6) : ?>

                            <?php endif; ?>
                        </table>
                    </div>
                </section>

                <section id="orders_update">
                    <table class="table table-hover table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Username</th>
                                <th>Product Name</th>
                                <th>Product Price</th>
                                <th>Total</th>

                            </tr>
                        </thead>
                        <tbody>
                        <form action="" method="POST">
                                <?php
                                $username = $_SESSION['username'];
                                $sql = "SELECT * FROM SBIT2J_ORDER_BY_USER ";
                                $statement = oci_parse($conn, $sql);
                                oci_execute($statement);
                                $totalPrice = 0;
                                while ($row = oci_fetch_assoc($statement)) {

                                    $arrayPrice = explode(',', $row['EACH_P_TOTAL']);
                                    $subtotal = 0.0;
                                    foreach ($arrayPrice as $price) {
                                        $price = trim($price);
                                        $subtotal += floatval($price);
                                        $totalPrice += floatval($price);
                                    }
                                    $array3 = array();

                                    $prodNames = explode(',', $row['EACH_P_NAME']);
                                    $prodQuan = explode(',', $row['EACH_P_IQTY']);

                                    if (count($prodNames) == count($prodQuan)) {
                                        for ($i = 0; $i < count($prodNames); $i++) {
                                            $array3[] = $prodNames[$i] . "(" . $prodQuan[$i] . ")";
                                        }
                                    }
                                ?>
                                    <tr>
                                        <td><?php echo $row['ORDER_ID'] ?></td>
                                        <td><?php echo $row['USERNAME'] ?></td>
                                        <td><?php echo implode(", ", $array3); ?></td>
                                        <td>
                                            <?php
                                            foreach ($arrayPrice as $price) {
                                                echo "₱" . $price . "<br>";
                                            }
                                            ?>
                                        </td>
                                        <td><strong>Total: ₱<?php echo number_format($subtotal, 2); ?></strong></td>

                                    </tr>

                                <?php
                                }
                                ?>
                            </form>
                        </tbody>
                    </table>
                </section>

                <section id="inventory">
                    <div>
                        <input class="form-control me-2" type="search" id="searchInput" style="width: 20%; margin:5px" placeholder="Search" aria-label="Search">
                    </div>
                    <form action="update_prod_qty.php" method="POST">
                        <div style="max-height: 500px; overflow-y: auto;">
                            <table class="table table-hover table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Product ID</th>
                                        <th>Product Name</th>
                                        <th>Category</th>
                                        <th>Product Category</th>
                                        <th>Price</th>
                                        <th>Image</th>
                                        <th>Description</th>
                                        <th>Small Qty</th>
                                        <th>Medium Qty</th>
                                        <th>Large Qty</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="inventoryTableBody">
                                    <?php
                                    $sql = "SELECT * FROM SBIT2J_PRODUCTSTBL";
                                    $statement = oci_parse($conn, $sql);
                                    oci_execute($statement);
                                    while ($row = oci_fetch_assoc($statement)) {
                                    ?>
                                        <tr class="inventoryRow">
                                            <td width='10%'><a href='#' class='add-product' data-product-id='<?php echo $row['P_ID'] ?>' data-bs-toggle='modal' data-bs-target='#addProductModal'><?php echo $row['P_ID'] ?></a></td>
                                            <td><?php echo $row['P_NAME'] ?></td>
                                            <td><?php echo $row['P_CATGENDER'] ?></td>
                                            <td><?php echo $row['P_CATEGORY'] ?></td>
                                            <td>₱ <?php echo $row['P_PRICE'] ?></td>
                                            <td><img src='./uploads/<?php echo $row['P_IMAGE'] ?>' width='100' height='100'></td>
                                            <td><?php echo $row['P_DESCRIPTION'] ?></td>
                                            <td><?php echo $row['SMALLQTY'] ?>: <input type="number" min="0" value="0" style="width:50px" name="smallqty[<?php echo $row['P_ID'] ?>]"></td>
                                            <td><?php echo $row['MEDIUMQTY'] ?> : <input type="number" min="0" value="0" style="width:50px" name="mediumqty[<?php echo $row['P_ID'] ?>]"></td>
                                            <td><?php echo $row['LARGEQTY'] ?>: <input type="number" min="0" value="0" style="width:50px" name="largeqty[<?php echo $row['P_ID'] ?>]"></td>
                                            <input type="hidden" name="prodID[]" value="<?php echo $row['P_ID'] ?>">
                                            <td><input type="submit" class="btn btn-dark" name="updateqty" value="ADD"></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </form>
                </section>

                <section id="customers">
                    <table class="table table-hover table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Contact No.</th>
                                <th>Address</th>
                                <th>City</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM SBIT2J_USERACCOUNT";
                            $statement = oci_parse($conn, $sql);
                            oci_execute($statement);
                            while ($row = oci_fetch_assoc($statement)) {
                                echo "<tr>
                                <td>{$row['USERNAME']}</td>
                                <td>{$row['NAME']}</td>
                                <td>";

                                if ($row['USERTYPE'] == 1) {
                                    echo 'Customer';
                                } elseif ($row['USERTYPE'] == 2) {
                                    echo 'Admin';
                                } else {
                                    echo 'Unknown';
                                }

                                echo "</td>
                                <td>{$row['EMAIL']}</td>
                                <td>{$row['ADDRESS']}</td>
                                <td>{$row['CITY']}</td>
                                </tr>";
                            } ?>
                        </tbody>
                    </table>
                </section>

                <section id="pending_order">
                    <table class="table table-hover table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Username</th>
                                <th>Product Name</th>
                                <th>Product Price</th>
                                <th>Status</th>
                                <th></th>

                            </tr>
                        </thead>
                        <tbody>
                            <form action="update_prod_qty.php" method="POST">
                                <?php
                                $sql = "SELECT * FROM SBIT2J_ORDER_BY_USER WHERE STATUS = 'Pending'";
                                $statement = oci_parse($conn, $sql);
                                oci_execute($statement);
                                $totalPrice = 0;
                                while ($row = oci_fetch_assoc($statement)) {

                                    $arrayPrice = explode(',', $row['EACH_P_TOTAL']);
                                    $subtotal = 0.0;
                                    foreach ($arrayPrice as $price) {
                                        $price = trim($price);
                                        $subtotal += floatval($price);
                                        $totalPrice += floatval($price);
                                    }
                                    $array3 = array();

                                    $prodNames = explode(',', $row['EACH_P_NAME']);
                                    $prodQuan = explode(',', $row['EACH_P_IQTY']);

                                    if (count($prodNames) == count($prodQuan)) {
                                        for ($i = 0; $i < count($prodNames); $i++) {
                                            $array3[] = $prodNames[$i] . "(" . $prodQuan[$i] .  ")";
                                        }
                                    }
                                ?>
                                    <tr>
                                        <td><?php echo $row['ORDER_ID'] ?></td>
                                        <td><?php echo $row['USERNAME'] ?></td>
                                        <td><?php echo implode(", ", $array3); ?></td>
                                        <td>
                                            <?php
                                            foreach ($arrayPrice as $price) {
                                                echo "₱" . $price . "<br>";
                                            }
                                            ?>
                                            <strong>Total: ₱<?php echo number_format($subtotal, 2); ?></strong>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <select name="status">
                                                    <option value="Pending">Pending</option>
                                                    <option value="Complete">Complete</option>
                                                </select>
                                            </div>
                                        </td>
                                        <td><input class="order-user-btn" type="submit" value="UpdateStatus" name="Update"></td>
                                        <input type="hidden" name="orderid" value="<?php echo $row['ORDER_ID']; ?>">
                                    </tr>

                                <?php
                                }
                                ?>
                            </form>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="1"></td>
                                <td colspan="2" style="text-align: right;"><strong>Pending Total:</strong></td>
                                <td><strong>₱<?php echo number_format($totalPrice, 2); ?></strong></td>
                            </tr>
                        </tfoot>
                    </table>
                </section>


                <section id="complete_order">
                    <table class="table table-hover table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Username</th>
                                <th>Product Name</th>
                                <th>Total</th>
                                <th>Status</th>

                            </tr>
                        </thead>
                        <tbody>
                            <form action="" method="POST">
                                <?php
                                $username = $_SESSION['username'];
                                $sql = "SELECT * FROM SBIT2J_ORDER_BY_USER WHERE STATUS = 'Complete'";
                                $statement = oci_parse($conn, $sql);
                                oci_execute($statement);
                                $totalPrice = 0;
                                while ($row = oci_fetch_assoc($statement)) {

                                    $arrayPrice = explode(',', $row['EACH_P_TOTAL']);
                                    $subtotal = 0.0;
                                    foreach ($arrayPrice as $price) {
                                        $price = trim($price);
                                        $subtotal += floatval($price);
                                        $totalPrice += floatval($price);
                                    }
                                    $array3 = array();

                                    $prodNames = explode(',', $row['EACH_P_NAME']);
                                    $prodQuan = explode(',', $row['EACH_P_IQTY']);

                                    if (count($prodNames) == count($prodQuan)) {
                                        for ($i = 0; $i < count($prodNames); $i++) {
                                            $array3[] = $prodNames[$i] . "(" . $prodQuan[$i] . ")";
                                        }
                                    }
                                ?>
                                    <tr>
                                        <td><?php echo $row['ORDER_ID'] ?></td>
                                        <td><?php echo $row['USERNAME'] ?></td>
                                        <td><?php echo implode(", ", $array3); ?></td>
                                        <td>
                                            <?php
                                            foreach ($arrayPrice as $price) {
                                                echo "₱" . $price . "<br>";
                                            }
                                            ?>
                                            <strong>Total: ₱<?php echo number_format($subtotal, 2); ?></strong>
                                        </td>
                                        <td><?php echo $row['STATUS'] ?></td>

                                    </tr>

                                <?php
                                }
                                ?>
                            </form>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="1"></td>
                                <td colspan="2" style="text-align: right;"><strong>Total Gross:</strong></td>
                                <td><strong>₱<?php echo number_format($totalPrice, 2); ?></strong></td>
                            </tr>
                        </tfoot>
                    </table>
                </section>
            </div>
        </div>
    </div>


    <!-- Modal -->


    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Update Product</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="addproduct.php" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label> Product ID </label>
                            <input type="text" name="productid" class="form-control" value="<?php echo isset($product_id) ? $product_id : ''; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label> Product </label>
                            <input type="text" name="productname" class="form-control" placeholder="Enter Product Name" required>
                        </div>
                        <div class="form-group">
                            <label>Cat Gender</label>
                            <select class="form-select" name="catgender" aria-label="Default select example" required>
                                <option value="Men" selected>Men</option>
                                <option value="Women">Women</option>
                                <option value="Kids">Kids</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Category</label>
                            <select class="form-select" name="category" aria-label="Default select example" required>
                                <option value="T-Shirt" selected>T-Shirt</option>
                                <option value="Jeans">Jeans</option>
                                <option value="Jackets">Jackets</option>
                                <option value="Sweatpants">Sweatpants</option>
                                <option value="Dress">Dress</option>
                                <option value="Undergarments">Undergarments</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Size</label>
                            <select class="form-select" name="size" aria-label="Default select example" required>
                                <option value="Small" selected>Small</option>
                                <option value="Medium">Medium</option>
                                <option value="Large">Large</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label> Price </label>
                            <input type="number" name="productprice" class="form-control" placeholder="Enter Product Price" required>
                        </div>
                        <div class="form-group">
                            <label> Description </label>
                            <textarea name="productdescription" class="form-control" placeholder="Enter Product Description" required></textarea>
                        </div>
                        <div class="form-group">
                            <label> Image </label>
                            <input type="file" name="productimage" class="form-control" accept=".jpg, .png, .jpeg" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="addProduct" class="btn btn-dark">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade" id="editproduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Update Product</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="editproduct.php" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" name="xproductid" id="xproductid" class="form-control">
                            <label> Product </label>
                            <input type="text" name="xproductname" id="xproductname" class="form-control" placeholder="Enter Product Name">
                        </div>
                        <div class="form-group">
                            <label>Cat Gender</label>
                            <select class="form-select" name="xcatgender" id="xcatgender" aria-label="Default select example">
                                <option value="Men" selected>Men</option>
                                <option value="Women">Women</option>
                                <option value="Kids">Kids</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Category</label>
                            <select class="form-select" name="xcategory" id="xcategory" aria-label="Default select example">
                                <option value="T-Shirt" selected>T-Shirt</option>
                                <option value="Jeans">Jeans</option>
                                <option value="Jackets">Jackets</option>
                                <option value="Sweatpants">Sweatpants</option>
                                <option value="Dress">Dress</option>
                                <option value="Undergarments">Undergarments</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Size</label>
                            <select class="form-select" name="xsize" id="xsize" aria-label="Default select example">
                                <option value="Small" selected>Small</option>
                                <option value="Medium">Medium</option>
                                <option value="Large">Large</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label> Price </label>
                            <input type="text" name="xproductprice" id="xproductprice" class="form-control" placeholder="Enter Product Price">
                        </div>
                        <div class="form-group">
                            <label> Description </label>
                            <textarea name="xproductdescription" id="xproductdescription" class="form-control" placeholder="Enter Product Description"></textarea>
                        </div>
                        <div class="form-group">
                            <label> Image </label>
                            <input type="file" name="xproductimage" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="registerbtn" class="btn btn-dark">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteproduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Product</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="deleteproduct.php" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" name="xproductidx" id="xproductidx" class="form-control">
                            <label>Are you sure you want to delete this product?<span id="productName"></span></label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="registerbtn" class="btn btn-dark">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.edit-btn').click(function() {
                var prod_id = $(this).data('product-id');

                $.ajax({
                    url: 'fetch_product.php',
                    type: 'POST',
                    data: {
                        prod_id: prod_id
                    },
                    dataType: 'json',
                    success: function(response) {
                        $('#xproductid').val(response.P_ID);
                        $('#xproductname').val(response.P_NAME);
                        $('#xcatgender').val(response.P_CATGENDER);
                        $('#xcategory').val(response.P_CATEGORY);
                        $('#xsize').val(response.P_SIZE);
                        $('#xproductprice').val(response.P_PRICE);
                        $('#xproductdescription').val(response.P_DESCRIPTION);
                        $('#xproductidx').val(response.P_ID);
                        $('#productName').text(response.P_NAME);

                        $('#xproductimage').attr('src', response.P_IMAGE);

                        $('#editproduct').modal('show');
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                        alert('Failed to fetch product details. Please try again.');
                    }
                });
            });
        });

        $(document).ready(function() {
            $('#searchInput').on('keyup', function() {
                var value = $(this).val().toLowerCase();
                $('.inventoryRow').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });

        $('.delete-btn').click(function() {
            var prod_id = $(this).data('product-id');

            if (confirm('Are you sure you want to delete this product?')) {
                $.ajax({
                    url: 'deleteproduct.php',
                    type: 'POST',
                    data: {
                        prod_id: prod_id
                    },
                    success: function(response) {
                        alert('Product deleted successfully');
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                        alert('Failed to delete product. Please try again.');
                    }
                });
            }
        });


        $(document).ready(function() {
            $('#searchInput').on('keyup', function() {
                var searchText = $(this).val().toLowerCase();
                $('#inventoryTableBody tr').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(searchText) > -1);
                });
            });
        });

        const navLinks = document.querySelectorAll('#adminnav .nav-link');

        navLinks.forEach(link => {
            link.addEventListener('click', function(event) {
                event.preventDefault();
                const sectionId = this.getAttribute('href').substring(1);
                const targetSection = document.getElementById(sectionId);
                if (targetSection) {
                    document.querySelectorAll('#contentArea section').forEach(section => {
                        section.style.display = 'none';
                    });
                    targetSection.style.display = 'block';
                }
            });
        });
    </script>

</body>

</html>