<?php
 include "includeFiles.php";
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<link href="../css/edit.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../../ueditor/editor_config.js"></script>
<script type="text/javascript" src="../../ueditor/editor_all.js"></script>
<script type="text/javascript" src="../js/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="../js/aduf.js"></script>
<script src="../js/checkSubmit.js"></script>
<script language="javascript">
    function checkContent(dom){
if(!check_empty(dom.arrivePlace,"到达地点不能为空！")) return false;
  //if(!check_istel(dom.guest_contact,"请输入正确的联系电话，只可以由数字和“/”和“-”组成！")) return false;
        //if(!check_isemail(dom.guest_email,"邮箱格式不正确！")) return false;
        return true;
    }
</script>
</head>
<?php include_once("../common/files.php"); ?>
<?php
include_once("../../class/aduf.class.php");
include_once("../common/files.php"); 
$aduf = new Audf();
if ($_POST[action] == "add") {
    $aduf->actionAdd(lvyou);
}elseif ($_POST[action] == "update") {
    $aduf->actionUpdate(lvyou,id);
}
?>

<body id="main" >
<table  id="pagehead" cellpadding="0" cellspacing="0" border="0" width="100%">
  <tr>
    <td width="23%"><h1>旅游客户管理系统</h1></td>
    <td width="77%" class="actions"><table  cellpadding="0" cellspacing="0" border="0" align="right">
        <tr>
          <td ><a href="index.php" class="view">管理列表</a></td>
          <td class="active"><a href="lvyou_add.php" class="edit">新增</a></td>
          <td ><a href="lvyou_search.php" class="edit">高级搜索</a></td>
        </tr>
      </table></td>
  </tr>
