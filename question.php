<?php
include ('connect.php');
session_start();
$answer="";
$answerErr="";
if($_SERVER["REQUEST_METHOD"]=="POST")
{
    if(empty($_POST["reply"]))
    {
        $answerErr="Answer Required";
    }
 else
 {
     $answer=mysql_real_escape_string($_POST["reply"]);
     $topic_check=$_GET["id"];
     //select the question
     $result=mysql_query("select topic_id from topic where topic_name='$topic_check'");
     while($row=mysql_fetch_array($result))
     {
         $t_id=$row['topic_id'];
     }
$u_id=$_SESSION['user_id'];
$date_time=date('y/m/d h:i:s');
//insert the answerd part in table
$ins=mysql_query("insert into reply (reply_content,date_time_r,reply_by,reply_topic) values ('$answer','$date_time','$u_id','$t_id')");
if(!$ins)
    echo "wrong";
else{ 
    //heading back to the question portion to prevent the resubmition on refreshing the browser
header("Location: question.php?id=$topic_check");
 }}
}
?>


<!DOCTYPE html>
<html>
    <head>
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
        ?>
        
        
      <div class="container">
            <div class="row" style="margin-top:10px">
        <div class="col-sm-8 col-md-8">
              <?php
                
                if(isset($_SESSION['signed_in']) && $_SESSION['signed_in']==true)
                echo '<a  class="btn btn-success" href="thread.php" style="font-size:20px; width:200px;">Ask Question</a>';
                
                ?>
            <?php
            include 'connect.php';
            $name=$_GET['id'];
            //extracting the topic from the url
            $check=mysql_query("select topic_name from topic where topic_name='$name'");
            $post=mysql_query("select topic.topic_name,topic.topic_id,topic.topic_by,topic.category,topic.date_time,users.user_id,users.fname from topic left join users on topic.topic_by=users.user_id where topic_name='$name'");
            
            if(mysql_num_rows($check)!=0)
            {
                while($row=  mysql_fetch_array($post))
                {
                    echo '<div class="panel panel-default">
                        <div class="panel-body">
                        <span style="font-size:23px;color:#009999">'.$row["fname"].'</span>';
                    if(isset($_SESSION['signed_in']) && $_SESSION['signed_in']==true)
                    {
                        $uid=$_SESSION['user_id'];
                $topicbyy=$row['topic_by'];
                    $t_id=$row['topic_id'];
                if($topicbyy==$uid)
                {
                    echo "<a href='delete.php?id=$t_id' class='close' area-hidden='true'>&times;</a>";
                    //echo "<a href='delete.php?id=$t_id' style='right:0;top:0;float:right;margin-top:10px;'><img src='close.png' width='15px' height='15px' title='delete'/></a>"; 
                }}
                  echo "<p style='font-size:25px;color:grey;'>".$name."<br>";
                  echo "<span style='font-size:15px'>in <b>".$row['category']."</b></span></p>";
                  echo '</div>';
                   if(isset($_SESSION['signed_in']) && $_SESSION['signed_in']==true)
                   {
                       echo '<div class="panel-footer">';
                       echo "<form method='POST' action=''>
                      <textarea rows='13' cols='60' name='reply' style='resize:none'></textarea><br>
                      <input type='submit' name='submit' value='Add'>
                      </form>";
                   }
                   else{
                       echo '<div class="panel-footer">';
                   }
                }  
            }
            else
            {
                echo "dont be too smart!!! dont fuck up within URL!!!<br> Now go home and start again";
            }
            $id_exc=mysql_query("select topic_id from topic where topic_name='$name'");
            while($row=mysql_fetch_array($id_exc))
            {
                $id=$row['topic_id'];
            }
            $extract=mysql_query("select reply.reply_content,reply.reply_id,reply.reply_by,users.user_id,users.fname from reply left join users on reply.reply_by=users.user_id where reply.reply_topic='$id' order by reply.date_time_r desc");
            if(mysql_num_rows($extract)!=0)
            {
            echo "<h3>Answers</h3><hr>";
            while($row=  mysql_fetch_array($extract))
            {
               echo '<p><span style="font-size:15px;color:#009999"><b>'.$row["fname"].'</b></span></p>';
                if(isset($_SESSION['signed_in']) && $_SESSION['signed_in']==true)
                 {$uid=$_SESSION['user_id'];
                $replybyy=$row['reply_by'];
                $r_id=$row['reply_id'];
                if($replybyy==$uid)
                {
                    echo "<a href='delete_ans.php?id=$r_id' class='close' area-hidden='true'>&times;</a>";
                    //echo "<a href='delete_ans.php?id=$r_id' style='right:0;top:0;float:right;margin-top:10px;'><img src='close.png' width='15px' height='15px' title='delete'/></a>"; 
                }
                }
                echo "<p style='color:black;font-size:20px'>".$row['reply_content']."<br>";
                echo '<hr>';
                //echo "<span style='font-size:15px'>by <b>".$row['fname']."</b></p>";
            }
            echo '</div>
                    </div>';
            }
            else
                echo '</div>';
            ?>  
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