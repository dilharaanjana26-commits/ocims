<?php require __DIR__ . '/../layouts/header.php'; ?>
<h2>Admin Dashboard</h2>
<div class="row g-3">
    <div class="col-md-3"><div class="card"><div class="card-body">Teachers: <?= $stats['teachers'] ?></div></div></div>
    <div class="col-md-3"><div class="card"><div class="card-body">Students: <?= $stats['students'] ?></div></div></div>
    <div class="col-md-3"><div class="card"><div class="card-body">Batches: <?= $stats['batches'] ?></div></div></div>
    <div class="col-md-3"><div class="card"><div class="card-body">Upcoming Classes: <?= $stats['upcoming_classes'] ?></div></div></div>
</div>
<div class="row g-3 mt-3">
    <div class="col-md-3"><div class="card"><div class="card-body">Pending Teacher Payments: <?= $stats['pending_teacher_payments'] ?></div></div></div>
    <div class="col-md-3"><div class="card"><div class="card-body">Pending Student Payments: <?= $stats['pending_student_payments'] ?></div></div></div>
    <div class="col-md-3"><div class="card"><div class="card-body">Pending Posts: <?= $stats['pending_posts'] ?></div></div></div>
    <div class="col-md-3"><div class="card"><div class="card-body">Pending Post Boosts: <?= $stats['pending_post_payments'] ?></div></div></div>
</div>
<div class="mt-4">
    <a class="btn btn-outline-primary" href="/public/index.php?route=admin/teachers">Manage Teachers</a>
    <a class="btn btn-outline-primary" href="/public/index.php?route=admin/students">Manage Students</a>
    <a class="btn btn-outline-primary" href="/public/index.php?route=admin/batches">Manage Batches</a>
    <a class="btn btn-outline-primary" href="/public/index.php?route=admin/payments">Payments</a>
    <a class="btn btn-outline-primary" href="/public/index.php?route=admin/posts">Posts</a>
    <a class="btn btn-outline-primary" href="/public/index.php?route=admin/reminders">Reminders</a>
    <a class="btn btn-outline-primary" href="/public/index.php?route=admin/reports">Reports</a>
    <a class="btn btn-outline-primary" href="/public/index.php?route=admin/setup-check">Setup Check</a>
</div>
<?php require __DIR__ . '/../layouts/footer.php'; ?>
