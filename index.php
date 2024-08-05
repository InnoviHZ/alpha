<?php
include "./assets/include/config.php";

?>

<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>OrphaCare - Empowering Orphans, Changing Lives</title>
<link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;500;700;900&family=Public+Sans:wght@400;500;700;900&display=swap">
<link rel="icon" type="image/x-icon" href="data:image/x-icon;base64,">
<!-- <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script> -->
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
<!-- Google Fonts - Roboto -->
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;500;700;900&family=Public+Sans:wght@400;500;700;900&display=swap">
<link rel="favicon" href="./assets/images/logo/logo1.svg" href="data:image/x-icon;base64,">
<link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>
    <?php include "./assets/include/header.php" ?>

    <!-- Hero Section -->
    <header class="hero text-center">
        <div class="container">
            <h1 class="display-4 fw-bold mb-4 text-[#333]">Empowering Orphans, Changing Lives</h1>
            <p class="lead mb-4 text-[#333]">Join us in our mission to provide care, support, and opportunities for orphans and vulnerable children</p>
            <a href="#contact" class="btn btn-primary btn-lg z-0">Get Involved</a>
        </div>
        <!--Waves Container-->
        <div class="z-n1">
            <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
                <defs>
                    <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
                </defs>
                <g class="parallax">
                    <use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(69,148,77,0.7" />
                    <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(69,148,77,0.5)" />
                    <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(69,148,77,0.3)" />
                    <use xlink:href="#gentle-wave" x="48" y="7" fill="#45944d" />
                </g>
            </svg>
        </div>
        <!--Waves end-->
        <div class="content flex">
            <!-- <p>By.Goodkatz | Free to use </p> -->
        </div>
    </header>

    <!-- Carousel Section -->
    <div id="mainCarousel" class="carousel slide mb-5" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="./assets/images/carousel/01.jpg" class="d-block w-100" alt="Orphanage">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Our Facilities</h5>
                    <p>Providing a safe and nurturing environment for children</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="./assets/images/carousel/02.jpg" class="d-block w-100" alt="Children Playing">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Joyful Moments</h5>
                    <p>Creating happy memories and fostering personal growth</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="./assets/images/carousel/03.jpg" class="d-block w-100" alt="Volunteers">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Our Volunteers</h5>
                    <p>Dedicated individuals making a difference in children's lives</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#mainCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#mainCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- Content Section -->
    <main class="container my-5">
        <section id="about" class="mb-5">
            <h2 class="text-center mb-4">About OrphaCare</h2>
            <p>OrphaCare is a non-profit organization dedicated to improving the lives of orphans and vulnerable children. Founded in 2010, we have been working tirelessly to provide care, support, and opportunities for children who have lost their parents or are living in difficult circumstances.</p>
            <p>Our mission is to create a nurturing environment where every child can thrive, learn, and build a bright future. We believe that every child deserves love, care, and the chance to reach their full potential.</p>
        </section>

        <section id="programs" class="mb-5">
            <h2 class="text-center mb-4">Our Programs</h2>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <div class="card h-100 text-center">
                        <div class="card-body">
                            <i class="fas fa-graduation-cap card-icon"></i>
                            <h5 class="card-title">Education Support</h5>
                            <p class="card-text">We provide school supplies, uniforms, and tutoring to ensure every child has access to quality education.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card h-100 text-center">
                        <div class="card-body">
                            <i class="fas fa-heartbeat card-icon"></i>
                            <h5 class="card-title">Health & Nutrition</h5>
                            <p class="card-text">Our health program offers regular check-ups, vaccinations, and nutritious meals to keep children healthy and strong.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card h-100 text-center">
                        <div class="card-body">
                            <i class="fas fa-tools card-icon"></i>
                            <h5 class="card-title">Skills Training</h5>
                            <p class="card-text">We offer vocational training and life skills workshops to prepare older children for independent living.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="impact" class="mb-5">
            <h2 class="text-center mb-4">Our Impact</h2>
            <div class="row text-center">
                <div class="col-md-4 mb-3">
                    <h3 class="display-4 fw-bold text-primary">500+</h3>
                    <p>Children Supported</p>
                </div>
                <div class="col-md-4 mb-3">
                    <h3 class="display-4 fw-bold text-primary">50</h3>
                    <p>Dedicated Staff Members</p>
                </div>
                <div class="col-md-4 mb-3">
                    <h3 class="display-4 fw-bold text-primary">10</h3>
                    <p>Years of Service</p>
                </div>
            </div>
        </section>
    </main>
    <?php include "./assets/include/footer.php" ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html