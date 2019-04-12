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
if(!check_empty(dom.applyUnit,"申请单位不能为空！")) return false;
if(!check_empty(dom.name,"项目名称不能为空！")) return false;
if(!check_empty(dom.province,"省不能为空！")) return false;
if(!check_empty(dom.city,"市不能为空！")) return false;
if(!check_empty(dom.qu,"区（县）不能为空！")) return false;
if(!check_empty(dom.zheng,"镇（乡）不能为空！")) return false;
if(!check_empty(dom.ghjsyd,"规划建设用地不能为空！")) return false;
if(!check_empty(dom.mu,"亩不能为空！")) return false;
if(!check_empty(dom.rzl,"容积率不能为空！")) return false;
if(!check_empty(dom.xg,"限高不能为空！")) return false;
if(!check_empty(dom.zjzsize,"总建筑面积不能为空！")) return false;
if(!check_empty(dom.zzsize,"住宅面积不能为空！")) return false;
if(!check_empty(dom.sysize,"商业面积不能为空！")) return false;
if(!check_empty(dom.jsbz,"建设标准不能为空！")) return false;
if(!check_empty(dom.zxbz,"装修标准不能为空！")) return false;
if(!check_empty(dom.wybz,"物业保障不能为空！")) return false;
if(!check_empty(dom.zhuzai1,"住宅1不能为空！")) return false;
if(!check_empty(dom.buzy1,"商业2不能为空！")) return false;
if(!check_empty(dom.car1,"车位3不能为空！")) return false;
if(!check_empty(dom.zhuzai2,"住宅1不能为空！")) return false;
if(!check_empty(dom.buzy2,"商业2不能为空！")) return false;
if(!check_empty(dom.car2,"车位3不能为空！")) return false;
if(!check_empty(dom.zhuzai3,"住宅1不能为空！")) return false;
if(!check_empty(dom.buzy3,"商业2不能为空！")) return false;
if(!check_empty(dom.car3,"车位3不能为空！")) return false;
if(!check_empty(dom.contact1,"联系人1不能为空！")) return false;
if(!check_empty(dom.mobile1,"联系电话1不能为空！")) return false;
if(!check_empty(dom.tel1;,"固定电话1不能为空！")) return false;
if(!check_empty(dom.contact2,"联系人2不能为空！")) return false;
if(!check_empty(dom.mobile2,"联系电话2不能为空！")) return false;
if(!check_empty(dom.tel2;,"固定电话2不能为空！")) return false;
if(!check_empty(dom.contact3,"联系人3不能为空！")) return false;
if(!check_empty(dom.mobile3,"联系电话3不能为空！")) return false;
if(!check_empty(dom.tel3;,"固定电话3不能为空！")) return false;
if(!check_empty(dom.publishtime,"发布日期不能为空！")) return false;
if(!check_isnum(dom.publishtime,"发布日期只能为数字！")) return false;
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
    $aduf->actionAdd(hy_b_tuansale);
}elseif ($_POST[action] == "update") {
    $aduf->actionUpdate(hy_b_tuansale,id);
}
?>


<body id="main" >
<table  id="pagehead" cellpadding="0" cellspacing="0" border="0" width="100%">
    <tr>
        <td width="23%"><h1>申请团销管理系统</h1></td>
        <td width="77%" class="actions"><table  cellpadding="0" cellspacing="0" border="0" align="right">
                <tr>
                    <td ><a href="index.php" class="view">管理列表</a></td>
                    <td class="active"><a href="fangsale_add.php" class="edit">新增</a></td>
					<td ><a href="fangsale_search.php" class="edit">高级搜索</a></td>
                </tr>
            </table></td>
    </tr>
</table>

<form action="fangsale_add.php" method="post" onsubmit="return checkContent(this);">
    <? if ($_GET["id"]) { ?>
        <input name="action" type="hidden" value="update" />
        <input name="id" type="hidden" value="<?=$_GET["id"]?>" />

        <?
        $SQL2 = " select * from hy_b_tuansale where id = $id ";
        $objDb->query($SQL2);
        $msg = $objDb->get_data();
        ?>

    <? } else { ?>
        <input name="action" type="hidden" value="add" />
    <? } ?>
    <table cellspacing="0" cellpadding="0" width="100%"  class="maintable" id="feedbackTable"><tr><td>

                        <label> 申请单位</label></td>
                    <td>
<input name="applyUnit" id="applyUnit"  type="text" value="<?=$msg[0]['applyUnit']; ?>" /></td> </tr><tr><td>

                        <label> 项目名称</label></td>
                    <td>
<input name="name" id="name"  type="text" value="<?=$msg[0]['name']; ?>" /></td> </tr><tr><td>

                        <label> 省</label></td>
                    <td>
<input name="province" id="province"  type="text" value="<?=$msg[0]['province']; ?>" /></td> </tr><tr><td>

                        <label> 市</label></td>
                    <td>
<input name="city" id="city"  type="text" value="<?=$msg[0]['city']; ?>" /></td> </tr><tr><td>

                        <label> 区（县）</label></td>
                    <td>
<input name="qu" id="qu"  type="text" value="<?=$msg[0]['qu']; ?>" /></td> </tr><tr><td>

                        <label> 镇（乡）</label></td>
                    <td>
<input name="zheng" id="zheng"  type="text" value="<?=$msg[0]['zheng']; ?>" /></td> </tr><tr><td>

                        <label> 规划建设用地</label></td>
                    <td>
<input name="ghjsyd" id="ghjsyd"  type="text" value="<?=$msg[0]['ghjsyd']; ?>" /></td> </tr><tr><td>

                        <label> 亩</label></td>
                    <td>
