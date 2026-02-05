<?php require __DIR__ . '/../layouts/header.php'; ?>
<h2>Student Dashboard</h2>
<div class="card mb-3">
    <div class="card-body">
        <strong>Next Class:</strong>
        <?php if ($nextClass): ?>
            <?= Helpers::e($nextClass['batch_name']) ?> on <?= Helpers::e($nextClass['class_date']) ?> (<?= Helpers::e($nextClass['topic']) ?>)
        <?php else: ?>
            No upcoming classes.
        <?php endif; ?>
    </div>
</div>
<h5>Payments</h5>
<table class="table table-bordered">
    <thead><tr><th>Batch</th><th>Total</th><th>Status</th></tr></thead>
    <tbody>
    <?php foreach ($payments as $payment): ?>
        <tr>
            <td><?= Helpers::e($payment['batch_name']) ?></td>
            <td><?= Helpers::e($payment['total_amount']) ?></td>
            <td><?= Helpers::e($payment['status']) ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<div class="mt-3">
    <a class="btn btn-outline-primary" href="/public/index.php?route=student/payments">Payments</a>
    <a class="btn btn-outline-primary" href="/public/index.php?route=student/content">Content</a>
</div>
<?php require __DIR__ . '/../layouts/footer.php'; ?>
