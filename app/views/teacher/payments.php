<?php require __DIR__ . '/../layouts/header.php'; ?>
<div class="d-flex align-items-start justify-content-between mb-4">
    <div>
        <p class="text-uppercase lms-eyebrow">Billing</p>
        <h2 class="lms-heading">Subscription payments</h2>
        <p class="text-muted mb-0">Submit receipts and review your payment history.</p>
    </div>
    <span class="badge badge-category badge-category--mint">Secure</span>
</div>

<div class="lms-card fade-in mb-4">
    <div class="lms-card__header">
        <h5 class="mb-0">Submit payment</h5>
        <span class="badge badge-category badge-category--slate">Receipt</span>
    </div>
    <form method="post" action="/public/index.php?route=teacher/payments/create" enctype="multipart/form-data" class="row g-3">
        <input type="hidden" name="csrf_token" value="<?= Csrf::token() ?>">
        <div class="col-lg-4">
            <label class="form-label">Amount</label>
            <input class="form-control" name="amount" placeholder="Amount" type="number" step="0.01" required>
        </div>
        <div class="col-lg-6">
            <label class="form-label">Upload proof</label>
            <input class="form-control" type="file" name="proof" required>
        </div>
        <div class="col-lg-2 d-flex align-items-end">
            <button class="btn btn-primary w-100">Submit</button>
        </div>
    </form>
</div>

<div class="lms-card fade-in">
    <div class="lms-card__header">
        <h5 class="mb-0">Payment history</h5>
        <span class="badge badge-category">Archive</span>
    </div>
    <div class="table-responsive">
        <table class="table table-borderless align-middle mb-0">
            <thead>
                <tr>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Paid On</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($payments as $payment): ?>
                <tr>
                    <td><?= Helpers::e($payment['amount']) ?></td>
                    <td><span class="badge badge-category badge-category--slate"><?= Helpers::e($payment['status']) ?></span></td>
                    <td><?= Helpers::e($payment['paid_on']) ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php require __DIR__ . '/../layouts/footer.php'; ?>
