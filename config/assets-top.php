<?php

echo ' <!-- Loader -->
<link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
<link href="assets/css/loader.css" rel="stylesheet" type="text/css" />
<script src="assets/js/loader.js"></script>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="assets/css/plugins.css" rel="stylesheet" type="text/css" />
<link href="plugins/sweetalerts/sweetalert2.min.css" rel="stylesheet" type="text/css" />
<link href="plugins/sweetalerts/sweetalert.css" rel="stylesheet" type="text/css" />
<link href="assets/css/components/custom-sweetalert.css" rel="stylesheet" type="text/css" />
<link href="assets/css/components/custom-modal.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="assets/css/elements/alert.css">
<!-- END GLOBAL MANDATORY STYLES -->';

switch (CURRENT_PAGE) {
    case 'index.php':
        echo '<link rel="stylesheet" type="text/css" href="assets/css/widgets/modules-widgets.css"> 
        <link href="plugins/apex/apexcharts.css" rel="stylesheet" type="text/css">
        <link href="assets/css/dash.css" rel="stylesheet" type="text/css" />';
        break;
    case 'login.php':
    case 'register.php':
        echo '<link href="assets/css/pages/login.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="assets/css/forms/theme-checkbox-radio.css">
        <link rel="stylesheet" type="text/css" href="assets/css/forms/switches.css">';
        break;
    case 'business.php':
    case 'users.php':
        echo '<link href="plugins/animate/animate.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="plugins/table/datatable/datatables.css">
        <link rel="stylesheet" type="text/css" href="plugins/table/datatable/custom_dt_html5.css">
        <link rel="stylesheet" type="text/css" href="plugins/table/datatable/dt-global_style.css">';
        break;
}

?>