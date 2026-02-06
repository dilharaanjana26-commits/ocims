<?php
$navItems = [
    'teacher/dashboard' => ['label' => 'Dashboard', 'icon' => 'fa-solid fa-compass'],
    'teacher/classes' => ['label' => 'Classes', 'icon' => 'fa-solid fa-calendar-check'],
    'teacher/content' => ['label' => 'Content', 'icon' => 'fa-solid fa-folder-open'],
    'teacher/posts' => ['label' => 'Posts', 'icon' => 'fa-solid fa-pen-to-square'],
    'teacher/payments' => ['label' => 'Payments', 'icon' => 'fa-solid fa-wallet'],
];
?>
<aside class="lms-sidebar">
    <div class="lms-sidebar__brand">
        <span class="lms-sidebar__logo">OCIMS</span>
        <span class="lms-sidebar__subtitle">Teacher</span>
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
            <div class="fw-semibold">Teaching tips</div>
            <p class="small text-muted mb-3">Access classroom guides and best practices.</p>
            <a class="btn btn-sm btn-light w-100" href="/public/index.php?route=teacher/content">Explore resources</a>
        </div>
    </div>
</aside>
