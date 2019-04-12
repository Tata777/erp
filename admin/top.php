<?
	session_start();
	if (!isset($_SESSION["ad_id"])){
	echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">
	<script>
	alert('您没有登录或不是管理员，请重新登录！')
	<!--top.location.href='index.php'-->
	</script>";
	}
	require_once('../config.inc.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $companyname;?></title>
<link href="css/style.css" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript" src="../include/js/admin.js"></script>
</head>

<body id="header">
<div id="sitetitle">
<strong>网站管理平台</strong>
<!--<a href="<?php echo $companyurl;?>" target="_blank"><?php echo $companyname;?></a>-->
<a href="../index.php" target="_blank"><?php echo $companyname;?></a>
</div>
<!--<div id="topmenu">
	<ul>
		<li><a href="user/index.php" target="mainframe" onclick="channelNav(this, 1);">用户管理</a></li>
		<li><a href="info/index.php?" target="mainframe" onclick="channelNav(this, 2);" class="current">资讯管理</a></li>
		<li><a href="sysproduct/index.php" target="mainframe" onclick="channelNav(this, 3);">系统产品</a></li>
		<li><a href="gestbook/index.php" target="mainframe" onclick="channelNav(this, 4);">留言本</a></li>
	</ul>
</div>-->
<a class="opened" id="sideswitch" onclick="sideSwitch();" href="javascript:;">关闭侧栏</a>
<div id="topinfo">
	<ul>
				<li class="sitehomelink"></li>
        <li class="sitehomelink"></li>
        <li class="sitehomelink"></li>
        <li class="sitehomelink"></li>
        <li class="sitehomelink"></li>
        <li class="sitehomelink">用户名：<font color="#00ff00"><?=$_SESSION["ad_username"]?></font></li>
				<li class="sitehomelink">登录IP：<font color="#00ff00"><?=$_SESSION["IP"]?></font></li>
				<li class="sitehomelink"><a href="quit.php">安全退出系统</a></li>
	</ul>
</div>

</body>
</html>
