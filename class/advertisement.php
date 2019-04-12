<?
if( !class_exists('mysqldb') )
{
	require_once(dirname(__FILE__)."/../config.inc.php");
	include_once(CFG_LIB_DIR.'mysqldb.inc.php');
}
class clsAd extends mysqldb
{
	
    function Advertisement($PosID = "", $number = 0, $Width = "", $Height ="")
		{
			$script_filename = $_SERVER['PHP_SELF'];
			if (preg_match("/\/www\/([^\/]*)$/" , $script_filename)) {
				$dir_path = '../';
			} else {
				$dir_path = '../../';
			}
			$path=$dir_path."uploadfile/guangg/";
			/*echo $path;*/
			$NowTime = time();
			$strSQL = "SELECT * FROM `".con_strPREFIX."advertisement` WHERE `PosID` = '".$PosID."' AND `StartDate` <= ".$NowTime." AND `EndDate` >= ".$NowTime."	ORDER BY `SortNum` ASC, `PublishDate` DESC";
			if($Number == 1){
				$strSQL .= " LIMIT 0,1";
			}
			parent::query($strSQL);
			$Rs = parent::get_data();

			if($Rs)
			{
					foreach($Rs as $AdVal)
					{
						if($_SESSION['ad_id']){
							$link = $dir_path."admin/advertisement/index.php?PosID=".$PosID."&Width=".$Width."&Height=".$Height;
							$boder ="; border:1px solid #FF0000;";
							$rel = " rel='gb_page_center[900,500]'";
						}else{
							$link = $AdVal["Link"];
						}
							//echo $_SESSION['ad_id'];
						 if($AdVal['Type'] === 'pic')
						 {
								echo "<div style='margin:10px 0 10px 0".$boder."'><a href='".$link."'".$rel."><img name='index_r3_c29' src='".$path.$AdVal['Photo']."' width='".$AdVal['Width']."' height='".$AdVal['Height']."' border='0' id='index_r3_c29' alt='".$AdVal['Name']."' /></a></div>";
						 }
						 else if($AdVal['Type'] === 'fla')
						 {
													if($_SESSION['ad_id']){
															echo "<div style='margin:10px 0 10px 0".$boder."'><a href='".$link."''".$rel.">
															编辑flash广告</a> <a href='".$path.$AdVal['Photo']."' target='_blank'>当前flash广告</a>
													          </div>";
								         }else{
												 			echo "<div style='margin:10px 0 10px 0'><a href='".$link."' rel=\"gb_page_center[900,500]\">
								<script type='text/javascript'>AC_FL_RunContent( 'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0','width','".$AdVal['Width']."','height','".$AdVal['Height']."','src','".$path.preg_replace("/([A-z0-9]*)\\.swf?/is", "\\1", $AdVal['Photo'])."','quality','high','pluginspage','http://www.macromedia.com/go/getflashplayer','wmode','transparent','movie','".$path.preg_replace("/([A-z0-9]*)\\.swf?/is", "\\1", $AdVal['Photo'])."' ); //end AC code
								</script>
			<noscript>
			<object classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000' codebase='http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0' width='".$AdVal['Width']."' height='".$AdVal['Height']."'>
				<param name='movie' value='".$path.$AdVal['Photo']."' />
				<param name='quality' value='high' />
				<param name='wmode' value='transparent' />
				<embed src='".$path.$AdVal['Photo']."' width='".$AdVal['Width']."' height='".$AdVal['Height']."' quality='high' pluginspage='http://www.macromedia.com/go/getflashplayer' type='application/x-shockwave-flash' wmode='transparent'></embed>
			</object>
			</noscript> </a></div>";
												 }
						}
					}
			}else{
						if($_SESSION['ad_id']){
							$link2 = $dir_path."admin/advertisement/index.php?PosID=".$PosID."&Width=".$Width."&Height=".$Height;
							$boder ="; border:1px solid #FF0000;";
							$rel = " rel='gb_page_center[900,500]'";
						}else{
							$link2 = "";
							$boder = "";
							$rel = "";
						}

			echo "<div style='margin:10px 0 10px 0".$boder."'><a href='".$link2."'".$rel."><img name='index_r3_c29' src='".$dir_path."cn/images/ggw.jpg' width='".$Width."' height='".$Height."' border='0' id='index_r3_c29' alt='广告位招商' /></a></div>";
			}
		}
}
?>
