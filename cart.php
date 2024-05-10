<!DOCTYPE html>
<html lang="en">
<?php

include "connection.php";
session_start();
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Cart</title>

    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <!-- Slick Carousel CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" />

    <link rel="stylesheet" href="./css/style.css">

</head>

<body>

    <?php
    include "header.php";
    ?>

    <!-- Cart -->
    <section id="cart" class="container my-5 py-5">
        <div class="container text-center mt-5">
            <h2 class="font-weight-bold">My Cart</h2>
            <hr>
        </div>

        <table class="mt-5 pt-5">
            <thead>
                <tr>
                    <th></th>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Size</th>
                    <th>Qty</th>
                    <th>Total</th>
                    <th>Image</th>
                    <!-- <th></th> -->
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT C.*, U.USERNAME, C.STATUS
                FROM SBIT2J_CART C
                INNER JOIN SBIT2J_USERACCOUNT U ON C.USERNAME = U.USERNAME
                WHERE C.STATUS = 1";

                $statement = oci_parse($conn, $sql);
                oci_execute($statement);
                while ($row = oci_fetch_assoc($statement)) {
                    echo "<tr>
                    <td><input type='checkbox' name='selected_products[]' value='{$row['ID']}'></td>
                    <td>{$row['CART_PRODID']}</td>
                    <td>{$row['CART_PRODNAME']}</td>
                    <td>{$row['CART_PRICE']}</td>
                    <td>{$row['CART_SIZE']}</td>
                    <td>{$row['CART_QTY']}</td>
                    <td>{$row['CART_TOTAL']}</td>
                    <td><img src='./uploads/{$row['CART_PRODIMAGE']}' width='100' height='100'></td>
                <!--     <td><button type='button' class='btn btn-dark delete-cart' data-product-id='{$row['ID']}'>DELETE</button></td> -->
                  </tr>";
                }
                ?>
            </tbody>
        </table>

        <div class="cart-total">

        </div>

    </section>

    <section id="checkout" class="my-5 py-5">
        <div class="container text-center mt-3 pt-3">
            <h2 class="form-weight-bold">Checkout Payment</h2>
            <hr class="mx-auto">
        </div>
        <div class="mx-auto container">
            <form method="post" action="https://www.sandbox.paypal.com/cgi-bin/webscr" class="col-md-4 mb-5 mt-5 payment-form">
                <div class="form-group checkout-small-element">
                    <label>Total</label>
                    <input type="hidden" name="business" value="sb-gju3a29373225@business.example.com">
                    <input type="hidden" name="item_name" id="item_name">
                    <input type="hidden" name="amount" id="amount">
                    <input type="hidden" name="currency_code" value="PHP">
                    <input type="hidden" name="no_shipping" value="1">
                    <input type="hidden" name="cmd" value="_xclick">
                    <input type="hidden" name="return" value="http://localhost/SBIT2J/success.php">
                    <input type="hidden" name="cancel_return" value="http://localhost/SBIT2J/cart.php">
                    <input type="text" class="form-control" id="checkout-total" name="total" value="" readonly>
                </div>
                <div>
                    <label>Payment Method</label>
                    <select class="form-select" name="xsize" id="xsize" aria-label="Default select example">
                        <option value="Paypal" selected>Paypal</option>
                        <!-- <option value="GCash">GCash</option>
                        <option value="Paymaya">Paymaya</option> -->
                    </select>
                </div>
                <div class="form-group checkout-btn-container">
                    <input type="submit" id="donateBtn" class="btn btn-dark" value="Checkout">
                </div>
            </form>

        </div>
    </section>

    <!-- Modal for GCash, and Paymaya -->

    <!-- <div class="modal fade" id="gcashModal" tabindex="-1" aria-labelledby="gcashModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="gcashModalLabel">Pay with GCash</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" name="xproductid" id="xproductid" class="form-control">
                        <label> Reference No. </label>
                        <input type="text" name="xproductname" id="xproductname" class="form-control" placeholder="Enter Reference No.">
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="xproductid" id="xproductid" class="form-control">
                        <label> Name </label>
                        <input type="text" name="xproductname" id="xproductname" class="form-control" placeholder="Enter Name">
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="xproductid" id="xproductid" class="form-control">
                        <label> Contact No. </label>
                        <input type="tel" name="xproductname" id="xproductname" class="form-control" placeholder="Enter Contact No.">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="paybtn" class="btn btn-dark">Paid</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="paymayaModal" tabindex="-1" aria-labelledby="paymayaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="paymayaModalLabel">Pay with Paymaya</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" name="xproductid" id="xproductid" class="form-control">
                        <label> Reference No. </label>
                        <input type="text" name="xproductname" id="xproductname" class="form-control" placeholder="Enter Reference No.">
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="xproductid" id="xproductid" class="form-control">
                        <label> Name </label>
                        <input type="text" name="xproductname" id="xproductname" class="form-control" placeholder="Enter Name">
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="xproductid" id="xproductid" class="form-control">
                        <label> Contact No. </label>
                        <input type="tel" name="xproductname" id="xproductname" class="form-control" placeholder="Enter Contact No.">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="paybtn" class="btn btn-dark">Paid</button>
                </div>
            </div>
        </div>
    </div> -->

    <!-- Banner -->
    <section id="banner">
        <div class="container">
            <h4 class="text-center">Shop the Latest Trends in Renz and Co!</h4>
            <h1 class="text-center">"Explore our Stylish Collection Today."</h1>
        </div>

    </section>

    <?php
    include "footercontactus.php";
    ?>


    <!-- Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>

    <script>
        $('#categories .box-area').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 1000,
            responsive: [{
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1
                    }
                }
            ]
        });

        $('#prodSlider').slick({
            slidesToShow: 4,
            slidesToScroll: 1,
            autoplay: false,
            responsive: [{
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1
                    }
                }
            ]
        });


        $('#xsize').change(function() {
            var selectedPayment = $(this).val();
            if (selectedPayment === 'Paypal') {
                $('#paypalModal').modal('show');
            } else if (selectedPayment === 'GCash') {
                $('#gcashModal').modal('show');
            } else if (selectedPayment === 'Paymaya') {
                $('#paymayaModal').modal('show');
            }
        });

        function removeCartItem(id) {
            $.ajax({
                url: 'removeCartItem.php',
                method: 'POST',
                data: {
                    id: id
                },
                success: function(response) {
                    console.log(response);
                    window.location.reload();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }

        function attachDeleteListener() {
            var removeButtons = document.querySelectorAll('.delete-cart');
            removeButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    var cartId = button.getAttribute('data-product-id');
                    removeCartItem(cartId);
                });
            });
        }

        function updateCartItem(id, quantity, price) {
            $.ajax({
                url: 'updateCartItem.php',
                method: 'POST',
                dataType: 'json',
                data: {
                    id: id,
                    quantity: quantity,
                    total: quantity * price
                },
                success: function(result) {
                    console.log(result);
                    if (result.success) {
                        window.location.reload();
                    }
                }
            });
        }

        function attachChangeAmountListener() {
            var cartInputs = document.querySelectorAll('#cart-quantity');
            console.log(cartInputs);
            cartInputs.forEach(function(input) {
                input.addEventListener('change', function(e) {
                    var quantity = e.target.value;
                    var cart_id = input.getAttribute('data-record-id');
                    var price = input.getAttribute('data-record-price');
                    updateCartItem(cart_id, quantity, price);
                });
            });
        }

        $(document).ready(function() {
            updateTotal();

            $('#select-all-btn').click(function() {
                updateTotal();
            });

            $('input[name="selected_products[]"]').change(function() {
                updateTotal();
            });

            function updateTotal() {
                var total = 0;
                var selectedProducts = [];
                $('input[name="selected_products[]"]:checked').each(function() {
                    var totalText = $(this).closest('tr').find('td:nth-child(7)').text().trim();
                    var rowTotal = parseFloat(totalText.replace('₱', '').trim());
                    if (!isNaN(rowTotal)) {
                        total += rowTotal;
                    } else {
                        console.error('Error: Unable to parse total:', totalText);
                    }
                    selectedProducts.push($(this).val());
                });
                $('#checkout-total').val('₱ ' + total);
                $('#checkout-totalsecond').val(total);
                $('#amount').val(total);
                $('#item_name').val(selectedProducts.join(', '));
                console.log(selectedProducts);
            }
        });
    </script>
</body>

</html>