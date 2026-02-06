<?php require __DIR__ . '/../layouts/header.php'; ?>
<div class="d-flex align-items-start justify-content-between mb-4">
    <div>
        <p class="text-uppercase lms-eyebrow">Admin</p>
        <h2 class="lms-heading">Batches</h2>
        <p class="text-muted mb-0">Create cohorts and assign teachers in one streamlined flow.</p>
    </div>
    <span class="badge badge-category badge-category--indigo">Cohorts</span>
</div>

<div class="lms-card fade-in mb-4">
    <div class="lms-card__header">
        <h5 class="mb-0">Add a batch</h5>
        <span class="badge badge-category badge-category--slate">Setup</span>
    </div>
    <form method="post" action="/public/index.php?route=admin/batches/create" class="row g-3">
        <input type="hidden" name="csrf_token" value="<?= Csrf::token() ?>">
        <div class="col-lg-4">
            <label class="form-label">Batch name</label>
            <input class="form-control" name="name" placeholder="Batch Name" required>
        </div>
        <div class="col-lg-4">
            <label class="form-label">Assign teacher</label>
            <select class="form-select" name="teacher_id" required>
                <option value="">Assign Teacher</option>
                <?php foreach ($teachers as $teacher): ?>
                    <option value="<?= $teacher['id'] ?>"><?= Helpers::e($teacher['name']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-lg-2">
            <label class="form-label">Fee</label>
            <input class="form-control" name="fee_amount" placeholder="Fee" type="number" step="0.01" required>
        </div>
        <div class="col-lg-2 d-flex align-items-end">
            <button class="btn btn-primary w-100">Add Batch</button>
        </div>
    </form>
</div>

<div class="lms-card fade-in">
    <div class="lms-card__header">
        <h5 class="mb-0">Active batches</h5>
        <span class="badge badge-category">Overview</span>
    </div>
    <div class="table-responsive">
        <table class="table table-borderless align-middle mb-0">
            <thead>
                <tr>
                    <th>Batch</th>
                    <th>Teacher</th>
                    <th>Fee</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($batches as $batch): ?>
                <tr>
                    <td><?= Helpers::e($batch['name']) ?></td>
                    <td><?= Helpers::e($batch['teacher_name']) ?></td>
                    <td><?= Helpers::e($batch['fee_amount']) ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php require __DIR__ . '/../layouts/footer.php'; ?>
