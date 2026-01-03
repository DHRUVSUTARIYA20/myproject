<?php
include("../config/db.php");

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: register.php");
    exit;
}

$company = mysqli_real_escape_string($conn, $_POST['company_name']);
$name = mysqli_real_escape_string($conn, $_POST['first_name']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = $_POST['password'];
$pass = password_hash($password, PASSWORD_BCRYPT);

// Check if email already exists
$check = mysqli_query($conn, "SELECT id FROM users WHERE email='$email'");
if (mysqli_num_rows($check) > 0) {
    $_SESSION['register_error'] = "Email already registered";
    header("Location: register.php");
    exit;
}

// Handle logo upload
$logo_path = null;
if (isset($_FILES['company_logo']) && $_FILES['company_logo']['error'] === 0) {
    $file = $_FILES['company_logo'];
    $file_size = $file['size'];
    $file_tmp = $file['tmp_name'];
    $file_ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    
    // Validate file
    $allowed_ext = array('jpg', 'jpeg', 'png', 'gif');
    $max_size = 2 * 1024 * 1024; // 2MB
    
    if (!in_array($file_ext, $allowed_ext)) {
        $_SESSION['register_error'] = "Invalid file type. Only JPG, PNG, GIF allowed";
        header("Location: register.php");
        exit;
    }
    
    if ($file_size > $max_size) {
        $_SESSION['register_error'] = "File too large. Maximum 2MB allowed";
        header("Location: register.php");
        exit;
    }
    
    // Create company-specific logo directory
    $logo_dir = "../assets/images/logos/";
    if (!is_dir($logo_dir)) {
        mkdir($logo_dir, 0755, true);
    }
    
    // Generate unique filename with timestamp
    $logo_filename = time() . "_" . preg_replace('/[^a-zA-Z0-9_-]/', '_', $company) . "." . $file_ext;
    $logo_path = $logo_dir . $logo_filename;
    
    // Move uploaded file
    if (!move_uploaded_file($file_tmp, $logo_path)) {
        $_SESSION['register_error'] = "Failed to upload logo";
        header("Location: register.php");
        exit;
    }
} else {
    $_SESSION['register_error'] = "Company logo is required";
    header("Location: register.php");
    exit;
}

$otp = rand(100000, 999999);
$otp_time = date("Y-m-d H:i:s");

$insert = mysqli_query($conn, "
INSERT INTO users 
(company_name, company_logo, first_name, email, password, role, otp, otp_time, email_verified)
VALUES 
('$company', '$logo_path', '$name', '$email', '$pass', 'admin', '$otp', '$otp_time', 1)
");

if (!$insert) {
    $_SESSION['register_error'] = "Registration failed: " . mysqli_error($conn);
    // Delete uploaded logo if registration fails
    if ($logo_path && file_exists($logo_path)) {
        unlink($logo_path);
    }
    header("Location: register.php");
    exit;
}

$user_id = mysqli_insert_id($conn);

// Send emails (non-blocking - don't let email errors stop registration)
include("../config/email.php");
try {
    @sendOTPEmail($email, $otp, $company);
    @sendCompanyWelcomeEmail($email, $name, $company);
} catch (Exception $e) {
    // Email errors won't block registration
}

// Auto-login after registration
$_SESSION['user_id'] = $user_id;
$_SESSION['role'] = 'admin';
$_SESSION['company_name'] = $company;
$_SESSION['company_logo'] = $logo_path;
$_SESSION['first_name'] = $name;
$_SESSION['email'] = $email;
$_SESSION['register_success'] = "Registration successful! Logging you in...";

// Redirect immediately
header("Location: ../index.php");
exit;
