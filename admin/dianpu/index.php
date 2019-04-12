<?php
	//产品管理ID号
	$protectid="14"; 
	include("../protect.php");
	
	include_once("../../config.inc.php");	
	
	//$strSqlWhere .=" and p.CateID not like '114%' ";
	
	if($_REQUEST['act'] == "advsearch")
	{
		include("../common/advsearchact.php");
		$objSearch = new clsSearch('p');
		$strSqlWhere .=$objSearch->strSearchSql($_REQUEST);
	}
	else
	{
		$strSqlWhere .= ($_GET['con']) ? $_GET['con'] : " ORDER BY p.`SysProductsID` DESC";
	}
	
	//echo $strSqlWhere;
	
	include_once(CFG_LIB_DIR."manage_page.php");	
	$objManPage = new clsManagePage();
	
	//分页获取数据
	$ProResult = $objManPage->GetResult('p.`SysProductsID`,s.`CateName`, p.`ProductName`, p.`SubName`, p.`FirstPhoto`,p.`Photos`, p.`PublishDate`, p.`ValidDate`, p.`SortNum`, p.`Lang`,  s.`CateName`', '`'.con_strPREFIX.'sys_dianpu` as p LEFT JOIN `'.con_strPREFIX.'city` as s ON p.`CateID` = s.`CityID`', $strSqlWhere, 20);
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
		<td><h1>产品</h1></td>
		<td class="actions">
			<table summary="" cellpadding="0" cellspacing="0" border="0" align="right">
				<tr>
					<td class="active"><a href="index.php" class="view">浏览产品</a></td>
					<td><a href="advsearch.php">高级搜索</a></td>
					<td><a href="#" class="add" onclick="return PopupWindow('product.php?act=add', 800, 600);">发布产品</a></td>
 <!--         <td><a href="../order/" class="add">查看订单</a></td>-->

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
										array("tips" => "排序", "width" => "5%"),
										array("tips" => "店铺地址", "width" => "15%"),
										array("tips" => "店铺名称", "width" => "20%"),
										array("tips" => "店铺分类", "width" => "10%"),
										array("tips" => "预览图", "width" => "10%"),
										array("tips" => "发布日期", "width" => "10%"),
										array("tips" => "语言", "width" => "10%"),
										array("tips" => "执行操作", "width" => "10%")
									 );
									 						 
	$arrColumn = array(
										array("CheckBox" => "SysProductsID"),
										array("Text" => "SysProductsID"),
										array("Sort" => "SortNum"),
										array("Text" => "SubName"),
										"Title" => 
										array(
												"Tmp" => "<a href=\"#\" onclick=\"PopupWindow('view.php?id={SysProductsID}', 800, 600)\">{ProductName}</a>",
												"Img" => "FirstPhoto"
													),
										array("Text" => "CateName"),
							
												array(
												"Tmp" => "<img src=\"../pic.php?imagename=../uploadfile/product_b/{Photos}&imagewidth=180&imageheight=70&cuteit=2\"  />",
													),
										array("Date" => "PublishDate"),
										array("LangSelect" => "Lang"),
										array("Tmp" => "<sapn class=\"buttons\"><input type=\"button\" value=\"编辑\" class=\"submit\" onclick=\"PopupWindow('product.php?act=modify&id={SysProductsID}', 800, 600)\"></span>")
									 );
	
	echo $objMan->strHead($arrColumnTips);
	echo $objMan->strMiddle($ProResult, $arrColumn);
	echo $objMan->strLast();
	
	
	//输出批量操作
	include_once(CFG_LIB_DIR.'batch_operation.php');
	$objBO = new clsBatchOperation();
	
	$arrOperation = array ("RevChk", "Sort", "Top", "Extract", "Copy", "Move", "Del");
	$objBO->strCateTable = "sys_procategory";
	$arrBO = $objBO->strBottom($arrOperation, "Sort");
	
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
