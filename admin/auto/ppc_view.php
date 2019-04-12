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
    $aduf->actionAdd(hy_b_ppc);
}elseif ($_POST[action] == "update") {
    $aduf->actionUpdate(hy_b_ppc,ID);
}
?>


<body id="main" >
<table  id="pagehead" cellpadding="0" cellspacing="0" border="0" width="100%">
    <tr>
        <td width="23%"><h1>竞价排名管理系统</h1></td>
        <td width="77%" class="actions"><table  cellpadding="0" cellspacing="0" border="0" align="right">
                <tr>
                    <td ><a href="index.php" class="view">管理列表</a></td>
                    <td ><a href="ppc_add.php" class="edit">新增</a></td>
					<td ><a href="ppc_search.php" class="edit">高级搜索</a></td>
                </tr>
            </table></td>
    </tr>
</table>

<form action="ppc_add.php" method="post" onsubmit="return checkContent(this);">
    <? if ($_GET["id"]) { ?>
        <input name="action" type="hidden" value="update" />
        <input name="id" type="hidden" value="<?=$_GET["id"]?>" />

        <?
        $SQL2 = " select * from hy_b_ppc where ID = $id ";
        $objDb->query($SQL2);
        $msg = $objDb->get_data();
        ?>

    <? } else { ?>
        <input name="action" type="hidden" value="add" />
    <? } ?>
    <table cellspacing="0" cellpadding="0" width="100%"  class="maintable" id="feedbackTable"><tr><td>编号</td><td><?=$msg[0]['ID']; ?> </td></tr><tr><td>关键字</td><td><?=$msg[0]['key']; ?> </td></tr><tr><td>我的出价（元）</td><td><?=$msg[0]['myPrice']; ?> </td></tr><tr><td>当前排名</td><td><?=$msg[0]['ranking']; ?> </td></tr><tr><td>出价时间</td><td><?=$msg[0]['bidTime']; ?> </td></tr><tr><td>点击次数</td><td><?=$msg[0]['clicks']; ?> </td></tr><tr><td>关键字状态</td><td><?=$msg[0]['state']; ?> </td></tr><tr><td>消费金额</td><td><?=$msg[0]['money']; ?> </td></tr><tr><td>推广的产品编号</td><td><?=$msg[0]['myPro']; ?> </td></tr>
    </table>
</form>
</body>
</html>
