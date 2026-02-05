<?php require __DIR__ . '/../layouts/header.php'; ?>
<h2>Class Schedule</h2>
<form method="post" action="/public/index.php?route=teacher/classes/create" class="row g-3 mb-4">
    <input type="hidden" name="csrf_token" value="<?= Csrf::token() ?>">
    <div class="col-md-3">
        <select class="form-select" name="batch_id" required>
            <option value="">Select Batch</option>
            <?php foreach ($batches as $batch): ?>
                <option value="<?= $batch['id'] ?>"><?= Helpers::e($batch['name']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="col-md-2"><input class="form-control" type="date" name="class_date" required></div>
    <div class="col-md-2"><input class="form-control" type="time" name="start_time" required></div>
    <div class="col-md-2"><input class="form-control" type="time" name="end_time" required></div>
    <div class="col-md-2"><input class="form-control" name="topic" placeholder="Topic" required></div>
    <div class="col-md-1"><button class="btn btn-primary w-100">Add</button></div>
</form>
<table class="table table-bordered">
    <thead><tr><th>Batch</th><th>Date</th><th>Time</th><th>Topic</th><th>Status</th></tr></thead>
    <tbody>
    <?php foreach ($classes as $class): ?>
        <tr>
            <td><?= Helpers::e($class['batch_name']) ?></td>
            <td><?= Helpers::e($class['class_date']) ?></td>
            <td><?= Helpers::e($class['start_time']) ?> - <?= Helpers::e($class['end_time']) ?></td>
            <td><?= Helpers::e($class['topic']) ?></td>
            <td><?= Helpers::e($class['status']) ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php require __DIR__ . '/../layouts/footer.php'; ?>
