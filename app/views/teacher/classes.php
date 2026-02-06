<?php require __DIR__ . '/../layouts/header.php'; ?>
<div class="d-flex align-items-start justify-content-between mb-4">
    <div>
        <p class="text-uppercase lms-eyebrow">Schedule</p>
        <h2 class="lms-heading">Class schedule</h2>
        <p class="text-muted mb-0">Plan and track every live class across your cohorts.</p>
    </div>
    <span class="badge badge-category badge-category--indigo">Live</span>
</div>

<div class="lms-card fade-in mb-4">
    <div class="lms-card__header">
        <h5 class="mb-0">Add a class</h5>
        <span class="badge badge-category badge-category--slate">Planner</span>
    </div>
    <form method="post" action="/public/index.php?route=teacher/classes/create" class="row g-3">
        <input type="hidden" name="csrf_token" value="<?= Csrf::token() ?>">
        <div class="col-lg-3">
            <label class="form-label">Batch</label>
            <select class="form-select" name="batch_id" required>
                <option value="">Select Batch</option>
                <?php foreach ($batches as $batch): ?>
                    <option value="<?= $batch['id'] ?>"><?= Helpers::e($batch['name']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-lg-2">
            <label class="form-label">Date</label>
            <input class="form-control" type="date" name="class_date" required>
        </div>
        <div class="col-lg-2">
            <label class="form-label">Start time</label>
            <input class="form-control" type="time" name="start_time" required>
        </div>
        <div class="col-lg-2">
            <label class="form-label">End time</label>
            <input class="form-control" type="time" name="end_time" required>
        </div>
        <div class="col-lg-2">
            <label class="form-label">Topic</label>
            <input class="form-control" name="topic" placeholder="Topic" required>
        </div>
        <div class="col-lg-1 d-flex align-items-end">
            <button class="btn btn-primary w-100">Add</button>
        </div>
    </form>
</div>

<div class="lms-card fade-in">
    <div class="lms-card__header">
        <h5 class="mb-0">Upcoming classes</h5>
        <span class="badge badge-category">Timeline</span>
    </div>
    <div class="table-responsive">
        <table class="table table-borderless align-middle mb-0">
            <thead>
                <tr>
                    <th>Batch</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Topic</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($classes as $class): ?>
                <tr>
                    <td><?= Helpers::e($class['batch_name']) ?></td>
                    <td><?= Helpers::e($class['class_date']) ?></td>
                    <td><?= Helpers::e($class['start_time']) ?> - <?= Helpers::e($class['end_time']) ?></td>
                    <td><?= Helpers::e($class['topic']) ?></td>
                    <td><span class="badge badge-category badge-category--slate"><?= Helpers::e($class['status']) ?></span></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php require __DIR__ . '/../layouts/footer.php'; ?>
