<?php require __DIR__ . '/../layouts/header.php'; ?>
<div class="d-flex align-items-start justify-content-between mb-4">
    <div>
        <p class="text-uppercase lms-eyebrow">Community</p>
        <h2 class="lms-heading">Posts</h2>
        <p class="text-muted mb-0">Share announcements and highlight featured content.</p>
    </div>
    <span class="badge badge-category badge-category--indigo">Engagement</span>
</div>

<div class="lms-card fade-in mb-4">
    <div class="lms-card__header">
        <h5 class="mb-0">Create a post</h5>
        <span class="badge badge-category badge-category--slate">New</span>
    </div>
    <form method="post" action="/public/index.php?route=teacher/posts/create" enctype="multipart/form-data" class="row g-3">
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
        <div class="col-lg-4">
            <label class="form-label">Post content</label>
            <input class="form-control" name="content" placeholder="Post content" required>
        </div>
        <div class="col-lg-3">
            <label class="form-label">Media</label>
            <input class="form-control" type="file" name="media">
        </div>
        <div class="col-lg-2 d-flex align-items-end">
            <button class="btn btn-primary w-100">Post</button>
        </div>
    </form>
</div>

<div class="lms-card fade-in">
    <div class="lms-card__header">
        <h5 class="mb-0">All posts</h5>
        <span class="badge badge-category">Moderation</span>
    </div>
    <div class="table-responsive">
        <table class="table table-borderless align-middle mb-0">
            <thead>
                <tr>
                    <th>Content</th>
                    <th>Status</th>
                    <th>Feature request</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($posts as $post): ?>
                <tr>
                    <td><?= Helpers::e($post['content']) ?></td>
                    <td><span class="badge badge-category badge-category--slate"><?= Helpers::e($post['status']) ?></span></td>
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
    </div>
</div>
<?php require __DIR__ . '/../layouts/footer.php'; ?>
