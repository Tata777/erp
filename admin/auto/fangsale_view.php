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
    $aduf->actionAdd(hy_b_tuansale);
}elseif ($_POST[action] == "update") {
    $aduf->actionUpdate(hy_b_tuansale,id);
}
?>


<body id="main" >
<table  id="pagehead" cellpadding="0" cellspacing="0" border="0" width="100%">
    <tr>
        <td width="23%"><h1>申请团销管理系统</h1></td>
        <td width="77%" class="actions"><table  cellpadding="0" cellspacing="0" border="0" align="right">
                <tr>
                    <td ><a href="index.php" class="view">管理列表</a></td>
                    <td ><a href="fangsale_add.php" class="edit">新增</a></td>
					<td ><a href="fangsale_search.php" class="edit">高级搜索</a></td>
                </tr>
            </table></td>
    </tr>
</table>

<form action="fangsale_add.php" method="post" onsubmit="return checkContent(this);">
    <? if ($_GET["id"]) { ?>
        <input name="action" type="hidden" value="update" />
        <input name="id" type="hidden" value="<?=$_GET["id"]?>" />

        <?
        $SQL2 = " select * from hy_b_tuansale where id = $id ";
        $objDb->query($SQL2);
        $msg = $objDb->get_data();
        ?>

    <? } else { ?>
        <input name="action" type="hidden" value="add" />
    <? } ?>
    <table cellspacing="0" cellpadding="0" width="100%"  class="maintable" id="feedbackTable"><tr><td></td><td><?=$msg[0]['id']; ?> </td></tr><tr><td>申请单位</td><td><?=$msg[0]['applyUnit']; ?> </td></tr><tr><td>项目名称</td><td><?=$msg[0]['name']; ?> </td></tr><tr><td>省</td><td><?=$msg[0]['province']; ?> </td></tr><tr><td>市</td><td><?=$msg[0]['city']; ?> </td></tr><tr><td>区（县）</td><td><?=$msg[0]['qu']; ?> </td></tr><tr><td>镇（乡）</td><td><?=$msg[0]['zheng']; ?> </td></tr><tr><td>规划建设用地</td><td><?=$msg[0]['ghjsyd']; ?> </td></tr><tr><td>亩</td><td><?=$msg[0]['mu']; ?> </td></tr><tr><td>容积率</td><td><?=$msg[0]['rzl']; ?> </td></tr><tr><td>限高</td><td><?=$msg[0]['xg']; ?> </td></tr><tr><td>总建筑面积</td><td><?=$msg[0]['zjzsize']; ?> </td></tr><tr><td>住宅面积</td><td><?=$msg[0]['zzsize']; ?> </td></tr><tr><td>商业面积</td><td><?=$msg[0]['sysize']; ?> </td></tr><tr><td>建设标准</td><td><?=$msg[0]['jsbz']; ?> </td></tr><tr><td>装修标准</td><td><?=$msg[0]['zxbz']; ?> </td></tr><tr><td>物业保障</td><td><?=$msg[0]['wybz']; ?> </td></tr><tr><td>住宅1</td><td><?=$msg[0]['zhuzai1']; ?> </td></tr><tr><td>商业2</td><td><?=$msg[0]['buzy1']; ?> </td></tr><tr><td>车位3</td><td><?=$msg[0]['car1']; ?> </td></tr><tr><td>住宅1</td><td><?=$msg[0]['zhuzai2']; ?> </td></tr><tr><td>商业2</td><td><?=$msg[0]['buzy2']; ?> </td></tr><tr><td>车位3</td><td><?=$msg[0]['car2']; ?> </td></tr><tr><td>住宅1</td><td><?=$msg[0]['zhuzai3']; ?> </td></tr><tr><td>商业2</td><td><?=$msg[0]['buzy3']; ?> </td></tr><tr><td>车位3</td><td><?=$msg[0]['car3']; ?> </td></tr><tr><td>备注</td><td><?=$msg[0]['note']; ?> </td></tr><tr><td>联系人1</td><td><?=$msg[0]['contact1']; ?> </td></tr><tr><td>联系电话1</td><td><?=$msg[0]['mobile1']; ?> </td></tr><tr><td>固定电话1</td><td><?=$msg[0]['tel1;']; ?> </td></tr><tr><td>联系人2</td><td><?=$msg[0]['contact2']; ?> </td></tr><tr><td>联系电话2</td><td><?=$msg[0]['mobile2']; ?> </td></tr><tr><td>固定电话2</td><td><?=$msg[0]['tel2;']; ?> </td></tr><tr><td>联系人3</td><td><?=$msg[0]['contact3']; ?> </td></tr><tr><td>联系电话3</td><td><?=$msg[0]['mobile3']; ?> </td></tr><tr><td>固定电话3</td><td><?=$msg[0]['tel3;']; ?> </td></tr><tr><td>发布日期</td><td><?=$msg[0]['publishtime']; ?> </td></tr>
    </table>
</form>
</body>
</html>
