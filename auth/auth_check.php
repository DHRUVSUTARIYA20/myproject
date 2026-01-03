<?php
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../auth/login.php");
    exit;
}

// Set default values if not in session
if (!isset($_SESSION['company_name'])) {
    $_SESSION['company_name'] = '';
}
if (!isset($_SESSION['first_name'])) {
    $_SESSION['first_name'] = '';
}
if (!isset($_SESSION['logo'])) {
    $_SESSION['logo'] = '';
}
?>
