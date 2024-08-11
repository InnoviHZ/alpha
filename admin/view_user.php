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
                                    $sql = "SELECT full_name, yod, full_name_b, dob, gender, lga, ward, address, phone, email, id_number, benefit_type, photo, op_number, reg_by FROM _PDUsers WHERE id = ?";

                                    if ($stmt = $mysqli->prepare($sql)) {
                                        // Bind the user ID to the statement
                                        $stmt->bind_param("i", $userId);

                                        // Execute the statement
                                        $stmt->execute();

                                        // Bind the result to variables
                                        $stmt->bind_result($fullName, $yod, $fullNameB, $dob, $gender, $lga, $ward, $address, $phone, $email, $idNumber, $benefitType, $photo, $opNumber, $registeredBy);

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
                                            echo "<p><strong>ID Number:</strong> " . htmlspecialchars($idNumber) . "</p>";
                                            echo "<p><strong>Benefit Type:</strong> " . htmlspecialchars($benefitType) . "</p>";
                                            echo "<p><strong>Operation Number:</strong> " . htmlspecialchars($opNumber) . "</p>";
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
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
</div>
<!-- ./wrapper -->

<!-- AdminLTE JS -->
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1.0/dist/js/adminlte.min.js"></script>
<!-- Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
