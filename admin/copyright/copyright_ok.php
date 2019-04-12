<?php
	$protectid="2"; 
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
			$strSQL = "INSERT INTO `".con_strPREFIX."copyright` (`PT`,`Title`, `Keywords`, `Description`, `CopyRight`, `BottomInfo`, `ICO`, `address`, `phone`, `fax`, `email`, `Lang`) VALUES ( '$PT','$Title', '$Keywords', '$Description', '$CopyRight', '$BottomInfo', '$ICO', '$address', '$phone', '$fax','$email', '$Lang')";
		/*	echo $strSQL;
			exit;*/
			$objAddModify->vodExecute("add", $strSQL, "copyright.php?Lang=$Lang");
			break;
		
		case "modify":
			$strID = $_GET['id'];
			$strSQL = "UPDATE `".con_strPREFIX."copyright` SET `Title` = '$Title',`PT`='$PT', `Keywords` = '$Keywords', `Description` = '$Description', `CopyRight` = '$CopyRight', `BottomInfo` = '$BottomInfo', `ICO` = '$ICO', `address` = '$address', `phone` = '$phone', `fax` = '$fax', `email` = '$email'  WHERE `Lang` = '$Lang'";
			
			//echo $strSQL;
			//exit;
			$objAddModify->vodExecute("modify", $strSQL, "copyright.php?Lang=$Lang");
			break;		
	}

?>