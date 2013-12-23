<?php
include_once("../includes/header.php");
include_once("../includes/navbar.php");
?>
<!-- Begin page content -->
<?php

if(isset($_SESSION['SHOWALERT']) && $_SESSION['SHOWALERT'] != ""){
    $alertBanner = getAlertBanner($_SESSION['SHOWALERT']);
    echo $alertBanner;
    $_SESSION['SHOWALERT'] = "";

} else if (isset($_GET["logout"]) && $_GET["logout"] === "true") {
    $alertBanner = getAlertBanner('VALID_LOGOUT');
    echo $alertBanner;
}
?>

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


<img id="transparentImage" src="../images/transparentImage.png" usemap="#transparentImageMap" style="position:relative;"/>
<map name="transparentImageMap">
    <?php if($username === "notLogin") { ?>
    <!--added onfocus as a hack to remove the outline which comes on area on clicking.(http://stackoverflow.com/questions/4351827/how-do-i-get-rid-of-this-border-outline-for-my-image-map-areas-when-clicked-os)-->
        <area onfocus="blur();" shape="poly" Coords="1119, 71, 1116, 178, 1059, 306, 926, 368, 737, 498, 719, 682, 1513, 691, 1512, 406, 1384, 414, 1327, 359, 1264, 333, 1238, 272, 1215, 316, 1150, 241, 1122, 171, 1120, 71" href="#signIn_modal" data-toggle="modal"/>
    <?php } else { ?>
        <area onfocus="blur();" shape="poly" Coords="1119, 71, 1116, 178, 1059, 306, 926, 368, 737, 498, 719, 682, 1513, 691, 1512, 406, 1384, 414, 1327, 359, 1264, 333, 1238, 272, 1215, 316, 1150, 241, 1122, 171, 1120, 71" href="../city"/>
    <?php } ?>    
</map>

<div id="sidePanelLabel" >
    <a onclick="showPanelAndHideLabel();"><img src='../images/slider.png' style="width:100%;height: 100%"></a>
</div>

<div id="sidePanel" class="panel-articles panel-margin" style="height:90%;">
    <div class=" container-panel">  
        <div class="close-div">
            <button type="button" class="close" onclick="hidePanelAndShowLabel();">&times;</button>
        </div>
            <div style="width:100%;height:50%;background-color: white;">
            
        </div>
    </div>
</div>
<div class="container" >
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
    <div class="modal fade" id="signIn_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" style="color:black;" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="signInModalLabel">Sign In</h4>
                </div>
                <form role="form" class="form-horizontal" action="../includes/login.php" method="post" accept-charset="UTF-8" name="login_form" id="login_form">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="email" class="col-sm-2 control-label">Email:</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" id="email" name="email" required/>
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
                        <button type="submit" class="btn btn-primary">Sign In</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>
<script>
   
    var resizeEnd;
    $(window).bind('resize', function(e) {
        clearTimeout(resizeEnd);
        var wh = $(window).width();
        var ht = $(window).height();
        resizeEnd = setTimeout(function() {
          resizeAndPositionDashboard(wh, ht);
          $('img[usemap]').rwdImageMaps();
        }, 100);
    });
    
    $(document).ready(function() {
        var wh = $(window).width();
        var ht = $(window).height();
        resizeAndPositionDashboard(wh, ht);
        $('img[usemap]').rwdImageMaps();
    });
    
    

</script>
<?php
include_once("../includes/footer.php");
?>


