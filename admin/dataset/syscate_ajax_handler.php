<?php
	$protectid="132"; 
	include("../protect.php");
	
	header("Content-type:text/xml; charset=utf-8");
	echo '<?xml version="1.0" encoding="utf-8"?>'."\n";
	echo "<root>\n";
	
	include_once("../../config.inc.php");
	
	include_once(CFG_LIB_DIR."selector.php");
	$SelCate = new clsSelCate();
	
	$strCateType 	= $_POST['strCateType'];
	$strCateID 		= $_POST['strCateID'];
	$arrMap				= array(
										"info"					=>	array("id"	=>	"InfoCategoryID",	"table"	=>	"infocategory"),
										"supplyndemand"	=>	array("id"	=>	"SndCategoryID",	"table"	=>	"sndcategory"),
										"link"				=>	array("id"	=>	"LinkCategoryID",	"table"	=>	"linkcategory"),
										"down"				=>	array("id"	=>	"DownCategoryID",	"table"	=>	"downcategory"),
										"recruitment"		=>	array("id"	=>	"RecruitmentCategoryID",	"table"	=>	"recruitmentcategory"),
										"sysproduct"		=>	array("id"	=>	"SysProCategoryID",	"table"	=>	"sys_procategory"),
										"personal"			=>	array("id"	=>	"PersonCateID",		"table"	=>	"personalcate"),
										"exhibition"		=>	array("id"	=>	"FairID",					"table"	=>	"exhibitioncate")						
									);
									
	
	echo "<keyname>".$arrMap[$strCateType]["id"]."</keyname>";
	
	echo "<Response><![CDATA[";
	
	echo $SelCate->strSelCate("1", ((isset($strCateID) && !empty($strCateID)) ? unserialize(stripslashes($strCateID)) : ""), con_strPREFIX.$arrMap[$strCateType]["table"], "SysCateID[]", "10", "multiple");
	
	echo "]]></Response>\n";
	
	echo "</root>";
	exit();
?>