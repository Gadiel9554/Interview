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
    <title><?php echo "Users | ".NAME_SYSTEM; ?></title>
    <?php
    require 'config/assets-top.php';
    ?>
</head>
<body class="sidebar-noneoverflow">
    
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

        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">
                
                <div class="row layout-top-spacing" id="cancel-row">
                
                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <div class="alert alert-gradient mb-4" role="alert">
                                <strong>Hey!</strong> If you want to edit the information, just double click on it.
                            </div>
                            <div class="table-responsive mb-4 mt-4">
                                <table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        <?php require 'config/footer.php'; ?>
        <!--  END CONTENT AREA  -->

        <div class="modal fade" id="new_users" tabindex="-1" role="dialog" aria-labelledby="new_usersLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="new_usersLabel">New User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input id="user_name" name="user_name" type="text" class="form-control mb-3" placeholder="Name">
                        <input id="user_mail" name="user_mail" type="email" class="form-control mb-3" placeholder="Email">
                        <select name="user_business" id="user_business" class="custom-select mb-3">
                            <?php
                            $GetBus = mysqli_query($link,"SELECT * FROM inter_business WHERE STATUS='Active'");
                            $BusList = array();
                            if($GetBus && mysqli_num_rows($GetBus) > 0) {
                                while ($Buss = mysqli_fetch_array($GetBus)) {
                                    echo '<option value="'.$Buss[0].'">'.decrypt($Buss['NAME']).'</option>';
                                    $BusList[] = $Buss[0].":".decrypt($Buss['NAME']);
                                }
                            }
                            ?>
                        </select>
                        <input type="hidden" id="busList" value="<?php echo implode('|',$BusList); ?>">
                        <input id="user_salary" name="user_salary" type="text" class="form-control mb-3" placeholder="Salary">
                    </div>
                    <div class="modal-footer">
                        <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Cancel</button>
                        <button type="button" class="btn btn-primary" onclick="saveUser(this);">Save</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- END MAIN CONTAINER -->
    
    <?php require 'config/assets-bottom.php'; ?>
</body>
</html>