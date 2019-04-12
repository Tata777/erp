<?php
	$protectid="2"; 
	include("../protect.php");
	
	require("../../config.inc.php");
	
/*	include_once(CFG_LIB_DIR.'generic.lib.php');
	$objBase = new clsBase();*/
	
	include_once(CFG_LIB_DIR.'add_modify.php');
	$objAddModify = new clsAddModify();
	
	include_once(CFG_LIB_DIR.'relation.php');
	$objRelation = new clsRelation();

	extract($_POST);
	//$Content = $objBase->strFCKFilter($Content);
	$date=date("Y-m-d H:i:s");
	
	switch($_GET['act'])
	{
		
		case "update":
			$strID = $_GET['id'];
			$strSQL = "UPDATE `".con_strPREFIX."guestbook` SET `guest_re` = '$guest_re', `guest_redate` = '$date' WHERE guest_id = ".$strID;
			/*echo $strSQL;
			exit;*/
			$objAddModify->vodExecute("modify", $strSQL, "reply.php?act=update&id=".$strID);
			break;	
	}

?>