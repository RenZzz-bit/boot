<?php
include('login/admin/db.php');

 // Set the number of articles per page
 $articlesPerPage = 3; // We are displaying 3 articles per row as per your layout

 // Get the total number of articles
 $sqlCount = "SELECT COUNT(*) FROM news";
 $resultCount = $conn->query($sqlCount);
 $totalArticles = $resultCount->fetch_row()[0];
 
 // Calculate the total number of pages
 $totalPages = ceil($totalArticles / $articlesPerPage);
 
 // Get the current page from the URL, default to 1 if not set
 $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
 
 // Calculate the offset for the SQL query
 $offset = ($currentPage - 1) * $articlesPerPage;
 
 // Fetch articles for the current page
 $sql = "SELECT * FROM news ORDER BY created_at DESC LIMIT $offset, $articlesPerPage";
 $result = $conn->query($sql);
 ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Kaagapay-Home</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Ubuntu:wght@500;700&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<style>
    /* Set a fixed height for the image container */
.case-item {
    position: relative;
    overflow: hidden;
    border-radius: 5px;
    height: 300px; /* You can adjust this value */
    display: flex;
    justify-content: center;
}

/* Make the image fill the container, while maintaining its aspect ratio */
.case-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* Optional: Set a fixed size for the text content area to ensure consistency */
.case-overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    padding: 15px;
    background: rgba(0, 0, 0, 0.6);
    color: white;
}
.pagination {
    display: flex; /* Use flexbox for inline layout */
    justify-content: center; /* Center the pagination buttons */
}

.pagination-btn {
    margin-right: 10px; /* Add space between buttons */
}

.pagination-btn:last-child {
    margin-right: 0; /* Remove margin from the last button */
}


</style>

