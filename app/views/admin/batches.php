<?php require __DIR__ . '/../layouts/header.php'; ?>
<h2>Batches</h2>
<form method="post" action="/public/index.php?route=admin/batches/create" class="row g-3 mb-4">
    <input type="hidden" name="csrf_token" value="<?= Csrf::token() ?>">
    <div class="col-md-4"><input class="form-control" name="name" placeholder="Batch Name" required></div>
    <div class="col-md-4">
        <select class="form-select" name="teacher_id" required>
            <option value="">Assign Teacher</option>
            <?php foreach ($teachers as $teacher): ?>
                <option value="<?= $teacher['id'] ?>"><?= Helpers::e($teacher['name']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="col-md-2"><input class="form-control" name="fee_amount" placeholder="Fee" type="number" step="0.01" required></div>
    <div class="col-md-2"><button class="btn btn-primary w-100">Add Batch</button></div>
</form>
<table class="table table-bordered">
    <thead><tr><th>Batch</th><th>Teacher</th><th>Fee</th></tr></thead>
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
<?php require __DIR__ . '/../layouts/footer.php'; ?>
