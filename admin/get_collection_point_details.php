<?php
header('Content-Type: application/json');
require_once "../assets/include/fuctions.php";
$mysqli = Config::getInstance()->getConnection();

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $sql = "SELECT * FROM _PDCollection_points WHERE id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $collectionPoint = $result->fetch_assoc();
        echo json_encode($collectionPoint);
    } else {
        echo json_encode(null);
    }
} else {
    echo json_encode(['error' => 'No ID provided']);
}

$mysqli->close();
