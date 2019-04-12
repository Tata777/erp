<?php
	require_once("./user_chksession.php");
	$dir = $_POST['dir'];
	$input = $_POST['input'];
	$pic = $_POST['pic'];
	
	include_once("../config.inc.php");
	include_once(CFG_LIB_DIR."upload_class.php");
	
	$objUp = new uploadclass();
	
	$dir = $_POST['dir'];
	$input = $_POST['input'];
	$pic = $_POST['pic'];
	$other = $_POST['other'];
	$form = $_POST['form'];
	$downsize = $_POST['downsize'];
	
	
	$strUploadDir = $uploaddirarray[$dir]; //取自定义上传路径
	$strImg = $_FILES['imagefile']['name'];
	$intImgSize = $_FILES['imagefile']['size'];
	$strTmpFile = $_FILES['imagefile']['tmp_name'];
	$strMimeType = $_FILES['imagefile']['type'];
	//echo $strMimeType;
	//exit;
	$objUp->upload($strUploadDir, $strImg, $intImgSize, $strTmpFile, $strMimeType, $input, $pic, $other,$form,$downsize);
?>