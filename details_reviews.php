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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"
              integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg=="
              crossorigin="anonymous" referrerpolicy="no-referrer"/>
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
    <header id="header" class="fixed-top" style=" background: #5e8078; ">
        <div class="container d-flex align-items-center justify-content-between">
            <a href="index.php" class="nav-link scrollto text-left" style="color: #f6f6f6">Review</a>
            <nav id="navbar" class="navbar">
                <ul>
                    <li><a href="index.php"><span>Home</span></a>
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
        <nav class="navbar navbar-expand-sm navbar-dark">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02"
                    aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="end">
                <div class="collapse navbar-collapse" id="navbarColor02">
                    <ul class="navbar-nav">
                        <li class="nav-item"><a class="nav-link" href="#" data-abc="true">Work</a></li>
                        <li class="nav-item"><a class="nav-link" href="#" data-abc="true">Capabilities</a></li>
                        <li class="nav-item "><a class="nav-link" href="#" data-abc="true">Articles</a></li>
                        <li class="nav-item active"><a class="nav-link mt-2" href="#" data-abc="true"
                                                       id="clicked">Contact<span class="sr-only">(current)</span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Main Body -->
        <section>
            <div class="container">
                <?php
                include('Admin/sections/db_connection.php');
                //  Code for Like and Dislike
                if (isset($_POST['action'])) {
                    $review_id = $_POST['review_id'];
                    $action = $_POST['action'];
                    echo $action;
                    if (isset($_SESSION['username'])) {
                        $user_id = $_SESSION['id'];
                    } else {
                        $user_id = 1;
                    }
                    switch ($action) {
                        case 'like':
                            $check = "SELECT * FROM `rate`WHERE `user_id` = '$user_id'AND `review_id` = '$review_id' AND`rating_action`='dislike' ";
//                            $result = mysqli_query($con, $check);
                            $x = $con->query($check);
                            if ($x->num_rows > 0) {
                                $delete = "DELETE FROM `rate` WHERE `user_id` = '$user_id' AND `review_id` = '$review_id'";
                                mysqli_query($con, $delete);
                            }
                            $sql = "INSERT INTO `rate` (`review_id`,`user_id`,`rating_action`) 
                                                VALUES ('$review_id','$user_id','like') 
                                                ON DUPLICATE KEY UPDATE `rating_action`='like'";
                            break;
                        case 'dislike':
                            $check = "SELECT * FROM `rate`WHERE `user_id` = '$user_id'AND `review_id` = '$review_id' AND`rating_action`='LIKE' ";
//                            $result = mysqli_query($con, $check);
                            $x = $con->query($check);
                            if ($x->num_rows > 0) {
                                $delete = "DELETE FROM `rate` WHERE `user_id` = '$user_id' AND `review_id` = '$review_id'";
                                mysqli_query($con, $delete);
                            }
                            $sql = "INSERT INTO `rate` (`review_id`,`user_id`,`rating_action`) 
                                                VALUES ('$review_id','$user_id','dislike') 
                                                ON DUPLICATE KEY UPDATE `rating_action`='dislike'";
                            break;
                        case 'unlike':
                            $sql = "DELETE FROM `rate` WHERE `user_id` = '$user_id' AND `review_id` = '$review_id'";
                            break;
                        case 'undislike':
                            $sql = "DELETE FROM `rate` WHERE `user_id` = '$user_id' AND `review_id` = '$review_id'";
                            break;
                        default;
                            break;
                    }
                    mysqli_query($con, $sql);
                    $DisLikesCount = getDisLikes($review_id);
                    $LikesCount = getLikes($review_id);
                    echo getRatting($review_id);
                    return json_encode(array($LikesCount, $DisLikesCount));
                }
                //    check If User Already Likes Reviews or Not

                function userLiked($review_id)
                {
                    include('connect.php');
                    if (isset($_SESSION['username'])) {
                        $user_id = $_SESSION['id'];
                    } else {
                        $user_id = 1;
                    }
                    $sql = $con->prepare("SELECT * FROM `rate` WHERE `user_id` = '$user_id' AND `review_id` = '$review_id' AND rating_action='like'");
                    $sql->execute();
                    $result = $sql->rowCount();
                    if ($result > 0) {
                        return true;
                    } else {
                        return false;
                    }
                }

                //    check If User Already DisLikes Reviews or Not

                function userDisLiked($review_id)
                {
                    include('connect.php');
                    if (isset($_SESSION['username'])) {
                        $user_id = $_SESSION['id'];
                    } else {
                        $user_id = 1;
                    }
                    $sql = $con->prepare("SELECT * FROM `rate` WHERE `user_id` = '$user_id' AND `review_id` = '$review_id' AND rating_action='dislike'");
                    $sql->execute();
                    $result = $sql->rowCount();
                    if ($result > 0) {
                        return true;
                    } else {
                        return false;
                    }
                }

                //  Get Total Number Of Likes For a Particular Review

                function getLikes($review_id)
                {
                    include('Admin/sections/db_connection.php');
                    $query = "SELECT COUNT(*) FROM `rate` WHERE `review_id` = '$review_id' AND rating_action='like'";
                    $res = mysqli_query($con, $query);
                    $result = mysqli_fetch_array($res);
                    return $result[0];
                }

                //  Get Total Number Of Like And DisLikes For a Particular Review
                function getRatting($review_id)
                {
                    include('Admin/sections/db_connection.php');
                    $ratting = array();
                    $likes_query = "SELECT COUNT(*) FROM `rate` WHERE `review_id` = '$review_id' AND rating_action='like'";
                    $dislikes_query = "SELECT COUNT(*) FROM `rate` WHERE `review_id` = '$review_id' AND rating_action='dislike'";

                    $likes_res = mysqli_query($con, $likes_query);
                    $dislikes_res = mysqli_query($con, $dislikes_query);
                    $likes = mysqli_fetch_array($likes_res);
                    $dislikes = mysqli_fetch_array($dislikes_res);
                    $ratting = [
                        'likes' => $likes[0],
                        'dislikes' => $dislikes[0],
                    ];
                    return json_encode($ratting);
                }

                //  Get Total Number Of DisLikes For a Particular Review

                function getDisLikes($review_id)
                {
                    include('Admin/sections/db_connection.php');
                    $query = "SELECT COUNT(*) FROM `rate` WHERE `review_id` = '$review_id' AND rating_action='dislike'";
                    $res = mysqli_query($con, $query);
                    $result = mysqli_fetch_array($res);
                    return $result[0];
                }

                function checkTruOrFalse($review_user_id)
                {
                    if (!isset($_SESSION['id'])) {
                        return false;
                    } elseif ($review_user_id == $_SESSION['id']) {
                        return false;
                    }
                    return true;
                }

                include('connect.php');

                if (isset($_GET['id']))
                    $review_id = $_GET['id'];

                $sql = $con->prepare("SELECT e.*, u.`username`,u.`email` FROM `reviews` e INNER JOIN users u ON e.user_id = u.id AND e.`id`='$review_id'");
                $sql->execute();
                $result = $sql->fetchAll();
                $count = $sql->rowCount();
                if ($count > 0) {
                    foreach ($result as $row) {
                        $video = $row['video'];
                        $category_name = $row['category_name'];
                        $name = $row['name'];
                        $price = $row['price'];
                        $description = $row['description'];
                        $date_of_add = $row['date_of_add'];
                        $rate = $row['rate'];
                        $link = $row['link'];
                        $place_name = $row['place_name'];
                        $video = $row['video'];
                        $company_name = $row['company_name'];
                        $username = $row['username'];
                        $email = $row['email'];
                        $reviewId = $row['id'];
                        $image = $row['image'];
                        $review_user_id = $row['user_id'];
                    }
                }

                if ($count > 0) { ?>
                    <div class="row">
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-sm-8">
                                <img src="images/<?php echo $image ?>" style="width:800px; height:400px" alt="">
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <div style="margin-top:50px;margin-left: 111px;color:#5399f6">
                                    <div class="card-body text-center">
                                        <img src="images/avatar4.png" alt="avatar"
                                             class="rounded-circle img-fluid" style="width: 150px;">
                                        <h5 class="my-3"><?php echo $username ?></h5>
                                        <p class="text-muted mb-1"><?php echo $email ?></p>
                                        <p class="text-muted mb-4">Bay Area, San Francisco, CA</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div style="margin-left: 638px;margin-top: 16px;">


                            <!-- if user likes review , style button differently  -->
                            <i <?php if (userLiked($reviewId)): ?>
                                class="fa fa-thumbs-up  like-btn"
                            <?php else: ?>
                                class="fa fa-thumbs-o-up  like-btn"
                            <?php endif ?>
                                    data-id="<?php echo $reviewId ?>"
                                    style="font-size:40px;color: #0a53be;margin: 10px"
                                    aria-disabled="true"></i><span style="color: black;font-size:30px;" id="LikesCount"
                                                                   class="likes"><?php echo getLikes($reviewId); ?></span>
                            <!-- if user dislikes review , style button differently  -->
                            <i <?php if (userDisLiked($reviewId)): ?>
                                class="fa fa-thumbs-down fa-lg dislike-btn"
                            <?php else: ?>
                                class="fa fa-thumbs-o-down fa-lg dislike-btn"
                            <?php endif ?>
                                    style="font-size:40px;color: red;margin: 10px" data-id="<?php echo $reviewId ?>"
                                    aria-hidden="true">
                            <span style="color: black;font-size:30px;" class="dislikes" id="disLikesCount">
                                <?php echo getDisLikes($reviewId); ?>
                            </span></i>
                        </div>
                        <div class="col-lg-7 col-sm-6 col-md-6 col-12 pb-4">
                            <h3 style="margin-top: 20px"><?php echo $name ?></h3>
                            <p class="px-xl-3" style="margin-top: 40px"><?php echo $description ?>
                            </p>
                            <h4 style="margin-top: 83px; margin-bottom: 44px">All Details Of Review</h4>
                            <ul>
                                <h2>
                                    <li style="margin-bottom: 30px">Name Of Category :
                                        <span
                                                style="color:#5e8078;"><?php echo $category_name ?></span>
                                    </li>
                                    <h2>
                                        <li style="margin-bottom: 30px">Price Of Review: <span

                                                    style="color:#5e8078;"><?php echo $price ?></span>
                                        </li>
                                    </h2>
                                    <h2>
                                        <li style="margin-bottom: 30px">Date of Added Of Reviews : <span
                                                    style="color:#5e8078;"
                                            ><?php echo $date_of_add ?></span>
                                        </li>
                                    </h2>


                                    <h2>
                                        <li style="margin-bottom: 30px">Rate Of Review: <span style="color:#5e8078;"
                                            ><?php echo $rate ?>
                                                /5</span>
                                        </li>
                                    </h2>

                                    <h2>
                                        <li style="margin-bottom: 30px">Palace Of Review: <span style="color:#5e8078;"
                                            ><?php echo $place_name ?>
                                            </span>
                                        </li>
                                    </h2>

                                    <h2>
                                        <li style="margin-bottom: 30px">Link Of Review: <span style="color:#5e8078;"
                                            ><a
                                                        href="<?php echo $row['link'] ?>">Review link</a></span>

                                    </h2>

                                    <h2>
                                        <li style="margin-bottom: 30px">Company Name : <span style="color:#5e8078;"
                                            ><?php echo $company_name ?>
                                            </span>
                                        </li>
                                    </h2>

                                </h2>
                            </ul>
                        </div>
                        <div class="col-lg-5 col-md-6 col-sm-6" style="margin-top: 80px ">
                            <div>
                                <video width="550px" height="600" controls>
                                    <source src="images/videos/<?php echo $video ?>" type="video/mp4">
                                </video>
                            </div>
                        </div>
                    </div>
                    <?php
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
                    &copy; Copyright <span><span>Review</span></span>. All Rights Reserved
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
    <script>
        $(document).ready(function () {

            var x = <?php echo checkTruOrFalse($review_user_id);?> ;
            console.log(x);
            if (x == true) {
                // If User Click On the Like Button
                $('.like-btn').on('click', function () {
                    var review_id = $(this).data('id');
                    $clicked_btn = $(this);
                    if ($clicked_btn.hasClass('fa-thumbs-o-up')) {
                        action = 'like';

                    } else if ($clicked_btn.hasClass('fa-thumbs-up')) {
                        action = 'unlike';
                    }
                    $.ajax({
                        url: 'details_reviews.php',
                        type: 'post',
                        data: {
                            'action': action,
                            'review_id': review_id
                        },
                        success: function (data) {
                            console.log(JSON.parse(JSON.stringify(data)));
                            res = JSON.parse(JSON.stringify(data));
                            let likesCount = parseInt($('#LikesCount').html());
                            if (action === "like") {
                                $clicked_btn.removeClass('fa-thumbs-o-up');
                                $clicked_btn.addClass('fa-thumbs-up');
                                $('#LikesCount').html((likesCount + 1));
                            } else if (action === "unlike") {
                                console.log(data);
                                $clicked_btn.removeClass('fa-thumbs-up');
                                $clicked_btn.addClass('fa-thumbs-o-up');
                                $('#LikesCount').html((likesCount - 1));
                            }
                            //  display the number of like and dislikes
                            $clicked_btn.siblings('span.likes').text(res.likes);
                            $clicked_btn.siblings('span.dislikes').text(res.dislikes);

                            // changing button  styling of the other button if user  reacting the second time to reviews
                            $clicked_btn.siblings('i.fa-thumbs-down').removeClass('fa-thumbs-down').addClass('fa-thumbs-o-down');
                            window.location.reload();

                            // $('#likesCount').html(likesCount);
                        }
                    });
                });

                // If User Click On the disLike Button
                $('.dislike-btn').on('click', function () {
                    var review_id = $(this).data('id');
                    $clicked_btn = $(this);

                    if ($clicked_btn.hasClass('fa-thumbs-o-down')) {
                        action = 'dislike';
                    } else if ($clicked_btn.hasClass('fa-thumbs-down')) {
                        action = 'undislike';
                    }
                    $.ajax({
                        url: 'details_reviews.php',
                        type: 'post',
                        data: {
                            'action': action,
                            'review_id': review_id
                        },
                        success: function (data) {
                            res = JSON.parse(JSON.stringify(data));
                            let disLikesCount = parseInt($('#disLikesCount').html());
                            if (action == "dislike") {
                                console.log(data);
                                $clicked_btn.removeClass('fa-thumbs-o-down');
                                $clicked_btn.addClass('fa-thumbs-down');
                                // getDislikeCount(review_id);
                                $('#disLikesCount').html((disLikesCount + 1));
                            } else if (action == "undislike") {
                                console.log(data);
                                $clicked_btn.removeClass('fa-thumbs-down');
                                $clicked_btn.addClass('fa-thumbs-o-down');
                                $('#disLikesCount').html((disLikesCount - 1));
                            }
                            //  display the number of like and dislikes
                            $clicked_btn.siblings('span.likes').text(res.likes);
                            $clicked_btn.siblings('span.dislike').text(res.dislike);

                            // changing button  styling of the other button if user  reacting the second time to reviews
                            $clicked_btn.siblings('i.fa-thumbs-up').removeClass('fa-thumbs-up').addClass('fa-thumbs-o-up');
                            window.location.reload();

                        }
                    });
                });
            }


        })

    </script>
    </body>
    </html>
<?php
ob_end_flush();
?>