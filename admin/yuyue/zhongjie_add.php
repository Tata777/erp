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
    $aduf->actionAdd(hy_b_zhongjie);
}elseif ($_POST[action] == "update") {
    $aduf->actionUpdate(hy_b_zhongjie,ID);
}
?>


<body id="main" >
<table  id="pagehead" cellpadding="0" cellspacing="0" border="0" width="100%">
    <tr>
        <td width="23%"><h1>中介公司管理系统</h1></td>
        <td width="77%" class="actions"><table  cellpadding="0" cellspacing="0" border="0" align="right">
                <tr>
                    <td ><a href="zhongjie.php" class="view">管理列表</a></td>
                    <td class="active"><a href="zhongjie_add.php" class="edit">新增</a></td>

                </tr>
            </table></td>
    </tr>
</table>

<form action="zhongjie_add.php" method="post" onsubmit="return checkContent(this);">
    <? if ($_GET["id"]) { ?>
        <input name="action" type="hidden" value="update" />
        <input name="id" type="hidden" value="<?=$_GET["id"]?>" />

        <?
        $SQL2 = " select * from hy_b_zhongjie where ID = $id ";
        $objDb->query($SQL2);
        $msg = $objDb->get_data();
        ?>

    <? } else { ?>
        <input name="action" type="hidden" value="add" />
    <? } ?>
    <table cellspacing="0" cellpadding="0" width="100%"  class="maintable" id="feedbackTable">
        <tr><td>

                        <label> 公司名称</label>
            </td><td>
<input name="CopyrightName" id="CopyrightName"  type="text" value="<?=$msg[0]['CopyrightName']; ?>" /></td> </tr>
        <tr><td>

                        <label> 公司地址</label></td>
                    <td>
<input name="CopyrightAddress" id="CopyrightAddress"  type="text" value="<?=$msg[0]['CopyrightAddress']; ?>" /></td> </tr><tr><td>

                        <label> 办公电话</label></td>
                    <td>
<input name="Phone" id="Phone"  type="text" value="<?=$msg[0]['Phone']; ?>" /></td> </tr><tr><td>

                        <label> 营业执照号码</label></td>
                    <td>
<input name="Number" id="Number"  type="text" value="<?=$msg[0]['Number']; ?>" /></td> </tr><tr><td>

                        <label> 公司性质</label></td>
                    <td>
<input name="CopyrightType" id="CopyrightType"  type="text" value="<?=$msg[0]['CopyrightType']; ?>" /></td> </tr>
        <tr><td>

                <label> 经营范围</label></td>
            <td>
                <input name="Scope" id="Scope"  type="text" value="<?=$msg[0]['Scope']; ?>" /></td> </tr>
        <tr><td>
        <tr><td>

                        <label> 客户来源</label></td>
                    <td>
<input name="Source" id="Source"  type="text" value="<?=$msg[0]['Source']; ?>" /></td> </tr>
        <tr><td>

                <label> 客户归属</label></td>
            <td>
                <input name="Attribution" id="Attribution"  type="text" value="<?=$msg[0]['Attribution']; ?>" /></td> </tr><tr><td>

                <label> 公司人数</label></td>
            <td>
                <input name="CopyrightNumber" id="CopyrightNumber"  type="text" value="<?=$msg[0]['CopyrightNumber']; ?>" /></td> </tr>


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
