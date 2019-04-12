<?php
	$protectid="7"; 
	include("../protect.php");
	
	include_once("../../config.inc.php");	
	
	$Lang=$_GET['Lang']?$_GET['Lang']:"cn";
	
	if($_REQUEST['act'] == "advsearch")
	{
		include_once("../common/advsearchact.php");
		$objSearch = new clsSearch('i');
		if($_REQUEST['con'])
		{
	 	$strSqlWhere = urldecode($_REQUEST['con']);
		$strSqlWhere = str_replace('\\','', $strSqlWhere);
		}
		else
		{
		 $strSqlWhere=$objSearch->strSearchSql($_REQUEST);
		 $strSqlWhere =" AND i.`Lang` = '".$Lang."'".$strSqlWhere;
		}
		$Flag = true;
	}
	else
	{
		$strSqlWhere =  " AND i.`Lang` = '".$Lang."' ORDER BY i.`LinkID` DESC";
		$Flag = false;
	}	
	include_once(CFG_LIB_DIR."manage_page.php");	
	$objManPage = new clsManagePage();
	
	//分页获取数据
	$InfoResult = $objManPage->GetResult('i.*, s.`CateName`', '`'.con_strPREFIX.'link` as i LEFT JOIN `'.con_strPREFIX.'linkcategory` as s ON i.`CateID` = s.`LinkCategoryID`', $strSqlWhere, 20);

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
		<td><h1>幻灯片管理</h1></td>
		<td class="actions">
			<table summary="" cellpadding="0" cellspacing="0" border="0" align="right">
				<tr>
					<td class="active"><a href="index.php" class="view">浏览幻灯片</a></td>
					<td><a href="#" class="add" onclick="return PopupWindow('link.php?act=add', 800, 600);">发布幻灯片</a></td>	
				</tr>
			</table>
		</td>
	</tr>
</table>
<table summary="" cellpadding="0" cellspacing="0" border="0" width="100%">
	<tr>
		<td class="actions">
			<table cellpadding="0" cellspacing="0" border="0" align="right">
				<tr>
        
					<td <?php if($Lang == "cn"){?> class="active"<?php }?>><a href="index.php?Lang=cn">简体中文</a></td>
					<td<?php if($Lang == "en"){?> class="active"<?php }?>><a href="index.php?Lang=en">英文</a></td>	
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
										array("tips" => "ID", "width" => "10％"),
										array("tips" => "排序", "width" => "40"),
										array("tips" => "链接名称", "width" => "25%"),
										array("tips" => "链接分类", "width" => "15%"),
										array("tips" => "LOGO", "width" => "30%"),
										array("tips" => "发布日期", "width" => "15%"),
										array("tips" => "执行操作", "width" => "20%")
									 );
									 
	$arrColumn = array(
										array("CheckBox" => "LinkID"),
										array("Text" => "LinkID"),
										array("Sort" => "SortNum"),
										"Title" => 
										array(
												"Tmp" => "<a href=\"{LinkUrl}\">{LinkName}</a>",
												"Img" => "IsPic"
													),
										array("Text" => "CateName"),
										array(
												"Tmp" => "<img src=\"../pic.php?imagename=../uploadfile/link/{LogoPic}&imagewidth=88&imageheight=30&cuteit=0\" width=\"88\" height=\"31\" />",
													),
										array("Date" => "PublishDate"),
										array("Tmp" => "<sapn class=\"buttons\"><input type=\"button\" value=\"编辑\" class=\"submit\" onclick=\"PopupWindow('link.php?act=modify&id={LinkID}', 800, 600)\"></span>")
									 );
	
	echo $objMan->strHead($arrColumnTips);
	echo $objMan->strMiddle($InfoResult, $arrColumn);
	echo $objMan->strLast();
	
	
	//输出批量操作
	include_once(CFG_LIB_DIR.'batch_operation.php');
	$objBO = new clsBatchOperation();
	
	$arrOperation = array ("RevChk", "Sort", "PublishDate", "Copy", "Move", "Del");
	$objBO->strCateTable = "linkcategory";
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