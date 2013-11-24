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
            <a class="navbar-brand" href="../">Road To Freedom</a>
          </div>
          <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav navbar-right">
							<li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $username; ?><b class="caret"></b></a>   
                  <ul class="dropdown-menu">
                    <li><a href="../city">City</a></li>
                    <li><a href="../temple">Temple</a></li>
                    <li><a href="../theatre">Theatre</a></li>
                    <li><a href="../arena">Arena</a></li>
                    <li><a href="../library">Library</a></li>
                    <li class="divider"></li>
                    <li><a href="../includes/logout.php">Logout</a></li>
                  </ul>
              </li> 
            </ul>
          </div><!--/.nav-collapse -->
      </div>
