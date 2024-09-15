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

// Fetch registered LGAs from the _PDUsers table
$lgaQuery = "SELECT DISTINCT lga FROM _PDUsers";
$lgaResult = $mysqli->query($lgaQuery);

// Convert the results to arrays
$lgas = [];
while ($row = $lgaResult->fetch_assoc()) {
  $lgas[] = $row['lga'];
}

// handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Collect form data
  $name = $_POST['name'];
  $lga = $_POST['lga'];
  $wards = $_POST['ward']; // This will be an array of selected wards
  $address = $_POST['address'];
  $capacity = $_POST['capacity'];

  // Convert the wards array to a comma-separated string
  $wardsString = implode(",", $wards);

  $sql = "INSERT INTO `_PDCollection_points`(`name`, `address`, `lga`, `ward`, `capacity`)
                    VALUES (?, ?, ?, ?, ?)";

  if ($stmt = $mysqli->prepare($sql)) {
    $stmt->bind_param("ssssi", $name, $lga, $wardsString, $address, $capacity);

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

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
              <a href="admin.php" class="nav-link active">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Dashboard</p>
              </a>
            </li>
            <!-- Other menu items -->
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
                          <label for="name">Name:</label>
                          <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                          <label for="lga">LGA:</label>
                          <select class="form-control" id="lga" name="lga" onchange="fetchWards()">
                            <option value="">Select LGA</option>
                            <?php foreach ($lgas as $lga) { ?>
                              <option value="<?php echo $lga; ?>"><?php echo $lga; ?></option>
                            <?php } ?>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="ward">Ward:</label>
                          <select class="form-control" id="ward" name="ward[]" multiple required>
                            <option value="">Select Ward</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="address">Address:</label>
                          <textarea class="form-control" id="address" name="address"></textarea>
                        </div>
                        <div class="form-group">
                          <label for="capacity">Capacity:</label>
                          <input type="number" class="form-control" id="capacity" name="capacity" required>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary">Register Collection Point</button>
                      <button type="button" class="btn btn-secondary" onclick="goBack()">Cancel</button>
                    </div>
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

    <!-- Footer -->
    <footer class="main-footer">
      <div class="float-right d-none d-sm-block">
        <b>Version</b> 1.0.0
      </div>
      <strong>&copy; 2024 <a href="#">Your Company</a>.</strong> All rights reserved.
    </footer>

  </div>
  <!-- ./wrapper -->

<<<<<<< HEAD
  <!-- AdminLTE JS -->
  <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1.0/dist/js/adminlte.min.js"></script>
  <!-- Bootstrap JS and dependencies -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
  
=======
  <!-- REQUIRED SCRIPTS -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
>>>>>>> 5a207a3a0b6cee93143736e0f85e36a6a93b5fd6
  <script>
    function register() {
      document.getElementById('CollectionPointForm').style.display = 'none';
      document.getElementById('newCollectionPointForm').style.display = 'block';
    }

    function goBack() {
      document.getElementById('CollectionPointForm').style.display = 'block';
      document.getElementById('newCollectionPointForm').style.display = 'none';
    }

    function fetchWards() {
      var lga = $('#lga').val();
      if (lga) {
        $.ajax({
          url: 'get_wards.php',
          type: 'GET',
          data: { lga: lga },
          success: function(response) {
            var wards = JSON.parse(response);
            var wardSelect = $('#ward');
            wardSelect.empty();
            wards.forEach(function(ward) {
              wardSelect.append('<option value="' + ward + '">' + ward + '</option>');
            });
          }
        });
      } else {
        $('#ward').empty();
      }
    }
  </script>
</body>

</html>
