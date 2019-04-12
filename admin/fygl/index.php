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
    $aduf->actionDelete(hy_menzhenly,id);
}
?>

<table id="pagehead" cellpadding="0" cellspacing="0" border="0" width="100%">
    <tr>
        <td width="23%"><h1>预约管理系统</h1></td>
        <td width="77%" class="actions"><table summary="" cellpadding="0" cellspacing="0" border="0" align="right">
                <tr>
                    <td class="active"><a href="index.php" class="view">管理列表</a></td>
                    <td ><a href="yy_add.php" class="edit">新增</a></td>
					<td ><a href="yy_search.php" class="edit">高级搜索</a></td>
					
                </tr>
            </table></td>
    </tr>
</table>
<?php 
echo "您搜索对应的关键字为<font color='#FF0000'>".implode(",",$_GET)."</font>"; 
 if($_GET['id']){
    $con .=" AND id ='".$_GET['id']."'"; 
 }
if($_GET['menzhen_id']){
    $con .=" AND menzhen_id ='".$_GET['menzhen_id']."'";
}
if($_GET['yy_time']){
    $con .=" AND yy_time ='".$_GET['yy_time']."'"; 
 } 
 if($_GET['yy_xiangmu']){
    $con .=" AND yy_xiangmu ='".$_GET['yy_xiangmu']."'"; 
 } 
 if($_GET['user_truename']){
    $con .=" AND user_truename ='".$_GET['user_truename']."'"; 
 } 
 if($_GET['user_id']){
    $con .=" AND user_id ='".$_GET['user_id']."'"; 
 } 
 if($_GET['yuyue_dianpuName']){
    $con .=" AND yuyue_dianpuName ='".$_GET['yuyue_dianpuName']."'"; 
 } 
 if($_GET['create_time']){
    $con .=" AND create_time ='".$_GET['create_time']."'"; 
 } 

$sql = "SELECT * FROM `hy_menzhenly` WHERE  1  $con ";
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
                <input type="button" value="全选/全不选" id="unSelect"></td><td> 序号</td><td> 预约时间</td><td> 预约项目</td><td> 用户名</td><td> 会员ID</td><td> 创建时间</td>
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
<td><?=$value[yy_time]?></td>
<td><?=$value[yy_xiangmu]?></td>
<td><?=$value[user_truename]?></td>
<td><?=$value[user_id]?></td>
<td><?=date("Y-m-d H:i:s", $value['create_time'])?></td>
 <td><span class="buttons"><input type="button" onclick="location.href='yy_add.php?id=<? echo $value[id]; ?>'" value="编辑" class="submit"></span></td>
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
