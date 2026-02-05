<?php
use MailService;
use Database;

require_once __DIR__ . '/../bootstrap.php';

$service = new MailService();
$db = Database::get();

$reminders = $db->prepare("SELECT * FROM reminders WHERE channel = 'email' AND status = 'pending' AND scheduled_date <= NOW()");
$reminders->execute();
foreach ($reminders->fetchAll() as $reminder) {
    try {
        $email = null;
        if ($reminder['user_type'] === 'teacher') {
            $stmt = $db->prepare('SELECT email FROM teachers WHERE id = :id');
            $stmt->execute(['id' => $reminder['user_id']]);
            $email = $stmt->fetchColumn();
        } elseif ($reminder['user_type'] === 'student') {
            $stmt = $db->prepare('SELECT email FROM students WHERE id = :id');
            $stmt->execute(['id' => $reminder['user_id']]);
            $email = $stmt->fetchColumn();
        }
        if ($email) {
            $service->send($email, 'OCIMS Reminder', $reminder['content']);
            $db->prepare("UPDATE reminders SET status = 'sent' WHERE id = :id")->execute(['id' => $reminder['id']]);
        }
    } catch (Exception $e) {
        $db->prepare("UPDATE reminders SET status = 'failed' WHERE id = :id")->execute(['id' => $reminder['id']]);
    }
}
