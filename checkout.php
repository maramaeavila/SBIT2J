<!DOCTYPE html>
<html lang="en">
<?php
session_start();
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>

    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <link rel="stylesheet" href="./css/style.css">

</head>

<body>

    <?php
    include "header.php";
    ?>

    <!-- Checkout -->
    <section id="checkout" class="my-5 py-5">
        <div class="container text-center mt-3 pt-3">
            <h2 class="form-weight-bold">Checkout</h2>
            <hr class="mx-auto">
        </div>
        <div class="mx-auto container">
            <form id="checkout-form">
                <div class="form-group checkout-small-element">
                    <label>Name</label>
                    <input type="text" class="form-control" id="checkout-name" name="name" required>
                </div>
                <div class="form-group checkout-small-element">
                    <label>Email</label>
                    <input type="email" class="form-control" id="checkout-email" name="email" required>
                </div>
                <div class="form-group checkout-small-element">
                    <label>Contact No.</label>
                    <input type="tel" class="form-control" id="checkout-contactno" name="contactno" required>
                </div>
                <div class="form-group checkout-small-element">
                    <label>City</label>
                    <input type="text" class="form-control" id="checkout-city" name="city" required>
                </div>
                <div class="form-group checkout-large-element">
                    <label>Address</label>
                    <input type="text" class="form-control" id="checkout-address" name="address" placeholder="Home Address" required>
                </div>
                <div class="form-group checkout-btn-container">
                    <input type="button" class="btn" id="checkout-btn" value="Checkout" onclick="checkout()">
                </div>
            </form>
        </div>
    </section>

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
    <script>
        $.ajax({
            url: 'getUserDetails.php',
            type: 'GET',
            dataType: 'json',
            success: function(result) {
                if (result.success) {
                    console.log(result.data)
                    document.getElementById('checkout-name').value = result.data.NAME
                    document.getElementById('checkout-email').value = result.data.EMAIL
                    document.getElementById('checkout-contactno').value = result.data.CONTACTNUMBER
                    document.getElementById('checkout-city').value = result.data.CITY
                    document.getElementById('checkout-address').value = result.data.ADDRESS
                }
            }
        });

        function checkout() {
            $.ajax({
                url: 'checkoutOrder.php',
                type: 'POST',
                dataType: 'json',
                data: {
                    name: document.getElementById('checkout-name').value,
                    email: document.getElementById('checkout-email').value,
                    contactnumber: document.getElementById('checkout-contactno').value,
                    city: document.getElementById('checkout-city').value,
                    address: document.getElementById('checkout-address').value
                },
                success: function(result) {
                    if (result.success) {
                        window.location.href = 'account.php'
                    }
                }
            });
        }
    </script>

</body>

</html>