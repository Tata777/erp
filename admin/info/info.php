<?php
	$protectid="2"; 
	include("../protect.php");
	
	//include_once("../../fckeditor/fckeditor.php");
	include_once("../../config.inc.php");
	
	$strID = $_GET['id'];	
	$strAct = (empty($_GET['act'])) ? "add" : $_GET['act'];
	$strOperation = ( $strAct == "add" ) ? "添加" : "修改";
	
	include_once(CFG_LIB_DIR.'mysqldb.inc.php');		
	$objDb = new mysqldb();
	
	$strSQL = "SELECT * FROM `".con_strPREFIX."info` WHERE InfoID = ".$strID." LIMIT 1";
	$objDb->query($strSQL);
	$tmpResult = $objDb->get_data();
	$InfoResult = $tmpResult[0];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--<script type="text/javascript" src="../../ueditor/editor_config.js"></script>-->
<!--<script type="text/javascript" src="../../ueditor/editor_all.js"></script>-->
    <script type="text/javascript" src="../ueditor/ueditor.config.js"></script>
    <script type="text/javascript" src="../ueditor/ueditor.all.min.js"></script>
    <script type="text/javascript" src="../ueditor/lang/zh-cn/zh-cn.js"></script>

<title><?php echo $strOperation; ?>资讯</title>

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
	
	function changeColor(p_strColor)
	{
		document.getElementById('Title').style.color = p_strColor;
		document.getElementById('TitleColor').value = p_strColor;
	}
</script>
</head>

<body id="main" >
<table summary="" id="pagehead" cellpadding="0" cellspacing="0" border="0" width="100%">
	<tr>
		<td><h1><?php echo $strOperation; ?>信息</h1></td>
		<td class="actions">
			<table summary="" cellpadding="0" cellspacing="0" border="0" align="right">
				<tr>
          <td class="active"><a href="#" ><?php echo $strOperation; ?>信息</a></td>
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
        <div class="listtab" id="div_1"><a href="#" onclick="ShowSort(1);return false;" class="active"><img src="../images/icon_folder.gif" align="absmiddle">　添加信息</a></div>
        <div class="listtab" id="div_2"><a href="#" onclick="ShowSort(2);return false;"><img src="../images/icon_folder2.gif" align="absmiddle"> 基本设置</a></div>
      </div>
  	</td>
  </tr>
</table>

<form name="infoadd" method="post" action="info_ok.php?act=<?php echo $strAct; ?>&id=<?php echo $strID; ?>" onsubmit="return validForm();">
<div id="TabsAll">
<div id="Tab_1"> 
<table cellspacing="0" cellpadding="0" width="100%"  class="maintable">
  <tr id="strTips">
    <th >信息类别</th>
    <td width="40%">
      <?php
				include_once(CFG_LIB_DIR."selector.php");
				$SelCate = new clsSelCate();				
				$strCateID = ( $strAct == "add" ) ? $_GET['cid'] : $InfoResult['CateID'];
				echo $SelCate->strSelCate("1", $strCateID, con_strPREFIX."infocategory", "CateID")
			?> 
      <span>*</span>
    </td>
  </tr>
  <tr id="specialTr" style="display:none;">
    <th width="20%">专题类别</th>
    <td width="80%">
      <?php
				$strCateID = ( $strAct == "add" ) ? $_GET['SpecialID'] : $InfoResult['SpecialID'];
				echo $SelCate->strSelCate("1", $strCateID, con_strPREFIX."specialcate", "SpecialID","","","","1","1")
			?> 
    </td>
  </tr>
  <tr id="infoTitleTr">
    <th>标题</th>
    <td>
      <input type="text" name="Title" id="Title" size="60" value="<?php echo $InfoResult['Title']; ?>" <?php if(isset($InfoResult['TitleColor']) && $InfoResult['TitleColor'] != "")echo 'style="color: '.$InfoResult['TitleColor'].';"'; ?> /> <span>*</span>
     <!-- <span class="buttons">
	      <input type="button" value="选择颜色" class="submit" onclick="PopupWindow('../js/color2.php', 450, 200);" />
			</span>-->
      <input type="hidden" name="TitleColor" id="TitleColor" value="<?php echo $InfoResult['TitleColor']; ?>">
    </td>
  </tr>
  <tr   >
    <th>副标题</th>
    <td><input type="text" name="SubTitle" id="SubTitle" size="60" value="<?php echo $InfoResult['SubTitle']; ?>" /></td>
  </tr>


 <tr style="display:none;" >
    <th>顶部小图</th>
    <td>
      <input name="smallphoto" type="text" id="smallphoto" size="60" value="<?php echo $InfoResult['smallphoto']; ?>" />&nbsp;&nbsp;
      <span class="buttons">
        <input type="button" value="上传"  onclick="PopupWindow('../upload.php?dir=10&input=smallphoto', 380, 140);" class="submit">
        <input type="button" value="选择" onclick="PopupWindow('../pic_list.php?dir=10&input=smallphoto', 712, 600);">
      </span>
    <br />
      <span>图片格式：178px*178px
   <?
    if($InfoResult['smallphoto']){
   ?>
<img src="../../uploadfile/info/<?=$InfoResult['smallphoto']?>" width="100px">
   <? } ?>
      </span>
    </td>
  </tr>

  <tr>
    <th>新闻图片</th>
    <td>
    	<input name="Photo" type="text" id="Photo" size="60" value="<?php echo $InfoResult['FirstPhoto']; ?>" />&nbsp;&nbsp;
      <span class="buttons">
        <input type="button" value="上传"  onclick="PopupWindow('../upload.php?dir=10&input=Photo', 380, 140);" class="submit">
        <input type="button" value="选择" onclick="PopupWindow('../pic_list.php?dir=10&input=Photo', 712, 600);">
			</span>
		<br />
      <span>
