<?php require __DIR__ . '/../layouts/header.php'; ?>
<h2>Reminders</h2>
<form method="post" action="/public/index.php?route=admin/reminders/run" class="mb-3">
    <input type="hidden" name="csrf_token" value="<?= Csrf::token() ?>">
    <button class="btn btn-primary">Run Reminder Jobs Now</button>
</form>
<table class="table table-bordered">
    <thead><tr><th>User Type</th><th>Content</th><th>Channel</th><th>Scheduled</th><th>Status</th></tr></thead>
    <tbody>
    <?php foreach ($reminders as $reminder): ?>
        <tr>
            <td><?= Helpers::e($reminder['user_type']) ?></td>
            <td><?= Helpers::e($reminder['content']) ?></td>
            <td><?= Helpers::e($reminder['channel']) ?></td>
            <td><?= Helpers::e($reminder['scheduled_date']) ?></td>
            <td><?= Helpers::e($reminder['status']) ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php require __DIR__ . '/../layouts/footer.php'; ?>
