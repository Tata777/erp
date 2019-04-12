<?php
	session_start();
	require_once('../config.inc.php');
	include_once (CFG_LIB_DIR.'generic.lib.php');
	$ObjBase = new clsBase();
	$lifetime=24*60*60;
	$time=time();
	if(isset($_SESSION['ad_activetime'])){
		if(intval($_SESSION['ad_activetime'])<$time-$lifetime){
			$ObjBase->popup("登录超时，请重新登录！", 'index.php');
		}else{
			$_SESSION['ad_activetime']=$time;
		}
	}
	if (!isset($_SESSION["ad_id"])){
		$ObjBase->popup("您没有登录或不是管理员，请重新登录！", 'index.php');
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $companyname;?></title>
</head>

<frameset rows="100,*" frameborder="no" border="0" framespacing="0">
  <frame src="top.php" name="topframe" scrolling="No" id="topframe" title="topframe" />
  <frameset id="mainframe" cols="205,*" frameborder="no" border="0" framespacing="0">
    <frame src="left.php" name="leftframe" scrolling="Yes" noresize="noresize" id="leftframe" title="leftframe" />
    <frame src="date.html" name="mainframe" id="mainframe" title="mainframe" />
  </frameset>
</frameset>
<noframes>
<body>
</body>
</noframes>
</html>