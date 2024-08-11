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
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Update User Details</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active">Update User</li>
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
                        <!-- User update form -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Update User Details</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <?php
                                require_once "../assets/include/config.php"; // Include the config file

                                // Check if user ID is provided in the query string
                                if (isset($_GET['id'])) {
                                    $userId = $_GET['id'];
                                    $mysqli = Config::getInstance()->getConnection();

                                    // Handle form submission
                                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                        // Collect updated data from form
                                        $fullName = $_POST['full_name'];
                                        $yod = $_POST['yod'];
                                        $fullNameB = $_POST['full_name_b'];
                                        $dob = $_POST['dob'];
                                        $gender = $_POST['gender'];
                                        $lga = $_POST['lga'];
                                        $ward = $_POST['ward'];
                                        $address = $_POST['address'];
                                        $phone = $_POST['phone'];
                                        $email = $_POST['email'];
                                        $idNumber = $_POST['id_number'];
                                        $benefitType = $_POST['benefit_type'];
                                        $opNumber = $_POST['op_number'];

                                        // Prepare SQL statement to update user details
                                        $sql = "UPDATE _PDUsers SET full_name=?, yod=?, full_name_b=?, dob=?, gender=?, lga=?, ward=?, address=?, phone=?, email=?, id_number=?, benefit_type=?, op_number=? WHERE id=?";

                                        if ($stmt = $mysqli->prepare($sql)) {
                                            $stmt->bind_param("sssssssssssssi", $fullName, $yod, $fullNameB, $dob, $gender, $lga, $ward, $address, $phone, $email, $idNumber, $benefitType, $opNumber, $userId);

                                            if ($stmt->execute()) {
                                                echo "<div class='alert alert-success'>User details updated successfully.</div>";
                                                header("Location:./view_user.php?id=$userId");
                                            } else {
                                                echo "<div class='alert alert-danger'>Error updating user details: " . $stmt->error . "</div>";
                                            }
                                            $stmt->close();
                                        }
                                    }

                                    // Fetch current user data
                                    $sql = "SELECT full_name, yod, full_name_b, dob, gender, lga, ward, address, phone, email, id_number, benefit_type, photo, op_number FROM _PDUsers WHERE id = ?";
                                    if ($stmt = $mysqli->prepare($sql)) {
                                        $stmt->bind_param("i", $userId);
                                        $stmt->execute();
                                        $stmt->bind_result($fullName, $yod, $fullNameB, $dob, $gender, $lga, $ward, $address, $phone, $email, $idNumber, $benefitType, $photo, $opNumber);
                                        $stmt->fetch();
                                        $stmt->close();
                                    }
                                ?>
                                <form method="post">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="full_name">Name:</label>
                                                <input type="text" class="form-control" id="full_name" name="full_name" value="<?php echo htmlspecialchars($fullName); ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="yod">Year of Death:</label>
                                                <input type="text" class="form-control" id="yod" name="yod" value="<?php echo htmlspecialchars($yod); ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="full_name_b">Beneficiary Name:</label>
                                                <input type="text" class="form-control" id="full_name_b" name="full_name_b" value="<?php echo htmlspecialchars($fullNameB); ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="dob">Date of Birth:</label>
                                                <input type="date" class="form-control" id="dob" name="dob" value="<?php echo htmlspecialchars($dob); ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="gender">Gender:</label>
                                                <select class="form-control" id="gender" name="gender">
                                                    <option value="Male" <?php echo ($gender == 'Male') ? 'selected' : ''; ?>>Male</option>
                                                    <option value="Female" <?php echo ($gender == 'Female') ? 'selected' : ''; ?>>Female</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="lga">LGA:</label>
                                                <input type="text" class="form-control" id="lga" name="lga" value="<?php echo htmlspecialchars($lga); ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="ward">Ward:</label>
                                                <input type="text" class="form-control" id="ward" name="ward" value="<?php echo htmlspecialchars($ward); ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="address">Address:</label>
                                                <textarea class="form-control" id="address" name="address"><?php echo htmlspecialchars($address); ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="phone">Phone:</label>
                                                <input type="tel" class="form-control" id="phone" name="phone" value="<?php echo htmlspecialchars($phone); ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email:</label>
                                                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="id_number">ID Number:</label>
                                                <input type="text" class="form-control" id="id_number" name="id_number" value="<?php echo htmlspecialchars($idNumber); ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="benefit_type">Benefit Type:</label>
                                                <input type="text" class="form-control" id="benefit_type" name="benefit_type" value="<?php echo htmlspecialchars($benefitType); ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="op_number">Operation Number:</label>
                                                <input type="text" class="form-control" id="op_number" name="op_number" value="<?php echo htmlspecialchars($opNumber); ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Current Photo:</label><br>
                                                <img src="../assets/images/beneficiaries/<?php echo htmlspecialchars($photo); ?>" alt="User Photo" class="img-fluid img-thumbnail" style="max-width: 200px;">
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Update User</button>
                                </form>
                                <?php
                                } else {
                                    echo "<p class='text-danger'>Error: No user ID provided.</p>";
                                }
                                ?>
                                <a href="admin.php" class="btn btn-secondary mt-3">Back to Users List</a>
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
