<?php
	$protectid="2"; 
	include("../protect.php");
	
	include_once("../../config.inc.php");
	
	$strID = $_GET['id'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>查看</title>
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<link href="../css/edit.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../js/commentJS.js"></script>
</head>

<body id="main" >
<table summary="" id="pagehead" cellpadding="0" cellspacing="0" border="0" width="100%">
	<tr>
		<td><h1>查看详细</h1></td>
		<td class="actions">
			<table summary="" cellpadding="0" cellspacing="0" border="0" align="right">
				<tr>
          <td class="active"><a href="#" >查看详细</a></td>
					<td ><a href="#" onclick="return ConfirmCloseWinow('');">关闭</a></td>
				</tr>
			</table>
		</td>
	</tr>
</table>

<?php
	include_once(CFG_LIB_DIR."preview.php");
	$objPreview = new clsPreview();
	
	$p_arrColumn = array(
												array("ID", "InfoID"),
												array("信息类别", "CateID", "Type" => "SQL", "secTable" => con_strPREFIX."infocategory", "secColumn" => "CateName", "secIDColumn" => "InfoCategoryID"),
												array("标题", "Title"),
												array("颜色", "TitleColor"),
												array("作者", "Author"),
												array("编辑", "Editor"),
												array("图片名", "Photo"),
												array("副标题", "SubTitle"),
												array("内容", "Content"),
												array("关键字", "Tag"),
												array("相关文章", "RelationID", "Type" => "Relation", "secColumn" => "Title"),
												array("来源网站", "FromSite"),
												array("简介", "Intro"),
												array("跳转地址", "CustomLinks", "Type" => "Link"),
												array("阅读权限", "Role", "Type" => "ReadingRight", "secTable" => con_strPREFIX."rolesetting ", "secColumn" => "RoleName", "secIDColumn" => "RoleSettingID"),
												array("是否审核", "IsAuditing", "Type" => "Boolean"),
												array("是否锁定", "IsLock", "Type" => "Boolean"),
												array("排序号", "SortNum"),
												array("置顶权值", "TopNum"),
												array("精华权值", "ExtractNum"),
												array("创建日期", "CreationDate", "Type" => "Date"),
												array("修改日期", "ModifiedDate", "Type" => "Date"),
												array("创建人", "CreationUserID", "Type" => "SQL", "secTable" => "admin", "secColumn" => "ad_username", "secIDColumn" => "ad_id"),
												array("修改人", "ModifiedUserID", "Type" => "SQL", "secTable" => "admin", "secColumn" => "ad_username", "secIDColumn" => "ad_id"),
												array("供稿人", "ContributionUserID", "Type" => "SQL", "secTable" => con_strPREFIX."member", "secColumn" => "MemberName", "secIDColumn" => "MemberID"),
												array("创建日期", "PublishDate", "Type" => "Date"),
												array("点击率", "Clicks")
								 );
	
	$objPreview->vodPrintPreview(con_strPREFIX."info", $p_arrColumn, "InfoID", $strID);
?>

<div class="buttons">
	<input type="button" value="关闭" class="submit" onclick="return ConfirmCloseWinow('');">
</div>

<br>
<?php include "../bottom.php"; ?>
</div>
</body>
</html>