<?php
//产品管理ID号
$protectid="14"; 
include("../protect.php");
/*ini_set('display_errors',1);
error_reporting(0);
*/
include("../common/categoryact.php");
$objSort = new clsCategoryAct('sys_procategory', 'sys_products', 'CateID', 'SysProCategoryID', 'procateform.php');
$arrData = $objSort -> vodCategoryAct($_REQUEST);
/*						echo "<pre>";
						var_dump($arrData);
						echo "</pre>";
*/
//echo substr($_GET['SysProCategoryID'],0,3)."_".$_GET['ParentID'];
if(substr($_GET['SysProCategoryID'],0,3)=="114" || substr($_GET['ParentID'],0,3)=="114"){
	$isdesign="1";
}
//echo "<br />".$isdesign;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>信息类别</title>
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<link href="../css/edit.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../js/commentJS.js"></script>
<script type="text/javascript" src="../js/changeUploadPic.js"></script>
<script type="text/javascript">
    function validForm(){
         if(document.getElementById('CateName').value=="")
         {
             alert("警告:\n您还没有没有填写分类名称!")
             document.getElementById('CateName').select()
             return false
          }
				if(document.getElementById('SortNum').value=="")
         {
             alert("请填写分类排序!")
             document.getElementById('SortNum').select()
             return false
          }
         return true
    }
</script>
</head>

<body id="main">
<table summary="" id="pagehead" cellpadding="0" cellspacing="0" border="0" width="100%">
  <tr>
    <td width="23%"><h1><?php echo (isset($_GET['SysProCategoryID'])&&!empty($_GET['SysProCategoryID'])) ? '编辑' :'添加'?>类别</h1></td>
    <td width="77%" class="actions"><table summary="" cellpadding="0" cellspacing="0" border="0" align="right">
      <tr>
        <td ><a href="procatelist.php" class="view">浏览分类</a></td>
        <td class="active"><a href="procateform.php?ParentID=1" class="<?php echo (isset($_GET['SysProCategoryID'])&&!empty($_GET['SysProCategoryID'])) ? 'edit' :'add'?>"><?php echo (isset($_GET['SysProCategoryID'])&&!empty($_GET['SysProCategoryID'])) ? '编辑' :'添加'?>分类</a></td>
      </tr>
    </table></td>
  </tr>
</table>

