<!DOCTYPE html>
<html lang="en">

<?php
session_start();
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>

    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <!-- Slick Carousel CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" />

    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <link rel="stylesheet" href="./css/style.css?=<?php echo time(); ?>"> 
    <style>
        .category {
            color: black;
            font-family: 'Times New Roman', Times, serif;
            font-size: 20px;
            margin-left: 5px;
        }
    </style>

</head>

<body>

    <?php
    include "header.php";
    ?>

    <!-- Products -->
    <section id="products" style="width: 100%;height: 100vh;padding: 5% 0;margin-top:20px">
        <div>
            <h2>Our Products</h2>
            <div class="prod-cat">
                <nav id="prodcat" >
                    <a href="?category=All" class="category">All</a>
                    <a href="?category=T-Shirt" class="category">T-Shirt</a>
                    <a href="?category=Jeans" class="category">Jeans</a>
                    <a href="?category=Jackets" class="category">Jackets</a>
                    <a href="?category=Sweatpants" class="category">Sweatpants</a>
                    <a href="?category=Dress" class="category">Dress</a>
                    <a href="?category=Undergarments" class="category">Undergarments</a>
                </nav>
            </div>

            <hr>
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <?php
                    include "connection.php";

                    $category = isset($_GET['category']) ? $_GET['category'] : 'All';

                    $sql = "SELECT * FROM SBIT2J_PRODUCTSTBL";

                    if ($category !== 'All') {
                        $sql .= " WHERE P_CATEGORY = '$category'";
                    }

                    $statement = oci_parse($conn, $sql);
                    $result = oci_execute($statement);

                    if ($result) {
                        if (oci_fetch_all($statement, $rows, null, null, OCI_FETCHSTATEMENT_BY_ROW)) {
                            foreach ($rows as $row) {
                                echo '<div class="swiper-slide">';
                                echo '<div class="prod ' . strtolower($row['P_CATGENDER']) . '" style="height:510px;width:380px">';
                                echo '<img src="./imgs/products/' . $row['P_IMAGE'] . '">';

                                echo '<div class="prod-info">';
                                echo '<h4>' . $row['P_CATGENDER'] . '</h4>';
                                echo '<h4>' . $row['P_CATEGORY'] . '</h4>';
                                echo '<h4 class="prod-title">' . $row['P_NAME'] . '</h4>';
                                echo '<p class="prod-price">₱ ' . $row['P_PRICE'] . '</p>';

                                if ($row['SMALLQTY'] == 0 || $row['MEDIUMQTY'] == 0 || $row['LARGEQTY'] == 0) {
                                    echo '<p class="sold-out">Sold Out</p>';
                                } else {
                                    echo '<a href="single_product.php?id=' . $row['P_ID'] . '" class="prod-btn">Add To Cart</a>';
                                }

                                echo '</div></div></div>';
                            }
                        } else {
                            echo "No rows found.";
                        }
                    } else {
                        $error = oci_error($statement);
                        echo "Error executing query: " . $error['message'];
                    }
                    ?>

                </div>
            </div>
            <div class="swiper-pagination"></div>
    </section>

    <!-- Categories -->
    <section id="categories" class="w-100 my-5 py-5">
        <div>
            <h1>Top Categories</h1>
        </div>
        <div class="row p-0 m-0">
            <!-- Men -->
            <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
                <img id="Men" class="img-fluid" src="./imgs/men.png">
                <div class="details">
                    <h2>Men</h2>
                    <button class="btn btn-dark" onclick="filterProducts('Men')">Shop Now</button>
                </div>
            </div>
            <!-- Women -->
            <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
                <img id="Women" class="img-fluid" src="./imgs/women.png">
                <div class="details">
                    <h2>Women</h2>
                    <button class="btn btn-dark" onclick="filterProducts('Women')">Shop Now</button>
                </div>
            </div>
            <!-- Kid -->
            <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
                <img id="Kid" class="img-fluid" src="./imgs/kid.PNG">
                <div class="details">
                    <h2>Kid</h2>
                    <button class="btn btn-dark" onclick="filterProducts('Kid')">Shop Now</button>
                </div>
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
        var swiper = new Swiper('.swiper-container', {
            slidesPerView: 'auto',
            spaceBetween: 5,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            breakpoints: {
                768: {
                    slidesPerView: 4,
                },
                576: {
                    slidesPerView: 2,
                },
                0: {
                    slidesPerView: 1,
                }
            }
        });

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

        function filterProducts(category) {
            let allProducts = document.querySelectorAll('.prod');
            allProducts.forEach(product => {
                product.style.display = 'none';

                if (product.classList.contains(category.toLowerCase()) || product.querySelector('.prod-title').innerText === category) {
                    product.style.display = 'block';
                }
            });
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
    </script>

</body>

</html>