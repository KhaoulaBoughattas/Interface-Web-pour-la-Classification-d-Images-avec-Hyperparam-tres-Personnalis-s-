<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: index.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <title>KR Image Classification</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Classification of images with custom hyperparameters" name="description">

    <!-- Google Web Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    
</head>
<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->
    
    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4 py-3">
    <a href="index.html" class="navbar-brand p-0">
            <img src="img/k-removebg-preview.png" alt="Logo" id="navbar-logo" width="30" height="auto">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a href="services.php" class="nav-link active">Services</a></li>
                <li class="nav-item"><a href="#dashboard" class="nav-link">Dashboard</a></li>
                <li class="nav-item"><a href="#feature" class="nav-link active">features</a></li>
                <li class="nav-item"><a href="logout.php" class="btn btn-danger">Logout</a></li>
            </ul>
        </div>
    </nav>
    <!-- Navbar End -->

    <!-- Hero Section -->
    <div class="container-fluid bg-primary py-5 text-center text-white">
        <h1 class="display-4">Welcome, <?= htmlspecialchars($_SESSION['user_name']); ?>!</h1>
        <p class="lead">Explore our premium image classification services tailored just for you.</p>
    </div>
<br>
<br>
<br>
<br>
<br>
<br>
  <!-- Services Section Start -->
<div class="container my-5">
    <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 900px;">
        <h4 class="mb-1 text-primary">Our Service</h4>
        <h1 class="display-5 mb-4">What We Can Do For You</h1>
        <p class="mb-0">We offer a variety of services to enhance your image classification experience, from uploading images to customizing hyperparameters.</p>
    </div>
    <!-- Row for service items -->
    <div class="row d-flex justify-content-center">
        <!-- Image Upload Service -->
        <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.1s">
            <div class="service-item text-center rounded p-4">
                <div class="service-icon d-inline-block bg-light rounded p-4 mb-4">
                    <i class="fas fa-image fa-5x text-secondary"></i>
                </div>
                <div class="service-content">
                    <h4 class="mb-4">Image Upload</h4>
                    <p class="mb-4">Easily upload images for classification with just a few clicks.</p>
                    <!--<a href="chooseimg.html" class="btn btn-primary">Get Started</a>-->
                </div>
            </div>
        </div>
        <!-- Hyperparameter Tuning -->
        <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.3s">
            <div class="service-item text-center rounded p-4">
                <div class="service-icon d-inline-block bg-light rounded p-4 mb-4">
                    <i class="fas fa-cogs fa-5x text-secondary"></i>
                </div>
                <div class="service-content">
                    <h4 class="mb-4">Hyperparameter Tuning</h4>
                    <p class="mb-4">Customize your model's settings to get the best results for your images.</p>
                    <!--<a href="parametresimg.html" class="btn btn-primary">Customize</a>-->
                </div>
            </div>
        </div>
        <!-- Process and Analyze Images -->
        <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.5s">
            <div class="service-item text-center rounded p-4">
                <div class="service-icon d-inline-block bg-light rounded p-4 mb-4">
                    <i class="fas fa-play-circle fa-5x text-secondary"></i>
                </div>
                <div class="service-content">
                    <h4 class="mb-4">Process Images</h4>
                    <p class="mb-4">Run the classification process and view results in real-time.</p>
                    <!-- Button to trigger processing -->
                    <form method="post" action="process_images.php">
                        <!--<button type="submit" class="btn btn-primary">Start Processing</button>-->
                    </form>
                </div>
            </div>
            
        </div>
        <a href="parametresimg.html" class="btn btn-primary btn-small-width">Customize</a>

    </div>
    
</div>
<!-- Services Section End -->

