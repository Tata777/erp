<?php
	$protectid="14"; 
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
	$RelationID = $objRelation->strGetRelationID($Tag, con_strPREFIX."sys_products_banner", "SysProductsID", "Tag", $_GET['id']);
	$Price = $Price ? $Price : "0";
	$Postage = $Postage ? $Postage : "0";
	$Express = $Express ? $Express : "0";
	$Ems = $Ems ? $Ems : "0";
	
	switch($_GET['act'])
	{
		case "add" :
			$strSQL = "INSERT INTO `".con_strPREFIX."sys_products_banner` (`CateID`, `BrandID`, `ProductName`, `SubName`, `Price`, `Postage`, `Express`, `Ems`, `Unit`, `Material`, `Size`, `Color`, `FirstPhoto`, `Photos`, `Files`, `Note`, `Tag`, `RelationID`, `Lang`, `IsLock`, `SortNum`, `TopNum`, `ExtractNum`, `PublishDate`, `ModifiedDate`, `CreationUserID`, `ModifiedUserID`) VALUES ('$CateID', '$BrandID', '$ProductName', '$SubName', $Price, $Postage, $Express, $Ems, '$Unit', '$Material', '$Size', '$Color', '$FirstPhoto', '$Photos', '$Files', '$Note', '$Tag', '$RelationID', '$Lang', $IsLock, $SortNum, $TopNum, $ExtractNum, UNIX_TIMESTAMP(), UNIX_TIMESTAMP(), ".$_SESSION['ad_id'].", ".$_SESSION['ad_id'].")";

			$objAddModify->vodExecute("add", $strSQL, "banner_product.php?act=add&cid=$CateID");
			break;
		
		case "modify":
			$strID = $_GET['id'];
			$strSQL = "UPDATE `".con_strPREFIX."sys_products_banner` SET `CateID` = '$CateID', `BrandID` = '$BrandID', `ProductName` = '$ProductName', `SubName` = '$SubName', `Price` = '$Price', `Postage` = '$Postage', `Express` = '$Express', `Ems` = '$Ems', `Unit` = '$Unit', `Material` = '$Material', `Size` = '$Size', `Color` = '$Color', `FirstPhoto` = '$FirstPhoto', `Photos` = '$Photos',  `Files` = '$Files',`Note` = '$Note', `Tag` = '$Tag' , `RelationID` = '$RelationID', `IsLock` = $IsLock, `Lang` = '$Lang', `SortNum` = $SortNum, `TopNum` = $TopNum, `ExtractNum` = $ExtractNum, `ModifiedDate` = UNIX_TIMESTAMP(), `ModifiedUserID` = ".$_SESSION['ad_id']." WHERE  SysProductsID = ".$strID;
			

			$objAddModify->vodExecute("modify", $strSQL, "banner_product.php?act=modify&id=".$strID);
			break;		
	}

?>