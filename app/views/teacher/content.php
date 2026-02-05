<?php require __DIR__ . '/../layouts/header.php'; ?>
<h2>Teaching Content</h2>
<div class="row g-4">
    <div class="col-md-6">
        <h5>Upload Tute</h5>
        <form method="post" action="/public/index.php?route=teacher/content/tute" enctype="multipart/form-data" class="row g-3">
            <input type="hidden" name="csrf_token" value="<?= Csrf::token() ?>">
            <div class="col-12">
                <select class="form-select" name="batch_id" required>
                    <option value="">Select Batch</option>
                    <?php foreach ($batches as $batch): ?>
                        <option value="<?= $batch['id'] ?>"><?= Helpers::e($batch['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-12"><input class="form-control" name="title" placeholder="Title" required></div>
            <div class="col-12"><input class="form-control" type="file" name="file" required></div>
            <div class="col-12"><button class="btn btn-primary w-100">Upload</button></div>
        </form>
    </div>
    <div class="col-md-6">
        <h5>Add Live Class</h5>
        <form method="post" action="/public/index.php?route=teacher/content/live" class="row g-3">
            <input type="hidden" name="csrf_token" value="<?= Csrf::token() ?>">
            <div class="col-12">
                <select class="form-select" name="batch_id" required>
                    <option value="">Select Batch</option>
                    <?php foreach ($batches as $batch): ?>
                        <option value="<?= $batch['id'] ?>"><?= Helpers::e($batch['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-12"><input class="form-control" name="youtube_embed_url" placeholder="YouTube Embed URL/iframe" required></div>
            <div class="col-12"><input class="form-control" type="date" name="schedule_date" required></div>
            <div class="col-12"><button class="btn btn-success w-100">Add Live</button></div>
        </form>
    </div>
</div>
<h5 class="mt-4">Uploaded Tutes</h5>
<table class="table table-bordered">
    <thead><tr><th>Batch</th><th>Title</th><th>File</th></tr></thead>
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
<h5 class="mt-4">Live Classes</h5>
<table class="table table-bordered">
    <thead><tr><th>Batch</th><th>Date</th><th>URL</th></tr></thead>
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
<?php require __DIR__ . '/../layouts/footer.php'; ?>
