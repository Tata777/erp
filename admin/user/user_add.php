<?
include "admin_pass.php";
include_once("../../class/mysqldb.inc.php");
$db=new mysqldb();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $strOperation; ?>用户</title>

<link href="../css/style.css" rel="stylesheet" type="text/css" />

<script language="JavaScript">
<!--
function check(fm)
{	var al="";
	var ischeck;
	/*for (i=4;i<fm.elements.length-2;i++)
	{	ischeck=ischeck || fm.elements[i].checked;
	}
	if (!ischeck)
	{	al="请至少要选择一个权限！";
		fm.elements[4].focus();
	}*/
	if(fm.admin_password.value!=fm.admin_password1.value)
	{	al="两次输入的密码不相同！\n"+al;
		fm.admin_password1.select();
	}
	if(tr(fm.admin_password.value)=="")
	{	al="密码不能为空！\n"+al;
		fm.admin_password.select();
	}
	if(tr(fm.admin_username.value)=="")
	{	al="用户名不能为空！\n"+al;
		fm.admin_username.select();
	}
	if(tr(fm.admin_truename.value)=="")
	{	al="真实姓名不能为空！\n"+al;
		fm.admin_truename.select();
	}
	if(al!="")
	{	alert(al);
		return false;
	}
}
//-->
</script>
<script language="VBScript">
<!--
function tr(a)
	tr=trim(a)
end function
//-->
</script>

</head>

<body id="main" >
<table summary="" id="pagehead" cellpadding="0" cellspacing="0" border="0" width="100%">
	<tr>
		<td><h1>添加用户</h1></td>
		<td class="actions">
			<table summary="" cellpadding="0" cellspacing="0" border="0" align="right">
				<tr>
          <td class="active"><a href="#" ><?php echo $strOperation; ?>用户</a></td>
					<td ><a href="#" onclick="return ConfirmCloseWinow('');">关闭</a></td>
				</tr>
			</table>
		</td>
	</tr>
</table>

<table width="100%">
  <tr>
  	<td>
      <div id="listtab">
        <div class="listtab" id="div_1"><a href="#" onclick="ShowSort(1);return false;" class="active"><img src="../images/icon_folder.gif" align="absmiddle">　添加用户</a></div>
      </div>
  	</td>
  </tr>
</table>
<?
if(isset($_POST['admin_username'])){
$admin_username=$_POST['admin_username'];
$admin_password=md5($_POST['admin_password']);
$admin_truename=$_POST['admin_truename'];
$admin_flag=$_POST['admin_flag'];


if($admin_username!="")
{	//检查是否重名
	$sql="select * from admin where ad_username='$admin_username'";
	$db->query($sql);
	$num=$db->get_num1();
	if($num!=0)
	{	echo "<script language=\"JavaScript\">";
		echo "alert(\"用户名已有，请换一个用户名！\");";
		echo "history.back()";
		echo "</script>";
		die();
	}
	//设置权限
$flag="";
if(count($admin_flag)>0)
  {
	$flag=0;
	for ($i=0;$i<count($admin_flag);$i++)
     {
      $flag=$flag.",".$admin_flag[$i];
	      }
  }
	else
	{
		$flag="demo";
	}
	$insert_sql="insert into admin values('','$admin_truename','$admin_username','$admin_password','$flag')";
	$db->query($insert_sql);
	echo "<script language=\"JavaScript\">";
	echo "alert(\"新用户添加成功！\");";
	echo "location.href=\"index.php\"";
	echo "</script>";
	die;
 }
}
?>
<form name="fm" method="post" action="user_add.php" onSubmit="return check(this);">
<div id="TabsAll">
<div id="Tab_1"> 
<table cellspacing="0" cellpadding="0" width="100%"  class="maintable">
  <tr id="strTips">
    <th width="20%">真实姓名</th>
    <td width="80%"><input type="text" name="admin_truename" style="width:200px;" />
      <span>*</span>    </td>
  </tr>

  <tr id="infoTitleTr">
    <th>用户名称</th>
    <td><input type="text" name="admin_username" style="width:200px;" /></td>
  </tr>
  <tr >
    <th>密&nbsp;&nbsp;&nbsp;&nbsp;码</th>
    <td><input type="password" name="admin_password" style="width:200px;"></td>
  </tr>

  <tr>
    <th>确认密码</th>
    <td><input type="password" name="admin_password1" style="width:200px;" /></td>
  </tr>

	<tr>
		<th>用户权限<br />
    <span>
若为最高级管理理员则不做权限选择
</span></th>
		<td height="16" colspan="2">
              <? 
				  $websortsql="select sort_id,sort_name from websort where sort_id!=1 and  parentid=0 and ifdisplay=1  and sort_id in ($leftflag) order by sort_id asc";
				  $db->query($websortsql);
				  $websortnum=$db->get_num1();
				  $websortresult=$db->get_data();
				  for($i=0;$i<$websortnum;$i++){?>
              <table width="100%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF" bordercolorlight="#CCCCCC" bordercolordark="#FFFFFF">
                <tr>
                  <th width="21%"><input type="checkbox" name="admin_flag[]" value="<? 
echo $websortresult[$i]["sort_id"];?>" >
                  <? echo $websortresult[$i]["sort_name"];?>&nbsp;&nbsp;</th>
                  <td width="79%"><? 
				  $parentid=$websortresult[$i]["sort_id"];
				  $websortsql1="select sort_id,sort_name from websort where  ifdisplay=1 and parentid=$parentid order by sort_id asc";
				  $db->query($websortsql1);
				  $websortnum1=$db->get_num1();
				  $websortresult1=$db->get_data();
				  for($j=0;$j<$websortnum1;$j++){?>
                    <input type="checkbox" name="admin_flag[]" value="<? 
echo $websortresult1[$j]["sort_id"].",".$websortresult[$i]["sort_id"];?>" >                    
                  <? echo $websortresult1[$j]["sort_name"];?>&nbsp;&nbsp;<? }?></td>
                </tr>
              </table>
            <? }?></td>
	</tr>
</table>
</div>



</div>

<div class="buttons">
	<input type="submit" value="提交保存" class="submit">
	<input type="reset" value="重新设置">
</div>

</form>
<br>
<?php include "../bottom.php"; ?>
</div>
</body>
</html>
