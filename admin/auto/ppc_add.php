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
<script language="javascript">
    function checkContent(dom){
if(!check_empty(dom.bidTime,"出价时间不能为空！")) return false;
if(!check_isnum(dom.bidTime,"出价时间只能为数字！")) return false;
if(!check_empty(dom.clicks,"点击次数不能为空！")) return false;
if(!check_isnum(dom.clicks,"点击次数只能为数字！")) return false;
if(!check_empty(dom.state,"关键字状态不能为空！")) return false;
if(!check_isnum(dom.state,"关键字状态只能为数字！")) return false;
if(!check_empty(dom.money,"消费金额不能为空！")) return false;
if(!check_isnum(dom.money,"消费金额只能为数字！")) return false;
if(!check_empty(dom.myPro,"推广的产品编号不能为空！")) return false;
if(!check_isnum(dom.myPro,"推广的产品编号只能为数字！")) return false;
  //if(!check_istel(dom.guest_contact,"请输入正确的联系电话，只可以由数字和“/”和“-”组成！")) return false;
        //if(!check_isemail(dom.guest_email,"邮箱格式不正确！")) return false;
        return true;
    }
</script>
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
                    <td class="active"><a href="ppc_add.php" class="edit">新增</a></td>
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
    <table cellspacing="0" cellpadding="0" width="100%"  class="maintable" id="feedbackTable"><tr><td>

                        <label> 关键字</label></td>
                    <td>
<input name="key" id="key"  type="text" value="<?=$msg[0]['key']; ?>" /></td> </tr><tr><td>

                        <label> 我的出价（元）</label></td>
                    <td>
<input name="myPrice" id="myPrice"  type="text" value="<?=$msg[0]['myPrice']; ?>" /></td> </tr><tr><td>

                        <label> 当前排名</label></td>
                    <td>
<input name="ranking" id="ranking"  type="text" value="<?=$msg[0]['ranking']; ?>" /></td> </tr><tr><td>

                        <label> 出价时间</label></td>
                    <td>
<input name="bidTime" id="bidTime"  type="text" value="<?=$msg[0]['bidTime']; ?>" /></td> </tr><tr><td>

                        <label> 点击次数</label></td>
                    <td>
<input name="clicks" id="clicks"  type="text" value="<?=$msg[0]['clicks']; ?>" /></td> </tr><tr><td>

                        <label> 关键字状态</label></td>
                    <td>
<input name="state" id="state"  type="text" value="<?=$msg[0]['state']; ?>" /></td> </tr><tr><td>

                        <label> 消费金额</label></td>
                    <td>
<input name="money" id="money"  type="text" value="<?=$msg[0]['money']; ?>" /></td> </tr><tr><td>

                        <label> 推广的产品编号</label></td>
                    <td>
<input name="myPro" id="myPro"  type="text" value="<?=$msg[0]['myPro']; ?>" /></td> </tr><tr><td colspan="2">
        <center>
		<?php
		    if ($_GET["id"]) { 
			   $str ="修改";
			}else{ 
			   $str="提交";
			} ?>
            <input type="submit" value="<?=$str?>" />
        </center>
        </td></tr>
    </table>
</form>
</body>
</html>
