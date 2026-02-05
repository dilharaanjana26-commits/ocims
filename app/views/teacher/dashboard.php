<?php require __DIR__ . '/../layouts/header.php'; ?>
<h2>Teacher Dashboard</h2>
<div class="card mb-3">
    <div class="card-body">
        <strong>Subscription Status:</strong> <?= Helpers::e($teacher['subscription_status']) ?>
        <strong class="ms-3">Expiry:</strong> <?= Helpers::e($teacher['subscription_expiry']) ?>
    </div>
</div>
<div class="row g-3">
    <div class="col-md-6">
        <h5>Assigned Batches</h5>
        <ul>
            <?php foreach ($batches as $batch): ?>
                <li><?= Helpers::e($batch['name']) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div class="col-md-6">
        <h5>Upcoming Classes</h5>
        <ul>
            <?php foreach ($classes as $class): ?>
                <li><?= Helpers::e($class['class_date']) ?> - <?= Helpers::e($class['topic']) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
<p class="mt-3">Pending Post Approvals: <?= Helpers::e($pendingPosts) ?></p>
<div class="mt-3">
    <a class="btn btn-outline-primary" href="/public/index.php?route=teacher/payments">Subscription Payments</a>
    <a class="btn btn-outline-primary" href="/public/index.php?route=teacher/classes">Class Schedule</a>
    <a class="btn btn-outline-primary" href="/public/index.php?route=teacher/posts">Posts</a>
    <a class="btn btn-outline-primary" href="/public/index.php?route=teacher/content">Content</a>
</div>
<?php require __DIR__ . '/../layouts/footer.php'; ?>
