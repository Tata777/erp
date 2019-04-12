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
	$RelationID = $objRelation->strGetRelationID($Tag, con_strPREFIX."info", "InfoID", "Tag", $_GET['id']);
	$PublishDate = $PublishDate .date("H:i",time());
	
	switch($_GET['act'])
	{
		case "add" :
			$Intro=str_replace("\r\n","<br />",$Intro);
			$Intro=str_replace("\r","<br />",$Intro);
			$Intro=str_replace("\n","<br />",$Intro);
			$strSQL = "INSERT INTO `".con_strPREFIX."info` (`CateID`, `SpecialID`, `Title`, `TitleColor`, `Author`, `Editor`, `FirstPhoto`, `Photos`, `SubTitle`, `Content`, `Tag`, `RelationID`, `FromSite`, `Intro`, `CustomLinks`, `Role`, `IsAuditing`, `Lang`, `IsLock`, `SortNum`, `TopNum`, `ExtractNum`, `CreationDate`, `ModifiedDate`, `CreationUserID`, `ModifiedUserID`, `PublishDate`) 
			VALUES ('$CateID', '$SpecialID', '$Title', '$TitleColor', '$Author', '$Editor', '$Photo', '$Photo', '$SubTitle', '$Content', '$Tag', '$RelationID', '$FromSite', '$Intro', '$CustomLinks', '$Role', '$IsAuditing', '$Lang', '$IsLock', '$SortNum', '$TopNum', '$ExtractNum', UNIX_TIMESTAMP(), UNIX_TIMESTAMP(), '".$_SESSION['ad_id']."', '".$_SESSION['ad_id']."', '".strtotime($PublishDate)."')";
 		//	echo $strSQL;
		//	exit; 
			$objAddModify->vodExecute("add", $strSQL, "info.php?act=add&cid=$CateID&role=$Role");
			break;
		
		case "modify":
			$strID = $_GET['id'];
			$Intro=str_replace("\r\n","<br />",$Intro);
			$Intro=str_replace("\r","<br />",$Intro);
			$Intro=str_replace("\n","<br />",$Intro);
			$strSQL = "UPDATE `".con_strPREFIX."info` SET  
		 `CateID` = '$CateID', `SpecialID` = '$SpecialID', `Title` = '$Title', `TitleColor` = '$TitleColor', `Author` = '$Author', `Editor` = '$Editor', `Photos` = '$Photo', `FirstPhoto` = '$Photo', `SubTitle` = '$SubTitle', `Content` = '$Content', `Tag` = '$Tag', `RelationID` = '$RelationID', `FromSite` = '$FromSite' , `Intro` = '$Intro', `CustomLinks` = '$CustomLinks', `Role` = '$Role', `IsAuditing` = '$IsAuditing' , `IsLock` = '$IsLock', `Lang` = '$Lang', `SortNum` = '$SortNum', `TopNum` = '$TopNum', `ExtractNum` = '$ExtractNum',  `ModifiedDate` = UNIX_TIMESTAMP(), `ModifiedUserID` = ".$_SESSION['ad_id'].", `PublishDate` = ".strtotime($PublishDate)." WHERE  InfoID = ".$strID;
		 //	echo $strSQL;
			//exit; 
			$objAddModify->vodExecute("modify", $strSQL, "info.php?act=modify&id=".$strID);
			break;		
	}

?>