<form id="cateform" name="cateform" method="post" action="<?php echo $_SERVER['PHP_SELF']?>" onsubmit="return validForm()">
<table cellspacing="0" cellpadding="0" width="100%"  class="maintable" id="feedbackTable">
  <tr>
    <th width="28%" style="text-align:left;">上级分类</th>
    <td>
     <?php echo $arrData['ParentName']?> <input name="ParentID" type="hidden" id="ParentID" value="<?php echo $arrData['ParentID']?>" />
    </td>
  </tr>
  <tr>
    <th style="text-align:left;">分类中文名称</th>
    <td><input name="CateName" type="text" id="CateName" size="30" value="<?php echo $arrData['list']['CateName']?>" />
    <span> *请填写分类名称</span></td>
  </tr>
  <tr>
    <th style="text-align:left;">分类英文名称</th>
    <td><input name="CateNameEn" type="text" id="CateNameEn" size="30" value="<?php echo $arrData['list']['CateNameEn']?>" /></td>
  </tr>
  <tr>
    <th style="text-align:left;">分类繁体名称</th>
    <td><input name="CateNameFn" type="text" id="CateNameFn" size="30" value="<?php echo $arrData['list']['CateNameFn']?>" /></td>
  </tr>
    <tr>
    <th style="text-align:left;">跳转页面</th>
    <td>
    	<input name="CustomLink" type="text" id="CustomLink" size="40" value="<?php echo $arrData['list']['CustomLink']; ?>" />&nbsp;&nbsp;
			</span>
		</td>
  </tr>

  <tr>
    <th style="text-align:left;">类别图片</th>
    <td>
    	<input name="Photo" type="text" id="Photo" size="40" value="<?php echo $arrData['list']['Photo']; ?>" />&nbsp;&nbsp;
      <span class="buttons">
        <input type="button" value="上传"  onclick="PopupWindow('../upload.php?dir=14&input=Photo', 380, 140);" class="submit">
        <input type="button" value="选择" onclick="PopupWindow('../pic_list.php?dir=14&input=Photo', 712, 600);">
			</span>
		</td>
  </tr>
  <tr>
    <th style="text-align:left;">排序</th>
    <td><input name="SortNum" id="SortNum" type="text" size="15" value="<?php echo $arrData['list']['SortNum'] ? $arrData['list']['SortNum'] : '9999';?>" onblur="CheckNum(this)" />
    <span> *请填写排列序号从小到大排列 注"9999"为不参与排序</span></td>
  </tr>
  <?php if($isdesign=="1"){?>
  <tr>
    <th style="text-align:left;">职务</th>
    <td><input name="zhiwu" type="text" id="zhiwu" size="40" value="<?php echo $arrData['list']['zhiwu']; ?>" /></td>
  </tr>
  <tr>
    <th style="text-align:left;">性别</th>
    <td>
      <input type="radio" name="sex" id="sex1" value="1" <?php echo $arrData['list']['sex']==1?"checked=\"checked\"":""?> />
      <label for="sex1">男</label>
      <input type="radio" name="sex" id="sex2" value="0" <?php echo $arrData['list']['sex']==0?"checked=\"checked\"":""?> />
      <label for="sex2">女</label></td>
  </tr>
  <tr>
    <th style="text-align:left;">所属公司</th>
    <td><input name="company" type="text" id="company" size="40" value="<?php echo $arrData['list']['company']; ?>" /></td>
  </tr>
  <tr>
    <th style="text-align:left;">民族</th>
    <td><input name="minzu" type="text" id="minzu" size="40" value="<?php echo $arrData['list']['minzu']; ?>" /></td>
  </tr>
  <tr>
    <th style="text-align:left;">学历</th>
    <td><input name="xueli" type="text" id="xueli" size="40" value="<?php echo $arrData['list']['xueli']; ?>" /></td>
  </tr>
  <tr>
    <th style="text-align:left;">Blog地址</th>
    <td><input name="blogurl" type="text" id="blogurl" size="40" value="<?php echo $arrData['list']['blogurl']; ?>" /></td>
  </tr>
  <?php }?>
  <tr>
    <th style="text-align:left;">是否锁定该类</th>
    <td>
		<input name="IsLock" id="IsLock1" type="radio" value="1" <?php echo $arrData['list']['IsLock']==1?"checked=\"checked\"":""?> /> 
		<label for="IsLock1">是</label>
    <input type="radio" id="IsLock0" name="IsLock" value="0" <?php echo $arrData['list']['IsLock']==0?"checked=\"checked\"":""?> /> 
    <label for="IsLock0">否</label>
		</td>
  </tr>
	<tr>
    <th style="text-align:left;">描述</th>
    <td>
      <label>
      <textarea name="Intro" id="Intro" style="width:300px; height:100px;"><?php echo $arrData['list']['Intro']?></textarea>
      </label>		</td>
  </tr>
</table>
<div class="buttons">
  <input type="submit" name="thevaluesubmit" value="提交保存" class="submit" />
  <input type="hidden" name="act" id="act" value="<?php echo (isset($_GET['SysProCategoryID'])&&!empty($_GET['SysProCategoryID'])) ? 'edit' :'add'?>" />
  <input name="IsSelect" type="hidden" id="IsSelect" value="SysProCategoryID,ParentID,CateName,CateNameEn,CateNameFn,CustomLink,SortNum,IsLock,Intro,Photo,zhiwu,sex,company,minzu,xueli,blogurl" />
	<input name="IsNum" type="hidden" id="IsNum" value="SysProCategoryID,ParentID,SortNum,IsLock" />
  <?php echo (isset($_GET['SysProCategoryID'])&&!empty($_GET['SysProCategoryID'])) ? '<input name="SysProCategoryID" type="hidden" value="'.$_GET['SysProCategoryID'].'" />' :''?>
  
  <input type="reset" name="thevaluereset" value="全部重置" />
	 <input type="button" id="button1" value="返回" onclick="javascript:history.back();">
</div>
</form>
<br>
<?php include "../bottom.php"?>
</div>
</body>
</html>
