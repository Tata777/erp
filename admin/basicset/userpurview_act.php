<?php
	$protectid="9";
	include("../protect.php");
	ini_set('display_errors',1);
  error_reporting(E_ALL);
	require("../../config.inc.php");
	
	include_once(CFG_LIB_DIR.'generic.lib.php');
	$objBase = new clsBase();
	
	include_once(CFG_LIB_DIR.'add_modify.php');
	$objAddModify = new clsAddModify();
	extract($_POST);
	switch($_REQUEST['act'])
	{
		case "add" :
			$strSQL = "INSERT INTO `".con_strPREFIX."rolesetting` (`RoleName`, `ReadingRight`) VALUES ('$RoleName', '$ReadingRight')";
			$objAddModify->vodExecute("add", $strSQL, "userpurview.php?act=add");
			break;
		
		case "modify":
			$strID = $_GET['id'];
			$strSQL = "UPDATE `".con_strPREFIX."rolesetting` SET `RoleName` = '$RoleName', `ReadingRight` = '$ReadingRight', `IsInfo` = '$IsInfo', `InfoAuditing` = '$InfoAuditing', `MaxInfo` = '$MaxInfo', `IsSnd` = '$IsSnd', `SndAuditing` = '$SndAuditing', `MaxSnd` = '$MaxSnd', `MaxSndPhoto` = '$MaxSndPhoto', `IsProduct` = '$IsProduct', `ProductAuditing` = '$ProductAuditing', `MaxProduct` = '$MaxProduct', `MaxProductPhoto` = '$MaxProductPhoto' WHERE  RoleSettingID = ".$strID;
			$objAddModify->vodExecute("modify", $strSQL, "purviewform.php?act=modify&id=".$strID);
			break;	
		case "batch"://批量修改
			$arrVal = $_POST;
			$num = 0;
			//$objBase->vardump($arrVal);
		  foreach($arrVal['RoleSettingID'] as $key=>$indID)
        {
				$strSQL = "UPDATE `".con_strPREFIX."rolesetting` SET `RoleName` = '".$arrVal['RoleName'][$key]."', `ReadingRight` = '".$arrVal['ReadingRight'][$key]."' WHERE  RoleSettingID = ".$indID;
				$result = mysql_query($strSQL);
				$num++;
				}
			if($num)
				$objBase->popup('恭喜你更新成功', "userpurview.php");
			else
				$objBase->popup('对不起，更新失败');
			break;

			break;
		case "del":	
		  $strID = $_GET['id'];
			$DelSql = "delete from `".con_strPREFIX."rolesetting` WHERE  RoleSettingID = ".$strID;
			$result = mysql_query($DelSql);
			if($result)
				$objBase->popup('恭喜你删除成功', "userpurview.php");
			else
				$objBase->popup('对不起，删除失败');
			break;
	}

?>