<?php require __DIR__ . '/../layouts/header.php'; ?>
<div class="d-flex align-items-start justify-content-between mb-4">
    <div>
        <p class="text-uppercase lms-eyebrow">Admin</p>
        <h2 class="lms-heading">Posts</h2>
        <p class="text-muted mb-0">Review submissions and approve feature requests.</p>
    </div>
    <span class="badge badge-category badge-category--indigo">Moderation</span>
</div>

<div class="lms-card fade-in mb-4">
    <div class="lms-card__header">
        <h5 class="mb-0">Post approvals</h5>
        <span class="badge badge-category badge-category--slate">Queue</span>
    </div>
    <div class="table-responsive">
        <table class="table table-borderless align-middle mb-0">
            <thead>
                <tr>
                    <th>Teacher</th>
                    <th>Batch</th>
                    <th>Content</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($posts as $post): ?>
                <tr>
                    <td><?= Helpers::e($post['teacher_name']) ?></td>
                    <td><?= Helpers::e($post['batch_name']) ?></td>
                    <td><?= Helpers::e($post['content']) ?></td>
                    <td><span class="badge badge-category badge-category--slate"><?= Helpers::e($post['status']) ?></span></td>
                    <td>
                        <?php if ($post['status'] === 'pending'): ?>
                            <form method="post" action="/public/index.php?route=admin/posts/approve">
                                <input type="hidden" name="csrf_token" value="<?= Csrf::token() ?>">
                                <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
                                <button class="btn btn-sm btn-success">Approve</button>
                            </form>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="lms-card fade-in">
    <div class="lms-card__header">
        <h5 class="mb-0">Post feature requests</h5>
        <span class="badge badge-category">Boosts</span>
    </div>
    <div class="table-responsive">
        <table class="table table-borderless align-middle mb-0">
            <thead>
                <tr>
                    <th>Post</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($postPayments as $payment): ?>
                <tr>
                    <td><?= Helpers::e($payment['content']) ?></td>
                    <td><?= Helpers::e($payment['amount']) ?></td>
                    <td><span class="badge badge-category badge-category--slate"><?= Helpers::e($payment['status']) ?></span></td>
                    <td>
                        <?php if ($payment['status'] === 'pending'): ?>
                            <form method="post" action="/public/index.php?route=admin/posts/feature">
                                <input type="hidden" name="csrf_token" value="<?= Csrf::token() ?>">
                                <input type="hidden" name="payment_id" value="<?= $payment['id'] ?>">
                                <button class="btn btn-sm btn-success">Approve Feature</button>
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
