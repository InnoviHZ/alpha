<?php
session_start();
require_once "../assets/include/config.php";
require_once "../assets/include/fuctions.php";
require 'vendor/autoload.php'; // Add this line to include Composer autoloader

use PhpOffice\PhpSpreadsheet\IOFactory;

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location:../login.php");
    exit;
}

$id = $_SESSION["id"];
$email = $_SESSION["email"];
$name = $_SESSION["name"];
$type = $_SESSION["type"];
$picture = $_SESSION["picture"];

// Get the database connection
$mysqli = Config::getInstance()->getConnection();

// Handle file upload
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["bulkUploadFile"])) {
    $targetDir = "../uploads/";
    $targetFile = $targetDir . basename($_FILES["bulkUploadFile"]["name"]);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check file type
    if ($fileType != "xlsx" && $fileType != "xls") {
        echo "<script>alert('Sorry, only XLSX and XLS files are allowed.');</script>";
        $uploadOk = 0;
    }

    // Upload file
    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["bulkUploadFile"]["tmp_name"], $targetFile)) {
            echo "<script>alert('The file has been uploaded successfully.');</script>";

            // Process the uploaded Excel file
            $spreadsheet = IOFactory::load($targetFile);
            $worksheet = $spreadsheet->getActiveSheet();
            $highestRow = $worksheet->getHighestRow();

            // Prepare the SQL statement
            $sql = "INSERT INTO _PDUsers (full_name, yod, full_name_b, dob, gender, lga, ward, address, phone, email, id_number, benefit_type, photo, op_number, reg_by) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $mysqli->prepare($sql);

            // Loop through the rows and insert data
            for ($row = 2; $row <= $highestRow; $row++) { // Assuming first row is header
                $fullName = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                $yod = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                $fullNameB = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                $dob = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                $gender = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                $lga = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                $ward = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                $address = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                $phone = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
                $email = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
                $idNumber = generateUniqueId(); // Assuming this function exists
                $benefitType = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
                $photo = "default.jpg"; // You might want to handle this differently
                $opNumber = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
                $reg_by = $_SESSION['name'];

                $stmt->bind_param("sssssssssssssss", $fullName, $yod, $fullNameB, $dob, $gender, $lga, $ward, $address, $phone, $email, $idNumber, $benefitType, $photo, $opNumber, $reg_by);
                $stmt->execute();
            }

            $stmt->close();
            echo "<script>alert('Data has been successfully inserted into the database.');</script>";
        } else {
            echo "<script>alert('Sorry, there was an error uploading your file.');</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bulk Upload - AdminLTE Dashboard</title>
    <!-- Include CSS -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    <!-- Navbar and Sidebar code here (same as in your admin.php) -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Bulk Upload</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="admin.php">Home</a></li>
                            <li class="breadcrumb-item active">Bulk Upload</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Bulk Upload Beneficiaries</h3>
                            </div>
                            <div class="card-body">
                                <p>Download the template Excel file, fill it with beneficiary data, and upload it here.</p>
                                <a href="templates/beneficiary_template.xlsx" class="btn btn-primary mb-3" download>
                                    <i class="fas fa-download"></i> Download Template
                                </a>
                                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="bulkUploadFile">Select Excel File</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="bulkUploadFile" name="bulkUploadFile" accept=".xlsx, .xls">
                                                <label class="custom-file-label" for="bulkUploadFile">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-success">
                                        <i class="fas fa-upload"></i> Upload and Process
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Footer code here (same as in your admin.php) -->
</div>

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- bs-custom-file-input -->
<script src="plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script>
$(function () {
    bsCustomFileInput.init();
});
</script>
</body>
</html>
