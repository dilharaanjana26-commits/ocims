<?php require __DIR__ . '/../layouts/header.php'; ?>
<h2>Reports</h2>
<h4>Teacher Payments</h4>
<ul>
    <?php foreach ($teacherPayments as $row): ?>
        <li><?= Helpers::e($row['status']) ?>: <?= Helpers::e($row['total']) ?></li>
    <?php endforeach; ?>
</ul>
<h4>Student Payments</h4>
<ul>
    <?php foreach ($studentPayments as $row): ?>
        <li><?= Helpers::e($row['status']) ?>: <?= Helpers::e($row['total']) ?></li>
    <?php endforeach; ?>
</ul>
<h4>Attendance</h4>
<ul>
    <?php foreach ($attendance as $row): ?>
        <li><?= Helpers::e($row['status']) ?>: <?= Helpers::e($row['total']) ?></li>
    <?php endforeach; ?>
</ul>
<h4>Performance</h4>
<p>Average Score: <?= Helpers::e($performance) ?></p>
<h4>Upcoming Classes</h4>
<p><?= Helpers::e($upcoming) ?> classes scheduled.</p>
<?php require __DIR__ . '/../layouts/footer.php'; ?>
