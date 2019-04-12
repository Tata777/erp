<?php
	$protectid="132"; 
	include("../protect.php");
	
	include_once("../../config.inc.php");
	
	$strSqlWhere = ($_GET['con']) ? stripslashes($_GET['con']) : (($_GET['cid']) ? " AND b.`CateID` = '".$_GET['cid']."'" : "")." ORDER BY b.`CreationDate` DESC";
		
	include_once(CFG_LIB_DIR."manage_page.php");	
	$objManPage = new clsManagePage();
	
	//分页获取数据
	$InfoResult = $objManPage->GetResult('b.`BlocksID`, b.`CateID`, b.`BlockName`, b.`BlockCode`, b.`CreationDate`, c.`CateName`, c.`CateType`', '`'.con_strPREFIX.'blocks` as b LEFT JOIN `'.con_strPREFIX.'blockcategory` as c ON b.`CateID` = c.`BlockCategoryID`', $strSqlWhere, 8);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Administrator's Control Panel</title>
<?php include_once("../common/files.php"); ?>
<script type="text/javascript">
//验证批量管理页面,将选中的'选择'框的值组合成字符串,并赋值
function validForm(strItem, strTargetItem)
{
	var arrChecked = Array();
	var arrItem = document.getElementsByName(strItem);
	for(intCount = 0; intCount < arrItem.length; intCount++)
	{
		if(arrItem[intCount].checked)
		{
			arrChecked[arrChecked.length] = arrItem[intCount].value;
		}
	}
	
	if(arrChecked.length == 0)
	{
		alert('请至少选中一条记录');
		return false;
	}
	else
	{
		document.getElementById(strTargetItem).value = arrChecked.join(",");
		return true;
	}
}
</script>
</head>

<body id="main">
<table summary="" id="pagehead" cellpadding="0" cellspacing="0" border="0" width="100%">
	<tr>
		<td><h1>模块</h1></td>
		<td class="actions">
			<table summary="" cellpadding="0" cellspacing="0" border="0" align="right">
				<tr>
					<td class="active"><a href="index.php" class="view">浏览模块</a></td>
					<td><a href="block.php?act=add&cid=<?php echo $_GET['cid']; ?>&ctype=<?php echo $_GET['ctype']; ?>" class="add">创建模块</a></td>	
				</tr>
			</table>
		</td>
	</tr>
</table>

<?php
	include_once(CFG_LIB_DIR."manage_block.php");
	$objManBlock = new clsManageBlock();
	
	$objManBlock->vodPirntSelector();
?>

<form method="post" action="index_ok.php?cid=<?php echo $_GET['cid']; ?>&ctype=<?php echo $_GET['ctype']; ?>" onsubmit="return validForm('Item', 'SelectedID');">
<?php
	//输出 Manage Grid
	include_once(CFG_LIB_DIR.'manage.php');
	$objMan = new clsManage();
	
	$arrColumnTips = array(
										array("tips" => "选择", "width" => "20"),
										array("tips" => "ID", "width" => "30"),
										array("tips" => "模块名", "width" => "60%"),
										array("tips" => "执行操作", "width" => "60")
									 );
									 
	$arrColumn = array(
										array("CheckBox" => "BlocksID"),
										array("Text" => "BlocksID"),
										array("Tmp" => "<table><tbody><tr><td><b>{BlockName}</b> ({date(CreationDate)})<br/>基本模块: {CateName}</td></tr><tr><td>模板内部调用代码<br/><textarea cols=\"100\" rows=\"5\" name=\"blcokcode[]\">{BlockCode}</textarea></td></tr></tbody></table>"),										
										array("Tmp" => "<sapn class=\"buttons\"><input type=\"button\" value=\"编辑\" class=\"submit\" onclick=\"window.location.href='block.php?act=modify&id={BlocksID}&cid={CateID}&ctype={CateType}'\"></span>")
									 );
	
	echo $objMan->strHead($arrColumnTips);
	echo $objMan->strMiddle($InfoResult, $arrColumn);
	echo $objMan->strLast();
	
	
	//输出批量操作
	include_once(CFG_LIB_DIR.'batch_operation.php');
	$objBO = new clsBatchOperation();
	
	$arrOperation = array ("RevChk", "Del");
	$objBO->strCateTable = "blockcategory";
	$arrBO = $objBO->strBottom($arrOperation, "Del");
	
	echo $arrBO[0].$arrBO[1];
	
	
	//输出分页
	echo $objManPage->ShowLink();
?>

<div class="buttons">
	<input type="hidden" name="SelectedID" id="SelectedID" />
  <input type="submit" value="提交保存" class="submit" />
  <input type="reset" value="重置" />
</div>
</form>

<br />
<?php include "../bottom.php"; ?>
</div>

</body>
</html>