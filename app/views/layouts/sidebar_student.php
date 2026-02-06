<?php
$navItems = [
    'student/dashboard' => ['label' => 'Dashboard', 'icon' => 'fa-solid fa-house'],
    'student/content' => ['label' => 'Content', 'icon' => 'fa-solid fa-book-open'],
    'student/payments' => ['label' => 'Payments', 'icon' => 'fa-solid fa-credit-card'],
];
?>
<aside class="lms-sidebar">
    <div class="lms-sidebar__brand">
        <span class="lms-sidebar__logo">OCIMS</span>
        <span class="lms-sidebar__subtitle">Student</span>
    </div>
    <nav class="nav flex-column lms-sidebar__nav">
        <?php foreach ($navItems as $path => $item): ?>
            <?php $active = ($route === $path) ? 'active' : ''; ?>
            <a class="nav-link <?= $active ?>" href="/public/index.php?route=<?= Helpers::e($path) ?>">
                <i class="<?= Helpers::e($item['icon']) ?>"></i>
                <span><?= Helpers::e($item['label']) ?></span>
            </a>
        <?php endforeach; ?>
    </nav>
    <div class="lms-sidebar__cta">
        <div class="lms-sidebar__cta-card">
            <div class="fw-semibold">Need help?</div>
            <p class="small text-muted mb-3">Schedule a 1:1 session with your mentor.</p>
            <a class="btn btn-sm btn-light w-100" href="/public/index.php?route=student/content">Book a session</a>
        </div>
    </div>
</aside>
