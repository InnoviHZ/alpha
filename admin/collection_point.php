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

// handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Collect form data
  $name = $_POST['name'];
  $lga = $_POST['lga'];
  $ward = $_POST['ward'];
  $address = $_POST['address'];
  $capacity = $_POST['capacity'];

  $sql = "INSERT INTO `_PDCollection_points`(`name`, `address`, `lga`, `ward`, `capacity`)
                    VALUES (?, ?, ?, ?, ?)";

  if ($stmt = $mysqli->prepare($sql)) {
    $stmt->bind_param("ssssi", $name, $lga, $ward, $address, $capacity);

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
        ";
    } else {
      $errorMessage = "Error: " . $stmt->error;
    }
    $stmt->close();
  } else {
    $errorMessage = "Error: " . $mysqli->error;
  }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update User Details</title>
  <!-- AdminLTE CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1.0/dist/css/adminlte.min.css">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700">
</head>

<body class="hold-transition sidebar-mini">

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
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>New Collection Point</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Collection Point</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card" id="CollectionPointForm" style="display:block;">
                <div class="card-header">
                  <div>
                    <h3 class="card-title">
                      <i class="fas fa-users mr-1"></i>
                      Collection Points
                    </h3>
                  </div>
                  <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                      <button id="registerNewButton" onclick="register()" class="btn btn-primary">Register New</button>
                    </div>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <?php
                  displayCollection_pointTable(1);
                  ?>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
              <!-- User update form -->
              <div class="card card-primary" style="display: none;" id="newCollectionPointForm">
                <div class="card-header">
                  <h3 class="card-title">New Collection Point</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <form method="post">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="full_name">Name:</label>
                          <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                          <label for="lga">LGA:</label>
                          <select class="form-control" id="lga" name="lga">
                            <option value="LGA1">LGA 1</option>
                            <option value="LGA2">LGA 2</option>
                            <option value="LGA3">LGA 3</option>
                            <!-- Add more LGA options as needed -->
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="ward">Ward:</label>
                          <select class="form-control" id="ward" name="ward">
                            <option value="Ward1">Ward 1</option>
                            <option value="Ward2">Ward 2</option>
                            <option value="Ward3">Ward 3</option>
                            <!-- Add more Ward options as needed -->
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="address">Address:</label>
                          <textarea class="form-control" id="address" name="address"></textarea>
                        </div>
                        <div class="form-group">
                          <label for="op_number">Capacity:</label>
                          <input type="number" class="form-control" id="capacity" name="capacity" value="">
                        </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Register</button>
                  </form>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
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

  <!-- AdminLTE JS -->
  <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1.0/dist/js/adminlte.min.js"></script>
  <!-- Bootstrap JS and dependencies -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
  
  <script>
    function register() {
      document.getElementById('newCollectionPointForm').style.display = 'block';
      document.getElementById('CollectionPointForm').style.display = 'none';
    }
  </script>
</body>

</html>
