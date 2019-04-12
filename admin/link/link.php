<?php
	$protectid="7"; 
	include("../protect.php");
	
	//include_once("../../fckeditor/fckeditor.php");
	include_once("../../config.inc.php");
	
	$strID = $_GET['id'];	
	$strAct = (empty($_GET['act'])) ? "add" : $_GET['act'];
	$strOperation = ( $strAct == "add" ) ? "添加" : "修改";
	
	include_once(CFG_LIB_DIR.'mysqldb.inc.php');		
	$objDb = new mysqldb();
	
	$strSQL = "SELECT * FROM `".con_strPREFIX."link` WHERE LinkID = ".$strID." LIMIT 1";
	$objDb->query($strSQL);
	$tmpResult = $objDb->get_data();
	$LinkRS = $tmpResult[0];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $strOperation; ?>友情链接</title>

<?php include_once("../common/files.php"); ?>

<script type="text/javascript">
	function validForm()
	{
		var arrNotBlankElement = new Array("infoTitleTr", "sortTr", "topTr", "extractTr", "publishDateTr");
		if(validNotBlank(arrNotBlankElement) == false)
			return false;
			
		var arrDateElementID = new Array("PublishDate");
		if(validDate(arrDateElementID) == false)
			return false;
			
		var arrNumElementID = new Array("SortNum", "TopNum", "ExtractNum");
		if(validSortNum(arrNumElementID) == false)
			return false;
			
		return true;
	}
function product_hot_display(me_value){
        document.all.ifpiclink.style.display=me_value;        
}
</script>
</head>

<body id="main" >
<table summary="" id="pagehead" cellpadding="0" cellspacing="0" border="0" width="100%">
	<tr>
		<td><h1><?php echo $strOperation; ?>友情链接</h1></td>
		<td class="actions">
			<table summary="" cellpadding="0" cellspacing="0" border="0" align="right">
				<tr>
          <td class="active"><a href="#" ><?php echo $strOperation; ?>友情链接</a></td>
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
        <div class="listtab" id="div_1"><a href="#" onclick="ShowSort(1);return false;" class="active"><img src="../images/icon_folder.gif" align="absmiddle">　发布友情链接</a></div>
      </div>
  	</td>
  </tr>
</table>

<form name="linkadd" method="post" action="link_ok.php?act=<?php echo $strAct; ?>&id=<?php echo $strID; ?>" onsubmit="return validForm();">
<div id="TabsAll">
<div id="Tab_1"> 
<table cellspacing="0" cellpadding="0" width="100%"  class="maintable">
  <tr id="strTips">
    <th width="20%">链接分类</th>
    <td width="82%">
      <?php
				include_once(CFG_LIB_DIR."selector.php");
				$SelCate = new clsSelCate();				
				$strCateID = ( $strAct == "add" ) ? $_GET['cid'] : $LinkRS['CateID'];
				echo $SelCate->strSelCate("1", $strCateID, con_strPREFIX."linkcategory", "CateID")
			?> 
      <span>*</span>    </td>
  </tr>

  <tr id="infoTitleTr">
    <th>链接名称</th>
    <td>
      <input type="text" name="LinkName" id="LinkName" size="60" value="<?php echo $LinkRS['LinkName']; ?>" /> <span>*</span>
  </td>
  </tr>
  <tr style="display:none;">
    <th>是否有图片LOGO链接:</th>
    <td><input name="IsPic" type="radio" onclick="javascript:product_hot_display('');" value="1" <?php if ($LinkRS['IsPic']==1){?>checked<? }?> />
有
  <input name="IsPic" type="radio" onclick="javascript:product_hot_display('none');" value="0" <?php if ($LinkRS['IsPic']==0){?>checked<? }?> />
没有</td>
  </tr>

  <tr id="ifpiclink" <?php /*?>style="display:<?php if ($LinkRS['IsPic']==0){?>none<? }?>; display:none;"<?php */?>>
    <th>LOGO图片</th>
    <td>
    	<input name="LogoPic" type="text" id="LogoPic" size="60" value="<?php echo $LinkRS['LogoPic']; ?>" />&nbsp;&nbsp;
      <span class="buttons">
        <input type="button" value="上传"  onclick="PopupWindow('../upload.php?dir=5&input=LogoPic', 380, 140);" class="submit">
        <input type="button" value="选择" onclick="PopupWindow('../pic_list.php?dir=5&input=LogoPic', 712, 600);">
			</span>		</td>
  </tr>

	<tr>
		<th>链接地址</th>
		<td><input name="LinkUrl" type="text" id="LinkUrl" size="60" value="<?php echo $LinkRS['LinkUrl']; ?>" /></td>
	</tr>
	
	<tr>
		<th>简介</th>
		<td><textarea name="desc" cols="60" rows="5" id="desc"><?php echo $LinkRS['desc']; ?></textarea></td>
	</tr>
  <tr>
    <th>语言版本</th>
    <td>
      <input type="radio" name="Lang" id="LangCn" value="cn" <?php if($LinkRS['Lang']!='en')echo 'checked="checked"'; ?> />
      <label for="LangCn">中文</label>
      <input type="radio" name="Lang" id="LangEn" value="en" <?php if($LinkRS['Lang']=='en')echo 'checked="checked"'; ?> />
      <label for="LangEn">英文</label>
    </td>
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
