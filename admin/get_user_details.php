<?php
require_once "../assets/include/fuctions.php"; // Include the function definition

// Get the database connection
$mysqli = Config::getInstance()->getConnection();

if (isset($_GET['key'])) {
    $key = $_GET['key'];
    $query = "SELECT * FROM _PDUsers WHERE id_number = ? OR phone_number = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("ss", $key, $key);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();

    if ($result) {
        // Fetch collection point details based on the ward
        $ward = $result['ward'];
        $collectionQuery = "SELECT * FROM _PDCollection_points WHERE ward = ?";
        $collectionStmt = $mysqli->prepare($collectionQuery);
        $collectionStmt->bind_param("s", $ward);
        $collectionStmt->execute();
        $collectionResult = $collectionStmt->get_result()->fetch_assoc();

        $result['collection_point'] = $collectionResult;
    }

    echo json_encode($result);
} else {
    echo json_encode(["error" => "No key provided"]);
}
?>
