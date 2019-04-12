<?
require("../../class/mysqldb.inc.php");
$db=new mysqldb();

extract($_POST);

$action=$_POST["action"];
if($action=="add"){
 
	 
	$user_regtime=date("Y-m-d H:i:s",time());
	$sql="insert into hy_member(`user_name`,`user_truename`,`user_pws`,`user_sex`,`user_email`,`user_zipcode`,`user_add`,`user_tel`,`user_mobile`,`user_company`,`user_intro`,`user_regtime`) values('$user_name','$user_truename','$user_pws','$user_sex','$user_email','$user_zipcode','$user_add','$user_tel','$user_mobile','$user_company','$user_intro','$user_regtime')";
	$result=$db->query($sql);
	if($result){
		echo "<script>alert('保存成功。');location.href='index.php';</script>";
		exit;
	}
	else{
		echo "<script>alert('保存失败，请重试。');history.go(-1);</script>";
		exit;
	}
}
?>
<link href="../../css/css.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
body,td,th {
	font-size: 12px;
	color: #333333;
}
-->
</style>
<script type="text/javascript">
<!--
function checkFrm(dom){
	if(dom.user_truename.value.length == 0){
		alert('姓名不能为空');	
		dom.user_truename.focus();
		return false;
	}
	/*
	else if(dom.user_pws.value.length<6 || dom.user_pws.value.length>20){
		alert('密码必须在6-20个字符之间');	
		dom.user_pws.focus();
		return false;
	}
	else if(dom.user_pws.value!=dom.user_repws.value){
		alert('两次输入密码不一致');	
		dom.user_repws.focus();
		return false;
	}
	*/
	else if(dom.user_email.value=="" || dom.user_email.value.lenght<5 || dom.user_email.value.indexOf('@')==-1 || dom.user_email.value.indexOf('.')==-1){
		alert("email格式不正确");
		dom.user_email.focus();
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
    <td  height="30" colspan="3"  nowrap><span class="title1"><strong>&nbsp;<img src="../images/user1.jpg" width="24" height="24"> 客户管理 --&gt; 添加客户</strong></span></td>
  </tr>
  <tr>
    <td height="143"><form action="" method="post" id="form1" onSubmit="return checkFrm(this)">
					  	<input name="action" type="hidden" value="add" />
              <input name="action2" type="hidden" value="reg" />
					  <table cellspacing="1" cellpadding="5" width="100%" align="center" 
                  bgcolor="#cccccc" border="0">
                        <tbody>
						        <tr>
                            <td align="right" bgcolor="#f3f3f3" class="text-3"><strong>姓 名：</strong></td>
                            <td align="left" bgcolor="#ffffff">&nbsp;
                              <input id="user_truename" maxlength="200" name="user_truename" /></td>
                          </tr>
						  <!--
                          <tr>
                            <td width="85" align="right" bgcolor="#f3f3f3" class="text-3"><strong>帐 
                              号：</strong></td>
                            <td width="696" align="left" bgcolor="#ffffff">&nbsp;
                              <input id="user_name" type="text" maxlength="20" name="user_name" />
                              <font color="red" class="text-4">*(建议采用英文字母开头，可以包含数字和下划线，长度在5-20位之间) </font></td>
                          </tr>
						
                          <tr>
                            <td align="right" bgcolor="#f3f3f3" class="text-3"><strong>登录密码：</strong></td>
                            <td align="left" bgcolor="#ffffff">&nbsp;
                              <input id="user_pws" type="password" maxlength="20" name="user_pws" />
                              <span class="text-4"><font color="red">*</font> (密码由6-20个英文字母或数字组成，建议采用易记、难猜的英文数字组合)</span></td>
                          </tr>
                        -->
                          <tr>
                            <td align="right" bgcolor="#f3f3f3" class="text-3"><strong>性 
                              别：</strong></td>
                            <td align="left" bgcolor="#ffffff"><span class="text-3">
                              <input id="sex1" type="radio" checked="checked" value="1" name="user_sex" />
                              <label for="sex1">男性</label>
                              <input id="sex2" type="radio" value="2" name="user_sex" />
                              <label for="sex2">女性</label>
                            </span>
                              <label for="sex2"></label></td>
                          </tr>
                  
                          <tr>
                            <td align="right" bgcolor="#f3f3f3" class="text-3"><strong>E-Mail：</strong></td>
                            <td align="left" bgcolor="#ffffff">&nbsp;
                              <input id="user_email" style="WIDTH: 300px" maxlength="200" name="user_email" />
                              <font color="red" class="text-4">* <span class="tt7"></span></font></td>
                          </tr>
                          <tr>
                            <td align="right" bgcolor="#f3f3f3" class="text-3"><strong>邮政编码：</strong></td>
                            <td align="left" bgcolor="#ffffff">&nbsp;
                              <input id="user_zipcode" style="WIDTH: 300px" maxlength="6" name="user_zipcode" /></td>
                          </tr>
                          <tr>
                            <td align="right" bgcolor="#f3f3f3" class="text-3"><strong>联系地址：</strong></td>
                            <td align="left" bgcolor="#ffffff">&nbsp;
                              <input id="user_add" style="WIDTH: 300px" maxlength="200" name="user_add" /></td>
                          </tr>
                          <tr>
                            <td align="right" bgcolor="#f3f3f3" class="text-3"><strong>电 话：</strong></td>
                            <td align="left" bgcolor="#ffffff">&nbsp;
                              <input id="user_tel" style="WIDTH: 300px" maxlength="200" name="user_tel" /></td>
                          </tr>
                          <tr>
                            <td align="right" bgcolor="#f3f3f3" class="text-3"><strong>手 机：</strong></td>
                            <td align="left" bgcolor="#ffffff">&nbsp;
                              <input id="user_mobile" style="WIDTH: 300px" maxlength="200" name="user_mobile" /></td>
                          </tr>
                          <tr>
                            <td align="right" bgcolor="#f3f3f3" class="text-3"><strong>工作单位：</strong></td>
                            <td align="left" bgcolor="#ffffff">&nbsp;
                              <input id="user_company" style="WIDTH: 300px" maxlength="200" name="user_company" /></td>
                          </tr>
                          <tr>
                            <td align="right" bgcolor="#f3f3f3" class="text-3"><strong>客户简介：<br />
                            
                            </strong></td>
                            <td align="left" bgcolor="#ffffff">&nbsp;
                              <textarea id="user_intro" style="WIDTH: 300px; HEIGHT: 144px" name="user_intro"></textarea></td>
                          </tr>
                          <tr>
                            <td align="right" bgcolor="#f3f3f3" class="text-3">&nbsp;</td>
                            <td align="left" bgcolor="#ffffff"><input language="javascript" class="button2" id="Button1" style="WIDTH: 110px" onClick="if (typeof(Page_ClientValidate) == 'function') Page_ClientValidate(); " type="submit" value="提交保存" name="Button1" /></td>
                          </tr>
                        </tbody>
                      </table>
					  </form></td>
  </tr>
</table>
</body>
</html>