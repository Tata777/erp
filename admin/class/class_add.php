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
if(!check_empty(dom.nianJi,"年级不能为空！")) return false;
if(!check_empty(dom.memberID,"所属会员ID不能为空！")) return false;
if(!check_isnum(dom.memberID,"所属会员ID只能为数字！")) return false;
if(!check_empty(dom.banji,"班级不能为空！")) return false;
if(!check_empty(dom.pic,"所属班级图片不能为空！")) return false;
if(!check_empty(dom.zhuanye,"专业不能为空！")) return false;
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
    $aduf->actionAdd(hy_b_class);
}elseif ($_POST[action] == "update") {
    $aduf->actionUpdate(hy_b_class,id);
}
?>


<body id="main" >
<table  id="pagehead" cellpadding="0" cellspacing="0" border="0" width="100%">
    <tr>
        <td width="23%"><h1>班级管理系统</h1></td>
        <td width="77%" class="actions"><table  cellpadding="0" cellspacing="0" border="0" align="right">
                <tr>
                    <td ><a href="index.php" class="view">管理列表</a></td>
                    <td class="active"><a href="class_add.php" class="edit">新增</a></td>
					<td ><a href="class_search.php" class="edit">高级搜索</a></td>
                </tr>
            </table></td>
    </tr>
</table>

<form action="class_add.php" method="post" onsubmit="return checkContent(this);">
    <? if ($_GET["id"]) { ?>
        <input name="action" type="hidden" value="update" />
        <input name="id" type="hidden" value="<?=$_GET["id"]?>" />

        <?
        $SQL2 = " select * from hy_b_class where id = $id ";
        $objDb->query($SQL2);
        $msg = $objDb->get_data();
        ?>

    <? } else { ?>
        <input name="action" type="hidden" value="add" />
    <? } ?>
    <table cellspacing="0" cellpadding="0" width="100%"  class="maintable" id="feedbackTable"><tr><td>

                        <label> 班级名称</label></td>
                    <td>
<input name="className" id="className"  type="text" value="<?=$msg[0]['className']; ?>" /></td> </tr><tr><td>

                        <label> 宣言</label></td>
                    <td>
<textarea name="xuanYuan" id="xuanYuan"><?=$msg[0]['xuanYuan']; ?></textarea>
							<script type="text/javascript">
								var editor = new UE.ui.Editor();
								editor.render("xuanYuan");
							</script>
						</td> </tr><tr><td>

                        <label> 年级</label></td>
                    <td>
<input name="nianJi" id="nianJi"  type="text" value="<?=$msg[0]['nianJi']; ?>" /></td> </tr><tr><td>

                        <label> 建立时间</label></td>
                    <td>
<input name="date" id="date"  type="text" value="<?=$msg[0]['date']; ?>" /></td> </tr><tr><td>

                        <label> 所属会员ID</label></td>
                    <td>
<input name="memberID" id="memberID"  type="text" value="<?=$msg[0]['memberID']; ?>" /></td> </tr><tr><td>

                        <label> 班级</label></td>
                    <td>
<input name="banji" id="banji"  type="text" value="<?=$msg[0]['banji']; ?>" /></td> </tr><tr><td>

                        <label> 所属班级图片</label></td>
                    <td>
<input name="pic" id="pic"  type="text" value="<?=$msg[0]['pic']; ?>" /></td> </tr><tr><td>

                        <label> 专业</label></td>
                    <td>
<input name="zhuanye" id="zhuanye"  type="text" value="<?=$msg[0]['zhuanye']; ?>" /></td> </tr><tr><td colspan="2">
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
