<?php require __DIR__ . '/layouts/header.php'; ?>

<section class="hero-section mb-5">
    <div class="row align-items-center g-4">
        <div class="col-lg-6">
            <span class="badge bg-primary-subtle text-primary mb-3">Welcome to OCIMS</span>
            <h1 class="display-5 fw-semibold mb-3">A complete learning management system for modern institutes.</h1>
            <p class="text-muted mb-4">Manage admissions, classes, content, and payments in one connected workspace. OCIMS keeps staff aligned, teachers empowered, and students progressing with clarity.</p>
            <div class="d-flex flex-wrap gap-3 mb-4">
                <a class="btn btn-primary btn-lg" href="/public/index.php?route=login">Launch dashboard</a>
                <a class="btn btn-outline-primary btn-lg" href="/public/index.php?route=signup">Create account</a>
            </div>
            <div class="hero-highlights">
                <div class="hero-highlight">
                    <i class="bi bi-lightning-charge-fill"></i>
                    <div>
                        <strong>Instant onboarding</strong>
                        <p class="mb-0">Approve and activate roles in minutes.</p>
                    </div>
                </div>
                <div class="hero-highlight">
                    <i class="bi bi-grid-1x2-fill"></i>
                    <div>
                        <strong>Unified workspace</strong>
                        <p class="mb-0">Switch between admin, teacher, and student views.</p>
                    </div>
                </div>
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
                <div class="hero-callout mt-3">
                    <i class="bi bi-credit-card-2-back text-success"></i>
                    <div>
                        <strong>Flexible payments</strong>
                        <p class="mb-0 text-muted">Manual proofs and online payments with smart reminders.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="mb-5">
    <div class="section-heading">
        <div>
            <h2 class="mb-1">A complete LMS experience</h2>
            <p class="text-muted mb-0">Everything you need to coordinate classes, content, and outcomes across every role.</p>
        </div>
        <a class="btn btn-outline-secondary" href="/public/index.php?route=signup">Start onboarding</a>
    </div>
    <div class="row g-4">
        <div class="col-lg-4">
            <div class="feature-tile h-100">
                <div class="feature-tile__icon text-primary"><i class="bi bi-people-fill"></i></div>
                <h5>Role-based dashboards</h5>
                <p class="text-muted mb-0">Purpose-built views for admins, teachers, and students with the exact tools they need.</p>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="feature-tile h-100">
                <div class="feature-tile__icon text-success"><i class="bi bi-calendar-week"></i></div>
                <h5>Scheduling & attendance</h5>
                <p class="text-muted mb-0">Plan weekly classes, monitor enrollment, and keep cohorts on track.</p>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="feature-tile h-100">
                <div class="feature-tile__icon text-warning"><i class="bi bi-journal-richtext"></i></div>
                <h5>Structured content</h5>
                <p class="text-muted mb-0">Deliver materials, posts, and assignments directly inside the learner workspace.</p>
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
    <div class="learning-paths mt-5">
        <div class="row g-4">
            <div class="col-lg-4">
                <div class="path-card h-100">
                    <div class="path-card__header">
                        <span class="badge bg-primary-subtle text-primary">Pathway</span>
                        <span class="badge bg-light text-dark">8 modules</span>
                    </div>
                    <h5>Foundations of Digital Skills</h5>
                    <p class="text-muted">Onboard new learners with an engaging blend of live sessions and self-paced work.</p>
                    <ul class="path-list">
                        <li>Live class cadence</li>
                        <li>Weekly assessments</li>
                        <li>Discussion-ready prompts</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="path-card h-100">
                    <div class="path-card__header">
                        <span class="badge bg-success-subtle text-success">Cohort</span>
                        <span class="badge bg-light text-dark">12 weeks</span>
                    </div>
                    <h5>Professional Certificate Track</h5>
                    <p class="text-muted">Guide students through milestone projects with expert feedback loops.</p>
                    <ul class="path-list">
                        <li>Project milestones</li>
                        <li>Rubric-based grading</li>
                        <li>Completion analytics</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="path-card h-100">
                    <div class="path-card__header">
                        <span class="badge bg-warning-subtle text-warning">Workshop</span>
                        <span class="badge bg-light text-dark">4 weeks</span>
                    </div>
                    <h5>Career Readiness Sprint</h5>
                    <p class="text-muted">Support job-ready skills through mock interviews and portfolio clinics.</p>
                    <ul class="path-list">
                        <li>Mentor hours</li>
                        <li>Progress check-ins</li>
                        <li>Outcome tracking</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="mb-5">
    <div class="row g-4">
        <div class="col-lg-6">
            <div class="workflow-card h-100">
                <div class="workflow-card__header">
                    <span class="badge bg-dark-subtle text-dark">Workflow</span>
                    <h3 class="mb-2">From enrollment to achievement</h3>
                    <p class="text-muted mb-0">Automate the steps that keep your institute organized, from approvals to reporting.</p>
                </div>
                <div class="workflow-step">
                    <div class="workflow-step__icon"><i class="bi bi-person-check"></i></div>
                    <div>
                        <h6 class="mb-1">Verify & approve learners</h6>
                        <p class="text-muted mb-0">Admins validate profiles before unlocking access to content.</p>
                    </div>
                </div>
                <div class="workflow-step">
                    <div class="workflow-step__icon"><i class="bi bi-calendar2-check"></i></div>
                    <div>
                        <h6 class="mb-1">Schedule + deliver classes</h6>
                        <p class="text-muted mb-0">Teachers plan sessions, share notes, and post updates in one place.</p>
                    </div>
                </div>
                <div class="workflow-step">
                    <div class="workflow-step__icon"><i class="bi bi-graph-up-arrow"></i></div>
                    <div>
                        <h6 class="mb-1">Measure outcomes</h6>
                        <p class="text-muted mb-0">Reports surface completion, payment, and engagement signals.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="insight-card h-100">
                <h3 class="mb-3">A smart command center</h3>
                <p class="text-muted">See the tasks that matter most and keep every stakeholder moving forward.</p>
                <div class="insight-grid">
                    <div class="insight-item">
                        <h4>98%</h4>
                        <p class="text-muted mb-0">On-time class delivery</p>
                    </div>
                    <div class="insight-item">
                        <h4>12 hrs</h4>
                        <p class="text-muted mb-0">Average response time</p>
                    </div>
                    <div class="insight-item">
                        <h4>6+</h4>
                        <p class="text-muted mb-0">Reports per batch</p>
                    </div>
                    <div class="insight-item">
                        <h4>4.8/5</h4>
                        <p class="text-muted mb-0">Learner satisfaction</p>
                    </div>
                </div>
                <div class="insight-footer">
                    <a class="btn btn-primary" href="/public/index.php?route=login">Explore dashboards</a>
                    <a class="btn btn-link" href="/public/index.php?route=signup">Request access</a>
                </div>
            </div>
        </div>
    </div>
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

<section class="cta-section">
    <div class="cta-card">
        <div>
            <h2 class="mb-2">Ready to run a smarter institute?</h2>
            <p class="text-muted mb-0">Bring every course, payment, and learner touchpoint together in OCIMS.</p>
        </div>
        <div class="d-flex flex-wrap gap-3">
            <a class="btn btn-primary btn-lg" href="/public/index.php?route=signup">Create an account</a>
            <a class="btn btn-outline-secondary btn-lg" href="/public/index.php?route=login">Sign in</a>
        </div>
    </div>
</section>

<?php require __DIR__ . '/layouts/footer.php'; ?>
