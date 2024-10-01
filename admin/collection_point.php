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
  $state = $_POST['state'];
  $lga = $_POST['lga'];
  $wards = isset($_POST['wards']) ? $_POST['wards'] : []; // This will be an array of selected wards
  $address = $_POST['address'];
  $date = $_POST['date'];
  $time = $_POST['time'];

  // Convert the wards array to a comma-separated string
  $wardsString = implode(",", $wards);

  $sql = "INSERT INTO `_PDCollection_points`(`name`, `address`,`state`, `lga`, `ward`, `date` , `time`)
                    VALUES (?, ?, ?, ?, ?, ?, ?)";

  if ($stmt = $mysqli->prepare($sql)) {
    $stmt->bind_param("sssssss", $name, $address, $state, $lga, $wardsString, $date, $time);

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
                          <label for="state">State</label>
                          <select class="form-control" id="state" name="state">
                            <option value="">Select State</option>
                            <!-- States will be populated dynamically -->
                          </select>
                        </div>

                        <div class="form-group">
                          <label for="lga">Local Government Area (LGA)</label>
                          <select class="form-control" id="lga" name="lga">
                            <option value="">Select LGA</option>
                            <!-- LGAs will be populated dynamically -->
                          </select>
                        </div>

                        <div class="form-group">
                          <label>Wards</label>
                          <div id="wardsCheckboxes">
                            <!-- Wards checkboxes will be populated dynamically -->
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="address">Address:</label>
                          <textarea class="form-control" id="address" name="address"></textarea>
                        </div>
                        <div class="form-group">
                          <label for="date">Date of collection:</label>
                          <input type="date" class="form-control" id="date" name="date" required>
                        </div>
                        <div class="form-group">
                          <label for="time">Time of collection:</label>
                          <input type="time" class="form-control" id="time" name="time" required>
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
              <?php
              if (isset($_GET['id'])) {
                $c_id = $_GET['id'];

                // Define the SQL query to fetch user details
                $sql = "SELECT * FROM _PDCollection_points WHERE id = $c_id";
                $result = $mysqli->query($sql);
                $row = $result->fetch_assoc();

                $name = $row["name"];
                $address = $row["address"];
                $state = $row["state"];
                $lga = $row["lga"];
                $ward = $row["ward"];
                $date = $row["date"];
                $time = $row["time"];
              ?>
                <script>
                  document.getElementById('CollectionPointForm').style.display = 'none';
                </script>
                <!-- User update form -->
                <div class="card card-primary" id="updateCollectionPointForm">
                  <div class="card-header">
                    <h3 class="card-title">update Collection Point</h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <form method="post">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?php echo $name ?>" required>
                          </div>
                          <div class="form-group">
                            <label for="state">State</label>
                            <select class="form-control" id="state" name="state">
                              <option value="">Select State</option>
                              <!-- States will be populated dynamically -->
                            </select>
                          </div>

                          <div class="form-group">
                            <label for="lga">Local Government Area (LGA)</label>
                            <select class="form-control" id="lga" name="lga">
                              <option value="">Select LGA</option>
                              <!-- LGAs will be populated dynamically -->
                            </select>
                          </div>

                          <div class="form-group">
                            <label>Wards</label>
                            <div id="wardsCheckboxes">
                              <!-- Wards checkboxes will be populated dynamically -->
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="address">Address:</label>
                            <textarea class="form-control" id="address" name="address"><?php echo $address ?></textarea>
                          </div>
                          <div class="form-group">
                            <label for="date">Date of collection:</label>
                            <input type="date" class="form-control" id="date" name="date" value="<?php echo $date ?>" required>
                          </div>
                          <div class="form-group">
                            <label for="time">Time of collection:</label>
                            <input type="time" class="form-control" id="time" name="time" value="<?php echo $time ?>" required>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <input type="submit" name="update" class="btn btn-primary"  value="Update">
                        <a href="./collection_point.php"><button type="button" class="btn btn-secondary" onclick="goBack()">Cancel</button></a>
                      </div>
                    </form>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->

              <?php }
              ?>
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

  <!-- AdminLTE JS -->
  <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1.0/dist/js/adminlte.min.js"></script>
  <!-- Bootstrap JS and dependencies -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

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
          data: {
            lga: lga
          },
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
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function() {
      var locationsData;

      // Load the JSON data
      $.getJSON('locations.json', function(data) {
        locationsData = data.states;

        // Populate the states dropdown
        for (var state in locationsData) {
          $('#state').append('<option value="' + state + '">' + state + '</option>');
        }
      });

      // Handle State change
      $('#state').change(function() {
        var state = $(this).val();
        $('#lga').html('<option value="">Select LGA</option>');
        $('#wardsCheckboxes').empty();

        if (state && locationsData[state]) {
          var lgas = locationsData[state].LGAs;
          for (var lga in lgas) {
            $('#lga').append('<option value="' + lga + '">' + lga + '</option>');
          }
        }
      });

      // Handle LGA change
      $('#lga').change(function() {
        var state = $('#state').val();
        var lga = $(this).val();
        $('#wardsCheckboxes').empty();

        if (state && lga && locationsData[state].LGAs[lga]) {
          var wards = locationsData[state].LGAs[lga];
          for (var i = 0; i < wards.length; i++) {
            $('#wardsCheckboxes').append(
              '<div class="form-check">' +
              '<input class="form-check-input" type="checkbox" name="wards[]" value="' + wards[i] + '" id="ward' + i + '">' +
              '<label class="form-check-label" for="ward' + i + '">' + wards[i] + '</label>' +
              '</div>'
            );
          }
        }
      });
    });
  </script>
</body>

</html>
