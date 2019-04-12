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
    $aduf->actionAdd(hy_b_class);
}elseif ($_POST[action] == "update") {
    $aduf->actionUpdate(hy_b_class,id);
}
?>


<body id="main" >
<table  id="pagehead" cellpadding="0" cellspacing="0" border="0" width="100%">
    <tr>
        <td width="23%"><h1>班级管理系统</h1></td>
        <td width="77%" class="actions"><table  cellpadding="0" cellspacing="0" border="0" align="right">
                <tr>
                    <td ><a href="index.php" class="view">管理列表</a></td>
                    <td ><a href="class_add.php" class="edit">新增</a></td>
					<td ><a href="class_search.php" class="edit">高级搜索</a></td>
                </tr>
            </table></td>
    </tr>
</table>

<form action="class_add.php" method="post" onsubmit="return checkContent(this);">
    <? if ($_GET["id"]) { ?>
        <input name="action" type="hidden" value="update" />
        <input name="id" type="hidden" value="<?=$_GET["id"]?>" />

        <?
        $SQL2 = " select * from hy_b_class where id = $id ";
        $objDb->query($SQL2);
        $msg = $objDb->get_data();
        ?>

    <? } else { ?>
        <input name="action" type="hidden" value="add" />
    <? } ?>
    <table cellspacing="0" cellpadding="0" width="100%"  class="maintable" id="feedbackTable"><tr><td>序号</td><td><?=$msg[0]['id']; ?> </td></tr><tr><td>班级名称</td><td><?=$msg[0]['className']; ?> </td></tr><tr><td>宣言</td><td><?=$msg[0]['xuanYuan']; ?> </td></tr><tr><td>年级</td><td><?=$msg[0]['nianJi']; ?> </td></tr><tr><td>建立时间</td><td><?=$msg[0]['date']; ?> </td></tr><tr><td>所属会员ID</td><td><?=$msg[0]['memberID']; ?> </td></tr><tr><td>班级</td><td><?=$msg[0]['banji']; ?> </td></tr><tr><td>所属班级图片</td><td><?=$msg[0]['pic']; ?> </td></tr><tr><td>专业</td><td><?=$msg[0]['zhuanye']; ?> </td></tr>
    </table>
</form>
</body>
</html>
