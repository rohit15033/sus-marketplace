<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="stylesheet" href="homepage.css">

</head>

<body>

    <div class="global-container">
        <div class="hero-container">
            <header>
                <div class="header-logo">
                    <a href="https://www.sampoernauniversity.ac.id"><img src="../../TestimonyAsset/su-logo-light.png"
                            alt=""></a>
                </div>

                <label class="hamburger-menu">
                    <input type="checkbox">
                </label>
                <aside class="sidebar">
                    <h1 id="sidebar-text">Sitemap</h1>
                    <nav>
                        <div class="sidebar-links"><a href="">Login</a></div>
                        <div class="sidebar-links"><a href="">Register</a></div>
                        <div class="sidebar-links"><a href="">About</a></div>
                        <div class="sidebar-links"><a href="">Contact</a></div>
                    </nav>
                </aside>

            </header>
            <div class="header-accent">

            </div>
            <div class="carousel-container">
                <button id="prevBtn" class="carousel-button">&#10094;</button>
                <div class="carousel">
                    <div class="carousel">
                        <img src="../../Assets/carousel/carousel1.jpeg" alt="img">
                        <img src="../../Assets/carousel/carousel2.jpeg" alt="img">
                        <img src="../../Assets/carousel/carousel3.jpeg" alt="img">
                    </div>
                </div>
                <button id="nextBtn" class="carousel-button">&#10095;</button>
            </div>
        </div>

        <div class="categories-section">

            <div class="tagline-searchbar-container">

                <div class="tagline-header-container">
                    <h1>Welcome to SU Shop!</h1>
                </div>

                <div class="lesser-tagline-header-container">
                    <p>Click on a product or use the search bar to continue.</p>
                </div>

                <div class="searchbar">
                    <form action="../search/search.php" method="POST">
                        <input type="text" name="search" placeholder="Search here...">
                        <button type="submit">Search</button>
                    </form>
                </div>
            </div>



            <div class="categories-container">

                <?php
                session_start();
                $db_host = "localhost";
                $db_username = "root";
                $db_password = "";
                $db_name = "susmarketplace";
                $conn = new mysqli($db_host, $db_username, $db_password, $db_name);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $getQuery = "SELECT * FROM product_seller_view ORDER BY RAND() LIMIT 5";
                $Result = mysqli_query($conn, $getQuery);
                ?>
                <div class='productoftheday-container'>

                    <?php

                    $counter = 1;
                    if (mysqli_num_rows($Result) > 0) {
                        while ($row = mysqli_fetch_assoc($Result)) {
                            $product_name = $row['product_name'];
                            $image_path = $row['image_path'];
                            $quantity = $row['quantity'];
                            $description = $row['description'];
                            $category = $row['category'];
                            $price = $row['price'];
                            $product_id = $row['product_id'];
                            $seller_id = $row['seller_id'];

                            if ($counter == 1) {
                                echo "<div class='productoftheday'>";
                                echo "<h1> Product Of The Day</h1>";
                                echo "<div class='product'>";
                                echo "<a href='../product/product.php?product_id=$product_id'>";
                                echo "<img src='$image_path' alt='$product_name'>";
                                echo "<div class = 'product-details'>";
                                echo "<div>";
                                echo "<h2 class='productoftheday-title'>$product_name</h2>";
                                echo "</div>";
                                echo "<div class='productoftheday-price'>";
                                echo "<h2>$price</h2>";
                                echo "</div>";
                                echo "</div>";
                                echo "</div>";
                                echo "</div>";
                                $counter++;
                                continue;
                            }

                            if ($counter == 2) {
                                echo "<div class = 'products'>";
                            }

                            echo "<div class='product'>";
                            echo "<a href='../product/product.php?product_id=$product_id'></a>";
                            echo "<img src='$image_path' alt='$product_name' >";
                            echo "<div class = 'product-details'>";
                            echo "<div>";
                            echo "<p>$product_name</p>";
                            echo "</div>";
                            echo "<div class='price'>";
                            echo "<p>$price</p>";
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";

                            if ($counter == 5) {
                                echo "</div>";
                            }
                            $counter++;
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="ultimate-testimony-container">
                <div class="testimony-container">
                    <p>"The campus marketplace is a gem! Navigating the website was a breeze, and I found everything I
                        needed
                        quickly. The selection of products is impressive, and the quality is top-notch. The staff were
                        friendly
                        and helpful, making my shopping experience enjoyable. Highly recommend!"</p>

                    <div class="testimony-user">
                        <div class="profile-pic">
                            <img src="../../TestimonyAsset/man-user-circle-icon.svg" alt="img">
                        </div>
                        <p id="user-text">- Johhny Sins</p>
                    </div>
                </div>
            </div>

            <div class="footer">
                <div class="footer-accent1"></div>
                <div class="footer-accent2"></div>
                <div class="footer-logo">
                    <a href=""><img src="../../TestimonyAsset/Universitas Sampoerna (1).png" alt=""></a>
                </div>
                <div class="footer-details1">
                    <p>L'Avenue Campus</p>
                    <p>Jln. Raya Pasar Minggu, Kav. 16</p>
                    <p>Pancoran, Jakarta 12780</p>
                </div>

                <div class="footer-details2">
                    <p>Need More Assistance?</p>
                    <p>+62817 5251 414 / +62856 0733 6771</p>
                </div>

                <div class="social-media-container">
                    <a href="https://www.facebook.com/sampoerna.university"><img
                            src="../../Assets/Icons/icons8-facebook.svg" alt=""></a>
                    <a href="https://www.instagram.com/sampoerna.university"><img
                            src="../../Assets/Icons/icons8-instagram.svg" alt=""></a>
                    <a href="https://twitter.com/SampoernaUniv"><img src="../../Assets/Icons/icons8-twitter.svg"
                            alt=""></a>
                    <a href="https://www.youtube.com/@sampoernauniversity5660"><img
                            src="../../Assets/Icons/icons8-youtube.svg" alt=""></a>
                    <a href="https://www.linkedin.com/school/sampoerna-university/"><img
                            src="../../Assets/Icons/icons8-linkedin.svg" alt=""></a>
                </div>

                <div class="footer-accent3"></div>
                <div class="footer-accent4">
                    <h3 id="footer-text">2022 Sampoerna University. All Rights Reserved.</h3>
                </div>
            </div>
        </div>
    </div>

        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const carousel = document.querySelector(".carousel");
                const images = document.querySelectorAll(".carousel img");
                const prevBtn = document.getElementById("prevBtn");
                const nextBtn = document.getElementById("nextBtn");
                let currentIndex = 0;
                let intervalId;

                function showImage() {
                    carousel.style.transform = `translateX(${-currentIndex * 100}%)`;
                }

                function nextImage() {
                    currentIndex = (currentIndex + 1) % images.length;
                    showImage();
                }

                function prevImage() {
                    currentIndex = (currentIndex - 1 + images.length) % images.length;
                    showImage();
                }

                function startInterval() {
                    intervalId = setInterval(nextImage, 5000);
                }

                function stopInterval() {
                    clearInterval(intervalId);
                }

                nextBtn.addEventListener("click", function () {
                    nextImage();
                    stopInterval();
                    startInterval();
                });

                prevBtn.addEventListener("click", function () {
                    prevImage();
                    stopInterval();
                    startInterval();
                });

                startInterval();
                showImage();
            });

            var lastScrollTop = 0;
            var headerHeight = document.querySelector('header').offsetHeight;
            var header = document.querySelector('header');

            window.addEventListener('scroll', function () {
                var currentScroll = window.pageYOffset || document.documentElement.scrollTop;

                if (currentScroll > lastScrollTop && currentScroll > headerHeight) {
                    header.classList.add('hide');
                } else {
                    header.classList.remove('hide');
                }
                lastScrollTop = currentScroll <= 0 ? 0 : currentScroll;
            });
        </script>

</body>

</html>