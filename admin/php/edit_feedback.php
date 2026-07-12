<?php
include_once('../../config.php');
session_start();

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Sanitize & fetch data
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $company_name = trim($_POST['company_name']);
    $phone = trim($_POST['phone']);
    $message = trim($_POST['message']);

    if ($id <= 0) {
        echo json_encode(["success" => false, "message" => "Invalid ID!"]);
        exit;
    }

    // Prepare and bind
    $stmt = $conn->prepare("UPDATE feedback SET name = ?, email = ?, company_name = ?, mobile = ?, msg = ? WHERE id = ?");
    $stmt->bind_param("sssssi", $name, $email, $company_name, $phone, $message, $id);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Feedback updated successfully!"]);
    } else {
        echo json_encode(["success" => false, "message" => "Error updating record: " . $conn->error]);
    }

    $stmt->close();
} else {
    echo json_encode(["success" => false, "message" => "Invalid request method."]);
}
?>
