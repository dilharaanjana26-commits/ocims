<?php require __DIR__ . '/../layouts/header.php'; ?>
<section class="lms-hero">
    <div>
        <p class="text-uppercase lms-eyebrow">Teacher workspace</p>
        <h2 class="lms-heading">Deliver standout lessons with a premium command center.</h2>
        <p class="text-muted mb-0">Monitor classes, manage content, and keep subscriptions on track.</p>
    </div>
    <div class="lms-hero__card">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <span class="fw-semibold">Subscription status</span>
            <span class="badge badge-category badge-category--mint"><?= Helpers::e($teacher['subscription_status']) ?></span>
        </div>
        <div class="text-muted">
            Renewal date
            <span class="d-block fw-semibold text-dark mt-1"><?= Helpers::e($teacher['subscription_expiry']) ?></span>
        </div>
        <a class="btn btn-primary mt-3" href="/public/index.php?route=teacher/payments">Manage subscription</a>
    </div>
</section>

<section class="lms-grid mt-4">
    <div class="lms-card fade-in">
        <div class="lms-card__header">
            <div>
                <h5 class="mb-1">Assigned batches</h5>
                <p class="text-muted mb-0">Cohorts you lead this term.</p>
            </div>
            <span class="badge badge-category">Active</span>
        </div>
        <div class="lms-list">
            <?php foreach ($batches as $batch): ?>
                <div class="lms-list__item">
                    <div class="fw-semibold"><?= Helpers::e($batch['name']) ?></div>
                    <span class="badge badge-category badge-category--slate">Cohort</span>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="lms-card fade-in">
        <div class="lms-card__header">
            <div>
                <h5 class="mb-1">Upcoming classes</h5>
                <p class="text-muted mb-0">Your next live sessions.</p>
            </div>
            <span class="badge badge-category badge-category--indigo">Schedule</span>
        </div>
        <div class="lms-list">
            <?php foreach ($classes as $class): ?>
                <div class="lms-list__item">
                    <div>
                        <div class="fw-semibold"><?= Helpers::e($class['topic']) ?></div>
                        <div class="text-muted small"><?= Helpers::e($class['class_date']) ?></div>
                    </div>
                    <span class="badge badge-category badge-category--slate">Upcoming</span>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="lms-card fade-in">
        <div class="lms-card__header">
            <div>
                <h5 class="mb-1">Pending post approvals</h5>
                <p class="text-muted mb-0">Requests waiting for review.</p>
            </div>
            <span class="badge badge-category badge-category--mint">Queue</span>
        </div>
        <div class="lms-metric">
            <div>
                <div class="lms-metric__label">Items to review</div>
                <div class="lms-metric__value"><?= Helpers::e($pendingPosts) ?></div>
            </div>
            <a class="btn btn-outline-primary" href="/public/index.php?route=teacher/posts">Review posts</a>
        </div>
    </div>
</section>

<section class="mt-4">
    <div class="lms-card fade-in">
        <div class="lms-card__header">
            <h5 class="mb-0">Quick actions</h5>
            <span class="badge badge-category badge-category--slate">Workflow</span>
        </div>
        <div class="lms-action-list">
            <a class="lms-action" href="/public/index.php?route=teacher/classes"><i class="fa-solid fa-calendar-check"></i>Plan class schedule</a>
            <a class="lms-action" href="/public/index.php?route=teacher/content"><i class="fa-solid fa-folder-open"></i>Upload new content</a>
            <a class="lms-action" href="/public/index.php?route=teacher/posts"><i class="fa-solid fa-pen-to-square"></i>Manage posts</a>
            <a class="lms-action" href="/public/index.php?route=teacher/payments"><i class="fa-solid fa-wallet"></i>View subscription payments</a>
        </div>
    </div>
</section>
<?php require __DIR__ . '/../layouts/footer.php'; ?>
