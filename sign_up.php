<?php
include 'connect.php';
session_start();
        if(isset($_SESSION['signed_in']) && $_SESSION['signed_in']==true)
        {
            header('location:home.php');
        }

$nameErr=$lnameErr=$usernameErr=$emailErr=$genderErr=$passwordErr=$passwordcnErr=$schoolErr=$regnErr="";   //define error variables and set to empty values
$new_name=$new_lname=$new_username=$new_email=$new_pass=$new_passcn=$new_gender=$new_school=$new_regn=$new_passarea="";    //define variables for taking input
$query1=$query2=$query3="";

if($_SERVER["REQUEST_METHOD"]=="POST")        
{
    //firstname validation
    if(empty($_POST["name"]))     //check if the name area is empty then display name is required
    {
        $nameErr="Firstname is required";
    }
    else
    {
        $new_name=test_input($_POST["name"]);     //now take input as the name after checking using test_input() function
        if(!preg_match("/^[a-zA-Z ]{1,20}$/",$new_name))      //check name enterred with regular expression     
        {
            $nameErr="Only letter and white spaces allowed,range is 1 to 20";
        }
    }
    //lastname validation
    if(empty($_POST["lname"]))
    {
        $lnameErr="Lastname is required";
    }
    else
    {
        $new_lname=test_input($_POST["lname"]); 
        if(!preg_match("/^[a-zA-Z ]{1,20}$/",$new_lname))      //check name enterred with regular expression     
        {
            $lnameErr="Only letter and white spaces allowed,range is 1 to 20";
        }
        
    }
    //username validation
    if(empty($_POST["user_up"]))
    {
        $usernameErr="Username is required";
    }
    else
    {
        $new_username=test_input($_POST["user_up"]);
        $query1=mysql_query("SELECT user_name FROM users WHERE user_name='$new_username'");
        
        if(!preg_match("/^[a-zA-Z0-9]{6,12}$/",$new_username))
        {
           $usernameErr="6-12 characters and letters and numbers only";
        }
        else if(mysql_num_rows($query1)!=0)
        {
            $usernameErr="Username already exists";
        }
    }
    //registration number validation
    if(empty($_POST["regn"]))
    {
        $regnErr="Registration number is required";
    }
 else 
 {
     $new_regn=test_input($_POST["regn"]);
     $query2=mysql_query("SELECT regno FROM users WHERE regno='$new_regn'");
    if(!preg_match("/^[0-1][0-9][a-zA-Z]{3}[0-9]{4}$/",$new_regn))
    {
       $regnErr="Invalid registration number"; 
    }
    else if(mysql_num_rows($query2)!=0)
    {
        $regnErr="Registration number already exists";
    }
 }
 //password validation
  if(empty($_POST["pass_up"]))
    {
        $passwordErr="Password is required";
    }
 else 
 {
     $new_pass=test_input($_POST["pass_up"]);
     $new_passarea=$new_pass;
    if(!preg_match("/^[a-zA-Z0-9]{6,12}$/",$new_pass))
    {
       $passwordErr="Invalid password,lenght should be between 6 to 12"; 
    }
 }
 if(empty($_POST["pass_cn"]))
    {
        $passwordcnErr="Confirm Password is required";
    }
 else 
 {
     $new_passcn=test_input($_POST["pass_cn"]);
    if(!preg_match("/^[a-zA-Z0-9]{6,12}$/",$new_passcn))
    {
       $passwordcnErr="Invalid password"; 
    }
    if($new_passarea!=$new_passcn)
    {
        $passwordcnErr="Not same password";
    }
 }
 //email validation
 if(empty($_POST["email"]))
    {
       $emailErr="email is required"; 
    }
    else
    {
        $new_email=test_input($_POST["email"]);
        $query3=mysql_query("SELECT email FROM users WHERE email='$new_email'");
        if(!preg_match("/([\a-zA-z0-9\-\.\_]+\@[\a-zA-Z0-9\-\_]+\.[\a-zA-Z0-9\-\_]+)/",$new_email))
        {
            $emailErr="Invalid email";
        }
        else if(mysql_num_rows($query3)!=0)
        {
            $emailErr="This email already exists";
        }
    }
    //gender validation
     if(empty($_POST["gender"]))
    {
        $genderErr="Gender missing";
    }
    else 
    {
    $new_gender = $_POST["gender"]; 
    }
    //school checking
    if(empty($_POST["school"]))
       {
           $schoolErr="School missing";
       }
   else
   {
       $new_school=$_POST["school"];
   }
   //date
   $new_date=date("y/m/d");
   $salt="i_love_you";
   //inserting into database after all varification
   if(!$nameErr && !$lnameErr && !$usernameErr && !$emailErr && !$genderErr && !$passwordErr && !$passwordcnErr && !$schoolErr && !$regnErr)
{
       $new_pass=md5($salt.$new_pass);
       $new_name=  mysql_real_escape_string($new_name);
       $new_lname=  mysql_real_escape_string($new_lname);
       $new_username=  mysql_real_escape_string($new_username);
       $new_regn=  mysql_real_escape_string($new_regn);
       $new_email=  mysql_real_escape_string($new_email);
       $new_gender=  mysql_real_escape_string($new_gender);
       $new_school=  mysql_real_escape_string($new_school);
       
    $ins=mysql_query("insert into users (fname,lname,user_name,regno,password,email,gender,school,date) values ('$new_name','$new_lname','$new_username','$new_regn', '$new_pass','$new_email', '$new_gender','$new_school','$new_date')");
    if(!$ins)
    {echo "I will not allow you,contact the admin";}
    else header('location:sign_in.php');
}
}

