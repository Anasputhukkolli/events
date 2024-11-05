<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if the user is logged in
$is_logged_in = isset($_SESSION['username']);
?>

<div id="about" class="about_area black_bg text-white py-5">
    <div class="container">
        <!-- Section Title -->
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section_title text-center mb-5">
                    <h3 class="wow fadeInRight" data-wow-duration="1s" data-wow-delay=".3s">About Our College Event</h3>
                    <p class="wow fadeInRight" data-wow-duration="1s" data-wow-delay=".4s">
                        Join us for a day filled with exciting activities, networking opportunities, and inspiring talks. Our event draws students, faculty, and professionals from diverse backgrounds, all eager to share ideas and build connections.
                    </p>
                </div>
            </div>
        </div>
        <!-- Main Content -->
        <div class="row align-items-center">
            <!-- Image Section -->
            <div class="col-lg-7 col-md-6">
                <div class="about_thumb">
                    <div class="shap_3 wow fadeInLeft" data-wow-duration="1s" data-wow-delay=".4s">
                        <img src="img/shape/shape_3.svg" alt="Background Shape" class="img-fluid">
                    </div>
                    <div class="thumb_inner wow fadeInUp" data-wow-duration="1s" data-wow-delay=".3s">
                        <img src="uploads/4.jpg" alt="College Event Image" class="img-fluid">
                    </div>
                </div>
            </div>
            <!-- Information Section -->
            <div class="col-lg-5 col-md-6">
                <div class="about_info pl-3">
                    <h4 class="wow fadeInLeft" data-wow-duration="1s" data-wow-delay=".5s">Reserve Your Spot Now!</h4>
                    <p class="wow fadeInLeft" data-wow-duration="1s" data-wow-delay=".6s">
                        Experience a variety of workshops, speaker sessions, and networking opportunities designed to empower students and enhance professional development. Don’t miss out on this transformative event!
                    </p>
                    <?php if (!$is_logged_in): ?>
                        <a href="login.php" class="btn boxed-btn2 wow fadeInLeft" data-wow-duration="1s" data-wow-delay=".7s">Register Now</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Required JS and CSS for WOW Animations -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
<script>
    // Initialize WOW.js
    new WOW().init();
</script>
