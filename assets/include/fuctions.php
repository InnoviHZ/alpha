<?php
require_once "../assets/include/config.php"; // Include the config file

// Function to fetch all user details and display them in a table
function displayBeneficiaryTable()
{
    // Get the database connection
    $mysqli = Config::getInstance()->getConnection();

    // Define the SQL query to fetch user details
    $sql = "SELECT * FROM _PDUsers ";

    // Execute the query
    if ($result = $mysqli->query($sql)) {
        if ($result->num_rows > 0) {
            // Start generating the HTML table
            echo '<table id="userTable" class="table table-bordered table-striped">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>#</th>';
            echo '<th>Name</th>';
            echo '<th>Address</th>';
            echo '<th>Phone Number</th>';
            echo '<th>Registered By</th>';
            echo '<th>Actions</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';

            // Fetch and display each row of user data
            $counter = 1;
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $counter;

                echo '<td>' . htmlspecialchars($row['full_name']) . '</td>';
                echo '<td>' . htmlspecialchars($row['address']) . '</td>';
                echo '<td>' . htmlspecialchars($row['phone']) . '</td>';
                echo '<td>' . htmlspecialchars($row['reg_by']) . '</td>';
                echo '<td>';
                echo '<a href="view_user.php?id=' . $row['id'] . '" class="btn btn-primary btn-sm">View</a> ';
                echo '<a href="update_user.php?id=' . $row['id'] . '" class="btn btn-warning btn-sm">Update</a> ';
                echo '<form method="POST" action="delete_user.php" style="display:inline-block;">';
                echo '<input type="hidden" name="user_id" value="' . $row['id'] . '">';
                echo '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure you want to delete this user?\')">Delete</button>';
                echo '</form>';
                echo '</td>';
                echo '</tr>';
                $counter++;
            }
            echo '</tbody>';
            echo '</table>';
        } else {
            echo '<p>No users found.</p>';
        }
        // Free result set
        $result->free();
    } else {
        echo 'Error: ' . $mysqli->error;
    }
}

function displayManagerTable()
{
    // Get the database connection
    $mysqli = Config::getInstance()->getConnection();

    // Define the SQL query to fetch user details
    $sql = "SELECT * FROM _PDAdmin  WHERE type = 'Manager'";

    // Execute the query
    if ($result = $mysqli->query($sql)) {
        if ($result->num_rows > 0) {
            // Start generating the HTML table
            echo '<table id="userTable" class="table table-bordered table-striped">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>#</th>';
            echo '<th>Name</th>';
            echo '<th>Address</th>';
            echo '<th>Phone Number</th>';
            echo '<th>Local Gov</th>';
            echo '<th>Email</th>';
            echo '<th>Registered By</th>';
            echo '<th>Actions</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';

            // Fetch and display each row of user data
            $counter = 1;
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $counter;

                echo '<td>' . htmlspecialchars($row['name']) . '</td>';
                echo '<td>' . htmlspecialchars($row['address']) . '</td>';
                echo '<td>' . htmlspecialchars($row['phone']) . '</td>';
                echo '<td>' . htmlspecialchars($row['lga']) . '</td>';
                echo '<td>' . htmlspecialchars($row['email']) . '</td>';
                echo '<td>' . htmlspecialchars($row['reg_by']) . '</td>';
                echo '<td>';
                echo '<a href="view_user.php?id=' . $row['id'] . '" class="btn btn-primary btn-sm">View</a> ';
                echo '<a href="update_user.php?id=' . $row['id'] . '" class="btn btn-warning btn-sm">Update</a> ';
                echo '<form method="POST" action="delete_user.php" style="display:inline-block;">';
                echo '<input type="hidden" name="user_id" value="' . $row['id'] . '">';
                echo '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure you want to delete this user?\')">Delete</button>';
                echo '</form>';
                echo '</td>';
                echo '</tr>';
                $counter++;
            }
            echo '</tbody>';
            echo '</table>';
        } else {
            echo '<p>No users found.</p>';
        }
        // Free result set
        $result->free();
    } else {
        echo 'Error: ' . $mysqli->error;
    }
}

function displayAdminTable()
{
    // Get the database connection
    $mysqli = Config::getInstance()->getConnection();

    // Define the SQL query to fetch user details
    $sql = "SELECT * FROM _PDAdmin  WHERE type = 'Admin'";

    // Execute the query
    if ($result = $mysqli->query($sql)) {
        if ($result->num_rows > 0) {
            // Start generating the HTML table
            echo '<table id="userTable" class="table table-bordered table-striped">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>#</th>';
            echo '<th>Name</th>';
            echo '<th>Address</th>';
            echo '<th>Phone Number</th>';
            echo '<th>Local Gov</th>';
            echo '<th>Email</th>';
            echo '<th>Registered By</th>';
            echo '<th>Actions</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';

            // Fetch and display each row of user data
            $counter = 1;
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $counter;

                echo '<td>' . htmlspecialchars($row['name']) . '</td>';
                echo '<td>' . htmlspecialchars($row['address']) . '</td>';
                echo '<td>' . htmlspecialchars($row['phone']) . '</td>';
                echo '<td>' . htmlspecialchars($row['lga']) . '</td>';
                echo '<td>' . htmlspecialchars($row['email']) . '</td>';
                echo '<td>' . htmlspecialchars($row['reg_by']) . '</td>';
                echo '<td>';
                echo '<a href="view_user.php?id=' . $row['id'] . '" class="btn btn-primary btn-sm">View</a> ';
                echo '<a href="update_user.php?id=' . $row['id'] . '" class="btn btn-warning btn-sm">Update</a> ';
                echo '<form method="POST" action="delete_user.php" style="display:inline-block;">';
                echo '<input type="hidden" name="user_id" value="' . $row['id'] . '">';
                echo '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure you want to delete this user?\')">Delete</button>';
                echo '</form>';
                echo '</td>';
                echo '</tr>';
                $counter++;
            }
            echo '</tbody>';
            echo '</table>';
        } else {
            echo '<p>No users found.</p>';
        }
        // Free result set
        $result->free();
    } else {
        echo 'Error: ' . $mysqli->error;
    }
}

// Function to check if the current user has the required permission
function hasPermission($requiredRole)
{
    $roleHierarchy = ['Super' => 3, 'Admin' => 2, 'Manager' => 1];
    return $roleHierarchy[$_SESSION['type']] >= $roleHierarchy[$requiredRole];
}


function generateUniqueId()
{
    // Get the current year
    $currentYear = date('Y');

    // Extract the last two digits of the year
    $lastTwoDigits = substr($currentYear, -2);

    // Define the prefix
    $prefix = $lastTwoDigits;

    // Generate a random 6-byte value and convert it to a hexadecimal string
    // This ensures the suffix part is 9 characters or less
    $randomNumber = sprintf('%08d', mt_rand(0, 99999999)); // 10-digit random number

    // Use only the first 7 characters of the random bytes to leave space for 2 random letters
    $suffix = $randomNumber;

    // Generate two random letters
    $letters = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 2);

    // Combine the prefix, suffix, and letters to form the unique ID
    $uniqueId = $prefix . $suffix . $letters;

    return $uniqueId;
}
