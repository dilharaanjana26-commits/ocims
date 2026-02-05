<?php require __DIR__ . '/../layouts/header.php'; ?>
<div class="row justify-content-center">
    <div class="col-md-5">
        <h2 class="mb-4">Login</h2>
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
        <p class="text-muted mt-3">Use the seeded credentials from README to access Admin/Teacher/Student accounts.</p>
    </div>
</div>
<?php require __DIR__ . '/../layouts/footer.php'; ?>
