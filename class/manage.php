<?php
	class clsManage
	{		
		private $intCount = 0; //临时计数器，用于输入element的唯一ID号
		public $intSubStrLen = 24; //截取Text字符串的长度
		public $blnSubStrDot = true; //截取Text字符串后显示'...'
		
		/**************************************************************
		depiction：截字函数
		@param p_strIn 需要截取的字符串
		@param p_intLen 截取长度
		@param p_blnDot 是否显示"..."
		@returns string
		Creater：sun
		Create Date：2007-12-15
		***************************************************************/
		public function strSubString($p_strIn, $p_intLen, $p_blnDot)
		{
			preg_match_all("/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/", $p_strIn, $arrCharacter);
			if (count($arrCharacter[0])>$p_intLen)
			{ 
				return join("", array_slice($arrCharacter[0], 0, $p_intLen)).($p_blnDot == true ? "..." : ""); 
			} 
			
			return join("",array_slice($arrCharacter[0], 0, $p_intLen));
		}
		
		public function strHead($p_arrColumnTips)
		{
			$strOut  = "<table cellspacing=\"0\" cellpadding=\"0\" width=\"100%\"  class=\"listtable\">"."\n";
			$strOut .= "<tr>"."\n";
			
			foreach($p_arrColumnTips as $value)
			{
				$intWidth = (isset($value["width"])) ? 'width="'.$value["width"].'"' : '';
				$strOut .= "<th $intWidth>".$value["tips"]."</th>"."\n";
			}
			
			$strOut .= "</tr>"."\n";
			return $strOut;
		}
		
		public function strLast()
		{
			$strOut  = "</table>";
			return $strOut;
		}
		
		protected function strEstimate($p_arrRecord, $p_strElement, $strEntity)
		{
			$this->intCount++;
			switch($p_strElement)
			{
				//显示'选择'多选框
				case "CheckBox":
					$strOut = "<input type=\"checkbox\" name=\"Item\" id=\"Item{$this->intCount}\" value=\"{$p_arrRecord[$strEntity]}\" />";
					break;
					
				//显示排序输入框
				case "Sort":
					$strOut = "<input type=\"text\" name=\"SortNum\" id=\"SortNum{$this->intCount}\" size=\"5\" value=\"{$p_arrRecord[$strEntity]}\" onblur=\"CheckNum(this)\" />";
					break;
					
				//显示文本
				case "Text":
					$strOut = $p_arrRecord[$strEntity];
					break;
					
				//判断是否有图片
				case "Img":
					$strOut = ($p_arrRecord[$strEntity]) ? " <img src=\"../images/image.gif\" />" : "";
					break;
					
				//显示日期
				case "Date":
					$strOut = date("Y-m-j", $p_arrRecord[$strEntity]);
					break;
					
				case "Sex":
					$strOut = ($p_arrRecord[$strEntity]=='1') ? '男' : '女';
					break;		
				//判断 '√'/'×'
				case "TickOff":
					$strOut = ($p_arrRecord[$strEntity]) ? '√' : '×';
					break;
				//语言板本 '中文'/'英文'
				case "LangSelect":
					$strOut = ($p_arrRecord[$strEntity]=='cn') ? '中文' : '英文';
					break;
				//模板，{字段名}可以读取数据对应字段内容
				case "Tmp":
					$var_regexp = "{([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)}";					
					$date_regexp = "{date\(([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)\)}";
					
					$strOut = preg_replace("/$var_regexp/es", "\$p_arrRecord['\\1']", $strEntity);
					$strOut = preg_replace("/$date_regexp/es", "date('Y-m-j H:i:s', \$p_arrRecord['\\1'])", $strOut);
					break;
			}
			
			return $strOut;
		}
		
		
		/**************************************************************
		depiction：输出中部管理页面
		@param p_arrDataSet 数据库查出的数据集合
		@param p_arrColumns 显示字段
		格式:
		array(
					array(显示类型 => 对应数据库字段/模板内容),
					}
		
		
		@returns string
		Creater：sun
		Create Date：2007-12-15
		***************************************************************/
		public function strMiddle($p_arrDataSet, $p_arrColumns)
		{
			$strOut = "";
			if(is_array($p_arrDataSet))
			{
				foreach($p_arrDataSet as $arrRecord)
				{
					$strOut .= "<tr onmouseover=\"chgColor(this, 'over');\" onmouseout=\"chgColor(this, 'out');\" align=\"center\">"."\n";
					foreach($p_arrColumns as $key => $p_arrColumn)
					{
						$strOut .= (strval($key) == "Title") ? "<td align=\"left\">" : "<td>";
						foreach($p_arrColumn as $strElement => $strEntity)
						{
							$strOut .= $this->strEstimate($arrRecord, $strElement, $strEntity);
						}
						$strOut .= "</td>"."\n";
					}
					$strOut .= "</tr>"."\n";
				}
			}
			
			return $strOut;
		}
	}
?>