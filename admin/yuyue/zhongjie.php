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
    $aduf->actionDelete(hy_b_zhongjie,ID);
} ?>

<table id="pagehead" cellpadding="0" cellspacing="0" border="0" width="100%">
    <tr>
        <td width="23%"><h1>中介公司管理系统</h1></td>
        <td width="77%" class="actions"><table summary="" cellpadding="0" cellspacing="0" border="0" align="right">
                <tr>
                    <td class="active"><a href="zhongjie.php" class="view">管理列表</a></td>
                    <td ><a href="zhongjie_add.php" class="edit">新增</a></td>
<!--					<td ><a href="yy_search.php" class="edit">高级搜索</a></td>-->
					
                </tr>
            </table></td>
    </tr>
</table>
<?php 


$sql = "SELECT * FROM `hy_b_zhongjie` WHERE  1  $con ";
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
                <input type="button" value="全选/全不选" id="unSelect"></td><td> 序号</td><td> 公司名称</td><td> 公司地址</td><td> 办公电话</td><td> 营业执照号码</td>
            <td> 公司性质</td><td> 经营范围</td><td> 客户来源</td><td> 客户归属</td><td> 公司人数</td>

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
<td><?=$value[CopyrightName]?></td>
<td><?=$value[CopyrightAddress]?></td>
<td><?=$value[Phone]?></td>
<td><?=$value[Number]?></td>
<td><?=$value[CopyrightType]?></td>
<td><?=$value[Scope]?></td>
<td><?=$value[Source]?></td>
<td><?=$value[Attribution]?></td>
<td><?=$value[CopyrightNumber]?></td>


 <td><span class="buttons"><input type="button" onclick="location.href='zhongjie_add.php?id=<? echo $value[ID]; ?>'" value="编辑" class="submit"></span></td>
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