</table>
<form action="lvyou_add.php" method="post" onSubmit="return checkContent(this);">
  <? if ($_GET["id"]) { ?>
  <input name="action" type="hidden" value="update" />
  <input name="id" type="hidden" value="<?=$_GET["id"]?>" />
  <?
        $SQL2 = " select * from lvyou where id = $id ";
        $objDb->query($SQL2);
        $msg = $objDb->get_data();
        ?>
  <? } else { ?>
  <input name="action" type="hidden" value="add" />
  <? } ?>
  <table cellspacing="0" cellpadding="0" width="100%"  class="maintable" id="feedbackTable">
    <tr>
      <td width="21%"><label> 店号/贵宾号</label></td>
      <td width="79%"><input name="shopNo" id="shopNo"  type="text" value="<?=$msg[0]['shopNo']; ?>" /></td>
    </tr>
    <tr>
      <td><label> 密码</label></td>
      <td><input name="password" id="password"  type="text" value="<?=$msg[0]['password']; ?>" /></td>
    </tr>
    <tr>
      <td><label> 负责人姓名</label></td>
      <td><input name="name" id="name"  type="text" value="<?=$msg[0]['name']; ?>" /></td>
    </tr>
    <tr>
      <td><label> 联系方式</label></td>
      <td><input name="contact" id="contact"  type="text" value="<?=$msg[0]['contact']; ?>" /></td>
    </tr>
    <tr>
      <td><label> 秘书姓名</label></td>
      <td><input name="secretaryName" id="secretaryName"  type="text" value="<?=$msg[0]['secretaryName']; ?>" /></td>
    </tr>
    <tr>
      <td><label> 秘书联系方式</label></td>
      <td><input name="secretaryContact" id="secretaryContact"  type="text" value="<?=$msg[0]['secretaryContact']; ?>" /></td>
    </tr>
    <tr>
      <td><label> 参团人姓名</label></td>
      <td><input name="joinName" id="joinName"  type="text" value="<?=$msg[0]['joinName']; ?>" /></td>
    </tr>
    <tr>
      <td><label> 参团人联系方式</label></td>
      <td><input name="joinContact" id="joinContact"  type="text" value="<?=$msg[0]['joinContact']; ?>" /></td>
    </tr>
    <tr>
      <td><label> 参团人出生年月日</label></td>
      <td><input name="joinBorn" id="joinBorn"  type="text" value="<?=$msg[0]['joinBorn']; ?>" /></td>
    </tr>
    <tr>
      <td><label> 性别</label></td>
      <td>
        <select name="sex" id="sex">
          <option value="男" <?  if($msg[0]['sex'] == '男') echo 'selected'; ?>>男</option>
          <option value="女" <?  if($msg[0]['sex'] == '女') echo 'selected'; ?>>女</option>
      </select></td>
    </tr>
    <tr>
      <td><label> 是否有护照</label></td>
      <td> 
        <select name="havePassport" id="havePassport">
          <option value="是" <?  if($msg[0]['havePassport'] == '是') echo 'selected'; ?>>是</option>
          <option value="否" <?  if($msg[0]['havePassport'] == '否') echo 'selected'; ?>>否</option>
      </select></td>
    </tr>
    <tr>
      <td><label> 护照号码</label></td>
      <td><input name="passport"  type="text" id="passport" value="<?=$msg[0]['passport']; ?>" size="50" /></td>
    </tr>
    <tr>
      <td><label> 护照有效期</label></td>
      <td><input name="passportValid" id="passportValid"  type="text" value="<?=$msg[0]['passportValid']; ?>" /></td>
    </tr>
    <tr>
      <td><label> 预计取证时间</label></td>
      <td><input name="passportExpectedTimeEvidence" id="passportExpectedTimeEvidence"  type="text" value="<?=$msg[0]['passportExpectedTimeEvidence']; ?>" /></td>
    </tr>
    <tr>
      <td><label> 是否有通行证</label></td>
      <td>
        <select name="havePass" id="havePass">
          <option value="是" <?  if($msg[0]['havePass'] == '是') echo 'selected'; ?>>是</option>
          <option value="否" <?  if($msg[0]['havePass'] == '否') echo 'selected'; ?>>否</option>
      </select></td>
    </tr>
    <tr>
      <td><label> 通行证号码</label></td>
      <td><input name="passNo" id="passNo"  type="text" value="<?=$msg[0]['passNo']; ?>" /></td>
    </tr>
    <tr>
      <td><label> 通行证有效期</label></td>
      <td><input name="passValid" id="passValid"  type="text" value="<?=$msg[0]['passValid']; ?>" /></td>
    </tr>
    <tr>
      <td><label> 预计取证时间</label></td>
      <td><input type="text" name="passExpectedTimeEvidence" id="passExpectedTimeEvidence" size="10" value="<?php echo (!isset($msg[0]['passExpectedTimeEvidence'])) ? date("Y-m-j") : date("Y-m-j", $msg[0]['passExpectedTimeEvidence']); ?>" />
        <span>*</span> <img src="../js/jscalendar/img.gif" id="f_trigger_c6"
           style="cursor: pointer; border: 1px solid red;"
           title="Date selector"
           onmouseover="this.style.background='red';"
           onmouseout="this.style.background=''" /> 
        <script type="text/javascript">
          Calendar.setup({
              inputField     :    "passExpectedTimeEvidence",
              ifFormat       :    "%Y-%m-%d",
              button         :    "f_trigger_c6",
              align          :    "Tl",
              singleClick    :    false
          });
      </script> 
        (输入格式例如 : 2007-04-05)  
      
      
      </td>
    </tr>
    <tr>
      <td><label> 身份证号码</label></td>
      <td><input name="No."  type="text" id="No." value="<?=$msg[0]['No.']; ?>" size="50" /></td>
    </tr>
    <tr>
      <td><label> 户籍所在地</label></td>
      <td><input name="place" id="place"  type="text" value="<?=$msg[0]['place']; ?>" /></td>
    </tr>
    <tr>
      <td><label> 工作地</label></td>
      <td><input name="workplace" id="workplace"  type="text" value="<?=$msg[0]['workplace']; ?>" /></td>
    </tr>
    <tr>
      <td><label> 护照与工作地是否同一省份</label></td>
      <td>
        <select name="passportAndWorkAreTheSameProvince" id="passportAndWorkAreTheSameProvince">
          <option value="是" <?  if($msg[0]['passportAndWorkAreTheSameProvince'] == '是') echo 'selected'; ?>>是</option>
          <option value="否" <?  if($msg[0]['passportAndWorkAreTheSameProvince'] == '否') echo 'selected'; ?>>否</option>
      </select></td>
    </tr>
    <tr>
      <td><label> 衣服尺码</label></td>
      <td>
        <select name="clothingSizes" id="clothingSizes">
          <option value="S" <?  if($msg[0]['clothingSizes'] == 'S') echo 'selected'; ?>>S</option>
          <option value="M" <?  if($msg[0]['clothingSizes'] == 'M') echo 'selected'; ?>>M</option>
          <option value="L" <?  if($msg[0]['clothingSizes'] == 'L') echo 'selected'; ?>>L</option>
          <option value="XL" <?  if($msg[0]['clothingSizes'] == 'XL') echo 'selected'; ?>>XL</option>
          <option value="XXL" <?  if($msg[0]['clothingSizes'] == 'XXL') echo 'selected'; ?>>XXL</option>
          <option value="XXXL" <?  if($msg[0]['clothingSizes'] == 'XXXL') echo 'selected'; ?>>XXXL</option>
      </select></td>
    </tr>
    <tr>
      <td><label> 优选线路</label></td>
      <td><input name="preferredLine" id="preferredLine"  type="text" value="<?=$msg[0]['preferredLine']; ?>" /></td>
    </tr>
    <tr>
      <td><label> 备选线路</label></td>
      <td><input name="alternativeLine" id="alternativeLine"  type="text" value="<?=$msg[0]['alternativeLine']; ?>" /></td>
    </tr>
    <tr>
      <td><label> 报名日期</label></td>
      <td>
      
      <input type="text" name="registrationDate" id="registrationDate" size="10" value="<?php echo (!isset($msg[0]['registrationDate'])) ? date("Y-m-j") : date("Y-m-j", $msg[0]['registrationDate']); ?>" />
        <span>*</span> <img src="../js/jscalendar/img.gif" id="f_trigger_c5"
           style="cursor: pointer; border: 1px solid red;"
           title="Date selector"
           onmouseover="this.style.background='red';"
           onmouseout="this.style.background=''" /> 
        <script type="text/javascript">
          Calendar.setup({
              inputField     :    "registrationDate",
              ifFormat       :    "%Y-%m-%d",
              button         :    "f_trigger_c5",
              align          :    "Tl",
              singleClick    :    false
          });
      </script> 
        (输入格式例如 : 2007-04-05) 
     
      
      </td>
    </tr>
    <tr>
      <td><label> 出行时间</label></td>
      <td><input name="tripTime" id="tripTime"  type="text" value="<?=$msg[0]['tripTime']; ?>" /></td>
    </tr>
    <tr>
      <td><label> 目标房间</label></td>
      <td><input name="targetRoom" id="targetRoom"  type="text" value="<?=$msg[0]['targetRoom']; ?>" /></td>
    </tr>
    <tr>
      <td><label> 是否愿意合住</label></td>
      <td> 
        <select name="likeChummage" id="likeChummage">
          <option value="是" <?  if($msg[0]['likeChummage'] == '是') echo 'selected'; ?>>是</option>
          <option value="否" <?  if($msg[0]['likeChummage'] == '否') echo 'selected'; ?>>否</option>
      </select></td>
    </tr>
    <tr>
      <td><label> 合住人信息1</label></td>
      <td><input name="accommodatioInfo1" id="accommodatioInfo1"  type="text" value="<?=$msg[0]['accommodatioInfo1']; ?>" /></td>
    </tr>
    <tr>
      <td><label> 合住时间1</label></td>
      <td><input name="sharingTime1" id="sharingTime1"  type="text" value="<?=$msg[0]['sharingTime1']; ?>" /></td>
    </tr>
    <tr>
      <td><label> 合住人信息2</label></td>
      <td><input name="accommodatioInfo2" id="accommodatioInfo2"  type="text" value="<?=$msg[0]['accommodatioInfo2']; ?>" /></td>
    </tr>
    <tr>
      <td><label> 合住时间2</label></td>
      <td><input name="sharingTime2" id="sharingTime2"  type="text" value="<?=$msg[0]['sharingTime2']; ?>" /></td>
    </tr>
    <tr>
      <td><label> 退房日期</label></td>
      <td>
      
      
      <input type="text" name="checkoutDate" id="checkoutDate" size="10" value="<?php echo (!isset($msg[0]['checkoutDate'])) ? date("Y-m-j") : date("Y-m-j", $msg[0]['checkoutDate']); ?>" />
        <span>*</span> <img src="../js/jscalendar/img.gif" id="f_trigger_c4"
           style="cursor: pointer; border: 1px solid red;"
           title="Date selector"
           onmouseover="this.style.background='red';"
           onmouseout="this.style.background=''" /> 
        <script type="text/javascript">
          Calendar.setup({
              inputField     :    "checkoutDate",
              ifFormat       :    "%Y-%m-%d",
              button         :    "f_trigger_c4",
              align          :    "Tl",
              singleClick    :    false
          });
      </script> 
        (输入格式例如 : 2007-04-05) 
      
      </td>
    </tr>
    <tr>
      <td><label> 是否携带家属</label></td>
      <td><input name="haveBringFamilies" id="haveBringFamilies"  type="text" value="<?=$msg[0]['haveBringFamilies']; ?>" /></td>
    </tr>
    <tr>
      <td><label> 多少位家属</label></td>
      <td><input name="howManyFamilies" id="howManyFamilies"  type="text" value="<?=$msg[0]['howManyFamilies']; ?>" /></td>
    </tr>
    <tr>
      <td><label> 家属名称</label></td>
      <td><input name="familyname" id="familyname"  type="text" value="<?=$msg[0]['familyname']; ?>" /></td>
    </tr>
    <tr>
      <td><label> 家属联系方式</label></td>
      <td><input name="familyContact" id="familyContact"  type="text" value="<?=$msg[0]['familyContact']; ?>" /></td>
    </tr>
    <tr>
      <td><label> 家属出生年月日</label></td>
      <td><input name="familyBorn" id="familyBorn"  type="text" value="<?=$msg[0]['familyBorn']; ?>" /></td>
    </tr>
    <tr>
      <td><label> 性别</label></td>
      <td><input name="familySex" id="familySex"  type="text" value="<?=$msg[0]['familySex']; ?>" /></td>
    </tr>
    <tr>
      <td><label> 是否有护照</label></td>
      <td><input name="familyHavePassport" id="familyHavePassport"  type="text" value="<?=$msg[0]['familyHavePassport']; ?>" /></td>
    </tr>
    <tr>
      <td><label> 号码</label></td>
      <td><input name="familyPassportNo." id="familyPassportNo."  type="text" value="<?=$msg[0]['familyPassportNo.']; ?>" /></td>
    </tr>
    <tr>
      <td><label> 护照有效期</label></td>
      <td><input name="familyPassportValid" id="familyPassportValid"  type="text" value="<?=$msg[0]['familyPassportValid']; ?>" /></td>
    </tr>
    <tr>
      <td><label> 预计取证时间</label></td>
      <td><input name="familyPassportExpectedTimeEvidence" id="familyPassportExpectedTimeEvidence"  type="text" value="<?=$msg[0]['familyPassportExpectedTimeEvidence']; ?>" /></td>
    </tr>
    <tr>
      <td><label> 是否有通行证</label></td>
      <td> 
        <select name="familyHavePass" id="familyHavePass">
          <option value="是" <?  if($msg[0]['familyHavePass'] == '是') echo 'selected'; ?>>是</option>
          <option value="否" <?  if($msg[0]['familyHavePass'] == '否') echo 'selected'; ?>>否</option>
      </select></td>
    </tr>
    <tr>
      <td><label> 通行证号码</label></td>
      <td><input name="familyPassNo." id="familyPassNo."  type="text" value="<?=$msg[0]['familyPassNo.']; ?>" /></td>
    </tr>
    <tr>
      <td><label> 通行证有效期</label></td>
      <td><input name="familyPassValid" id="familyPassValid"  type="text" value="<?=$msg[0]['familyPassValid']; ?>" /></td>
    </tr>
    <tr>
      <td><label> 预计取证时间</label></td>
      <td><input name="familyPassExpectedTimeEvidence" id="familyPassExpectedTimeEvidence"  type="text" value="<?=$msg[0]['familyPassExpectedTimeEvidence']; ?>" /></td>
    </tr>
    <tr>
      <td><label> 身份证号码</label></td>
      <td><input name="familyNo." id="familyNo."  type="text" value="<?=$msg[0]['familyNo.']; ?>" /></td>
    </tr>
    <tr>
      <td><label> 户籍所在地</label></td>
      <td><input name="familyPlace" id="familyPlace"  type="text" value="<?=$msg[0]['familyPlace']; ?>" /></td>
    </tr>
    <tr>
      <td><label> 工作地</label></td>
      <td><input name="familyWorkPlace" id="familyWorkPlace"  type="text" value="<?=$msg[0]['familyWorkPlace']; ?>" /></td>
    </tr>
    <tr>
      <td><label> 护照与工作地是否同一省份</label></td>
      <td><select name="familyPassportAndWorkAreTheSameProvince" id="familyPassportAndWorkAreTheSameProvince">
          <option value="是" <?  if($msg[0]['familyPassportAndWorkAreTheSameProvince'] == '是') echo 'selected'; ?>>是</option>
          <option value="否" <?  if($msg[0]['familyPassportAndWorkAreTheSameProvince'] == '否') echo 'selected'; ?>>否</option>
      </select></td>
    </tr>
    <tr>
      <td><label> 衣服尺码</label></td>
      <td><select name="familyClothingSizes" id="familyClothingSizes">
          <option value="S" <?  if($msg[0]['familyClothingSizes'] == 'S') echo 'selected'; ?>>S</option>
          <option value="M" <?  if($msg[0]['familyClothingSizes'] == 'M') echo 'selected'; ?>>M</option>
          <option value="L" <?  if($msg[0]['familyClothingSizes'] == 'L') echo 'selected'; ?>>L</option>
          <option value="XL" <?  if($msg[0]['familyClothingSizes'] == 'XL') echo 'selected'; ?>>XL</option>
          <option value="XXL" <?  if($msg[0]['familyClothingSizes'] == 'XXL') echo 'selected'; ?>>XXL</option>
          <option value="XXXL" <?  if($msg[0]['familyClothingSizes'] == 'XXXL') echo 'selected'; ?>>XXXL</option>
        </select></td>
    </tr>
    <tr>
      <td><label> 出发地</label></td>
      <td><input name="departure" id="departure"  type="text" value="<?=$msg[0]['departure']; ?>" /></td>
    </tr>
    <tr>
      <td><label> 出发时间</label></td>
      <td><input type="text" name="departureTime" id="departureTime" size="10" value="<?php echo (!isset($msg[0]['departureTime'])) ? date("Y-m-j") : date("Y-m-j", $msg[0]['departureTime']); ?>" />
        <span>*</span> <img src="../js/jscalendar/img.gif" id="f_trigger_c3"
           style="cursor: pointer; border: 1px solid red;"
           title="Date selector"
           onmouseover="this.style.background='red';"
           onmouseout="this.style.background=''" /> 
        <script type="text/javascript">
          Calendar.setup({
              inputField     :    "departureTime",
              ifFormat       :    "%Y-%m-%d",
              button         :    "f_trigger_c3",
              align          :    "Tl",
              singleClick    :    false
          });
      </script> 
        (输入格式例如 : 2007-04-05) </td>
    </tr>
    <tr>
      <td><label> 出发航班号</label></td>
      <td><input name="departureFlightNumber" id="departureFlightNumber"  type="text" value="<?=$msg[0]['departureFlightNumber']; ?>" /></td>
    </tr>
    <tr>
      <td><label> 到达日期</label></td>
      <td><input name="arriveDate" id="arriveDate"  type="text" value="<?=$msg[0]['arriveDate']; ?>" /></td>
    </tr>
    <tr>
      <td><label> 到达时间</label></td>
      <td><input type="text" name="arriveTime" id="arriveTime" size="10" value="<?php echo (!isset($msg[0]['arriveTime'])) ? date("Y-m-j") : date("Y-m-j", $msg[0]['arriveTime']); ?>" />
        <span>*</span> <img src="../js/jscalendar/img.gif" id="f_trigger_c2"
           style="cursor: pointer; border: 1px solid red;"
           title="Date selector"
           onmouseover="this.style.background='red';"
           onmouseout="this.style.background=''" /> 
        <script type="text/javascript">
          Calendar.setup({
              inputField     :    "arriveTime",
              ifFormat       :    "%Y-%m-%d",
              button         :    "f_trigger_c2",
              align          :    "Tl",
              singleClick    :    false
          });
      </script> 
        (输入格式例如 : 2007-04-05) </td>
    </tr>
    <tr>
      <td><label> 到达地点</label></td>
      <td><input name="arrivePlace" id="arrivePlace"  type="text" value="<?=$msg[0]['arrivePlace']; ?>" /></td>
    </tr>
    <tr>
      <td><label> 回程时间</label></td>
      <td><input type="text" name="returnTime" id="returnTime" size="10" value="<?php echo (!isset($msg[0]['returnTime'])) ? date("Y-m-j") : date("Y-m-j", $msg[0]['returnTime']); ?>" />
        <span>*</span> <img src="../js/jscalendar/img.gif" id="f_trigger_c1"
           style="cursor: pointer; border: 1px solid red;"
           title="Date selector"
           onmouseover="this.style.background='red';"
           onmouseout="this.style.background=''" /> 
        <script type="text/javascript">
          Calendar.setup({
              inputField     :    "returnTime",
              ifFormat       :    "%Y-%m-%d",
              button         :    "f_trigger_c1",
              align          :    "Tl",
              singleClick    :    false
          });
      </script> 
        (输入格式例如 : 2007-04-05) </td>
    </tr>
    <tr>
      <td><label> 回程航班号</label></td>
      <td><input name="returnFlightNumber" id="returnFlightNumber"  type="text" value="<?=$msg[0]['returnFlightNumber']; ?>" /></td>
    </tr>
    <tr>
      <td height="45"><label> 是否需要接送</label></td>
      <td><select name="haveNeedTransport" id="select">
          <option value="是" <?  if($msg[0]['haveNeedTransport'] == '是') echo 'selected'; ?>>是</option>
          <option value="否" <?  if($msg[0]['haveNeedTransport'] == '否') echo 'selected'; ?>>否</option>
        </select></td>
    </tr>
    <tr>
      <td><label> 开票公司抬头</label></td>
      <td><input name="billingCompanyLetterhead"  type="text" id="billingCompanyLetterhead" value="<?=$msg[0]['billingCompanyLetterhead']; ?>" size="50" /></td>
    </tr>
    <tr>
      <td><label> 发票内容</label></td>
      <td><input name="invoiceContent"  type="text" id="invoiceContent" value="<?=$msg[0]['invoiceContent']; ?>" size="0" /></td>
    </tr>
    <tr>
      <td><label> 金额</label></td>
      <td><input name="invoiceMoney" id="invoiceMoney"  type="text" value="<?=$msg[0]['invoiceMoney']; ?>" /></td>
    </tr>
    <tr>
      <td><label> 邮寄地址</label></td>
      <td><textarea name="mailingAddress" cols="50" rows="3" id="mailingAddress"><?=$msg[0]['mailingAddress']; ?>
                    </textarea></td>
    </tr>
    <tr>
      <td colspan="2"><center>
          <?php
		    if ($_GET["id"]) { 
			   $str ="修改";
			}else{ 
			   $str="提交";
			} ?>
          <input type="submit" value="<?=$str?>" />
        </center></td>
    </tr>
  </table>
</form>
</body>
</html>
