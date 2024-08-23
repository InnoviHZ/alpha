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
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Details</title>
  <!-- AdminLTE CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1.0/dist/css/adminlte.min.css">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700">
</head>

<body class="hold-transition sidebar-mini">

  <div class="wrapper">
    <!-- Content Wrapper. Contains page content -->
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
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>User Details</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">User Details</li>
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
              <!-- User details box -->
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Details of User</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <?php
                  require_once "../assets/include/config.php"; // Include the config file

                  // Check if user ID is provided in the query string
                  if (isset($_GET['id'])) {
                    // Get the user ID from the URL
                    $userId = $_GET['id'];

                    // Get the database connection
                    $mysqli = Config::getInstance()->getConnection();

                    // Prepare the SQL statement to fetch user details
                    $sql = "SELECT full_name, yod, full_name_b, dob, gender, lga, ward, address, phone, email, op_number,id_number, benefit_type, photo, op_number, reg_by FROM _PDUsers WHERE id = ?";

                    if ($stmt = $mysqli->prepare($sql)) {
                      // Bind the user ID to the statement
                      $stmt->bind_param("i", $userId);

                      // Execute the statement
                      $stmt->execute();

                      // Bind the result to variables
                      $stmt->bind_result($fullName, $yod, $fullNameB, $dob, $gender, $lga, $ward, $address, $phone, $email, $op_number, $id_number, $benefitType, $photo, $opNumber, $registeredBy);

                      // Fetch the details
                      if ($stmt->fetch()) {
                        // Display user details in HTML with AdminLTE styling
                        echo "<div class='row'>";
                        echo "<div class='col-md-6'>";
                        echo "<p><strong>Name:</strong> " . htmlspecialchars($fullName) . "</p>";
                        echo "<p><strong>Year of Death:</strong> " . htmlspecialchars($yod) . "</p>";
                        echo "<p><strong>Beneficiary Name:</strong> " . htmlspecialchars($fullNameB) . "</p>";
                        echo "<p><strong>Date of Birth:</strong> " . htmlspecialchars($dob) . "</p>";
                        echo "<p><strong>Gender:</strong> " . htmlspecialchars($gender) . "</p>";
                        echo "<p><strong>LGA:</strong> " . htmlspecialchars($lga) . "</p>";
                        echo "<p><strong>Ward:</strong> " . htmlspecialchars($ward) . "</p>";
                        echo "<p><strong>Address:</strong> " . htmlspecialchars($address) . "</p>";
                        echo "</div>";
                        echo "<div class='col-md-6'>";
                        echo "<p><strong>Phone:</strong> " . htmlspecialchars($phone) . "</p>";
                        echo "<p><strong>Email:</strong> " . htmlspecialchars($email) . "</p>";
                        echo "<p><strong>Number of Orphans:</strong> " . htmlspecialchars($op_number) . "</p>";
                        echo "<p><strong>Benefit Type:</strong> " . htmlspecialchars($benefitType) . "</p>";
                        echo "<p><strong>Id Number:</strong> " . htmlspecialchars($id_number) . "</p>";
                        echo "<p><strong>Registered By:</strong> " . htmlspecialchars($registeredBy) . "</p>";
                        echo "<p><strong>Photo:</strong><br><img src='../assets/images/beneficiaries/" . htmlspecialchars($photo) . "' alt='User Photo' class='img-fluid img-thumbnail' style='max-width: 200px;'></p>";
                        echo "</div>";
                        echo "</div>";
                      } else {
                        echo "<p class='text-danger'>User not found.</p>";
                      }

                      // Close the statement
                      $stmt->close();
                    } else {
                      echo "<p class='text-danger'>Error: Could not prepare the statement.</p>";
                    }
                  } else {
                    echo "<p class='text-danger'>Error: No user ID provided.</p>";
                  }
                  ?>
                  <a href="admin.php" class="btn btn-primary mt-3">Back to Users List</a>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-12">
              <!-- User Details Card -->
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">
                    <i class="fas fa-users mr-1"></i>
                    Otlets Details
                  </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <?php
                  displayOutletTable($userId);
                  ?>
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

  <!-- Bootstrap JS and dependencies -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
  <!-- DataTables & Plugins -->
  <script src="plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="plugins/jszip/jszip.min.js"></script>
  <script src="plugins/pdfmake/pdfmake.min.js"></script>
  <script src="plugins/pdfmake/vfs_fonts.js"></script>
  <script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  <script>
    $(function() {
      $("#userTable").DataTable({
        "responsive": true,
        "lengthChange": true,
        "autoWidth": false,
        "buttons": ["excel", "pdf", "print"]
      }).buttons().container().appendTo('#userTable_wrapper .col-md-6:eq(0)');
    });
  </script>
  <script>
    $(document).ready(function() {
      $('#saveProfileChanges').on('click', function() {
        var formData = new FormData($('#adminProfileForm')[0]);
        if ($('#adminPhotoUpload')[0].files[0]) {
          formData.append('picture', $('#adminPhotoUpload')[0].files[0]);
        }

        $.ajax({
          url: 'update_admin_details.php', // Endpoint to handle the update
          method: 'POST',
          data: formData,
          processData: false,
          contentType: false,
          success: function(response) {
            alert('Profile updated successfully!');
            $('#profileModal').modal('hide');
            // Optionally, update the photo on the page
            $('#adminPhoto').attr('src', URL.createObjectURL($('#adminPhotoUpload')[0].files[0]));
          },
          error: function(error) {
            console.error('Error updating profile:', error);
          }
        });
      });
    });
  </script>
</body>

</html>
