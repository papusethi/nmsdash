<!-- This is the normal viewer header file -->
<?php include "db_con.php"; ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Noise Monitoring System</title>

    <link rel="stylesheet" href="assets/css/bootstrap.css" />
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="assets/css/mystyle.css" />

    <!-- Boxicons CDN Link -->
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />

</head>

<body>
    <div class="mysidebar">
        <div class="logo-details">
            <i class='bx bxl-c-plus-plus'></i>
            <span class="logo_name">NoiseDash</span>
        </div>
        <ul class="mynav-links">
            <li>
                <a href="./index.php" class="active">
                    <i class="bx bx-grid-alt"></i>
                    <span class="links_name">Dashboard</span>
                </a>
            </li>

            <li>
                <a href="./view_block_wise.php">
                    <i class="bx bx-pie-chart-alt-2"></i>
                    <span class="links_name">Block Dashboard</span>
                </a>
            </li>
            <li>
                <a href="./data_streaming.php">
                    <i class='bx bx-line-chart'></i>
                    <span class="links_name">Data Streaming</span>
                </a>
            </li>
            <li>
                <a href="./noisewiki.php">
                    <i class="bx bx-coin-stack"></i>
                    <span class="links_name">Noise Wiki</span>
                </a>
            </li>
            <li>
                <a href="./ourteam.php">
                    <i class="bx bx-user"></i>
                    <span class="links_name">Our Team</span>
                </a>
            </li>
        </ul>

    </div>

    <section class="home-section">
        <nav>
            <div class="mysidebar-button">
                <i class="bx bx-menu sidebarBtn"></i>
            </div>
            <a href="./device_login.php">
                <div class="btn btn-secondary">
                    <span class="admin_name">
                        <i class='bx bxs-lock-alt'></i>
                        <?php if (isset($_SESSION['district_name'])) {
                            echo $_SESSION['district_name'] . '&nbsp' . 'Agent';
                        } else {
                            echo "Login";
                        } ?>
                    </span>
                </div>
            </a>

        </nav>