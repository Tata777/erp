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
		$strSqlWhere = ($_GET['con']) ? $_GET['con'] : " ORDER BY ResumeId DESC";
	}
		
	include_once(CFG_LIB_DIR."manage_page.php");	
	$objManPage = new clsManagePage();
	
	//分页获取数据
	$ProResult = $objManPage->GetResult('*', '`'.con_strPREFIX.'resume`', $strSqlWhere, 20);
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
		<td><h1>简历管理</h1></td>
		<td class="actions">
			<table summary="" cellpadding="0" cellspacing="0" border="0" align="right">
				<tr>
					<td class="active"><a href="resume_manage.php" class="view">浏览简历</a></td>
					<!--<td><a href="advsearch.php">高级搜索</a></td>-->
					<td><a href="#" class="add" onclick="return PopupWindow('recruitment.php?act=add', 800, 600);">发布招聘</a></td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<form method="post" action="resume_manage_ok.php" onsubmit="return validForm('Item', 'SelectedID');">
<?php
	//输出 Manage Grid
	include_once(CFG_LIB_DIR.'manage.php');
	$objMan = new clsManage();
	
	$arrColumnTips = array(
										array("tips" => "选择", "width" => "20"),
										array("tips" => "ID", "width" => "20"),
										array("tips" => "姓名", "width" => "10%"),
										array("tips" => "性别", "width" => "5%"),
										array("tips" => "应聘的职位", "width" => "15%"),
										array("tips" => "联系电话", "width" => "15%"),
										array("tips" => "Email地址", "width" => "20%"),
										array("tips" => "申请日期", "width" => "15%"),
										array("tips" => "执行操作", "width" => "10%")
									 );
									 						 
	$arrColumn = array(
										array("CheckBox" => "ResumeId"),
										array("Text" => "ResumeId"),
										"Title" => 
										array(
												"Tmp" => "<a href=\"#\" onclick=\"PopupWindow('view_resume.php?id={ResumeId}', 800, 600)\">{ResumeName}</a>",
													),
										array("Sex" => "ResumeSex"),
										array("Text" => "ResumeJobName"),
										array("Text" => "ResumeTel"),
										array("Text" => "ResumeEmail"),
										array("Date" => "ResumeDate"),
										array("Tmp" => "<sapn class=\"buttons\"><input type=\"button\" value=\"查看\" class=\"submit\" onclick=\"PopupWindow('view_resume.php?id={ResumeId}', 800, 600)\"></span>")
									 );
	
	echo $objMan->strHead($arrColumnTips);
	echo $objMan->strMiddle($ProResult, $arrColumn);
	echo $objMan->strLast();
	
	
	//输出批量操作
	include_once(CFG_LIB_DIR.'batch_operation.php');
	$objBO = new clsBatchOperation();
	
	$arrOperation = array ("RevChk", "Sort", "Del");
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