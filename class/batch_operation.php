<?php
	/*****************************************************************
	FileName：batch_operation.php
	Creater：sun
	Create Date：2007-12-15
	Main Description：存放clsBatchOperation类，用于后台管理页面的显示、执行批量操作
	
	Copyright © HUYI Digital Technology Co.,Ltd. 2007. All Rights Reserved
	******************************************************************/

	if( !class_exists('clsOperationBase') )
	{
		require_once(dirname(__FILE__)."/../config.inc.php");
		include_once(CFG_LIB_DIR.'operation.php');
	}
	if( !class_exists('clsSelCate') )
	{
		require_once(dirname(__FILE__)."/../config.inc.php");
		include_once(CFG_LIB_DIR.'selector.php');
	}
	if( !class_exists('clsRoleSetting') )
	{
		require_once(dirname(__FILE__)."/../config.inc.php");
		include_once(CFG_LIB_DIR.'role_setting.php');
	}

	class clsBatchOperation extends clsOperationBase
	{
		public $strCateTable; //分类表名
		private $intCount = 0; //临时计数器，用于输入element的唯一ID号码

		/**************************************************************
		depiction：用于输出Readio Element
		@param p_strOp 操作名称(英文)
		@param p_strOpTips 操作提示(中文)
		@param p_strChecked 是否选中，传入值为checked="checked"或''
		@param p_strRadioName Radio的Name
		@param p_strRadioValue Radio的Value
		@returns string
		Creater：sun
		Create Date：2007-12-15
		***************************************************************/
		protected function strReadio($p_strOp, $p_strOpTips, $p_strChecked, $p_strRadioName, $p_strRadioValue)
		{
			$this->intCount++;
			$strAction = "onclick=\"DisplaySubBO('{$p_strOp}TR')\"";
			$strOut  = "<input type=\"radio\" name=\"$p_strRadioName\" id=\"{$p_strOp}{$this->intCount}\" value=\"$p_strRadioValue\" $strAction $p_strChecked />"."\n";
			$strOut .= "<label for=\"{$p_strOp}{$this->intCount}\"> $p_strOpTips </label>"."\n";
			return $strOut;
		}
		
		protected function strTextInput($p_strOp)
		{
			$strOut = "<input type=\"text\" name=\"$p_strOp\" id=\"$p_strOp\" size=\"10\" value=\"9999\" onblur=\"CheckNum(this)\" />"."\n";
			return $strOut;
		}
		
		protected function strDateInput($p_strOp)
		{
			$this->intCount++;
			$strOut = '
			<input type="text" name="'.$p_strOp.'" id="'.$p_strOp.'" size="10" value="'.date("Y-m-j").'" onblur="CheckDate(this)" /> <span>*</span>
      <img src="../js/jscalendar/img.gif" id="f_trigger_c'.($this->intCount).'"
           style="cursor: pointer; border: 1px solid red;"
           title="Date selector"
           onmouseover="this.style.background=\'red\';"
           onmouseout="this.style.background=\'\'" />
      <script type="text/javascript">
          Calendar.setup({
              inputField     :    "'.$p_strOp.'",
              ifFormat       :    "%Y-%m-%d",
              button         :    "f_trigger_c'.($this->intCount).'",
              align          :    "Tl",
              singleClick    :    false
          });
      </script>
      (输入格式例如 : 2007-04-05)';
			return $strOut;
		}
		
		

		/**************************************************************************
		depiction：以下拉框形式输出'分类'，调用此函数前必须给本对象的strCateTable属性附值
		@param p_strOp 操作名称(英文)
		@returns string
		Creater：sun
		Create Date：2007-12-15
		***************************************************************************/
		protected function strCateSelect($p_strOp)
		{
			if(empty($this->strCateTable))
			{
				return "本对象的strCateTable属性还未附值！";
			}
			else
			{
				$SelCate = new clsSelCate();
				return $SelCate->strSelCate("1", '', con_strPREFIX.$this->strCateTable, $p_strOp);
			}
		}
		
		/**************************************************************************
		depiction：以下拉框形式输出'用户组'
		@param p_strOp 操作名称(英文)
		@returns string
		Creater：sun
		Create Date：2007-12-15
		***************************************************************************/
		protected function strRoleSelect($p_strOp)
		{
			if(!empty($this->strRoleTable))
			{
				return "本对象的strRoleTable属性还未附值！";
			}
			else
			{
				$objRole = new clsRoleSetting();
				return $objRole->strGetRoleForSelection($p_strOp);
			}
		}
		
		protected function strHead($p_strTrID, $p_strTips)
		{
			$strOut  = "<tr id=\"{$p_strTrID}TR\" style=\"display:none\">"."\n";
			$strOut .= "<th width=\"12%\">$p_strTips</th>"."\n";
			$strOut .= "<td>"."\n";
			return $strOut;
		}
		
		protected function strLast()
		{
			$strOut  = "</td>"."\n";
			$strOut .= "</tr>"."\n";
			return $strOut;
		}
		
		protected function arrOut($p_operation, $p_strChecked, $p_strRadioName)
		{
			$arrReturn = array();
			$strBL1 = "";
			$strBL2 = "";
			
			switch($p_operation)
			{
				case "RevChk":
					$strBL1  = "<input type=\"checkbox\" name=\"chkall\" id=\"chkall\" onclick=\"ReversSelected('Item')\" />"."\n";
					$strBL1 .= "<label for=\"chkall\"> 反选 </label>"."\n";
					$strBL2  = "";
					break;
					
				case "Sort":
					$strBL1  = $this->strReadio($p_operation, "更新", $p_strChecked, $p_strRadioName, $p_operation);
					$strBL2  = "";
					break;
					
				case "Auditing":
					$strBL1  = $this->strReadio($p_operation, "审核", $p_strChecked, $p_strRadioName, $p_operation);
					$strBL2  = $this->strHead($p_operation, "审核");
					$strBL2 .= $this->strReadio($p_operation, "已审核", 'checked="checked"', "sub".$p_operation, "1");
					$strBL2 .= $this->strReadio($p_operation, "未审核", '', "sub".$p_operation, "0");
					$strBL2 .= $this->strLast();
					break;
					
				case "Recommand":
					$strBL1  = $this->strReadio($p_operation, "推荐至首页中间图", $p_strChecked, $p_strRadioName, $p_operation);
					$strBL2  = $this->strHead($p_operation, "推荐");
					$strBL2 .= $this->strReadio($p_operation, "已推荐", 'checked="checked"', "sub".$p_operation, "1");
					$strBL2 .= $this->strReadio($p_operation, "未推荐", '', "sub".$p_operation, "0");
					$strBL2 .= $this->strLast();
					break;	
					
				case "Top":
					$strBL1  = $this->strReadio($p_operation, "置顶(设置为1即为头条新闻)", $p_strChecked, $p_strRadioName, $p_operation);
					$strBL2  = $this->strHead($p_operation, "置顶");
					$strBL2 .= $this->strTextInput("sub".$p_operation);
					$strBL2 .= $this->strLast();
					break;
					
				case "Extract":
					$strBL1  = $this->strReadio($p_operation, "精华", $p_strChecked, $p_strRadioName, $p_operation);
					$strBL2  = $this->strHead($p_operation, "精华");
					$strBL2 .= $this->strTextInput("sub".$p_operation);
					$strBL2 .= $this->strLast();
					break;
					
				case "PublishDate":
					$strBL1  = $this->strReadio($p_operation, "发布时间", $p_strChecked, $p_strRadioName, $p_operation);
					$strBL2  = $this->strHead($p_operation, "发布时间");
					$strBL2 .= $this->strDateInput("sub".$p_operation);
					$strBL2 .= $this->strLast();
					break;
					
				case "Copy":
					$strBL1  = $this->strReadio($p_operation, "复制", $p_strChecked, $p_strRadioName, $p_operation);
					$strBL2  = $this->strHead($p_operation, "复制到");
					$strBL2 .= $this->strCateSelect("sub".$p_operation);
					$strBL2 .= $this->strLast();
					break;
					
				case "Move":
					$strBL1  = $this->strReadio($p_operation, "移动", $p_strChecked, $p_strRadioName, $p_operation);
					$strBL2  = $this->strHead($p_operation, "移动到");
					$strBL2 .= $this->strCateSelect("sub".$p_operation);
					$strBL2 .= $this->strLast();
					break;
					
				case "Del":
					$strBL1  = $this->strReadio($p_operation, "删除", $p_strChecked, $p_strRadioName, $p_operation);
					$strBL2  = "";
					break;
					
				case "Role":
					$strBL1  = $this->strReadio($p_operation, "用户组", $p_strChecked, $p_strRadioName, $p_operation);
					$strBL2  = $this->strHead($p_operation, "用户组");
					$strBL2 .= $this->strRoleSelect("sub".$p_operation);
					$strBL2 .= $this->strLast();
					break;
					
				case "Lock":
					$strBL1  = $this->strReadio($p_operation, "锁定", $p_strChecked, $p_strRadioName, $p_operation, true);
					$strBL2  = $this->strHead($p_operation, "锁定");
					$strBL2 .= $this->strReadio($p_operation, "已锁定", '', "sub".$p_operation, "1");
					$strBL2 .= $this->strReadio($p_operation, "未锁定", 'checked="checked"', "sub".$p_operation, "0");
					$strBL2 .= $this->strLast();
					break;
			}
			
			array_push($arrReturn, $strBL1);
			array_push($arrReturn, $strBL2);
			return $arrReturn;
		}
		
		/**************************************************************************
		depiction：用于显示批量操作选项
		@param p_arrOperation 需要输出的操作
		@param p_strCheckedOperationName 默认选中的操作名字
		@param $p_strRadioName 输出操作项的Element Name，默认值为"BatchOperation"
		@param $p_strBottomTableID 包含所有子选项的Table ID，默认值为"BOTable"
		@returns array array[0]为批操作第一行, array[1]为批操作子选项行
		Creater：sun
		Create Date：2007-12-15
		***************************************************************************/
		public function strBottom ($p_arrOperation, $p_strCheckedOperationName, $p_strRadioName = "BatchOperation", $p_strBottomTableID = "BOTable")
		{
			$arrGetReturn = array();
			$arrReturn = array();
			$strBottomLine1 .= "<table cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" class=\"btmtable\">"."\n";
			$strBottomLine1 .= "<tr><th width=\"12%\">提示</th><th>*请填写排列序号从小到大排列 注9999为不参与排序</th></tr>";
			$strBottomLine1 .= "<tr><th width=\"12%\">批量操作</th><th>"."\n";			
			$strBottomLine2  = "<script type=\"text/javascript\">var strTableID = '$p_strBottomTableID';</script>";
			$strBottomLine2 .= "<table cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" class=\"btmtable\" id=\"$p_strBottomTableID\">";
		
			foreach($p_arrOperation as $value)
			{
				$strChecked = ($value == $p_strCheckedOperationName) ? 'checked="checked"' : '';
				$arrGetReturn = $this->arrOut($value, $strChecked, $p_strRadioName);
				
				$strBottomLine1 .= $arrGetReturn[0];
				$strBottomLine2 .= $arrGetReturn[1];
			}
			
			$strBottomLine1 .= "</table>";
			$strBottomLine2 .= "</table>";
			array_push($arrReturn, $strBottomLine1);
			array_push($arrReturn, $strBottomLine2);
			return $arrReturn;
		}
		
		
		/**************************************************************************
		depiction：用于执行批量操作
		@param p_strTable 操作表名称
		@param p_strPrimary 操作表主键
		@param p_strSucceedUrl 操作成功后跳转页面
		@param p_strRadioName 操作项的Element Name，默认值为"BatchOperatio
		@param p_strItemsName '选择'项的Element Name，默认值为SelectedID
		@param p_strSortName '排序'项的Element Name，默认值为SelectedSort
		Creater：sun
		Create Date：2007-12-15
		***************************************************************************/
		public function vodExecuteBO($p_strTable, $p_strPrimary, $p_strSucceedUrl, $p_strMemberColumn = '', $p_strMemberID = '', $p_strRadioName = "BatchOperation", $p_strItemsName = "SelectedID", $p_strSortName = "SelectedSort")
		{
			$blnResult = false;
			//限制批量操作信息仅属于某个会员的ID
			$strConditon = ($p_strMemberColumn) ? " AND $p_strMemberColumn = $p_strMemberID " : "";
			
			if(strlen($_POST[$p_strItemsName]) > 0)
			{
				$arrItem = explode(",", $_POST[$p_strItemsName]);		
				switch($_POST[$p_strRadioName])
				{						
					case "Sort":				
						$arrSort = explode(",", $_POST[$p_strSortName]);
						foreach($arrItem as $key => $value)
						{
							$strSQL = "UPDATE `$p_strTable` SET SortNum = {$arrSort[$key]} WHERE $p_strPrimary = $value $strConditon LIMIT 1";
							$blnResult = parent::query($strSQL);
						}
						break;
						
					case "Auditing":
						$strSQL = "UPDATE `$p_strTable` SET IsAuditing = {$_POST['subAuditing']} WHERE $p_strPrimary IN ({$_POST[$p_strItemsName]}) $strConditon";
						$blnResult = parent::query($strSQL);
						break;
						
					case "Recommand":
 					 	$strSQL = "UPDATE `$p_strTable` SET Recommand = {$_POST['subRecommand']} WHERE $p_strPrimary IN ({$_POST[$p_strItemsName]}) $strConditon";
						$blnResult = parent::query($strSQL);
						break;
						
					case "Top":
						$strSQL = "UPDATE `$p_strTable` SET TopNum = {$_POST['subTop']} WHERE $p_strPrimary IN ({$_POST[$p_strItemsName]}) $strConditon";
						$blnResult = parent::query($strSQL);
						break;
						
					case "Extract":
						$strSQL = "UPDATE `$p_strTable` SET ExtractNum = {$_POST['subExtract']} WHERE $p_strPrimary IN ({$_POST[$p_strItemsName]}) $strConditon";
						$blnResult = parent::query($strSQL);
						break;
						
					case "PublishDate":
						$strSQL = "UPDATE `$p_strTable` SET PublishDate = '".strtotime($_POST['subPublishDate'])."' WHERE $p_strPrimary IN ({$_POST[$p_strItemsName]}) $strConditon";
						$blnResult = parent::query($strSQL);
						break;
						
					case "Copy":
						$strSQL = "SHOW FIELDS FROM `$p_strTable`";
						parent::query($strSQL);
						$fieldsResult = parent::get_data();
						if($fieldsResult)
						{
							$arrFields = array();
							foreach($fieldsResult as $value)
							{
								if($value['Field'] != $p_strPrimary && $value['Field'] != "CateID")
								{
									array_push($arrFields, "`".$value['Field']."`");
								}
							}
							
							$strFields = implode(",", $arrFields);
						
							$strSQL = "INSERT INTO `$p_strTable` ($strFields, `CateID`) SELECT $strFields, '{$_POST['subCopy']}' FROM `$p_strTable` WHERE $p_strPrimary IN ({$_POST[$p_strItemsName]}) $strConditon";
							$blnResult = parent::query($strSQL);
						}
						break;
						
					case "Move":
						$strSQL = "UPDATE `$p_strTable` SET CateID = {$_POST['subMove']} WHERE $p_strPrimary IN ({$_POST[$p_strItemsName]}) $strConditon";
						$blnResult = parent::query($strSQL);
						break;
						
					case "Del":
						$strSQL = "DELETE FROM `$p_strTable` WHERE $p_strPrimary IN ({$_POST[$p_strItemsName]}) $strConditon";
						$blnResult = parent::query($strSQL);
						break;
						
					case "Role":
						$strSQL = "UPDATE `$p_strTable` SET Role = {$_POST['subRole']} WHERE $p_strPrimary IN ({$_POST[$p_strItemsName]}) $strConditon";
						$blnResult = parent::query($strSQL);
						break;
						
					case "Lock":
						$strSQL = "UPDATE `$p_strTable` SET IsLock = {$_POST['subLock']} WHERE $p_strPrimary IN ({$_POST[$p_strItemsName]}) $strConditon";
						$blnResult = parent::query($strSQL);
						break;
				}
			}
			
			if($blnResult)
				parent::popup('恭喜你操作成功', $p_strSucceedUrl);
			else
				parent::popup('对不起，操作失败');
		}
	}
?>