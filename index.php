<?php
include 'connect.php';
session_start();
        if(isset($_SESSION['signed_in']) && $_SESSION['signed_in']==true)
        {
            header('location:home.php');
        }
        ?>
<!DOCTYPE html>
<html>
    <head>
        <title>VITask</title>
        <link rel="stylesheet" type="text/css" href="sticky-footer.css"/>
        <link rel="stylesheet" type="text/css" href="bootstrap.css"/>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
    <body>
        <div id="wrap">
       <nav class="navbar navbar-default" role="navigation">
           <div class="container-fluid">
               <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>

                   <a class="navbar-brand" href="#">VITask</a>
               </div>
              <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
               <p class="navbar-text navbar-right"><a href="sign_up.php" class="navbar-link">Sign Up</a></p>
               <p class="navbar-text navbar-right"><a href="sign_in.php" class="navbar-link">Sign In</a></p>
                </div>
           </div>
  
</nav>
            <div class="container">
        <div class="row">
  <div class="col-sm-4 col-md-4">
    <div class="thumbnail">
      <div class="caption">
        <h3 align="center">Thumbnail label</h3>
        <p align="center">About us what we do how<br>how we do <br> blah blah</p>
      </div>
    </div>
  </div>
      <div class="col-sm-4 col-md-4">
    <div class="thumbnail">
      <div class="caption">
        <h3 align="center">Thumbnail label</h3>
        <p align="center">About us what we do how<br>how we do <br> blah blah</p>
      </div>
    </div>
  </div>
      <div class="col-sm-4 col-md-4">
    <div class="thumbnail">
      <div class="caption">
        <h3 align="center">Thumbnail label</h3>
        <p align="center">About us what we do how<br>how we do <br> blah blah</p>
      </div>
    </div>
  </div>
</div>
            </div>
        </div>
        <div id="footer">
     <div class="container">
          <div id="list"> <ul>
              <li>About Us</li>
              <li>Contact Us</li>
              <li>Feedback</li>
          </ul>
          </div>
      </div>
        </div>
        <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
        <script src="bootstrap.min.js"></script>
       </body>
</html>
