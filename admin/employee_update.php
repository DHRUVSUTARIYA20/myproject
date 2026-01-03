<?php
include("../config/db.php");
include("../auth/auth_check.php");

$id = $_POST['id'];
$fname = $_POST['first_name'];
$lname = $_POST['last_name'];
$role = $_POST['role'];

mysqli_query($conn,"
UPDATE users SET 
first_name='$fname',
last_name='$lname',
role='$role'
WHERE id=$id
");

header("Location: employees.php");
