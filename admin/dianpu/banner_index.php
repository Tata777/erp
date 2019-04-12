<?php
	//产品管理ID号
	$protectid="14"; 
	include("../protect.php");
	
	include_once("../../config.inc.php");	
	
	if($_REQUEST['act'] == "advsearch")
	{
		include("../common/advsearchact.php");
		$objSearch = new clsSearch('p');
		$strSqlWhere=$objSearch->strSearchSql($_REQUEST);
	}
	else
	{
		$strSqlWhere = ($_GET['con']) ? $_GET['con'] : " ORDER BY p.`SysProductsID` DESC";
	}
		
	include_once(CFG_LIB_DIR."manage_page.php");	
	$objManPage = new clsManagePage();
	
	//分页获取数据
	$ProResult = $objManPage->GetResult('p.`SysProductsID`, p.`ProductName`, p.`FirstPhoto`, p.`PublishDate`, p.`ValidDate`, p.`SortNum`, p.`Lang`, b.`CateName` AS BrandName,  s.`CateName`', '`'.con_strPREFIX.'sys_products_banner` as p LEFT JOIN `'.con_strPREFIX.'sys_procategory` as s ON p.`CateID` = s.`SysProCategoryID` LEFT JOIN `'.con_strPREFIX.'brandcategory` as b ON p.`BrandID` = b.`BrandCategoryID`', $strSqlWhere, 20);
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
		<td><h1>广告管理中心</h1></td>
		<td class="actions">
			<table summary="" cellpadding="0" cellspacing="0" border="0" align="right">
				<tr>
					<td class="active"><a href="banner_index.php" class="view">浏览广告</a></td><td><a href="banner_advsearch.php">高级搜索</a></td>
					<td style="display:none;"><a href="#" class="add" onclick="return PopupWindow('banner_product.php?act=add', 800, 600);">发布广告图片</a></td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<form method="post" action="banner_index_ok.php"  onsubmit="return validManage('Item', 'SortNum', 'SelectedID', 'SelectedSort');">
<?php
	//输出 Manage Grid
	include_once(CFG_LIB_DIR.'manage.php');
	$objMan = new clsManage();
	
	$arrColumnTips = array(
										array("tips" => "选择", "width" => "26"),
										array("tips" => "ID", "width" => "30"),
										array("tips" => "排序", "width" => "60"),
										//array("tips" => "产品分类", "width" => "60"),
										array("tips" => "广告说明", "width" => "100"),
										array("tips" => "图片", "width" => "40%"),
										//array("tips" => "所属品牌", "width" => "60"),
										array("tips" => "发布日期", "width" => "80"),
										array("tips" => "执行操作", "width" => "60")
									 );
									 						 
	$arrColumn = array(
										array("CheckBox" => "SysProductsID"),
										array("Text" => "SysProductsID"),
										array("Sort" => "SortNum"),
										//array("Text" => "CateName"),
										"Title" => 
										array("Tmp" => "<a href=\"#\" onclick=\"PopupWindow('view.php?id={SysProductsID}', 800, 600)\">{ProductName}</a>",
												"Img" => "FirstPhoto"
													),
										array("Tmp" => "<img src=\"../../uploadfile/product/{FirstPhoto}\" width=200>"),
										//sarray("Text" => "BrandName"),
										array("Date" => "PublishDate"),
										array("Tmp" => "<sapn class=\"buttons\"><input type=\"button\" value=\"编辑\" class=\"submit\" onclick=\"PopupWindow('banner_product.php?act=modify&id={SysProductsID}', 800, 600)\"></span>")
									 );
	
	echo $objMan->strHead($arrColumnTips);
	echo $objMan->strMiddle($ProResult, $arrColumn);
	echo $objMan->strLast();
	
	
	//输出批量操作
	include_once(CFG_LIB_DIR.'batch_operation.php');
	$objBO = new clsBatchOperation();
	
	$arrOperation = array ("RevChk", "Sort", "Top", "Extract", "Del");
	$objBO->strCateTable = "sys_procategory";
	$arrBO = $objBO->strBottom($arrOperation, "Sort");
	
	echo $arrBO[0].$arrBO[1];
	
	
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