<?php
require_once "../assets/include/config.php"; // Include the config file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the database connection
    $mysqli = Config::getInstance()->getConnection();

    // Get the user ID from the POST data
    $userId = $_POST['user_id'];

    // Prepare the DELETE statement
    $sql = "DELETE FROM _PDUsers WHERE id = ?";

    if ($stmt = $mysqli->prepare($sql)) {
        // Bind the user ID to the statement
        $stmt->bind_param("i", $userId);

        // Execute the statement
        if ($stmt->execute()) {
            // Redirect back to the page with the user table
            header("Location: ../admin/admin.php"); // Change this to the correct page where the table is displayed
            exit;
        } else {
            echo "Error: Could not execute the delete operation.";
        }
        $stmt->close();
    } else {
        echo "Error: Could not prepare the delete statement.";
    }
}
