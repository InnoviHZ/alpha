<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OrphaCare - Login</title>
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;500;700;900&family=Public+Sans:wght@400;500;700;900&display=swap">
    <link rel="icon" type="image/x-icon" href="data:image/x-icon;base64,">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <style>
        @keyframes gradient {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        .body {
            /* background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab); */
            background-color: var(--white);
            background-size: 400% 400%;
            /* animation: gradient 15s ease infinite; */
            margin: 0;
            padding: 0;
        }

        .card {
            border: none;
            border-radius: 1rem;
            backdrop-filter: blur(10px);
            background-color: rgba(255, 255, 255, 0.7);
            overflow: hidden;
        }

        .card-header {
            background-color: transparent;
            border-bottom: none;
            padding: 2rem 1rem 1rem;
        }

        .btn-primary {
            background-color: #4e73df;
            border-color: #4e73df;
        }

        .btn-primary:hover {
            background-color: #2e59d9;
            border-color: #2e59d9;
        }

        .form-control:focus {
            border-color: #bac8f3;
            box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
        }

        .social-btn {
            font-size: 1.2rem;
            padding: 0.5rem 1rem;
        }

        .bg-login-image {
            background-position: center;
            background-size: cover;
            background-image: url(./assets/images/login/login.jpg);
            overflow: hidden;
        }
    </style>
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
                    <!-- <button class="btn btn-outline-primary me-2">Sign In</button> -->
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
    <!-- main Section -->
    <div class="container-fluid body h-100">
        <div class="card-body p-0">
            <div class="row">
                <div class="col-lg-8 d-none d-lg-block bg-login-image">
                </div>
                <div class="col-lg-4 h-100">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                        </div>
                        <form class="user">
                            <div class="form-group mb-3">
                                <input type="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                            </div>
                            <div class="form-group mb-3">
                                <input type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                            </div>
                            <div class="form-group mb-3">
                                <div class="custom-control custom-checkbox small">
                                    <input type="checkbox" class="custom-control-input" id="customCheck">
                                    <label class="custom-control-label" for="customCheck">Remember Me</label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-user btn-block mb-3">
                                Login
                            </button>
                            <hr>
                            <div class="text-center mb-3">
                                <p>Or sign in with:</p>
                                <a href="#" class="btn btn-google btn-user social-btn me-2">
                                    <i class="fab fa-google fa-fw"></i> Google
                                </a>
                                <a href="#" class="btn btn-facebook btn-user social-btn">
                                    <i class="fab fa-facebook-f fa-fw"></i> Facebook
                                </a>
                            </div>
                        </form>
                        <hr>
                        <div class="text-center">
                            <a class="small" href="#">Forgot Password?</a>
                        </div>
                        <div class="text-center">
                            <a class="small" href="#">Create an Account!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Footer -->
    <footer class="py-5">
        <div class="container">
            <div class="row">
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
                <div class="col-md-3 mb-4">
                    <h5>Useful Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-dark">Partner Organizations</a></li>
                        <li><a href="#" class="text-dark">Government Resources</a></li>
                        <li><a href="#" class="text-dark">Volunteer Opportunities</a></li>
                    </ul>
                </div>
                <div class="col-md-3 mb-4">
                    <h5>Sitemap</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-dark">Home</a></li>
                        <li><a href="#about" class="text-dark">About</a></li>
                        <li><a href="#programs" class="text-dark">Programs</a></li>
                        <li><a href="#contact" class="text-dark">Contact</a></li>
                    </ul>
                </div>
                <div class="col-md-3 mb-4">
                    <h5>Find Us</h5>
                    <div id="map" style="width: 100%; height: 200px;">
                        <!-- Google Map will be inserted here -->
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Privacy Policy -->
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

</html>