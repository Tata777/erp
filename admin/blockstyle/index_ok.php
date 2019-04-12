<?php	
	$protectid="131"; 
	include("../protect.php");
	
	include_once("../../config.inc.php");
	
	//执行批量操作
	include_once(CFG_LIB_DIR.'batch_operation.php');
	$objBO = new clsBatchOperation();
	
	$objBO->vodExecuteBO(con_strPREFIX."blockstyle", "BlockStyleID", "index.php");
?>