<?php
require_once "../assets/include/fuctions.php"; // Include the function definition

// Get the database connection
$mysqli = Config::getInstance()->getConnection();

if (isset($_GET['lga'])) {
    $lga = $_GET['lga'];
    $wardQuery = "SELECT DISTINCT ward FROM _PDUsers WHERE lga = ?";
    $stmt = $mysqli->prepare($wardQuery);
    $stmt->bind_param("s", $lga);
    $stmt->execute();
    $wardResult = $stmt->get_result();

    $wards = [];
    while ($row = $wardResult->fetch_assoc()) {
        $wards[] = $row['ward'];
    }

    echo json_encode($wards);
}
?>
