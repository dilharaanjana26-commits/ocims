<?php require __DIR__ . '/../layouts/header.php'; ?>
<div class="d-flex align-items-start justify-content-between mb-4">
    <div>
        <p class="text-uppercase lms-eyebrow">Admin</p>
        <h2 class="lms-heading">Payments</h2>
        <p class="text-muted mb-0">Approve payments and keep billing in perfect order.</p>
    </div>
    <span class="badge badge-category badge-category--mint">Finance</span>
</div>

<div class="lms-card fade-in mb-4">
    <div class="lms-card__header">
        <h5 class="mb-0">Teacher payments</h5>
        <span class="badge badge-category badge-category--slate">Review</span>
    </div>
    <div class="table-responsive">
        <table class="table table-borderless align-middle mb-0">
            <thead>
                <tr>
                    <th>Teacher</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Paid On</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($teacherPayments as $payment): ?>
                <tr>
                    <td><?= Helpers::e($payment['teacher_name']) ?></td>
                    <td><?= Helpers::e($payment['amount']) ?></td>
                    <td><span class="badge badge-category badge-category--slate"><?= Helpers::e($payment['status']) ?></span></td>
                    <td><?= Helpers::e($payment['paid_on']) ?></td>
                    <td>
                        <?php if ($payment['status'] === 'pending'): ?>
                            <form method="post" action="/public/index.php?route=admin/payments/teacher/approve">
                                <input type="hidden" name="csrf_token" value="<?= Csrf::token() ?>">
                                <input type="hidden" name="payment_id" value="<?= $payment['id'] ?>">
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
        <h5 class="mb-0">Student payments</h5>
        <span class="badge badge-category badge-category--indigo">Invoices</span>
    </div>
    <div class="table-responsive">
        <table class="table table-borderless align-middle mb-0">
            <thead>
                <tr>
                    <th>Student</th>
                    <th>Batch</th>
                    <th>Total</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($studentPayments as $payment): ?>
                <tr>
                    <td><?= Helpers::e($payment['student_name']) ?></td>
                    <td><?= Helpers::e($payment['batch_name']) ?></td>
                    <td><?= Helpers::e($payment['total_amount']) ?></td>
                    <td><?= Helpers::e($payment['payment_type']) ?></td>
                    <td><span class="badge badge-category badge-category--slate"><?= Helpers::e($payment['status']) ?></span></td>
                    <td>
                        <?php if ($payment['status'] === 'pending'): ?>
                            <form method="post" action="/public/index.php?route=admin/payments/student/approve">
                                <input type="hidden" name="csrf_token" value="<?= Csrf::token() ?>">
                                <input type="hidden" name="payment_id" value="<?= $payment['id'] ?>">
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
<?php require __DIR__ . '/../layouts/footer.php'; ?>
