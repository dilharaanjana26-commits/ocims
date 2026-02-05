<?php
use SmsService;
use Database;

require_once __DIR__ . '/../bootstrap.php';

$service = new SmsService();
$db = Database::get();

$reminders = $db->prepare("SELECT * FROM reminders WHERE channel = 'sms' AND status = 'pending' AND scheduled_date <= NOW()");
$reminders->execute();
foreach ($reminders->fetchAll() as $reminder) {
    try {
        $mobile = null;
        if ($reminder['user_type'] === 'teacher') {
            $stmt = $db->prepare('SELECT mobile FROM teachers WHERE id = :id');
            $stmt->execute(['id' => $reminder['user_id']]);
            $mobile = $stmt->fetchColumn();
        } elseif ($reminder['user_type'] === 'student') {
            $stmt = $db->prepare('SELECT WhatsApp FROM students WHERE id = :id');
            $stmt->execute(['id' => $reminder['user_id']]);
            $mobile = $stmt->fetchColumn();
        }
        if ($mobile) {
            $service->send($mobile, $reminder['content']);
            $db->prepare("UPDATE reminders SET status = 'sent' WHERE id = :id")->execute(['id' => $reminder['id']]);
        }
    } catch (Exception $e) {
        $db->prepare("UPDATE reminders SET status = 'failed' WHERE id = :id")->execute(['id' => $reminder['id']]);
    }
}
