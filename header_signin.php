<?php
include 'connect.php';
echo '<nav class="navbar navbar-default" role="navigation">
           <div class="container-fluid">
               <div class="navbar-header">
                  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>

                   <a class="navbar-brand" href="index.php">VITask</a>
               </div>
               <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                   <form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search" style="width:300px;">
        </div>
        <button type="submit" class="btn btn-default">Search</button>
      </form>
                   <ul class="nav navbar-nav navbar-right">
        <li><a class="btn btn-success btn-sm" href="#">'.$_SESSION["user_name"].'</a></li>
        <li><a class="btn btn-success btn-sm" href="home.php">Home</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="#">Profile</a></li>
            <li><a href="sign_out.php">Sign Out</a></li>
            <li class="divider"></li>
            <li><a href="#">Help</a></li>
          </ul>
        </li>
        </ul>
              </div>
           </div>
  
</nav>';
?>
