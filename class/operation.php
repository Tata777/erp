<?php
	if( !class_exists('mysqldb') )
	{
		require_once(dirname(__FILE__)."/../config.inc.php");
		include_once(CFG_LIB_DIR.'mysqldb.inc.php');
	}
	
	class clsOperationBase extends mysqldb
	{
		protected function popup($tips, $location='', $refreshParent='no', $debug='no')
		{
			$location = (!empty($location)) ? "window.location.href = '$location'" : "history.back();";
			$location = ($debug == 'yes') ? "" : $location;
				
			$strRefresh = ($refreshParent == "yes") ? "self.parent.location.reload()" : "";
		
			echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">
						<script type=\"text/javascript\">\n
							alert('$tips');\n
							$strRefresh\n
							$location;\n
						</script>\n";
			exit();		
		}
		
		/*
		获取用户IP
		*/
		protected function getUserIp()
		{
			$ip=false;
			if($_SERVER['HTTP_X_FORWARDED_FOR']!="")
			{
					$REMOTE_ADDR=$_SERVER['HTTP_X_FORWARDED_FOR'];
						$tmp_ip=explode(",",$REMOTE_ADDR);
					$ip=$tmp_ip[0]; 
			}	
			return ($ip ? $ip : $_SERVER['REMOTE_ADDR']);
		}
		
		//过滤FCKeditor Post过来的特殊字符
		protected function strFCKFilter($p_strValue)
		{
			if ( get_magic_quotes_gpc() )
				$postedValue = htmlspecialchars( stripslashes( $p_strValue ) ) ;
			else
				$postedValue = htmlspecialchars( $p_strValue ) ;
			
			return $postedValue;
		}
	}
?>