<?php
include_once("../../config.inc.php");
include_once (CFG_LIB_DIR.'generic.lib.php');
class clsSearch extends clsBase{
    /*
		$p_strHostByname : 查询的表的别名;
		$p_arrTableByname : 相关联查询的表的别名，别名之间用","隔开;
		$p_arrSearchField　：　要关联查询的字段，与$p_arrTableByname一一对对应，各字段间用","隔开.
		*/
    function __construct($p_strHostByname = '', $p_arrTableByname = '', $p_arrSearchField = ''){
				$this->strHostByname = $p_strHostByname;
        $this->arrTableByname = $p_arrTableByname;
        $this->arrSearchField = $p_arrSearchField;
    }
		function strSearchSql($arrRequest)
		{	
				$intTime = time();
				$strSqlWhere = "";
				/*
				按获取的字段匹配关键字搜索
				*/
				$arrTable = array();
				$arrField = array();
				$arrCondition = array();
				$arrTable = explode(",", $this->arrTableByname);
				$arrField = explode(",", $this->arrSearchField);
				if($arrRequest['Tag'] and $arrRequest['Field'])
				{
					foreach($arrRequest['Field'] as $field)
						{ 
						
						   $strKeyword = (intval(strpos($field, "ID")) === 0) ? "%".$arrRequest['Tag']."%" : $arrRequest['Tag'];
								if($this->strHostByname)
								{		
									  if(in_array($field,$arrField))
										{
											foreach($arrField as $key => $strField)
											{
												if($field == $strField)
												{
													$arrCondition[] = $arrTable[$key].".".$field." like '%".$arrRequest['Tag']."%' ";
													break;
												}
											}
									 }
									 else
									 {
											$arrCondition[] = $this->strHostByname.".".$field." like '$strKeyword' ";
									 }
								}
								else
								{
								$arrCondition[] = $field." like '$strKeyword' ";
								}
						}
						$strSqlWhere .= " and (". implode(" or ", $arrCondition).")";
				}
			
				/*
				按选择的搜索类别搜索
				分三大类：未发布文档、已发布文档、所有文档
				*/
				if($arrRequest['IsAuditing'] != 2 and $arrRequest['IsAuditing'] != "")
				{
						if($this->strHostByname)
						{
						$strSqlWhere .= " and ".$this->strHostByname.".IsAuditing = ".$arrRequest['IsAuditing'];
						}
						else
						{
						$strSqlWhere .= " and IsAuditing = ".$arrRequest['IsAuditing'];
						}
				}
				/*
				按获取的类别ID号搜索
				*/
				if(!empty($arrRequest['CateID']))
				{
						$arrCateID = array();
						foreach($arrRequest['CateID'] as $arrVal){
								$arrCateID[] = $arrVal;
						}
						if(is_array($arrCateID)){
								$strCateID = implode(",", $arrCateID);
								if($this->strHostByname)
								{
								$strSqlWhere .= " and ".$this->strHostByname.".CateID in (".$strCateID.")";
								}
								else
								{
								$strSqlWhere .= " and CateID in (".$strCateID.")";
								}
						}
				}
				
				/*
				会员等级
				*/
				if(!empty($arrRequest['Role']))
				{
						if($this->strHostByname)
						{
						$strSqlWhere .= " and ".$this->strHostByname.".Role = ".$arrRequest['Role'];
						}
						else
						{
						$strSqlWhere .= " and Role = ".$arrRequest['Role'];
						}
				}

				/*
				按时间搜索
				*/
				if($arrRequest['PublishDate'])
				{
						$intSearchTime = $arrRequest['PublishDate'] * 24 * 60 * 60;//计算以"秒"为单位的查询时间;
						//echo date("Y-m-j", $intTime - $intSearchTime);
						if($this->strHostByname)
						{
						$strSqlWhere .= " and ".$this->strHostByname.".PublishDate >= ".$intTime." - ".$intSearchTime." and PublishDate <= ".$intTime;
						}
						else
						{
						$strSqlWhere .= " and PublishDate >= ".$intTime." - ".$intSearchTime." and PublishDate <= ".$intTime;
						}
				}
				/*
				排序方法
				*/
				if($arrRequest['TaxisField']&&$arrRequest['Taxis'])
				{
						if($this->strHostByname)
						{
						$strSqlOrder = " order by ".$this->strHostByname.".".$arrRequest['TaxisField']." ".$arrRequest['Taxis'];
						}else{
						$strSqlOrder = " order by ".$arrRequest['TaxisField']." ".$arrRequest['Taxis'];
						}
				}
			$SqlSentence=$strSqlWhere.$strSqlOrder;
			return $SqlSentence;
			}
}
?>
