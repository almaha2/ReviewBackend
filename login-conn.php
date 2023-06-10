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
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
              rel="stylesheet">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/bootstrap-icons.css" rel="stylesheet">
        <link href="css/boxicons.min.css" rel="stylesheet">
        <link href="css/glightbox.min.css" rel="stylesheet">
        <link href="css/remixicon.css" rel="stylesheet">
        <link href="css/swiper-bundle.min.css" rel="stylesheet">
        <!-- Template Main CSS File -->
        <link href="css/style.css" rel="stylesheet">
        <link href="css/login.css" rel="stylesheet">
    </head>
    <body>
    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top"  style="background: #5e8078; ">
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

        <!-- ======= Breadcrumbs ======= -->
        <section id="breadcrumbs" class="breadcrumbs" style="padding-top: 60px">
            <div class="container">

                <ol>
                    <li><a href="index.php">Home</a></li>
                    <li>Sign In</li>
                </ol>
                <h2>Sign In</h2>

            </div>
        </section><!-- End Breadcrumbs -->

        <?php



        include('connect.php');

        //print_r($_POST);
        $email = $_POST['email'];
        $password = $_POST['password'];
        $hashedPass = sha1($password);

        $sql1 = $con->prepare("SELECT * FROM users WHERE 
 email=? AND password=?");
        $sql1->execute(array($email, $hashedPass));
        $row1 = $sql1->fetch();
        $count1 = $sql1->rowCount();

        $sql2 = $con->prepare("SELECT * FROM `admin` WHERE 
 email=? AND password=?");
        $sql2->execute(array($email, $hashedPass));
        $row3 = $sql2->fetch();
        $count2 = $sql2->rowCount();
        if ($email != "" && $hashedPass != "") {
            if ($count1 > 0) {
                $sql = $con->prepare("SELECT * FROM users ");
                $sql->execute();
                $rows = $sql->fetchAll();

                foreach ($rows as $use) {

                    if ($email == $use["email"] && $hashedPass == $use["password"]) {
                        $_SESSION['id'] = $use['id'];
                        $_SESSION['username'] = $use['username'];
                        $_SESSION['email'] = $use['email'];
                        $_SESSION['password'] = $use['password'];
                        $_SESSION['type'] = "1";
                        header('Location:index.php');

                        //echo $_SESSION['name'];
                    }
                }
                $con = null;
                //echo "wrong password or email";


            } elseif ($count2 > 0) {
                echo 12;
                $sql = $con->prepare("SELECT * FROM `admin`");
                $sql->execute();
                $rows = $sql->fetchAll();
                foreach ($rows as $ad) {
                    if ($email == $ad["email"] && $hashedPass == $ad["password"]) {
                        $_SESSION['id'] = $ad['id'];
                        $_SESSION['password'] = $ad['password'];
                        $_SESSION['email'] = $ad['email'];
                        $_SESSION['type'] = "2";
                        header('Location:Admin/report.php');
                        //echo $_SESSION['name'];
                    }
                }
                $con = null;
                //echo "wrong password or email";
            } else {
                echo '
	 <div class="container"><div class="container" style="margin-top:50px">
	  <div class="alert alert-info role="alert">
		  <strong>Error!</strong> That Email address or password error please try again.
		  <button type="button" class="close pull-left" style="float:right;background-color: #CFF4FC;border:none;font-size:20px" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		  </button>
            </div></div>
	    </div> 
	        <div class="design" dir="ltr" style="height:auto">
         <form class="login" action="login-conn.php" method="post">
              <h4 class="text-center" style="color:#5e8078;font-family: cursive">Sign In</h4> 
              <div class="ast">
                  <input class="form-control email" type="text" placeholder="Email Address" name="email" autocomplete="off" required="required"/>
                  <i class="bx bx-envelope"></i>
                  <i class="bi bi-check check"></i>
                  <i class="bi bi-close close"></i>
                  <div class="alert alert-danger empty-alert">Please Fill Your <strong>Email</strong></div>
                <div class="alert alert-danger long-alert">Please Your E-mail Must Be Contains <strong>@</strong></div>
                <div class="alert alert-danger custom-alert">Please Your E-mail Must Be Contains <strong>.com</strong></div> 
              </div>	
              
              <div class="ast">
                  <input class="form-control password" type="password" placeholder="Password" name="password" autocomplete="new-password" required="required"/>
                  <i class="bx bx-key"></i>
                  <i class="bi bi-check  check-pass"></i>
                  <i class="bi bi-close close-pass"></i>
                  <i class="show-pass bi bi-eye fa-2x"></i>
                  <div class="alert alert-danger empty-alert">Please Fill Your <strong>Password</strong></div>
                <div class="alert alert-danger long-alert">Please Password Must Be  <strong>6 digits</strong></div>
                <div class="alert alert-danger custom-alert">Please Password Must Be Contains<strong>One Uppercase Character</strong></div>
                <div class="alert alert-danger lower-alert">Please Password Must Be Contains<strong>One Lowercase Character</strong></div>
                <div class="alert alert-danger number-alert">Please Password Must Be Contains<strong>One Number</strong></div>
              </div>
              <input style="background-color:#5e8078" class="btn btn-primary" type="submit" value="Sign In"/>
              <div class="text-center" style="margin-top:10px">
                  <span>have an account? </span><a style="text-decoration:none" href="signup.php"> Register Now</a>
              </div>	 
              <div class="text-center" style="margin-top:10px;padding-bottom:20px">
                  <span>Forgot Password? </span><a style="text-decoration:none" href="resetpassword.php"> Reset Password Now</a>
              </div>	 
         </form>
        </div>';
            }
        } else {
            /*include('logout.php');
            include('login.php');*/
            //echo "Not found UserName or password";
        }
        ?>
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