<?php require __DIR__ . '/../layouts/header.php'; ?>
<div class="row justify-content-center">
    <div class="col-xl-10">
        <div class="auth-shell">
            <div class="auth-intro">
                <h2>Create your OCIMS account</h2>
                <p class="text-muted">Register as a teacher or student. Every signup is reviewed by the admin team for approval.</p>
                <ul class="list-unstyled auth-steps">
                    <li><i class="bi bi-check-circle-fill"></i> Submit your details</li>
                    <li><i class="bi bi-check-circle-fill"></i> Wait for admin approval</li>
                    <li><i class="bi bi-check-circle-fill"></i> Log in and start learning</li>
                </ul>
            </div>
            <div class="auth-card">
                <ul class="nav nav-pills mb-4" id="signup-tabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="teacher-tab" data-bs-toggle="pill" data-bs-target="#teacher-pane" type="button" role="tab">Teacher signup</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="student-tab" data-bs-toggle="pill" data-bs-target="#student-pane" type="button" role="tab">Student signup</button>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="teacher-pane" role="tabpanel">
                        <form method="post" action="/public/index.php?route=signup/teacher" class="row g-3">
                            <input type="hidden" name="csrf_token" value="<?= Csrf::token() ?>">
                            <div class="col-md-6">
                                <label class="form-label">Full name</label>
                                <input class="form-control" name="name" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email address</label>
                                <input class="form-control" name="email" type="email" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Mobile number</label>
                                <input class="form-control" name="mobile" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Password</label>
                                <input class="form-control" name="password" type="password" required>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary w-100">Submit teacher signup</button>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="student-pane" role="tabpanel">
                        <form method="post" action="/public/index.php?route=signup/student" class="row g-3">
                            <input type="hidden" name="csrf_token" value="<?= Csrf::token() ?>">
                            <div class="col-md-6">
                                <label class="form-label">Full name</label>
                                <input class="form-control" name="name" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Age</label>
                                <input class="form-control" name="age" type="number" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">NIC</label>
                                <input class="form-control" name="NIC" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">City</label>
                                <input class="form-control" name="city" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">WhatsApp number</label>
                                <input class="form-control" name="WhatsApp" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email address</label>
                                <input class="form-control" name="email" type="email" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Password</label>
                                <input class="form-control" name="password" type="password" required>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary w-100">Submit student signup</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="text-center mt-4">
                    <span class="text-muted">Already approved?</span>
                    <a href="/public/index.php?route=login">Login here</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require __DIR__ . '/../layouts/footer.php'; ?>
