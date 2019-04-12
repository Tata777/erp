<?php
	if( !class_exists('clsOperationBase') )
	{
		require_once(dirname(__FILE__)."/../config.inc.php");
		include_once(CFG_LIB_DIR.'operation.php');
	}
	
	class clsRoleSetting extends clsOperationBase
	{
		/**************************************************************
		depiction：获取所有会员组的阅读权限，并以下拉框输出
		@param $p_strElementName 需要输出的下拉框的Name和ID值
		@param $p_intRoleRight 需要选中项的权限值
		@param $p_strWithAllMember 是否输出'所有浏览者'
		@returns string
		Creater：sun
		Create Date：2007-12-13
		***************************************************************/
		public function strGetReadingRightForSelection($p_strElementName, $p_intRoleRight = "0", $p_blnWithAllMember = "yes")
		{
			$strOut = "<select name=\"$p_strElementName\" id=\"$p_strElementName\">"."\n";
			
			if($p_blnWithAllMember == "yes")
			{
				$strSelected = ($p_intRoleRight == 0) ? 'selected="selected"' : '';
				$strOut .= "<option value=\"0\" $strSelected>所有浏览者</option>"."\n";
			}
			
			parent::query("SELECT RoleName, ReadingRight FROM ".con_strPREFIX."RoleSetting ORDER BY ReadingRight");
			$selResult = parent::get_data();
			if(is_array($selResult))
			{
				foreach($selResult as $key => $value)
				{
					$strSelected = ($p_intRoleRight == $value['ReadingRight']) ? 'selected="selected"' : '';
					$strOut .= "<option value=\"{$value['ReadingRight']}\" $strSelected>{$value['RoleName']}</option>"."\n";
				}
			}
			
			$strOut .= "</select>"."\n";
			
			return $strOut;
		}
		
		/**************************************************************
		depiction：获取所有会员组ID，并以下拉框输出
		@param $p_strElementName 需要输出的下拉框的Name和ID值
		@param $p_intRoleID 需要选中项的ID值
		@returns string
		Creater：sun
		Create Date：2007-12-13
		***************************************************************/
		public function strGetRoleForSelection($p_strElementName, $p_intRoleID = "0")
		{
			$strOut = "<select name=\"$p_strElementName\" id=\"$p_strElementName\">"."\n";
			
			parent::query("SELECT RoleName, RoleSettingID FROM ".con_strPREFIX."RoleSetting ORDER BY ReadingRight");
			$selResult = parent::get_data();
			foreach($selResult as $key => $value)
			{
				$strSelected = ($p_intRoleID == $value['RoleSettingID']) ? 'selected="selected"' : '';
				$strOut .= "<option value=\"{$value['RoleSettingID']}\" $strSelected>{$value['RoleName']}</option>"."\n";
			}			
			
			$strOut .= "</select>"."\n";
			
			return $strOut;
		}
		
	}
?>