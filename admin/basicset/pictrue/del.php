<?php
$protectid="309,400,401"; 
include("../protect.php");
include_once("../../config.inc.php");
include_once(CFG_LIB_DIR.'mysqldb.inc.php');
$objDb = new mysqldb();
if($action=="del"){
	if($id>0){
		$sql="delete from `".con_strPREFIX."pictrue` where ID=$id";
		$blnResult=$objDb->query($sql);
		if($blnResult){
			echo "<script>alert('删除成功');location.href='index.php';</script>";
		}
		else{
			echo "<script>alert('删除失败，请重试');history.go(-1);</script>";
		}
		exit;
	}
	else{
		if($_POST["action"]!="del"){exit;}
		$sel=$_POST["sel"];
		if(!empty($sel)){
			foreach($sel as $v){
				if(empty($strID)){$strID = $v;}
				else{$strID .= ",".$v;}
			}
			$sql="delete from `".con_strPREFIX."pictrue` where ID in($strID)";
			$blnResult=$objDb->query($sql);
			if($blnResult){
				echo "<script>alert('删除成功');location.href='index.php?page=$page';</script>";
			}
			else{
				echo "<script>alert('删除失败，请重试');history.go(-1);</script>";
			}
			exit;
		}
	}
}
else if($_POST["action"]=="sortNum"){
	$sel=$_POST["sel"];
	if(!empty($sel)){
		foreach($sel as $v){
			$intSortNum=$_POST["sortNum".$v];
			$sql="update `".con_strPREFIX."pictrue` set sortNum='$intSortNum' where ID ='$v'";
			$blnResult=$objDb->query($sql);
			if($blnResult){
				echo "<script>alert('排序成功');location.href='index.php?page=$page';</script>";
			}
			else{
				echo "<script>alert('排序失败，请重试');history.go(-1);</script>";
			}
		}
	}
	else{
		echo "<script>alert('请选择要进行排序的记录');history.go(-1);</script>";
	}
}
?>
