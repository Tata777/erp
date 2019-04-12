<?php
	//招聘管理ID号
	$protectid="15"; 
	include("../protect.php");
	
	include_once("../../config.inc.php");	
	
	if($_REQUEST['act'] == "advsearch")
	{
		include("../common/advsearchact.php");
		$objSearch = new clsSearch();
		$strSqlWhere=$objSearch->strSearchSql($_REQUEST);
	}
	else
	{
		$strSqlWhere = ($_GET['con']) ? $_GET['con'] : " ORDER BY i.`RecruitmentID` DESC";
	}
		
	include_once(CFG_LIB_DIR."manage_page.php");	
	$objManPage = new clsManagePage();
	
	//分页获取数据
	//$ProResult = $objManPage->GetResult('*', '`'.con_strPREFIX.'recruitment`', $strSqlWhere, 20);
	$ProResult = $objManPage->GetResult('i.*, s.`CateName`', '`'.con_strPREFIX.'recruitment` as i LEFT JOIN `'.con_strPREFIX.'recruitmentcategory` as s ON i.`CateID` = s.`RecruitmentCategoryID`', $strSqlWhere, 20);
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
		<td><h1>招聘</h1></td>
		<td class="actions">
			<table summary="" cellpadding="0" cellspacing="0" border="0" align="right">
				<tr>
					<td class="active"><a href="index.php" class="view">浏览招聘</a></td>
					<!--<td><a href="advsearch.php">高级搜索</a></td>-->
					<td><a href="#" class="add" onclick="return PopupWindow('recruitment.php?act=add', 800, 600);">发布招聘</a></td>
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
										array("tips" => "招聘职位", "width" => "13%"),
										array("tips" => "学历要求", "width" => "10%"),
										array("tips" => "招聘人数", "width" => "10%"),
										array("tips" => "开始时间", "width" => "12%"),
										array("tips" => "截止时间", "width" => "12%"),
										array("tips" => "发布日期", "width" => "12%"),
										array("tips" => "语言", "width" => "60"),
										array("tips" => "执行操作", "width" => "60")
									 );
									 						 
	$arrColumn = array(
										array("CheckBox" => "RecruitmentID"),
										array("Text" => "RecruitmentID"),
										array("Sort" => "SortNum"),
										"Title" => 
										array(
												"Tmp" => "<a href=\"#\" onclick=\"PopupWindow('view.php?id={RecruitmentID}', 800, 600)\">{JobName}</a>",
													),
										array("Text" => "Academic"),
										array("Text" => "Number"),
										array("Date" => "StartDate"),
										array("Date" => "EndDate"),
										array("Date" => "PublishDate"),
										array("LangSelect" => "Lang"),
										array("Tmp" => "<sapn class=\"buttons\"><input type=\"button\" value=\"编辑\" class=\"submit\" onclick=\"PopupWindow('recruitment.php?act=modify&id={RecruitmentID}', 800, 600)\"></span>")
									 );
	
	echo $objMan->strHead($arrColumnTips);
	echo $objMan->strMiddle($ProResult, $arrColumn);
	echo $objMan->strLast();
	
	
	//输出批量操作
	include_once(CFG_LIB_DIR.'batch_operation.php');
	$objBO = new clsBatchOperation();
	
	$arrOperation = array ("RevChk", "Sort", "Auditing","Lock","PublishDate", "Copy", "Move", "Del");
	$objBO->strCateTable = "recruitmentcategory";
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
<?php //$objDb->close(); ?>