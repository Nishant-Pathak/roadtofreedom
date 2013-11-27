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
        <a class="navbar-brand" href="#">Road To Freedom</a>
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
                        <form class="navbar-form" id="logout_form" action="../includes/helper_functions.php" method="post">
                            <input type="hidden" name="check_logout" value="true"/>
                            <li><a onclick="submit_logout_form(logout_form);">Logout</a></li>
                        </form>
                    </ul>
                </li>
            <?php } else { ?>     
                <li class="divider-vertical"></li>
                <li class="dropdown btn-group pull-right">
                    <a class="dropdown-toggle" href="#" data-toggle="dropdown">Sign In <strong class="caret"></strong></a>
                    <div class="dropdown-menu dropdown-menu-arrow" style="margin-top: 2px; padding: 15px; padding-bottom: 0px;">
                        <p class="pull-left" style="margin-bottom: 5px;"><b>Login as </b><a onclick="guestLogin(login_form)">Guest !</a></p>
                        <form action="../includes/login.php" method="post" accept-charset="UTF-8" name="login_form">
                            <input id="email" style="margin-bottom: 15px;" type="text" name="email" size="30" placeholder="Email"/>
                            <input id="password" style="margin-bottom: 15px;" type="password" name="password" size="30" placeholder="Password" onkeyup="submitOnEnter(event, 'signinbtn');"/>           
                            <input class="btn btn-primary" id="signinbtn" onclick="formhash(login_form, login_form.password);" style="margin-bottom: 5px; clear: left; width: 100%; height: 32px; font-size: 13px;" type="button" name="signin" value="Sign In" />                                            
                        </form>
                        <p class="pull-right" style="margin-bottom: 15px;"><b>(New User? </b><a href="#registration_modal" data-toggle="modal">SignUp</a><b>)</b></p>                                                                              
                    </div>
                </li>
            <?php } ?>
        </ul>
    </div><!--/.nav-collapse -->
</div><!-- nav bar -->