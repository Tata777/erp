<?php
	$protectid="14"; 
	include("../protect.php");
	
	//include_once("../../fckeditor/fckeditor.php");
	include_once("../../config.inc.php");
	
	$strID = $_GET['id'];	
	$strAct = (empty($_GET['act'])) ? "add" : $_GET['act'];
	$strOperation = ( $strAct == "add" ) ? "添加" : "修改";
	
	include_once(CFG_LIB_DIR.'mysqldb.inc.php');		
	$objDb = new mysqldb();
	
	$strSQL = "SELECT * FROM `".con_strPREFIX."sys_products` WHERE SysProductsID = ".$strID." LIMIT 1";
	$objDb->query($strSQL);
	$tmpResult = $objDb->get_data();
	$ProResult = $tmpResult[0];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $strOperation; ?>产品</title>
<!---->
<!--<script type="text/javascript" src="../../ueditor/editor_config.js"></script>-->
<!--<script type="text/javascript" src="../../ueditor/editor_all.js"></script>-->

    <script type="text/javascript" src="../ueditor/ueditor.config.js"></script>
    <script type="text/javascript" src="../ueditor/ueditor.all.min.js"></script>
    <script type="text/javascript" src="../ueditor/lang/zh-cn/zh-cn.js"></script>

<?php include_once("../common/files.php"); ?>

<script type="text/javascript">
	function validForm()
	{
		var arrNotBlankElement = new Array("infoTitleTr", "sortTr", "topTr", "extractTr", "publishDateTr");
		if(validNotBlank(arrNotBlankElement) == false)
			return false;
			
		var arrDateElementID = new Array("ValidDate");
		if(validDate(arrDateElementID) == false)
			return false;
			
		var arrNumElementID = new Array("SortNum", "TopNum", "ExtractNum");
		if(validSortNum(arrNumElementID) == false)
			return false;
			
		return true;
	}
	
</script>
</head>

<body id="main" >
<table summary="" id="pagehead" cellpadding="0" cellspacing="0" border="0" width="100%">
	<tr>
		<td><h1><?php echo $strOperation; ?>产品</h1></td>
		<td class="actions">
			<table summary="" cellpadding="0" cellspacing="0" border="0" align="right">
				<tr>
          <td class="active"><a href="#" ><?php echo $strOperation; ?>产品</a></td>
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
        <div class="listtab" id="div_1"><a href="#" onclick="ShowSort(1);return false;" class="active"><img src="../images/icon_folder.gif" align="absmiddle">　发布产品</a></div>
        <div class="listtab" id="div_2"><a href="#" onclick="ShowSort(2);return false;"><img src="../images/icon_folder2.gif" align="absmiddle"> 基本设置</a></div>
      </div>
  	</td>
  </tr>
</table>

<form name="proadd" method="post" action="product_ok.php?act=<?php echo $strAct; ?>&id=<?php echo $strID; ?>" onsubmit="return validForm();"> 
<div id="TabsAll">
<div id="Tab_1"> 
<table cellspacing="0" cellpadding="0" width="100%"  class="maintable">
  <tr id="strTips">
    <th width="20%">产品类别</th>
    <td width="82%">
      <?php
				include_once(CFG_LIB_DIR."selector.php");
				$SelCate = new clsSelCate();				
				$strCateID = ( $strAct == "add" ) ? $_GET['cid'] : $ProResult['CateID'];
				echo $SelCate->strSelCate("1", $strCateID, con_strPREFIX."sys_procategory", "CateID", "", "", "", "1", "1");
			?> 
      <span>*</span>
    </td>
  </tr>
  <tr id="strTips" style="display:none;">
    <th width="20%">所属品牌</th>
    <td width="82%">
      <?php
				$strCateID = ( $strAct == "add" ) ? $_GET['cid'] : $ProResult['BrandID'];
				echo $SelCate->strSelCate("1", $strCateID, con_strPREFIX."brandcategory", "BrandID", "", "", "", "1", "1");
			?> 
      <span>*</span>
    </td>
  </tr>
  <tr style="display:none;">
    <th>促销</th>
    <td><label>
      <input type="radio" name="Tag" id="tag1" value="<?php echo $ProResult['Tag']; ?>" />
      促销 
      <input type="radio" name="Tag" id="tag2" value="<?php echo $ProResult['Tag']; ?>" checked="checked" />
      不促销
    </label></td>
  </tr>
  <tr id="infoTitleTr">
    <th><span id="p_name">产品名称</span></th>
    <td>
      <input type="text" name="ProductName" id="ProductName" size="60" value="<?php echo $ProResult['ProductName']; ?>" /> <span>*</span>
    </td>
  </tr>
