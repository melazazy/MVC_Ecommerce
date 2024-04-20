<?php


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
            // save the email to database
            $DB = new Database;
            $query = "INSERT INTO subscribers (email) VALUES (:email)";
            $add = $DB->write($query, $data);
            $this->sendConfirmationEmail($email);
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
        $recipient = $email;
        $sender_email = "melazazy52@gmail.com";
        $email_title = "Subscription Confirmation";
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
