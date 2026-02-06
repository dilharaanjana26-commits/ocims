<?php require __DIR__ . '/../layouts/header.php'; ?>
<div class="d-flex align-items-start justify-content-between mb-4">
    <div>
        <p class="text-uppercase lms-eyebrow">Admin</p>
        <h2 class="lms-heading">Teachers</h2>
        <p class="text-muted mb-0">Approve instructors and manage subscription details.</p>
    </div>
    <span class="badge badge-category badge-category--indigo">Faculty</span>
</div>

<div class="lms-card fade-in mb-4">
    <div class="lms-card__header">
        <h5 class="mb-0">Add teacher</h5>
        <span class="badge badge-category badge-category--slate">Enrollment</span>
    </div>
    <form method="post" action="/public/index.php?route=admin/teachers/create" class="row g-3">
        <input type="hidden" name="csrf_token" value="<?= Csrf::token() ?>">
        <div class="col-lg-3"><label class="form-label">Name</label><input class="form-control" name="name" placeholder="Name" required></div>
        <div class="col-lg-3"><label class="form-label">Email</label><input class="form-control" name="email" placeholder="Email" type="email" required></div>
        <div class="col-lg-2"><label class="form-label">Mobile</label><input class="form-control" name="mobile" placeholder="Mobile" required></div>
        <div class="col-lg-2"><label class="form-label">Password</label><input class="form-control" name="password" placeholder="Password" required></div>
        <div class="col-lg-2 d-flex align-items-end"><button class="btn btn-primary w-100">Add Teacher</button></div>
    </form>
</div>

<div class="lms-card fade-in">
    <div class="lms-card__header">
        <h5 class="mb-0">Teacher directory</h5>
        <span class="badge badge-category badge-category--mint">Roster</span>
    </div>
    <div class="table-responsive">
        <table class="table table-borderless align-middle mb-0">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Subscription</th>
                    <th>Expiry</th>
                    <th>Approval</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($teachers as $teacher): ?>
                <?php $isApproved = $teacher['approval_status'] === 'approved'; ?>
                <tr>
                    <td><?= Helpers::e($teacher['name']) ?></td>
                    <td><?= Helpers::e($teacher['email']) ?></td>
                    <td><?= Helpers::e($teacher['mobile']) ?></td>
                    <td><?= Helpers::e($teacher['subscription_status']) ?></td>
                    <td><?= Helpers::e($teacher['subscription_expiry']) ?></td>
                    <td>
                        <span class="badge badge-category <?= $isApproved ? 'badge-category--mint' : 'badge-category--slate' ?>">
                            <?= Helpers::e($teacher['approval_status']) ?>
                        </span>
                        <?php if (!$isApproved): ?>
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
    </div>
</div>
<?php require __DIR__ . '/../layouts/footer.php'; ?>
