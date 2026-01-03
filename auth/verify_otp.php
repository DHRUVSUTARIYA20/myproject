<!DOCTYPE html>
<html>
<head>
<title>Verify OTP</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-dark text-white">
<div class="container mt-5" style="max-width:400px">

<h4>Verify OTP</h4>

<form method="post" action="verify_otp_process.php">
    <input name="otp" class="form-control mb-3" placeholder="Enter OTP" required>
    <button class="btn btn-light w-100">Verify</button>
</form>

</div>
</body>
</html>
