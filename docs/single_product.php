<!DOCTYPE html>
<html lang="en">
<?php
session_start();
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Single Product</title>

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

    <!-- navbar -->
    <?php
    include "header.php";
    ?>

    <!-- Single Product -->
    <section id="single-product" class="container my-5 pt-5">
        <div class="row mt-5">
            <div class="col-lg-5 col-md-6 col-sm-12">
                <img class="img-fluid w-100 pb-1" src="./imgs/products/itemld1.png" id="mainImg">
            </div>

            <div class="col-lg-6 col-md-12 col-12 pt-5">
                <h3 class="py-4" id="product-name">Men's Fashion</h3>
                <h2 id="product-price">₱ 800</h2>
                <h2 id="product-priceoriginal" style="display:none;"></h2>
                <h2 id="product-image" style="display:none;"></h2>
                <h6>Quantity</h6>
                <div>
                    <label for="size">Size:</label>
                    <select name="size" id="size" class="form-select" style="width: 20%">
                        <option value="Small">Small</option>
                        <option value="Medium">Medium</option>
                        <option value="Large">Large</option>
                    </select>
                    <button id="increment" class="size-btn" onclick="increment()">+</button>
                    <label for="total" id="totalLabel">Total:</label>
                    <label for="qty">
                        <input type="number" name="qty" id="qty" value="1" min="1" oninput="calculateTotal()">
                    </label>
                    <button id="decrement" class="size-btn" onclick="decrement()">-</button>
                </div>
                <button class="prod-btn" onclick="addToCart()">Add To Cart</button>
            </div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>

    <script>
        function increment() {
            document.getElementById('qty').stepUp(1);
            calculateTotal();
        }

        function decrement() {
            document.getElementById('qty').stepDown(1);
            calculateTotal();
        }

        function calculateTotal() {
            const qty = parseInt(document.getElementById('qty').value);
            const priceStr = document.getElementById('product-price').innerText;
            const price = parseInt(priceStr.replace('₱ ', ''));
            const total = qty * price;
            document.getElementById('totalLabel').innerText = 'Total: ₱ ' + total;
        }

        function addToCart() {

        }

        document.addEventListener('DOMContentLoaded', function() {
            let section = document.querySelectorAll('section');
            let navLinks = document.querySelectorAll('nav a');

            window.onscroll = () => {
                section.forEach(sec => {
                    let top = window.scrollY;
                    let offset = sec.offsetTop;
                    let height = sec.offsetHeight;
                    let id = sec.getAttribute('id');

                    if (top >= offset && top < offset + height) {
                        navLinks.forEach(links => {
                            links.classList.remove('active');
                            document.querySelector('nav a[href*=' + id + ']').classList.add('active');
                        })
                    }
                })
            }
        });

        function increment() {
            document.getElementById('qty').stepUp(1);
        }

        function decrement() {
            document.getElementById('qty').stepDown(1);
        }

        function addToCart() {
            <?php
            if (!isset($_SESSION['username'])) {
                echo "if (confirm('You need to login first. Click OK to proceed to login page.')) {
            window.location.href = 'login.php';
        }";
                echo "return;";
            }
            ?>

            const qty = parseInt($('#qty').val());
            const size = $('#size').val();
            const priceStr = parseFloat(document.getElementById('product-priceoriginal').innerText);
            const productStr = document.getElementById('product-image').innerText;
            const productnameStr = document.getElementById('product-name').innerText;
            const total = qty * priceStr;
            const prodID = <?= $_GET['id'] ?>;

            if (isNaN(qty) || qty < 1) {
                alert('Quantity must be a valid positive number');
                return false;
            }

            $.ajax({
                url: 'addToCart.php',
                method: 'POST',
                data: {
                    productId: prodID,
                    quantity: qty,
                    price: priceStr,
                    name: productnameStr,
                    size: size,
                    total: total,
                    image: productStr
                },
                success: function(msg) {
                    if (msg === 'success') {
                        alert('Product added to cart successfully');
                        window.location.href = 'cart.php';
                    } else {
                        alert(msg);
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    alert('An error occurred while adding the product to the cart');
                }
            });
        }
        $.ajax({
            url: 'getProduct.php',
            data: {
                prod_id: "<?= $_GET['id'] ?>"
            },
            dataType: 'json',
            success: function(result) {
                if (result.success) {
                    console.log(result.data);
                    product = result.data;
                    document.getElementById('product-name').innerHTML = result.data.P_NAME;
                    document.getElementById('product-price').innerHTML = "₱ " + result.data.P_PRICE;
                    document.getElementById('product-priceoriginal').innerHTML = result.data.P_PRICE;
                    document.getElementById('mainImg').src = "./imgs/products/" + result.data.P_IMAGE;
                    document.getElementById('product-image').innerHTML = result.data.P_IMAGE;
                    document.getElementById('mainImg').alt = result.data.P_NAME;
                }
            }
        });
    </script>

</body>

</html>