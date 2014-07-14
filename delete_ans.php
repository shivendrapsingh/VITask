<?php
include 'connect.php';
session_start();
$replyid=$_GET['id'];
$del=  mysql_query("delete from reply where reply_id='$replyid'");
if(!$del)
{
    echo "something went wrong";
}
else
{
    header('location:home.php');
}
?>
