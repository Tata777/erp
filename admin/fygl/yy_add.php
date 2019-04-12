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
if(!check_empty(dom.user_id,"会员ID不能为空！")) return false;
if(!check_isnum(dom.user_id,"会员ID只能为数字！")) return false;
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
    $aduf->actionAdd(hy_menzhenly);
}elseif ($_POST[action] == "update") {
    $aduf->actionUpdate(hy_menzhenly,id);
}
?>


<body id="main" >
<table  id="pagehead" cellpadding="0" cellspacing="0" border="0" width="100%">
    <tr>
        <td width="23%"><h1>预约管理系统</h1></td>
        <td width="77%" class="actions"><table  cellpadding="0" cellspacing="0" border="0" align="right">
                <tr>
                    <td ><a href="index.php" class="view">管理列表</a></td>
                    <td class="active"><a href="yy_add.php" class="edit">新增</a></td>
					<td ><a href="yy_search.php" class="edit">高级搜索</a></td>
                </tr>
            </table></td>
    </tr>
</table>

<form action="yy_add.php" method="post" onsubmit="return checkContent(this);">
    <? if ($_GET["id"]) { ?>
        <input name="action" type="hidden" value="update" />
        <input name="id" type="hidden" value="<?=$_GET["id"]?>" />

        <?
        $SQL2 = " select * from hy_menzhenly where id = $id ";
        $objDb->query($SQL2);
        $msg = $objDb->get_data();
        ?>

    <? } else { ?>
        <input name="action" type="hidden" value="add" />
    <? } ?>
    <table cellspacing="0" cellpadding="0" width="100%"  class="maintable" id="feedbackTable"><tr><td>

                        <label> 预约时间</label></td>
                    <td>
<input name="yy_time" id="yy_time"  type="text" value="<?=$msg[0]['yy_time']; ?>" /></td> </tr><tr><td>

                        <label> 预约项目</label></td>
                    <td>
<input name="yy_xiangmu" id="yy_xiangmu"  type="text" value="<?=$msg[0]['yy_xiangmu']; ?>" /></td> </tr><tr><td>

                        <label> 用户名</label></td>
                    <td>
<input name="user_truename" id="user_truename"  type="text" value="<?=$msg[0]['user_truename']; ?>" /></td> </tr><tr><td>

                        <label> 会员ID</label></td>
                    <td>
<input name="user_id" id="user_id"  type="text" value="<?=$msg[0]['user_id']; ?>" /></td> </tr><tr><td>

                        <label> 预约店铺</label></td>
                    <td>
<input name="yuyue_dianpuName" id="yuyue_dianpuName"  type="text" value="<?=$msg[0]['yuyue_dianpuName']; ?>" /></td> </tr><tr><td>

                        <label> 创建时间</label></td>
                    <td>
<input name="create_time" id="create_time"  type="text" value="<?=$msg[0]['create_time']; ?>" /></td> </tr><tr><td colspan="2">
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
