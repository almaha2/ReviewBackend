<?php
session_start();
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <title>reviews Project</title>
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
        <link href="css/loginn.css" rel="stylesheet">
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

    <main id="main">
        <!-- ======= About Reviews ======= -->
        <section class="container">
            <div class="row d-flex justify-content-center mt-5">
                <div class="col-md-10 col-xl-8 text-center">
                    <h3 class="mb-4">About Result Of Review</h3>
                </div>
            </div>
            <div class="text-center mb-5">
                <?php
                if (isset($_SESSION['username'])) {
                    ?>
                    <a href="Users/add_reviews.php" target="_blank" style="background: #5e8078;" class="btn text-white">Add
                        Reviews</a>
                    <?php
                } else { ?>
                    <a href="Users/add_reviews.php" target="_blank" style="background: #70a2a2; pointer-events: none"
                       class="btn text-white">Add
                        Reviews</a>
                    <?php
                }

                ?>
            </div>
            <div class="row text-center">
                <?php
                if (isset($_GET['nameCompanyUser']))
                    $result= $_GET['nameCompanyUser'];
                include('connect.php');
                $sql = $con->prepare("SELECT e.`image`,e.`name`,e.`description`,e.`company_name`,u.`username` FROM `reviews` e 
                                            INNER JOIN users u ON e.user_id = u.id
                                            WHERE  e.`name` LIKE '%$result%' OR  u.`username` LIKE '%$result%' OR e.`company_name` LIKE '%$result%' "
                );
                $sql->execute();
                $rows = $sql->fetchAll();
                $count = $sql->rowCount();
                if ($count > 0) {
                    foreach ($rows as $row) {
                        ?>
                        <div class="col-md-4 mb-5 mb-md-0">
                            <div class="d-flex justify-content-center mb-4">
                                <img src="images/<?php echo $row["image"] ?>"
                                     class="rounded shadow-1-strong" width="400" height="200"/>
                            </div>
                            <h5 class="mb-3"><?php echo $row["username"] ?></h5>
                            <h6 class="mb-3" style="color:#5e8078;"><?php echo $row["company_name"] ?></h6>
                            <p class="px-xl-3">
                                <i class="fas fa-quote-left pe-2"></i><?php echo $row["description"] ?>
                            </p>
                            <ul class="list-unstyled d-flex justify-content-center mb-3">
                                <li>
                                    <i class="fas fa-star fa-sm text-warning"></i>
                                </li>
                                <li>
                                    <i class="fas fa-star fa-sm text-warning"></i>
                                </li>
                                <li>
                                    <i class="fas fa-star fa-sm text-warning"></i>
                                </li>
                                <li>
                                    <i class="fas fa-star fa-sm text-warning"></i>
                                </li>
                                <li>
                                    <i class="fas fa-star fa-sm text-warning"></i>
                                </li>
                            </ul>
                            <div>
                                <a href="details_reviews.php?id=<?php echo $row['id']; ?>" style="background: #5e8078;"
                                   class="btn text-white mb-5">Details</a>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </section>
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