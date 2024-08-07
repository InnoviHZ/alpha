<?php
session_start();
require_once "../assets/include/config.php";

// Check if the user is already logged in, if yes then redirect to beneficiary dashboard
// if(isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] == true){
//     header("location: reg.php");
   
// }else{
//     exit;

// }

class Beneficiary {
    private $db;

    public function __construct() {
        $this->db = Config::getInstance()->getConnection();
    }

    public function register($name, $email, $password) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO `_PDUsers` (name, email, password) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("sss", $name, $email, $hashed_password);
        
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}

class RegistrationForm {
    private $name = '';
    private $email = '';
    private $password = '';
    private $confirm_password = '';
    private $name_err = '';
    private $email_err = '';
    private $password_err = '';
    private $confirm_password_err = '';
    private $registration_err = '';

    public function processForm() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->validateName();
            $this->validateEmail();
            $this->validatePassword();
            $this->validateConfirmPassword();

            if (empty($this->name_err) && empty($this->email_err) && empty($this->password_err) && empty($this->confirm_password_err)) {
                $beneficiary = new Beneficiary();
                if ($beneficiary->register($this->name, $this->email, $this->password)) {
                    header("location: ../login.php");
                    exit;
                } else {
                    $this->registration_err = "Something went wrong. Please try again later.";
                }
            }
        }
    }

    private function validateName() {
        if (empty(trim($_POST["name"]))) {
            $this->name_err = "Please enter your name.";
        } else {
            $this->name = trim($_POST["name"]);
        }
    }

    private function validateEmail() {
        if (empty(trim($_POST["email"]))) {
            $this->email_err = "Please enter your email.";
        } else {
            $this->email = trim($_POST["email"]);
            if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
                $this->email_err = "Invalid email format.";
            }
        }
    }

    private function validatePassword() {
        if (empty(trim($_POST["password"]))) {
            $this->password_err = "Please enter a password.";
        } elseif (strlen(trim($_POST["password"])) < 6) {
            $this->password_err = "Password must have at least 6 characters.";
        } else {
            $this->password = trim($_POST["password"]);
        }
    }

    private function validateConfirmPassword() {
        if (empty(trim($_POST["confirm_password"]))) {
            $this->confirm_password_err = "Please confirm password.";
        } else {
            $this->confirm_password = trim($_POST["confirm_password"]);
            if (empty($this->password_err) && ($this->password != $this->confirm_password)) {
                $this->confirm_password_err = "Password did not match.";
            }
        }
    }

    public function getName() { return $this->name; }
    public function getEmail() { return $this->email; }
    public function getNameErr() { return $this->name_err; }
    public function getEmailErr() { return $this->email_err; }
    public function getPasswordErr() { return $this->password_err; }
    public function getConfirmPasswordErr() { return $this->confirm_password_err; }
    public function getRegistrationErr() { return $this->registration_err; }
}

$registrationForm = new RegistrationForm();
$registrationForm->processForm();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beneficiary Registration - OrphaCare</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .registration-form {
            max-width: 400px;
            margin: 100px auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="registration-form">
            <h2 class="text-center mb-4">Beneficiary Registration</h2>
            <?php
            if (!empty($registrationForm->getRegistrationErr())) {
                echo '<div class="alert alert-danger">' . $registrationForm->getRegistrationErr() . '</div>';
            }
            ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="mb-3">
                    <label for="name" class="form-label">Full Name</label>
                    <input type="text" class="form-control <?php echo (!empty($registrationForm->getNameErr())) ? 'is-invalid' : ''; ?>" id="name" name="name" value="<?php echo $registrationForm->getName(); ?>">
                    <div class="invalid-feedback"><?php echo $registrationForm->getNameErr(); ?></div>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" class="form-control <?php echo (!empty($registrationForm->getEmailErr())) ? 'is-invalid' : ''; ?>" id="email" name="email" value="<?php echo $registrationForm->getEmail(); ?>">
                    <div class="invalid-feedback"><?php echo $registrationForm->getEmailErr(); ?></div>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control <?php echo (!empty($registrationForm->getPasswordErr())) ? 'is-invalid' : ''; ?>" id="password" name="password">
                    <div class="invalid-feedback"><?php echo $registrationForm->getPasswordErr(); ?></div>
                </div>
                <div class="mb-3">
                    <label for="confirm_password" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control <?php echo (!empty($registrationForm->getConfirmPasswordErr())) ? 'is-invalid' : ''; ?>" id="confirm_password" name="confirm_password">
                    <div class="invalid-feedback"><?php echo $registrationForm->getConfirmPasswordErr(); ?></div>
                </div>
                <button type="submit" class="btn btn-primary w-100">Register</button>
            </form>
            <p class="mt-3 text-center">Already have an account? <a href="beneficiary-login.php">Login here</a></p>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>