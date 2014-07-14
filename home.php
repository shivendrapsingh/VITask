<?php 
session_start(); 
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Home</title>
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
            $res=mysql_query("select topic.topic_name,topic.topic_by,topic.category,topic.topic_id,topic.date_time,users.user_id,users.fname from topic left join users on topic.topic_by=users.user_id order by topic.date_time desc");
            //fetching the questions asked by the users and displaying them in most recent first
            while($row=mysql_fetch_array($res))
            {
                $ques=$row['topic_name'];
                $t_id=$row['topic_id'];
                 $useridd=$row['user_id'];
                 echo '<div class="panel panel-default">
                        <div class="panel-body">
                        <span style="font-size:23px;color:#009999">'.$row["fname"].'</span>';
                 if(isset($_SESSION['signed_in']) && $_SESSION['signed_in']==true)
                 {$uid=$_SESSION['user_id'];
                $topicbyy=$row['topic_by'];
                
                if($topicbyy==$uid)
                {
                    echo "<a href='delete.php?id=$t_id' class='close' area-hidden='true'>&times;</a>";
                   // echo "<a href='delete.php?id=$t_id' style='right:0;top:0;float:right;margin-top:0px;'><img src='close.png' width='15px' height='15px' title='delete'/></a>"; 
                }
                }
                
                echo "<p style='font-size:20px;'><a href='question.php?id=$ques' id='ques'>".$row['topic_name']."</a><br>";
                echo "<span style='font-size:12px'>in <b>".$row['category']."</b></span></p>";
                //fetching the ansers to the question which is most recent
                
               echo '</div>';
                
                $see_ans=  mysql_query("select reply.reply_content,reply.reply_by,reply.reply_id,users.user_id,users.fname from reply left join users on reply.reply_by=users.user_id where reply.reply_topic='$t_id' order by reply.date_time_r desc limit 1");
                if(mysql_num_rows($see_ans))
                {
                    
                    while($row=  mysql_fetch_array($see_ans))
                    {
                     echo '<div class="panel-footer">
                    <p><span style="font-size:15px;color:#009999"><b>'.$row["fname"].'</b></span></p>';
                        if(isset($_SESSION['signed_in']) && $_SESSION['signed_in']==true)
                 {$uid=$_SESSION['user_id'];
                $replybyy=$row['reply_by'];
                $r_id=$row['reply_id'];
                
                if($replybyy==$uid)
                {
                    echo "<a href='delete_ans.php?id=$r_id' class='close' area-hidden='true'>&times;</a>";
                    //echo "<a href='delete_ans.php?id=$r_id' style='right:0;top:0;float:right;margin-top:0px;'><img src='close.png' width='15px' height='15px' title='delete'/></a>"; 
                }
                }
                        echo "<p style='color:black;font-size:15px'>".$row['reply_content']."</p><br>";
                
                
                }
                echo '</div>
                    </div>';
                }
                else
                    echo '</div>';
                
                
                
            }
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