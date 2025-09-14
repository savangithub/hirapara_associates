<?php
$servername = "localhost";  // or 127.0.0.1
$username = "root";         // MySQL username
$password = "";             // MySQL password (XAMPP default is empty)
$dbname = "hirapara";

$conn = new mysqli($servername, $username, $password, $dbname);
print_r('code');
die();
if ($conn->connect_error) {
    die("❌ Connection failed: " . $conn->connect_error);
}
echo "✅ Connected successfully";
?>