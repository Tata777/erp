<?php
	$protectid="15"; 
	include("../protect.php");
	
	require("../../config.inc.php");
	
	include_once(CFG_LIB_DIR.'generic.lib.php');
	$objBase = new clsBase();
	
	include_once(CFG_LIB_DIR.'add_modify.php');
	$objAddModify = new clsAddModify();

	extract($_POST);
	$Request = $objBase->strTextareaConvert($Request);
	$Note = $objBase->strTextareaConvert($Note);
	switch($_GET['act'])
	{
		case "add" :
			$strSQL = "INSERT INTO `".con_strPREFIX."recruitment` (`CateID`,`CmpProvince`,`CmpCity`,`Lang`, `JobName`, `Academic`, `Request`, `StartDate`, `EndDate`, `Note`, `Salary`, `Experience`, `PublishDate`, `CreationUserID`, `ModifiedUserID`, `ModifiedDate`) VALUES ('$CateID', '$CmpProvince', '$CmpCity', '$Lang', '$JobName', '$Academic', '$Request', ".strtotime($StartDate).", ".strtotime($EndDate).", '$Note', '$Salary', '$Experience', UNIX_TIMESTAMP(), ".$_SESSION['ad_id'].", ".$_SESSION['ad_id'].", UNIX_TIMESTAMP())";
			//echo $strSQL;
			//exit;
			$objAddModify->vodExecute("add", $strSQL, "recruitment.php?act=add&cid=$CateID");
			break;
		
		case "modify":
			$strID = $_GET['id'];
			$strSQL = "UPDATE `".con_strPREFIX."recruitment` SET `CateID` = '$CateID',`CmpProvince` = '$CmpProvince',`CmpCity` = '$CmpCity',`Lang` = '$Lang', `JobName` = '$JobName', `Academic` = '$Academic', `Request` = '$Request', `StartDate` = ".strtotime($StartDate).", `EndDate` = ".strtotime($EndDate).", `Note` = '$Note', `Salary` = '$Salary', `Experience` = '$Experience', `ModifiedDate` = UNIX_TIMESTAMP(), `ModifiedUserID` = ".$_SESSION['ad_id']." WHERE RecruitmentID = ".$strID;
			$objAddModify->vodExecute("modify", $strSQL, "recruitment.php?act=modify&id=".$strID);
			break;		
	}

?>