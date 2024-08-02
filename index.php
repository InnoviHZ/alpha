<!DOCTYPE html>
<html lang="en">

<head>
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
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top shadow-b1">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="./assets/images/logo/logo1.svg" alt="OrphaCare Logo" height="30" class="d-inline-block align-top">
                OrphaCare
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="./index.php">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="aboutDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            About
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="aboutDropdown">
                            <li><a class="dropdown-item" href="#mission">Our Mission</a></li>
                            <li><a class="dropdown-item" href="#team">Our Team</a></li>
                            <li><a class="dropdown-item" href="#history">Our History</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="programsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Programs
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="programsDropdown">
                            <li><a class="dropdown-item" href="#education">Education Support</a></li>
                            <li><a class="dropdown-item" href="#health">Health Services</a></li>
                            <li><a class="dropdown-item" href="#community">Community Outreach</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#impact">Impact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact</a>
                    </li>
                </ul>
                <div class="d-flex align-items-center">
                    <a href="./login.php">
                        <button class="btn btn-outline-primary me-2">Sign In</button>
                    </a>
                    <a href="./slip-printing.php">
                        <button class="btn btn-outline-secondary me-2">Print Slip</button>
                    </a>
                    <button class="btn btn-outline-success me-2">Donation</button>
                    <a href="#" class="btn btn-outline-secondary me-2" aria-label="Facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="btn btn-outline-secondary me-2" aria-label="Twitter">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="btn btn-outline-secondary" aria-label="Instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                </div>
            </div>
        </div>
    </nav>

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

    <!-- Footer -->
    <footer class="">
        <div class="container">
            <div class="row">
                <!-- Social Links and Address -->
                <div class="col-md-3 mb-4">
                    <h5>Contact Us</h5>
                    <p class="mb-2">123 Charity Lane, Careville, CA 90210</p>
                    <p class="mb-2">Phone: (555) 123-4567</p>
                    <p class="mb-3">Email: info@orphacare.org</p>
                    <div class="d-flex">
                        <button class="btn btn-outline-secondary me-2" aria-label="Facebook">
                            <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 256 256">
                                <path d="M128,24A104,104,0,1,0,232,128,104.11,104.11,0,0,0,128,24Zm8,191.63V152h24a8,8,0,0,0,0-16H136V112a16,16,0,0,1,16-16h16a8,8,0,0,0,0-16H152a32,32,0,0,0-32,32v24H96a8,8,0,0,0,0,16h24v63.63a88,88,0,1,1,16,0Z" />
                            </svg>
                        </button>
                        <button class="btn btn-outline-secondary me-2" aria-label="Twitter">
                            <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 256 256">
                                <path d="M247.39,68.94A8,8,0,0,0,240,64H209.57A48.66,48.66,0,0,0,168.1,40a46.91,46.91,0,0,0-33.75,13.7A47.9,47.9,0,0,0,120,88v6.09C79.74,83.47,46.81,50.72,46.46,50.37a8,8,0,0,0-13.65,4.92c-4.31,47.79,9.57,79.77,22,98.18a110.93,110.93,0,0,0,21.88,24.2c-15.23,17.53-39.21,26.74-39.47,26.84a8,8,0,0,0-3.85,11.93c.75,1.12,3.75,5.05,11.08,8.72C53.51,229.7,65.48,232,80,232c70.67,0,129.72-54.42,135.75-124.44l29.91-29.9A8,8,0,0,0,247.39,68.94Zm-45,29.41a8,8,0,0,0-2.32,5.14C196,166.58,143.28,216,80,216c-10.56,0-18-1.4-23.22-3.08,11.51-6.25,27.56-17,37.88-32.48A8,8,0,0,0,92,169.08c-.47-.27-43.91-26.34-44-96,16,13,45.25,33.17,78.67,38.79A8,8,0,0,0,136,104V88a32,32,0,0,1,9.6-22.92A30.94,30.94,0,0,1,167.9,56c12.66.16,24.49,7.88,29.44,19.21A8,8,0,0,0,204.67,80h16Z" />
                            </svg>
                        </button>
                        <button class="btn btn-outline-secondary" aria-label="Instagram">
                            <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 256 256">
                                <path d="M128,80a48,48,0,1,0,48,48A48.05,48.05,0,0,0,128,80Zm0,80a32,32,0,1,1,32-32A32,32,0,0,1,128,160ZM176,24H80A56.06,56.06,0,0,0,24,80v96a56.06,56.06,0,0,0,56,56h96a56.06,56.06,0,0,0,56-56V80A56.06,56.06,0,0,0,176,24Zm40,152a40,40,0,0,1-40,40H80a40,40,0,0,1-40-40V80A40,40,0,0,1,80,40h96a40,40,0,0,1,40,40ZM192,76a12,12,0,1,1-12-12A12,12,0,0,1,192,76Z" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- External Links -->
                <div class="col-md-3 mb-4">
                    <h5>Useful Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-dark">Partner Organizations</a></li>
                        <li><a href="#" class="text-dark">Government Resources</a></li>
                        <li><a href="#" class="text-dark">Volunteer Opportunities</a></li>
                    </ul>
                </div>

                <!-- Sitemap -->
                <div class="col-md-3 mb-4">
                    <h5>Sitemap</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-dark">Home</a></li>
                        <li><a href="#about" class="text-dark">About</a></li>
                        <li><a href="#programs" class="text-dark">Programs</a></li>
                        <li><a href="#contact" class="text-dark">Contact</a></li>
                    </ul>
                </div>

                <!-- Google Map -->
                <div class="col-md-3 mb-4">
                    <h5>Find Us</h5>
                    <div id="map" style="width: 100%; height: 200px;">
                        <!-- Google Map will be inserted here -->
                    </div>
                </div>
            </div>
        </div>
        <div class="wv">
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
        </div>
    </footer>

    <!-- Privacy Policy (Separated with different color) -->
    <div class="bg-light py-3 border-top border-5 border-success">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <a href="#" class="text-primary me-2">Privacy Policy</a>
                    <span class="text-muted">&copy; 2024 OrphaCare. All rights reserved.</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Google Maps JavaScript -->
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap" async defer></script>
    <script>
        function initMap() {
            var location = {
                lat: 34.052235,
                lng: -118.243683
            }; // Example coordinates for Los Angeles
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 14,
                center: location
            });
            var marker = new google.maps.Marker({
                position: location,
                map: map
            });
        }
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html