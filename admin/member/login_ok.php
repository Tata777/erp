<?php
include "includeFiles.php";
if(empty($cateid)) $cateid=11010;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $C['Title'];?></title>
<Link href="./uploadfile/ico/<?php echo $C['ICO'];?>" rel="Shortcut Icon">
<meta name="Keywords" content="<?php echo $C['Keywords'];?>">
<meta name="description" content="<?php echo $C['Description'];?>">
<Meta name="Copyright" Content="<?php echo $C['CopyRight'];?>">
<link type="text/css" href="./css/layout.css" rel="stylesheet" />
<link type="text/css" href="./css/skin.css" rel="stylesheet" />
<link type="text/css" href="./css/font.css" rel="stylesheet" />
<link href="css/main_style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php

if($_SESSION["islogin"]=="1"){
	echo "<script>location.href='modify.php';</script>";
	exit;
}

$action=$_POST["action"];
if($action=="login"){
	$yancode=$_POST['yancode'];
	if ($_SESSION['seccode']=="" || trim($yancode)!=$_SESSION['seccode']){
		echo "<script>alert('验证码错误。');location.href='member.php';</script>";
		exit;
	}
	else{
		$sql="select * from hy_member where user_name='$user_name' and user_pws='$user_pws'";
		$objDb->query($sql);
		$row=$objDb->get_data();
		if($row){
			$_SESSION["user_id"]=$row[0]["user_id"];
			$_SESSION["user_name"]=$row[0]["user_name"];
			$_SESSION["islogin"]="1";
			echo "<script>alert('登陆成功。');location.href='modify.php';</script>";
			exit;
		}
		else{
			echo "<script>alert('用户名或密码错误。');location.href='member.php';</script>";
			exit;
		}
	}
}


?>
</body>
</html>
