<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// require 'vendor/autoload.php'; // Include PHPMailer
require __DIR__ . '/../vendor/autoload.php';

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hirapara";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$mail = new PHPMailer(true);

try {
    $name= $_POST['name'];
    $email=$_POST['email'];
    $phone_no=$_POST['phone_no'];
    $company_name= $_POST['company_name'];
    $message =$_POST['message'];

    $stmt = $conn->prepare("INSERT INTO feedback (name,company_name, email, mobile, msg) VALUES (?, ?, ?,?, ?)");
    $stmt->bind_param("sssss", $name, $company_name,$email,$phone_no, $message);
    $stmt->execute();
    $stmt->close();

    // SMTP settings
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com'; // Change for other providers
    $mail->SMTPAuth = true;
    $mail->Username = 'savanhirpara97@gmail.com'; // Your email
    $mail->Password = 'pavn dyqw qiml gavh'; // Use an App Password (not your Gmail password)
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Email settings
    $mail->setFrom('savanhirpara97@gmail.com', 'Savanhirpara'); // Sender email
    $mail->addAddress('savan@mailinator.com', 'savan patel'); // Receiver email
    $mail->Subject = 'Test Email';
    $mail->Body = "
    <div style='font-family: Arial, sans-serif; padding: 20px;'>
        <img src='https://yourwebsite.com/logo.png' width='100'>
        <h2>New Contact Message</h2>
        <p><strong>Name:</strong> $name</p>
        <p><strong>Email:</strong> $email</p>
        <p><strong>Message:</strong></p>
        <p>$message</p>
    </div>
";
    if ($mail->send()) {

        $response["success"] = true;
        $response["message"] = "Form submited successfully.";
    } else {
        $response["error"] = "Failed to send email.";
    }
    echo json_encode($response);


} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
