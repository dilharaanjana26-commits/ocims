<?php
class MailService
{
    public function send($to, $subject, $body)
    {
        if (class_exists('PHPMailer\\PHPMailer\\PHPMailer')) {
            $mailer = new PHPMailer\\PHPMailer\\PHPMailer(true);
            $mailer->isSMTP();
            $mailer->Host = Env::get('SMTP_HOST', '');
            $mailer->SMTPAuth = true;
            $mailer->Username = Env::get('SMTP_USER', '');
            $mailer->Password = Env::get('SMTP_PASS', '');
            $mailer->Port = (int) Env::get('SMTP_PORT', 587);
            $mailer->setFrom(Env::get('MAIL_FROM', 'no-reply@example.com'), 'OCIMS');
            $mailer->addAddress($to);
            $mailer->Subject = $subject;
            $mailer->Body = $body;
            $mailer->send();
            return ['status' => 'sent'];
        }
        return ['status' => 'sent', 'provider' => 'mock'];
    }
}
