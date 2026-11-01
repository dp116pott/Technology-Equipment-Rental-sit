<?php
// Make sure this script only runs on POST requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = filter_var($_POST['Name'] ?? '', FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['Email'] ?? '', FILTER_SANITIZE_EMAIL);
    $subject = filter_var($_POST['Subject'] ?? '', FILTER_SANITIZE_STRING);
    $messageContent = filter_var($_POST['Message'] ?? '', FILTER_SANITIZE_STRING);

    // Validate required fields
    if (empty($name) || empty($email) || empty($subject) || empty($messageContent)) {
        echo "Error: All fields are required.";
        exit;
    }

    // Recipient and From email
    $to = "dylanpottinger615@gmail.com";
    $from = "dylanpottinger615@gmail.com";

    // Prepare email headers
    $headers = "From: $from\r\n";
    $headers .= "Reply-To: $email\r\n"; // So you can reply to user email
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    // Build email message (HTML formatted)
    $message = "
        <html>
        <head><title>{$subject}</title></head>
        <body>
            <h2>New Contact Form Message</h2>
            <p><strong>Name:</strong> {$name}</p>
            <p><strong>Email:</strong> {$email}</p>
            <p><strong>Subject:</strong> {$subject}</p>
            <p><strong>Message:</strong><br>" . nl2br(htmlspecialchars($messageContent)) . "</p>
        </body>
        </html>
    ";

    // Send the email
    if (mail($to, $subject, $message, $headers)) {
        echo "Your message was sent successfully.";
    } else {
        echo "Error: Unable to send email. Please try again later.";
    }
} else {
    echo "Invalid request.";
}
    
?>

<?php
/*
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'C:/xampp/htdocs/vendor/autoload.php'; // Update path if needed

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name    = $_POST['Name'] ?? '';
    $email   = $_POST['Email'] ?? '';
    $subject = $_POST['Subject'] ?? '';
    $message = $_POST['Message'] ?? '';

    // Validate
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        echo "Error: All fields are required.";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Error: Invalid email format.";
        exit;
    }

    // PHPMailer setup
    $mail = new PHPMailer(true);
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.hostinger.com'; // Replace with your SMTP server
        $mail->SMTPAuth   = true;
        $mail->Username   = 'info@technologyequipmentrental.com'; // your email
        $mail->Password   = 'YOUR_PASSWORD'; // your email password
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        // Recipients
        $mail->setFrom('info@technologyequipmentrental.com', 'TER Contact');
        $mail->addAddress('pentest_data@dtljadev.com'); // main recipient
        $mail->addReplyTo($email, $name); // so you can reply to the sender

        // Content
        $mail->isHTML(true);
        $mail->Subject = htmlspecialchars($subject);
        $mail->Body    = "
            <h3>Message from $name</h3>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Subject:</strong> $subject</p>
            <p><strong>Message:</strong><br>" . nl2br(htmlspecialchars($message)) . "</p>
        ";

        $mail->send();
        echo "Success: Message has been sent.";
    } catch (Exception $e) {
        echo "Error: Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    echo "Error: Invalid request.";
}
*/
?>