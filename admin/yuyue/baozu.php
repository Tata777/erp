<?php
 include "includeFiles.php";
 include "../../page.php";
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<link href="../css/edit.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../js/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="../js/aduf.js"></script>
</head>
<body id="main" >
<?php
include_once("../../class/aduf.class.php");
$aduf = new Audf();
if ($_POST[action] == "del") {
    $aduf->actionDelete(hy_b_zuhu,ID);
} ?>

<table id="pagehead" cellpadding="0" cellspacing="0" border="0" width="100%">
    <tr>
        <td width="23%"><h1>包租意向系统</h1></td>
        <td width="77%" class="actions"><table summary="" cellpadding="0" cellspacing="0" border="0" align="right">
                <tr>
                    <td class="active"><a href="baozu.php" class="view">管理列表</a></td>
                    <td ><a href="baozu_add.php" class="edit">新增</a></td>
<!--					<td ><a href="yy_search.php" class="edit">高级搜索</a></td>-->
					
                </tr>
            </table></td>
    </tr>
</table>
<?php 


$sql = "SELECT * FROM `hy_b_baozu` WHERE  1  $con ";
$result = mysql_query($sql);
$total = mysql_num_rows($result);
_PAGEFT($total, 20);
echo "结果数为:".  $total;
$SQL2 = $sql . " order by `id` DESC limit $firstcount,$displaypg  ";
$objDb->query($SQL2);
$result = $objDb->get_data();
?>
<form action="#" method="post" name="form1" onsubmit="return isDel();">
    <table cellspacing="0" cellpadding="0" width="100%"  class="listtable">
        <tr id="first">
            <td><input name="action" type="hidden" value="del" >
                <input type="button" value="全选/全不选" id="unSelect"></td><td> 序号</td><td> 物业名称</td><td> 可包面积</td><td> 价格</td><td> 管理费</td>
            <td> 空调费</td><td> 免租期</td><td> 合同年限</td><td> 递增</td><td> 洽谈人</td><td> 录入时间</td><td> 状态</td><td> 已批示</td>

 <td>操作</td>
        </tr>
        
        <?php
        if (empty($total))
            echo "<tr><Td colspan=\"8\"><center>对不起！资料暂时为空！</center></td></tr>";
        if ($result) {
            foreach ($result as $key => $value) {
                ?>
                <tr id="content">
                    <td><input name="ID[]"  id="ID[]" type="checkbox" value="<?php echo $value[ID]; ?>" /></td>
<td><?=$value[ID]?></td>
<td><?=$value[Name]?></td>
<td><?=$value[Area]?></td>
<td><?=$value[Price]?></td>
<td><?=$value[ManagementPrice]?></td>
<td><?=$value[Cooling]?></td>
<td><?=$value[Period]?></td>
<td><?=$value[Contract]?></td>
<td><?=$value[Add]?></td>
<td><?=$value[Partner]?></td>
<td><?=$value[Time]?></td>
<td><?=$value[State]?></td>
<td><?=$value['If']?></td>

 <td><span class="buttons"><input type="button" onclick="location.href='baozu_add.php?id=<? echo $value[ID]; ?>'" value="编辑" class="submit"></span></td>
                </tr>
                <?
            }
        }
        ?>
    </table>
    <div align="center"> <?php echo $pagenav; ?></div>

    <input type="submit" id="submit" value="批量删除">
</form>
<script>
    //反选事件
    $("#unSelect").click(function() {
        var checkbox = $(":checkbox");
        for (var i = 0; i < checkbox.length; i++) {
            checkbox[i].checked = !checkbox[i].checked;
        }
    });

</script>
</body>
</html>
