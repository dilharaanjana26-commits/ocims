<?php
use Helpers;
use Flash;

$route = $_GET['route'] ?? '';
$isAdminRoute = strpos($route, 'admin') === 0;
$isStudentRoute = strpos($route, 'student') === 0;
$isTeacherRoute = strpos($route, 'teacher') === 0;
$isLmsRoute = $isStudentRoute || $isTeacherRoute;
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Online Class Institute Management System</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Lexend:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="/public/assets/css/theme.css" rel="stylesheet">
</head>
<body class="app-body<?= $isLmsRoute ? ' lms-body' : '' ?>">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark ocims-navbar">
    <div class="container-fluid">
        <?php if ($isAdminRoute): ?>
            <button class="btn btn-outline-light me-2 d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#adminSidebar" aria-controls="adminSidebar">
                <i class="bi bi-list"></i>
            </button>
        <?php endif; ?>
        <a class="navbar-brand d-flex align-items-center" href="/public/index.php">
            <span class="brand-text">Online Class Institute Management System</span>
            <span class="badge bg-light text-dark ms-2 d-none d-sm-inline">OCIMS</span>
        </a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto align-items-lg-center">
                <?php if (Auth::check()): ?>
                    <li class="nav-item"><a class="nav-link" href="/public/index.php?route=logout">Logout</a></li>
                <?php else: ?>
                    <li class="nav-item"><a class="nav-link" href="/public/index.php?route=login">Login</a></li>
                    <li class="nav-item ms-lg-2"><a class="btn btn-sm btn-outline-light nav-cta" href="/public/index.php?route=signup">Sign up</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
<?php if ($isAdminRoute): ?>
    <div class="admin-shell">
        <?php require __DIR__ . '/sidebar_admin.php'; ?>
        <main class="admin-content">
            <div class="container-fluid py-4">
<?php elseif ($isLmsRoute): ?>
    <div class="lms-shell">
        <?php require __DIR__ . ($isTeacherRoute ? '/sidebar_teacher.php' : '/sidebar_student.php'); ?>
        <main class="lms-main">
            <div class="lms-content">
<?php else: ?>
    <div class="container my-4">
<?php endif; ?>
        <?php if ($message = Flash::getSuccess()): ?>
            <div class="alert alert-success"><?= Helpers::e($message) ?></div>
        <?php endif; ?>
        <?php if ($message = Flash::getError()): ?>
            <div class="alert alert-danger"><?= Helpers::e($message) ?></div>
        <?php endif; ?>
