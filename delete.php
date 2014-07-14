<?php
include 'connect.php';
session_start();
$topicid=$_GET['id'];
$del=  mysql_query("delete from topic where topic_id='$topicid'");
if(!$del)
{
    echo "something went wrong";
}
else
{
    header('location:home.php');
}
?>