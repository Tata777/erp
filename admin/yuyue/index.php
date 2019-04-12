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
    $aduf->actionDelete(hy_b_fangyuan,ID);
}
?>

<table id="pagehead" cellpadding="0" cellspacing="0" border="0" width="100%">
    <tr>
        <td width="23%"><h1>房源管理系统</h1></td>
        <td width="77%" class="actions"><table summary="" cellpadding="0" cellspacing="0" border="0" align="right">
                <tr>
                    <td class="active"><a href="index.php" class="view">管理列表</a></td>
                    <td ><a href="yy_add.php" class="edit">新增</a></td>
<!--					<td ><a href="yy_search.php" class="edit">高级搜索</a></td>-->
					
                </tr>
            </table></td>
    </tr>
</table>
<?php 

$sql = "SELECT * FROM `hy_b_fangyuan` WHERE  1  $con ";
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
                <input type="button" value="全选/全不选" id="unSelect"></td><td> 序号</td><td> 编号</td><td> 物业名称</td><td> 房号</td><td> 面积</td>
            <td> 初始单价</td><td> 当前单价</td><td> 当前月租</td><td> 物业单价</td><td> 物业总价</td><td> 年限</td><td> 租赁押金</td><td> 物业押金</td>
            <td> 水电押金</td><td> 租付几月</td><td> 起租日</td><td> 到期日</td><td> 二次计租日</td><td> 租户公司</td><td> 成交类型</td><td> 租金税率</td><td> 成交人</td>
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
<td><?=$value[Num]?></td>
<td><?=$value[HouseName]?></td>
<td><?=$value[HouseID]?></td>
<td><?=$value[HouseArea]?></td>
<td><?=$value[IniPrice]?></td>
<td><?=$value[NowPrice]?></td>
<td><?=$value[NowRental]?></td>
<td><?=$value[TentmentPrice]?></td>
<td><?=$value[TentmentAllPrice]?></td>
<td><?=$value[Year]?></td>
<td><?=$value[Deposit]?></td>
<td><?=$value[TentmentDeposit]?></td>
<td><?=$value[WaterDeposit]?></td>
<td><?=$value[Lease]?></td>
<td><?=$value[StartDate]?></td>
<td><?=$value[EndDate]?></td>
<td><?=$value[SecondDate]?></td>
<td><?=$value[Copyright]?></td>
<td><?=$value[Type]?></td>
<td><?=$value[TaxRate]?></td>
<td><?=$value[Personal]?></td>
 <td><span class="buttons"><input type="button" onclick="location.href='yy_add.php?id=<? echo $value[ID]; ?>'" value="编辑" class="submit"></span></td>
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
