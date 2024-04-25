<?php

namespace app\models;

use app\core\db\DbModel;
use app\core\Request;
use app\core\Response;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class EmailVerification extends DbModel
{

    public string $id = '';
    public string $email = '';
    public string $token = '';
    public string $created_at = '';

    public function tableName(): string
    {
        return 'emailVerifications';
    }

    public function primaryKey(): string
    {
        return 'id';
    }

    public function rules(): array
    {
        return [
            'email' => [self::RULE_REQUIRED,[
                self::RULE_UNIQUE ,'class' => self::class
            ]],
            'token' => [self::RULE_REQUIRED],
            'created_at' => [self::RULE_REQUIRED ],
        ];
    }

    public function attributes(): array
    {
        return ['email', 'token', 'created_at'];
    }

    public function verifyEmail($token): bool
    {
        $this->token= $token;
        $record = $this->findOne(self::class, ['token' => $this->token]);

        if (!$record) {
            return false;
        }

        $user = (new User)->findOne(User::class, ['email' => $record->email]);
        $user->status = User::STATUS_ACTIVE;
        $user->update();

        $record->delete();
        return true;
    }

    /**
     * @throws \Exception
     */
    public function sendOtp($email): false|int
    {
        //generate 128 long random string
        $token = bin2hex(random_bytes(64));
        $link = $this->generateVerificationLink($token);
        $mail = new PHPMailer(true);
        var_dump($link);

        //save the token to the database
        $this->email = $email;
        $this->token = $token;
        $this->created_at = date('Y-m-d H:i:s');
        $this->save();

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
    public function generateVerificationLink($token): string
    {
        return $_ENV['APP_URL'] . '/verify?token=' . $token;
    }

}