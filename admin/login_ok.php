<?php
session_start();
include_once(dirname(__FILE__) ."/../config.inc.php");

include_once(CFG_LIB_DIR.'mysqldb.inc.php');
$objDb = new mysqldb();

include(CFG_LIB_DIR."generic.lib.php");
$objBase = new clsBase();

include(CFG_LIB_DIR."check.php");
$check = new check_ifno();

$username=$_POST['username'];
$password=$_POST['password'];
$psw=md5($password);
$yancode=$_POST['yancode'];
if ($_SESSION['seccode']=="" || trim($yancode)!=$_SESSION['seccode'])
{
	$check->popup("本页面禁止刷新，请返回首页并刷新！");				
}
else
{
	if($username=="" || $password=="")
	{
		 $check->popup("请输入用户名或密码","index.php");
	}
	$sql="select * from admin where ad_username='$username' and ad_password='$psw'";
	$objDb->query($sql);
	$rss=$objDb->get_data();
	if(!$rss)
	{        
		$check->popup("提示:用户名或密码错误!");
	}
	else
	{ 
      
		$ad_id=$rss[0]['ad_id'];
		$ad_flag=$rss[0]['ad_flag'];
		$ad_username=$rss[0]['ad_username'];
		$ad_truename=$rss[0]['ad_truename'];
		$_SESSION['ad_id']=$ad_id;
		$_SESSION['ad_flag']=$ad_flag;
		$_SESSION['ad_username']=$ad_username;
		$_SESSION['ad_truename']=$ad_truename;
		$_SESSION['ad_activetime']=time();
		$_SESSION['IP']=$objBase->getUserIp();
		echo "<script language=\"JavaScript\">";
		echo "location.href=\"main.php\"";
		echo "</script>";
	}
}
?>