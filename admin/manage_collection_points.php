<?php
session_start();
require_once "../assets/include/config.php";
require_once "../assets/include/fuctions.php";

// Check if user has permission
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || (!hasPermission('Admin') && !hasPermission('Super'))) {
    header("location:../login.php");
    exit;
}

$mysqli = Config::getInstance()->getConnection();

// Handle form submission for adding/editing collection points
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process form data and insert/update collection point in the database
    // Add your code here
}

// Fetch collection points from the database
$stmt = $mysqli->prepare("SELECT * FROM collection_points");
$stmt->execute();
$result = $stmt->get_result();
$collection_points = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Include your head content here -->
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Include your navbar and sidebar here -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <h1 class="m-0">Manage Collection Points</h1>
                </div>
            </div>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Add Collection Point Form -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Add Collection Point</h3>
                        </div>
                        <div class="card-body">
                            <form action="" method="POST">
                                <!-- Add form fields for name, address, LGA, ward, and capacity -->
                                <button type="submit" class="btn btn-primary">Add Collection Point</button>
                            </form>
                        </div>
                    </div>

                    <!-- Collection Points Table -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Collection Points</h3>
                        </div>
                        <div class="card-body">
                            <table id="collectionPointsTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Address</th>
                                        <th>LGA</th>
                                        <th>Ward</th>
                                        <th>Capacity</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($collection_points as $point): ?>
                                        <tr>
                                            <td><?php echo $point['name']; ?></td>
                                            <td><?php echo $point['address']; ?></td>
                                            <td><?php echo $point['lga']; ?></td>
                                            <td><?php echo $point['ward']; ?></td>
                                            <td><?php echo $point['capacity']; ?></td>
                                            <td>
                                                <!-- Add edit and delete buttons -->
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <!-- Include your footer here -->
    </div>

    <!-- Include your scripts here -->
    <script>
        $(function () {
            $("#collectionPointsTable").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#collectionPointsTable_wrapper .col-md-6:eq(0)');
        });
    </script>
</body>

</html>