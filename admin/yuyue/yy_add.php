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
if(!check_empty(dom.yy_time,"预约时间不能为空！")) return false;
if(!check_empty(dom.yy_xiangmu,"预约项目不能为空！")) return false;
if(!check_empty(dom.user_truename,"用户名不能为空！")) return false;
// if(!check_empty(dom.user_id,"会员ID不能为空！")) return false;
// if(!check_isnum(dom.user_id,"会员ID只能为数字！")) return false;
if(!check_empty(dom.yuyue_dianpuName,"预约店铺不能为空！")) return false;
if(!check_empty(dom.create_time,"创建时间不能为空！")) return false;
if(!check_isnum(dom.create_time,"创建时间只能为数字！")) return false;
  //if(!check_istel(dom.guest_contact,"请输入正确的联系电话，只可以由数字和“/”和“-”组成！")) return false;
        //if(!check_isemail(dom.guest_email,"邮箱格式不正确！")) return false;
        return true;
    }
</script>
</head>
<?php
include_once("../../class/aduf.class.php");
include_once("../common/files.php"); 
$aduf = new Audf();
if ($_POST[action] == "add") {
    $aduf->actionAdd(hy_b_fangyuan);
}elseif ($_POST[action] == "update") {
    $aduf->actionUpdate(hy_b_fangyuan,ID);
}
?>


<body id="main" >
<table  id="pagehead" cellpadding="0" cellspacing="0" border="0" width="100%">
    <tr>
        <td width="23%"><h1>房源管理系统</h1></td>
        <td width="77%" class="actions"><table  cellpadding="0" cellspacing="0" border="0" align="right">
                <tr>
                    <td ><a href="index.php" class="view">管理列表</a></td>
                    <td class="active"><a href="yy_add.php" class="edit">新增</a></td>
<!--					<td ><a href="yy_search.php" class="edit">高级搜索</a></td>-->
                </tr>
            </table></td>
    </tr>
</table>

<form action="yy_add.php" method="post" onsubmit="return checkContent(this);">
    <? if ($_GET["id"]) { ?>
        <input name="action" type="hidden" value="update" />
        <input name="id" type="hidden" value="<?=$_GET["id"]?>" />

        <?
        $SQL2 = " select * from hy_b_fangyuan where ID = $id ";
        $objDb->query($SQL2);
        $msg = $objDb->get_data();
        ?>

    <? } else { ?>
        <input name="action" type="hidden" value="add" />
    <? } ?>
    <table cellspacing="0" cellpadding="0" width="100%"  class="maintable" id="feedbackTable">
        <tr><td>

                        <label> 编号</label>
            </td><td>
<input name="Num" id="Num"  type="text" value="<?=$msg[0]['Num']; ?>" /></td> </tr>
        <tr><td>

                        <label> 物业名称</label></td>
                    <td>
<input name="HouseName" id="HouseName"  type="text" value="<?=$msg[0]['HouseName']; ?>" /></td> </tr><tr><td>

                        <label> 房号</label></td>
                    <td>
<input name="HouseID" id="HouseID"  type="text" value="<?=$msg[0]['HouseID']; ?>" /></td> </tr><tr><td>

                        <label> 面积</label></td>
                    <td>
<input name="HouseArea" id="HouseArea"  type="text" value="<?=$msg[0]['HouseArea']; ?>" /></td> </tr><tr><td>

                        <label> 初始单价</label></td>
                    <td>
<input name="IniPrice" id="IniPrice"  type="text" value="<?=$msg[0]['IniPrice']; ?>" /></td> </tr>
        <tr><td>

                        <label> 当前单价</label></td>
                    <td>
<input name="NowPrice" id="NowPrice"  type="text" value="<?=$msg[0]['NowPrice']; ?>" /></td> </tr>
        <tr><td>

                <label> 物业单价</label></td>
            <td>
                <input name="TentmentPrice" id="TentmentPrice"  type="text" value="<?=$msg[0]['TentmentPrice']; ?>" /></td> </tr><tr><td>

                <label> 物业总价</label></td>
            <td>
                <input name="TentmentAllPrice" id="TentmentAllPrice"  type="text" value="<?=$msg[0]['TentmentAllPrice']; ?>" /></td> </tr>
        <tr><td>
                <label> 年限</label></td>
            <td>
                <input name="Year" id="Year"  type="text" value="<?=$msg[0]['Year']; ?>" /></td> </tr>

        <tr><td>
                <label> 租赁押金</label></td>
            <td>
                <input name="Deposit" id="Deposit"  type="text" value="<?=$msg[0]['Deposit']; ?>" /></td> </tr>
        <tr><td>
                <label> 物业押金</label></td>
            <td>
                <input name="TentmentDeposit" id="TentmentDeposit"  type="text" value="<?=$msg[0]['TentmentDeposit']; ?>" /></td> </tr>
        <tr><td>
                <label> 水电押金</label></td>
            <td>
                <input name="WaterDeposit" id="WaterDeposit"  type="text" value="<?=$msg[0]['WaterDeposit']; ?>" /></td> </tr>
        <tr><td>
                <label> 租付几月</label></td>
            <td>
                <input name="Lease" id="Lease"  type="text" value="<?=$msg[0]['Lease']; ?>" /></td> </tr>
        <tr><td>
                <label> 起租日</label></td>
            <td>
                <input name="StartDate" id="StartDate"  type="text" value="<?=$msg[0]['StartDate']; ?>" /></td> </tr>
        <tr><td>
                <label> 到期日</label></td>
            <td>
                <input name="EndDate" id="EndDate"  type="text" value="<?=$msg[0]['EndDate']; ?>" /></td> </tr>
        <tr><td>
                <label> 二次计租日</label></td>
            <td>
                <input name="SecondDate" id="SecondDate"  type="text" value="<?=$msg[0]['SecondDate']; ?>" /></td> </tr>
        <tr><td>
                <label> 租户公司</label></td>
            <td>
                <input name="Copyright" id="Copyright"  type="text" value="<?=$msg[0]['Copyright']; ?>" /></td> </tr>

        <tr><td>
                <label> 成交类型</label></td>
            <td>
                <input name="Type" id="Type"  type="text" value="<?=$msg[0]['Type']; ?>" /></td> </tr>

        <tr><td>
                <label> 租金税率</label></td>
            <td>
                <input name="TaxRate" id="TaxRate"  type="text" value="<?=$msg[0]['TaxRate']; ?>" /></td> </tr>

        <tr><td>
                <label> 成交人</label></td>
            <td>
                <input name="Personal" id="Personal"  type="text" value="<?=$msg[0]['Personal']; ?>" /></td> </tr>


        <tr><td colspan="2">
        <center>
		<?php
		    if ($_GET["id"]) { 
			   $str ="修改";
			}else{ 
			   $str="提交";
			} ?>
            <input type="submit" value="<?=$str?>" />
        </center>
        </td></tr>
    </table>
</form>
</body>
</html>
