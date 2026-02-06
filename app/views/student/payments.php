<?php require __DIR__ . '/../layouts/header.php'; ?>
<div class="d-flex align-items-start justify-content-between mb-4">
    <div>
        <p class="text-uppercase lms-eyebrow">Billing</p>
        <h2 class="lms-heading">Student payments</h2>
        <p class="text-muted mb-0">Manage invoices, upload receipts, and stay ahead of billing.</p>
    </div>
    <span class="badge badge-category badge-category--mint">Secure</span>
</div>

<div class="row g-4">
    <div class="col-lg-6">
        <div class="lms-card fade-in h-100">
            <div class="lms-card__header">
                <h5 class="mb-0">Manual payment</h5>
                <span class="badge badge-category badge-category--slate">Upload</span>
            </div>
            <form method="post" action="/public/index.php?route=student/payments/manual" enctype="multipart/form-data" class="row g-3">
                <input type="hidden" name="csrf_token" value="<?= Csrf::token() ?>">
                <div class="col-12">
                    <label class="form-label">Select batch</label>
                    <select class="form-select" name="batch_id" required>
                        <option value="">Select Batch</option>
                        <?php foreach ($batches as $batch): ?>
                            <option value="<?= $batch['id'] ?>"><?= Helpers::e($batch['name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-12">
                    <label class="form-label">Amount</label>
                    <input class="form-control" type="number" step="0.01" name="amount" placeholder="Amount" required>
                </div>
                <div class="col-12">
                    <label class="form-label">Upload payment proof</label>
                    <input class="form-control" type="file" name="proof" required>
                </div>
                <div class="col-12"><button class="btn btn-primary w-100">Submit manual payment</button></div>
            </form>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="lms-card fade-in h-100">
            <div class="lms-card__header">
                <h5 class="mb-0">Online payment</h5>
                <span class="badge badge-category badge-category--indigo">Fast</span>
            </div>
            <form method="post" action="/public/index.php?route=student/payments/online" class="row g-3">
                <input type="hidden" name="csrf_token" value="<?= Csrf::token() ?>">
                <div class="col-12">
                    <label class="form-label">Select batch</label>
                    <select class="form-select" name="batch_id" required>
                        <option value="">Select Batch</option>
                        <?php foreach ($batches as $batch): ?>
                            <option value="<?= $batch['id'] ?>"><?= Helpers::e($batch['name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-12">
                    <label class="form-label">Amount</label>
                    <input class="form-control" type="number" step="0.01" name="amount" placeholder="Amount" required>
                </div>
                <div class="col-12"><button class="btn btn-success w-100">Pay online</button></div>
                <p class="text-muted small mb-0">A 5% convenience fee is automatically added for online payments.</p>
            </form>
        </div>
    </div>
</div>

<div class="lms-card fade-in mt-4">
    <div class="lms-card__header">
        <h5 class="mb-0">Payment history</h5>
        <span class="badge badge-category">Archive</span>
    </div>
    <div class="table-responsive">
        <table class="table table-borderless align-middle mb-0">
            <thead>
                <tr>
                    <th>Batch</th>
                    <th>Amount</th>
                    <th>Fee</th>
                    <th>Total</th>
                    <th>Type</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($payments as $payment): ?>
                <tr>
                    <td><?= Helpers::e($payment['batch_name']) ?></td>
                    <td><?= Helpers::e($payment['amount']) ?></td>
                    <td><?= Helpers::e($payment['convenience_fee']) ?></td>
                    <td><?= Helpers::e($payment['total_amount']) ?></td>
                    <td><?= Helpers::e($payment['payment_type']) ?></td>
                    <td><span class="badge badge-category badge-category--slate"><?= Helpers::e($payment['status']) ?></span></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php require __DIR__ . '/../layouts/footer.php'; ?>
