<?php
$route = $_GET['route'] ?? '';
$menuItems = [
    'admin/dashboard' => ['label' => 'Dashboard', 'icon' => 'bi-speedometer2'],
    'admin/teachers' => ['label' => 'Manage Teachers', 'icon' => 'bi-person-badge'],
    'admin/students' => ['label' => 'Manage Students', 'icon' => 'bi-people'],
    'admin/batches' => ['label' => 'Manage Batches', 'icon' => 'bi-collection'],
    'admin/payments' => ['label' => 'Payments', 'icon' => 'bi-credit-card'],
    'admin/posts' => ['label' => 'Posts', 'icon' => 'bi-megaphone'],
    'admin/reminders' => ['label' => 'Reminders', 'icon' => 'bi-bell'],
    'admin/reports' => ['label' => 'Reports', 'icon' => 'bi-bar-chart'],
    'admin/setup-check' => ['label' => 'Setup Check', 'icon' => 'bi-gear'],
];

$renderAdminNav = function (array $items, string $currentRoute): void {
    foreach ($items as $path => $item) {
        $active = $currentRoute === $path ? 'active' : '';
        ?>
        <a class="nav-link d-flex align-items-center gap-2 <?= $active ?>" href="/public/index.php?route=<?= $path ?>">
            <i class="bi <?= $item['icon'] ?>"></i>
            <span><?= $item['label'] ?></span>
        </a>
        <?php
    }
};
?>

<aside class="admin-sidebar d-none d-lg-flex flex-column">
    <div class="sidebar-brand px-4 py-4">
        <span class="text-uppercase text-muted small">Administration</span>
    </div>
    <nav class="nav flex-column px-3">
        <?php $renderAdminNav($menuItems, $route); ?>
    </nav>
    <div class="mt-auto px-4 py-4 sidebar-footer">
        <?php if (Auth::check()): ?>
            <a class="btn btn-outline-light w-100" href="/public/index.php?route=logout">
                <i class="bi bi-box-arrow-right me-2"></i>Logout
            </a>
        <?php endif; ?>
    </div>
</aside>

<div class="offcanvas offcanvas-start d-lg-none admin-sidebar admin-sidebar--offcanvas" tabindex="-1" id="adminSidebar" aria-labelledby="adminSidebarLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="adminSidebarLabel">Admin Menu</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-0 d-flex flex-column">
        <div class="sidebar-brand px-4 py-4">
            <span class="text-uppercase text-muted small">Administration</span>
        </div>
        <nav class="nav flex-column px-3">
            <?php $renderAdminNav($menuItems, $route); ?>
        </nav>
        <div class="mt-auto px-4 py-4 sidebar-footer">
            <?php if (Auth::check()): ?>
                <a class="btn btn-outline-light w-100" href="/public/index.php?route=logout">
                    <i class="bi bi-box-arrow-right me-2"></i>Logout
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>
