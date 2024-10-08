<?php
session_start();
require_once "../assets/include/config.php";
require_once "../assets/include/fuctions.php";
// Function to check if user has permission
if (!isset($_SESSION["loggedin"]) ||  $_SESSION["loggedin"] !== true) {
  header("location:../login.php");
  exit;
}

$id = $_SESSION["id"];
$email = $_SESSION["email"];
$name = $_SESSION["name"];
$type = $_SESSION["type"];
$picture = $_SESSION["picture"];

// fetch adimn detail form databes
$mysqli = Config::getInstance()->getConnection();
$stmt = $mysqli->prepare("SELECT * FROM _PDAdmin WHERE id =?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$admin_details = $result->fetch_assoc();
// saving details as variables
$admin_id = $admin_details['id'];
$admin_name = $admin_details['name'];
$admin_email = $admin_details['email'];
$admin_phone = $admin_details['phone'];
$admin_address = $admin_details['address'];
$admin_lga = $admin_details['lga'];
$admin_reg_by = $admin_details['reg_by'];
// $admin_pa = $admin_details['password'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AdminLTE Dashboard</title>
  <!-- Include CSS -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- DataTables CSS -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="admin.php" class="nav-link">Home</a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Profile Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="fas fa-user"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right">
            <a href="#" class="dropdown-item" data-toggle="modal" data-target="#profileModal">
              <i class="fas fa-user"></i> Profile
            </a>
            <div class="dropdown-divider"></div>
            <a href="logout.php" class="dropdown-item">
              <i class="fas fa-sign-out-alt mr-2"></i> Logout
            </a>
          </div>
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

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
              <a href="#" class="nav-link active">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Dashboard</p>
              </a>
            </li>
            <?php if (hasPermission('Super')): ?>
              <li class="nav-item">
                <a href="admin.php" class="nav-link">
                  <form action="" method="get">
                    <i class="nav-icon fas fa-users"></i>
                    <p>Manage Admins</p>
                  </form>
                </a>
              </li>
            <?php endif; ?>
            <?php if (hasPermission('Admin')): ?>
              <li class="nav-item">
                <a href="admin.php?man" class="nav-link">
                  <form action="" method="get">
                    <i class="nav-icon fas fa-users"></i>
                    <p>Manage Managers</p>
                  </form>
                </a>
              </li>
            <?php endif; ?>
            <?php if (hasPermission('Manager')): ?>
              <li class="nav-item">
                <a href="admin.php?ben" class="nav-link">
                  <form action="" method="get">
                    <i class="nav-icon fas fa-users"></i>
                    <p>Manage Beneficiaries</p>
                  </form>
                </a>
              </li>

              <?php endif; ?>
            <?php if (hasPermission('Manager')): ?>
              <li class="nav-item">
                <a href="./collection_point.php" class="nav-link">
                  <form action="" method="get">
                    <i class="nav-icon fas fa-users"></i>
                    <p>Manage Collection P.</p>
                  </form>
                </a>
              </li>
            <?php endif; ?>
            <li class="nav-item">
              <a href="./bulk_upload.php" class="nav-link">
                <i class="nav-icon fas fa-heart"></i>
                <p>Bulk Upload</p>
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
            </li><li class="nav-item">
              <a href="./sys_settings.php" class="nav-link">
                <i class="nav-icon fas fa-calendar"></i>
                <p>System Settings</p>
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
              <h1 class="m-0"><a href="admi.php">Dashboard</a></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active"><a href="admi.php">Dashboard</a></li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <?php if (hasPermission('Manager')): ?>
              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                  <div class="inner">
                    <h3>150</h3>
                    <p>New Beneficiaries</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-user-plus"></i>
                  </div>
                  <a href="./reg2.php" class="small-box-footer">Add More <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
            <?php endif; ?>
            <?php if (hasPermission('Admin')): ?>
              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                  <div class="inner">
                    <h3>30</h3>
                    <p>Active Managers</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-user-tie"></i>
                  </div>
                  <a href="reg_managers.php" class="small-box-footer">Add More <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
            <?php endif; ?>
            <?php if (hasPermission('Super')): ?>
              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                  <div class="inner">
                    <h3>10</h3>
                    <p>Active Admins</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-users-cog"></i>
                  </div>
                  <a href="reg_admin.php" class="small-box-footer">Add More <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
            <?php endif; ?>
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3>$53,000</h3>
                  <p>Total Donations</p>
                </div>
                <div class="icon">
                  <i class="fas fa-dollar-sign"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3>53</h3>
                  <p>Total Collection Points</p>
                </div>
                <div class="icon">
                  <i class="fas fa-dollar-sign"></i>
                </div>
                <a href="./collection_point.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
          </div>
          <!-- /.row -->
          <!-- Info boxes -->
          <div class="row">
            <div class="col-12">
              <!-- User Details Card -->
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">
                    <i class="fas fa-users mr-1"></i>
                    <?php
                    if (hasPermission('Super')) echo "Admin Details";
                    elseif (hasPermission('Admin')) echo "Manager Details";
                    else echo "Beneficiary Details";
                    ?>
                  </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <?php
                  if (hasPermission('Super')) {
                    if (isset($_GET['ben'])) {
                      displayBeneficiaryTable();
                    } elseif (isset($_GET['man'])) {
                      displayManagerTable();
                    } else {
                      displayAdminTable();
                    }
                  } elseif (hasPermission('Admin')) {
                    if (isset($_GET['ben'])) {
                      displayBeneficiaryTable();
                    } else {
                      displayManagerTable();
                    }
                  } else {
                    displayBeneficiaryTable();
                  }
                  ?>
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

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->
  <!-- Profile Modal -->
  <div class="modal fade" id="profileModal" tabindex="-1" role="dialog" aria-labelledby="profileModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="profileModalLabel">Admin Profile</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- Admin Profile Photo -->
          <div class="form-group text-center">
            <img src="../assets/images/admin/<?php echo $picture; ?>" alt="Admin Photo" class="img-thumbnail" id="adminPhoto" style="width: 150px; height: 150px;">
            <input type="file" class="form-control-file mt-2" id="adminPhotoUpload" name="picture">
          </div>

          <!-- Admin details form -->
          <form id="adminProfileForm">
            <div class="form-group">
              <label for="adminName">Name</label>
              <input type="text" class="form-control" id="adminName" name="name" value="<?php echo $admin_name ?>">
            </div>
            <div class="form-group">
              <label for="adminEmail">Email</label>
              <input type="email" class="form-control" id="adminEmail" name="email" value="<?php echo $admin_email ?>">
            </div>
            <!-- <div class="form-group">
              <label for="adminPassword">Password</label>
              <input type="text" class="form-control" id="adminPassword" name="password" value="<?php echo $admin_pa; ?>">
            </div> -->
            <div class="form-group">
              <label for="adminPhone">Phone Number</label>
              <input type="text" class="form-control" id="adminPhone" name="phone" value="<?php echo $admin_phone; ?>">
            </div>
            <div class="form-group">
              <label for="adminAddress">Address</label>
              <input type="text" class="form-control" id="adminAddress" name="address" value="<?php echo $admin_address; ?>">
            </div>
            <div class="form-group">
              <label for="adminRegBy">Registered By</label>
              <input type="text" class="form-control" id="adminRegBy" name="reg_by" value="<?php echo $admin_reg_by; ?>">
            </div>
            <div class="form-group">
              <label for="adminLGA">LGA</label>
              <input type="text" class="form-control" id="adminLGA" name="lga" value="<?php echo $admin_lga; ?>">
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="saveProfileChanges">Save changes</button>
        </div>
      </div>
    </div>
  </div>

  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
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
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>
  <!-- Page specific script -->
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
