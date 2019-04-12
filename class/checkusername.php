<?php 
	require_once(dirname(__FILE__)."/../config.inc.php");
	include_once(CFG_LIB_DIR.'mysqldb.inc.php');		
	$objDb = new mysqldb();
	$MemberName = $_POST['MemberName'];
		$sql="select MemberName from ".con_strPREFIX."member where MemberName='$MemberName'";
		$objDb->query($sql);
		$num=$objDb->get_num1();
		if ($num>0)
		{
			echo('用户名'.$MemberName.'已存在，请另选用户名！');
		}else{
			echo('<font color="#009900">用户名'.$MemberName.'未被使用^-^！</font>');
		}
?>
