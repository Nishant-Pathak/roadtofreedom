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
    <area onfocus="blur();" shape="poly" Coords="1119, 71, 1116, 178, 1059, 306, 926, 368, 737, 498, 719, 682, 1513, 691, 1512, 406, 1384, 414, 1327, 359, 1264, 333, 1238, 272, 1215, 316, 1150, 241, 1122, 171, 1120, 71" href="#"/>
</map>

<!-- Menu Item Bubbles -->
<div class="navigation" id="nav">
    <div class="item mission">
        <img src="../images/bg_home_orange.png" alt="" width="199" height="199" class="circle"/>
        <a href="#" class="icon"></a>
        <ul>
            <li><a href="#sidePanel">Mission</a></li>
        </ul>
    </div>
    <div class="item home">
        <img src="../images/bg_home.png" alt="" width="199" height="199" class="circle"/>
        <a href="#" class="icon"></a>
        <ul>
            <li><a href="../arena/">Arena</a></li>
            <li><a href="../library/">Library</a></li>
            <li><a href="../temple/">Temple</a></li>
            <li><a href="../theater/">Theater</a></li>
        </ul>
    </div>
    <div class="item contact">
        <img src="../images/bg_home_green.png" alt="" width="199" height="199" class="circle"/>
        <a href="#" class="icon"></a>
        <ul>
            <li><a href="#">Help</a></li>
            <li><a href="#">Contact</a></li>
        </ul>
    </div>
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
          resizeAndPositionTransparentImage(wh, ht);
          $('img[usemap]').rwdImageMaps();
        }, 100);
    });
    
    $(document).ready(function() {
        var wh = $(window).width();
        var ht = $(window).height();
        resizeAndPositionTransparentImage(wh, ht);
        $('img[usemap]').rwdImageMaps();
    });
   
    //javascript for menu bubbles
    $(function() {
        $('#nav > div').hover(
        function () {
            var $this = $(this);
            $this.find('img').stop().animate({
                'width'     :'199px',
                'height'    :'199px',
                'top'       :'-25px',
                'left'      :'-25px',
                'opacity'   :'1.0'
            },500,'easeOutBack',function(){
                $(this).parent().find('ul').fadeIn(700);
            });

            $this.find('a:first,h2').addClass('active');
        },
        function () {
            var $this = $(this);
            $this.find('ul').fadeOut(500);
            $this.find('img').stop().animate({
                'width'     :'52px',
                'height'    :'52px',
                'top'       :'0px',
                'left'      :'0px',
                'opacity'   :'0.1'
            },5000,'easeOutBack');

            $this.find('a:first,h2').removeClass('active');
        }
        );
    });

</script>
<?php
include_once("../includes/footer.php");
?>


