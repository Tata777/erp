<?php
	session_start();
	header("content-type:text/html;charset=utf-8");
	
	include_once("../../config.inc.php");
	
	include_once(CFG_LIB_DIR.'mysqldb.inc.php');
	$objDb = new mysqldb();
	
	include_once(CFG_LIB_DIR."block.php");
	$Block = new clsBlock();
	
	include_once(CFG_LIB_DIR."generic.lib.php");
	$objBase = new clsBase();
	
	$strID = $_GET['id'];
	
	switch($_GET['act'])
	{		
		case "manage":	
			//执行批量操作
			include_once(CFG_LIB_DIR.'batch_operation.php');
			$objBO = new clsBatchOperation();
			
			$objBO->vodExecuteBO(con_strPREFIX."book", "guest_id", "index.php");
			break;	
	}

?>