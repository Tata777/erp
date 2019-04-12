<?php
	$protectid="6"; 
	include("../protect.php");
	
	include_once("../../config.inc.php");
	$strID = $_GET['id'];	
	
	include_once(CFG_LIB_DIR.'mysqldb.inc.php');		
	$objDb = new mysqldb();
	
	include_once(CFG_LIB_DIR."generic.lib.php");
	$objBase = new clsBase();
	
	$strSQL = "SELECT * FROM `".con_strPREFIX."zfresult` WHERE guest_id = ".$strID." LIMIT 1";
	$objDb->query($strSQL);
	$tmpResult = $objDb->get_data();
	$guestRs = $tmpResult[0];
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
    <td><h1>处理兑换积分商品</h1></td>
    <td class="actions"><table summary="" cellpadding="0" cellspacing="0" border="0" align="right">
      <tr>
        <td ><a href="#" onclick="return ConfirmCloseWinow('');">关闭</a></td>
      </tr>
    </table></td>
  </tr>
</table> 
<form method="post" action="reply2_ok.php?act=update&id=<?php echo $strID;?>" >

	<table cellspacing="0" cellpadding="0" width="100%"  class="listtable">
    
 
    <tr>
    	<td>处理备注</td>
      <td colspan="3" style="vertical-align: top">
      	<p><textarea name="guest_re" cols="70" rows="8"><?php echo $objBase->strDbConvert($guestRs['guest_re']);?></textarea>&nbsp;</p>
        </td>
    </tr>
	</table>

<div class="buttons">
	<input type="submit" value="提交保存" class="submit">
	<input type="reset" value="重新设置">
</div>
</form>
<?php include "../bottom.php"; ?>
</body>
</html>