<!--  <tr >-->
<!--    <th><span id="p_subname">产品编号</span></th>-->
<!--    <td><input type="text" name="SubName" id="SubName" size="60" value="--><?php //echo $ProResult['SubName']; ?><!--" /> </td>-->
<!--  </tr>-->
  <!--<tr>
    <th>产品缩略图</th>
    <td>
    	<input name="FirstPhoto" type="text" id="FirstPhoto" size="60" value="<?php echo $ProResult['FirstPhoto']; ?>" />&nbsp;&nbsp;
      <span class="buttons">
        <input type="button" value="上传"  onclick="PopupWindow('../upload.php?dir=2&input=FirstPhoto', 380, 140);" class="submit">
				<input type="button" value="选择" onclick="PopupWindow('../pic_list.php?dir=2&input=FirstPhoto', 712, 600);">
			</span>
      <span>产品的宽高为132*96</span>
		</td>
  </tr>-->
  <tr>
    <th>产品图片</th>
    <td>
    	<input name="Photos" type="text" id="Photos" size="60" value="<?php echo $ProResult['Photos']; ?>" />&nbsp;&nbsp;
      <span class="buttons">
        <input type="button" value="上传"  onclick="PopupWindow('../upload.php?dir=17&input=Photos', 380, 140);" class="submit">
				<input type="button" value="选择" onclick="PopupWindow('../pic_list.php?dir=17&input=Photos', 712, 600);">
			</span>
		</td>
  </tr>
  <!--
  <tr>
    <th>产品大图</th>
    <td>
    	<input name="Photos1" type="text" id="Photos1" size="60" value="<?php echo $ProResult['Photos1']; ?>" />&nbsp;&nbsp;
      <span class="buttons">
        <input type="button" value="上传"  onclick="PopupWindow('../upload.php?dir=17&input=Photos1', 380, 140);" class="submit">
				<input type="button" value="选择" onclick="PopupWindow('../pic_list.php?dir=17&input=Photos1', 712, 600);">
			</span>
		</td>
  </tr>
  -->
    <tr style=" display:none;">
    <th>上传附件<br /></th>
    <td>
    	<input name="Files" type="text" id="Files" size="60" value="<?php echo $InfoResult['Files']; ?>" />&nbsp;&nbsp;
      <span class="buttons">
        <input type="button" value="上传"  onclick="PopupWindow('../uploadfiled.php?dir=15&input=Files', 380, 140);" class="submit">
				<input type="button" value="选择" onclick="PopupWindow('../file_list.php?dir=15&input=Files', 712, 600);">
			</span>	
      <span><br />
      上传文件支持格式为pdf,xls,doc文件,且不能大于2M</span>
    </td>
  </tr>
	<tr style="display:none;">
		<th><span id="p_price">产品价格</span></th>
		<td><input name="Price" type="text" id="Price" size="60" value="<?php echo $ProResult['Price']; ?>" /></td>
	</tr>
	<tr style="display:none;">
	  <th>特价</th>
	  <td><input type="text" name="Color" id="Color" size="60" value="<?php echo $ProResult['Color']; ?>"/></td>
	  </tr>
 <tr style="display:none;">
      <th width="20%">单位</th>
      <td width="82%"><input name="Unit" type="text" id="Unit" size="60" value="<?php echo $ProResult['Unit']; ?>" /></td>
  </tr>    
  <tr style="display:none;">
    <th>规格</th>
    <td><input type="text" name="Size" id="Size" size="60" value="<?php echo $ProResult['Size']; ?>"/></td>
  </tr>
 
	<tr>
	  <th>详细信息</th>
	  <td>

	  
	    <textarea name="Note" id="Note"><?=$ProResult['Note']?></textarea>
<script type="text/javascript">
    // var editor = new UE.ui.Editor();
    // editor.render("Note");
    //1.2.4以后可以使用一下代码实例化编辑器
    UE.getEditor('Note',{initialFrameWidth:800,initialFrameHeight:400})
</script>
	  
	  		</td>
	  </tr>
