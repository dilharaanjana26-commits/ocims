<?php require __DIR__ . '/../layouts/header.php'; ?>
<h2>Student Payments</h2>
<div class="row g-4">
    <div class="col-md-6">
        <h5>Manual Payment</h5>
        <form method="post" action="/public/index.php?route=student/payments/manual" enctype="multipart/form-data" class="row g-3">
            <input type="hidden" name="csrf_token" value="<?= Csrf::token() ?>">
            <div class="col-12">
                <select class="form-select" name="batch_id" required>
                    <option value="">Select Batch</option>
                    <?php foreach ($batches as $batch): ?>
                        <option value="<?= $batch['id'] ?>"><?= Helpers::e($batch['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-12"><input class="form-control" type="number" step="0.01" name="amount" placeholder="Amount" required></div>
            <div class="col-12"><input class="form-control" type="file" name="proof" required></div>
            <div class="col-12"><button class="btn btn-primary w-100">Submit Manual</button></div>
        </form>
    </div>
    <div class="col-md-6">
        <h5>Online Payment (Mock)</h5>
        <form method="post" action="/public/index.php?route=student/payments/online" class="row g-3">
            <input type="hidden" name="csrf_token" value="<?= Csrf::token() ?>">
            <div class="col-12">
                <select class="form-select" name="batch_id" required>
                    <option value="">Select Batch</option>
                    <?php foreach ($batches as $batch): ?>
                        <option value="<?= $batch['id'] ?>"><?= Helpers::e($batch['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-12"><input class="form-control" type="number" step="0.01" name="amount" placeholder="Amount" required></div>
            <div class="col-12"><button class="btn btn-success w-100">Pay Online</button></div>
            <p class="text-muted">A 5% convenience fee is automatically added for online payments.</p>
        </form>
    </div>
</div>
<h5 class="mt-4">Payment History</h5>
<table class="table table-bordered">
    <thead><tr><th>Batch</th><th>Amount</th><th>Fee</th><th>Total</th><th>Type</th><th>Status</th></tr></thead>
    <tbody>
    <?php foreach ($payments as $payment): ?>
        <tr>
            <td><?= Helpers::e($payment['batch_name']) ?></td>
            <td><?= Helpers::e($payment['amount']) ?></td>
            <td><?= Helpers::e($payment['convenience_fee']) ?></td>
            <td><?= Helpers::e($payment['total_amount']) ?></td>
            <td><?= Helpers::e($payment['payment_type']) ?></td>
            <td><?= Helpers::e($payment['status']) ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php require __DIR__ . '/../layouts/footer.php'; ?>
