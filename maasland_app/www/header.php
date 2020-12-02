<!--
=========================================================

 Coded by Sloots.nu

=========================================================

-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Maasland</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <!-- CSS Files -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/light-bootstrap-dashboard.css?v=2.0.0 " rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="assets/css/demo.css" rel="stylesheet" />

<script type="text/javascript" src="chili/jquery-3.5.1.js"></script>

</head>

<body>
    <div class="wrapper">
        <div class="sidebar" data-image="assets/img/sidebar-5.jpg" data-color="green">
            <div class="sidebar-wrapper">
                <div class="logo">
                    <a href="index.php" class="simple-text">
                        Maasland
                    </a>
                </div>
                <ul class="nav">
                    <li <?php echo ($id == 0) ? 'class="nav-item active"' : '' ?>>
                        <a class="nav-link active" href="index.php">
                            <i class="nc-icon nc-chart-pie-35"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li <?php echo ($id == 1) ? 'class="nav-item active"' : '' ?>>
                        <a class="nav-link" href="./users.php">
                            <i class="nc-icon nc-single-02"></i>
                            <p>Users</p>
                        </a>
                    </li>
                    <li <?php echo ($id == 2) ? 'class="nav-item active"' : '' ?>>
                        <a class="nav-link" href="./groups.php">
                            <i class="nc-icon nc-circle-09"></i>
                            <p>Groups</p>
                        </a>
                    </li>
                    <li <?php echo ($id == 3) ? 'class="nav-item active"' : '' ?>>
                        <a class="nav-link" href="./doors.php">
                            <i class="nc-icon nc-bank"></i>
                            <p>Doors</p>
                        </a>
                    </li>
                    <li <?php echo ($id == 4) ? 'class="nav-item active"' : '' ?>>
                        <a class="nav-link" href="./timezone.php">
                            <i class="nc-icon nc-watch-time"></i>
                            <p>Timezones</p>
                        </a>
                    </li>
                    <li <?php echo ($id == 5) ? 'class="nav-item active"' : '' ?>>
                        <a class="nav-link" href="./reports.php">
                            <i class="nc-icon nc-ruler-pencil"></i>
                            <p>Reports</p>
                        </a>
                    </li>
                    <li <?php echo ($id == 6) ? 'class="nav-item active"' : '' ?>>
                        <a class="nav-link" href="./events.php">
                            <i class="nc-icon nc-notes"></i>
                            <p>Events</p>
                        </a>
                    </li>
<!--                     <li class="nav-item active active-pro">
                        <a class="nav-link active" href="upgrade.html">
                            <i class="nc-icon nc-alien-33"></i>
                            <p>Upgrade to PRO</p>
                        </a>
                    </li> -->
                </ul>
            </div>
        </div>
        <div class="main-panel">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg " color-on-scroll="500">
                <div class="container-fluid">



                    <a class="navbar-brand" href="#wim"><?php echo $title ?></a>
                    <button href="" class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-bar burger-lines"></span>
                        <span class="navbar-toggler-bar burger-lines"></span>
                        <span class="navbar-toggler-bar burger-lines"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navigation">
                        <ul class="nav navbar-nav ml-auto">

                            <li class="dropdown nav-item">
                                <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                                    <i class="nc-icon nc-planet"></i>
                                    <span class="notification">5</span>
                                    <span class="d-lg-none">Notification</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <a class="dropdown-item" href="#">12:34 Main door opened by John</a>
                                    <a class="dropdown-item" href="#">06:23 Fire alarm</a>
                                    <a class="dropdown-item" href="#">06:14 Main door opened by Daenerys </a>
                                    <a class="dropdown-item" href="#">02:34 Back door opened by Arya</a>
                                </ul>
                            </li>  
                            <li class="nav-item">
                                <a class="nav-link" href="#pablo">
                                    <span class="no-icon">Log out</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- End Navbar -->
