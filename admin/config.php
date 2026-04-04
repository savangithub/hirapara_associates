<?php
define("BASE_URL", "http://localhost/hirapara/admin/");

$servername = "localhost";  // or 127.0.0.1
$username = "root";         // MySQL username
$password = "";             // MySQL password (XAMPP default is empty)
$dbname = "hirapara";

// $conn = new mysqli($servername, $username, $password, $dbname);
$conn = new mysqli("127.0.0.1", "root", "", "hirapara", 3307);

if ($conn->connect_error) {
    die("❌ Connection failed: " . $conn->connect_error);
}

?>