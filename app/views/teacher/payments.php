<?php require __DIR__ . '/../layouts/header.php'; ?>
<h2>Subscription Payments</h2>
<form method="post" action="/public/index.php?route=teacher/payments/create" enctype="multipart/form-data" class="row g-3 mb-4">
    <input type="hidden" name="csrf_token" value="<?= Csrf::token() ?>">
    <div class="col-md-3"><input class="form-control" name="amount" placeholder="Amount" type="number" step="0.01" required></div>
    <div class="col-md-5"><input class="form-control" type="file" name="proof" required></div>
    <div class="col-md-2"><button class="btn btn-primary w-100">Submit</button></div>
</form>
<table class="table table-bordered">
    <thead><tr><th>Amount</th><th>Status</th><th>Paid On</th></tr></thead>
    <tbody>
    <?php foreach ($payments as $payment): ?>
        <tr>
            <td><?= Helpers::e($payment['amount']) ?></td>
            <td><?= Helpers::e($payment['status']) ?></td>
            <td><?= Helpers::e($payment['paid_on']) ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php require __DIR__ . '/../layouts/footer.php'; ?>
