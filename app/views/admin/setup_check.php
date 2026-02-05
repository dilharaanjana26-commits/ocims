<?php require __DIR__ . '/../layouts/header.php'; ?>
<h2>Setup Check</h2>
<table class="table table-bordered">
    <thead><tr><th>Check</th><th>Status</th></tr></thead>
    <tbody>
        <tr><td>PDO MySQL Extension</td><td><?= $checks['pdo'] ? 'OK' : 'Missing' ?></td></tr>
        <tr><td>Uploads Writable</td><td><?= $checks['uploads'] ? 'OK' : 'Not Writable' ?></td></tr>
        <tr><td>SMTP Configured</td><td><?= $checks['mail'] ? 'Configured' : 'Missing' ?></td></tr>
        <tr><td>SMS Provider Configured</td><td><?= $checks['sms'] ? 'Configured' : 'Missing' ?></td></tr>
        <tr><td>Base URL Configured</td><td><?= $checks['base_url'] ? 'Configured' : 'Missing' ?></td></tr>
    </tbody>
</table>
<?php require __DIR__ . '/../layouts/footer.php'; ?>
