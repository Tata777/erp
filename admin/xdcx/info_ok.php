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
	$Role = 0;
	$RelationID = $objRelation->strGetRelationID($Tag, con_strPREFIX."xdcx", "ID", "Tag", $_GET['id']);
	
	switch($_GET['act'])
	{
		case "add" :
			$Intro=str_replace("\r\n","<br />",$Intro);
			$Intro=str_replace("\r","<br />",$Intro);
			$Intro=str_replace("\n","<br />",$Intro);
			$strSQL = "INSERT INTO `".con_strPREFIX."xdcx` (`CateID`,`Title`,`SubTitle`,`FromSite`,`Intro`) 
			VALUES ('$CateID','$Title','$SubTitle','$FromSite','$Intro')";
/*			echo $strSQL;
			exit;*/
			$objAddModify->vodExecute("add", $strSQL, "info.php?act=add&cid=$CateID&role=$Role");
			break;
		
		case "modify":
			$strID = $_GET['id'];
			$Intro=str_replace("\r\n","<br />",$Intro);
			$Intro=str_replace("\r","<br />",$Intro);
			$Intro=str_replace("\n","<br />",$Intro);
			$strSQL = "UPDATE `".con_strPREFIX."xdcx` SET `CateID`='$CateID',`Title`='$Title',`SubTitle`='$SubTitle',`FromSite`='$FromSite',`Intro`='$Intro'   WHERE  ID = ".$strID;
		/*	echo $strSQL;
			exit;*/
			$objAddModify->vodExecute("modify", $strSQL, "info.php?act=modify&id=".$strID);
			break;		
	}

?>