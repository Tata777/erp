<?php
	if( !class_exists('mysqldb') )
	{
		require_once(dirname(__FILE__)."/../config.inc.php");
		include_once(CFG_LIB_DIR.'mysqldb.inc.php');
	}
	
class clsCategory extends mysqldb{

	/****************************************************************/
	/*     得到指定表的某个指定字段，在系统中用于得到分类的名称     */
	/*                                                              */
	/*     $TableName    表名                                       */
	/*     $IDField      ID号字段名称                               */
	/*     $NameField    名称字段名称                               */
	/*     $SortID       ID值                                       */
	/****************************************************************/
	
  function GetSortName($TableName,$IDField,$NameField='*',$SortID){
        $sql = "SELECT $NameField FROM $TableName WHERE $IDField = $SortID";
				//echo $sql;
        parent::query($sql);
				$res = parent::getRow();
/*				echo "<pre>";
				var_dump($res);
				echo "</pre>";*/
        if($res){
            return $res[$NameField];
        }else{
            return "类别不存在！";
        }
    }
		
	/****************************************************************/
	/*     得到指定表的某个指定字段，在系统中用于得到分类的名称     */
	/*                                                              */
	/*     $TableName    表名                                       */
	/*     $IDField      ID号字段名称                               */
	/*     $NameField    名称字段名称                               */
	/*     $SortID       ID值                                       */
	/****************************************************************/
	function GetSort($TableName = '',$IDField = '',$NameField='*',$SortID = '',$limit='',$order=''){
		$limit = $limit ? " LIMIT ".$limit : "";
		$order = $order ? $order : "";
		$sql = "SELECT $NameField FROM $TableName WHERE $IDField = $SortID ".$order.$limit;
		//echo $sql;
		parent::query($sql);
		$result = parent::get_data();
		return $result;
	}
	//递归输出类别
	function GetSortId($TableName = '',$IDField = '',$NameField='*',$SortID = '',$strIndex = '')
	{
			$sql = "SELECT $NameField FROM $TableName WHERE $IDField = $SortID OR $NameField = $SortID";
			$arrSecCateId = parent::getAll($sql);

			$arrCateId = array();
			//echo $strIndex;
			for($i=0; $i < count($arrSecCateId); $i++){
					$arrCateId[] = $arrSecCateId[$i][$strIndex];
			}
			$strCateId=implode(",", $arrCateId);
			//var_dump($arrCateId);
			return $strCateId;
	}
}
?>