<?php
session_start();
// Clear any previous session data when accessing register page
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    if (isset($_SESSION['user_id'])) {
        session_destroy();
        session_start();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Register - HRMS</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    min-height: 100vh;
    display: flex;
    align-items: center;
}
.register-card {
    border-radius: 10px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
}
</style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card register-card bg-white">
                <div class="card-body p-5">
                    <h3 class="card-title text-center mb-4 text-dark">Company Registration</h3>
                    
                    <?php if (isset($_SESSION['register_error'])): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?= $_SESSION['register_error']; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                        <?php unset($_SESSION['register_error']); ?>
                    <?php endif; ?>

                    <form method="post" action="register_process.php" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label class="form-label text-dark">Company Name</label>
                            <input name="company_name" class="form-control" placeholder="Your Company" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-dark">Company Logo</label>
                            <input name="company_logo" type="file" class="form-control" accept="image/*" required>
                            <small class="text-muted">Upload PNG, JPG, or GIF (Max 2MB)</small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-dark">Admin Name</label>
                            <input name="first_name" class="form-control" placeholder="Admin First Name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-dark">Email</label>
                            <input name="email" type="email" class="form-control" placeholder="admin@company.com" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-dark">Password</label>
                            <input name="password" type="password" class="form-control" placeholder="Strong password" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 mb-3">Register</button>
                    </form>

                    <hr>
                    <p class="text-center text-dark mb-0">
                        Already have an account? <a href="login.php" class="text-primary">Login here</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
