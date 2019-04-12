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
    $aduf->actionDelete(hy_b_tuansale,id);
}
?>


<table id="pagehead" cellpadding="0" cellspacing="0" border="0" width="100%">
    <tr>
        <td width="23%"><h1>申请团销管理系统</h1></td>
        <td width="77%" class="actions"><table summary="" cellpadding="0" cellspacing="0" border="0" align="right">
                <tr>
                    <td><a href="index.php" class="view">管理列表</a></td>
                    <td ><a href="fangsale_add.php" class="edit">新增</a></td>
					<td   class="active"><a href="fangsale_search.php" class="edit">高级搜索</a></td>
					
                </tr>
            </table></td>
    </tr>
</table><h2>搜索一下</h2>
<table  cellspacing="0" cellpadding="0" width="100%"  class="listtable">
<form method="get" name="searchfrom" id="searchfrom" action="fangsale_admin_list.php" >
<tr><td align="right"><label><b></b></label></td><td><input type="text" name="id" id="id" /></td></tr>
<tr><td align="right"><label><b>申请单位</b></label></td><td><input type="text" name="applyUnit" id="applyUnit" /></td></tr>
<tr><td align="right"><label><b>项目名称</b></label></td><td><input type="text" name="name" id="name" /></td></tr>
<tr><td align="right"><label><b>省</b></label></td><td><input type="text" name="province" id="province" /></td></tr>
<tr><td align="right"><label><b>市</b></label></td><td><input type="text" name="city" id="city" /></td></tr>
<tr><td align="right"><label><b>区（县）</b></label></td><td><input type="text" name="qu" id="qu" /></td></tr>
<tr><td align="right"><label><b>镇（乡）</b></label></td><td><input type="text" name="zheng" id="zheng" /></td></tr>
<tr><td align="right"><label><b>规划建设用地</b></label></td><td><input type="text" name="ghjsyd" id="ghjsyd" /></td></tr>
<tr><td align="right"><label><b>亩</b></label></td><td><input type="text" name="mu" id="mu" /></td></tr>
<tr><td align="right"><label><b>容积率</b></label></td><td><input type="text" name="rzl" id="rzl" /></td></tr>
<tr><td align="right"><label><b>限高</b></label></td><td><input type="text" name="xg" id="xg" /></td></tr>
<tr><td align="right"><label><b>总建筑面积</b></label></td><td><input type="text" name="zjzsize" id="zjzsize" /></td></tr>
<tr><td align="right"><label><b>住宅面积</b></label></td><td><input type="text" name="zzsize" id="zzsize" /></td></tr>
<tr><td align="right"><label><b>商业面积</b></label></td><td><input type="text" name="sysize" id="sysize" /></td></tr>
<tr><td align="right"><label><b>建设标准</b></label></td><td><input type="text" name="jsbz" id="jsbz" /></td></tr>
<tr><td align="right"><label><b>装修标准</b></label></td><td><input type="text" name="zxbz" id="zxbz" /></td></tr>
<tr><td align="right"><label><b>物业保障</b></label></td><td><input type="text" name="wybz" id="wybz" /></td></tr>
<tr><td align="right"><label><b>住宅1</b></label></td><td><input type="text" name="zhuzai1" id="zhuzai1" /></td></tr>
<tr><td align="right"><label><b>商业2</b></label></td><td><input type="text" name="buzy1" id="buzy1" /></td></tr>
<tr><td align="right"><label><b>车位3</b></label></td><td><input type="text" name="car1" id="car1" /></td></tr>
<tr><td align="right"><label><b>住宅1</b></label></td><td><input type="text" name="zhuzai2" id="zhuzai2" /></td></tr>
<tr><td align="right"><label><b>商业2</b></label></td><td><input type="text" name="buzy2" id="buzy2" /></td></tr>
<tr><td align="right"><label><b>车位3</b></label></td><td><input type="text" name="car2" id="car2" /></td></tr>
<tr><td align="right"><label><b>住宅1</b></label></td><td><input type="text" name="zhuzai3" id="zhuzai3" /></td></tr>
<tr><td align="right"><label><b>商业2</b></label></td><td><input type="text" name="buzy3" id="buzy3" /></td></tr>
<tr><td align="right"><label><b>车位3</b></label></td><td><input type="text" name="car3" id="car3" /></td></tr>
<tr><td align="right"><label><b>联系人1</b></label></td><td><input type="text" name="contact1" id="contact1" /></td></tr>
<tr><td align="right"><label><b>联系电话1</b></label></td><td><input type="text" name="mobile1" id="mobile1" /></td></tr>
<tr><td align="right"><label><b>固定电话1</b></label></td><td><input type="text" name="tel1;" id="tel1;" /></td></tr>
<tr><td align="right"><label><b>联系人2</b></label></td><td><input type="text" name="contact2" id="contact2" /></td></tr>
<tr><td align="right"><label><b>联系电话2</b></label></td><td><input type="text" name="mobile2" id="mobile2" /></td></tr>
<tr><td align="right"><label><b>固定电话2</b></label></td><td><input type="text" name="tel2;" id="tel2;" /></td></tr>
<tr><td align="right"><label><b>联系人3</b></label></td><td><input type="text" name="contact3" id="contact3" /></td></tr>
<tr><td align="right"><label><b>联系电话3</b></label></td><td><input type="text" name="mobile3" id="mobile3" /></td></tr>
<tr><td align="right"><label><b>固定电话3</b></label></td><td><input type="text" name="tel3;" id="tel3;" /></td></tr>
<tr><td align="right"><label><b>发布日期</b></label></td><td><input type="text" name="publishtime" id="publishtime" /></td></tr>
<tr><td colspan="2" ><center><input  type="submit" value="搜索" /></center></td></tr>
</form>
</table>
</body>
</html>
