<?php require __DIR__ . '/../layouts/header.php'; ?>
<div class="d-flex align-items-start justify-content-between mb-4">
    <div>
        <p class="text-uppercase lms-eyebrow">Admin</p>
        <h2 class="lms-heading">Payments</h2>
        <p class="text-muted mb-0">Approve payments and keep billing in perfect order.</p>
    </div>
    <span class="badge badge-category badge-category--mint">Finance</span>
</div>
<?php
$buildProofMeta = function ($proofPath) {
    if (!$proofPath) {
        return ['url' => null, 'type' => null];
    }

    $normalized = str_replace('\\', '/', $proofPath);
    $pattern = '#^/assets/uploads/payment_proofs/([A-Za-z0-9._-]+)$#';
    if (!preg_match($pattern, $normalized, $matches)) {
        return ['url' => null, 'type' => null];
    }

    $filename = $matches[1];
    $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    $type = 'unknown';
    if (in_array($extension, ['jpg', 'jpeg', 'png', 'webp', 'gif'], true)) {
        $type = 'image';
    } elseif ($extension === 'pdf') {
        $type = 'pdf';
    }

    return ['url' => "/assets/uploads/payment_proofs/{$filename}", 'type' => $type];
};
?>

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
                        <?php $proofMeta = $buildProofMeta($payment['proof'] ?? null); ?>
                        <div class="d-flex flex-wrap gap-2">
                            <?php if ($proofMeta['url']): ?>
                                <button
                                    type="button"
                                    class="btn btn-outline-primary btn-sm"
                                    data-bs-toggle="modal"
                                    data-bs-target="#proofModal"
                                    data-proof-url="<?= Helpers::e($proofMeta['url']) ?>"
                                    data-proof-type="<?= Helpers::e($proofMeta['type']) ?>"
                                    data-proof-title="<?= Helpers::e('Teacher: ' . $payment['teacher_name'] . ' · Amount: ' . $payment['amount']) ?>"
                                >
                                    View Proof
                                </button>
                            <?php else: ?>
                                <span class="badge bg-secondary">No proof</span>
                            <?php endif; ?>
                            <?php if ($payment['status'] === 'pending'): ?>
                                <form method="post" action="/public/index.php?route=admin/payments/teacher/approve">
                                    <input type="hidden" name="csrf_token" value="<?= Csrf::token() ?>">
                                    <input type="hidden" name="payment_id" value="<?= $payment['id'] ?>">
                                    <button class="btn btn-sm btn-success">Approve</button>
                                </form>
                            <?php endif; ?>
                        </div>
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
                        <?php $proofMeta = $buildProofMeta($payment['proof'] ?? null); ?>
                        <div class="d-flex flex-wrap gap-2">
                            <?php if ($proofMeta['url']): ?>
                                <button
                                    type="button"
                                    class="btn btn-outline-primary btn-sm"
                                    data-bs-toggle="modal"
                                    data-bs-target="#proofModal"
                                    data-proof-url="<?= Helpers::e($proofMeta['url']) ?>"
                                    data-proof-type="<?= Helpers::e($proofMeta['type']) ?>"
                                    data-proof-title="<?= Helpers::e('Student: ' . $payment['student_name'] . ' · Total: ' . $payment['total_amount']) ?>"
                                >
                                    View Proof
                                </button>
                            <?php else: ?>
                                <span class="badge bg-secondary">No proof</span>
                            <?php endif; ?>
                            <?php if ($payment['status'] === 'pending'): ?>
                                <form method="post" action="/public/index.php?route=admin/payments/student/approve">
                                    <input type="hidden" name="csrf_token" value="<?= Csrf::token() ?>">
                                    <input type="hidden" name="payment_id" value="<?= $payment['id'] ?>">
                                    <button class="btn btn-sm btn-success">Approve</button>
                                </form>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="proofModal" tabindex="-1" aria-labelledby="proofModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="proofModalLabel">Payment proof</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="proofModalBody" class="text-center text-muted">
                    Select a proof to preview.
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    (function () {
        var modal = document.getElementById('proofModal');
        if (!modal) {
            return;
        }
        modal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            if (!button) {
                return;
            }
            var proofUrl = button.getAttribute('data-proof-url');
            var proofType = button.getAttribute('data-proof-type');
            var proofTitle = button.getAttribute('data-proof-title');
            var modalTitle = modal.querySelector('.modal-title');
            var modalBody = modal.querySelector('#proofModalBody');

            if (modalTitle) {
                modalTitle.textContent = proofTitle || 'Payment proof';
            }
            if (!proofUrl || !modalBody) {
                return;
            }

            if (proofType === 'image') {
                modalBody.innerHTML = '<img src="' + proofUrl + '" alt="Payment proof" class="img-fluid">';
            } else if (proofType === 'pdf') {
                modalBody.innerHTML = '<iframe src="' + proofUrl + '" style="width:100%;height:70vh;" frameborder="0"></iframe>';
            } else {
                modalBody.innerHTML = '<a href="' + proofUrl + '" class="btn btn-outline-primary btn-sm" target="_blank" rel="noopener">Download proof</a>';
            }
        });
    })();
</script>
<?php require __DIR__ . '/../layouts/footer.php'; ?>
