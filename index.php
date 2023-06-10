<?php
session_start();
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <title>Reviews Project</title>
        <meta content="" name="description">
        <meta content="" name="keywords">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.2.0/css/all.min.css"
              integrity="sha512-6c4nX2tn5KbzeBJo9Ywpa0Gkt+mzCzJBrE1RB6fmpcsoN+b/w/euwIMuQKNyUoU/nToKN3a8SgNOtPrbW12fug=="
              crossorigin="anonymous" referrerpolicy="no-referrer"/>
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
              rel="stylesheet">
        <!-- Vendor CSS Files -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/bootstrap-icons.css" rel="stylesheet">
        <link href="css/boxicons.min.css" rel="stylesheet">
        <link href="css/glightbox.min.css" rel="stylesheet">
        <link href="css/remixicon.css" rel="stylesheet">
        <link href="css/swiper-bundle.min.css" rel="stylesheet">
        <!-- Template Main CSS File -->
        <link href="css/style.css" rel="stylesheet">
    </head>
    <body>
    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top">
        <div class="container d-flex align-items-center justify-content-between">
            <a href="index.php" class="nav-link scrollto text-left" style="color: #f6f6f6">Review</a>
            <nav id="navbar" class="navbar">
                <ul>
                    <li ><a href="index.php"><span>Home</span></a>
                    <li class="dropdown"><a href="#"><span>Reviews</span> <i class="bi bi-chevron-down"></i></a>
                        <ul>
                            <li><a href="review_services.php">Services</a></li>
                            <li><a href="review_products.php">Products</a></li>
                            <li><a href="review_shops.php">Shops</a></li>
                        </ul>
                    </li>

                    <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
                    <?php
                    if (isset($_SESSION['username'])) {
//                    if($_SESSION['type'] == "1"){
                        ?>
                        <li><a class="nav-link scrollto" href="Users/add_reviews.php">My Profile</a></li>
                        <li><a class="nav-link scrollto" href="logout.php">Logout</a></li>
                        <?php
                    } else { ?>
                        <li><a class="nav-link scrollto" href="signin.php">Sign In</a></li>
                        <li><a class="nav-link scrollto" href="signup.php">Sign Up</a></li>
                        <?php
//                    }
                    }
                    ?>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->

    <!-- ======= Hero Section ======= -->
    <section id="hero">
        <div class="hero-container">
            <h1><img src="images/photo_2023-05-30_21-22-17.jpg" alt=""></h1>
        </div>
    </section><!-- End Hero -->

    <main id="main">

        <!-- ======= About Section ======= -->
        <section id="about" class="container">
            <div class="container">

                <div class="section-title">
                    <h2>About</h2>
                    <h3>Learn More <span>About Us</span></h3>
                </div>

                <div class="row content">
                    <div class="col-xl-6 col-sm-6 col-lg-6">
                            <img src="images/About.png" style="width:360px;height:450px">
                    </div>
                    <div class="col-lg-6 pt-4 pt-lg-0 ">
                        <p class="paragraph">
                            We are senior students of computer information systems at PSAU .We have created this platform to serve customersall over the world, in all commercial sectorsin all categories, by allowing website users to view customer reviews and add personal reviews .
                        </p>

                    </div>
                </div>

            </div>
        </section><!-- End About Section -->

        <!-- ======= Services Section ======= -->
        <section id="services" class="services">
            <div class="container">

                <div class="section-title">
                    <h2>Services</h2>
                    <h3>We do offer awesome <span>Reviews</span></h3>
                    <p>Some Of the Services Provided by our website</p>
                </div>

                <div class="row">
                    <div class="col-md-4 col-lg-4 d-flex align-items-stretch mb-5 mb-lg-0">
                        <div class="icon-box">
                            <div class="icon"><i class="bx bxl-dribbble"></i></div>
                            <h4 class="title"><a href="">Services</a></h4>
                            <p class="description">including service reviews,
                                which are also experiences related to other experiences,
                                including reviews belonging </p>
                        </div>
                    </div>

                    <div class="col-md-4 col-lg-4 d-flex align-items-stretch mb-5 mb-lg-0">
                        <div class="icon-box">
                            <div class="icon"><i class="bx bx-file"></i></div>
                            <h4 class="title"><a href="">Products</a></h4>
                            <p class="description">The main goal of activating reviews and reviews is to promote all
                                daily reviews and events,
                                which are divided into three main sections.</p>
                        </div>
                    </div>

                    <div class="col-md-4 col-lg-4 d-flex align-items-stretch mb-5 mb-lg-0">
                        <div class="icon-box">
                            <div class="icon"><i class="bx bx-share"></i></div>
                            <h4 class="title"><a href="">Shops</a></h4>
                            <p class="description">Including the main section, which is the market section,
                                and there are many reviews related to this section and the products section</p>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- End Services Section -->

        <!-- ======= Portfolio Section ======= -->
        <section id="portfolio" class="portfolio">
            <div class="container">
                <div class="section-title">
                    <h2>Some products</h2>
                    <h3>Check our <span>Some Reviews</span></h3>
                    <p>Some Of the fun and products for users</p>
                </div>
                <div class="row portfolio-container">

                    <?php

                    include('connect.php');
                    $sql = $con->prepare("SELECT * FROM `reviews` e WHERE e.`category_name` = 'Product'");
                    $sql->execute();
                    $rows = $sql->fetchAll();
                    $count = $sql->rowCount();
                    if ($count > 0) {
                        foreach ($rows as $row) {
                            ?>
                            <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                                <img src="images/<?php echo $row["image"]?>" style="width: 350px;height: 220px;left: 3px;"
                                     class="img-fluid" alt="">
                                <div class="portfolio-info">
                                    <h4><?php echo $row["name"]?></h4>
                                    <a href="images/videos/<?php echo $row["video"]?>" style="width: 360px;height: 220px"
                                       data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="<?php echo $row["name"]?>"><i
                                                class="bx bx-plus"></i></a>
                                    <a href="details_reviews.php?id=<?php echo $row['id']; ?>" class="details-link" title="Review Link"><i class="bx bx-link"></i></a>
                                </div>
                            </div>
                            <?php
                        }
                    } else {
                        ?>
                        <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                            <img src="images/photo_5834874730346298372_m.jpg" style="width: 350px;height: 220px;left: 3px;"
                                 class="img-fluid" alt="">
                            <div class="portfolio-info">
                                <h4>Review 1</h4>
                                <a href="images/document_6024090158360433001.mp4" style="width: 360px;height: 220px"
                                   data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="Review 2"><i
                                            class="bx bx-plus"></i></a>
                                <a href="#" class="details-link" title="Review Link"><i class="bx bx-link"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                            <img src="images/photo_5834874730346298367_m.jpg" style="width: 350px;height: 220px;left: 3px;"
                                 class="img-fluid" alt="">
                            <div class="portfolio-info">
                                <h4>Review 2</h4>
                                <a href="images/document_6024090158360433002.mp4" style="width: 360px;height: 220px"
                                   data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="Review 2"><i
                                            class="bx bx-plus"></i></a>
                                <a href="#" class="details-link" title="Review Link"><i class="bx bx-link"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                            <img src="images/340.jpg" style="width: 349px;height: 220px;left: 3px;"
                                 class="img-fluid" alt="">
                            <div class="portfolio-info">
                                <h4>Review 3</h4>
                                <a href="images/document_6024090158360433000.mp4" style="width: 355px;height: 220px"
                                   data-gallery="portfolioGallery" class="portfolio-lightbox preview-link img-fluid"
                                   title="Review 3"><i class="bx bx-plus"></i></a>
                                <a href="#" class="details-link" title="Review Link"><i class="bx bx-link"></i></a>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </section>
        <!-- End Portfolio Section -->
        <section id="team" class="team">
            <div class="container">

                <div class="section-title">
                    <h2>Users</h2>
                    <h3>Our <span>Users</span></h3>
                    <p>Some Of the Users for our website</p>
                </div>

                <div class="row">
                    <?php

                    include('connect.php');
                    $sql = $con->prepare("SELECT * FROM `users`");
                    $sql->execute();
                    $rows = $sql->fetchAll();
                    $count = $sql->rowCount();
                    if ($count > 0) {
                        foreach ($rows as $key => $row) {
                            if ($key <= 3) {
                                ?>
                                <div class="col-lg-3 col-md-6 align-items-stretch">
                                    <div class="member">
                                        <div class="member-img">
                                            <img src="images/avatar4.png" class="img-fluid" alt="">
                                        </div>
                                        <div class="member-info">
                                            <h4><?php echo $row["username"] ?></h4>
                                            <span><?php echo $row["email"] ?></span>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                    } else {
                        ?>
                        <div class="col-lg-3 col-md-6 align-items-stretch">
                            <div class="member">
                                <div class="member-img">
                                    <img src="images/avatar4.png" class="img-fluid" alt="">
                                </div>
                                <div class="member-info">
                                    <h4>Jack</h4>
                                    <span>Jack@yahoo.com</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 align-items-stretch">
                            <div class="member">
                                <div class="member-img">
                                    <img src="images/avatar4.png" class="img-fluid" alt="">
                                </div>
                                <div class="member-info">
                                    <h4>Willem</h4>
                                    <span>Willem@yahoo.com</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 align-items-stretch">
                            <div class="member">
                                <div class="member-img">
                                    <img src="images/avatar4.png" class="img-fluid" alt="">
                                </div>
                                <div class="member-info">
                                    <h4>horde</h4>
                                    <span>horde@gamil.com</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 align-items-stretch">
                            <div class="member">
                                <div class="member-img">
                                    <img src="images/avatar4.png" class="img-fluid" alt="">
                                </div>
                                <div class="member-info">
                                    <h4>Keiji</h4>
                                    <span>Keiji@gamil.com</span>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>

            </div>
        </section><!-- End Team Section -->
        <!-- ======= Contact Section ======= -->
        <section id="contact" class="contact">
            <div class="container">

                <div class="section-title">
                    <h2>Contact</h2>
                    <h3>Contact <span>Us</span></h3>

                </div>

                <div class="row mt-5">

                    <div class="col-lg-4">
                        <div class="info">
                            <div class="address">
                                <i class="bi bi-geo-alt"></i>
                                <h4>Location:</h4>
                                <p>Saudi Arabia</p>
                            </div>

                            <div class="email">
                                <i class="bi bi-envelope"></i>
                                <h4>Email:</h4>
                                <p>review@gmail.com</p>
                            </div>

                            <div class="phone">
                                <i class="bi bi-phone"></i>
                                <h4>Call:</h4>
                                <p>+96659568523083</p>
                            </div>

                        </div>

                    </div>
                    <div class="col-lg-8 mt-5 mt-lg-0">

                        <form action="" method="post" role="form" class="login">
                            <div class="row">
                                <div class="col-md-6 form-group ast">
                                    <input type="text" name="name" class="form-control name" id="name"
                                           placeholder="Your Name" required>
                                </div>
                                <div class="col-md-6 form-group mt-3 mt-md-0 ast">
                                    <input type="email" class="form-control email" name="email" id="email"
                                           placeholder="Your Email" required>
                                </div>
                            </div>
                            <div class="form-group mt-3 ast">
                                <input type="text" class="form-control name" name="subject" id="subject"
                                       placeholder="Subject">
                            </div>
                            <div class="form-group mt-3 ast">
                            <textarea class="form-control" name="message" rows="6"
                                      placeholder="Message"></textarea>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="appointment-btn"
                                        style="border-radius:50px;margin-top:20px;background-color:#5e8078;padding:15px;color:#FFF;width:200px">
                                    Send Message
                                </button>
                            </div>
                        </form>

                    </div>

                </div>
            </div>
        </section><!-- End Contact Section -->
    </main><!-- End #main -->
    <!-- ======= Footer ======= -->
    <footer id="footer">
        <div class="container  py-4 text-center">
            <div class="me-md-auto text-center text-md-start">
                <div class="copyright text-center">
                    &copy; Copyright <strong><span>Review</span></strong>. All Rights Reserved
                </div>
                <div class="credits">
                </div>
            </div>
        </div>
    </footer><!-- End Footer -->
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
                class="bi bi-arrow-up-short"></i></a>
    <!-- Vendor JS Files -->
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/glightbox.min.js"></script>
    <script src="js/isotope.pkgd.min.js"></script>
    <script src="js/validate.js"></script>
    <script src="js/swiper-bundle.min.js"></script>

    <!-- Template Main JS File -->
    <script src="js/jquery-1.12.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/front.js"></script>
    <script src="js/main.js"></script>

    </body>

    </html>

<?php
ob_end_flush();
?>