<?php 
	if( !class_exists('mysqldb') )
	{
		require_once(dirname(__FILE__)."/../config.inc.php");
		include_once(CFG_LIB_DIR.'mysqldb.inc.php');
	}
	class clsPurviewList extends mysqldb
	{
		function arrPurviewList($p_strTableName = '', $p_strOrder = '', $p_strField = '')
		{
			$strTableName = con_strPREFIX.$p_strTableName;
			$Order = $p_strOrder? " order by ".$p_strField." desc" : " order by ".$p_strField." desc";
			$sql = "select * from ".$strTableName.$Order;
			parent::query($sql);
		  $arrRsData = parent::get_data();
			return $arrRsData;
		}
	}
?>