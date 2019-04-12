<?php
  //  die('Website is under construction...');
	session_start();
	include_once("config.inc.php");
	//require_once('waf.php');
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

function time_tran($the_time){
   $now_time = date("Y-m-d H:i:s",time());
   $now_time = strtotime($now_time);
   $show_time = strtotime($the_time);
   $dur = $now_time - $show_time;
   if($dur < 0){
      return $the_time;
   }else{
     if($dur < 60){
       return $dur.'秒前';
     }else{
       if($dur < 3600){
          return floor($dur/60).'分钟前';
       }else{
          if($dur < 86400){
            return floor($dur/3600).'小时前';
          }else{
            if($dur < 259200){//3天内
                return floor($dur/86400).'天前';
            }else{
              return $the_time;
            }
		 }
       }
     }
   } 
}
   
   $id = $_GET['id'];
   $cateid = $_GET['cateid'];
   $prid = $_GET['prid'];
   $type = $_GET['type'];
   	
	extract($_POST);
		extract($_GET);


	
?>
