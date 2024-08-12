<?php
session_start();
require_once "../assets/include/fuctions.php"; // Include the function definition

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
  header("location:../login.php");
  exit;
}

// Get the database connection
$mysqli = Config::getInstance()->getConnection();

$id = $_SESSION["id"];
$email = $_SESSION["email"];
$name = $_SESSION["name"];
$type = $_SESSION["type"];
$picture = $_SESSION["picture"];

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Collect form data
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
  $type = $_POST['type'];
  $phone = $_POST['phone'];
  $address = $_POST['address'];
  $lga = $_POST['lga'];
  $reg_by = $_SESSION['name'];
  $picture = $_FILES["picture"]["name"];

  // Handle file upload
  $targetDir = "../assets/images/admin/";
  $fileType = pathinfo($_FILES["picture"]["name"], PATHINFO_EXTENSION);
  $newFileName = uniqid() . '.' . $fileType; // Generate a unique filename
  $targetFilePath = $targetDir . $newFileName;

  // Allow certain file formats
  $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
  if (in_array($fileType, $allowTypes)) {
    // Upload file to server
    if (move_uploaded_file($_FILES["picture"]["tmp_name"], $targetFilePath)) {
      // Insert manager data into database
      $sql = "INSERT INTO _PDAdmin (name, email, password, type, picture, phone, address, reg_by, lga)
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

      if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("sssssssss", $name, $email, $password, $type, $newFileName, $phone, $address, $reg_by, $lga);

        if ($stmt->execute()) {
          echo "
          <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css'>
          <link href='https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css' rel='stylesheet'>
          <script src='https://code.jquery.com/jquery-3.6.0.min.js'></script>
          <script src='https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js'></script>
          <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js'></script>

          <script>
          $(document).ready(function() {
              toastr.success('Registration Successful');
              setTimeout(function() {
                  $('#successModal').modal('show');
              }, 1500); // Show the modal after 1.5 seconds
          });
          </script>

          <!-- Bootstrap Modal -->
          <div class='modal fade' id='successModal' tabindex='-1' role='dialog' aria-labelledby='successModalLabel' aria-hidden='true'>
              <div class='modal-dialog' role='document'>
                  <div class='modal-content'>
                      <div class='modal-header'>
                          <h5 class='modal-title' id='successModalLabel'>Registration Successful</h5>
                          <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                              <span aria-hidden='true'>&times;</span>
                          </button>
                      </div>
                      <div class='modal-body'>
                          Manager registration was successful. Would you like to go back to Dashboard?
                      </div>
                      <div class='modal-footer'>
                          <a href='admin.php'><button type='button' class='btn btn-primary'>Go back to Dashboard</button></a>
                          <button type='button' class='btn btn-secondary' data-dismiss='modal'>No, Continue</button>
                      </div>
                  </div>
              </div>
          </div>
          ";
        } else {
          $errorMessage = "Error: " . $stmt->error;
        }
        $stmt->close();
      } else {
        $errorMessage = "Error: " . $mysqli->error;
      }
    } else {
      echo "
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css'>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js'></script>
        <script>
        $(document).ready(function() {
            toastr.error('Sorry, there was an error uploading your file.');
        });
        </script>";
    }
  } else {
    echo "
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css'>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js'></script>
    <script>
    $(document).ready(function() {
        toastr.error('Sorry, only JPG, JPEG, PNG & GIF files are allowed to upload.');
    });
    </script>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manager Registration - AdminLTE Dashboard</title>
  <!-- Include CSS -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Toastr CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

  <!-- Additional CSS for file input and image preview -->
  <style>
    .custom-file-input:lang(en)~.custom-file-label::after {
      content: "Browse";
    }

    #imagePreview {
      max-width: 200px;
      max-height: 200px;
      margin-top: 10px;
    }
  </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <!-- Navbar and Sidebar code here (same as before) -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="admin.php" class="nav-link">Home</a>
        </li>
        <!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li> -->
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item">
          <a class="nav-link" href="logout.php">
            <i class="fa fa-sign-out-alt"></i>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index.html" class="brand-link">
        <img src="../assets/images/logo/logo1.svg" alt="Logo" class="brand-image " style="opacity: .8">
        <span class="brand-text font-weight-light">ADMIN</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="../assets/images/admin/<?php echo $picture ?>" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block"><?php echo $name ?></a>
            <span class="badge badge-info"><?php echo $type ?></span>
          </div>
        </div>

        <!-- SidebarSearch Form -->
        <!-- <div class="form-inline">
          <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-sidebar">
                <i class="fas fa-search fa-fw"></i>
              </button>
            </div>
          </div>
        </div> -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
              <a href="admin.php" class="nav-link active">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Dashboard</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>Users</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-heart"></i>
                <p>Donations</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-calendar"></i>
                <p>Events</p>
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0">Manager Registration</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Manager Registration</li>
                </ol>
              </div>
            </div>
          </div>
        </div>

        <!-- Main content -->
        <section class="content">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-6 m-auto">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Register New Manager</h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <?php
                    if (isset($successMessage)) {
                      echo "<div class='alert alert-success'>" . $successMessage . "</div>";
                    }
                    if (isset($errorMessage)) {
                      echo "<div class='alert alert-danger'>" . $errorMessage . "</div>";
                    }
                    ?>
                    <form id="managerForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                      <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                      </div>
                      <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                      </div>
                      <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                      </div>
                      <div class="form-group">
                        <label for="type">Manager Type</label>
                        <input type="hidden" class="form-control" id="type" name="type" value="Manager">
                        <!-- <select class="form-control" id="type" name="type" disabled>
                          <option value="manager">Manager</option>
                        </select> -->
                      </div>
                      <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="tel" class="form-control" id="phone" name="phone" required>
                      </div>
                      <div class="form-group">
                        <label for="address">Address</label>
                        <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
                      </div>
                      <div class="form-group">
                        <label for="lga">Local Government Area (LGA)</label>
                        <select class="form-control" id="lga" name="lga" required>
                          <option value="">Select LGA</option>
                          <option value="Alkaleri">Alkaleri</option>
                          <option value="Bauchi">Bauchi</option>
                          <option value="Bogoro">Bogoro</option>
                          <!-- Add more LGAs here -->
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="picture">Profile Picture</label>
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" id="picture" name="picture" accept="image/*" required>
                          <label class="custom-file-label" for="picture">Choose file</label>
                        </div>
                        <img id="imagePreview" src="#" alt="Image Preview" style="display:none;">
                      </div>
                      <button type="submit" class="btn btn-primary">Register Manager</button>
                    </form>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->
      <footer class="main-footer">
        <strong>Copyright &copy; 2014-2023 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
          <b>Version</b> 3.2.0
        </div>
      </footer>
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <!-- bs-custom-file-input -->
    <script src="plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
      $(function() {
        bsCustomFileInput.init();

        // Image preview
        $("#picture").change(function() {
          readURL(this);
        });

        function readURL(input) {
          if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
              $('#imagePreview').attr('src', e.target.result);
              $('#imagePreview').show();
            }

            reader.readAsDataURL(input.files[0]);
          }
        }
      });
    </script>
</body>

</html>
