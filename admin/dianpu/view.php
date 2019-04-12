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
												array("ID", "SysProductsID"),
												array("信息类别", "CateID", "Type" => "SQL", "secTable" => con_strPREFIX."sys_procategory", "secColumn" => "CateName", "secIDColumn" => "SysProCategoryID"),
												array("产品名称", "ProductName"),
												/*array("副标题", "SubName"),
												array("图片名", "FirstPhoto"),
												array("产品价格", "Price"),
												array("平邮", "Postage"),
												array("快递", "Express"),
												array("EMS", "Ems"),*/
												array("关键字", "Tag"),
												/*array("相关产品", "RelationID", "Type" => "Relation", "secColumn" => "ProductName"),*/
												array("简介", "Note"),
												array("是否锁定", "IsLock", "Type" => "Boolean"),
												array("排序号", "SortNum"),
												array("置顶权值", "TopNum"),
												array("精华权值", "ExtractNum"),
												array("创建日期", "CreationDate", "Type" => "Date"),
												array("修改日期", "ModifiedDate", "Type" => "Date"),
												array("创建人", "CreationUserID", "Type" => "SQL", "secTable" => "admin", "secColumn" => "ad_username", "secIDColumn" => "ad_id"),
												array("修改人", "ModifiedUserID", "Type" => "SQL", "secTable" => "admin", "secColumn" => "ad_username", "secIDColumn" => "ad_id"),
												array("发布日期", "PublishDate", "Type" => "Date"),
												array("点击率", "Clicks")
								 );
	
	$objPreview->vodPrintPreview(con_strPREFIX."sys_products", $p_arrColumn, "SysProductsID", $strID);
?>

<div class="buttons">
	<input type="button" value="关闭" class="submit" onclick="return ConfirmCloseWinow('');">
</div>

<br>
<?php include "../bottom.php"; ?>
</div>
</body>
</html>