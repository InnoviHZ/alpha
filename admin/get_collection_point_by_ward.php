<?php
require_once "../assets/include/fuctions.php";
$mysqli = Config::getInstance()->getConnection();  // Make sure this path is correct

function getCollectionPointByWard($ward)
{
  global $mysqli;
  $conn = $mysqli;

  $sql = "SELECT * FROM _PDCollection_points WHERE FIND_IN_SET(?, ward) > 0";

  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $ward);
  $stmt->execute();

  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    return $result->fetch_assoc();
  } else {
    return null;
  }
}

if (isset($_GET['ward'])) {
  $ward = $_GET['ward'];
  $collectionPoint = getCollectionPointByWard($ward);

  if ($collectionPoint) {
    echo json_encode($collectionPoint);
  } else {
    echo json_encode(['error' => 'No collection point found for the given ward']);
  }
} else {
  echo json_encode(['error' => 'Ward parameter is missing']);
}
