<?
include "admin_pass.php";
include_once("../../config.inc.php");	
include_once ("../../class/mysqldb.inc.php");
$db=new mysqldb();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Administrator's Control Panel</title>
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<script language="JavaScript">
<!--
function del(w)
{	
	if(confirm("真的要删除吗？"))
		{	window.location.href=("admin_del.php?id="+w)
			return true
		}
}
function mOvr(src,clrOver)
{	
   if (!src.contains(event.fromElement))
	{	 src.bgColor = clrOver;
	}
}
function mOut(src,clrIn)
{	if (!src.contains(event.toElement))
	{	src.bgColor = clrIn;
	}
}
//-->
</script>
</head>
<body id="main" >
<?
$sql="select * from admin where ad_flag<>'$webadminflag' order by ad_id desc";
$rs=mysql_query($sql);
?>
<table summary="" id="pagehead" cellpadding="0" cellspacing="0" border="0" width="100%">
  <tr>
    <td><h1>用 户 管 理 </h1></td>
  </tr>
</table> 
	<table cellspacing="0" cellpadding="0" width="100%"  class="listtable">
    <tr> 
      <th width="12%">用户姓名</th>
      <th width="19%">用户名</th>
      <th width="50%">用户权限</th>
      <th width="9%">修改</th>
      <th width="10%">删除</th>
    </tr>
<?php
if (mysql_num_rows($rs)==0)	die("<tr align='center'><td colspan='5'><font color=red>没有用户!</font></td></tr></table>");
		while ($rss=mysql_fetch_array($rs))
		{
		?>
				<tr>
					<td><? echo $rss['ad_truename'];?></td>
					<td><? echo $rss["ad_username"];?> </td>
					<td><?
			$sortid=$rss["ad_flag"];
			$websortsql="select * from websort where sort_id in ($sortid)";
			$db->query($websortsql);
			$websortresult=$db->get_data();
			$websortnum=$db->get_num1();
			for ($i=0;$i<$websortnum;$i++){
			 ?><? echo $websortresult[$i]["sort_name"];?>&nbsp;&nbsp;<? }?></td>
					<td><a href="admin_edit.php?id=<?=$rss['ad_id']?>">修改</a></td>
					<td><a href="javascript:del(<?=$rss['ad_id']?>)">删除</a></td>
				</tr>
		<?php
}
?>
	</table>
<?php include "../bottom.php"; ?>
</body>
</html>
