<?php
	include_once("../../config.inc.php");
	include_once(CFG_LIB_DIR.'mysqldb.inc.php');		
	$objDb = new mysqldb();
	$intParentID = $this->input['ParentID'];
	$CityID = $this->input['CityID'];
	$sql = "select * from ".con_strPREFIX."companycategory where ParentID = $intParentID order by SortNum asc";
	$objDb->query($sql);
	$result = $objDb->get_data();
	if($result)
	{
		foreach($result as $arrVal)
		{
				// 输出当前结点信息
				$CateID = $arrVal['0'];
				$strOptions  = "<option value=\"\"> </option>";
				if ($CityID == $CateID) {
						$IfSelect = "selected";
				} else {
						$IfSelect = "";
				} 
				$strOptions .= "<option value=\"$CateID\" " . $IfSelect . " class=\"city\">" . str_repeat("&nbsp;&nbsp;", $arrVal['Level']-1) . "┠" . $arrVal['CateName']."</option>"."\n";
		}
	}
echo $strOptions;
?>