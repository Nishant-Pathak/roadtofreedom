<?php
$path = substr($_SERVER['REQUEST_URI'],1);
?>
      <!-- Fixed navbar -->
      <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
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
            <p class="navbar-text pull-right">
              Logged in as <a href="#" class="navbar-link">Guest</a>
            </p>
            <ul class="nav navbar-nav navbar-right">
              <li <?php if($path == "temple") echo "class='active'"; ?> ><a href="../temple">Temple</a></li>
              <li <?php if($path == "city") echo "class='active'"; ?> ><a href="../city">City</a></li>
              <li <?php if($path == "theatre") echo "class='active'"; ?> ><a href="../theatre">Theatre</a></li>
              <li <?php if($path == "arena") echo "class='active'"; ?> ><a href="../arena">Arena</a></li>
              <li <?php if($path == "library") echo "class='active'"; ?> ><a href="../library">Library</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
