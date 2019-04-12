<?php
	$protectid="131"; 
	include("../protect.php");
	
	require("../../config.inc.php");
	
	include_once(CFG_LIB_DIR.'add_modify.php');
	$objAddModify = new clsAddModify();
	
	include_once(CFG_LIB_DIR.'manage_block.php');
	$objManBlock = new clsManageBlock();
	
	$strID = $_GET['id'];
	$cid = $_GET['cid'];
	$ctype = $_GET['ctype'];
	$BlockName = $_POST['BlockName'];
	$BlockModel = $_POST['BlockModel'];
	
	
	$arrTextAndCode = $objManBlock->arrGetBlockTextAndCode();
	
	switch($_GET['act'])
	{
		case "add" :
			$strSQL = "INSERT INTO `".con_strPREFIX."blocks` (`CateID`, `BlockName`, `BlockModel`, `BlockText`, `BlockCode`, `CreationDate`) VALUES ( '$cid', '$BlockName', '$BlockModel', '{$arrTextAndCode['Text']}', '{$arrTextAndCode['Code']}', UNIX_TIMESTAMP())";
			
			$objAddModify->vodExecute("add", $strSQL, "block.php?act=add&cid=$cid&ctype=$ctype");
			break;
		
		case "modify":
			$strID = $_GET['id'];
			$strSQL = "UPDATE `".con_strPREFIX."blocks` SET `CateID` = '$cid', `BlockName` = '$BlockName', `BlockModel` = '$BlockModel', `BlockText` = '{$arrTextAndCode['Text']}', `BlockCode` = '{$arrTextAndCode['Code']}' WHERE  BlocksID = ".$strID;
			$objAddModify->vodExecute("modify", $strSQL, "block.php?act=modify&id=$strID&cid=$cid&ctype=$ctype");
			break;
	}

?>