<?php
	if( !class_exists('ShowPage') )
	{
		require_once(dirname(__FILE__)."/../config.inc.php");
		include_once(CFG_LIB_DIR.'page.php');
	}
	
	if( !class_exists('mysqldb') )
	{
		require_once(dirname(__FILE__)."/../config.inc.php");
		include_once(CFG_LIB_DIR.'mysqldb.inc.php');
	}
	
	class clsManagePage extends ShowPage
	{
		public function GetResult($p_strColumns, $p_strTables, $p_strCondition, $p_intPageSize = 0, $p_blnHideCondition = false)
		{
			$this->PageSize = $p_intPageSize;
			if(!$p_blnHideCondition)
			{
				$this->LinkAry = array("con" => urlencode($p_strCondition));
			}
		
			$objDb = new mysqldb();
			
			$strSQL = "SELECT count(*) FROM $p_strTables WHERE 1 $p_strCondition";
			$objDb->query($strSQL);
			$totalResult = $objDb->get_data();
			$this->Total = $totalResult[0][0];
			
		    $strSQL = "SELECT $p_strColumns FROM $p_strTables WHERE 1 $p_strCondition".(($p_intPageSize == 0) ? "" : " LIMIT ".$this->OffSet());
			$objDb->query($strSQL);
			$Result = $objDb->get_data();
			
			$objDb->close();
			
			return $Result;
		}
		
		public function ShowLink()
		{
			$strOut  = "<table cellspacing=\"0\" cellpadding=\"0\" width=\"100%\"  class=\"listtable\">"."\n";
			$strOut .= "<tr>"."\n";
			$strOut .= "<th align=\"center\">".parent::ShowLink()."</th>"."\n";
			$strOut .= "</tr>"."\n";
			$strOut .= "</table>";
			
			return $strOut;
		}
	}
?>