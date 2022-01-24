<!-- This is the Admin Heeader File -->
<?php include "includes/db_con.php"; ?>
<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Control Panel</title>

    <link rel="stylesheet" href="../assets/css/bootstrap.css" />
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../assets/css/admin_sidebar.css" />
    
    <!-- Bootstrap icons CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">

    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>

    <!-- Boxicons CDN Link -->
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />

</head>

<body>
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark p-3">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="./index.php"><i class="bi bi-menu-button-wide-fill"></i> NMS Control Panel</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mynavbar">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../index.php">Back to Site</a>
                    </li>
                </ul>
                <?php
                if (isset($_SESSION['district_name'])) {
                    $district_name = $_SESSION['district_name'];
                ?>
                    <button class="btn btn-warning"><i class="bi bi-person-fill"></i>&nbsp;<?php echo $district_name; ?> Agent</button>&nbsp;&nbsp;
                    <a class="btn btn-primary" href="../logout_device.php"><i class="bi bi-box-arrow-left"></i>&nbsp;Logout</a>
                <?php
                }
                ?>
            </div>
        </div>
    </nav>