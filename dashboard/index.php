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
                    <button type="button" class="close" style="color:black;" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">SignUp</h4>
                </div>
                <form role="form" class="form-horizontal" name="loginHere" id="loginHere" method="post" action="../includes/registration.php">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="username" class="col-sm-2 control-label">Name:</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" id="username" name="username" required/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-sm-2 control-label">Email:</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="email" id="email" name="email" required/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-sm-2 control-label">Password:</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="password" id="password" name="password" required/>
                            </div>
                        </div>
                    </div>
    	            <div class="modal-footer">
                        <button type="button" class="btn btn-default " data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>

<?php
include_once("../includes/footer.php");
?>