<input name="mu" id="mu"  type="text" value="<?=$msg[0]['mu']; ?>" /></td> </tr><tr><td>

                        <label> 容积率</label></td>
                    <td>
<input name="rzl" id="rzl"  type="text" value="<?=$msg[0]['rzl']; ?>" /></td> </tr><tr><td>

                        <label> 限高</label></td>
                    <td>
<input name="xg" id="xg"  type="text" value="<?=$msg[0]['xg']; ?>" /></td> </tr><tr><td>

                        <label> 总建筑面积</label></td>
                    <td>
<input name="zjzsize" id="zjzsize"  type="text" value="<?=$msg[0]['zjzsize']; ?>" /></td> </tr><tr><td>

                        <label> 住宅面积</label></td>
                    <td>
<input name="zzsize" id="zzsize"  type="text" value="<?=$msg[0]['zzsize']; ?>" /></td> </tr><tr><td>

                        <label> 商业面积</label></td>
                    <td>
<input name="sysize" id="sysize"  type="text" value="<?=$msg[0]['sysize']; ?>" /></td> </tr><tr><td>

                        <label> 建设标准</label></td>
                    <td>
<input name="jsbz" id="jsbz"  type="text" value="<?=$msg[0]['jsbz']; ?>" /></td> </tr><tr><td>

                        <label> 装修标准</label></td>
                    <td>
<input name="zxbz" id="zxbz"  type="text" value="<?=$msg[0]['zxbz']; ?>" /></td> </tr><tr><td>

                        <label> 物业保障</label></td>
                    <td>
<input name="wybz" id="wybz"  type="text" value="<?=$msg[0]['wybz']; ?>" /></td> </tr><tr><td>

                        <label> 住宅1</label></td>
                    <td>
<input name="zhuzai1" id="zhuzai1"  type="text" value="<?=$msg[0]['zhuzai1']; ?>" /></td> </tr><tr><td>

                        <label> 商业2</label></td>
                    <td>
<input name="buzy1" id="buzy1"  type="text" value="<?=$msg[0]['buzy1']; ?>" /></td> </tr><tr><td>

                        <label> 车位3</label></td>
                    <td>
<input name="car1" id="car1"  type="text" value="<?=$msg[0]['car1']; ?>" /></td> </tr><tr><td>

                        <label> 住宅1</label></td>
                    <td>
<input name="zhuzai2" id="zhuzai2"  type="text" value="<?=$msg[0]['zhuzai2']; ?>" /></td> </tr><tr><td>

                        <label> 商业2</label></td>
                    <td>
<input name="buzy2" id="buzy2"  type="text" value="<?=$msg[0]['buzy2']; ?>" /></td> </tr><tr><td>

                        <label> 车位3</label></td>
                    <td>
<input name="car2" id="car2"  type="text" value="<?=$msg[0]['car2']; ?>" /></td> </tr><tr><td>

                        <label> 住宅1</label></td>
                    <td>
<input name="zhuzai3" id="zhuzai3"  type="text" value="<?=$msg[0]['zhuzai3']; ?>" /></td> </tr><tr><td>

                        <label> 商业2</label></td>
                    <td>
<input name="buzy3" id="buzy3"  type="text" value="<?=$msg[0]['buzy3']; ?>" /></td> </tr><tr><td>

                        <label> 车位3</label></td>
                    <td>
<input name="car3" id="car3"  type="text" value="<?=$msg[0]['car3']; ?>" /></td> </tr><tr><td>

                        <label> 备注</label></td>
                    <td>
<textarea name="note" id="note"><?=$msg[0]['note']; ?></textarea>
							<script type="text/javascript">
								var editor = new UE.ui.Editor();
								editor.render("note");
							</script>
						</td> </tr><tr><td>

                        <label> 联系人1</label></td>
                    <td>
<input name="contact1" id="contact1"  type="text" value="<?=$msg[0]['contact1']; ?>" /></td> </tr><tr><td>

                        <label> 联系电话1</label></td>
                    <td>
<input name="mobile1" id="mobile1"  type="text" value="<?=$msg[0]['mobile1']; ?>" /></td> </tr><tr><td>

                        <label> 固定电话1</label></td>
                    <td>
<input name="tel1;" id="tel1;"  type="text" value="<?=$msg[0]['tel1;']; ?>" /></td> </tr><tr><td>

                        <label> 联系人2</label></td>
                    <td>
<input name="contact2" id="contact2"  type="text" value="<?=$msg[0]['contact2']; ?>" /></td> </tr><tr><td>

                        <label> 联系电话2</label></td>
                    <td>
<input name="mobile2" id="mobile2"  type="text" value="<?=$msg[0]['mobile2']; ?>" /></td> </tr><tr><td>

                        <label> 固定电话2</label></td>
                    <td>
<input name="tel2;" id="tel2;"  type="text" value="<?=$msg[0]['tel2;']; ?>" /></td> </tr><tr><td>

                        <label> 联系人3</label></td>
                    <td>
<input name="contact3" id="contact3"  type="text" value="<?=$msg[0]['contact3']; ?>" /></td> </tr><tr><td>

                        <label> 联系电话3</label></td>
                    <td>
<input name="mobile3" id="mobile3"  type="text" value="<?=$msg[0]['mobile3']; ?>" /></td> </tr><tr><td>

                        <label> 固定电话3</label></td>
                    <td>
<input name="tel3;" id="tel3;"  type="text" value="<?=$msg[0]['tel3;']; ?>" /></td> </tr><tr><td>

                        <label> 发布日期</label></td>
                    <td>
<input name="publishtime" id="publishtime"  type="text" value="<?=$msg[0]['publishtime']; ?>" /></td> </tr><tr><td colspan="2">
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
