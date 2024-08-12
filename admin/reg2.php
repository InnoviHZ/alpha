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
  $fullName = $_POST['fullName'];
  $yod = $_POST['yod'];
  $fullNameB = $_POST['fullNameB'];
  $dob = $_POST['dob'];
  $gender = $_POST['gender'];
  $lga = $_POST['lga'];
  $ward = $_POST['ward'];
  $address = $_POST['address'];
  $phone = $_POST['phone'];
  $email = $_POST['email'];
  $idNumber = generateUniqueId();
  $benefitType = $_POST['benefitType'];
  $photo = $_FILES["photo"]["name"];
  $opNumber = $_POST['opNumber'];
  $reg_by = $_SESSION['name'];

  // Handle file upload
  $targetDir = "../assets/images/beneficiaries/";
  $fileType = pathinfo($_FILES["photo"]["name"], PATHINFO_EXTENSION);
  $newFileName = $idNumber . '.' . $fileType; // Rename the file using the unique ID
  $targetFilePath = $targetDir . $newFileName;

  // Allow certain file formats
  $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
  if (in_array($fileType, $allowTypes)) {
    // Upload file to server
    if (move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFilePath)) {
      // Insert beneficiary data into database
      $sql = "INSERT INTO _PDUsers (full_name, yod, full_name_b, dob, gender, lga, ward, address, phone, email, id_number, benefit_type, photo, op_number,reg_by)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ? , ?)";

      if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("sssssssssssssss", $fullName, $yod, $fullNameB, $dob, $gender, $lga, $ward, $address, $phone, $email, $idNumber, $benefitType, $photo, $opNumber, $reg_by);

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
                        Your registration was successful. would you like to do go back to Dashboard?
                    </div>
                    <div class='modal-footer'>
                        <a href='admin.php'><button type='button' class='btn btn-primary'>Go back to Dashboard</button></a>
                        <button type='button' class='btn btn-secondary' data-dismiss='modal'>No Continue</button>
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
  <title>Beneficiary Registration - AdminLTE Dashboard</title>
  <!-- Include CSS -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Toastr CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">


  <!-- Toastr JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

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
              <h1 class="m-0">Beneficiary Registration</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Beneficiary Registration</li>
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
                  <h3 class="card-title">Register New Beneficiary</h3>
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
                  <form id="beneficiaryForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="fullName">Full Name of Late</label>
                      <input type="text" class="form-control" id="fullName" name="fullName" required>
                    </div>
                    <div class="form-group">
                      <label for="yod">Year of Death</label>
                      <input type="date" class="form-control" id="yod" name="yod" required>
                    </div>
                    <div class="form-group">
                      <label for="fullNameB">Full Name of Beneficiary</label>
                      <input type="text" class="form-control" id="fullNameB" name="fullNameB" required>
                    </div>
                    <div class="form-group">
                      <label for="dob">Date of Birth</label>
                      <input type="date" class="form-control" id="dob" name="dob" required>
                    </div>
                    <div class="form-group">
                      <label for="gender">Gender</label>
                      <select class="form-control" id="gender" name="gender" required>
                        <option value="">Select Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="lga">Local Government Area (LGA)</label>
                      <select class="form-control" id="lga" name="lga" onchange="updateWards()" required>
                        <option value="">Select LGA</option>
                        <option value="Alkaleri">Alkaleri</option>
                        <option value="Bauchi">Bauchi</option>
                        <option value="Bogoro">Bogoro</option>
                        <option value="Dambam">Dambam</option>
                        <option value="Dass">Dass</option>
                        <option value="Ganjuwa">Ganjuwa</option>
                        <option value="Giade">Giade</option>
                        <option value="Itas/Gadau">Itas/Gadau</option>
                        <option value="Jama'are">Jama'are</option>
                        <option value="Katagum">Katagum</option>
                        <option value="Kirfi">Kirfi</option>
                        <option value="Misau">Misau</option>
                        <option value="Ningi">Ningi</option>
                        <option value="Shira">Shira</option>
                        <option value="Tafawa Balewa">Tafawa Balewa</option>
                        <option value="Toro">Toro</option>
                        <option value="Warji">Warji</option>
                        <option value="Zaki">Zaki</option>
                        <option value="Darazo">Darazo</option>
                        <option value="Gamawa">Gamawa</option>
                        <!-- Add more LGAs here -->
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="ward">Ward</label>
                      <select class="form-control" id="ward" name="ward" required>
                        <option value="">Select Ward</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="address">Address</label>
                      <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                      <label for="opNumber">Number of Orphans</label>
                      <input type="text" class="form-control" id="opNumber" name="opNumber" required>
                    </div>
                    <div class="form-group">
                      <label for="phone">Phone Number</label>
                      <input type="tel" class="form-control" id="phone" name="phone" required>
                    </div>
                    <div class="form-group">
                      <label for="email">Email</label>
                      <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <!-- <div class="form-group">
                      <label for="idNumber">ID Number</label>
                      <input type="text" class="form-control" id="idNumber" name="idNumber" required>
                    </div> -->
                    <div class="form-group">
                      <label for="benefitType">Benefit Type</label>
                      <select class="form-control" id="benefitType" name="benefitType" required>
                        <option value="">Select Benefit Type</option>
                        <option value="financial">Financial Aid</option>
                        <option value="medical">Medical Assistance</option>
                        <option value="education">Education Support</option>
                        <option value="housing">Housing Assistance</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="photo">Photo</label>
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="photo" name="photo" accept="image/*" required>
                        <label class="custom-file-label" for="photo">Choose file</label>
                      </div>
                      <img id="imagePreview" src="#" alt="Image Preview" style="display:none;">
                    </div>
                    <button type="submit" class="btn btn-primary">Register Beneficiary</button>
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
    <!-- Footer code here (same as before) -->
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
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <!-- Toastr JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <script>
    $(function() {
      bsCustomFileInput.init();

      // Image preview
      $("#photo").change(function() {
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


    const lgaWards = {
      "Alkaleri": ["Alkaleri", "Gar", "Gwa'na", "Kasshi", "Mado", "Pali", "Yelwa"],
      "Bauchi": ["Birshi", "Dan'iya", "Danlami", "Dawaki", "Galambi", "Hardo", "Makama Sarkin Baki"],
      "Bogoro": ["Bogoro", "Boi", "Lusa", "Mallam Sidi", "Tafawa Balewa"],
      "Dambam": ["Dambam", ""],
      "Dass": ["Dass", ""],
      "Ganjuwa": ["Ganjuwa", "Birni", "Ganjuwa", "Kankara", "Kazali", "Makoda", "Rano", "Sabon Gari"],
      "Giade": ["Giade", ""],
      "Itas/Gadau": ["Itas/Gadau", "Birni", "Gadau"],
      "Katagum": ["Katagum", "Azare"],
      "Kirfi": ["Kirfi", ""],
      "Misau": ["Misau", ""],
      "Ningi": ["Ningi", "Birni", "Gadau", "Kankara", "Kazali", "Makoda", "Rano", "Sabon Gari"],
      "Shira": ["Shira", ""],
      "Tafawa Balewa": ["Tafawa Balewa", "Birni", "Gadau", "Kankara", "Kazali", "Makoda", "Rano", "Sabon Gari"],
      "Toro": ["Toro", "Birni", "Gadau", "Kankara", "Kazali", "Makoda", "Rano", "Sabon Gari"],
      "Warji": ["Warji", ""],
      "Zaki": ["Zaki", "Birni", "Gadau", "Kankara", "Kazali", "Makoda", "Rano", "Sabon Gari"],
      "Darazo": ["Darazo", "Birni", "Gadau", "Kankara", "Kazali", "Makoda", "Rano", "Sabon Gari"],
      "Gamawa": ["Gamawa", ""],
      // Add more LGAs and their respective wards here
    };

    function updateWards() {
      const lgaSelect = document.getElementById("lga");
      const wardSelect = document.getElementById("ward");
      const selectedLGA = lgaSelect.value;

      // Clear existing options
      wardSelect.innerHTML = "<option value=''>Select Ward</option>";

      if (selectedLGA in lgaWards) {
        lgaWards[selectedLGA].forEach(ward => {
          const option = document.createElement("option");
          option.value = ward;
          option.textContent = ward;
          wardSelect.appendChild(option);
        });
      }
    }
  </script>
</body>

</html>
