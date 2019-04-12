<?php
	$protectid="131"; 
	include("../protect.php");
	
	include_once("../../config.inc.php");
	
	$strSqlWhere = ($_GET['con']) ? stripslashes($_GET['con']) : " AND c.`CateName` LIKE '%".$_GET['sort']."%' ORDER BY s.`SortNum`";
		
	include_once(CFG_LIB_DIR."manage_page.php");	
	$objManPage = new clsManagePage();
	
	//分页获取数据
	$InfoResult = $objManPage->GetResult('s.`BlockStyleID`, s.`CateID`, s.`StyleTitle`, s.`FileName` , s.`SortNum`, c.`CateName`', '`'.con_strPREFIX.'blockstyle` as s LEFT JOIN `'.con_strPREFIX.'blockcategory` as c ON s.`CateID` = c.`BlockCategoryID`', $strSqlWhere, 20);
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
		<td><h1>模块风格</h1></td>
		<td class="actions">
			<table summary="" cellpadding="0" cellspacing="0" border="0" align="right">
				<tr>
					<td class="active"><a href="index.php" class="view">浏览风格</a></td>
					<td><a href="style.php?act=add" class="add">添加新风格</a></td>	
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
										array("tips" => "选择", "width" => "20"),
										array("tips" => "ID", "width" => "30"),
										array("tips" => "排序", "width" => "40"),
										array("tips" => "方案名称", "width" => "40%"),
										array("tips" => "系统分类", "width" => "60"),
										array("tips" => "文件名", "width" => "60"),
										array("tips" => "执行操作", "width" => "60")
									 );
									 
	$arrColumn = array(
										array("CheckBox" => "BlockStyleID"),
										array("Text" => "BlockStyleID"),
										array("Sort" => "SortNum"),
										array("Text" => "StyleTitle"),
										array("Tmp" => "<a href=\"index.php?sort={CateName}\">{CateName}</a>"),
										array("Text" => "FileName"),
										array("Tmp" => "<sapn class=\"buttons\"><input type=\"button\" value=\"编辑\" class=\"submit\" onclick=\"window.location.href='style.php?act=modify&id={BlockStyleID}'\"></span>")
									 );
	
	echo $objMan->strHead($arrColumnTips);
	echo $objMan->strMiddle($InfoResult, $arrColumn);
	echo $objMan->strLast();
	
	
	//输出批量操作
	include_once(CFG_LIB_DIR.'batch_operation.php');
	$objBO = new clsBatchOperation();
	
	$arrOperation = array ("RevChk", "Sort", "Copy", "Move", "Del");
	$objBO->strCateTable = "blockcategory";
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