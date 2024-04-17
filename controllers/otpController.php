<?php

namespace app\controllers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

use Dotenv\Dotenv;

// Include Composer's autoloader
require_once __DIR__ . '/../vendor/autoload.php';

// Load environment variables from .env file
$dotenv = Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

class otpController
{
    public function generateVerificationLink($email)
    {
        $key = bin2hex(random_bytes(16)); // Generate a random key
        $encodedEmail = base64_encode($email . ':' . $key); // Encode email using the key
        return $_ENV['APP_URL'] . '/verify?token=' . $encodedEmail; // Construct verification link
    }

    public function verifyEmail($token)
    {
        $decoded = base64_decode($token);
        list($email, $key) = explode(':', $decoded);
        $expected = base64_encode($email . ':' . $key);
        if ($decoded === $expected) {
            return $email;
        }
        return false;
    }

    public function sendOtp($email): false|int
    {
        $link = $this->generateVerificationLink($email); // Generate verification link
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->isSMTP();
            $mail->Host = $_ENV['SMTP_HOST'];
            $mail->SMTPAuth = true;
            $mail->Username = $_ENV['SMTP_USERNAME'];
            $mail->Password = $_ENV['SMTP_PASSWORD'];
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = $_ENV['SMTP_PORT'];

            //Recipients
            $mail->setFrom($_ENV['MAIL_FROM'], 'NurtureLife');
            $mail->addAddress($email); // Add a recipient

            // Content
            $mail->isHTML(true); // Set email format to HTML
            $mail->Subject = 'Welcome to NurtureLife';
            $mail->Body = "
                <!DOCTYPE html>
                <html lang='en'>
                <head>
                    <meta charset='UTF-8'>
                    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                    <title>Welcome to NurtureLife</title>
                </head>
                <body>
                    <div style='max-width: 600px; margin: 0 auto; padding: 20px;'>
                        <h1>Welcome to NurtureLife!</h1>
                        <p>Thank you for joining NurtureLife. We're excited to have you on board!</p>
                        <p>To continue the process, please click the button below:</p>
                        <a href='$link' style='display: inline-block; background-color: #007bff; color: #ffffff; text-decoration: none; padding: 10px 20px; border-radius: 5px;'>Continue Process</a>
                        <p>If you are unable to click the button, you can also <a href='$link'>click here</a> or copy and paste the following link into your browser:</p>
                        <p>$link</p>
                        <p>If you have any questions or need assistance, feel free to reply to this email.</p>
                        <p>Best regards,<br>NurtureLife Team</p>
                    </div>
                </body>
                </html>
            ";

            $mail->send();
            return true;

        } catch (Exception $e) {
            return false;
        }
    }
}
