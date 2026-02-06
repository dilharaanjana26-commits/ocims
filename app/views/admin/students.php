<?php require __DIR__ . '/../layouts/header.php'; ?>
<div class="d-flex align-items-start justify-content-between mb-4">
    <div>
        <p class="text-uppercase lms-eyebrow">Admin</p>
        <h2 class="lms-heading">Students</h2>
        <p class="text-muted mb-0">Manage learner profiles and approval status.</p>
    </div>
    <span class="badge badge-category badge-category--mint">Learners</span>
</div>

<div class="lms-card fade-in mb-4">
    <div class="lms-card__header">
        <h5 class="mb-0">Add student</h5>
        <span class="badge badge-category badge-category--slate">Enrollment</span>
    </div>
    <form method="post" action="/public/index.php?route=admin/students/create" class="row g-3">
        <input type="hidden" name="csrf_token" value="<?= Csrf::token() ?>">
        <div class="col-lg-3"><label class="form-label">Name</label><input class="form-control" name="name" placeholder="Name" required></div>
        <div class="col-lg-1"><label class="form-label">Age</label><input class="form-control" name="age" placeholder="Age" type="number" required></div>
        <div class="col-lg-2"><label class="form-label">NIC</label><input class="form-control" name="NIC" placeholder="NIC" required></div>
        <div class="col-lg-2"><label class="form-label">City</label><input class="form-control" name="city" placeholder="City" required></div>
        <div class="col-lg-2"><label class="form-label">WhatsApp</label><input class="form-control" name="WhatsApp" placeholder="WhatsApp" required></div>
        <div class="col-lg-2"><label class="form-label">Email</label><input class="form-control" name="email" placeholder="Email" type="email" required></div>
        <div class="col-lg-2"><label class="form-label">Password</label><input class="form-control" name="password" placeholder="Password" required></div>
        <div class="col-lg-2 d-flex align-items-end"><button class="btn btn-primary w-100">Add Student</button></div>
    </form>
</div>

<div class="lms-card fade-in">
    <div class="lms-card__header">
        <h5 class="mb-0">Student directory</h5>
        <span class="badge badge-category badge-category--indigo">Roster</span>
    </div>
    <div class="table-responsive">
        <table class="table table-borderless align-middle mb-0">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>City</th>
                    <th>WhatsApp</th>
                    <th>Approval</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($students as $student): ?>
                <?php $isApproved = $student['approval_status'] === 'approved'; ?>
                <tr>
                    <td><?= Helpers::e($student['name']) ?></td>
                    <td><?= Helpers::e($student['email']) ?></td>
                    <td><?= Helpers::e($student['city']) ?></td>
                    <td><?= Helpers::e($student['WhatsApp']) ?></td>
                    <td>
                        <span class="badge badge-category <?= $isApproved ? 'badge-category--mint' : 'badge-category--slate' ?>">
                            <?= Helpers::e($student['approval_status']) ?>
                        </span>
                        <?php if (!$isApproved): ?>
                            <form method="post" action="/public/index.php?route=admin/students/approve" class="d-inline">
                                <input type="hidden" name="csrf_token" value="<?= Csrf::token() ?>">
                                <input type="hidden" name="student_id" value="<?= Helpers::e($student['id']) ?>">
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