<?
    if($InfoResult['FirstPhoto']){
   ?>
<img src="../../uploadfile/info/<?=$InfoResult['FirstPhoto']?>" width="100px">
   <? } ?>
        上传图片支持格式为GIF,JPG,PNG文件,且不能大于2M</span>
		</td>
  </tr>
  
  <!--
    <tr>
    <th>新闻图片2</th>
    <td>
    	<input name="Photos2" type="text" id="Photos2" size="60" value="<?php echo $InfoResult['Photos2']; ?>" />&nbsp;&nbsp;
      <span class="buttons">
        <input type="button" value="上传"  onclick="PopupWindow('../upload.php?dir=10&input=Photos2', 380, 140);" class="submit">
        <input type="button" value="选择" onclick="PopupWindow('../pic_list.php?dir=10&input=Photos2', 712, 600);">
			</span>
		<br />
      <span><?
    if($InfoResult['Photos2']){
   ?>
<img src="../../uploadfile/info/<?=$InfoResult['Photos2']?>" width="100px">
   <? } ?>上传图片支持格式为GIF,JPG,PNG文件,且不能大于2M</span>
		</td>
  </tr>
  
  
    <tr>
    <th>新闻图片3</th>
    <td>
    	<input name="Photos3" type="text" id="Photos3" size="60" value="<?php echo $InfoResult['Photos3']; ?>" />&nbsp;&nbsp;
      <span class="buttons">
        <input type="button" value="上传"  onclick="PopupWindow('../upload.php?dir=10&input=Photos3', 380, 140);" class="submit">
        <input type="button" value="选择" onclick="PopupWindow('../pic_list.php?dir=10&input=Photos3', 712, 600);">
			</span>
		<br />
      <span><?
    if($InfoResult['Photos3']){
   ?>
<img src="../../uploadfile/info/<?=$InfoResult['Photos3']?>" width="100px">
   <? } ?>上传图片支持格式为GIF,JPG,PNG文件,且不能大于2M</span>
		</td>
  </tr>
  
  
    <tr>
    <th>新闻图片4</th>
    <td>
    	<input name="Photos4" type="text" id="Photos4" size="60" value="<?php echo $InfoResult['Photos4']; ?>" />&nbsp;&nbsp;
      <span class="buttons">
        <input type="button" value="上传"  onclick="PopupWindow('../upload.php?dir=10&input=Photos4', 380, 140);" class="submit">
        <input type="button" value="选择" onclick="PopupWindow('../pic_list.php?dir=10&input=Photos4', 712, 600);">
			</span>
		<br />
      <span><?
    if($InfoResult['Photos4']){
   ?>
<img src="../../uploadfile/info/<?=$InfoResult['Photos4']?>" width="100px">
   <? } ?>上传图片支持格式为GIF,JPG,PNG文件,且不能大于2M</span>
		</td>
  </tr>
  
    <tr>
    <th>新闻图片5</th>
    <td>
    	<input name="Photos5" type="text" id="Photos5" size="60" value="<?php echo $InfoResult['Photos5']; ?>" />&nbsp;&nbsp;
      <span class="buttons">
        <input type="button" value="上传"  onclick="PopupWindow('../upload.php?dir=10&input=Photos5', 380, 140);" class="submit">
        <input type="button" value="选择" onclick="PopupWindow('../pic_list.php?dir=10&input=Photos5', 712, 600);">
			</span>
		<br />
      <span><?
    if($InfoResult['Photos5']){
   ?>
<img src="../../uploadfile/info/<?=$InfoResult['Photos5']?>" width="100px">
   <? } ?>上传图片支持格式为GIF,JPG,PNG文件,且不能大于2M</span>
		</td>
  </tr>
  <!--
  
     <tr  >
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
  -->

	<tr>
		<th>作者</th>
		<td><input name="Author" type="text" id="Author" size="60" value="<?php if($InfoResult['Author']){echo $InfoResult['Author'];}else{echo $companyname; }?>" /> <span>若不填写将默认为网站名称</span> </td>
	</tr>
  <tr >
      <th width="18%">编辑</th>
      <td width="82%"><input name="Editor" type="text" id="Editor" size="60" value="<?php if($InfoResult['Editor']){echo $InfoResult['Author'];}else{echo $companyname; }?>" /> <span>若不填写将默认为网站名称</span> </td>
  </tr>    
  <tr>
    <th>来源网站</th>
    <td><input type="text" name="FromSite" id="FromSite" size="60" value="<?php echo $InfoResult['FromSite']; ?>"/></td>
  </tr>  <!--
    <tr>
    <th>发表单位</th>
    <td><input type="text" name="fb" id="fb" size="60" value="<?php echo $InfoResult['fb']; ?>"/></td>
  </tr>
  <!--
    <tr>
    <th>撰稿</th>
    <td><input type="text" name="yg" id="yg" size="60" value="<?php echo $InfoResult['yg']; ?>"/></td>
  </tr>
  
    <tr>
    <th>摄影</th>
    <td><input type="text" name="sy" id="sy" size="60" value="<?php echo $InfoResult['sy']; ?>"/></td>
  </tr>
  
    <tr>
    <th>审核人</th>
    <td><input type="text" name="sh" id="sh" size="60" value="<?php echo $InfoResult['sh']; ?>"/></td>
  </tr>

    <tr>
    <th>招聘选择<?=$InfoResult['sh']?></th>
    <td>
      <input type="radio" name="sh" id="sh" value="1" <?php if($InfoResult['sh'] == 1)echo 'checked="checked"'; ?> />
      <label for="sh">就业机会</label>
    	<input type="radio" name="sh" id="sh" value="0" <?php if($InfoResult['sh'] == 0)echo 'checked="checked"'; ?> />
      <label for="sh">店铺招聘</label>
    </td>
  </tr>
    -->
	<tr >
		<th>内容</th>
		<td>
	
	  
	  <textarea name="Content" id="Content"><?=$InfoResult['Content']?></textarea>
