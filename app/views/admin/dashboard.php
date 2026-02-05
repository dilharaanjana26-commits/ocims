<?php require __DIR__ . '/../layouts/header.php'; ?>
<div class="d-flex flex-wrap align-items-center justify-content-between mb-4 gap-3">
    <div>
        <h2 class="mb-1">Admin Dashboard</h2>
        <p class="text-muted mb-0">Welcome back! Here is a quick snapshot of institute activity today.</p>
    </div>
</div>

<div class="quick-overview mb-4">
    <h5 class="mb-2">Quick Overview</h5>
    <p class="text-muted mb-0">Monitor your teachers, students, and upcoming learning sessions from one calm, organized view.</p>
</div>

<div class="row g-4">
    <div class="col-12 col-md-6 col-xl-3">
        <div class="stat-card border-primary bg-primary-subtle">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div>
                    <p class="stat-label mb-1">Teachers</p>
                    <div class="stat-value"><?= $stats['teachers'] ?></div>
                </div>
                <div class="stat-icon bg-white text-primary">
                    <i class="bi bi-person-badge"></i>
                </div>
            </div>
            <span class="text-muted small">Active faculty network</span>
        </div>
    </div>
    <div class="col-12 col-md-6 col-xl-3">
        <div class="stat-card border-success bg-success-subtle">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div>
                    <p class="stat-label mb-1">Students</p>
                    <div class="stat-value"><?= $stats['students'] ?></div>
                </div>
                <div class="stat-icon bg-white text-success">
                    <i class="bi bi-people"></i>
                </div>
            </div>
            <span class="text-muted small">Learners enrolled</span>
        </div>
    </div>
    <div class="col-12 col-md-6 col-xl-3">
        <div class="stat-card border-warning bg-warning-subtle">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div>
                    <p class="stat-label mb-1">Pending Teacher Approvals</p>
                    <div class="stat-value"><?= $stats['pending_teacher_approvals'] ?></div>
                </div>
                <div class="stat-icon bg-white text-warning">
                    <i class="bi bi-person-check"></i>
                </div>
            </div>
            <span class="text-muted small">Teacher signups to review</span>
        </div>
    </div>
    <div class="col-12 col-md-6 col-xl-3">
        <div class="stat-card border-warning bg-warning-subtle">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div>
                    <p class="stat-label mb-1">Pending Student Approvals</p>
                    <div class="stat-value"><?= $stats['pending_student_approvals'] ?></div>
                </div>
                <div class="stat-icon bg-white text-warning">
                    <i class="bi bi-person-lines-fill"></i>
                </div>
            </div>
            <span class="text-muted small">Student requests awaiting approval</span>
        </div>
    </div>
    <div class="col-12 col-md-6 col-xl-3">
        <div class="stat-card border-info bg-info-subtle">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div>
                    <p class="stat-label mb-1">Batches</p>
                    <div class="stat-value"><?= $stats['batches'] ?></div>
                </div>
                <div class="stat-icon bg-white text-info">
                    <i class="bi bi-collection"></i>
                </div>
            </div>
            <span class="text-muted small">Organized class groups</span>
        </div>
    </div>
    <div class="col-12 col-md-6 col-xl-3">
        <div class="stat-card border-warning bg-warning-subtle">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div>
                    <p class="stat-label mb-1">Upcoming Classes</p>
                    <div class="stat-value"><?= $stats['upcoming_classes'] ?></div>
                </div>
                <div class="stat-icon bg-white text-warning">
                    <i class="bi bi-calendar-check"></i>
                </div>
            </div>
            <span class="text-muted small">Scheduled sessions ahead</span>
        </div>
    </div>
    <div class="col-12 col-md-6 col-xl-3">
        <div class="stat-card border-danger bg-danger-subtle">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div>
                    <p class="stat-label mb-1">Pending Teacher Payments</p>
                    <div class="stat-value"><?= $stats['pending_teacher_payments'] ?></div>
                </div>
                <div class="stat-icon bg-white text-danger">
                    <i class="bi bi-credit-card"></i>
                </div>
            </div>
            <span class="text-muted small">Approval queue</span>
        </div>
    </div>
    <div class="col-12 col-md-6 col-xl-3">
        <div class="stat-card border-danger bg-danger-subtle">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div>
                    <p class="stat-label mb-1">Pending Student Payments</p>
                    <div class="stat-value"><?= $stats['pending_student_payments'] ?></div>
                </div>
                <div class="stat-icon bg-white text-danger">
                    <i class="bi bi-cash-coin"></i>
                </div>
            </div>
            <span class="text-muted small">Awaiting confirmation</span>
        </div>
    </div>
    <div class="col-12 col-md-6 col-xl-3">
        <div class="stat-card border-secondary bg-secondary-subtle">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div>
                    <p class="stat-label mb-1">Pending Posts</p>
                    <div class="stat-value"><?= $stats['pending_posts'] ?></div>
                </div>
                <div class="stat-icon bg-white text-secondary">
                    <i class="bi bi-megaphone"></i>
                </div>
            </div>
            <span class="text-muted small">Content awaiting review</span>
        </div>
    </div>
    <div class="col-12 col-md-6 col-xl-3">
        <div class="stat-card border-dark bg-dark-subtle">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div>
                    <p class="stat-label mb-1">Pending Post Boosts</p>
                    <div class="stat-value"><?= $stats['pending_post_payments'] ?></div>
                </div>
                <div class="stat-icon bg-white text-dark">
                    <i class="bi bi-stars"></i>
                </div>
            </div>
            <span class="text-muted small">Boost requests pending</span>
        </div>
    </div>
</div>
<?php require __DIR__ . '/../layouts/footer.php'; ?>
