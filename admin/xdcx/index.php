<?php
	$protectid="2"; 
	include("../protect.php");
	
	include_once("../../config.inc.php");	
	
	$strSqlWhere = "";
	if($_REQUEST['act'] == "advsearch")
	{
		include_once("../common/advsearchact.php");
		$objSearch = new clsSearch("i");
		$strSqlWhere=$objSearch->strSearchSql($_REQUEST);
	}
	else
	{
		$strSqlWhere = ($_GET['con']) ? $_GET['con'] : " ORDER BY i.`ID` DESC";
	}
	//	echo $strSqlWhere;
	include_once(CFG_LIB_DIR."manage_page.php");	
	$objManPage = new clsManagePage();
	
	//分页获取数据
	$InfoResult = $objManPage->GetResult('i.`ID`, i.`Title`, i.`SubTitle`,i.`FromSite`,i.`Intro`, s.`CateName`', '`'.con_strPREFIX.'xdcx` as i LEFT JOIN `'.con_strPREFIX.'city` as s ON i.`CateID` = s.`CityID` ', $strSqlWhere, 20);
/*echo "<pre>";
var_dump($InfoResult);
echo "</pre>";*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Administrator's Control Panel</title>
<?php include_once("../common/files.php"); ?>
</head>

<body id="main">
<table summary="" id="pagehead" cellpadding="0" cellspacing="0" border="0" width="100%">
	<tr>
		<td><h1>信息管理</h1></td>
		<td class="actions">
			<table summary="" cellpadding="0" cellspacing="0" border="0" align="right">
				<tr>
					<td class="active"><a href="index.php" class="view">信息管理</a></td>
					<td><a href="advsearch.php">高级搜索</a></td>
					<td><a href="#" class="add" onclick="return PopupWindow('info.php?act=add', 800, 600);">添加信息</a></td>	
				</tr>
			</table>
		</td>
	</tr>
</table>

<form method="post" action="index_ok.php"  onsubmit="return validManage('Item', 'SortNum', 'SelectedID', 'SelectedSort');">
<?php
	//输出 Manage Grid
	include_once(CFG_LIB_DIR.'manage.php');
	$objMan = new clsManage();
	
	$arrColumnTips = array(
										array("tips" => "选择", "width" => "5%"),
										array("tips" => "ID", "width" => "5%"),
 										array("tips" => "售点名称", "width" => "20%"),
										array("tips" => "信息分类", "width" => "10%"),
										array("tips" => "联系人", "width" => "10%"),
										array("tips" => "联系电话", "width" => "10%"),
									 
										array("tips" => "操作", "width" => "10%")
									 );
									 
	$arrColumn = array(
										array("CheckBox" => "ID"),
										array("Text" => "ID"),
									
										"Title" => 
										array(
												"Tmp" => "<a href=\"#\" onclick=\"PopupWindow('view.php?id={InfoID}', 800, 600)\">{Title}</a>",
												"Img" => "FirstPhoto"
													),
										array("Text" => "CateName"),
										array("Text" => "SubTitle"),
										array("Text" => "FromSite"),
									 
										array("Tmp" => "<sapn class=\"buttons\"><input type=\"button\" value=\"编辑\" class=\"submit\" onclick=\"PopupWindow('info.php?act=modify&id={ID}', 800, 600)\"></span>")
									 );
	
	echo $objMan->strHead($arrColumnTips);
	echo $objMan->strMiddle($InfoResult, $arrColumn);
	echo $objMan->strLast();
	
	
	//输出批量操作
	include_once(CFG_LIB_DIR.'batch_operation.php');
	$objBO = new clsBatchOperation();
	
////	$arrOperation = array ("RevChk", "Sort", "Auditing","PublishDate", "Copy", "Move", "Del");
//	$objBO->strCateTable = "CityID";
//	$arrBO = $objBO->strBottom($arrOperation, "Sort");
	
//	echo $arrBO[0].$arrBO[1];
	
	
	//输出分页
	echo $objManPage->ShowLink();
?>

<div class="buttons">
	<input type="hidden" name="SelectedID" id="SelectedID" />
	<input type="hidden" name="SelectedSort" id="SelectedSort" />
  <input type="submit" value="提交保存" class="submit" />
  <input type="reset" value="重置" />
</div>
</form>

<br />
<?php include "../bottom.php"; ?>
</div>

</body>
</html>