<script type="text/javascript">
    // var editor = new UE.ui.Editor();
    // editor.render("Content");
    //1.2.4以后可以使用一下代码实例化编辑器
    UE.getEditor('Content',{initialFrameWidth:800,initialFrameHeight:400})
</script>
	  
	  
		</td>
	</tr>
	<tr>
		<th>简介</th>
		<td><textarea name="Intro" cols="90" rows="5" id="Intro"><?php echo $InfoResult['Intro']; ?></textarea></td>
	</tr>
</table>
</div>

<div id="Tab_2" style="display: none;">
<table cellspacing="0" cellpadding="0" width="100%"  class="maintable" >
  <!--<tr>
    <th width="20%">数据查看等级</th>
    <td width="80%">
    	<?php
				/*include_once(CFG_LIB_DIR.'role_setting.php');
				$objRole = new clsRoleSetting();
				echo $objRole->strGetReadingRightForSelection("Role", $_GET['role']);*/
			?> 
    	<span>*</span>
    </td>
  </tr>-->
	<tr>
    <th>搜索关键字</th>
  	<td><input type="text" name="Tag" id="Tag" size="60" value="<?php echo $InfoResult['Tag']; ?>" />（用半角,分隔）</td>
  </tr>
  <tr>
    <th>锁定</th>
    <td>
      <input type="radio" name="IsLock" id="IsLock" value="1" <?php if($InfoResult['IsLock'])echo 'checked="checked"'; ?> />
      <label for="IsLock">是</label>
      <input type="radio" name="IsLock" id="IsUnLock" value="0" <?php if(!$InfoResult['IsLock'])echo 'checked="checked"'; ?> />
      <label for="IsUnLock">否</label>
    </td>
  </tr>
  <tr >
    <th>语言</th>
    <td>
      <input type="radio" name="Lang" id="LangCn" value="cn" <?php if($InfoResult['Lang']!='en' && $InfoResult['Lang']!='fn')echo 'checked="checked"'; ?> />
      <label for="LangCn">中文</label>
      <input type="radio" name="Lang" id="LangEn" value="en" <?php if($InfoResult['Lang']=='en')echo 'checked="checked"'; ?> />
      <label for="LangEn">英文</label>
      <input type="radio" name="Lang" id="LangFn" style="display:none;" value="fn" <?php if($InfoResult['Lang']=='fn')echo 'checked="checked"'; ?> />
      <label for="LangFn" style="display:none;">繁体</label>
    </td>
  </tr>
  <tr>
    <th>审核</th>
    <td>
      <input type="radio" name="IsAuditing" id="IsAuditing" value="1" <?php if($InfoResult['IsAuditing'] !== 0)echo 'checked="checked"'; ?> />
      <label for="IsAuditing">已审核</label>
    	<input type="radio" name="IsAuditing" id="IsUnAuditing" value="0" <?php if($InfoResult['IsAuditing'] === 0)echo 'checked="checked"'; ?> />
      <label for="IsUnAuditing">未审核</label>
    </td>
  </tr>
  <tr id="sortTr">
    <th>排序号</th>
    <td><input type="text" name="SortNum" id="SortNum" size="10" value="<?php echo (!isset($InfoResult['SortNum'])) ? "9999" : $InfoResult['SortNum']; ?>" /> <span>*请填写排列序号从小到大排列 注9999为不参与排序</span></td>
  </tr>
  
  <tr id="topTr">
    <th>置顶权值</th>
    <td><input type="text" name="TopNum" id="TopNum" size="10" value="<?php echo (!isset($InfoResult['TopNum'])) ? "9999" : $InfoResult['TopNum']; ?>" /> <span>*请填写置顶权值从小到大排列 注9999为不参与排序</span></td>
  </tr>
  <tr id="extractTr">
    <th>精华权值</th>
    <td><input type="text" name="ExtractNum" id="ExtractNum" size="10" value="<?php echo (!isset($InfoResult['ExtractNum'])) ? "9999" : $InfoResult['ExtractNum']; ?>" /> <span>*请填精华权值写从小到大排列 注9999为不参与排序</span></td>
  </tr>
  <tr>
    <th>自定义链接</th>
    <td><input type="text" name="CustomLinks" id="CustomLinks" style="width: 350px;" value="<?php echo $InfoResult['CustomLinks']; ?>" /></td>
  </tr>  
	<tr id="publishDateTr">
		<th>发布时间</th>
		<td>
    	<input type="text" name="PublishDate" id="PublishDate" size="10" value="<?php echo (!isset($InfoResult['PublishDate'])) ? date("Y-m-j") : date("Y-m-j", $InfoResult['PublishDate']); ?>" /> <span>*</span>
      <img src="../js/jscalendar/img.gif" id="f_trigger_c2"
           style="cursor: pointer; border: 1px solid red;"
           title="Date selector"
           onmouseover="this.style.background='red';"
           onmouseout="this.style.background=''" />
      <script type="text/javascript">
          Calendar.setup({
              inputField     :    "PublishDate",
              ifFormat       :    "%Y-%m-%d",
              button         :    "f_trigger_c2",
              align          :    "Tl",
              singleClick    :    false
          });
      </script>
      (输入格式例如 : 2007-04-05)
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
<?php $objDb->close(); ?>