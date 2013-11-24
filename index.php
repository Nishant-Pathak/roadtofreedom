<!DOCTYPE html>
<?php
  include 'includes/db_connect.php';
  include 'includes/login_security_functions.php';
	$username = 'Guest';
  sec_session_start();
  if(login_check($mysqli) == true) {
    $user_id = $_SESSION['user_id'];
    $result = mysqli_query($mysqli, "SELECT * FROM members WHERE id= $user_id" );
    if(! $result) {
      die("SQL Error: " . mysqli_error($mysqli));
    }
    while ($row = mysqli_fetch_array($result)) {
      $username = $row['username'];
    }
  }
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <!--link rel="shortcut icon" href="../../assets/ico/favicon.png"-->

    <title>Road To Freedom</title>

    <!-- Bootstrap core CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sticky-footer-navbar.css" rel="stylesheet">
		<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

		</head>

		<body>
    <!-- Wrap all page content here -->
		<div id="wrap">
		<?php
			$path = substr($_SERVER['REQUEST_URI'],1);
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
							if($username != 'Guest') {
						?>
							<li class="dropdown">
        				<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $username; ?><b class="caret"></b></a>
        					<ul class="dropdown-menu">
          					<li><a href="city">City</a></li>
          					<li><a href="temple">Temple</a></li>
          					<li><a href="theatre">Theatre</a></li>
          					<li><a href="arena">Arena</a></li>
          					<li><a href="library">Library</a></li>
										<li class="divider"></li> 
										<li><a href="includes/logout.php">Logout</a></li>
        					</ul>
      				</li>
  					<?php	} else { ?>
							<form class="navbar-form navbar-left" action="includes/login.php" method="post" name="login_form">
        					<input type="text" class="" name="email" style="height:25px;margin-top:6px" placeholder="Email">
        					<input type="password" class="" id="passwordbox" name="password" style="height:25px;margin-top:6px" placeholder="Password">
      						<input type="button" class="btn btn-default" id="signinbtn" onclick="formhash(login_form, login_form.password);" style="height:25px;width:65px;padding:2px 12px;" value="SignIn" />
    					</form>
							<li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $username; ?><b class="caret"></b></a>
                  <ul class="dropdown-menu">
                    <li><a href="#registration_modal" data-toggle="modal">SignUp</a></li>
                  </ul>
              </li>
						<?php } ?>
            </ul>
          </div><!--/.nav-collapse -->
      </div>
			<script> 
      	$("#passwordbox").keyup(function(event){
        	if(event.keyCode == 13){
          	$("#signinbtn").click();
          }
        });
       </script>
      <!-- Begin page content -->
			<?php if(isset($_GET["logout"]) && $_GET["logout"] === "true") { ?>
      <div class="alert alert-success alert-fade" style="display: block;">
        <strong>Success!</strong> Logged Out! 
      </div>
    	<?php } ?>
    	<?php if(isset($_GET["error"]) && $_GET["error"] === "true") { ?>
      <div class="alert alert-danger alert-fade" style="display: block;">
        <strong>Error!</strong> Invalid login. Please try again!
      </div>
    	<?php } ?>
    	<?php if(isset($_GET["success"]) && $_GET["success"] === "true") { ?>
      <div class="alert alert-success alert-fade" id="alert_template" style="display: block;">
        <strong>Success!</strong> Your account has been registered. Please login!
      </div>
    	<?php } ?>
    	<?php if(isset($_GET["login"]) && $_GET["login"] === "false") { ?>
      <div class="alert alert-danger alert-fade" id="alert_template" style="display: block;">
        <strong>Error!</strong> Please login to enter into city!
      </div>
    	<?php } ?>
      <script>
        window.setTimeout(function() {
            $(".alert-fade").fadeTo(500, 0).slideUp(500, function(){
              $(this).remove(); 
            }); 
        }, 3000);
      </script>

			<style>
      	body {
                background: url('images/dashboard.png') no-repeat;
      	}
				
    	</style>
      <div class="container" style="position:relative">
				<!--<div id="maxWidth" style="display:none"></div>
				<div id="maxHeight" style="display:none"></div>-->
					<div class="modal fade" id="registration_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  					<div class="modal-dialog">
    					<div class="modal-content">
      					<div class="modal-header">
        					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        					<h4 class="modal-title" id="myModalLabel">SignUp</h4>
      					</div>
      					<div class="modal-body">
        					<form class="form-horizontal" name="loginHere" id="loginHere" method="post" action="includes/registration.php">
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

				<a id="monster" href="#"></a>
				<a id="entercity" href="city/index.php"></a>
      </div>
    </div>

  	<div id="footer">
      <div class="container">
        <p class="text-muted credit">Road To Freedom &copy; 2013.</p>
      </div>
  	</div>


		<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="javascript/form.js" ></script>
    <script type="text/javascript" src="javascript/sha512.js"></script>
		<link href="css/roadtofreedom.css" rel="stylesheet">
		<script type="text/javascript">
/*
			var rtime = new Date(1, 1, 2000, 12,00,00);
			var timeout = false;
			var delta = 200;
			function resizeMe() {
    		rtime = new Date();
    		if (timeout === false) {
        	timeout = true;
        	setTimeout(resizeend, delta);
    		}
			}

			function resizeend() {
    		if (new Date() - rtime < delta) {
        	setTimeout(resizeend, delta);
    		} else {
        	timeout = false;
			  	var MH =   $('#maxHeight').val();
					var myTop =   $('#maxWidth').val();	
					var newHeight = $(window).height();
					var ratio_top = myTop/MH;
					$("#entercity").css('top', ratio_top*newHeight + "px"); 
			  	console.log("MH:",MH, "top", ratio_top*newHeight, "newHeight", newHeight);	
					$('#maxHeight').val(newHeight);
					$('#maxWidth').val(parseInt($('#entercity').css('top'), 10));
       		alert('Done resizing');
    		}               
			}
			function resize_div() {
				var main = $('#entercity');
				var MH =	 $('#maxHeight').val();
				var MW =	 $('#maxWidth').val();
				var mytop  = parseInt($('#entercity').css('top'), 10);
				if(mytop == 0) mytop =1;
        var newHeight = $(window).height();
				var ratio_top = mytop/MH;
			  console.log("MH:",MH, "top", mytop, "newHeight", newHeight);	
			  $("#entercity").css('top', ratio_top*newHeight + "px");	
			}
			$(document).ready(function() {
				var maxHeight = $(window).height();
				var maxWidth  = $(window).width();
				$('#maxHeight').val(maxHeight);
				var myTop  = parseInt($('#entercity').css('top'), 10);
				$('#maxWidth').val(myTop);
  			resizeMe();
  			$(window).bind('resize', function() { resizeMe();});
			});	
*/
		</script>
		<!--<script type="text/javascript" src="javascript/setHeightOnResize.js">
		</script>-->
	</body>
</html>

