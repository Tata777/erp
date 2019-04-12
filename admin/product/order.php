<?php
	$protectid="6"; 
	include("../protect.php");
	
	include_once("../../config.inc.php");
	
	include_once(CFG_LIB_DIR.'mysqldb.inc.php');
	$objDb = new mysqldb();
	
	include_once(CFG_LIB_DIR."block.php");
	$Block = new clsBlock();
	
	include_once(CFG_LIB_DIR."generic.lib.php");
	$objBase = new clsBase();
	
	
	include_once(CFG_LIB_DIR."manage_page.php");	
	$objManPage = new clsManagePage();
	$ProductID = $_GET['id'];
	
	//分页获取数据
	$OrderResult = $objManPage->GetResult('*', '`'.con_strPREFIX.'pro_order`', " ORDER BY `OrderID` DESC", 12, true);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Administrator's Control Panel</title>
<?php include_once("../common/files.php"); ?>
</head>
<body id="main" >

<table summary="" id="pagehead" cellpadding="0" cellspacing="0" border="0" width="100%">
  <tr>
    <td><h1>查看订单</h1></td>
  </tr>
</table> 
	<table cellspacing="0" cellpadding="0" width="100%"  class="listtable">
    <tr>
      <th width="8%">产品编号</th>
      <th width="8%">订购者</th>
      <th width="6%">数量</th>
      <th width="10%">Email</th>
      <th width="11%">电话号码</th>
      <th width="10%">传真</th>
      <th width="11%">订购时间</th>
      <th width="5%">操作</th>
    </tr>
<?php
	//输出 Manage Grid
	if(is_array($OrderResult))
	{
		foreach($OrderResult as $key => $Order)
		{
?>
    <tr>
    	<td><?php echo $Order['ProductCode'];?></td>
    	<td><?php echo $Order['LinkMan'];?></td>
      <td><?php echo $Order['Number'];?></td>
      <td><?php echo $Order['Email'];?></td>
      <td><?php echo $Order['Phone'];?></td>
      <td><?php echo $Order['Fax'];?></td>
      <td><?php echo date('Y-m-d',$Order['PublishDate']);?></td>
      <td><a href="order_del.php?id=<? echo $Order['OrderID'];?>&ProductID=<?php echo $Order['ProductID'];?>" onClick="return confirm('你确定要删除吗？')" >删除</a>&nbsp;&nbsp;<a href="#"  onclick="PopupWindow('orderview.php?id=<? echo $Order['OrderID'];?>', 800, 600)">详细</a></td>
    </tr>
<?php	
		}
	}
?>
	</table>
	
<?php	
	//输出分页
	echo $objManPage->ShowLink();
?>

<?php include "../bottom.php"; ?>
</body>
</html>
