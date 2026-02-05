<?php
use Helpers;
use Flash;
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>OCIMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="/public/index.php">OCIMS</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <?php if (Auth::check()): ?>
                    <li class="nav-item"><a class="nav-link" href="/public/index.php?route=logout">Logout</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
<div class="container my-4">
    <?php if ($message = Flash::getSuccess()): ?>
        <div class="alert alert-success"><?= Helpers::e($message) ?></div>
    <?php endif; ?>
    <?php if ($message = Flash::getError()): ?>
        <div class="alert alert-danger"><?= Helpers::e($message) ?></div>
    <?php endif; ?>
