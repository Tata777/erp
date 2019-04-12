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
												array("ID", "OrderID"),
												array("订购产品", "ProductID", "Type" => "SQL", "secTable" => con_strPREFIX."sys_products", "secColumn" => "ProductName", "secIDColumn" => "SysProductsID"),
												array("订购者姓名", "LinkMan"),
												array("订购数量", "Number"),
												array("联系电话", "Phone"),
												array("传真", "Fax"),
												array("联系地址", "Address"),
												array("Email", "Email"),
												array("QQ/MSN", "QQ"),
												array("备注", "Note"),
												array("发布日期", "PublishDate", "Type" => "Date"),
												array("IP", "IP")
								 );
	
	$objPreview->vodPrintPreview(con_strPREFIX."pro_order", $p_arrColumn, "OrderID", $strID);
?>

<div class="buttons">
	<input type="button" value="关闭" class="submit" onclick="return ConfirmCloseWinow('');">
</div>

<br>
<?php include "../bottom.php"; ?>
</div>
</body>
</html>