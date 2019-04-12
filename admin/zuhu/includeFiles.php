<?php
    session_start();
	include_once("../../config.inc.php");
	
	include_once(CFG_LIB_DIR.'mysqldb.inc.php');
	$objDb = new mysqldb();
	
	include_once(CFG_LIB_DIR."block.php");
	$Block = new clsBlock();
	
	include_once(CFG_LIB_DIR."generic.lib.php");
	$objBase = new clsBase();
	
	include_once(CFG_LIB_DIR."category.php");
	$objSortList = new clsCategory();
	
	include_once(CFG_LIB_DIR."copyright.php");
	$objCopyRight = new clsCopyRight();
	
	include_once(CFG_LIB_DIR."infomanager.php");
	$info = new Info();
	
	$cfg_cur_lan = 'cn';//网站当前语言
	$CateNameEn = 'CateNameEn';
	$C = $objCopyRight->CopyRight($cfg_cur_lan);
	
	function BannerImg($CateID){
		if($CateID){
				$objDb = new mysqldb();
            	$sql="select * from `hy_b_sys_products_banner` where CateID=".$CateID." limit 0,1";
				$objDb -> query($sql);
				$rs=$objDb -> get_data();
				//print_r($rs);
				if($rs[0]['FirstPhoto']){
					$banner_img='../uploadfile/product/'.$rs[0]['FirstPhoto'];
				}else{
					$banner_img='images/banner.gif';
				}
				if($rs[0]['SubName']){
					$a_fir='<a href="'.$rs[0]['SubName'].'" target="_blank">';
					$a_end='</a>';
				}else{
					$a_fir='';
					$a_end='';
				}
				return  $bannerStr=$a_fir.'<img src="'.$banner_img.'"  onError="this.src=\'images/banner.gif\';">'.$a_end;
		}
	}
	
	function getsubstr($str,$len)
	{
		 $p_strIn=$str;
		 $p_intLen=$len;
		 $p_blnDot=1;
		 $p_strIn = preg_replace("/<.+?>/is", "", $p_strIn);
		 $p_strIn = preg_replace("/&nbsp;/is", " ", $p_strIn);
		 preg_match_all("/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/", $p_strIn, $arrCharacter);
		 if (count($arrCharacter[0])>$p_intLen)
		 { 
			$content=join("", array_slice($arrCharacter[0], 0, $p_intLen)).($p_blnDot == "1" ? "..." : ""); 
		 }else{   
			$content=join("",array_slice($arrCharacter[0], 0, $p_intLen));
		 }
		 return $content;
	}
	
	
	
	function getsubstr2($str,$len)
	{
		 $p_strIn=$str;
		 $p_intLen=$len;
		 $p_blnDot=1;
		 $p_strIn = preg_replace("/<.+?>/is", "", $p_strIn);
		 $p_strIn = preg_replace("/&nbsp;/is", " ", $p_strIn);
		 preg_match_all("/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/", $p_strIn, $arrCharacter);
		 if (count($arrCharacter[0])>$p_intLen)
		 { 
			$content=join("", array_slice($arrCharacter[0], 0, $p_intLen)).($p_blnDot == "1" ? "" : ""); 
		 }else{   
			$content=join("",array_slice($arrCharacter[0], 0, $p_intLen));
		 }
		 return $content;
	}
   
   
   $id     = $_GET['id'];
   $cateid = $_GET['cateid'];
   $prid   = $_GET['prid'];
   if(empty($cityid))   $cityid = 11614; //默认广东
   
    if($_GET['action'] == "exit") $info->memberexit();
    if($_POST['action'] == "modifymember") $info->modifymember($_POST);
	if($_POST['action'] == "login") $info->memberlogin($_POST); 
   	if($_GET['action'] == "addcart") $info->addCart($_GET['prid']);
	if($_GET['action'] == "delcart") $info->delCart();
	if($_POST['action'] == "jiesuan") $info->saveOrder($_POST); 
	if($_POST['action'] == "jfjiesuan") $info->chulizhifen($_POST['productID']); 
	if($_POST['action'] == "addcj") $info->addcj($_POST); 
	
?>