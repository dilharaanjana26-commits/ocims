<?php require __DIR__ . '/../layouts/header.php'; ?>
<h2>Posts</h2>
<form method="post" action="/public/index.php?route=teacher/posts/create" enctype="multipart/form-data" class="row g-3 mb-4">
    <input type="hidden" name="csrf_token" value="<?= Csrf::token() ?>">
    <div class="col-md-3">
        <select class="form-select" name="batch_id" required>
            <option value="">Select Batch</option>
            <?php foreach ($batches as $batch): ?>
                <option value="<?= $batch['id'] ?>"><?= Helpers::e($batch['name']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="col-md-5"><input class="form-control" name="content" placeholder="Post content" required></div>
    <div class="col-md-3"><input class="form-control" type="file" name="media"></div>
    <div class="col-md-1"><button class="btn btn-primary w-100">Post</button></div>
</form>
<table class="table table-bordered">
    <thead><tr><th>Content</th><th>Status</th><th>Feature Request</th></tr></thead>
    <tbody>
    <?php foreach ($posts as $post): ?>
        <tr>
            <td><?= Helpers::e($post['content']) ?></td>
            <td><?= Helpers::e($post['status']) ?></td>
            <td>
                <form method="post" action="/public/index.php?route=teacher/posts/feature" enctype="multipart/form-data">
                    <input type="hidden" name="csrf_token" value="<?= Csrf::token() ?>">
                    <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
                    <div class="input-group">
                        <input class="form-control" type="number" step="0.01" name="amount" placeholder="Amount" required>
                        <input class="form-control" type="file" name="proof" required>
                        <button class="btn btn-outline-primary">Request</button>
                    </div>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php require __DIR__ . '/../layouts/footer.php'; ?>
