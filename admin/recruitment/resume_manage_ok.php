<?php	
	//产品管理ID号
	$protectid="15"; 
	include("../protect.php");
	
	include_once("../../config.inc.php");
	
	//执行批量操作
	include_once(CFG_LIB_DIR.'batch_operation.php');
	$objBO = new clsBatchOperation();
	/*echo "<pre>";
	var_dump($_POST);
	echo "</pre>";
	exit();*/
	$objBO->vodExecuteBO(con_strPREFIX."resume", "ResumeId", "resume_manage.php");
?>