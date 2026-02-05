<?php require __DIR__ . '/../layouts/header.php'; ?>
<h2>Posts</h2>
<table class="table table-bordered">
    <thead><tr><th>Teacher</th><th>Batch</th><th>Content</th><th>Status</th><th>Action</th></tr></thead>
    <tbody>
    <?php foreach ($posts as $post): ?>
        <tr>
            <td><?= Helpers::e($post['teacher_name']) ?></td>
            <td><?= Helpers::e($post['batch_name']) ?></td>
            <td><?= Helpers::e($post['content']) ?></td>
            <td><?= Helpers::e($post['status']) ?></td>
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

<h4 class="mt-4">Post Feature Requests</h4>
<table class="table table-bordered">
    <thead><tr><th>Post</th><th>Amount</th><th>Status</th><th>Action</th></tr></thead>
    <tbody>
    <?php foreach ($postPayments as $payment): ?>
        <tr>
            <td><?= Helpers::e($payment['content']) ?></td>
            <td><?= Helpers::e($payment['amount']) ?></td>
            <td><?= Helpers::e($payment['status']) ?></td>
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
<?php require __DIR__ . '/../layouts/footer.php'; ?>
