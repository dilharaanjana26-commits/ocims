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
                        <?php
                            $proofPath = $payment['proof'] ?? '';
                            $proofUrl = '/public/index.php?route=admin/payments/proof&id=' . $payment['id'];
                            $extension = strtolower(pathinfo($proofPath, PATHINFO_EXTENSION));
                            $isAllowed = in_array($extension, ['pdf', 'png', 'jpg', 'jpeg', 'gif'], true);
                            $hasProof = $proofPath !== '' && strpos($proofPath, 'uploads/payment_proofs/') === 0 && $isAllowed;
                        ?>
                        <button type="button" class="btn btn-sm btn-outline-primary me-2" data-bs-toggle="modal" data-bs-target="#teacherProofModal<?= $payment['id'] ?>">
                            View Proof
                        </button>
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
<?php foreach ($teacherPayments as $payment): ?>
    <?php
        $proofPath = $payment['proof'] ?? '';
        $proofUrl = '/public/index.php?route=admin/payments/proof&id=' . $payment['id'];
        $extension = strtolower(pathinfo($proofPath, PATHINFO_EXTENSION));
        $isAllowed = in_array($extension, ['pdf', 'png', 'jpg', 'jpeg', 'gif'], true);
        $hasProof = $proofPath !== '' && strpos($proofPath, 'uploads/payment_proofs/') === 0 && $isAllowed;
    ?>
    <div class="modal fade" id="teacherProofModal<?= $payment['id'] ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Payment Proof</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php if (!$hasProof): ?>
                        <p class="text-muted mb-0">No proof uploaded.</p>
                    <?php elseif ($extension === 'pdf'): ?>
                        <iframe class="w-100" style="height:70vh" src="<?= Helpers::e($proofUrl) ?>"></iframe>
                    <?php else: ?>
                        <img class="img-fluid" src="<?= Helpers::e($proofUrl) ?>" alt="Payment proof">
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

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
                        <?php
                            $proofPath = $payment['proof'] ?? '';
                            $proofUrl = '/public/index.php?route=admin/payments/proof&id=' . $payment['id'];
                            $extension = strtolower(pathinfo($proofPath, PATHINFO_EXTENSION));
                            $isAllowed = in_array($extension, ['pdf', 'png', 'jpg', 'jpeg', 'gif'], true);
                            $hasProof = $proofPath !== '' && strpos($proofPath, 'uploads/payment_proofs/') === 0 && $isAllowed;
                        ?>
                        <button type="button" class="btn btn-sm btn-outline-primary me-2" data-bs-toggle="modal" data-bs-target="#studentProofModal<?= $payment['id'] ?>">
                            View Proof
                        </button>
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
<?php foreach ($studentPayments as $payment): ?>
    <?php
        $proofPath = $payment['proof'] ?? '';
        $proofUrl = '/public/index.php?route=admin/payments/proof&id=' . $payment['id'];
        $extension = strtolower(pathinfo($proofPath, PATHINFO_EXTENSION));
        $isAllowed = in_array($extension, ['pdf', 'png', 'jpg', 'jpeg', 'gif'], true);
        $hasProof = $proofPath !== '' && strpos($proofPath, 'uploads/payment_proofs/') === 0 && $isAllowed;
    ?>
    <div class="modal fade" id="studentProofModal<?= $payment['id'] ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Payment Proof</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php if (!$hasProof): ?>
                        <p class="text-muted mb-0">No proof uploaded.</p>
                    <?php elseif ($extension === 'pdf'): ?>
                        <iframe class="w-100" style="height:70vh" src="<?= Helpers::e($proofUrl) ?>"></iframe>
                    <?php else: ?>
                        <img class="img-fluid" src="<?= Helpers::e($proofUrl) ?>" alt="Payment proof">
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<?php require __DIR__ . '/../layouts/footer.php'; ?>
