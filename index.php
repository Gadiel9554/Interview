<?php
session_start();

if(isset($_SESSION['INTERVIEW_2024'])) {
    require 'PHP/settings/config.php';
    require 'PHP/settings/connection.php';
    require 'PHP/settings/functions.php';
    require 'PHP/settings/user.php';
} else {
    header('location: login.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title><?php echo NAME_SYSTEM; ?></title>
    <?php
    require 'config/assets-top.php';
    ?>
</head>

<body class="alt-menu sidebar-noneoverflow">
    <!-- BEGIN LOADER -->
    <div id="load_screen">
        <div class="loader">
            <div class="loader-content">
                <div class="spinner-grow align-self-center"></div>
            </div>
        </div>
    </div>
    <!--  END LOADER -->

    <!--  BEGIN NAVBAR  -->
    <?php require 'config/menu-top.php'; ?>
    <!--  END NAVBAR  -->

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>

        <!--  BEGIN TOPBAR  -->
        <?php require 'config/menu-main.php'; ?>
        <!--  END TOPBAR  -->

        <!--  BEGIN CONTENT PART  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">

                <div class="page-header">
                    <div class="page-title">
                        <h3>Dashboard</h3>
                    </div>
                </div>

                <div class="row layout-top-spacing">



                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                        <div class="widget widget-chart-two">
                            <div class="widget-heading">
                                <h5 class="">Users</h5>
                            </div>
                            <div class="widget-content">
                                <div id="gendUsr" class=""></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                        <div class="widget widget-chart-two">
                            <div class="widget-heading">
                                <h5 class="">Users by business</h5>
                            </div>
                            <div class="widget-content">
                                <div id="bussTotal" class=""></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                        <div class="widget widget-chart-two">
                            <div class="widget-heading">
                                <h5 class="">Total Business</h5>
                            </div>
                            <div class="widget-content">
                                <div id="bussTotalSingle" class=""></div>
                            </div>
                        </div>
                    </div>

                </div>

                <?php require 'config/footer.php'; ?>

            </div>
        </div>
        <!--  END CONTENT PART  -->

    </div>
    <!-- END MAIN CONTAINER -->

    <?php require 'config/assets-bottom.php'; ?>
</body>

</html>