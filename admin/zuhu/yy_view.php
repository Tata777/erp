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
                    <td ><a href="yy_add.php" class="edit">新增</a></td>
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
    <table cellspacing="0" cellpadding="0" width="100%"  class="maintable" id="feedbackTable"><tr><td>序号</td><td><?=$msg[0]['id']; ?> </td></tr><tr><td>预约时间</td><td><?=$msg[0]['yy_time']; ?> </td></tr><tr><td>预约项目</td><td><?=$msg[0]['yy_xiangmu']; ?> </td></tr><tr><td>用户名</td><td><?=$msg[0]['user_truename']; ?> </td></tr><tr><td>会员ID</td><td><?=$msg[0]['user_id']; ?> </td></tr><tr><td>预约店铺</td><td><?=$msg[0]['yuyue_dianpuName']; ?> </td></tr><tr><td>创建时间</td><td><?=$msg[0]['create_time']; ?> </td></tr>
    </table>
</form>
</body>
</html>
