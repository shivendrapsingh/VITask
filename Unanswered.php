<?php
include 'connect.php';
session_start();
$replyErr="";
$reply="";
$t_id="";
if($_SERVER["REQUEST_METHOD"]=="POST")
{
    if(empty($_POST['reply']))
        $replyErr="answer is required";
    else
    {
       // $reply=$_POST['reply'];
        $reply=  mysql_real_escape_string($_POST['reply']);
        $t_id=$_POST['topic_id'];
        $u_id=$_SESSION['user_id'];
        $date_time=date('y/m/d h:i:s');
        $ins=mysql_query("insert into reply (reply_content,date_time_r,reply_by,reply_topic) values ('$reply','$date_time','$u_id','$t_id')");
        if(!$ins)
            echo "went wrong";
        else {
            header('location:Unanswered.php');
        }
    }
}
?>
<!DOCTYPE html>
<html>
 <head>
    <title>Unanswered</title>
    <link href="sticky-footer.css" rel="stylesheet">
        <link href="bootstrap.css" rel="stylesheet">
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
          include 'header_signout.php';
        }
        ?> <div class="container">
            <div class="row" style="margin-top:10px">
        <div class="col-sm-8 col-md-8">
                 <?php
                
                if(isset($_SESSION['signed_in']) && $_SESSION['signed_in']==true)
                echo '<a  class="btn btn-success" href="thread.php" style="font-size:20px; width:200px;">Ask Question</a>';
                
                ?>
            <?php
            include 'connect.php';
            $check=mysql_query("select topic_id from topic where topic_id not in(select reply_topic from reply)");
            if($check)
            {
                while($row=mysql_fetch_array($check))
                {
                    $topic=$row['topic_id'];
                     $ch=mysql_query("select topic_name from topic where topic_id='$topic'");
            $post=mysql_query("select topic.topic_name,topic.topic_id,topic.topic_by,topic.category,topic.date_time,users.user_id,users.fname from topic left join users on topic.topic_by=users.user_id where topic_id='$topic'");
            if(mysql_num_rows($ch)!=0)
            {
                while($row= mysql_fetch_array($post))
                {
                     echo '<div class="panel panel-default">
                        <div class="panel-body">
                        <span style="font-size:23px;color:#009999">'.$row["fname"].'</span>';
                    if(isset($_SESSION['signed_in']) && $_SESSION['signed_in']==true)
                    {
                        $uid=$_SESSION['user_id'];
                $topicbyy=$row['topic_by'];
                    
                if($topicbyy==$uid)
                {
                    echo "<a href='delete.php?id=$t_id' class='close' area-hidden='true'>&times;</a>";
                   // echo "<a href='delete.php?id=$t_id' style='right:0;top:0;float:right;margin-top:10px;'><img src='close.png' width='15px' height='15px' title='delete'/></a>"; 
                }}
                  echo "<p style='font-size:25px;color:grey;'>".$row['topic_name']."<br>";
                  echo "<span style='font-size:15px'>in <b>".$row['category']."</b></span></p>";
                  echo '</div>';
                  if(isset($_SESSION['signed_in']) && $_SESSION['signed_in']==true)
                  {
                      echo '<div class="panel-footer">';
                      echo "<form method='POST' action=''>
                      <input type='hidden' name='topic_id' value=".$row['topic_id'].">
                      <textarea rows='13' cols='60' name='reply' style='resize:none'></textarea><br>
                      <input type='submit' name='submit' value='Add'>
                      </form>";
                      echo '</div>
                    </div>';
                  }
                  else
                    echo '</div>';
                }  
            }
                }
            }
            else echo "wrong";
            ?>  
            </div>
                <div class="col-sm-4 col-md-4">
            <a  class="btn btn-success" href="Unanswered.php" style="font-size:20px; width:230px;">Unanswered Questions</a>
            <ul class="list-group list-style">
                 <li class="list-group-item"><a href="sortbycategory.php?id=SCSE" id="ques">SCSE</a></li>
                <li class="list-group-item"><a href="sortbycategory.php?id=SITE" id="ques">SITE</a></li>
                <li class="list-group-item"><a href="sortbycategory.php?id=SMBS" id="ques">SMBS</a></li>
                <li class="list-group-item"><a href="sortbycategory.php?id=SBST" id="ques">SBST</a></li>
                <li class="list-group-item"><a href="sortbycategory.php?id=SENSE" id="ques">SENSE</a></li>
                <li class="list-group-item"><a href="sortbycategory.php?id=SELECT" id="ques">SELECT</a></li>
                <li class="list-group-item"><a href="sortbycategory.php?id=SSL" id="ques">SSL</a></li>
                <li class="list-group-item"><a href="sortbycategory.php?id=SAS" id="ques">SAS</a></li>
                <li class="list-group-item"><a href="sortbycategory.php?id=VITBS" id="ques">VITBS</a></li>
                <li class="list-group-item"><a href="sortbycategory.php?id=General" id="ques">General</a></li>
                <li class="list-group-item"><a href="sortbycategory.php?id=Others" id="ques">Others</a></li>
              </ul>
            <!-- <ul class="list-group list-style">
                <li class="list-group-item"><span class="badge">14</span>Academics</li>
                <li class="list-group-item"><span class="badge">14</span>CAT</li>
                <li class="list-group-item"><span class="badge">14</span>Lab</li>
                <li class="list-group-item"><span class="badge">14</span>TEE</li>
                <li class="list-group-item"><span class="badge">14</span>Hostel</li>
                <li class="list-group-item"><span class="badge">14</span>General</li>
                <li class="list-group-item"><span class="badge">14</span>Others</li>
            </ul> -->
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