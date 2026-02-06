<?php require __DIR__ . '/../layouts/header.php'; ?>
<div class="d-flex align-items-start justify-content-between mb-4">
    <div>
        <p class="text-uppercase lms-eyebrow">Admin</p>
        <h2 class="lms-heading">Reminders</h2>
        <p class="text-muted mb-0">Trigger reminder jobs and keep learners on schedule.</p>
    </div>
    <span class="badge badge-category badge-category--mint">Automation</span>
</div>

<div class="lms-card fade-in mb-4">
    <div class="lms-card__header">
        <h5 class="mb-0">Run reminders</h5>
        <span class="badge badge-category badge-category--slate">Jobs</span>
    </div>
    <form method="post" action="/public/index.php?route=admin/reminders/run">
        <input type="hidden" name="csrf_token" value="<?= Csrf::token() ?>">
        <button class="btn btn-primary">Run Reminder Jobs Now</button>
    </form>
</div>

<div class="lms-card fade-in">
    <div class="lms-card__header">
        <h5 class="mb-0">Reminder history</h5>
        <span class="badge badge-category">Logs</span>
    </div>
    <div class="table-responsive">
        <table class="table table-borderless align-middle mb-0">
            <thead>
                <tr>
                    <th>User Type</th>
                    <th>Content</th>
                    <th>Channel</th>
                    <th>Scheduled</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($reminders as $reminder): ?>
                <tr>
                    <td><?= Helpers::e($reminder['user_type']) ?></td>
                    <td><?= Helpers::e($reminder['content']) ?></td>
                    <td><?= Helpers::e($reminder['channel']) ?></td>
                    <td><?= Helpers::e($reminder['scheduled_date']) ?></td>
                    <td><span class="badge badge-category badge-category--slate"><?= Helpers::e($reminder['status']) ?></span></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php require __DIR__ . '/../layouts/footer.php'; ?>
