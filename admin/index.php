<?php
	include_once('../class/mysqldb.inc.php');
	$objDb = new mysqldb();
	$objDb->close();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><? echo $companyname; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/login.css" rel="stylesheet" type="text/css" />
<script language="javascript">
	function chkk()
	{
		if (document.login.username.value=="")
		{
			alert("提示：用户名不能为空!");
			document.login.username.focus();
			return false;
		}
		if (document.login.password.value=="")
		{
			alert("提示：密码不能为空!");
			document.login.password.focus();
			return false;
		}	
		if (document.login.yancode.value=="")
  	{
			alert("提示: 请输入验证码！");
			document.login.yancode.focus();
			return false;
  	}
		return true;
	}
</script>
</head>

<br /><br /><br /><br />
<table width="600" border="0" cellpadding="8" cellspacing="0" class="logintable">
<tr class="loginheader"><td width="80"></td><td width="100"></td><td></td><td width="120"></td><td width="80"></td></tr>
<tr style="height:40px"><td>&nbsp;</td>
<td class="line1"><span style="color:#ffff66;font-size:14px;font-weight: bold;">系统登录</span></td>
<td class="line1">&nbsp;</td>
<td class="line1">&nbsp;</td>
<td>&nbsp;</td></tr>
<form method="post" name="login" action="login_ok.php" onsubmit="return chkk();">
<tr><td>&nbsp;</td><td class="line2" align="right">用户名:</td><td class="line2"><input type="text" name="username" size="24" id="username" /></td><td class="line2">&nbsp;</td><td>&nbsp;</td></tr>
<tr><td>&nbsp;</td><td align="right">密    码:</td>
  <td><input type="password" name="password" size="25" id="password" /></td>
  <td>&nbsp;</td>
<td>&nbsp;</td></tr><tr><td>&nbsp;</td>
<td align="right">验证码:</td>
  <td>&nbsp;<input id="yancode" maxlength="6" size="6" name="yancode" />&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="this.firstChild.src='seccode.php?update=' + Math.random();return false;"><img align="absmiddle" src="seccode.php?update=<?php echo time(); ?>" border="0" /></a> </td>
  <td>&nbsp;</td><td>&nbsp;</td></tr><tr><td>&nbsp;</td><td class="line1">&nbsp;</td><td class="line1" align="center"><input type="submit" class="button" value="提 交" />
    <input name="Reset" type="reset" class="button" value="重 置" />
</form></td><td class="line1">&nbsp;</td><td>&nbsp;</td></tr><tr><td>&nbsp;</td><td class="line2">&nbsp;</td><td class="line2">&nbsp;</td><td class="line2">&nbsp;</td><td>&nbsp;</td></tr>
<tr><td colspan="5" align="center"><? include "bottom.php"?></td></tr>
<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr></table>
</html>
