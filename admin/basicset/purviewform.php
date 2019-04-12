<?php
	$protectid="2"; 
	include("../protect.php");
	
	include_once("../../config.inc.php");
	
	$strID = $_GET['id'];	
	
	include_once(CFG_LIB_DIR.'mysqldb.inc.php');		
	$objDb = new mysqldb();
	
	$strSQL = "SELECT * FROM `".con_strPREFIX."rolesetting` WHERE RoleSettingID = ".$strID." LIMIT 1";
	$objDb->query($strSQL);
	$tmpResult = $objDb->get_data();
	$InfoResult = $tmpResult[0];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $strOperation; ?>用户组权限</title>

<?php include_once("../common/files.php"); ?>

</head>

<body id="main" >
<table summary="" id="pagehead" cellpadding="0" cellspacing="0" border="0" width="100%">
	<tr>
		<td><h1>编辑组权限</h1></td>
		<td class="actions">
			<table summary="" cellpadding="0" cellspacing="0" border="0" align="right">
				<tr>
          <td class="active"><a href="#" class="edit">编辑组权限</a></td>
					<td ><a href="#" onclick="return ConfirmCloseWinow('');">关闭</a></td>
				</tr>
			</table>
		</td>
	</tr>
</table>


<form name="infoadd" method="post" action="userpurview_act.php?act=modify&id=<?php echo $strID; ?>"> 
<div id="TabsAll">
<div id="Tab_1"> 
<table cellspacing="0" cellpadding="0" width="100%"  class="maintable">

  <tr id="infoTitleTr">
    <th width="20%">组名</th>
    <td>
     <input name="RoleName" type="text" id="RoleName" value="<?php echo $InfoResult['RoleName']; ?>" />
		 </td>
  </tr>
  <tr >
    <th>阅读权限</th>
    <td>
		<input name="ReadingRight" type="text" id="ReadingRight" value="<?php echo $InfoResult['ReadingRight']; ?>" onblur="CheckNum(this)" />　<span>(阅读新闻权限0~255之间)</span>
		</td>
  </tr>
  <tr>
    <th>是否开通发布信息权限</th>
    <td><input name="IsInfo" type="radio" value="1" <?php if($InfoResult['IsInfo'] == 1){echo "checked=\"checked\"";} ?> />
       <label for="IsInfo0"> 是</label>
       <input type="radio" name="IsInfo" value="0" <?php if($InfoResult['IsInfo'] == 0){echo "checked=\"checked\"";} ?> />
      <label for="IsInfo1">否</label>  </td>
  </tr>
  <tr>
    <th>是否审核资讯信息</th>
    <td><input type="radio" name="InfoAuditing" id="InfoAuditing1" value="1" <?php if($InfoResult['InfoAuditing'] == 1){echo "checked=\"checked\"";} ?> />
       <label for="InfoAuditing1"> 是</label>
       <input type="radio" name="InfoAuditing" id="InfoAuditing0" value="0" <?php if($InfoResult['InfoAuditing'] == 0){echo "checked=\"checked\"";} ?> />
      <label for="InfoAuditing0">否</label>  </td>
  </tr>
	<tr>
		<th>最大可以发布的信息</th>
		<td><input name="MaxInfo" type="text" id="MaxInfo" value="<?php echo $InfoResult['MaxInfo']? $InfoResult['MaxInfo'] : 0?>" onblur="CheckNum(this)" />
		<span>(请按照正确的数字格式填写,0为没限制)</span>
		</td>
	</tr>
  
  <tr >
      <th width="18%">是否开通发布供求权限</th>
      <td width="82%">   
			<input name="IsSnd" type="radio" value="1" <?php if($InfoResult['IsSnd'] == 1){echo "checked=\"checked\"";} ?> />
      <label for="IsSnd0"> 是</label>
       <input type="radio" name="IsSnd" value="0" <?php if($InfoResult['IsSnd'] == 0){echo "checked=\"checked\"";} ?> />
      <label for="IsSnd1">否</label>
      </td>
  </tr>
  <tr>
    <th>是否审核供求信息</th>
    <td><input type="radio" name="SndAuditing" id="SndAuditing1" value="1" <?php if($InfoResult['SndAuditing'] == 1){echo "checked=\"checked\"";} ?> />
       <label for="SndAuditing1"> 是</label>
       <input type="radio" name="SndAuditing" id="SndAuditing0" value="0" <?php if($InfoResult['SndAuditing'] == 0){echo "checked=\"checked\"";} ?> />
      <label for="SndAuditing0">否</label>  </td>
  </tr>   
  <tr>
    <th>最大可以发布的供求信息</th>
    <td><input name="MaxSnd" type="text" id="MaxSnd" value="<?php echo $InfoResult['MaxSnd']? $InfoResult['MaxSnd'] : 0?>" onblur="CheckNum(this)" />
      <span>(请按照正确的数字格式填写,0为没限制)</span></td>
  </tr>
	<tr>
		<th>每个供求信息的最大上传图片数量</th>
		<td>
		<input name="MaxSndPhoto" type="text" id="MaxSndPhoto" value="<?php echo $InfoResult['MaxSndPhoto']? $InfoResult['MaxSndPhoto'] : 0?>" onblur="CheckNum(this)" />
		<span>(请按照正确的数字格式填写)</span></td>
	</tr>
  
	<tr>
		<th>是否开通发布产品权限</th>
		<td>
		<input name="IsProduct" type="radio" value="1" <?php if($InfoResult['IsProduct'] == 1){echo "checked=\"checked\"";} ?> />
       <label for="IsProduct0"> 是</label>
       <input type="radio" name="IsProduct" value="0" <?php if($InfoResult['IsProduct'] == 0){echo "checked=\"checked\"";} ?> />
      <label for="IsProduct1">否</label>   </td>
	</tr>
  <tr>
    <th>是否审核产品信息</th>
    <td><input type="radio" name="ProductAuditing" id="ProductAuditing1" value="1" <?php if($InfoResult['ProductAuditing'] == 1){echo "checked=\"checked\"";} ?> />
       <label for="ProductAuditing1"> 是</label>
       <input type="radio" name="ProductAuditing" id="ProductAuditing0" value="0" <?php if($InfoResult['ProductAuditing'] == 0){echo "checked=\"checked\"";} ?> />
      <label for="ProductAuditing0">否</label>  </td>
  </tr>
	<tr>
		<th>最大可以发布的产品信息</th>
		<td><input name="MaxProduct" type="text" id="MaxProduct" value="<?php echo $InfoResult['MaxProduct']? $InfoResult['MaxProduct'] : 0?>" onblur="CheckNum(this)" />
		 <span>(请按照正确的数字格式填写,0为没限制)</span></td>
		</tr>
	<tr>
		<th>每个产品信息的最大上传图片数量</th>
		<td><input name="MaxProductPhoto" type="text" id="MaxProductPhoto" value="<?php echo $InfoResult['MaxProductPhoto']? $InfoResult['MaxProductPhoto'] : 0?>" onblur="CheckNum(this)" />
		<span>(请按照正确的数字格式填写)</span></td>
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
<?php $objDb->close(); ?>