<?php
// update_admin_details.php
session_start();
require_once "../assets/include/config.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $id = $_SESSION['id'];
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : null;  // Hash the password if provided
  $phone = $_POST['phone'];
  $address = $_POST['address'];
  $reg_by = $_POST['reg_by'];
  $lga = $_POST['lga'];

  // Handle profile photo upload
  if (isset($_FILES['picture']) && $_FILES['picture']['error'] == 0) {
    $target_dir = "../uploads/";
    $target_file = $target_dir . basename($_FILES["picture"]["name"]);
    if (move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file)) {
      $picture = $target_file;
    }
  } else {
    $picture = $_SESSION["picture"];  // Use existing picture if no new upload
  }

  // Update query
  $sql = "UPDATE admin_table SET name = ?, email = ?, phone = ?, address = ?, reg_by = ?, lga = ?, picture = ?";
  if ($password) {
    $sql .= ", password = ? WHERE id = ?";
  } else {
    $sql .= " WHERE id = ?";
  }

  if ($stmt = mysqli_prepare($link, $sql)) {
    if ($password) {
      mysqli_stmt_bind_param($stmt, "sssssssi", $name, $email, $phone, $address, $reg_by, $lga, $picture, $password, $id);
    } else {
      mysqli_stmt_bind_param($stmt, "ssssssi", $name, $email, $phone, $address, $reg_by, $lga, $picture, $id);
    }

    if (mysqli_stmt_execute($stmt)) {
      echo "Profile updated successfully!";
    } else {
      echo "Error updating profile.";
    }
  }
  mysqli_stmt_close($stmt);
  mysqli_close($link);
}
