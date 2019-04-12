<?php
	$protectid="131"; 
	include("../protect.php");
	
	include_once("../../config.inc.php");
	
	$strID = $_GET['id'];	
	$strAct = (empty($_GET['act'])) ? "add" : $_GET['act'];
	$strOperation = ( $strAct == "add" ) ? "添加" : "修改";
	
	include_once(CFG_LIB_DIR.'mysqldb.inc.php');		
	$objDb = new mysqldb();
	
	$strSQL = "SELECT * FROM `".con_strPREFIX."blockstyle` WHERE BlockStyleID = ".$strID." LIMIT 1";
	$objDb->query($strSQL);
	$tmpResult = $objDb->get_data();
	$StyleResult = $tmpResult[0];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $strOperation; ?>风格</title>
<?php include_once("../common/files.php"); ?>
<script type="text/javascript">
	function validStyleFrom(objForm)
	{		
		if(blank(objForm.CateID.value))
		{
			alert('请选择类别');
			objForm.CateID.focus();
			return false;
		}
		
		if(blank(objForm.StyleTitle.value))
		{
			alert('请输入方案名');
			objForm.StyleTitle.focus();
			return false;
		}
		
		if(blank(objForm.FileName.value))
		{
			alert('请选择风格文件');
			objForm.FileName.focus();
			return false;
		}
		
		return true;
	}
</script>
</head>

<body id="main">
<table summary="" id="pagehead" cellpadding="0" cellspacing="0" border="0" width="100%">
	<tr>
		<td><h1>模块风格</h1></td>
		<td class="actions">
			<table summary="" cellpadding="0" cellspacing="0" border="0" align="right">
				<tr>
					<td><a href="index.php" class="view">浏览风格</a></td>
					<td class="active"><a href="#" class="<?php echo ($strAct == "modify") ? "edit" : "add"; ?>"><?php echo $strOperation; ?>新风格</a></td>	
				</tr>
			</table>
		</td>
	</tr>
</table>

<form method="post" action="style_ok.php?act=<?php echo $strAct; ?>&id=<?php echo $strID; ?>" onsubmit="return validStyleFrom(this);">
<table cellspacing="0" cellpadding="0" width="100%"  class="maintable">
  <tr id="strTips">
    <th width="20%">模块<p>请为该风格指定一个模块。只有指定的模块，才可以使用本风格</p></th>
    <td width="80%">
      <?php
				include_once(CFG_LIB_DIR."selector.php");
				$SelCate = new clsSelCate();				
				$strCateID = ( $strAct == "add" ) ? $_GET['cid'] : $StyleResult['CateID'];
				echo $SelCate->strSelCate("1", $strCateID, con_strPREFIX."blockcategory", "CateID", "", "", "", 1, 1)
			?> 
      <span>*</span>
    </td>
  </tr>
  
  <tr id="tr_tplname">
    <th>模块方案名</th>
    <td><input type="text" name="StyleTitle" id="StyleTitle" size="30" value="<?php echo $StyleResult['StyleTitle']; ?>" /> <span>*</span></td>
  </tr>
  
  <tr id="tr_tplnote">
    <th>详细说明<p>对本模块具体的显示样式作详细介绍说明</p></th>
    <td><textarea name="Intro" style="width:98%;" rows="5"><?php echo $StyleResult['Intro']; ?></textarea></td>
  </tr>
  
  <tr id="tr_">
    <th>风格模板文件地址<p>请选择现有的模块风格文件。也可以新建一个模块风格文件，文件后缀名必须为 .php.php ，并且上传到 blocks 目录下面</p></th>
    
    <td>
      目录名: /blocks/
      <br />
      文件名: 
      <select name="FileName" id="FileName">
      	<option value="">选择一个存在的风格文件</option>
        <?php
					$objDir = dir("../../blocks");
					while($file = $objDir->read())
					{
						$strFullName = $objDir->path."/".$file;
						if(is_file($strFullName) && preg_match('/html.php$/', $file))
						{
							$strSelected = ($StyleResult['FileName'] == $file) ? "selected=\"selected\"" : "";
							echo "<option value=\"$file\" $strSelected>$file</option>"."\n";
						}
					}
					$objDir->close();
				?>
     	</select> 
      <span>*</span>   
    </td>
  </tr>
</table>

<div class="buttons">
  <input type="submit" value="提交保存" class="submit" />
  <input type="reset" value="重置" />
</div>
</form>

<br />
<?php include "../bottom.php"; ?>
</div>

</body>
</html>