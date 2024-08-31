<?php
require_once "../assets/include/fuctions.php"; // Include the function definition

// Get the database connection
$mysqli = Config::getInstance()->getConnection();

if (isset($_GET['ward'])) {
    $ward = $_GET['ward'];
    $query = "SELECT * FROM _PDCollection_points WHERE ward = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("s", $ward);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();

    echo json_encode($result);
}
?>
