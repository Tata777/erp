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
	
	$intMemID = $_SESSION['M_Id'];
	
	include_once(CFG_LIB_DIR."manage_page.php");	
	$objManPage = new clsManagePage();
	
	
	//分页获取数据
	$FeedbackResult = $objManPage->GetResult('*', '`'.con_strPREFIX.'book`', "ORDER BY `guest_id` DESC", 12, true);
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
    <td><h1>查看预定</h1></td>
  </tr>
</table> 
<form method="post" action="qy_feedback_save.php?act=manage" onsubmit="return validForm('Item', 'SelectedID');">
<?php
	//输出 Manage Grid
	if(is_array($FeedbackResult))
	{
		foreach($FeedbackResult as $key => $record)
		{
?>
	<table cellspacing="0" cellpadding="0" width="100%"  class="listtable">
    <tr> 
      <th width="23%">标 题：</th>
      <th width="59%" style="text-align: left">
      	客户<?php echo trim($record['name']);?>  <?php echo date('Y年m月d日',$record['guest_date']);?>预定信息 </th>
      <th width="18%">
      <input type="checkbox" name="Item" id="Item<?php echo $key; ?>" value="<?php echo $record['guest_id']; ?>"/> 
      <label for="Item<?php echo $key; ?>">删除</label>
    <!--  | 
      <a href="reply.php?id=<? echo $record['guest_id'];?>">回复</a>
<a href="guest_del.php?id=<? echo $record['guest_id'];?>" onClick="return confirm('你确定要删除吗？')" >删除</a>--></th>
    </tr>
    <tr>
    	<td  colspan="3" style="line-height:25px">
		 价格:<?php echo trim($record['price']);?>  <br />
		 入住时间:<?php echo trim($record['in']);?> &nbsp;&nbsp;离店时间:<?php echo trim($record['out']);?><br />
		  房间类型:<?php echo trim($record['roomtype']);?><br />
		   房间数:<?php echo trim($record['roomnum']);?>&nbsp;&nbsp; 成人数:<?php echo trim($record['proplenum']);?>&nbsp;&nbsp;
		   儿童数:<?php echo trim($record['childnum']);?><br />
		   
		       姓名:<?php echo trim($record['name']);?>&nbsp;&nbsp;  性别:<?php echo trim($record['sex']);?><br />
			      联系电话	:<?php echo trim($record['phone']);?><br />
				     证件号码:<?php echo trim($record['idcard']);?><br />
					    Email:<?php echo trim($record['email']);?><br />
 
   
 
      
      </td>
    </tr>
								<?php
								if($record['guest_re']!=""){
								?>                    
    <tr>
    	<td>
      管理员回复:
      </td>
      <td colspan="2" style="vertical-align: top">
      回复于:<b> <?php echo $record['guest_redate'];?> </b>
				      <hr size="1" color="#cccccc">
		      <?php echo $record['guest_re'];?><br>			
      </td>
    </tr>
							<?php }?>	
	</table>
<?php	
		}
	}
	
	//输出批量操作
	include_once(CFG_LIB_DIR.'batch_operation.php');
	$objBO = new clsBatchOperation();
	
	$arrOperation = array ("RevChk", "Del");
	$arrBO = $objBO->strBottom($arrOperation, "Del");
	
	echo $arrBO[0].$arrBO[1];
	
	//输出分页
	echo $objManPage->ShowLink();
?>

<div align="center" style="padding: 5px;">
	<input type="hidden" name="SelectedID" id="SelectedID" />
  <input type="submit" value="提交保存" class="submit" />
  <input type="reset" value="重置" class="submit" />
</div>
</form>
<?php include "../bottom.php"; ?>
</body>
</html>
