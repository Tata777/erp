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

</head>
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
                    <td ><a href="lvyou_add.php" class="edit">新增</a></td>
					<td ><a href="lvyou_search.php" class="edit">高级搜索</a></td>
                </tr>
            </table></td>
    </tr>
</table>

<form action="lvyou_add.php" method="post" onsubmit="return checkContent(this);">
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
    <table cellspacing="0" cellpadding="0" width="100%"  class="maintable" id="feedbackTable"><tr><td>序号</td><td><?=$msg[0]['id']; ?> </td></tr><tr><td>店号/贵宾号</td><td><?=$msg[0]['shopNo']; ?> </td></tr><tr><td>密码</td><td><?=$msg[0]['password']; ?> </td></tr><tr><td>负责人姓名</td><td><?=$msg[0]['name']; ?> </td></tr><tr><td>联系方式</td><td><?=$msg[0]['contact']; ?> </td></tr><tr><td>秘书姓名</td><td><?=$msg[0]['secretaryName']; ?> </td></tr><tr><td>秘书联系方式</td><td><?=$msg[0]['secretaryContact']; ?> </td></tr><tr><td>参团人姓名</td><td><?=$msg[0]['joinName']; ?> </td></tr><tr><td>参团人联系方式</td><td><?=$msg[0]['joinContact']; ?> </td></tr><tr><td>参团人出生年月日</td><td><?=$msg[0]['joinBorn']; ?> </td></tr><tr><td>性别</td><td><?=$msg[0]['sex']; ?> </td></tr><tr><td>是否有护照</td><td><?=$msg[0]['havePassport']; ?> </td></tr><tr><td>护照号码</td><td><?=$msg[0]['passport']; ?> </td></tr><tr><td>护照有效期</td><td><?=$msg[0]['passportValid']; ?> </td></tr><tr><td>预计取证时间</td><td><?=$msg[0]['passportExpectedTimeEvidence']; ?> </td></tr><tr><td>是否有通行证</td><td><?=$msg[0]['havePass']; ?> </td></tr><tr><td>通行证号码</td><td><?=$msg[0]['passNo']; ?> </td></tr><tr><td>通行证有效期</td><td><?=$msg[0]['passValid']; ?> </td></tr><tr><td>预计取证时间</td><td><?=$msg[0]['passExpectedTimeEvidence']; ?> </td></tr><tr><td>身份证号码</td><td><?=$msg[0]['No.']; ?> </td></tr><tr><td>户籍所在地</td><td><?=$msg[0]['place']; ?> </td></tr><tr><td>工作地</td><td><?=$msg[0]['workplace']; ?> </td></tr><tr><td>护照与工作地是否同一省份</td><td><?=$msg[0]['passportAndWorkAreTheSameProvince']; ?> </td></tr><tr><td>衣服尺码</td><td><?=$msg[0]['clothingSizes']; ?> </td></tr><tr><td>优选线路</td><td><?=$msg[0]['preferredLine']; ?> </td></tr><tr><td>备选线路</td><td><?=$msg[0]['alternativeLine']; ?> </td></tr><tr><td>报名日期</td><td><?=$msg[0]['registrationDate']; ?> </td></tr><tr><td>出行时间</td><td><?=$msg[0]['tripTime']; ?> </td></tr><tr><td>目标房间</td><td><?=$msg[0]['targetRoom']; ?> </td></tr><tr><td>是否愿意合住</td><td><?=$msg[0]['likeChummage']; ?> </td></tr><tr><td>合住人信息1</td><td><?=$msg[0]['accommodatioInfo1']; ?> </td></tr><tr><td>合住时间1</td><td><?=$msg[0]['sharingTime1']; ?> </td></tr><tr><td>合住人信息2</td><td><?=$msg[0]['accommodatioInfo2']; ?> </td></tr><tr><td>合住时间2</td><td><?=$msg[0]['sharingTime2']; ?> </td></tr><tr><td>退房日期</td><td><?=$msg[0]['checkoutDate']; ?> </td></tr><tr><td>是否携带家属</td><td><?=$msg[0]['haveBringFamilies']; ?> </td></tr><tr><td>多少位家属</td><td><?=$msg[0]['howManyFamilies']; ?> </td></tr><tr><td>家属名称</td><td><?=$msg[0]['familyname']; ?> </td></tr><tr><td>家属联系方式</td><td><?=$msg[0]['familyContact']; ?> </td></tr><tr><td>家属出生年月日</td><td><?=$msg[0]['familyBorn']; ?> </td></tr><tr><td>性别</td><td><?=$msg[0]['familySex']; ?> </td></tr><tr><td>是否有护照</td><td><?=$msg[0]['familyHavePassport']; ?> </td></tr><tr><td>号码</td><td><?=$msg[0]['familyPassportNo.']; ?> </td></tr><tr><td>护照有效期</td><td><?=$msg[0]['familyPassportValid']; ?> </td></tr><tr><td>预计取证时间</td><td><?=$msg[0]['familyPassportExpectedTimeEvidence']; ?> </td></tr><tr><td>是否有通行证</td><td><?=$msg[0]['familyHavePass']; ?> </td></tr><tr><td>通行证号码</td><td><?=$msg[0]['familyPassNo.']; ?> </td></tr><tr><td>通行证有效期</td><td><?=$msg[0]['familyPassValid']; ?> </td></tr><tr><td>预计取证时间</td><td><?=$msg[0]['familyPassExpectedTimeEvidence']; ?> </td></tr><tr><td>身份证号码</td><td><?=$msg[0]['familyNo.']; ?> </td></tr><tr><td>户籍所在地</td><td><?=$msg[0]['familyPlace']; ?> </td></tr><tr><td>工作地</td><td><?=$msg[0]['familyWorkPlace']; ?> </td></tr><tr><td>护照与工作地是否同一省份</td><td><?=$msg[0]['familyPassportAndWorkAreTheSameProvince']; ?> </td></tr><tr><td>衣服尺码</td><td><?=$msg[0]['familyClothingSizes']; ?> </td></tr><tr><td>出发地</td><td><?=$msg[0]['departure']; ?> </td></tr><tr><td>出发时间</td><td><?=$msg[0]['departureTime']; ?> </td></tr><tr><td>出发航班号</td><td><?=$msg[0]['departureFlightNumber']; ?> </td></tr><tr><td>到达日期</td><td><?=$msg[0]['arriveDate']; ?> </td></tr><tr><td>到达时间</td><td><?=$msg[0]['arriveTime']; ?> </td></tr><tr><td>到达地点</td><td><?=$msg[0]['arrivePlace']; ?> </td></tr><tr><td>回程时间</td><td><?=$msg[0]['returnTime']; ?> </td></tr><tr><td>回程航班号</td><td><?=$msg[0]['returnFlightNumber']; ?> </td></tr><tr><td>是否需要接送</td><td><?=$msg[0]['haveNeedTransport']; ?> </td></tr><tr><td>开票公司抬头</td><td><?=$msg[0]['billingCompanyLetterhead']; ?> </td></tr><tr><td>发票内容</td><td><?=$msg[0]['invoiceContent']; ?> </td></tr><tr><td>金额</td><td><?=$msg[0]['invoiceMoney']; ?> </td></tr><tr><td>邮寄地址</td><td><?=$msg[0]['mailingAddress']; ?> </td></tr>
    </table>
</form>
</body>
</html>
