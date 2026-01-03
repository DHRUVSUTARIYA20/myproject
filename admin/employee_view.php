<?php
include("../config/db.php");
include("../auth/auth_check.php");

if (!isset($_GET['id'])) {
    $_SESSION['error'] = "Employee ID not provided!";
    header("Location: employees.php");
    exit;
}

$id = mysqli_real_escape_string($conn, $_GET['id']);
$data = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM users WHERE id='$id' AND company_name='{$_SESSION['company_name']}'"));

if (!$data) {
    $_SESSION['error'] = "Employee not found!";
    header("Location: employees.php");
    exit;
}

include("../includes/header.php");
?>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-8">
            <div class="card p-4">
                <h4>Employee Profile</h4>
                
                <form method="post" action="employee_update.php">
                    <input type="hidden" name="id" value="<?= $id ?>">

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">First Name</label>
                            <input name="first_name" value="<?= htmlspecialchars($data['first_name']) ?>" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Last Name</label>
                            <input name="last_name" value="<?= htmlspecialchars($data['last_name']) ?>" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input value="<?= htmlspecialchars($data['email']) ?>" class="form-control" disabled>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Role</label>
                            <select name="role" class="form-control">
                                <option value="employee" <?= $data['role']=='employee'?'selected':'' ?>>Employee</option>
                                <option value="hr" <?= $data['role']=='hr'?'selected':'' ?>>HR Officer</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-control">
                                <option value="active" <?= $data['status']=='active'?'selected':'' ?>>Active</option>
                                <option value="inactive" <?= $data['status']=='inactive'?'selected':'' ?>>Inactive</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Company</label>
                            <input value="<?= htmlspecialchars($data['company_name']) ?>" class="form-control" disabled>
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Update Profile</button>
                            <a href="employees.php" class="btn btn-secondary">Back</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-4">
                <h5>Account Information</h5>
                <table class="table table-sm">
                    <tr>
                        <td><strong>Created:</strong></td>
                        <td><?= date('d M Y', strtotime($data['created_at'])) ?></td>
                    </tr>
                    <tr>
                        <td><strong>Status:</strong></td>
                        <td><span class="badge bg-<?= $data['status']=='active'?'success':'danger' ?>"><?= ucfirst($data['status']) ?></span></td>
                    </tr>
                    <tr>
                        <td><strong>Role:</strong></td>
                        <td><span class="badge bg-info"><?= ucfirst($data['role']) ?></span></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include("../includes/footer.php"); ?>
