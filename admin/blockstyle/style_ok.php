<?php
	$protectid="131"; 
	include("../protect.php");
	
	require("../../config.inc.php");
	
	include_once(CFG_LIB_DIR.'add_modify.php');
	$objAddModify = new clsAddModify();
	
	extract($_POST);
	
	switch($_GET['act'])
	{
		case "add" :
			$strSQL = "INSERT INTO `".con_strPREFIX."blockstyle` (`CateID`, `StyleTitle`, `Intro`, `FileName`) VALUES ( '$CateID', '$StyleTitle', '$Intro', '$FileName')";
			
			$objAddModify->vodExecute("add", $strSQL, "style.php?act=add&cid=$CateID");
			break;
		
		case "modify":
			$strID = $_GET['id'];
			$strSQL = "UPDATE `".con_strPREFIX."blockstyle` SET `CateID` = '$CateID', `StyleTitle` = '$StyleTitle', `Intro` = '$Intro', `FileName` = '$FileName' WHERE  BlockStyleID = ".$strID;
			$objAddModify->vodExecute("modify", $strSQL, "style.php?act=modify&id=".$strID);
			break;		
	}

?>