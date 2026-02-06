<?php require __DIR__ . '/../layouts/header.php'; ?>
<div class="d-flex align-items-start justify-content-between mb-4">
    <div>
        <p class="text-uppercase lms-eyebrow">Content studio</p>
        <h2 class="lms-heading">Teaching content</h2>
        <p class="text-muted mb-0">Publish tutes, schedule live classes, and keep learners engaged.</p>
    </div>
    <span class="badge badge-category">Creator</span>
</div>

<div class="row g-4">
    <div class="col-lg-6">
        <div class="lms-card fade-in h-100">
            <div class="lms-card__header">
                <h5 class="mb-0">Upload tute</h5>
                <span class="badge badge-category badge-category--indigo">Files</span>
            </div>
            <form method="post" action="/public/index.php?route=teacher/content/tute" enctype="multipart/form-data" class="row g-3">
                <input type="hidden" name="csrf_token" value="<?= Csrf::token() ?>">
                <div class="col-12">
                    <label class="form-label">Batch</label>
                    <select class="form-select" name="batch_id" required>
                        <option value="">Select Batch</option>
                        <?php foreach ($batches as $batch): ?>
                            <option value="<?= $batch['id'] ?>"><?= Helpers::e($batch['name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-12">
                    <label class="form-label">Title</label>
                    <input class="form-control" name="title" placeholder="Title" required>
                </div>
                <div class="col-12">
                    <label class="form-label">File</label>
                    <input class="form-control" type="file" name="file" required>
                </div>
                <div class="col-12"><button class="btn btn-primary w-100">Upload</button></div>
            </form>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="lms-card fade-in h-100">
            <div class="lms-card__header">
                <h5 class="mb-0">Add live class</h5>
                <span class="badge badge-category badge-category--mint">Streaming</span>
            </div>
            <form method="post" action="/public/index.php?route=teacher/content/live" class="row g-3">
                <input type="hidden" name="csrf_token" value="<?= Csrf::token() ?>">
                <div class="col-12">
                    <label class="form-label">Batch</label>
                    <select class="form-select" name="batch_id" required>
                        <option value="">Select Batch</option>
                        <?php foreach ($batches as $batch): ?>
                            <option value="<?= $batch['id'] ?>"><?= Helpers::e($batch['name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-12">
                    <label class="form-label">YouTube embed URL/iframe</label>
                    <input class="form-control" name="youtube_embed_url" placeholder="YouTube Embed URL/iframe" required>
                </div>
                <div class="col-12">
                    <label class="form-label">Schedule date</label>
                    <input class="form-control" type="date" name="schedule_date" required>
                </div>
                <div class="col-12"><button class="btn btn-success w-100">Add live class</button></div>
            </form>
        </div>
    </div>
</div>

<div class="lms-card fade-in mt-4">
    <div class="lms-card__header">
        <h5 class="mb-0">Uploaded tutes</h5>
        <span class="badge badge-category badge-category--slate">Library</span>
    </div>
    <div class="table-responsive">
        <table class="table table-borderless align-middle mb-0">
            <thead>
                <tr>
                    <th>Batch</th>
                    <th>Title</th>
                    <th>File</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($tutes as $tute): ?>
                <tr>
                    <td><?= Helpers::e($tute['batch_name']) ?></td>
                    <td><?= Helpers::e($tute['title']) ?></td>
                    <td><a href="<?= Helpers::e($tute['file_path']) ?>" class="btn btn-sm btn-outline-primary">View</a></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="lms-card fade-in mt-4">
    <div class="lms-card__header">
        <h5 class="mb-0">Live classes</h5>
        <span class="badge badge-category">Schedule</span>
    </div>
    <div class="table-responsive">
        <table class="table table-borderless align-middle mb-0">
            <thead>
                <tr>
                    <th>Batch</th>
                    <th>Date</th>
                    <th>URL</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($live as $item): ?>
                <tr>
                    <td><?= Helpers::e($item['batch_name']) ?></td>
                    <td><?= Helpers::e($item['schedule_date']) ?></td>
                    <td><?= Helpers::e($item['youtube_embed_url']) ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php require __DIR__ . '/../layouts/footer.php'; ?>
