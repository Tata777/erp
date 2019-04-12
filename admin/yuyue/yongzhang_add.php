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
    $aduf->actionAdd(hy_b_yongzhang);
}elseif ($_POST[action] == "update") {
    $aduf->actionUpdate(hy_b_yongzhang,ID);
}
?>


<body id="main" >
<table  id="pagehead" cellpadding="0" cellspacing="0" border="0" width="100%">
    <tr>
        <td width="23%"><h1>用章申请系统</h1></td>
        <td width="77%" class="actions"><table  cellpadding="0" cellspacing="0" border="0" align="right">
                <tr>
                    <td ><a href="yongzhang.php" class="view">管理列表</a></td>
                    <td class="active"><a href="yongzhang_add.php" class="edit">新增</a></td>

                </tr>
            </table></td>
    </tr>
</table>

<form action="yongzhang_add.php" method="post" onsubmit="return checkContent(this);">
    <? if ($_GET["id"]) { ?>
        <input name="action" type="hidden" value="update" />
        <input name="id" type="hidden" value="<?=$_GET["id"]?>" />

        <?
        $SQL2 = " select * from hy_b_yongzhang where ID = $id ";
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

                        <label> 用章类型</label></td>
                    <td>
<input name="Type" id="Type"  type="text" value="<?=$msg[0]['Type']; ?>" /></td> </tr><tr><td>

                        <label> 盖章内容</label></td>
                    <td>
<input name="Content" id="Content"  type="text" value="<?=$msg[0]['Content']; ?>" /></td> </tr><tr><td>

                        <label> 申请人</label></td>
                    <td>
<input name="Applicant" id="Applicant"  type="text" value="<?=$msg[0]['Applicant']; ?>" /></td> </tr><tr><td>

                        <label> 申请时间</label></td>
                    <td>
<input name="ApplicantTime" id="ApplicantTime"  type="text" value="<?=$msg[0]['ApplicantTime']; ?>" /></td> </tr>
        <tr><td>

                        <label> 标的物</label></td>
                    <td>
<input name="Tag" id="Tag"  type="text" value="<?=$msg[0]['Tag']; ?>" /></td> </tr>
        <tr><td>

                <label> 内务工程审核</label></td>
            <td>
                <input name="Interior" id="Interior"  type="text" value="<?=$msg[0]['Interior']; ?>" /></td> </tr><tr><td>

                <label> 法务审核</label></td>
            <td>
                <input name="Legal" id="Legal"  type="text" value="<?=$msg[0]['Legal']; ?>" /></td> </tr>
        <tr><td>
                <label> 会计审核</label></td>
            <td>
                <input name="Accounting" id="Accounting"  type="text" value="<?=$msg[0]['Accounting']; ?>" /></td> </tr>

        <tr><td>
                <label> 总经理审核</label></td>
            <td>
                <input name="Manager" id="Manager"  type="text" value="<?=$msg[0]['Manager']; ?>" /></td> </tr>
        <tr><td>
                <label> 已盖章</label></td>
            <td>
                <input name="If" id="If"  type="text" value="<?=$msg[0]['If']; ?>" /></td> </tr>
        <tr><td>
                <label> 盖章人</label></td>
            <td>
                <input name="Personal" id="Personal"  type="text" value="<?=$msg[0]['Personal']; ?>" /></td> </tr>
        <tr><td>
                <label> 盖章时间</label></td>
            <td>
                <input name="SealTime" id="SealTime"  type="text" value="<?=$msg[0]['SealTime']; ?>" /></td> </tr>


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
