<?php
include_once("../includes/header.php");
include_once("../includes/navbar.php");
include_once("../includes/db_connect.php");
include_once ("../includes/helper_functions.php");
?>
<!-- Begin page content -->
<?php if (isset($_GET["logout"]) && $_GET["logout"] === "true") { ?>
    <div class="alert alert-success alert-fade" style="display: block;">
        <strong>Success!</strong> Logged Out! 
    </div>
<?php } ?>
<?php if (isset($_GET["error"]) && $_GET["error"] === "true") { ?>
    <div class="alert alert-danger alert-fade" style="display: block;">
        <strong>Error!</strong> Invalid login. Please try again!
    </div>
<?php } ?>
<?php if (isset($_GET["success"]) && $_GET["success"] === "true") { ?>
    <div class="alert alert-success alert-fade" id="alert_template" style="display: block;">
        <strong>Success!</strong> Your account has been registered. Please login!
    </div>
<?php } ?>
<?php if (isset($_GET["login"]) && $_GET["login"] === "false") { ?>
    <div class="alert alert-danger alert-fade" id="alert_template" style="display: block;">
        <strong>Error!</strong> Please login to enter into city!
    </div>
<?php } ?>
<script>
    window.setTimeout(function() {
        $(".alert-fade").fadeTo(500, 0).slideUp(500, function() {
            $(this).remove();
        });
    }, 3000);
</script>
<style>
    body {
        background: url('../images/dashboard.png') no-repeat ;
    }
</style>
<div class="container">
    <div class="modal fade" id="registration_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">SignUp</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" name="loginHere" id="loginHere" method="post" action="../includes/registration.php">
                        <span class="label label-default" style="width:200px;margin: 0px 50px 0px 0px">Name:</span>
                        <input class="span5" type="text" id="username" name="username" />
                        <br/><br/>
                        <span class="label label-default" style="width:200px;margin: 0px 50px 0px 0px">Email:</span>
                        <input class="span5" type="text" id="email" name="email" />
                        <br/><br/>
                        <span class="label label-default" style="width:200px; margin: 0px 27px 0px 0px;">Password:</span>
                        <input class="span5" type="password" id="password" name="password" />
                        <br/><br/>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input  type="button" class="btn btn-primary" onclick="formhash(loginHere, loginHere.password);" value="Save changes" />
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

</div>
</div>

<?php
include_once("../includes/footer.php");
?>


