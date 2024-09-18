<?php
ini_set('display_errors', 'Off');
require_once "../assets/include/fuctions.php";

$mysqli = Config::getInstance()->getConnection();

header('Content-Type: application/json');

if (isset($_GET['key'])) {
  $key = $_GET['key'];
  $query = "SELECT * FROM _PDUsers WHERE id_number = ? OR phone = ?";
  $stmt = $mysqli->prepare($query);
  $stmt->bind_param("ss", $key, $key);
  $stmt->execute();
  $result = $stmt->get_result()->fetch_assoc();


  if ($result) {
    echo json_encode($result);
  } else {
    echo json_encode(["error" => "User not found"]);
  }
} else {
  echo json_encode(["error" => "No key provided"]);
}
