<?php
	if( !class_exists('mysqldb') )
	{
		require_once(dirname(__FILE__)."/../config.inc.php");
		include_once(CFG_LIB_DIR.'mysqldb.inc.php');
	}
	
class clsCopyRight extends mysqldb{

		
	/****************************************************************/
	/*     得到指定表的某个指定字段，在系统中用于得到分类的名称     */
	/*                                                              */
	/*     $TableName    表名                                       */
	/*     $IDField      ID号字段名称                               */
	/*     $NameField    名称字段名称                               */
	/*     $SortID       ID值                                       */
	/****************************************************************/
	function CopyRight($Lang){
		$sql = "SELECT * FROM ".con_strPREFIX."copyright WHERE `Lang`='".$Lang."' ORDER BY CopyrightID DESC LIMIT 1";
		//echo $sql;
		parent::query($sql);
		$result = parent::get_data();
		return $result[0];
	}
}
?>