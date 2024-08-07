<?php
session_start();
require_once "./assets/include/config.php";

// Check if the user is already logged in, if yes then redirect to dashboard
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: admin-dashboard.php");
    exit;
}

class User {
    private $db;

    public function __construct() {
        $this->db = Config::getInstance()->getConnection();
    }

    public function login($email, $password) {
        $sql = "SELECT id, email, password, type, picture FROM `_PDAdmin` WHERE email = ?";
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
                $_SESSION["type"] = $user['type'];
                $_SESSION["picture"] = $user['picture'];
                
                return true;
            }
        }
        return false;
    }
}

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
                    header("location: admin-dashboard.php");
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

$loginForm = new LoginForm();
$loginForm->processForm();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - OrphaCare</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .login-form {
            max-width: 400px;
            margin: 100px auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="login-form">
            <h2 class="text-center mb-4">Admin Login</h2>
            <?php
            if (!empty($loginForm->getLoginErr())) {
                echo '<div class="alert alert-danger">' . $loginForm->getLoginErr() . '</div>';
            }
            ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" class="form-control <?php echo (!empty($loginForm->getEmailErr())) ? 'is-invalid' : ''; ?>" id="email" name="email" value="<?php echo $loginForm->getEmail(); ?>">
                    <div class="invalid-feedback"><?php echo $loginForm->getEmailErr(); ?></div>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control <?php echo (!empty($loginForm->getPasswordErr())) ? 'is-invalid' : ''; ?>" id="password" name="password">
                    <div class="invalid-feedback"><?php echo $loginForm->getPasswordErr(); ?></div>
                </div>
                <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>