<body>
    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->


    <!-- Navbar Start -->
    <div class="container-fluid sticky-top" >
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-dark p-0">
                <a href="index.php" class="navbar-brand">
                    <h1 class="text-black" style="color: #FF5733;"></span>KAAGAPAY</h1>
                </a>
                <button type="button" class="navbar-toggler ms-auto me-0" data-bs-toggle="collapse" 
                    data-bs-target="#navbarCollapse" style="color: #FF5733;">
                    <span class="navbar-toggler-icon" ></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse" >
                    <div class="navbar-nav ms-auto">
                    <a href="index.php" class="nav-item nav-link active" style="color: #FF5733;">Home</a>
                        <a href="about.php#about" class="nav-item nav-link" style="color: #FF5733;">About</a>
                        <a href="hotline.php#hotlines" class="nav-item nav-link" style="color: #FF5733;">Hotlines</a>
                        <a href="index.php#news" class="nav-item nav-link" style="color: #FF5733;">News</a>
                        <a href="fb/login.php" class="nav-item nav-link" style="color: #FF5733;">Login</a>
                        <!-- <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" style="color: #FF5733;">LogIn</a>
                            <div class="dropdown-menu bg-light mt-2">
                                <a href="login/admin.html" class="dropdown-item" style="color: #FF5733;">Admin</a>
                                <a href="fb/login.php" class="dropdown-item" style="color: #FF5733;">User</a>
                            </div>
                        </div> -->
                    </div>
                    <!-- <butaton type="button" class="btn text-white p-0 d-none d-lg-block" data-bs-toggle="modal"
                        data-bs-target="#searchModal"><i class="fa fa-search"></i></butaton> -->
                </div>
            </nav>
        </div>
    </div>
    <!-- Navbar End -->


    <!-- Hero Start -->
    <div class="container-fluid pt-5 hero-header mb-5" style="background-color: #F3E5AB">
        <div class="container pt-5">
            <div class="row g-5 pt-5">
                <div class="col-lg-6 align-self-center text-center text-lg-start mb-lg-5">
                    <div class="btn btn-sm border rounded-pill  px-3 mb-3 animated slideInRight" style="color: #FF5733;">KAAGAPAY</div>
                    <h1 class="display-4  mb-4 animated slideInRight" style="color: #FF5733;">Bridging OFW across the world</h1>
                    <p class=" mb-4 animated slideInRight" style="color: #FF5733;">KAAGAPAY provides a unified platform where Overseas Filipino Workers (OFWs) can find essential resources, support, and a sense of community, no matter where they are in the world.</p>
                    <a href="fb/login.php" class="btn btn-light py-sm-3 px-sm-5 rounded-pill me-3 animated slideInRight" style="color: #FF5733;">Join Now</a>
                    <!-- <a href="" class="btn btn-outline-light py-sm-3 px-sm-5 rounded-pill animated slideInRight">Contact Us</a> -->
                </div>
                <div class="col-lg-6  text-center text-lg-end">
                    <img class="img-fluid" src="img/logohp.png" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- Hero End -->


    <!-- Full Screen Search Start -->
    <div class="modal fade" id="searchModal" tabindex="-1">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content" style="background: white;">
                <div class="modal-header border-0">
                    <button type="button" class="btn btn-square bg-white btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex align-items-center justify-content-center">
                    <div class="input-group" style="max-width: 600px;">
                        <input type="text" class="form-control bg-transparent border-light p-3"
                            placeholder="Type search keyword">
                        <button class="btn btn-light px-4"><i class="bi bi-search"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Full Screen Search End -->


    <!-- about Kaagapay -->
    <div class="container-fluid mt-5 py-5" style="background-color: #FFFFFF">
        <div class="container py-5">
            <div class="row g-5 align-items-center">
                <div class="col-lg-5 wow fadeIn" data-wow-delay="0.1s">
                    <!-- <div class="btn btn-sm border rounded-pill px-3 mb-3" style="color: #FF5733;">About Kaagapay</div> -->
                    <h1 class=" mb-4" style="color: #FF5733;">About Kaagapay</h1>
                    <p class=" mb-4"style="color: #FF5733;">KAAGAPAY is a web-based platform designed to connect and support overseas Filipino workers (OFWs). It offers resources for legal aid, emergency assistance, and important news while enabling users to interact and share experiences. The platform fosters a 
                        safe and accessible environment where OFWs can connect, access vital information, and support each other.</p>
                    <!-- <a class="btn rounded-pill px-4" href="" style="bg-color: #FF5733;">Read More</a> -->
                </div>
                <div class="col-lg-7">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="row g-4">
                                <div class="col-12 wow fadeIn" data-wow-delay="0.1s">
                                    <div class="service-item d-flex flex-column justify-content-center text-center rounded">
                                        <div class="service-icon btn-square">
                                            <i class="fa fa-heart fa-2x" style="color: #FF5733;"></i>
                                        </div>
                                        <h5 class="mb-3">Connecting and Supporting OFWs</h5>
                                        <p>KAAGAPAY is a comprehensive web-based platform specifically designed to connect and support overseas Filipino workers (OFWs), providing essential resources such as legal aid, emergency assistance, and up-to-date news.</p>
                                        <a class="btn px-3 mt-auto mx-auto" href="" style="color: #FF5733;">Read More</a>
                                    </div>
                                </div>
                                <div class="col-12 wow fadeIn" data-wow-delay="0.5s">
                                    <div class="service-item d-flex flex-column justify-content-center text-center rounded">
                                        <div class="service-icon btn-square">
                                            <i class="fa fa-heart fa-2x" style="color: #FF5733;"></i>
                                        </div>
                                        <h5 class="mb-3">Community Interaction</h5>
                                        <p>Through KAAGAPAY, users can interact and share experiences, fostering a supportive community among OFWs.</p>
                                        <a class="btn px-3 mt-auto mx-auto" href="" style="color: #FF5733;">Read More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 pt-md-4">
                            <div class="row g-4">
                                <div class="col-12 wow fadeIn" data-wow-delay="0.3s">
                                    <div class="service-item d-flex flex-column justify-content-center text-center rounded">
                                        <div class="service-icon btn-square">
                                            <i class="fa fa-heart fa-2x" style="color: #FF5733;"></i>
                                        </div>
                                        <h5 class="mb-3">Safe and Accessible Environment</h5>
                                        <p>The platform provides a safe and accessible environment where OFWs can access vital information and support each other.</p>
                                        <a class="btn px-3 mt-auto mx-auto" href="" style="color: #FF5733;">Read More</a>
                                    </div>
                                </div>
                                <div class="col-12 wow fadeIn" data-wow-delay="0.7s">
                                    <div class="service-item d-flex flex-column justify-content-center text-center rounded">
                                        <div class="service-icon btn-square">
                                            <i class="fa fa-heart fa-2x" style="color: #FF5733;"></i>
                                        </div>
                                        <h5 class="mb-3">Empowering OFWs</h5>
                                        <p>KAAGAPAY ensures that OFWs have the tools and resources they need to navigate challenges and stay connected with their community.</p>
                                        <a class="btn px-3 mt-auto mx-auto" href="" style="color: #FF5733;">Read More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->

   

