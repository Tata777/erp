<?php
	$protectid="15"; 
	include("../protect.php");
	
//	include_once("../../fckeditor/fckeditor.php");
	include_once("../../config.inc.php");
	include_once(CFG_LIB_DIR.'generic.lib.php');
	$objBase = new clsBase();
	
	$strID = $_GET['id'];	
	$strAct = (empty($_GET['act'])) ? "add" : $_GET['act'];
	$strOperation = ( $strAct == "add" ) ? "添加" : "修改";
	
	include_once(CFG_LIB_DIR.'mysqldb.inc.php');		
	$objDb = new mysqldb();
	
	$strSQL = "SELECT * FROM `".con_strPREFIX."recruitment` WHERE RecruitmentID = ".$strID." LIMIT 1";
	$objDb->query($strSQL);
	$tmpResult = $objDb->get_data();
	$ProResult = $tmpResult[0];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $strOperation; ?>招聘</title>

<?php include_once("../common/files.php"); ?>
<?php //include ("../common/city.php");?>

<script type="text/javascript">
	function validForm()
	{
		var arrNotBlankElement = new Array("JobNameTr", "NumberTr");
		if(validNotBlank(arrNotBlankElement) == false)
			return false;
			
		var arrDateElementID = new Array("StartDate");
		if(validDate(arrDateElementID) == false)
			return false;
		return true;
	}
</script>
</head>

<body id="main" >
<table summary="" id="pagehead" cellpadding="0" cellspacing="0" border="0" width="100%">
	<tr>
		<td><h1><?php echo $strOperation; ?>招聘</h1></td>
		<td class="actions">
			<table summary="" cellpadding="0" cellspacing="0" border="0" align="right">
				<tr>
          <td class="active"><a href="#" ><?php echo $strOperation; ?>招聘</a></td>
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
        <div class="listtab" id="div_1"><a href="#" onclick="ShowSort(1);return false;" class="active"><img src="../images/icon_folder.gif" align="absmiddle">　发布招聘</a></div>
      </div>
  	</td>
  </tr>
</table>

<form name="memberadd" method="post" action="recruitment_ok.php?act=<?php echo $strAct; ?>&id=<?php echo $strID; ?>" onsubmit="return validForm();"> 
<div id="TabsAll">
<div id="Tab_1"> 
<table cellspacing="0" cellpadding="0" width="100%"  class="maintable">
  <tr>
    <th>语言</th>
    <td>
      <input type="radio" name="Lang" id="LangCn" value="cn" <?php if($ProResult['Lang']!='en')echo 'checked="checked"'; ?> />
      <label for="LangCn">中文</label>
      <input type="radio" name="Lang" id="LangEn" value="en" <?php if($ProResult['Lang']=='en')echo 'checked="checked"'; ?> />
      <label for="LangEn">英文</label>
    </td>
  </tr>
  
<tr id="strTips">
    <th width="20%">招聘分类</th>
    <td width="82%">
      <?php
				include_once(CFG_LIB_DIR."selector.php");
				$SelCate = new clsSelCate();				
				$strCateID = ( $strAct == "add" ) ? $_GET['cid'] : $ProResult['CateID'];
				echo $SelCate->strSelCate("1", $strCateID, con_strPREFIX."recruitmentcategory", "CateID")
			?> 
      <span>*</span>    </td>
  </tr>
  
  <tr >
    <th width="20%">招聘地区</th>
    <td width="82%">
     <select onChange="initcity();" name="CmpProvince" id="CmpProvince" >
	<script>creatprovince('<?php  echo $ProResult['CmpProvince'];?>');</script>
	</select>
	<select name="CmpCity" id="CmpCity">
			<script>initcity('<?php echo $ProResult['CmpCity'];?>');</script>
		</select>
      <span>*</span>    </td>
  </tr>
  
  <tr id="JobNameTr">
    <th>招聘职位</th>
    <td>
      <input type="text" name="JobName" id="JobName" size="60" value="<?php echo $ProResult['JobName']; ?>" /> <span>*</span>    </td>
  </tr>
  <tr>
    <th>学历要求</th>
    <td><input type="text" name="Academic" id="Academic" size="60" value="<?php echo $ProResult['Academic']; ?>" /></td>
  </tr>
  <tr >
    <th>薪资</th>
    <td><input type="text" name="Salary" id="Salary" size="60" value="<?php echo $ProResult['Salary']; ?>" /></td>
  </tr>
  <tr id="NumberTr">
    <th>工作经验</th>
    <td><input type="text" name="Experience" id="Experience" size="60" value="<?php echo $ProResult['Experience']; ?>" /></td>
  </tr>
	<tr id="StartDateTr">
		<th>开始时间</th>
		<td>
    	<input type="text" name="StartDate" id="StartDate" size="10" value="<?php echo (!isset($ProResult['StartDate'])) ? date("Y-m-j") : date("Y-m-j", $ProResult['StartDate']); ?>" /> <span>*</span>
<!--      <img src="../js/jscalendar/img.gif" id="f_trigger_c1"-->
<!--           style="cursor: pointer; border: 1px solid red;"-->
<!--           title="Date selector"-->
<!--           onmouseover="this.style.background='red';"-->
<!--           onmouseout="this.style.background=''" />-->
      <script type="text/javascript">
          Calendar.setup({
              inputField     :    "StartDate",
              ifFormat       :    "%Y-%m-%d",
              button         :    "f_trigger_c1",
              align          :    "Tl",
              singleClick    :    false
          });
      </script>
      (输入格式例如 : 2007-04-05)    </td>
	</tr>
	<tr id="EndDateTr">
		<th>截止时间</th>
		<td>
    	<input type="text" name="EndDate" id="EndDate" size="10" value="<?php echo (!isset($ProResult['EndDate'])) ? date("Y-m-j") : date("Y-m-j", $ProResult['EndDate']); ?>" /> <span>*</span>
<!--      <img src="../js/jscalendar/img.gif" id="f_trigger_c2"-->
<!--           style="cursor: pointer; border: 1px solid red;"-->
<!--           title="Date selector"-->
<!--           onmouseover="this.style.background='red';"-->
<!--           onmouseout="this.style.background=''" />-->
      <script type="text/javascript">
          Calendar.setup({
              inputField     :    "EndDate",
              ifFormat       :    "%Y-%m-%d",
              button         :    "f_trigger_c2",
              align          :    "Tl",
              singleClick    :    false
          });
      </script>
      (输入格式例如 : 2007-04-05)    </td>
	</tr>
  <tr >
    <th>职位职责</th>
    <td>
      <textarea name="Request" id="Request" style="width:400px; height:150px;"><?php echo $objBase->strDbConvert($ProResult['Request']); ?></textarea>
    </td>
  </tr>
  <tr >
    <th>职位要求</th>
    <td>
      <textarea name="Note" id="Note" style="width:400px; height:150px;"><?php echo $objBase->strDbConvert($ProResult['Note']); ?></textarea>
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