<?php
	$protectid="9"; 
	include("../protect.php");
	ini_set('display_errors',1);
  error_reporting(E_ALL);

	include_once("../../config.inc.php");
	$strID = $_GET['id'];	
	$strAct = (empty($_GET['act'])) ? "add" : $_GET['act'];
	$strOperation = ( $strAct == "add" ) ? "添加" : "修改";
	include_once(CFG_LIB_DIR.'mysqldb.inc.php');		
	$objDb = new mysqldb();
	
	include_once(CFG_LIB_DIR.'purviewlist.php');
	$objPre = new clsPurviewList();
	$arrPreList = $objPre -> arrPurviewList('rolesetting','','RoleSettingID');
	
	$strSQL = "SELECT * FROM `".con_strPREFIX."rolesetting` WHERE RoleSettingID = ".$strID." LIMIT 1";
	$objDb->query($strSQL);
	$tmpResult = $objDb->get_data();
	$InfoResult = $tmpResult[0];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>用户组权限</title>
<?php include_once("../common/files.php"); ?>
<script type="text/javascript">
function war(intId)
{	
  if(confirm("确认删除吗"))
    {
	  window.location.href = "userpurview_act.php?act=del&id="+intId;
	 }
}
</script>

</head>
<body id="main">
<table summary="" id="pagehead" cellpadding="0" cellspacing="0" border="0" width="100%">
  <tr>
    <td><h1>用户组权限</h1></td>
    <td class="actions"><table summary="" cellpadding="0" cellspacing="0" border="0" align="right">
        <tr>
          <td class="active"><a href="userpurview.php" class="view">查看用户组</a></td>
        </tr>
      </table></td>
  </tr>
</table>
<table cellspacing="2" cellpadding="2" class="helptable">
  <tr>
    <td><ul>
        <li><? echo $companyname;?>通过用户组对用户的权限进行控制。</li>
        <li>通过权限控制，您可以指定归属于该用户组的会员，是否能发布信息，是否能发布供求，是否能发布产品，发布的信息最大数量，上传图片的最大数量等权限。</li>
      </ul></td>
  </tr>
</table>
<form action="userpurview_act.php?act=batch" method="post">
<table cellspacing="0" cellpadding="0" width="100%"  class="listtable">
  <tr>
    <th>组名</th>
    <th>阅读权限</th>
    <th>操作</th>
  </tr>
	<?php 
	foreach($arrPreList as $key=>$strVal)
	{
	?>
  <tr onmouseover="chgColor(this, 'over');" onmouseout="chgColor(this, 'out');">
    <td style="font-weight:bold">
		<input type="hidden" name="RoleSettingID[]" value="<?php echo $strVal['RoleSettingID']; ?>" />
		<input name="RoleName[]" type="text" id="RoleName[]" value="<?=$strVal['RoleName']?>" />
		</td>
    <td align="center">
		<input name="ReadingRight[]" type="text" id="ReadingRight[]" value="<?=$strVal['ReadingRight']?>" onblur="CheckNum(this)" />
		</td>
    <td align="center">
		<span class="buttons">
		<input type="button" value=" 编 辑 " class="submit" onclick="PopupWindow('purviewform.php?act=modify&id=<?php echo $strVal['RoleSettingID']; ?>', 800, 600)" /><input type="button" value=" 删 除 " class="submit" onClick="javascript:war('<?php echo $strVal['RoleSettingID']; ?>')" />
		</span>
		</td>
    </tr>

	<?php
	}
	?>
	  <tr>
    <td colspan="3" style="font-weight:bold; text-align:center;">
		<span class="buttons">
		  <input type="submit" value="提交保存" class="submit" />
		</span>	
		</td>
		</tr>
</table>
</form>
<br />
<table summary="" id="pagehead" cellpadding="0" cellspacing="0" border="0" width="100%">
  <tr>
    <td><h1><?php echo $strOperation; ?>用户组</h1></td>
    <td class="actions"><table summary="" cellpadding="0" cellspacing="0" border="0" align="right">
        <tr>
          <td class="active"><a href="userpurview.php" class="<?php echo ( $strAct == "add" ) ? "add" : "edit";?>"><?php echo $strOperation; ?>用户组</a></td>
        </tr>
      </table></td>
  </tr>
</table>
<form action="userpurview_act.php" method="post" name="addgroup">
  <table cellspacing="0" cellpadding="0" width="100%"  class="listtable">
    <tr>
      <td style="font-weight:bold; text-align:center;">组名</td>
      <td align="center"><label>
        <input name="RoleName" type="text" id="RoleName" value="<?php echo $InfoResult['RoleName']; ?>" />
        </label></td>
      <td style="font-weight:bold; text-align:center;">阅读权限</td>
      <td align="center">
			<input name="ReadingRight" type="text" id="ReadingRight" value="<?php echo $InfoResult['ReadingRight'] ? $InfoResult['ReadingRight']:0;?>" onblur="CheckNum(this)" />
			</td>
      <td align="center">
			 <input type="hidden" name="act" id="act" value="<?php echo (empty($_GET['act'])) ? "add" : $_GET['act']?>" />
			<input type="submit" value="提交保存" class="submit">
			<input type="reset" value="重新设置">
			</td>
    </tr>
  </table>
</form>
<br>
<?php include "../bottom.php"; ?>
</div>
</body>
</html>