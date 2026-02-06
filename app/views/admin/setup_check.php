<?php require __DIR__ . '/../layouts/header.php'; ?>
<div class="d-flex align-items-start justify-content-between mb-4">
    <div>
        <p class="text-uppercase lms-eyebrow">Admin</p>
        <h2 class="lms-heading">Setup check</h2>
        <p class="text-muted mb-0">Verify the essential services powering OCIMS.</p>
    </div>
    <span class="badge badge-category badge-category--slate">System</span>
</div>

<div class="lms-card fade-in">
    <div class="lms-card__header">
        <h5 class="mb-0">Environment status</h5>
        <span class="badge badge-category">Diagnostics</span>
    </div>
    <div class="table-responsive">
        <table class="table table-borderless align-middle mb-0">
            <thead>
                <tr>
                    <th>Check</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $statusMap = [
                    'pdo' => ['label' => 'PDO MySQL Extension', 'ok' => 'OK', 'fail' => 'Missing'],
                    'uploads' => ['label' => 'Uploads Writable', 'ok' => 'OK', 'fail' => 'Not Writable'],
                    'mail' => ['label' => 'SMTP Configured', 'ok' => 'Configured', 'fail' => 'Missing'],
                    'sms' => ['label' => 'SMS Provider Configured', 'ok' => 'Configured', 'fail' => 'Missing'],
                    'base_url' => ['label' => 'Base URL Configured', 'ok' => 'Configured', 'fail' => 'Missing'],
                ];
                ?>
                <?php foreach ($statusMap as $key => $meta): ?>
                    <?php $isOk = $checks[$key]; ?>
                    <tr>
                        <td><?= Helpers::e($meta['label']) ?></td>
                        <td>
                            <span class="badge badge-category <?= $isOk ? 'badge-category--mint' : 'badge-category--slate' ?>">
                                <?= Helpers::e($isOk ? $meta['ok'] : $meta['fail']) ?>
                            </span>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php require __DIR__ . '/../layouts/footer.php'; ?>
