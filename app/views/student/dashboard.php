<?php require __DIR__ . '/../layouts/header.php'; ?>
<section class="lms-hero">
    <div>
        <p class="text-uppercase lms-eyebrow">Student dashboard</p>
        <h2 class="lms-heading">Your learning journey, beautifully organized.</h2>
        <p class="text-muted mb-0">Track classes, payments, and progress across every cohort in one premium space.</p>
    </div>
    <div class="lms-hero__card">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <span class="fw-semibold">Next live class</span>
            <span class="badge badge-category">Upcoming</span>
        </div>
        <div class="text-muted">
            <?php if ($nextClass): ?>
                <?= Helpers::e($nextClass['batch_name']) ?> on <?= Helpers::e($nextClass['class_date']) ?>
                <span class="d-block fw-semibold text-dark mt-1"><?= Helpers::e($nextClass['topic']) ?></span>
            <?php else: ?>
                No upcoming classes yet. New sessions will appear here.
            <?php endif; ?>
        </div>
        <a class="btn btn-primary mt-3" href="/public/index.php?route=student/content">View class details</a>
    </div>
</section>

<section class="lms-grid mt-4">
    <div class="lms-card fade-in">
        <div class="lms-card__header">
            <div>
                <h5 class="mb-1">Completion focus</h5>
                <p class="text-muted mb-0">Stay consistent with your weekly goals.</p>
            </div>
            <span class="badge badge-category badge-category--indigo">Goal</span>
        </div>
        <div class="lms-progress">
            <div class="progress lms-progress__bar" role="progressbar" aria-label="Weekly goal" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100">
                <div class="progress-bar" style="width: 72%">72%</div>
            </div>
            <div class="d-flex justify-content-between small text-muted mt-2">
                <span>5 of 7 lessons complete</span>
                <span>2 days left</span>
            </div>
        </div>
    </div>
    <div class="lms-card fade-in">
        <div class="lms-card__header">
            <div>
                <h5 class="mb-1">Upcoming payments</h5>
                <p class="text-muted mb-0">Review your payment plan and invoices.</p>
            </div>
            <span class="badge badge-category badge-category--mint">Billing</span>
        </div>
        <div class="lms-metric">
            <div>
                <div class="lms-metric__label">Total balance</div>
                <div class="lms-metric__value">LKR <?= Helpers::e($payments[0]['total_amount'] ?? '0.00') ?></div>
            </div>
            <a class="btn btn-outline-primary" href="/public/index.php?route=student/payments">Manage payments</a>
        </div>
    </div>
    <div class="lms-card fade-in">
        <div class="lms-card__header">
            <div>
                <h5 class="mb-1">Learning hub</h5>
                <p class="text-muted mb-0">Everything from notes to live streams.</p>
            </div>
            <span class="badge badge-category badge-category--slate">Resources</span>
        </div>
        <div class="lms-action-list">
            <a class="lms-action" href="/public/index.php?route=student/content"><i class="fa-solid fa-video"></i>Watch live replays</a>
            <a class="lms-action" href="/public/index.php?route=student/content"><i class="fa-solid fa-file-arrow-down"></i>Download course tutes</a>
            <a class="lms-action" href="/public/index.php?route=student/content"><i class="fa-solid fa-message"></i>Read mentor updates</a>
        </div>
    </div>
</section>

<section class="mt-4">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <div>
            <h4 class="mb-1">Your courses</h4>
            <p class="text-muted mb-0">Elegant, card-based cohorts with progress visibility.</p>
        </div>
        <a class="btn btn-outline-secondary" href="/public/index.php?route=student/content">View all content</a>
    </div>
    <div class="row g-4">
        <?php
        $categories = ['Design', 'Development', 'Business', 'Marketing'];
        ?>
        <?php foreach ($payments as $index => $payment): ?>
            <?php
            $status = strtolower($payment['status'] ?? '');
            $progressValue = $status === 'paid' ? 100 : 45;
            $category = $categories[$index % count($categories)];
            ?>
            <div class="col-md-6 col-xl-4">
                <div class="lms-course-card fade-in">
                    <div class="d-flex align-items-start justify-content-between mb-3">
                        <div>
                            <h5 class="mb-1"><?= Helpers::e($payment['batch_name']) ?></h5>
                            <div class="text-muted small">Instructor-led cohort</div>
                        </div>
                        <span class="badge badge-category"><?= Helpers::e($category) ?></span>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between small text-muted mb-1">
                            <span>Completion</span>
                            <span><?= Helpers::e((string) $progressValue) ?>%</span>
                        </div>
                        <div class="progress lms-progress__bar" role="progressbar" aria-label="Course progress" aria-valuenow="<?= Helpers::e((string) $progressValue) ?>" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar" style="width: <?= Helpers::e((string) $progressValue) ?>%"></div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="small text-muted">Status: <span class="fw-semibold text-dark"><?= Helpers::e($payment['status']) ?></span></div>
                        <a class="btn btn-sm btn-primary" href="/public/index.php?route=student/content">Continue</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>
<?php require __DIR__ . '/../layouts/footer.php'; ?>