//lastname validation
/*if($_SERVER["REQUEST_METHOD"]=="POST")
{
    
}*/


//username validation
/*if($_SERVER["REQUEST_METHOD"]=="POST")
{
    
        
}*/


//registration number validation
/*if($_SERVER["REQUEST_METHOD"]=="POST")
{
    
}*/



//password validation
/*if($_SERVER["REQUEST_METHOD"]=="POST")
{
   
}*/



//email validation
/*if($_SERVER["REQUEST_METHOD"]=="POST")
{
    
}*/

/*if($_SERVER["REQUEST_METHOD"]=="POST")
{
   
 }*/
   
   /*if($_SERVER["REQUEST_METHOD"]=="POST")
   {
       
   }*/






function test_input($data)     //test_input function
{
  $data=trim($data);                    //for trimming the spaces
 // $data=stripslashes($data);            //for trimming backslashes
  //$data=htmlspecialchars($data);         
  return $data;
}



if($_SERVER["REQUEST_METHOD"]=="POST")
{


}
?>




<!DOCTYPE html>
<html>
    <head>
        <title>VITask</title>
        <link rel="stylesheet" type="text/css" href="sticky-footer.css"/>
        <link rel="stylesheet" type="text/css" href="signup.css"/>
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

                   <a class="navbar-brand" href="index.php">VITask</a>
               </div>
               <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <p class="navbar-text navbar-right"><a href="sign_in.php" class="navbar-link">Sign In</a></p> 
              
                </div>
           </div>
  
