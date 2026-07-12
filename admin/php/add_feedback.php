<?php
include_once('../../config.php');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = trim($_POST['name']);
  $email = trim($_POST['email']);
  $phone_no = trim($_POST['phone_no']);
  $company_name = trim($_POST['company_name']);
  $message = trim($_POST['message']);
  if (!isset($_POST['name'])) {
    echo json_encode(["success" => false, "message" => "Invalid form submission."]);
    exit;
}


  // Validate required fields
  if (empty($name) || empty($email) || empty($phone_no) || empty($company_name) || empty($message)) {
      echo json_encode(["success" => false, "message" => "All fields are required."]);
      exit;
  }

  // Validate email format
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      echo json_encode(["success" => false, "message" => "Invalid email format."]);
      exit;
  }

  // Validate phone number (10-15 digits)
  if (!preg_match("/^\d{10,15}$/", $phone_no)) {
      echo json_encode(["success" => false, "message" => "Phone number must be between 10 and 15 digits."]);
      exit;
  }

  // Prepare SQL statement
  $stmt = $conn->prepare("INSERT INTO feedback (name, company_name, email, mobile, msg) VALUES (?, ?, ?, ?, ?)");
  if (!$stmt) {
      echo json_encode(["success" => false, "message" => "Failed to prepare SQL statement."]);
      exit;
  }

  // Bind and execute statement
  $stmt->bind_param("sssss", $name, $company_name, $email, $phone_no, $message);
  if ($stmt->execute()) {
      echo json_encode(["success" => true, "message" => "Form submitted successfully."]);
  } else {
      echo json_encode(["success" => false, "message" => "Database error: " . $conn->error]);
  }

  $stmt->close();
}
?>
