<?php	
	if( !class_exists('mysqldb') )
	{
		require_once(dirname(__FILE__)."/../config.inc.php");
		include_once(CFG_LIB_DIR.'mysqldb.inc.php');
	}
	
	class clsRelation extends mysqldb
	{		
		/**************************************************************
		depiction：过滤'关键字'的分隔符号，将全角"、","空格","，"转换成半角","号
		@param p_strTag '关键字'
		@returns string
		Creater：sun
		Create Date：2007-12-14
		***************************************************************/
		public function strTagFilter($p_strTag)
		{
			//return preg_replace("/[、|　|，]+/s", ",", trim($p_strTag));
			return $p_strTag;
		}
		
		/**************************************************************
		depiction：查找关联'关键字'的ID号码，以","号隔开
		@param p_strTag '关键字'
		@param p_strTable 表名
		@param p_strIDcolumn 主键字段名
		@param p_strTagColumn '关键字'字段名
		@param p_strID ID号
		@returns string
		Creater：sun
		Create Date：2007-12-14
		***************************************************************/
		public function strGetRelationID($p_strTag, $p_strTable, $p_strIDcolumn, $p_strTagColumn, $p_strID = '')
		{
			$strTag = $this->strTagFilter($p_strTag);
			
			if(strlen($strTag) > 0)
			{
				$arrKeywords = explode(",", $strTag);
				foreach($arrKeywords as &$value)
				{
					$value = "`".$p_strTagColumn."` LIKE '%".$value."%'";
				}
				$condition = implode(" OR ", $arrKeywords);
				
				$condition = ($p_strID) ? "$p_strIDcolumn <> $p_strID AND (".$condition.")" : $condition;
				
				parent::query("SELECT `$p_strIDcolumn` FROM `$p_strTable` WHERE $condition ORDER BY `$p_strIDcolumn` DESC");
				$result = parent::get_data();
				
				$arrRelationID = array();
				if(is_array($result))
				{
					foreach($result as $value)
					{
						array_push($arrRelationID, $value[$p_strIDcolumn]);
					}
				}
				
				return implode(",", $arrRelationID);
			}
			else
				return '';
		}
	}
?>