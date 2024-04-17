<?php
// require_once ROOT . 'PHPMailer/src/PHPMailer.php';
// Assuming that subscribe.php is in the controllers directory
// require_once __DIR__ . '/../PHPMailer/src/PHPMailer.php';
// require_once __DIR__ . '/../PHPMailer/src/SMTP.php';
// Assuming that subscribe.php is in the controllers directory


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../../PHPMailer/src/PHPMailer.php';
require_once __DIR__ . '/../../PHPMailer/src/SMTP.php';
require_once __DIR__ . '/../../PHPMailer/src/Exception.php';

// vendor/PHPMailer/src/PHPMailer.php
class Subscribe extends Controller
{
    function index()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) {
            $email = $_POST['email'];
            $data['email'] = $email;
            // Perform your subscription handling here
            // You may save the email to a database, send a confirmation email, etc.
            // save the email to database
            $DB = new Database;
            $query = "INSERT INTO subscribers (email) VALUES (:email)";
            $add = $DB->write($query, $data);
            $this->sendConfirmationEmail($email);
            // $mail = new PHPMailer;
            // Simulate a response (adjust as needed)
            $response = ['status' => 'success', 'message' => 'Subscription successful.'];
            echo json_encode($response);
        } else {
            // Invalid request
            header('HTTP/1.1 400 Bad Request');
            echo 'Invalid request.';
        }
    }
    public function sendConfirmationEmail($email)
    {
        // $mail = new PHPMailer;
        // $mail->isSMTP();
        // // Configure your SMTP settings
        // $mail->Host = 'smtp.gmail.com';
        // $mail->SMTPAuth = true;
        // $mail->Username = 'melazazy52@gmail.com';
        // $mail->Password = '@Mac5303332';
        // $mail->SMTPSecure = 'tls';
        // $mail->Port = 587;

        // $mail->setFrom('melazazy52@gmail.com', 'Mustafa Elazazy');
        // $mail->addAddress($email);

        // $mail->isHTML(true);
        // $mail->AddAddress("recipient-email@domain", "recipient-name");
        // $mail->SetFrom("from-email@gmail.com", "from-name");
        // $mail->AddReplyTo("reply-to-email@domain", "reply-to-name");
        // $mail->AddCC("cc-recipient-email@domain", "cc-recipient-name");
        // $mail->Subject = "Subscription Confirmation";
        // $content = "<b>This is a Test Email sent via Gmail SMTP Server using PHP mailer class.</b>";
        // $mail->Subject = '';
        // $mail->Body = 'Thank you for subscribing to our newsletter.';
        // $mail->MsgHTML($content);
        // if (!$mail->send()) {
        //     // Handle email sending error
        //     echo 'Email could not be sent.';
        //     echo 'Mailer Error: ' . $mail->ErrorInfo;
        // } else {
        //     echo "Email sent successfully";
        // }
        $recipient = $email;
        $sender_email = "melazazy52@gmail.com";
        $email_title = "Subscription Confirmation";
        // $email_body = 'Thank you for subscribing to our newsletter.';
        $email_body = "<div>
        <label><b>Visitor Name:</b></label>&nbsp;<span>subscriber</span>
                    </div>
                    <div>
            <label><b>Visitor Email:</b></label>&nbsp;<span>" . $recipient . "</span>
                        </div>
                        <div>
                        <label><b>Reason For Contacting Us:</b></label>&nbsp;<span>" . $email_title . "</span>
                                    </div>
                                    <div>
                        <label><b>Visitor Message:</b></label>
                        <div>Thank you for contacting us,</div>
                        </div>";
        $headers  = 'MIME-Version: 1.0' . "\r\n" . 'Content-type: text/html; charset=utf-8' . "\r\n" . 'From: ' . $sender_email . "\r\n";
        if (mail($recipient, $email_title, $email_body, $headers)) {
            echo "Thank you for contacting us,";
        } else {
            echo '<p>We are sorry but the email did not go through.</p>';
        }
    }
}
