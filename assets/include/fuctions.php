<?php
require_once "../assets/include/config.php"; // Include the config file

// Function to fetch all user details and display them in a table
function displayUsersTable()
{
    // Get the database connection
    $mysqli = Config::getInstance()->getConnection();

    // Define the SQL query to fetch user details
    $sql = "SELECT * FROM _PDUsers";

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
                echo '<td>' . $counter . '</td>';
                echo '<td>' . htmlspecialchars($row['full_name']) . '</td>';
                echo '<td>' . htmlspecialchars($row['address']) . '</td>';
                echo '<td>' . htmlspecialchars($row['phone']) . '</td>';
                echo '<td>' . htmlspecialchars($row['reg_by']) . '</td>';
                echo '<td>';
                echo '<button class="btn btn-primary btn-sm">View</button> ';
                echo '<button class="btn btn-warning btn-sm">Update</button> ';
                echo '<form method="POST" action="delete_user.php" style="display:inline-block;">';
                echo '<input type="hidden" name="user_id" value="' . $row['id'] . '">';
                echo '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure you want to delete this user?\')">Delete</button>';
                echo '</form>';                echo '</td>';
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
