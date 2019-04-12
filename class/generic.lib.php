<?php
class clsBase{
		function popup($tips,$location='',$target='')
		{
			$target = ($target == '') ? "window" : $target;
			if(!empty($location))
				$location = $target.".location.href = '$location'";
			else
				$location = "history.back();";
		
			echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">
						<script type=\"text/javascript\">\n
							alert('$tips');\n
							$location;\n
						</script>\n";
			exit();		
		}
		/*
		获取用户IP
		*/
		function getUserIp()
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
		/**
		 * 显示指定变量的内容 
		 * @param mixd $var 变量名
		 */
		function vardump($var, $name = null) {
				echo "---------$name---------<pre>";
				print_r($var);
				echo '</pre>------------------------';
		}
		
		//过滤FCKeditor Post过来的特殊字符
		public function strFCKFilter($p_strValue)
		{
			if ( get_magic_quotes_gpc() )
				$postedValue = htmlspecialchars( stripslashes( $p_strValue ) ) ;
			else
				$postedValue = htmlspecialchars( $p_strValue ) ;
			
			return $postedValue;
		}
		/**
			 * *****************
			 *截取UTF-8编码下字符串的函数
			 * @param string $mStr	被截取的字符串
			 * @param int $mStart	截取的起始位置
			 * @param int $mLength	截取的长度
			 * @param bool $mAppend	是否附加省略号
			 * @return unknown
			 */
		function Utf8Cut($mStr, $mStart=0, $mLength=0, $mAppend=true)
		{
			$str = trim($mStr);
			$reval = '';
		
			if (0 == $mLength)
			{
				$length = strlen($str);
			}
			elseif (0 > $mLength)
			{
				$length = strlen($str) + $mLength;
			}
		
			if (strlen($str) <= $mLength) return $str;
		
			for($i = 0; $i < $mLength; $i++)
			{
				if (!isset($str[$i])) break;
		
				if (196 <= ord($str[$i]))
				{
					$i += 2 ;
					$start += 2;
				}
			}
			if ($i >= $mStart) $reval = substr($str, 0, $i);
			if ($i < strlen($str) && $mAppend) $reval .= "...";
		
			return $reval;
		}
		
		/*********************************
		* depiction：转换textarea框输入的内容
		@param p_strValue 需要转换的内容
		@returns string
		Creater：sun
		Create Date：2007-1-5
		**********************************/
		public function strTextareaConvert($p_strValue)
		{
			$strOut = preg_replace('/\n/m', "<br />", $p_strValue);
			$strOut = preg_replace('/\r/m', "", $strOut);
		//	$strOut = preg_replace('/[\x40\0xa1a1]/m', "&nbsp;", $strOut);
		
			return $strOut;
		}
		
		/*********************************
		* depiction：转换数据库框输出的内容
		@param p_strValue 需要转换的内容
		@returns string
		Creater：sun
		Create Date：2007-1-8
		**********************************/
		public function strDbConvert($p_strValue)
		{
			$strOut = preg_replace('/<br \/>/m', "\n", $p_strValue);
			$strOut = preg_replace('/&nbsp;/m', " ", $strOut);
		
			return $strOut;
		}
}
?>