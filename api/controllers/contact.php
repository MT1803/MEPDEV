<?php
header('Content-Type: application/json');
require '../../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Read JSON input
$input = json_decode(file_get_contents('php://input'), true);

$name = trim($input['name'] ?? '');
$email = trim($input['email'] ?? '');
$message = trim($input['message'] ?? '');
$lang = trim($input['lang'] ?? 'en');

if (empty($name) || empty($email) || empty($message)) {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'All fields are required']);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Invalid email format']);
    exit;
}

$mail = new PHPMailer(true);

try {
    $mail->SMTPDebug = 2;
    $mail->Debugoutput = 'html';
    // SMTP configuration
    $mail->isSMTP();
    $mail->Host       = 'mail.mepteam.pro';  // Change to your SMTP server
    $mail->SMTPAuth   = true;
    $mail->Username   = 'info@mepteam.pro';  // Your email address
    $mail->Password   = '^5ID6.u)VlrL'; // Your email password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // or PHPMailer::ENCRYPTION_SMTPS for SSL
    $mail->Port       = 587;                   // or 465 for SSL

    // Recipients
    $mail->setFrom('info@mepteam.pro', 'MEP Team Pro Website');
    $mail->addAddress('info@mepteam.pro');  // where you want to receive messages

    // Content
    $mail->isHTML(true);
    $mail->Subject = "New Contact Form Message from {$name}";
    $mail->Body    = "
        <p><strong>Name:</strong> {$name}</p>
        <p><strong>Email:</strong> {$email}</p>
        <p><strong>Message:</strong><br>" . nl2br(htmlspecialchars($message)) . "</p>
        <p><strong>Language:</strong> {$lang}</p>
    ";

    $mail->send();
    echo json_encode(['status' => 'success', 'message' => 'Email sent successfully']);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => "Mailer Error: {$mail->ErrorInfo}"]);
}
