<?php require __DIR__ . '/../layouts/header.php'; ?>
<h2>Payments</h2>
<h4 class="mt-4">Teacher Payments</h4>
<table class="table table-bordered">
    <thead><tr><th>Teacher</th><th>Amount</th><th>Status</th><th>Paid On</th><th>Action</th></tr></thead>
    <tbody>
    <?php foreach ($teacherPayments as $payment): ?>
        <tr>
            <td><?= Helpers::e($payment['teacher_name']) ?></td>
            <td><?= Helpers::e($payment['amount']) ?></td>
            <td><?= Helpers::e($payment['status']) ?></td>
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

<h4 class="mt-4">Student Payments</h4>
<table class="table table-bordered">
    <thead><tr><th>Student</th><th>Batch</th><th>Total</th><th>Type</th><th>Status</th><th>Action</th></tr></thead>
    <tbody>
    <?php foreach ($studentPayments as $payment): ?>
        <tr>
            <td><?= Helpers::e($payment['student_name']) ?></td>
            <td><?= Helpers::e($payment['batch_name']) ?></td>
            <td><?= Helpers::e($payment['total_amount']) ?></td>
            <td><?= Helpers::e($payment['payment_type']) ?></td>
            <td><?= Helpers::e($payment['status']) ?></td>
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
<?php require __DIR__ . '/../layouts/footer.php'; ?>
