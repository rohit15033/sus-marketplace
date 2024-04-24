<?php
session_start();
$user_id = $_SESSION['user_id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins&display=swap">
    <script src="https://kit.fontawesome.com/2cbd32f941.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="homepage.css">
</head>

<body>

    <div class="global-container">
        <div class="hero-container">

        <?php
            require '../navbar/navbar.html'; ?>
            <div class="header-accent">

            </div>
            <div class="carousel-container">
                <button id="prevBtn" class="carousel-button">&#10094;</button>
                <div class="carousel">
                    <img src="../../Assets/carousel/carousel1.jpeg" alt="img">
                    <img src="../../Assets/carousel/carousel2.jpeg" alt="img">
                    <img src="../../Assets/carousel/carousel3.jpeg" alt="img">
                </div>
                <button id="nextBtn" class="carousel-button">&#10095;</button>
            </div>
        </div>

        <div class="categories-section">

            <div class="tagline-searchbar-container">
                <div class="superior-tagline-header-container">
                    <div class="tagline-header-container">
                        <h1>Welcome to SU Shop!</h1>
                    </div>
                    <div class="lesser-tagline-header-container">
                        <p>Click on a product or use the search bar to continue.</p>
                    </div>
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
                require '../productOfTheDay/productOfTheDay.php';
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
                    <a href="https://www.facebook.com/sampoerna.university"><img src="../../Assets/Icons/icons8-facebook.svg" alt=""></a>
                    <a href="https://www.instagram.com/sampoerna.university"><img src="../../Assets/Icons/icons8-instagram.svg" alt=""></a>
                    <a href="https://twitter.com/SampoernaUniv"><img src="../../Assets/Icons/icons8-twitter.svg" alt=""></a>
                    <a href="https://www.youtube.com/@sampoernauniversity5660"><img src="../../Assets/Icons/icons8-youtube.svg" alt=""></a>
                    <a href="https://www.linkedin.com/school/sampoerna-university/"><img src="../../Assets/Icons/icons8-linkedin.svg" alt=""></a>
                </div>

                <div class="footer-accent3"></div>
                <div class="footer-accent4">
                    <h3 id="footer-text">2022 Sampoerna University. All Rights Reserved.</h3>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
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

            nextBtn.addEventListener("click", function() {
                nextImage();
                stopInterval();
                startInterval();
            });

            prevBtn.addEventListener("click", function() {
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

        window.addEventListener('scroll', function() {
            var currentScroll = window.pageYOffset || document.documentElement.scrollTop;

            if (currentScroll > lastScrollTop && currentScroll > headerHeight) {
                header.classList.add('hide');
            } else {
                header.classList.remove('hide');
            }
            lastScrollTop = currentScroll <= 0 ? 0 : currentScroll;
        });

        function toggleDropdown() {
            var dropdownContent = document.getElementById("dropdown-content");
            if (dropdownContent.style.display === "none") {
                dropdownContent.style.display = "block";
            } else {
                dropdownContent.style.display = "none";
            }
        }

        function searchCategory(category) {
            var form = document.createElement("form");
            form.setAttribute("method", "POST");
            form.setAttribute("action", "../search/search.php");

            var input = document.createElement("input");
            input.setAttribute("type", "hidden");
            input.setAttribute("name", "search");
            input.setAttribute("value", category);

            form.appendChild(input);

            document.body.appendChild(form);

            form.submit();
        }
    </script>


</body>

</html>