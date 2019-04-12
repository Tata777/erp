<?php
$protectid="309,400,401"; 
include("../protect.php");
include_once("../../config.inc.php");
include_once(CFG_LIB_DIR.'mysqldb.inc.php');
$objDb = new mysqldb();
$strAction="add";
?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<style>
.ulCss1{list-style:none; list-style-type:none; margin:0px; padding:0px;}
.ulCss1 li{margin:0px; padding:0px;}
body,td,th {
	font-size: 12px;
}
</style>
<script type="text/javascript">
<!--
function checkFrm(dom){
	if(dom.Title.value==""){
		alert("请输入标题");
		dom.Title.focus();
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
					<td><a href="video_add.php" style="color:#06C">添加画册</a></td>
				</tr>
			</table>
		</td>
	</tr>
</table>

<?php
if($id>0){
	$sql="select * from `".con_strPREFIX."pictrue` where ID='$id'";
	$objDb->query($sql);
	$rss=$objDb->get_data();
	if($rss){
		$intID=$rss[0]['ID'];
		$strTitle=$rss[0]['Title'];
		$strPhoto=$rss[0]['Photo'];
		$strAction="edit";
	}
}
?>
<fieldset>
	<legend><?=($intID>0?"修改":"添加")?>画册</legend>
  <div>
  <form name="form1" id="form1" action="ok.php?id=<?=$intID?>" method="post" onsubmit="return checkFrm(this);">
  <input name="action" type="hidden" value="<?=$strAction?>" />
  <div>
    <ul class="ulCss1">
    	<li>
      	<span style="padding-left:20px;">标题：<input name="Title" type="text" value="<?=$strTitle?>" size="40" maxlength="255" /></span>
  		</li>
      <li>&nbsp;</li>
      <li>
        <span style="padding-left:20px;">图片:</span><span><input name="Photo" id="Photo" type="text" value="<?=$strPhoto?>" size="40" maxlength="255" /></span>&nbsp;&nbsp;
      	<span class="buttons">
        <input type="button" value="上传"  onclick="PopupWindow('../upload.php?dir=20&input=Photo', 380, 140);" class="submit">
				<input type="button" value="选择" onclick="PopupWindow('../pic_list.php?dir=20&input=Photo', 712, 600);">
				</span>
      </li>
      <li>&nbsp;</li>
      <li><input name="submit" type="submit" value="提交" /><input name="reset" type="reset" value="重置" /></li>
    </ul>
  </div>
  </form>
  </div>
</fieldset>
</body>
</html>