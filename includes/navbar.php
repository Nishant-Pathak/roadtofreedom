<?php
include 'db_connect.php';
include 'helper_functions.php';

sec_session_start();
$username = "notLogin";

if (login_check($mysqli) == true) {
    $user_id = $_SESSION['user_id'];
    $username = getUsername($user_id, $mysqli);
}
$path = substr($_SERVER['REQUEST_URI'], 1);
?>
<!-- Fixed navbar -->
<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="../dashboard">Road To Freedom</a>
    </div>               
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav navbar-right">
            <?php
            if ($username != 'notLogin') {
                ?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $username; ?><b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="../city">City</a></li>
                        <li><a href="../temple">Temple</a></li>
                        <li><a href="../theatre">Theatre</a></li>
                        <li><a href="../arena">Arena</a></li>
                        <li><a href="../library">Library</a></li>
                        <li class="divider"></li> 
                        <li><form class="navbar-form" id="logout_form" action="../includes/helper_functions.php" method="post">
                            <input type="hidden" name="check_logout" value="true"/>
                            <a onclick="submit_logout_form(logout_form);">Logout</a>
                        </form>
                        </li>
                    </ul>
                </li>
            <?php } else { ?>     
                <li class="divider-vertical"></li>
                <li class="dropdown btn-group pull-right">
                    <a class="dropdown-toggle" href="#" data-toggle="dropdown">Sign In <strong class="caret"></strong></a>
                    <div class="dropdown-menu dropdown-menu-arrow" style="margin-top: 2px; padding: 15px; padding-bottom: 0px;min-width: 250px;">
                        <p class="pull-left" style="margin-bottom: 5px;"><b>Login as </b><a onclick="guestLogin(login_form)">Guest !</a></p>
                            <form role="form" action="../includes/login.php" method="post" accept-charset="UTF-8" name="login_form">
                                <div class="form-group" >
                                    <input type="email" class="form-control" id="email" placeholder="Email" style="height:30px;" required>
                                </div>
                                <div class="form-group" >
                                    <input type="password" class="form-control" id="password" placeholder="Password" style="height:30px;" required>
                                </div>
                                <button type="submit" class="btn btn-primary" >Submit</button>
                            </form>
                        <p class="pull-right" style="margin-bottom: 15px;"><b>(New User? </b><a href="#registration_modal" data-toggle="modal">SignUp</a><b>)</b></p>                                                                              
                    </div>
                </li>
            <?php } ?>
        </ul>
    </div><!--/.nav-collapse -->
</div><!-- nav bar -->