<?php
session_start();
require_once "../assets/include/config.php";

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location:../login.php");
    exit;
}

$mysqli = Config::getInstance()->getConnection();

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];
    $sql = "SELECT * FROM _PDUsers WHERE id = ?";
    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("i", $user_id);
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($row = $result->fetch_assoc()) {
                // Display user details
                echo "<h2>User Details</h2>";
                echo "<p><strong>Full Name:</strong> " . htmlspecialchars($row['full_name']) . "</p>";
                echo "<p><strong>Year of Death:</strong> " . htmlspecialchars($row['yod']) . "</p>";
                echo "<p><strong>Beneficiary Name:</strong> " . htmlspecialchars($row['full_name_b']) . "</p>";
                echo "<p><strong>Date of Birth:</strong> " . htmlspecialchars($row['dob']) . "</p>";
                echo "<p><strong>Gender:</strong> " . htmlspecialchars($row['gender']) . "</p>";
                echo "<p><strong>LGA:</strong> " . htmlspecialchars($row['lga']) . "</p>";
                echo "<p><strong>Ward:</strong> " . htmlspecialchars($row['ward']) . "</p>";
                echo "<p><strong>Address:</strong> " . htmlspecialchars($row['address']) . "</p>";
                echo "<p><strong>Phone:</strong> " . htmlspecialchars($row['phone']) . "</p>";
                echo "<p><strong>Email:</strong> " . htmlspecialchars($row['email']) . "</p>";
                echo "<p><strong>ID Number:</strong> " . htmlspecialchars($row['id_number']) . "</p>";
                echo "<p><strong>Benefit Type:</strong> " . htmlspecialchars($row['benefit_type']) . "</p>";
                echo "<p><strong>Number of Orphans:</strong> " . htmlspecialchars($row['op_number']) . "</p>";
                echo "<a href='users.php' class='btn btn-primary'>Back to User List</a>";
            } else {
                echo "User not found.";
            }
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error: " . $mysqli->error;
    }
} else {
    echo "Invalid request.";
}