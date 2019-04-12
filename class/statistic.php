<?php
		if( !class_exists('mysqldb') )
		{
			require_once(dirname(__FILE__)."/../config.inc.php");
			include_once(CFG_LIB_DIR.'mysqldb.inc.php');
		}
		class clsStat extends mysqldb
		{
				/*     获取供应信息量 */
				function GetSndCount($intCateID)
				{
						$SndSql = "SELECT count(*) FROM `".con_strPREFIX."supplyndemand` where `CateID` = $intCateID";
						parent::query($SndSql);
						$intSndCount = parent::getOne();
						return $intSndCount;
				}
				/*     获取企业单位数量 */
				function GetMebCount($CmpProvince)
				{
						$MebSql = "SELECT count(*) FROM `".con_strPREFIX."member` where `CmpProvince` = $CmpProvince";
						parent::query($MebSql);
						$intMebCount = parent::getOne();
						return $intMebCount;
				}
		}
?>