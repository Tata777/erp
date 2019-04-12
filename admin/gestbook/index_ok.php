<?php
	$protectid="6"; 
	include("../protect.php");
	
	include_once("../../config.inc.php");
	
	//执行批量操作
	include_once(CFG_LIB_DIR.'batch_operation.php');
	$objBO = new clsBatchOperation();
	
	$objBO->vodExecuteBO(con_strPREFIX."guestbook", "guest_id", "index.php");
?>