</table>
</div>

<div id="Tab_2" style="display: none;">
<table cellspacing="0" cellpadding="0" width="100%"  class="maintable" >
	<!--<tr>
    <th>搜索关键字</th>
  	<td><input type="text" name="Tag" id="Tag" size="60" value="<?php echo $ProResult['Tag']; ?>" />（用半角,分隔）</td>
  </tr>-->
<!--	<tr>
    <th>平邮</th>
  	<td><input type="text" name="Postage" id="Postage" size="60" value="<?php echo $ProResult['Postage']; ?>" />（平邮的费用,以标准的价格格式填写.如 9.80）</td>
  </tr>
	<tr>
    <th>快递</th>
  	<td><input type="text" name="Express" id="Express" size="60" value="<?php echo $ProResult['Express']; ?>" />（快递的费用,以标准的价格格式填写.如 9.80）</td>
  </tr>
	<tr>
    <th>EMS</th>
  	<td><input type="text" name="Ems" id="Ems" size="60" value="<?php echo $ProResult['Ems']; ?>" />（EMS的费用,以标准的价格格式填写.如 9.80）</td>
  </tr>
-->  <tr>
    <th>锁定</th>
    <td>
      <input type="radio" name="IsLock" id="IsLock" value="1" <?php if($ProResult['IsLock'])echo 'checked="checked"'; ?> />
      <label for="IsLock">是</label>
      <input type="radio" name="IsLock" id="IsUnLock" value="0" <?php if(!$ProResult['IsLock'])echo 'checked="checked"'; ?> />
      <label for="IsUnLock">否</label>
    </td>
  </tr>
  <tr id="sortTr">
    <th>排序号</th>
    <td><input type="text" name="SortNum" id="SortNum" size="10" value="<?php echo (!isset($ProResult['SortNum'])) ? "9999" : $ProResult['SortNum']; ?>" /> <span>*请填写排列序号从小到大排列 注9999为不参与排序</span></td>
  </tr>
<tr >
    <th>语言</th>
    <td>
      <input type="radio" name="Lang" id="LangCn" value="cn" <?php if( $ProResult['Lang']!='en' && $InfoResult['Lang']!='fn')echo 'checked="checked"'; ?> />
      <label for="LangCn">简体</label>
      <input type="radio" name="Lang" id="LangEn" value="en" <?php if( $ProResult['Lang']=='en')echo 'checked="checked"'; ?> />
      <label for="LangEn">英文</label>
      <input type="radio" name="Lang" id="LangFn" value="fn" <?php if($ProResult['Lang']=='fn')echo 'checked="checked"'; ?> />
      <label for="LangFn">繁体</label>
    </td>
  </tr>

  <tr id="topTr" style="display:none;">
    <th>推荐权值</th>
    <td><input type="text" name="TopNum" id="TopNum" size="10" value="<?php echo (!isset($ProResult['TopNum'])) ? "9999" : $ProResult['TopNum']; ?>" /> <span>*请填写推荐权值从小到大排列 注9999为不参与排序</span></td>
  </tr>
  <tr id="extractTr" style="display:none;">
    <th>活动权值</th>
    <td><input type="text" name="ExtractNum" id="ExtractNum" size="10" value="<?php echo (!isset($ProResult['ExtractNum'])) ? "9999" : $ProResult['ExtractNum']; ?>" />  <span>*请填活动权值写从小到大排列 注9999为不参与排序</span></td>
  </tr>
<!--	<tr id="publishDateTr">
		<th>有效时间</th>
		<td>
    	<input type="text" name="ValidDate" id="ValidDate" size="10" value="<?php echo (!isset($ProResult['ValidDate'])) ? date("Y-m-j") : date("Y-m-j", $ProResult['ValidDate']); ?>" /> <span>*</span>
      <img src="../js/jscalendar/img.gif" id="f_trigger_c2"
           style="cursor: pointer; border: 1px solid red;"
           title="Date selector"
           onmouseover="this.style.background='red';"
           onmouseout="this.style.background=''" />
      <script type="text/javascript">
          Calendar.setup({
              inputField     :    "ValidDate",
              ifFormat       :    "%Y-%m-%d",
              button         :    "f_trigger_c2",
              align          :    "Tl",
              singleClick    :    false
          });
      </script>
      (输入格式例如 : 2007-04-05)
    </td>
	</tr>-->
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