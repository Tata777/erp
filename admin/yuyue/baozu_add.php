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
<!--<script language="javascript">-->
<!--    function checkContent(dom){-->
<!--if(!check_empty(dom.yy_time,"预约时间不能为空！")) return false;-->
<!--if(!check_empty(dom.yy_xiangmu,"预约项目不能为空！")) return false;-->
<!--if(!check_empty(dom.user_truename,"用户名不能为空！")) return false;-->
<!--// if(!check_empty(dom.user_id,"会员ID不能为空！")) return false;-->
<!--// if(!check_isnum(dom.user_id,"会员ID只能为数字！")) return false;-->
<!--if(!check_empty(dom.yuyue_dianpuName,"预约店铺不能为空！")) return false;-->
<!--if(!check_empty(dom.create_time,"创建时间不能为空！")) return false;-->
<!--if(!check_isnum(dom.create_time,"创建时间只能为数字！")) return false;-->
<!--  //if(!check_istel(dom.guest_contact,"请输入正确的联系电话，只可以由数字和“/”和“-”组成！")) return false;-->
<!--        //if(!check_isemail(dom.guest_email,"邮箱格式不正确！")) return false;-->
<!--        return true;-->
<!--    }-->
<!--</script>-->
</head>
<?php
include_once("../../class/aduf.class.php");
include_once("../common/files.php"); 
$aduf = new Audf();
if ($_POST[action] == "add") {
    $aduf->actionAdd(hy_b_baozu);
}elseif ($_POST[action] == "update") {
    $aduf->actionUpdate(hy_b_baozu,ID);
}
?>


<body id="main" >
<table  id="pagehead" cellpadding="0" cellspacing="0" border="0" width="100%">
    <tr>
        <td width="23%"><h1>包租意向系统</h1></td>
        <td width="77%" class="actions"><table  cellpadding="0" cellspacing="0" border="0" align="right">
                <tr>
                    <td ><a href="baozu.php" class="view">管理列表</a></td>
                    <td class="active"><a href="baozu_add.php" class="edit">新增</a></td>

                </tr>
            </table></td>
    </tr>
</table>

<form action="baozu_add.php" method="post" onsubmit="return checkContent(this);">
    <? if ($_GET["id"]) { ?>
        <input name="action" type="hidden" value="update" />
        <input name="id" type="hidden" value="<?=$_GET["id"]?>" />

        <?
        $SQL2 = " select * from hy_b_baozu where ID = $id ";
        $objDb->query($SQL2);
        $msg = $objDb->get_data();
        ?>

    <? } else { ?>
        <input name="action" type="hidden" value="add" />
    <? } ?>
    <table cellspacing="0" cellpadding="0" width="100%"  class="maintable" id="feedbackTable">
        <tr><td>

                        <label> 物业名称</label>
            </td><td>
<input name="Name" id="Name"  type="text" value="<?=$msg[0]['Name']; ?>" /></td> </tr>
        <tr><td>

                        <label> 可包面积</label></td>
                    <td>
<input name="Area" id="Area"  type="text" value="<?=$msg[0]['Area']; ?>" /></td> </tr><tr><td>

                        <label> 价格</label></td>
                    <td>
<input name="Price" id="Price"  type="text" value="<?=$msg[0]['Price']; ?>" /></td> </tr><tr><td>

                        <label> 管理费</label></td>
                    <td>
<input name="ManagementPrice" id="ManagementPrice"  type="text" value="<?=$msg[0]['ManagementPrice']; ?>" /></td> </tr><tr><td>

                        <label> 空调费</label></td>
                    <td>
<input name="Cooling" id="Cooling"  type="text" value="<?=$msg[0]['Cooling']; ?>" /></td> </tr>
        <tr><td>

                <label> 免租期</label></td>
            <td>
                <input name="Period" id="Period"  type="text" value="<?=$msg[0]['Period']; ?>" /></td> </tr>
        <tr><td>
        <tr><td>

                        <label> 合同年限</label></td>
                    <td>
<input name="Contract" id="Contract"  type="text" value="<?=$msg[0]['Contract']; ?>" /></td> </tr>
        <tr><td>

                <label> 递增</label></td>
            <td>
                <input name="Add" id="Add"  type="text" value="<?=$msg[0]['Add']; ?>" /></td> </tr><tr><td>

                <label> 洽谈人</label></td>
            <td>
                <input name="Partner" id="Partner"  type="text" value="<?=$msg[0]['Partner']; ?>" /></td> </tr>
        <tr><td>
                <label> 录入时间</label></td>
            <td>
                <input name="Time" id="Time"  type="text" value="<?=$msg[0]['Time']; ?>" /></td> </tr>

        <tr><td>
                <label> 状态</label></td>
            <td>
                <input name="State" id="State"  type="text" value="<?=$msg[0]['State']; ?>" /></td> </tr>
        <tr><td>
                <label> 已批示</label></td>
            <td>
                <input name="If" id="If"  type="text" value="<?=$msg[0]['If']; ?>" /></td> </tr>


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
