<?php
$current = basename($_SERVER['PHP_SELF']);
$role = isset($_SESSION['role']) ? $_SESSION['role'] : 'employee';
?>
<!DOCTYPE html>
<html>
<head>
    <title>HRMS - <?= ucfirst($role); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
        }
        .nav-link {
            color: rgba(255,255,255,0.8) !important;
            transition: color 0.3s;
        }
        .nav-link:hover,
        .nav-link.active {
            color: white !important;
        }
        .profile-img {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            border: 2px solid white;
            cursor: pointer;
        }
        .company-logo {
            height: 40px;
            width: auto;
            max-width: 100px;
            object-fit: contain;
            border-radius: 4px;
        }
        .card {
            border: none;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark px-4">
    <a class="navbar-brand text-white d-flex align-items-center" href="../index.php">
        <?php if (isset($_SESSION['company_logo']) && !empty($_SESSION['company_logo']) && file_exists($_SESSION['company_logo'])): ?>
            <img src="<?= htmlspecialchars($_SESSION['company_logo']); ?>" alt="Company Logo" class="company-logo me-2">
        <?php else: ?>
            <i class="bi bi-people"></i>
        <?php endif; ?>
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-4">
            <li class="nav-item">
                <a class="nav-link <?= $current=='dashboard.php'?'active':'' ?>" href="dashboard.php">Dashboard</a>
            </li>
            
            <?php if ($role === 'admin'): ?>
                <li class="nav-item">
                    <a class="nav-link <?= $current=='employees.php'?'active':'' ?>" href="employees.php">Employees</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $current=='attendance.php'?'active':'' ?>" href="attendance.php">Attendance</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $current=='leaves.php'?'active':'' ?>" href="leaves.php">Leaves</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $current=='payroll.php'?'active':'' ?>" href="payroll.php">Payroll</a>
                </li>
            <?php elseif ($role === 'hr'): ?>
                <li class="nav-item">
                    <a class="nav-link <?= $current=='employees.php'?'active':'' ?>" href="employees.php">Employees</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $current=='attendance.php'?'active':'' ?>" href="attendance.php">Attendance</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $current=='leaves.php'?'active':'' ?>" href="leaves.php">Leaves</a>
                </li>
            <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link <?= $current=='attendance.php'?'active':'' ?>" href="attendance.php">Attendance</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $current=='leaves.php'?'active':'' ?>" href="leaves.php">My Leaves</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $current=='salary.php'?'active':'' ?>" href="salary.php">Salary</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $current=='profile.php'?'active':'' ?>" href="profile.php">Profile</a>
                </li>
            <?php endif; ?>
        </ul>

        <div class="ms-auto dropdown">
            <button class="btn btn-link dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="text-decoration: none; display: flex; align-items: center; border: none; background: none;">
                <div class="me-2 text-white text-end">
                    <small><?= $_SESSION['first_name'] ?? 'User'; ?></small><br>
                    <small style="font-size: 0.75rem;"><?= ucfirst($role); ?></small>
                </div>
                <div class="profile-img" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; color: white; font-weight: bold;">
                    <?= substr($_SESSION['first_name'] ?? 'U', 0, 1); ?>
                </div>
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="../employee/profile.php?action=view"><i class="bi bi-person-circle"></i> My Account</a></li>
                <li><a class="dropdown-item" href="../employee/profile.php?action=edit"><i class="bi bi-pencil"></i> Edit Profile</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item text-danger" href="../auth/logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

<main class="container-fluid py-4">
