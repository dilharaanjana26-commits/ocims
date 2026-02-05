<?php require __DIR__ . '/../layouts/header.php'; ?>
<div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
        <div class="auth-card">
            <h2 class="mb-2">Welcome back</h2>
            <p class="text-muted mb-4">Log in to manage schedules, posts, and payments.</p>
            <form method="post" action="/public/index.php?route=login">
                <input type="hidden" name="csrf_token" value="<?= Csrf::token() ?>">
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button class="btn btn-primary w-100">Login</button>
            </form>
            <p class="text-muted mt-3 mb-0">Use the seeded credentials from README to access Admin/Teacher/Student accounts.</p>
            <div class="text-center mt-4">
                <span class="text-muted">Need approval?</span>
                <a href="/public/index.php?route=signup">Create an account</a>
            </div>
        </div>
    </div>
</div>
<?php require __DIR__ . '/../layouts/footer.php'; ?>
