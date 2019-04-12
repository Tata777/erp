<?php
	if( !class_exists('mysqldb') )
	{
		require_once(dirname(__FILE__)."/../config.inc.php");
		include_once(CFG_LIB_DIR.'mysqldb.inc.php');
	}
	
	class clsSelCate extends mysqldb
	{
			/**
			 * 生成"select"表单元素
			 * $intParentID     父分类ID号     
			 * $intSelectedID   所要选中的分类ID号
			 * $strTableName    表名
			 * $strFormName     Select的名称和ID号
			 * $intFormSize			Select的size属性的设置
			 * $strFormMultiple	select的multiple的设置
			 * $strJs           js调用
			 * $IsTrue          需要循环调用
			 * $IsOption    　　 select首项选项是否为空
			 */
			 function strSelCate($intParentID = 1, $intSelectedID = "", $strTableName = "", $strFormName = "", $intFormSize = "", $strFormMultiple = "", $strJs = "", $IsTrue = 1, $IsOption = 0)
			 {		
			    $SelCate = $IsOption ? "<option value=\"\">请选择类别</option>" : "";
					$SelCate .= $this->strOptions($intParentID = 1, $intSelectedID, $strTableName, $IsTrue);
					$intFormSize = $intFormSize ? " size=\"$intFormSize\"" : '';
					$strFormMultiple = $strFormMultiple ? " multiple=\"$multiple\"" : '';
					$strJs = $strJs ? $strJs:"";
					$SelCate = "<select id=\"$strFormName\" name=\"$strFormName\" $intFormSize $strFormMultiple $strJs>"."\n".$SelCate."</select>"."\n";
					return $SelCate;
			}
			
			function strOptions($intParentID = 1, $intSelectedID = "", $strTableName = "", $IsTrue = "")
			{
					$IfSelect = "";
					$strOptions = "";
					$sql = "select * from ".$strTableName." where ParentID = $intParentID  order by SortNum asc";
					parent::query($sql);
					$result = parent::get_data();
					if($result)
					{
						foreach($result as $arrVal)
						{
								// 输出当前结点信息
								$CateID = $arrVal['0'];
								if(is_array($intSelectedID))
								{
									$IfSelect = (in_array($CateID, $intSelectedID)) ? "selected=\"selected\"" : "";
								}
								else
								{
									$IfSelect = ($CateID == $intSelectedID) ? "selected=\"selected\"" : "";
								} 
		/*						$BgColor = '';
								if ($arrVal['ParentID'] == 1) {
										$BgColor = ' style="background-color: #99f; color:#FFFFFF" ';
								}*/
								$strOptions .= "<option value=\"$CateID\" " . $IfSelect .$BgColor. ">" . str_repeat("&nbsp;&nbsp;", $arrVal['Level']-1) . "┠" . $arrVal['CateName']."</option>"."\n";
								if($arrVal['HasChild']==1){
								$strOptions .= $this->strOptions($arrVal[0], $intSelectedID, $strTableName);
								}
						}
					}
					return $strOptions;
			}
		
			/**************************************************************************
			depiction：以下拉框形式输出时间段
			@param p_strElementName 需要输出的Element Name
			@param p_strSelectedTime 默认选中的时间
			@returns string
			Creater：sun
			Create Date：2007-12-26
			***************************************************************************/
			public function strSelTime($p_strElementName, $p_strSelectedTime = "")
			{
        $strOut  = "<select name=\"$p_strElementName\" id=\"$p_strElementName\">"."\n";
        $strOut .= "<option value=\"0\" ".(($p_strSelectedTime == "0") ? "selected=\"selected\"" : "").">---不限制---</option>"."\n";
        $strOut .= "<option value=\"86400\" ".(($p_strSelectedTime == "86400") ? "selected=\"selected\"" : "").">一天以来</option>"."\n";
        $strOut .= "<option value=\"172800\" ".(($p_strSelectedTime == "172800") ? "selected=\"selected\"" : "").">两天以来</option>"."\n";
        $strOut .= "<option value=\"604800\" ".(($p_strSelectedTime == "604800") ? "selected=\"selected\"" : "").">一周以来</option>"."\n";
        $strOut .= "<option value=\"1209600\" ".(($p_strSelectedTime == "1209600") ? "selected=\"selected\"" : "").">两周以来</option>"."\n";
        $strOut .= "<option value=\"2592000\" ".(($p_strSelectedTime == "2592000") ? "selected=\"selected\"" : "").">一个月以来</option>"."\n";
        $strOut .= "<option value=\"7948800\" ".(($p_strSelectedTime == "7948800") ? "selected=\"selected\"" : "").">三个月以来</option>"."\n";
        $strOut .= "<option value=\"15897600\" ".(($p_strSelectedTime == "15897600") ? "selected=\"selected\"" : "").">六个月以来</option>"."\n";
        $strOut .= "<option value=\"31536000\" ".(($p_strSelectedTime == "31536000") ? "selected=\"selected\"" : "").">一年以来</option>"."\n";
        $strOut .= "</select>"."\n";
				
				return $strOut;
			}
		
			/**************************************************************************
			depiction：输出排序字段
			@param p_strElementName 需要输出的Element Name
			@param p_arrOption 所有选项数组
			@param p_strSelectedValue 默认选中的项值
			@returns string
			Creater：sun
			Create Date：2007-12-26
			***************************************************************************/
			public function strSelOrderColumn($p_strElementName, $p_arrOption, $p_strSelectedValue = "")
			{
        $strOut  = "<select name=\"$p_strElementName\" id=\"$p_strElementName\">"."\n";
				$strOut .= "<option value=\"\">------</option>"."\n";
				
				if(is_array($p_arrOption))
				{
					foreach($p_arrOption as $value)
					{
						$strSelected = ($p_strSelectedValue == $value[0]) ? "selected=\"selected\"" : "";
						$strOut .=  "<option value=\"$value[0]\" $strSelected>$value[1]</option>"."\n";
					}
				}
				
				$strOut .= "</select>"."\n";
				return $strOut;
			}
		
			/**************************************************************************
			depiction：输出排序顺序
			@param p_strElementName 需要输出的Element Name
			@param p_strSelectedValue 默认选中的项值
			@returns string
			Creater：sun
			Create Date：2007-12-26
			***************************************************************************/
			public function strSelOrder($p_strElementName, $p_strSelectedValue = "")
			{
        $strOut  = "<select name=\"$p_strElementName\" id=\"$p_strElementName\">"."\n";
				$strOut .= "<option value=\"\">------</option>"."\n";
				
				$strOut .= "<option value=\"ASC\" ".(($p_strSelectedValue == "ASC") ? "selected=\"selected\"" : "").">递增</option>"."\n";
				$strOut .= "<option value=\"DESC\" ".(($p_strSelectedValue == "DESC") ? "selected=\"selected\"" : "").">递减</option>"."\n";
				
				$strOut .= "</select>"."\n";
				return $strOut;
			}
		
			/**************************************************************************
			depiction：以Radio形式输出'供求类型'
			@param p_strElementName 需要输出的Element Name
			@param p_strCheckedValue 默认选中的项值
			@param p_blnDisplayNoLimited 是否显示'不限制'
			@returns string
			Creater：sun
			Create Date：2007-12-28
			***************************************************************************/
			public function strRadSndCate($p_strElementName, $p_strCheckedValue = "", $p_blnDisplayNoLimited = false)
			{
				$intCount = 0;
				
				$strOut = ($p_blnDisplayNoLimited) ? "<input type=\"radio\" name=\"$p_strElementName\" id=\"{$p_strElementName}{$intCount}\" value=\"0\" checked=\"checked\" /> <label for=\"{$p_strElementName}".($intCount++)."\">不限制</label>"."\n" : "";			
				
				$strSQL = "SELECT `SndTypeID`, `CateName` FROM `".con_strPREFIX."sndtype` ORDER BY `SortNum`";
				parent::query($strSQL);
				$RadioResult = parent::get_data();
				
				if(is_array($RadioResult))
				{
					foreach($RadioResult as $value)
					{
						$strSelected = ($p_strCheckedValue == $value['SndTypeID']) ? "checked=\"checked\"" : "";
						$strOut .=  "<input type=\"radio\" name=\"$p_strElementName\" id=\"{$p_strElementName}{$intCount}\" value=\"{$value['SndTypeID']}\" $strSelected /> <label for=\"{$p_strElementName}".($intCount++)."\">{$value['CateName']}</label>"."\n";
					}
				}
				
				return $strOut;
			}
		
			/**************************************************************************
			depiction：以下拉框形式输出'供求有效期'
			@param p_strElementName 需要输出的Element Name
			@param p_strCheckedValue 默认选中的项值
			@returns string
			Creater：sun
			Create Date：2007-12-28
			***************************************************************************/
			public function strSelSndDay($p_strElementName, $p_strCheckedValue = "")
			{				
        $strOut = "<select name=\"$p_strElementName\" id=\"$p_strElementName\">"."\n";
				
				$strSQL = "SELECT `CateName`, `Day` FROM `".con_strPREFIX."sndday` ORDER BY `SortNum`";
				parent::query($strSQL);
				$RadioResult = parent::get_data();
				
				if(is_array($RadioResult))
				{
					foreach($RadioResult as $value)
					{
						$strSelected = ($p_strCheckedValue == $value['Day']) ? "selected=\"selected\"" : "";
						$strOut .= "<option value=\"{$value['Day']}\" $strSelected />{$value['CateName']}</option>"."\n";
					}
				}
				
				$strOut .= "</select>"."\n";
				
				return $strOut;
			}
		
			/**************************************************************************
			depiction：以单选框形式输出'不发布/发布'
			@param p_strElementName 需要输出的Element Name
			@param p_strCheckedValue 默认选中的项值
			@param p_strAllLabel 需要输出的Label 值,以'/'号分隔
			@returns string
			Creater：sun
			Create Date：2008-1-10
			***************************************************************************/
			public function strRadPublish($p_strElementName, $p_strCheckedValue = "1", $p_strAllLabel = '不发布/发布')
			{
				$arrLabel = explode("/", $p_strAllLabel);
				static $intIDCount = 0;
				for($intCount = 1; $intCount >= 0; $intCount--)
				{
					$strChecked = ($p_strCheckedValue == $intCount) ? 'checked="checked"' : '';
					$strElementID = preg_replace("/[\[\]]/", "", $p_strElementName.$intIDCount.$intCount);
					$strOut .= "<input type=\"radio\" name=\"{$p_strElementName}{$intIDCount}\" id=\"$strElementID\" value=\"{$intCount}\" $strChecked /> <label for=\"$strElementID\">{$arrLabel[$intCount]}</label>"."\n";
				}
				$intIDCount++;
				return $strOut;
			}
		
			/**************************************************************************
			depiction：以下拉框形式输出在线调查'问卷'
			@param p_strElementName 需要输出的Element Name
			@param p_strCheckedValue 默认选中的项值
			@returns string
			Creater：sun
			Create Date：2007-1-10
			***************************************************************************/
			public function strSelResearchCate($p_strElementName, $p_strCheckedValue = "")
			{				
        $strOut  = "<select name=\"$p_strElementName\" id=\"$p_strElementName\">"."\n";
        $strOut .= "<option value=\"-1\">----请选择问卷----</option>"."\n";
				
				$strSQL = "SELECT * FROM `".con_strPREFIX."researchcategory`";
				parent::query($strSQL);
				$RadioResult = parent::get_data();
				
				if(is_array($RadioResult))
				{
					foreach($RadioResult as $value)
					{
						$strSelected = ($p_strCheckedValue == $value['id']) ? "selected=\"selected\"" : "";
						$strOut .= "<option value=\"{$value['id']}\" $strSelected>{$value['sortName']}</option>"."\n";
					}
				}
				
				$strOut .= "</select>"."\n";
				
				return $strOut;
			}
	}
	
?>