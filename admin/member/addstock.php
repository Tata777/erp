<?
	session_start();
	require("../../class/mysqldb.inc.php");
	$db=new mysqldb();
	$uid=$_GET['uid'];
	$sql = "select user_truename from hy_member where user_id=".$uid;
	$db->query($sql);
	$rs=$db->get_data();
	foreach($rs as $v){
	$user_name = $v['user_truename'];
	}
?>
<link href="../../css/css.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
body,td,th {
	font-size: 12px;
	color: #CCCCCC;
}
-->
</style>
<SCRIPT src="../../js/checkuser.js"></SCRIPT>
<script language="javascript">
function chk()
{
	var keyselected ='';
		
	if(!check_empty(document.getElementById('pro_name'),"请输入UTOP品名！")) return false;
	if(!check_empty(document.getElementById('code'),"请输入客户料号！")) return false;
	if(!check_empty(document.getElementById('unit'),"请输入产品单位！")) return false;
	if(!check_empty(document.getElementById('number'),"请输入库存数量！")) return false;
}
</script>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="70%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr bgcolor="#F3F6F3">
    <td  height="30" colspan="3"  nowrap><span class="title1"><strong>&nbsp;<img src="../images/user1.jpg" width="24" height="24"> 会 员 管 理 --&gt; 客 户 库 存</strong></span></td>
  </tr>
  <tr>
    <td height="143" valign="top"><table width="100%" border="1" align="center" cellpadding="6" cellspacing="0" bordercolor="#FFFFFF" bordercolorlight="#CCCCCC" bordercolordark="#FFFFFF">
        <form action="stock_act.php" method="post" name="reguser" id="reguser" onSubmit="return chk();">
          <tr>
            <td width="23%" height="32" align="left" style="padding-top:3px"><span style="padding-top:3px">客户名</span></td>
            <td width="36%" height="32" align="left"><input name="username" type="text" id="username" style="width:130px; height:17px" value="<?=$user_name?>" readonly="readonly" />
              <span class="requirefill">*</span> <span style="padding-top:3px"><span>
			  <input name="uid" type="hidden" id="uid" value="<?=$uid?>">
              <input name="action" type="hidden" id="action" value="save">
              </span></span></td>
          </tr>
          <tr>
            <td height="32" align="left" style="padding-top:3px"><span style="padding-top:3px">UTOP品名</span></td>
            <td height="32" align="left"><input name="pro_name" type="text" id="pro_name" style="width:130px; height:17px" />
              <span class="requirefill">*</span></td>
          </tr>
          <tr>
            <td height="32" align="left" style="padding-top:3px"><span style="padding-top:3px">客户料号</span></td>
            <td height="32" align="left"><input name="code" type="text" id="code" style="width:130px; height:17px" />
              <span class="requirefill">*</span></td>
          </tr>
          <tr>
            <td height="32" align="left" style="padding-top:3px"><span style="padding-top:3px">单位</span></td>
            <td height="32" align="left"><input name="unit" type="text" id="unit" style="width:130px; height:17px" />
              <span class="requirefill">*</span></td>
          </tr>
          <tr>
            <td height="32" align="left" style="padding-top:3px"><span style="padding-top:3px">存库数量</span></td>
            <td height="32" align="left"><input name="number" type="text" id="number" style="width:130px; height:17px" />
              <span class="requirefill">*</span></td>
          </tr>
          <tr>
            <td height="32" align="left" style="padding-top:3px"><span style="padding-top:3px">备注 </span></td>
            <td height="32" align="left"><textarea name="remark" type="text" id="remark"></textarea>
              <span class="requirefill">*</span></td>
          </tr>
          <tr>
            <td height="32" align="left" style="padding-top:3px">&nbsp;</td>
            <td height="32" align="left"><input type="submit" name="button" id="button" value="提交"></td>
          </tr>
        </form>
      </table>
    <p align="center">&nbsp;</p></td>
  </tr>
</table>
</body>
</html>