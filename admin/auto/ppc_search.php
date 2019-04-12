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
    $aduf->actionDelete(hy_b_ppc,ID);
}
?>


<table id="pagehead" cellpadding="0" cellspacing="0" border="0" width="100%">
    <tr>
        <td width="23%"><h1>竞价排名管理系统</h1></td>
        <td width="77%" class="actions"><table summary="" cellpadding="0" cellspacing="0" border="0" align="right">
                <tr>
                    <td><a href="index.php" class="view">管理列表</a></td>
                    <td ><a href="ppc_add.php" class="edit">新增</a></td>
					<td   class="active"><a href="ppc_search.php" class="edit">高级搜索</a></td>
					
                </tr>
            </table></td>
    </tr>
</table><h2>搜索一下</h2>
<table  cellspacing="0" cellpadding="0" width="100%"  class="listtable">
<form method="get" name="searchfrom" id="searchfrom" action="ppc_admin_list.php" >
<tr><td align="right"><label><b>编号</b></label></td><td><input type="text" name="ID" id="ID" /></td></tr>
<tr><td align="right"><label><b>出价时间</b></label></td><td><input type="text" name="bidTime" id="bidTime" /></td></tr>
<tr><td align="right"><label><b>点击次数</b></label></td><td><input type="text" name="clicks" id="clicks" /></td></tr>
<tr><td align="right"><label><b>关键字状态</b></label></td><td><input type="text" name="state" id="state" /></td></tr>
<tr><td align="right"><label><b>消费金额</b></label></td><td><input type="text" name="money" id="money" /></td></tr>
<tr><td align="right"><label><b>推广的产品编号</b></label></td><td><input type="text" name="myPro" id="myPro" /></td></tr>
<tr><td colspan="2" ><center><input  type="submit" value="搜索" /></center></td></tr>
</form>
</table>
</body>
</html>
