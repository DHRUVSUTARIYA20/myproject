<?php
include("../config/db.php");

$email = $_SESSION['otp_email'];
$otp = $_POST['otp'];

$q = mysqli_query($conn,"
SELECT * FROM users 
WHERE email='$email' AND otp='$otp'
");

if(mysqli_num_rows($q)==1){
    mysqli_query($conn,"
    UPDATE users 
    SET email_verified=1, otp=NULL 
    WHERE email='$email'
    ");

    unset($_SESSION['otp_email']);
    header("Location: login.php");
} else {
    echo "Invalid OTP";
}