</nav>
        <div class="container">
            <form class="form-signin" role="form" action="" method="POST">
                    <input type="text" class="form-control" name="name" value="<?php if(isset($new_name) && !$nameErr) echo $new_name;?>" placeholder="First Name" required autofocus>
                 <?php
                        if($nameErr)
                        {
                        echo "<span class='help-block' style='color:red'>".$nameErr."</span>";
                        }
                        ?>
                <input type="text" class="form-control" name="lname" value="<?php if(isset($new_lname) && !$lnameErr) echo $new_lname;?>" placeholder="Last Name" required>
                <?php
                        if($lnameErr)
                        {
                        echo "<span class='help-block' style='color:red'>".$lnameErr."</span>";
                        }
                        ?>
                <input type="text" class="form-control" name="user_up" value="<?php if(isset($new_username) && !$usernameErr) echo $new_username;?>" placeholder="User Name" required>
                 <?php
                        if($usernameErr)
                        {
                        echo "<span class='help-block' style='color:red'>".$usernameErr."</span>";
                        }
                        ?>
                <input type="text" class="form-control" name="regn" value="<?php if(isset($new_regn) && !$regnErr) echo $new_regn;?>" placeholder="Registration Number" required>
                <?php
                        if($regnErr)
                        {
                        echo "<span class='help-block' style='color:red'>".$regnErr."</span>";
                        }
                        ?>
                <input type="password" class="form-control" name="pass_up" value="<?php if(isset($new_pass) && !$passwordErr) echo $new_passarea;?>" placeholder="Password" required>
                <?php
                        if($passwordErr)
                        {
                        echo "<span class='help-block' style='color:red'>".$passwordErr."</span>";
                        }
                        ?>
                <input type="password" class="form-control" name="pass_cn" value="<?php if(isset($new_passcn) && !$passwordcnErr) echo $new_passcn;?>" placeholder="Confirm Password" required>
                <?php
                        if($passwordcnErr)
                        {
                        echo "<span class='help-block' style='color:red'>".$passwordcnErr."</span>";
                        }
                        ?>
                <input type="email" class="form-control" name="email" value="<?php if(isset($new_email) && !$emailErr) echo $new_email;?>" placeholder="Email id" required>
                <?php
                        if($emailErr)
                        {
                        echo "<span class='help-block' style='color:red'>".$emailErr."</span>";
                        }
                        ?>
                <div class="form-inline-radio">
                    <div class="radio radio-container">
                        <label>
                            <input type="radio" name="gender" value="male" <?php if(isset($new_gender) && !$genderErr && $new_gender=='male') echo 'checked="checked"';?>>Male
                        </label>
                        <label style="float:right">
                        <input type="radio" name="gender" value="female" <?php if(isset($new_gender) && !$genderErr && $new_gender=='female') echo 'checked="checked"';?>>Female
                        </label>
                    </div>
                    <?php
                        if($genderErr)
                        {
                        echo "<span class='help-block' style='color:red'>".$genderErr."</span>";
                        }
                        ?>
                </div>
                <select name="school" class="form-control" id="school">
                            <option value>School</option>
                            <option value="SCSE">SCSE</option>
                            <option value="SITE">SITE</option>
                            <option value="SMBS">SMBS</option>
                            <option value="SENSE">SENSE</option>
                            <option value="SELECT">SELECT</option>
                            <option value="VITBS">VITBS</option>
                </select>
                <script type="text/javascript">
                            document.getElementById('school').value = "<?php if(isset($new_school) && !$schoolErr) echo $new_school;?>";
                                    </script>
                        <?php
                        if($schoolErr)
                        {
                            echo "<span class='help-block' style='color:red'>".$schoolErr."</span>";
                        }
                        ?>
                                    <button class="btn btn-lg btn-primary btn-block" type="submit" style="background: #009999;">Sign Up</button>
            </form>
        </div>
        </div>
        
    <!--    <div id="sign_block">                   
            <p><span class="error">*required field</span></p>
            <form method="POST" action="sign_up.php">
                
                <table>
                    <tr>
                        <td><input type="text" name="name" value="<?php if(isset($new_name) && !$nameErr) echo $new_name; ?>" placeholder="FirstName"></td>
                        <?php
                        if($nameErr)
                        {
                        echo "<td><span class='error'>*".$nameErr."</span></td>";
                        }
                        ?>
                    </tr>
                    <tr>
                        <td><input type="text" name="lname" value="<?php if(isset($new_lname) && !$lnameErr) echo $new_lname; ?>" placeholder="Lastname"></td>
                        <?php
                        if($lnameErr)
                        {
                        echo "<td><span class='error'>*".$lnameErr."</span></td>";
                        }
                        ?>
                    </tr>
                    <tr>
                        <td><input type="text" name="user_up" value="<?php if(isset($new_username) && !$usernameErr) echo $new_username; ?>" placeholder="Username"></td>
                        <?php
                        if($usernameErr)
                        {
                            echo "<td><span class='error'>*".$usernameErr."</span></td>";
                        }
                        ?>
                    </tr>
                    <tr>
                        <td><input type="text" name="regn" value="<?php if(isset($new_regn) && !$regnErr) echo $new_regn; ?>" placeholder="registration number"></td>
                        <?php
                        if($regnErr)
                        {
                            echo "<td><span class='error'>*".$regnErr."</span></td>";
                        }
                        ?>
                    </tr>
                    <tr>
                        <td><input type="password" name="pass_up" value="<?php if(isset($new_pass) && !$passwordErr) echo $new_passarea; ?>" placeholder="Password"></td>
                        <?php
                        if($passwordErr)
                        {
                            echo "<td><span class='error'>*".$passwordErr."</span></td>";
                        }
                        ?>
                    </tr>
                    <tr>
                        <td><input type="password" name="pass_cn" value="<?php if(isset($new_passcn) && !$passwordcnErr) echo $new_passcn; ?>" placeholder="Confirm Password"></td>
                        <?php
                        if($passwordcnErr)
                        {
                            echo "<td><span class='error'>*".$passwordcnErr."</span></td>";
                        }
                        ?>
                    </tr>
                    <tr>
                        <td><input type="email" name="email" value="<?php if(isset($new_email) && !$emailErr) echo $new_email; ?>" placeholder="xyz@abc.lmn"></td>
                        <?php
                        if($emailErr)
                        {
                            echo "<td><span class='error'>*".$emailErr."</span></td>";
                        }
                        ?>
                    </tr>
                    <tr>
                        <td>
                            <label for="gender"> Gender:</label>
                            <input type="radio" name="gender" value="male" <?php if(isset($new_gender) && !$genderErr && $new_gender=='male') echo 'checked="checked"';?>>Male
                            <input type="radio" name="gender" value="female" <?php if(isset($new_gender) && !$genderErr && $new_gender=='female') echo 'checked="checked"';?>>Female
                        </td>
                        <?php
                        if($genderErr)
                        {
                            echo "<td><span class='error'>*".$genderErr."</span></td>";
                        }
                        ?>
                    </tr>
                    <tr>
                        <td>
                        <select name="school" size="1" id="school">
                            <option value>School</option>
                            <option value="SCSE">SCSE</option>
                            <option value="SITE">SITE</option>
                            <option value="SMBS">SMBS</option>
                            <option value="SENSE">SENSE</option>
                            <option value="SELECT">SELECT</option>
                            <option value="VITBS">VITBS</option>
                        </td>
                        <script type="text/javascript">
                            document.getElementById('school').value = "<?php if(isset($new_school) && !$schoolErr) echo $new_school;?>";
                                    </script>
                        <?php
                        if($schoolErr)
                        {
                            echo "<td><span class='error'>*".$schoolErr."</span></td>";
                        }
                        ?>
                        </select>
                    </tr>
                    
                    
                </table>
                
                <input type="submit" name="button" value="Signup..." style="background:white; height:30px;margin-left:150px;margin-top: 20px;" align="center">
            </form>
            </div>
        
        
        <div id="footer">
            <ul>
                <li>Contact us</li>
                <li>Suggestion</li>
                <li>Feedback</li>
            </ul>
            
        </div> -->
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
