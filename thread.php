<?php
$categoryErr = $tagErr =$titleErr= "";
$new_category=$new_tag=$new_title="";
session_start();

include ('connect.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
    if (empty($_POST["category"])) {
        $categoryErr = "Please select a category";
    } else {
        $new_category = mysql_real_escape_string($_POST['category']);
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(empty($_POST["tag"]))
    {
        $tagErr="Please select a tag";
    }
    else
    {
        $new_tag = mysql_real_escape_string($_POST['tag']);
    }
}

if ($_SERVER["REQUEST_METHOD"]=="POST")
{
    if(empty($_POST["title"]))
    {
        $titleErr="Please enter the question";
    }
    else
    {
        $new_title = mysql_real_escape_string($_POST['title']);
    }
        
}
    
$new_datetime = date('y/m/d h:i:s');
$new_topic_by = $_SESSION['user_id'];
if(!$categoryErr && !$tagErr && !$titleErr)
{
if ($_SERVER['REQUEST_METHOD'] == 'POST')      //inserting into table,the question which is asked
    {

    $ask = mysql_query("insert into topic (topic_name,date_time,category,tag,topic_by) values ('$new_title','$new_datetime','$new_category','$new_tag','$new_topic_by')");
    if (!$ask)
        echo "i will not allow you";
    else {
        header('location:home.php');
    }
}
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Thread</title>
       <link href="sticky-footer.css" rel="stylesheet">
        <link href="bootstrap.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="signup.css"/>
    </head>
    
    
    <body style="background: #F6FAFA;">
        <div id="wrap">
        <?php
        if(isset($_SESSION['signed_in']) && $_SESSION['signed_in']==true)
        {
            include 'header_signin.php';
        }
        else
        {
          header('location:home.php');
        }
        ?>
            <div class="container">
            <div class="row" style="margin-top:10px">
        <div class="col-sm-8 col-md-8">
            <div class="container">
       <form class="form-signin" role="form" action="" method="POST">
                    <select name="category" class="form-control" id="school">
                    <option value>Select School</option>
                    <option value="SCSE">SCSE</option>
                    <option value="SITE">SITE</option>
                    <option value="SMBS">SMBS</option>
                    <option value="SBST">SBST</option>
                    <option value="SENSE">SENSE</option>
                    <option value="SELECT">SELECT</option>
                    <option value="SSL">SSL</option>
                    <option value="SAS">SAS</option>
                    <option value="VITBS">VITBS</option>
                    <option value="General">General</option>
                    <option value="Other">other</option>
                    </select>
                        <script type="text/javascript">
                    document.getElementById('school').value="<?php if(isset($new_category)&& !$categoryErr) echo $new_category;?>";
                    </script>
                    <?php
                            if($categoryErr)
                            {
                                echo "<span class='help-block' style='color:red'>".$categoryErr."</span>";
                                //echo $categoryErr;
                            }
                            ?>
                    <select name="tag" class="form-control" id="tag">
                    <option value>Select Tag</option>
                    <option value="academics">Academics</option>
                    <option value="cat">CAT</option>
                    <option value="lab">Lab</option>
                    <option value="term_end">Term End Exams</option>
                    <option value="hostel">Hostel</option>
                    <option value="general">General</option>
                    <option value="other">Other</option>
                    </select>
                        <script type="text/javascript">
                    document.getElementById('tag').value="<?php if(isset($new_tag)&& !$tagErr) echo $new_tag;?>";
                    </script>
                    <?php
                            if($tagErr)
                            {
                               echo "<span class='help-block' style='color:red'>".$tagErr."</span>";
                                //echo $tagErr;
                            }
                            ?>
                <label for="title">Question </label><br>
                <input type="text" name="title" class="form-control" value="<?php if(isset($new_title) && !$titleErr) echo $new_title;?>" id="title" style="width: 160%" maxlength="255" placeholder="Your Question" required><br>
                <?php
                            if($titleErr)
                            {
                                echo "<span class='help-block' style='color:red'>".$titleErr."</span>";
                                //echo $titleErr;
                            }
                            ?>
                <button class="btn btn-lg btn-primary btn-block" type="submit" style="background: #009999;">Ask</button>
         <!--       <input type="submit" name="submit" value="Ask" style="width:80px;height:30px;font-size:15px;padding-bottom: 3px;padding-top:3px;padding-left:5px;border-radius: 3px;border:1px solid #ccc;"> -->
            </form>
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