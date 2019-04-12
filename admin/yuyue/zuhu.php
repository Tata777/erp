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
        <td width="23%"><h1>租户管理系统</h1></td>
        <td width="77%" class="actions"><table summary="" cellpadding="0" cellspacing="0" border="0" align="right">
                <tr>
                    <td class="active"><a href="zuhu.php" class="view">管理列表</a></td>
                    <td ><a href="zuhu_add.php" class="edit">新增</a></td>
<!--					<td ><a href="yy_search.php" class="edit">高级搜索</a></td>-->
					
                </tr>
            </table></td>
    </tr>
</table>
<?php 

$sql = "SELECT * FROM `hy_b_zuhu` WHERE  1  $con ";
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
                <input type="button" value="全选/全不选" id="unSelect"></td><td> 序号</td><td> 客户姓名</td><td> 手机号码</td><td> 归属项目</td><td> 客户来源</td>
            <td> 公司名称</td><td> 客户职位</td><td> 法人姓名</td><td> 公司规模</td><td> 所看物业</td><td> 房号</td><td> 需求面积</td><td> 客户归属</td>
            <td> 录入时间</td><td> 意向度</td>

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
<td><?=$value[UserName]?></td>
<td><?=$value[Phone]?></td>
<td><?=$value[Project]?></td>
<td><?=$value[Source]?></td>
<td><?=$value[Copyright]?></td>
<td><?=$value[Job]?></td>
<td><?=$value[LegalName]?></td>
<td><?=$value[Scale]?></td>
<td><?=$value[SeeTentment]?></td>
<td><?=$value[Num]?></td>
<td><?=$value[Area]?></td>
<td><?=$value[Affiliation]?></td>
<td><?=$value[CreateTime]?></td>
<td><?=$value[Interest]?></td>
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
