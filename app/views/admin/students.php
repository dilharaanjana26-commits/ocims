<?php require __DIR__ . '/../layouts/header.php'; ?>
<h2>Students</h2>
<form method="post" action="/public/index.php?route=admin/students/create" class="row g-3 mb-4">
    <input type="hidden" name="csrf_token" value="<?= Csrf::token() ?>">
    <div class="col-md-3"><input class="form-control" name="name" placeholder="Name" required></div>
    <div class="col-md-1"><input class="form-control" name="age" placeholder="Age" type="number" required></div>
    <div class="col-md-2"><input class="form-control" name="NIC" placeholder="NIC" required></div>
    <div class="col-md-2"><input class="form-control" name="city" placeholder="City" required></div>
    <div class="col-md-2"><input class="form-control" name="WhatsApp" placeholder="WhatsApp" required></div>
    <div class="col-md-2"><input class="form-control" name="email" placeholder="Email" type="email" required></div>
    <div class="col-md-2"><input class="form-control" name="password" placeholder="Password" required></div>
    <div class="col-md-2"><button class="btn btn-primary w-100">Add Student</button></div>
</form>
<table class="table table-bordered">
    <thead><tr><th>Name</th><th>Email</th><th>City</th><th>WhatsApp</th></tr></thead>
    <tbody>
    <?php foreach ($students as $student): ?>
        <tr>
            <td><?= Helpers::e($student['name']) ?></td>
            <td><?= Helpers::e($student['email']) ?></td>
            <td><?= Helpers::e($student['city']) ?></td>
            <td><?= Helpers::e($student['WhatsApp']) ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php require __DIR__ . '/../layouts/footer.php'; ?>
