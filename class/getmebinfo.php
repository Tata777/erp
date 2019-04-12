<?php
	if( !class_exists('mysqldb') )
	{
		require_once(dirname(__FILE__)."/../config.inc.php");
		include_once(CFG_LIB_DIR.'mysqldb.inc.php');
	}
	
class clsMebInfo extends mysqldb{

	/****************************************************************/
	/*                                                              */
	/*     $strID       ID值                                       */
	/****************************************************************/
	
  function GetMebInfo($strID){
        $sql = "SELECT * FROM `".con_strPREFIX."member` WHERE MemberID= $strID";
				//echo $sql;
        parent::query($sql);
				$Tempres = parent::get_data();
				$res = $Tempres[0];
         return $res;
    }
}