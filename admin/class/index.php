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
    $aduf->actionDelete(hy_b_class,id);
}
?>

<table id="pagehead" cellpadding="0" cellspacing="0" border="0" width="100%">
    <tr>
        <td width="23%"><h1>班级管理系统</h1></td>
        <td width="77%" class="actions"><table summary="" cellpadding="0" cellspacing="0" border="0" align="right">
                <tr>
                    <td class="active"><a href="index.php" class="view">管理列表</a></td>
                    <td ><a href="class_add.php" class="edit">新增</a></td>
					<td ><a href="class_search.php" class="edit">高级搜索</a></td>
					
                </tr>
            </table></td>
    </tr>
</table>
<?php 
echo "您搜索对应的关键字为<font color='#FF0000'>".implode(",",$_GET)."</font>"; 
 if($_GET['id']){
    $con .=" AND id ='".$_GET['id']."'"; 
 } 
 if($_GET['nianJi']){
    $con .=" AND nianJi ='".$_GET['nianJi']."'"; 
 } 
 if($_GET['memberID']){
    $con .=" AND memberID ='".$_GET['memberID']."'"; 
 } 
 if($_GET['banji']){
    $con .=" AND banji ='".$_GET['banji']."'"; 
 } 
 if($_GET['pic']){
    $con .=" AND pic ='".$_GET['pic']."'"; 
 } 
 if($_GET['zhuanye']){
    $con .=" AND zhuanye ='".$_GET['zhuanye']."'"; 
 } 

$sql = "SELECT * FROM `hy_b_class` WHERE  1  $con ";
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
                <input type="button" value="全选/全不选" id="unSelect"></td><td> 序号</td><td> 班级名称</td><td> 宣言</td><td> 年级</td><td> 建立时间</td><td> 所属会员ID</td>
 <td>操作</td>
        </tr>
        
        <?php
        if (empty($total))
            echo "<tr><Td colspan=\"8\"><center>对不起！资料暂时为空！</center></td></tr>";
        if ($result) {
            foreach ($result as $key => $value) {
                ?>
                <tr id="content">
                    <td><input name="ID[]"  id="ID[]" type="checkbox" value="<?php echo $value[id]; ?>" /></td>
<td><?=$value[id]?></td>
<td><?=$value[className]?></td>
<td><?=$value[xuanYuan]?></td>
<td><?=$value[nianJi]?></td>
<td><?=$value[date]?></td>
<td><?=$value[memberID]?></td>
 <td><sapn class="buttons"><input type="button" onclick="location.href='class_add.php?id=<? echo $value[id]; ?>'" value="编辑" class="submit"></span></td>
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
