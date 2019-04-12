<?php
	if( !class_exists('clsOperationBase') )
	{
		require_once(dirname(__FILE__)."/../config.inc.php");
		include_once(CFG_LIB_DIR.'operation.php');
	}
	
	class clsPreview extends clsOperationBase
	{
	
		/**************************************************************
		depiction：输出信息预览表格
		@param p_strTable 数据库表名
		@param p_arrColumn 显示字段
		@param p_strIDColumn 主键字段名
		@param p_strID ID号
		@returns null
		Creater：sun
		Create Date：2007-12-25
		***************************************************************/
		function vodPrintPreview($p_strTable, $p_arrColumn, $p_strIDColumn, $p_strID)
		{//echo "<pre>"; print_r($p_arrColumn); echo "</pre>"; exit();
			$strSQL = "SELECT * FROM $p_strTable WHERE $p_strIDColumn = $p_strID";
			parent::query($strSQL);
			$allResult = parent::get_data();
			$Result = $allResult[0];
			$strOut = "<table cellspacing=\"0\" cellpadding=\"0\" width=\"100%\"  class=\"maintable\">"."\n";
			
			foreach($p_arrColumn as $key => $value)
			{
				switch($value["Type"])
				{
					case "Date":
						$value[1] = date("Y-m-d", $Result[$value[1]]);
						break;
						
					case "ReadingRight":
						$strSQL = "SELECT {$value['secColumn']} FROM {$value['secTable']} WHERE {$value['secIDColumn']} = {$Result[$value[1]]}";
						parent::query($strSQL);
						$tmpResult = parent::get_data();
						
						$value[1] = ($tmpResult[0][0]) ? $tmpResult[0][0] : "所有浏览者";						
						break;
						
					case "SQL":
						$strSQL = "SELECT {$value['secColumn']} FROM {$value['secTable']} WHERE {$value['secIDColumn']} = {$Result[$value[1]]}";
						parent::query($strSQL);
						$tmpResult = parent::get_data();
						
						$value[1] = $tmpResult[0][0];
						break;
						
					case "Place":
                        $strSQL = "SELECT {$value['secColumn']} FROM {$value['secTable']} WHERE {$value['secIDColumn']} = {$p_strID}";
						parent::query($strSQL);
						$tmpResult = parent::get_data();
						
						$value[1] = $tmpResult[0][0]."-".$tmpResult[0][1];
						break;
	
						
					case "KB":
						$value[1] = $Result[$value[1]]."KB";
						break;
						
					case "Down":
						$value[1] = "<a href=\"{$value['Path']}{$Result[$value[1]]}\">{$Result[$value[1]]}</a>";
						break;	
						
						
					case "Boolean":
					$value[1] = ($Result[$value[1]]) ? "是" : "否";
					break;
					
					case "Sex":
					$value[1] = ($Result[$value[1]]) ? "男" : "女";
					break;
						
					case "Relation":					
						$strSQL = "SELECT * FROM  $p_strTable WHERE $p_strIDColumn in ({$Result[$value[1]]})";
						parent::query($strSQL);
						$tmpResult = parent::get_data();
						$tmpResultNum = parent::get_num();
						
						$value[1] = "";
						
						for($intCount = 0; $intCount < $tmpResultNum; $intCount++)
						{
							$value[1] .= "<a href=\"view.php?id=".$tmpResult[$intCount][$p_strIDColumn]."\">".$tmpResult[$intCount][$value['secColumn']]."</a><br />"."\n";
						}
						break;
						
					case "Link":
						$value[1] = "<a href=\"{$Result[$value[1]]}\">{$Result[$value[1]]}</a>";
						break;
						
					default:
						$value[1] = $Result[$value[1]];
						break;
				}
				
				$strOut .= "<tr><th width=\"20%\">".$value[0]."</th><td width=\"80%\">".$value[1]."</td></tr>"."\n";
			}
			
			$strOut .= "</table>";
			
			echo $strOut;
		}
	}
?>