<br>
<br>
<br>
<br>
<br>
<!-- Include Chart.js for any chart visualizations -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- Dashboard Section Start -->
<div class="container my-5" id="dashboard">
    <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 900px;">
        <h4 class="mb-1 text-primary">Dashboard</h4>
        <h1 class="display-5 mb-4">Overview of Your Image Classification Process</h1>
        <p class="mb-0">Here you can monitor your model's performance, review the classification results, and visualize key metrics.</p>
    </div>

    <!-- Row for Dashboard Stats and Visualizations -->
    <div class="row g-4">
        <!-- Model Accuracy Graph -->
        <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.1s">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h5 class="card-title">Model Accuracy</h5>
                    <img src="generate_graphs.php?type=accuracy" alt="Model Accuracy Graph" class="img-fluid mb-4">
                    <p>Real-time accuracy chart based on the model training process.</p>
                </div>
            </div>
        </div>

        <!-- Model Loss Graph -->
        <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.3s">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h5 class="card-title">Model Loss</h5>
                    <img src="generate_graphs.php?type=loss" alt="Model Loss Graph" class="img-fluid">
                    <p>Track the model loss during the training process.</p>
                </div>
            </div>
        </div>

        <!-- Classification Results -->
        <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.5s">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title text-center">Recent Predictions</h5>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Predicted Class</th>
                                <th>Confidence</th>
                            </tr>
                        </thead>
                        <tbody id="results-table">
                            <?php
                            if (file_exists('results.json')) {
                                $results = json_decode(file_get_contents('results.json'), true);
                                foreach ($results as $image => $data) {
                                    echo "<tr>
                                            <td>{$image}</td>
                                            <td>{$data['Predicted Class']}</td>
                                            <td>" . number_format($data['Confidence'] * 100, 2) . "%</td>
                                          </tr>";
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                    <a href="download_results.php" class="btn btn-primary">Download Results</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Dashboard Section End -->

    <!-- Feature Start -->
    <div class="container-fluid feature overflow-hidden py-5"id="feature">
        <div class="container py-5">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 900px;">
                <h4 class="text-primary">Our Features</h4>
                <h1 class="display-5 mb-4">Key Features for Image Classification</h1>
                <p class="mb-0">Our platform provides essential features to enhance your image classification experience.</p>
            </div>
            <div class="row g-4 justify-content-center text-center mb-5">
                <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="text-center p-4">
                        <div class="d-inline-block rounded bg-light p-4 mb-4"><i class="fas fa-image fa-5x text-secondary"></i></div>
                        <div class="feature-content">
                            <a href="highaccuracy.html" class="h4">High Accuracy <i class="fa fa-long-arrow-alt-right"></i></a>
                            <p class="mt-4 mb-0">Our classification algorithms ensure high accuracy in identifying images.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="text-center p-4">
                        <div class="d-inline-block rounded bg-light p-4 mb-4"><i class="fas fa-cogs fa-5x text-secondary"></i></div>
                        <div class="feature-content">
                            <a href="customizableparameters.html" class="h4">Customizable Parameters <i class="fa fa-long-arrow-alt-right"></i></a>
                            <p class="mt-4 mb-0">Easily customize hyperparameters to suit your classification needs.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="text-center p-4">
                        <div class="d-inline-block rounded bg-light p-4 mb-4"><i class="fas fa-chart-line fa-5x text-secondary"></i></div>
                        <div class="feature-content">
                            <a href="realtimeanalytics.html" class="h4">Real-time Analytics <i class="fa fa-long-arrow-alt-right"></i></a>
                            <p class="mt-4 mb-0">Get instant feedback and analytics on your classification results.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="text-center p-4">
                        <div class="d-inline-block rounded bg-light p-4 mb-4"><i class="fas fa-users fa-5x text-secondary"></i></div>
                        <div class="feature-content">
                            <a href="communitysupport.html" class="h4">Community Support <i class="fa fa-long-arrow-alt-right"></i></a>
                            <p class="mt-4 mb-0">Join a community of users to share tips and insights on image classification.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Feature End -->

    <!-- FAQ Start -->
    <div class="container-fluid FAQ bg-light overflow-hidden py-5">
        <div class="container py-5">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6 wow fadeInLeft" data-wow-delay="0.1s">
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item border-0 mb-4">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button rounded-top" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseTOne">
                                    Why choose our Image Classification service?
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body my-2">
                                    <h5>We simplify your image classification tasks.</h5>
                                    <p>Our platform is designed to make image classification easier for everyone. With intuitive controls and real-time feedback, you can quickly classify your images and analyze the results.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item border-0 mb-4">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed rounded-top" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Are there any hidden charges? 
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                <div class="accordion-body my-2">
                                    <h5>No hidden charges.</h5>
                                    <p>We believe in transparency. Our pricing plans are clear, and we provide full details upfront to help you make informed decisions.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item border-0">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed rounded-top" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    What are the key challenges of image classification?
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                <div class="accordion-body my-2">
                                    <h5>Common challenges include data quality and model selection.</h5>
                                    <p>Choosing the right model and ensuring the quality of your input data are crucial for successful image classification. Our service helps guide you through these challenges.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInRight" data-wow-delay="0.3s">
                    <div class="FAQ-img RotateMoveRight rounded">
                        <img src="img/about-1.png" class="img-fluid w-100" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- FAQ End -->

    <div class="col-12 wow fadeInUp" data-wow-delay="0.1s">
        <div class="rounded h-100">
            <iframe class="rounded w-100" 
            style="height: 500px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d387191.33750346623!2d-73.97968099999999!3d40.6974881!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew%20York%2C%20NY%2C%20USA!5e0!3m2!1sen!2sbd!4v1694259649153!5m2!1sen!2sbd" 
            loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
    
    <!-- Footer Start -->
    <div class="container-fluid footer bg-dark text-light py-5 wow fadeIn" data-wow-delay="0.2s">
        <div class="container py-5">
            <div class="row g-5">
                <!-- About Section -->
                <div class="col-md-6 col-lg-3">
                    <div class="footer-item">
                        <h4 class="text-white mb-4">About KR Image Classification</h4>
                        <p>KR Image Classification provides users a seamless experience for classifying images with customizable hyperparameters. Our platform allows easy adjustments to machine learning models and delivers accurate results in real-time.</p>
                        <a href="about.html" class="text-light">Learn more about us <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
                
                <!-- Quick Links -->
                <div class="col-md-6 col-lg-3">
                    <div class="footer-item">
                        <h4 class="text-white mb-4">Quick Links</h4>
                        <ul class="list-unstyled">
                            <li><a href="index.html" class="text-light"><i class="fas fa-chevron-right me-2"></i>Home</a></li>
                            <li><a href="index.html#about" class="text-light"><i class="fas fa-chevron-right me-2"></i>About Us</a></li>
                            <li><a href="parametresimg.html" class="text-light"><i class="fas fa-chevron-right me-2"></i>Set Parameters</a></li>
                            <li><a href="#results" class="text-light"><i class="fas fa-chevron-right me-2"></i>View Results</a></li>
                            <li><a href="pricing.html" class="text-light"><i class="fas fa-chevron-right me-2"></i>Pricing</a></li>
                            <li><a href="blog.html" class="text-light"><i class="fas fa-chevron-right me-2"></i>Blog</a></li>
                            <li><a href="contact.html" class="text-light"><i class="fas fa-chevron-right me-2"></i>Contact Us</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Services -->
                <div class="col-md-6 col-lg-3">
                    <div class="footer-item">
                        <h4 class="text-white mb-4">Our Services</h4>
                        <ul class="list-unstyled">
                            <li><a href="#services" class="text-light"><i class="fas fa-chevron-right me-2"></i>Image Classification</a></li>
                            <li><a href="#services" class="text-light"><i class="fas fa-chevron-right me-2"></i>Hyperparameter Tuning</a></li>
                            <li><a href="#services" class="text-light"><i class="fas fa-chevron-right me-2"></i>Real-time Results</a></li>
                            <li><a href="#services" class="text-light"><i class="fas fa-chevron-right me-2"></i>Performance Metrics</a></li>
                            <li><a href="#services" class="text-light"><i class="fas fa-chevron-right me-2"></i>Data Analysis</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Contact Info -->
                <div class="col-md-6 col-lg-3">
                    <div class="footer-item">
                        <h4 class="text-white mb-4">Contact Info</h4>
                        <p><i class="fa fa-map-marker-alt me-2"></i>Enetcom, Ons City, Sfax, Tunisia</p>
                        <p><i class="fas fa-envelope me-2"></i> KR_Image_Classification@gmail.com</p>
                        <p><i class="fas fa-phone me-2"></i> +216 21 325 548</p>
                        <p><i class="fas fa-print me-2"></i> +216 21 325 548</p>
                        
                        <!-- Social Media Links -->
                        <div class="d-flex mt-4">
                            <a class="btn-square btn btn-light rounded-circle mx-1" href="https://www.facebook.com/"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn-square btn btn-light rounded-circle mx-1" href="https://twitter.com/"><i class="fab fa-twitter"></i></a>
                            <a class="btn-square btn btn-light rounded-circle mx-1" href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a>
                            <a class="btn-square btn btn-light rounded-circle mx-1" href="https://www.linkedin.com/"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Newsletter Subscription -->
            <div class="row mt-5">
                <div class="col-lg-6">
                    <h4 class="text-white mb-4">Subscribe to our Newsletter</h4>
                    <p>Stay updated with the latest news and updates about KH Image Classification.</p>
                </div>
                <div class="col-lg-6">
                    <form class="input-group">
                        <input type="email" class="form-control p-3" placeholder="Your Email" required>
                        <button class="btn btn-primary px-4">Subscribe</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->

    <!-- Copyright Start -->
    <div class="container-fluid copyright py-4" style="background-color: #212529;">
        <div class="container text-white">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start">
                    <p class="mb-0">&copy; <a href="#" class="text-white">KH Image Classification</a>, All rights reserved.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <p class="mb-0">Designed by <a href="#" class="text-white">Your Name</a></p>
                </div>
            </div>
        </div>
    </div>
    <!-- Copyright End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-primary btn-lg-square back-to-top"><i class="fa fa-arrow-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/lightbox/js/lightbox.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
