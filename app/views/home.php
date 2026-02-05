<?php require __DIR__ . '/layouts/header.php'; ?>

<section class="hero-section mb-5">
    <div class="row align-items-center g-4">
        <div class="col-lg-6">
            <span class="badge bg-primary-subtle text-primary mb-3">Welcome to OCIMS</span>
            <h1 class="display-5 fw-semibold mb-3">All your classes, updates, and payments in one calm dashboard.</h1>
            <p class="text-muted mb-4">Follow teacher updates, stay on top of schedules, and manage learning journeys with confidence. Explore the latest announcements below or create your account to get started.</p>
            <div class="d-flex flex-wrap gap-3">
                <a class="btn btn-primary btn-lg" href="/public/index.php?route=login">Login</a>
                <a class="btn btn-outline-primary btn-lg" href="/public/index.php?route=signup">Create account</a>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="hero-panel">
                <div class="row g-3">
                    <div class="col-6">
                        <div class="hero-metric">
                            <p class="text-muted mb-1">Approved Teachers</p>
                            <h3 class="mb-0"><?= Helpers::e($stats['teachers']) ?></h3>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="hero-metric">
                            <p class="text-muted mb-1">Active Students</p>
                            <h3 class="mb-0"><?= Helpers::e($stats['students']) ?></h3>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="hero-metric">
                            <p class="text-muted mb-1">Batches Running</p>
                            <h3 class="mb-0"><?= Helpers::e($stats['batches']) ?></h3>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="hero-metric">
                            <p class="text-muted mb-1">Upcoming Classes</p>
                            <h3 class="mb-0"><?= Helpers::e($stats['upcoming_classes']) ?></h3>
                        </div>
                    </div>
                </div>
                <div class="hero-callout mt-4">
                    <i class="bi bi-shield-check text-primary"></i>
                    <div>
                        <strong>Admin-approved signups</strong>
                        <p class="mb-0 text-muted">Every teacher or student registration is verified for quality.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="mb-5">
    <div class="d-flex flex-wrap align-items-center justify-content-between mb-4 gap-2">
        <div>
            <h2 class="mb-1">Latest Teacher Posts</h2>
            <p class="text-muted mb-0">Browse announcements shared by approved teachers—no login required.</p>
        </div>
        <a class="btn btn-outline-secondary" href="/public/index.php?route=signup">Join the community</a>
    </div>

    <?php if (!$posts): ?>
        <div class="empty-state">
            <i class="bi bi-megaphone"></i>
            <h4>No posts yet</h4>
            <p class="text-muted mb-0">Teachers will appear here once they publish approved updates.</p>
        </div>
    <?php else: ?>
        <div class="row g-4">
            <?php foreach ($posts as $post): ?>
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="post-card h-100">
                        <div class="post-card__header">
                            <div>
                                <p class="text-muted small mb-1">Teacher</p>
                                <h5 class="mb-0"><?= Helpers::e($post['teacher_name']) ?></h5>
                            </div>
                            <span class="badge bg-light text-dark"><?= Helpers::e($post['batch_name']) ?></span>
                        </div>
                        <p class="post-card__content mb-3"><?= Helpers::e($post['content']) ?></p>
                        <div class="post-card__meta text-muted small">
                            <i class="bi bi-calendar-event me-1"></i>
                            <?= Helpers::e(date('M d, Y', strtotime($post['created_at']))) ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>

<section class="mb-4">
    <div class="row g-4">
        <div class="col-lg-4">
            <div class="feature-card h-100">
                <i class="bi bi-clipboard-check feature-icon text-primary"></i>
                <h5>Streamlined approvals</h5>
                <p class="text-muted mb-0">Admins verify every signup, keeping the institute community trusted and safe.</p>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="feature-card h-100">
                <i class="bi bi-bar-chart-line feature-icon text-success"></i>
                <h5>Progress at a glance</h5>
                <p class="text-muted mb-0">Dashboards highlight upcoming classes, payments, and content in one place.</p>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="feature-card h-100">
                <i class="bi bi-phone feature-icon text-warning"></i>
                <h5>Mobile-ready experience</h5>
                <p class="text-muted mb-0">Modern, responsive layouts keep parents, students, and teachers connected anywhere.</p>
            </div>
        </div>
    </div>
</section>

<?php require __DIR__ . '/layouts/footer.php'; ?>
