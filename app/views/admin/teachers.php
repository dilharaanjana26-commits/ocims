<?php require __DIR__ . '/../layouts/header.php'; ?>
<h2>Teachers</h2>
<form method="post" action="/public/index.php?route=admin/teachers/create" class="row g-3 mb-4">
    <input type="hidden" name="csrf_token" value="<?= Csrf::token() ?>">
    <div class="col-md-3"><input class="form-control" name="name" placeholder="Name" required></div>
    <div class="col-md-3"><input class="form-control" name="email" placeholder="Email" type="email" required></div>
    <div class="col-md-2"><input class="form-control" name="mobile" placeholder="Mobile" required></div>
    <div class="col-md-2"><input class="form-control" name="password" placeholder="Password" required></div>
    <div class="col-md-2"><button class="btn btn-primary w-100">Add Teacher</button></div>
</form>
<table class="table table-bordered align-middle">
    <thead><tr><th>Name</th><th>Email</th><th>Mobile</th><th>Subscription</th><th>Expiry</th><th>Approval</th></tr></thead>
    <tbody>
    <?php foreach ($teachers as $teacher): ?>
        <tr>
            <td><?= Helpers::e($teacher['name']) ?></td>
            <td><?= Helpers::e($teacher['email']) ?></td>
            <td><?= Helpers::e($teacher['mobile']) ?></td>
            <td><?= Helpers::e($teacher['subscription_status']) ?></td>
            <td><?= Helpers::e($teacher['subscription_expiry']) ?></td>
            <td>
                <span class="badge bg-<?= $teacher['approval_status'] === 'approved' ? 'success' : 'warning text-dark' ?>">
                    <?= Helpers::e($teacher['approval_status']) ?>
                </span>
                <?php if ($teacher['approval_status'] !== 'approved'): ?>
                    <form method="post" action="/public/index.php?route=admin/teachers/approve" class="d-inline">
                        <input type="hidden" name="csrf_token" value="<?= Csrf::token() ?>">
                        <input type="hidden" name="teacher_id" value="<?= Helpers::e($teacher['id']) ?>">
                        <button class="btn btn-sm btn-outline-success ms-2">Approve</button>
                    </form>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php require __DIR__ . '/../layouts/footer.php'; ?>
