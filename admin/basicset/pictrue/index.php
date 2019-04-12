<?php
$protectid="309,400,401"; 
include("../protect.php");
include_once("../../config.inc.php");
include_once(CFG_LIB_DIR.'mysqldb.inc.php');
$objDb = new mysqldb();
$page=$_GET["page"];
if(empty($page)){$page=1;}
?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Administrator's Control Panel</title>
<style type="text/css">
<!--
body,td,th {
	font-size: 12px;
}
a:link {
	text-decoration: none;
	color: #F00;
}
a:visited {
	text-decoration: none;
	color: #F00;
}
a:hover {
	text-decoration: none;
	color: #F0F;
}
a:active {
	text-decoration: none;
	color: #F00;
}
-->
</style>
<script type="text/javascript">
<!--
function setselall(s){
	var dom=document.getElementsByName("sel[]");
	var domflag=false;
	if(s==true){domflag=true;}
	for(i=0;i<dom.length;i++){
		dom[i].checked=domflag;
	}
}

function checkchoose(){
	var dom=document.getElementsByName("sel[]");
	var num=0;
	for(i=0;i<dom.length;i++){
		if(dom[i].checked==true){
			num +=1;
			break;
		}
	}
	if(num==0){
		alert('请选择要进行操作的记录');
		return false;
	}
	else{
		return true;
	}
}
-->
</script>

<?php include_once("../common/files.php"); ?>
</head>

<body id="main">
<table summary="" id="pagehead" cellpadding="0" cellspacing="0" border="0" width="100%">
	<tr>
		<td><h1>画册管理</h1></td>
		<td class="actions">
			<table summary="" cellpadding="0" cellspacing="0" border="0" align="right">
				<tr>
					<td class="active"><a href="index.php" class="view" style="color:#06C">浏览画册信息</a></td>
					<td><a href="add.php" style="color:#06C">添加画册</a></td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<form name="form1" method="post" action="del.php" onsubmit="return checkchoose();">
<input name="action" type="hidden" value="del" />
<table width="100%" border="1" cellspacing="0" cellpadding="0" bordercolordark="#FFFFFF" bordercolorlight="#E1E1F0">
  <tr style="font-weight:bold;">
    <td width="60" bgcolor="#F3F7FF"><input name="selAll" type="checkbox" value="" onclick="setselall(this.checked)" style="background-color:#F3F7FF;" />
      全选</td>
    <td bgcolor="#F3F7FF">标题</td>
    <td width="120" bgcolor="#F3F7FF">时间</td>
    <td width="100" bgcolor="#F3F7FF">排序</td>
    <td colspan="2" align="center" bgcolor="#F3F7FF">操作</td>
    </tr>
<?php
$pagesize=10;
$sNum=($page-1)*$pagesize;
$sql="select count(*) as counter from `".con_strPREFIX."pictrue`";
$objDb->query($sql);
$rss=$objDb->get_data();
$recordcount=$rss[0]["counter"];
$pagecount=intval($recordcount/$pagesize);
$modNum=$rss[0]["counter"]%$pagesize;
if($modNum>0){$pagecount +=1;}

$sql="select * from `".con_strPREFIX."pictrue` order by sortNum asc, ID desc limit $sNum,$pagesize";
//echo $sql;exit;
$objDb->query($sql);
$rss=$objDb->get_data();
if($rss){
	foreach($rss as $v){
		$intID=$v['ID'];
		$strTitle=$v['Title'];
		$strPhoto=$v['Photo'];
		$dtmCreateTime=$v['CreateTime'];
		$intSortNum=$v['sortNum'];
?>
  <tr>
    <td width="60"><input name="sel[]" id="sel[]" type="checkbox" value="<?=$intID?>" /></td>
    <td><?=$strTitle?></td>
    <td width="120"><?=date("Y-m-d",$dtmCreateTime)?></td>
    <td width="100" align="center"><input name="sortNum<?=$intID?>" type="text" id="sortNum" size="10" value="<?=$intSortNum?>" /></td>
    <td width="50" align="center"><a href="add.php?id=<?=$intID?>" style="color:#06C;">编辑</a></td>
    <td width="50" align="center"><a href="del.php?id=<?=$intID?>&page=<?=$page?>&action=del" style="color:#06C;" onclick="javascript:return confirm('您确定要删除此记录吗？')">删除</a></td>
  </tr>
<?php
	}
}
?>
  <tr>
    <td colspan="9" align="center" style="padding-top:10px; padding-bottom:10px;">
    <?php
		if($page>1){
		?>
      <a href="?page=1" style="color:#06C;">首页</a>&nbsp;&nbsp;
      <a href="?page=<?=($page-1)?>" style="color:#06C;">上一页</a>
    <?php
		}else{
		?>
      首页&nbsp;&nbsp;上一页
		<?php }?>
    &nbsp;&nbsp;
    <?php
		if($pagecount>$page){
		?>
      <a href="?page=<?=($page+1)?>" style="color:#06C;">下一页</a>&nbsp;&nbsp;
      <a href="?page=<?=$pagecount?>" style="color:#06C;">末页</a>
    <?php
		}else{
		?>
      下一页&nbsp;&nbsp;末页
		<?php }?>
    &nbsp;&nbsp;跳到第
    <select name="pageIndex" onchange="location.href=this.value;">
    <?php
    for ($i=1;$i<=$pagecount;$i++){
		?>
      <option value="?page=<?=$i?>" <?php if($i==$page){echo "selected";}?> ><?=$i?></option>
    <?php
		}
		?>
    </select>
    页
      <br />
      <div style="text-align:left;"><input name="submit" type="submit" value="删除" />&nbsp;<input name="submit2" type="submit" value="排序" onclick="document.getElementById('action').value='sortNum';" /></div></td>
  </tr>
  </table>
</form>
<br /><br />
<?php include "../bottom.php"; ?>
</body>
</html>