<?php
session_start();

// Config class to handle database connection
require_once "./assets/include/config.php";
// User class to handle user-related operations
class User {
    private $db;

    public function __construct() {
        $this->db = Config::getInstance()->getConnection();
    }

    public function login($email, $password) {
        $sql = "SELECT * FROM `_PDAdmin` WHERE email = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                $_SESSION["loggedin"] = true;
                $_SESSION["id"] = $user['id'];
                $_SESSION["email"] = $user['email'];
                $_SESSION["name"] = $user['name'];
                $_SESSION["type"] = $user['type'];
                $_SESSION["picture"] = $user['picture'];
                
                return true;
            }
        }
        return false;
    }
}

// LoginForm class to handle form processing
class LoginForm {
    private $email = '';
    private $password = '';
    private $email_err = '';
    private $password_err = '';
    private $login_err = '';

    public function processForm() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->validateEmail();
            $this->validatePassword();

            if (empty($this->email_err) && empty($this->password_err)) {
                $user = new User();
                if ($user->login($this->email, $this->password)) {
                    header("location: ./admin/admin.php");
                    exit;
                } else {
                    $this->login_err = "Invalid email or password.";
                }
            }
        }
    }

    private function validateEmail() {
        if (empty(trim($_POST["email"]))) {
            $this->email_err = "Please enter your email.";
        } else {
            $this->email = trim($_POST["email"]);
        }
    }

    private function validatePassword() {
        if (empty(trim($_POST["password"]))) {
            $this->password_err = "Please enter your password.";
        } else {
            $this->password = trim($_POST["password"]);
        }
    }

    public function getEmail() { return $this->email; }
    public function getEmailErr() { return $this->email_err; }
    public function getPasswordErr() { return $this->password_err; }
    public function getLoginErr() { return $this->login_err; }
}

// Usage
$loginForm = new LoginForm();
$loginForm->processForm();
?>

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
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .body {
            background-color: var(--white);
            background-size: 400% 400%;
            height: 100vh;
            margin: 0;
            padding: 0;
        }

        .error-message {
            color: #dc3545;
            font-size: 0.875em;
            margin-top: 0.25rem;
        }

        .is-invalid {
            border-color: #dc3545;
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

        .social-btn:hover {
            background-color: gray;
            color: white;
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
    <?php include "./assets/include/header.php" ?>
    <!-- main Section -->
    <div class="container-fluid body">
        <div class="container">
            <div class="row justify-content-center align-items-center min-vh-100">
                <div class="col-xl-10 col-lg-12 col-md-9">
                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <div class="row">
                                <div class="col-lg-6 d-none d-lg-block bg-login-image">
                                </div>
                                <div class="col-lg-6">
                                    <div class="p-5">
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                        </div>
                                        <?php
                                        if (!empty($loginForm->getLoginErr())) {
                                            echo '<div class="alert alert-danger">' . $loginForm->getLoginErr() . '</div>';
                                        }
                                        ?>
                                        <form class="user" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                            <div class="form-group mb-3">
                                                <label for="email" class="form-label">Email Address</label>
                                                <input type="email" class="form-control form-control-user <?php echo (!empty($loginForm->getEmailErr())) ? 'is-invalid' : ''; ?>" id="email" name="email" value="<?php echo $loginForm->getEmail(); ?>" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                                                <span class="error-message"><?php echo $loginForm->getEmailErr(); ?></span>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="password" class="form-label">Password</label>
                                                <input type="password" class="form-control form-control-user <?php echo (!empty($loginForm->getPasswordErr())) ? 'is-invalid' : ''; ?>" id="password" name="password" placeholder="Password">
                                                <span class="error-message"><?php echo $loginForm->getPasswordErr(); ?></span>
                                            </div>
                                            <div class="form-group mb-3">
                                                <div class="custom-control custom-checkbox small">
                                                    <input type="checkbox" class="custom-control-input" id="customCheck" name="remember">
                                                    <label class="custom-control-label" for="customCheck">Remember Me</label>
                                                </div>
                                            </div>
                                            <input type="submit" class="btn btn-success btn-user btn-block mb-3 w-100" value="Login">
                                        </form>
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include "./assets/include/footer.php" ?>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>