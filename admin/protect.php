<?php
session_start();
header("content-type:text/html;charset=utf-8");
$lifetime=24*60*60;
$time=time();
 
if ($_SESSION["ad_id"]=="" )
{
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" /><script>
alert('您没有登录或不是管理员，请重新登录！');\n
top.location.href='../index.php';\n
</script>";
 }
?>