<?php
$protectid="309,400,401"; 
include("../protect.php");
include_once("../../config.inc.php");
include_once(CFG_LIB_DIR.'mysqldb.inc.php');
$objDb = new mysqldb();
$strAction=$_POST["action"];
if(empty($strAction)){exit;}
$dtmDate=time();
if($strAction=="add"){
	$sql="insert into `".con_strPREFIX."pictrue`(Title,Photo,CreateTime) values('$Title','$Photo','$dtmDate')";
	$blnResult=$objDb->query($sql);
	if($blnResult){
		echo "<script>alert('增加成功');location.href='index.php';</script>";
	}
	else{
		echo "<script>alert('增加失败，请重试');history.go(-1);</script>";
	}
	exit;
}
else if($strAction=="edit"){
	$sql="update `".con_strPREFIX."pictrue` set Title='$Title',Photo='$Photo',CreateTime='$dtmDate' where ID=$id";
	$blnResult=$objDb->query($sql);
	if($blnResult){
		echo "<script>alert('修改成功');location.href='add.php?id=$id';</script>";
	}
	else{
		echo "<script>alert('修改失败，请重试');history.go(-1);</script>";
	}
	exit;
}
?>
