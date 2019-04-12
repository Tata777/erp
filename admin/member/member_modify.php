<?
session_start();
require("../../class/mysqldb.inc.php");
$db=new mysqldb();
$action=$_POST["action"];
if($action=="edit"){
	$sql="update hy_member set `user_truename`='$user_truename',`user_sex`='$user_sex',`user_email`='$user_email',`user_zipcode`='$user_zipcode',`user_add`='$user_add',`user_tel`='$user_tel',`user_mobile`='$user_mobile',`user_company`='$user_company',`user_intro`='$user_intro',`user_regtime`='$user_regtime' where user_id='$id'";
	$result=$db->query($sql);
	if($result){
		echo "<script>alert('修改成功。');location.href='member_modify.php?id=$id';</script>";
		exit;
	}
	else{
		echo "<script>alert('修改失败，请重试。');history.go(-1);</script>";
		exit;
	}
}

$sql="select * from hy_member where user_id='".$id."'";
$db->query($sql);
$row=$db->get_data();
if($row){
	$struserid=$row[0]["user_id"];
	$strusername=$row[0]["user_name"];
	$strusertruename=$row[0]["user_truename"];
	$struserpws=$row[0]["user_pws"];
	$strusersex=$row[0]["user_sex"];
	$struseremail=$row[0]["user_email"];
	$struserzipcode=$row[0]["user_zipcode"];
	$struseradd=$row[0]["user_add"];
	$strusertel=$row[0]["user_tel"];
	$strusermobile=$row[0]["user_mobile"];
	$strusercompany=$row[0]["user_company"];
	$struserintro=$row[0]["user_intro"];
}
?>
<link href="css/css.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
body,td,th {
	font-size: 12px;
	color: #CCCCCC;
}
-->
</style>
<SCRIPT src="../../js/checkuser.js"></SCRIPT>
<script type="text/javascript">
<!--
function checkFrm(dom){
	if(dom.user_name.value.length<5 || dom.user_name.value.length>20){
		alert('账号必须在5-20个字符之间');	
		dom.user_name.focus();
		return false;
	}
	else{
		return true;	
	}
}
-->
</script>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="70%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr bgcolor="#F3F6F3">
    <td  height="30" colspan="3"  nowrap><span class="title1"><strong>&nbsp;<img src="../images/user1.jpg" width="24" height="24"> 会 员 管 理 --&gt; 修 改 会 员 资 料</strong></span></td>
  </tr>
  <tr>
    <td height="143">
    <form action="" method="post" id="form1" onsubmit="return checkFrm(this)">
      										<input name="action" type="hidden" value="edit" />
      										<input name="user_id" type="hidden" value="<?=$struserid?>" />
      										<table cellspacing="1" cellpadding="5" width="100%" align="center" 
                  bgcolor="#cccccc" border="0">
      											<tbody>
      												<tr>
      													<td width="85" align="right" bgcolor="#f3f3f3" class="text-3"><strong>帐 
      														号：</strong></td>
      													<td width="544" align="left" bgcolor="#ffffff">&nbsp;
      														<input name="user_name" type="text" disabled="disabled" id="user_name" value="<?=$strusername?>" maxlength="20" />
      														<font color="red" class="text-4">*(必须是英文字母开头，可以包含数字和下划线，长度在5-20位之间) </font></td>
     													</tr>
      												<tr>
      													<td align="right" bgcolor="#f3f3f3" class="text-3"><strong>性 
      														别：</strong></td>
      													<td align="left" bgcolor="#ffffff"><span class="text-3">
      														<input id="sex1" type="radio" <? if($strusersex=="1"){echo "checked";}?> value="1" name="user_sex" />
      														<label for="sex1">男性</label>
      														<input id="sex2" type="radio" <? if($strusersex=="2"){echo "checked";}?> value="2" name="user_sex" />
      														<label for="sex2">女性</label>
      														</span>
      														<label for="sex2"></label></td>
     													</tr>
      												<tr>
      													<td align="right" bgcolor="#f3f3f3" class="text-3"><strong>姓 名：</strong></td>
      													<td align="left" bgcolor="#ffffff">&nbsp;
      														<input id="user_truename" maxlength="200" name="user_truename" value="<?=$strusertruename?>" /></td>
     													</tr>
      												<tr>
      													<td align="right" bgcolor="#f3f3f3" class="text-3"><strong>E-Mail：</strong></td>
      													<td align="left" bgcolor="#ffffff">&nbsp;
      														<input id="user_email" style="WIDTH: 300px" maxlength="200" name="user_email" value="<?=$struseremail?>" />
      														<font color="red" class="text-4">* <span class="tt7">(非常重要！这是客户与您联系的首选方式，请务必填写真实，并确认是您最常用的电子邮件。建议不要使用Sina的邮箱)</span></font></td>
     													</tr>
      												<tr>
      													<td align="right" bgcolor="#f3f3f3" class="text-3"><strong>邮政编码：</strong></td>
      													<td align="left" bgcolor="#ffffff">&nbsp;
      														<input id="user_zipcode" style="WIDTH: 300px" maxlength="6" name="user_zipcode" value="<?=$struserzipcode?>" /></td>
     													</tr>
      												<tr>
      													<td align="right" bgcolor="#f3f3f3" class="text-3"><strong>联系地址：</strong></td>
      													<td align="left" bgcolor="#ffffff">&nbsp;
      														<input id="user_add" style="WIDTH: 300px" maxlength="200" name="user_add" value="<?=$struseradd?>" /></td>
     													</tr>
      												<tr>
      													<td align="right" bgcolor="#f3f3f3" class="text-3"><strong>电 话：</strong></td>
      													<td align="left" bgcolor="#ffffff">&nbsp;
      														<input id="user_tel" style="WIDTH: 300px" maxlength="200" name="user_tel" value="<?=$strusertel?>" /></td>
     													</tr>
      												<tr>
      													<td align="right" bgcolor="#f3f3f3" class="text-3"><strong>手 机：</strong></td>
      													<td align="left" bgcolor="#ffffff">&nbsp;
      														<input id="user_mobile" style="WIDTH: 300px" maxlength="200" name="user_mobile" value="<?=$strusermobile?>" /></td>
     													</tr>
      												<tr>
      													<td align="right" bgcolor="#f3f3f3" class="text-3"><strong>工作单位：</strong></td>
      													<td align="left" bgcolor="#ffffff">&nbsp;
      														<input id="user_company" style="WIDTH: 300px" maxlength="200" name="user_company" value="<?=$strusercompany?>" /></td>
     													</tr>
      												<tr>
      													<td align="right" bgcolor="#f3f3f3" class="text-3"><strong>个人简介：<br />
      														(2000字)<br />
      														(<a href="javascript:checklen();">检查字数</a>)</strong></td>
      													<td align="left" bgcolor="#ffffff">&nbsp;
      														<textarea name="user_intro" id="user_intro" style="WIDTH: 300px; HEIGHT: 144px"><?=$struserintro?></textarea></td>
     													</tr>
      												<tr>
      													<td align="right" bgcolor="#f3f3f3" class="text-3">&nbsp;</td>
      													<td align="left" bgcolor="#ffffff"><input language="javascript" class="button2" id="Button1" style="WIDTH: 110px" onclick="if (typeof(Page_ClientValidate) == 'function') Page_ClientValidate(); " type="submit" value="确定修改" name="Button1" /></td>
     													</tr>
     												</tbody>
										</table>
			</form>
    </td>
  </tr>
</table>
</body>
</html>