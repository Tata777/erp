<?php 
/*产品输出
	$strTable  表名;
	$strCate   类别ID(多个ID以逗号分开);
	$intExtractNum　是否为精华产品;
	$intTopNum  是否置顶;
	$strOrder  排序;
	$strLimit  产品输出数量限制.
*/
	if( !class_exists('mysqldb') )
	{
		require_once(dirname(__FILE__)."/../config.inc.php");
		include_once(CFG_LIB_DIR.'mysqldb.inc.php');
	}
class clsProList extends mysqldb{
	function ProList($strTable='',$strCate='',$intExtractNum=0,$intTopNum=0,$strOrder='',$strLimit='')
	{
		$strSqlWhere = " WHERE 1";
		$strSqlWhere .= $strCate?" and CateID in(".$strCate.")" : '';
		$strSqlWhere .= $intExtractNum?" and  ExtractNum= $ExtractNum" : '';
		$strSqlWhere .= $intTopNum?" and  TopNum= $TopNum" : '';
		$strOrder = $strOrder ? $strOrder : ' ORDER BY `SortNum` ASC ';
		$strLimit = $strLimit ? $strLimit : '';
		$sql = "SELECT * FROM {$strTable}".$strSqlWhere.$strOrder.$strLimit;
		//echo $sql;
		return parent::getAll($sql);
	}
	function RecList($strOrder='',$strLimit='')
	{
		$strSqlWhere = " WHERE 1";
		$strOrder = $strOrder ? $strOrder : ' ORDER BY `SortNum` ASC ';
		$strLimit = $strLimit ? $strLimit : '';
		$sql = "SELECT * FROM `".con_strPREFIX."recruitment`".$strSqlWhere.$strOrder.$strLimit;
		//echo $sql;
		return parent::getAll($sql);
	}
}
?>
