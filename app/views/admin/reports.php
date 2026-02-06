<?php require __DIR__ . '/../layouts/header.php'; ?>
<div class="d-flex align-items-start justify-content-between mb-4">
    <div>
        <p class="text-uppercase lms-eyebrow">Admin</p>
        <h2 class="lms-heading">Reports</h2>
        <p class="text-muted mb-0">Analytics snapshots for payments, attendance, and performance.</p>
    </div>
    <span class="badge badge-category badge-category--indigo">Insights</span>
</div>

<div class="row g-4">
    <div class="col-lg-6">
        <div class="lms-card fade-in h-100">
            <div class="lms-card__header">
                <h5 class="mb-0">Teacher payments</h5>
                <span class="badge badge-category badge-category--slate">Totals</span>
            </div>
            <div class="lms-list">
                <?php foreach ($teacherPayments as $row): ?>
                    <div class="lms-list__item">
                        <span><?= Helpers::e($row['status']) ?></span>
                        <span class="fw-semibold"><?= Helpers::e($row['total']) ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="lms-card fade-in h-100">
            <div class="lms-card__header">
                <h5 class="mb-0">Student payments</h5>
                <span class="badge badge-category badge-category--mint">Totals</span>
            </div>
            <div class="lms-list">
                <?php foreach ($studentPayments as $row): ?>
                    <div class="lms-list__item">
                        <span><?= Helpers::e($row['status']) ?></span>
                        <span class="fw-semibold"><?= Helpers::e($row['total']) ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="lms-card fade-in h-100">
            <div class="lms-card__header">
                <h5 class="mb-0">Attendance</h5>
                <span class="badge badge-category badge-category--slate">Totals</span>
            </div>
            <div class="lms-list">
                <?php foreach ($attendance as $row): ?>
                    <div class="lms-list__item">
                        <span><?= Helpers::e($row['status']) ?></span>
                        <span class="fw-semibold"><?= Helpers::e($row['total']) ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="lms-card fade-in h-100">
            <div class="lms-card__header">
                <h5 class="mb-0">Performance</h5>
                <span class="badge badge-category badge-category--indigo">Summary</span>
            </div>
            <div class="lms-metric">
                <div>
                    <div class="lms-metric__label">Average score</div>
                    <div class="lms-metric__value"><?= Helpers::e($performance) ?></div>
                </div>
                <div class="text-muted small">Across active cohorts</div>
            </div>
            <hr class="my-4">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="lms-metric__label">Upcoming classes</div>
                    <div class="fw-semibold"><?= Helpers::e($upcoming) ?> scheduled</div>
                </div>
                <span class="badge badge-category badge-category--mint">Live</span>
            </div>
        </div>
    </div>
</div>
<?php require __DIR__ . '/../layouts/footer.php'; ?>