<!-- News Start -->
<div class="container-fluid bg-light py-5" id="news">
    <div class="container py-5">
        <div class="mx-auto text-center wow fadeIn" data-wow-delay="0.1s" style="max-width: 500px;">
            <div class="btn btn-sm border rounded-pill text-dark px-3 mb-3">News:</div>
            <h1 class="mb-4" style="color: #FF5733;">Latest News</h1>
        </div>
        <div class="row g-4">
            <?php
            if ($result->num_rows > 0) {
                // Loop through articles
                while ($row = $result->fetch_assoc()) {
                    // Sanitize and display each article
                    $title = htmlspecialchars($row['title']);
                    $content = nl2br(htmlspecialchars($row['content']));
                    $image = $row['image'] ? 'login/admin/assets/' . htmlspecialchars($row['image']) : 'assets/default.jpg'; // Fallback image
                    $articleLink = "login/admin/article.php?id=" . $row['id']; // Link to individual article page (if applicable)
            
                    echo '<div class="col-lg-4 wow fadeIn" data-wow-delay="0.3s">';
                    echo '<div class="case-item position-relative overflow-hidden rounded mb-2">';
                    echo '<img class="img-fluid" src="' . $image . '" alt="">';
                    echo '<a class="case-overlay text-decoration-none" href="' . $articleLink . '" target="_blank">';  // Add target="_blank" here
                    echo '<small>' . date('F j, Y', strtotime($row['created_at'])) . '</small>';
                    echo '<h5 class="lh-base text-white mb-3">' . $title . '</h5>';
                    echo '<span class="btn btn-square btn-primary"><i class="fa fa-arrow-right"></i></span>';
                    echo '</a>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo '<h3 style="text-align: center;">No articles published yet.</h3>';
            }
            
            ?>
        </div>
         <!-- Pagination Links -->
            <div class="pagination text-center mt-4">
                <?php
                for ($page = 1; $page <= $totalPages; $page++) {
                    echo "<a href='?page=$page index.php#news' class='btn btn-primary btn-sm pagination-btn'>$page</a>";
                }
                ?>
            </div>

    </div>
</div>
<!-- News End -->


    <!-- FAQs Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="mx-auto text-center wow fadeIn" data-wow-delay="0.1s" style="max-width: 500px;">
                <div class="btn btn-sm border rounded-pill text-dark px-3 mb-3">Popular FAQs</div>
                <h1 class="mb-4" style="color: #FF5733;">Frequently Asked Questions</h1>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="accordion" id="accordionFAQ1">
                        <div class="accordion-item wow fadeIn" data-wow-delay="0.1s">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                    How to use KAAGAPAY?
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
                                data-bs-parent="#accordionFAQ1">
                                <div class="accordion-body">
                                KAAGAPAY is user-friendly and easy to navigate. Simply sign up, complete your profile, and start exploring the resources available for OFWs, emergency assistance, and community forums.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item wow fadeIn" data-wow-delay="0.2s">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    What services does KAAGAPAY offer?
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                data-bs-parent="#accordionFAQ1">
                                <div class="accordion-body">
                                KAAGAPAY offers a range of services including news updates, and a community platform for OFWs to interact and share experiences."
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item wow fadeIn" data-wow-delay="0.3s">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Is KAAGAPAY free to use?
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                                data-bs-parent="#accordionFAQ1">
                                <div class="accordion-body">
                                Yes, KAAGAPAY is completely free for all OFWs. We aim to provide essential support and resources without any cost.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item wow fadeIn" data-wow-delay="0.4s">
                            <h2 class="accordion-header" id="headingFour">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                                    Can I connect with other OFWs on KAAGAPAY?
                                </button>
                            </h2>
                            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                                data-bs-parent="#accordionFAQ1">
                                <div class="accordion-body">
                                    Absolutely! KAAGAPAY is designed to foster a community where OFWs can connect, share experiences, and support each other.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="accordion" id="accordionFAQ2">
                        <div class="accordion-item wow fadeIn" data-wow-delay="0.5s">
                            <h2 class="accordion-header" id="headingFive">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                    How do I get legal assistance through KAAGAPAY?
                                </button>
                            </h2>
                            <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive"
                                data-bs-parent="#accordionFAQ2">
                                <div class="accordion-body">
                                KAAGAPAY provides access to legal resources and contacts. You can find information and support for various legal issues you might face as an OFW.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item wow fadeIn" data-wow-delay="0.6s">
                            <h2 class="accordion-header" id="headingSix">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                    How do I stay updated with news on KAAGAPAY?
                                </button>
                            </h2>
                            <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix"
                                data-bs-parent="#accordionFAQ2">
                                <div class="accordion-body">
                                KAAGAPAY features a news section that provides the latest updates relevant to OFWs. You can access important news, announcements, and advisories directly from the platform.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item wow fadeIn" data-wow-delay="0.7s">
                            <h2 class="accordion-header" id="headingSeven">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                                    What kind of support can I expect from the KAAGAPAY community?
                                </button>
                            </h2>
                            <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven"
                                data-bs-parent="#accordionFAQ2">
                                <div class="accordion-body">
                                    The KAAGAPAY community offers peer support, advice, and shared experiences. You can ask questions, share your story, and receive encouragement from fellow OFWs.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item wow fadeIn" data-wow-delay="0.8s">
                            <h2 class="accordion-header" id="headingEight">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                                    Is my personal information safe on KAAGAPAY?
                                </button>
                            </h2>
                            <div id="collapseEight" class="accordion-collapse collapse" aria-labelledby="headingEight"
                                data-bs-parent="#accordionFAQ2">
                                <div class="accordion-body">
                                Yes, KAAGAPAY takes privacy and security seriously. We ensure that your personal information is protected and only accessible to you and authorized personnel.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- FAQs Start -->


    <!-- Footer Start -->
    <div class="container-fluid text-white-50 footer pt-5" style="background-color: #F3E5AB">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.1s">
                    <a href="index.php" class="d-inline-block mb-3">
                        <h1 class="" style="color: #FF5733;">KAA<span class="text-primary"></span>GAPAY</h1>
                    </a>
                    <p class="mb-0" style="color: #FF5733;">is a web-based platform that supports overseas Filipino workers (OFWs) by providing legal aid, emergency assistance, news, and a safe space to connect and share experiences.</p>
                </div>
                <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.3s">
                    <h5 class="text-white mb-4" style="color: #FF5733;">Get In Touch</h5>
                    <p style="color: #808080;"><i class="fa fa-map-marker-alt me-3"></i>123 Street, New York, USA</p>
                    <p style="color: #808080;"><i class="fa fa-phone-alt me-3" ></i>+012 345 67890</p>
                    <p style="color: #808080    ;"><i class="fa fa-envelope me-3" ></i>info@example.com</p>
                    <div class="d-flex pt-2">
                        <a class="btn btn-outline-light btn-social" href="" style="color: #FF5733;"><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-outline-light btn-social" href="" style="color: #FF5733;"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-outline-light btn-social" href="" style="color: #FF5733;"><i class="fab fa-youtube"></i></a>
                        <a class="btn btn-outline-light btn-social" href="" style="color: #FF5733;"><i class="fab fa-instagram"></i></a>
                        <a class="btn btn-outline-light btn-social" href="" style="color: #FF5733;"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.5s">
                    <h5 class="text-white mb-4" style="color: #FF5733;">Popular Link</h5>
                    <a class="btn btn-link" href="">About Us</a>
                    <a class="btn btn-link" href="">Contact Us</a>
                    <a class="btn btn-link" href="">Privacy Policy</a>
                    <a class="btn btn-link" href="">Terms & Condition</a>
                    <!-- <a class="btn btn-link" href="">Career</a> -->
                </div>
                <!-- <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.7s">
                    <h5 class="text-white mb-4" style="color: #FF5733;">Our Services</h5>
                    <a class="btn btn-link" href="">R diam i</a>
                    <a class="btn btn-link" href="">stet no </a>
                    <a class="btn btn-link" href="">o labore l</a>
                    <a class="btn btn-link" href="">lorem sit</a>
                    <a class="btn btn-link" href=""> ipsum et</a>
                </div> -->
            </div>
        </div>
        <div class="container wow fadeIn" data-wow-delay="0.1s">
            <div class="copyright">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0" style="color: #FF5733;">
                        &copy; <a class="border-bottom" href="#" style="color: #FF5733;">KAAGAPAY, All Right Reserved.</a>

                        <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***
                        Designed By <a class="border-bottom" href="https://htmlcodex.com">HTML Codex</a> Distributed By <a class="border-bottom" href="https://themewagon.com">ThemeWagon</a>-->
                    </div> 
                    <div class="col-md-6 text-center text-md-end">
                        <div class="footer-menu">
                            <a href="" style="color: #FF5733;">Home</a>
                            <a href="" style="color: #FF5733;">Cookies</a>
                            <a href="" style="color: #FF5733;">Help</a>
                            <a href="" style="color: #FF5733;">FAQs</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-lg-square back-to-top pt-2" style="background-color: #FF5733;"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>