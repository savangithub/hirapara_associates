<?php
session_start();
require_once(__DIR__ . '/../config.php');

// Avoid undefined index warning
$action = $_POST['action'] ?? '';
if (function_exists($action)) {
    $action($conn);
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Invalid API"
    ]);
}

/* ---------- LOGIN FUNCTION ---------- */
function login($conn) {
    // Collect POST data safely
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (!$email || !$password) {
        echo json_encode([
            "status" => "error",
            "message" => "Email and Password are required"
        ]);
        return;
    }

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE email=? AND password=? AND status=1 AND deleted_at IS NULL");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    // $stmt->debugDumpParams();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['user'] = $email;
        echo json_encode([
            "status" => "success",
            "message" => "Login Successful"
        ]);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Invalid Email or Password"
        ]);
    }

    $stmt->close();
}

/* ---------- LOGOUT FUNCTION ---------- */
function logout($conn) {
    session_destroy();
    echo json_encode([
        "status" => "success",
        "message" => "Logout Successful"
    ]);
}
?>