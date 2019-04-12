<?php
	$protectid="7"; 
	include("../protect.php");
	
	require("../../config.inc.php");
	
/*	include_once(CFG_LIB_DIR.'generic.lib.php');
	$objBase = new clsBase();*/
	
	include_once(CFG_LIB_DIR.'add_modify.php');
	$objAddModify = new clsAddModify();
	

	extract($_POST);
	
	switch($_GET['act'])
	{
		case "add" :
			$strSQL = "INSERT INTO `".con_strPREFIX."link` (`CateID`,`LinkName`, `LinkUrl`, `LogoPic`, `IsPic`, `PublishDate`, `Lang`  ) VALUES ( '$CateID', '$LinkName', '$LinkUrl', '$LogoPic', '$IsPic', UNIX_TIMESTAMP(), '$Lang' )";
			
			$objAddModify->vodExecute("add", $strSQL, "link.php?act=add&cid=$CateID");
			break;
		
		case "modify":
			$strID = $_GET['id'];
			  $strSQL = "UPDATE `".con_strPREFIX."link` SET  `CateID` = '$CateID', `LinkName` = '$LinkName', `LinkUrl` = '$LinkUrl', `LogoPic` = '$LogoPic', `IsPic` = '$IsPic', `PublishDate` = UNIX_TIMESTAMP(), `Lang` = '$Lang' WHERE  LinkID = ".$strID;
			 
			$objAddModify->vodExecute("modify", $strSQL, "link.php?act=modify&id=".$strID);
			break;		
	}

?>