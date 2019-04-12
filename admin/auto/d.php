<?php
include_once('config.php');

$str_php="<?php\n"; //得到php的起始符。$str_tmp将累加
$str_end="?>\r\n"; //php结束符
$str_tmp = $str_php;
$str_tmp.=" include \"includeFiles.php\";\r\n"; 
$str_tmp .= $str_end;
$str_tmp.='
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

</head>
<?php
include_once("../../class/aduf.class.php");
include_once("../common/files.php"); 
$aduf = new Audf();
if ($_POST[action] == "add") {
    $aduf->actionAdd('.$tablename.');
}elseif ($_POST[action] == "update") {
    $aduf->actionUpdate('.$tablename.','.$frstid.');
}
?>
';
$str_tmp .= "\r\n";
$str_tmp .='
<body id="main" >
<table  id="pagehead" cellpadding="0" cellspacing="0" border="0" width="100%">
    <tr>
        <td width="23%"><h1>'.$managername.'</h1></td>
        <td width="77%" class="actions"><table  cellpadding="0" cellspacing="0" border="0" align="right">
                <tr>
                    <td ><a href="index.php" class="view">管理列表</a></td>
                    <td ><a href="'.$filename.'_add.php" class="edit">新增</a></td>
					<td ><a href="'.$filename.'_search.php" class="edit">高级搜索</a></td>
                </tr>
            </table></td>
    </tr>
</table>

<form action="'.$filename.'_add.php" method="post" onsubmit="return checkContent(this);">
    <? if ($_GET["id"]) { ?>
        <input name="action" type="hidden" value="update" />
        <input name="id" type="hidden" value="<?=$_GET["id"]?>" />

        <?
        $SQL2 = " select * from '.$tablename.' where '.$frstid.' = $id ";
        $objDb->query($SQL2);
        $msg = $objDb->get_data();
        ?>

    <? } else { ?>
        <input name="action" type="hidden" value="add" />
    <? } ?>
    <table cellspacing="0" cellpadding="0" width="100%"  class="maintable" id="feedbackTable">';
        
         $SQL3 = "  select COLUMN_NAME,CHARACTER_MAXIMUM_LENGTH,column_comment,DATA_TYPE from INFORMATION_SCHEMA.Columns where table_name= '".$tablename."' and table_schema='".$database."' ";
        $objDb->query($SQL3);
        $result = $objDb->get_data();
        if ($result) {
            foreach ($result as $key => $value) {
						
						$str_tmp .= '<tr><td>'.$value["column_comment"].'</td><td><?=$msg[0]['."'".$value["COLUMN_NAME"] ."'".']; ?> </td></tr>';
					
			}
		}         
		$str_tmp .= '
    </table>
</form>
</body>
</html>
';


//保存文件
$sf=$dir.$filename."_view.php"; //文件名
$fp=fopen($sf,"w"); //写方式打开文件
fwrite($fp,$str_tmp); //存入内容
fclose($fp); //关闭文件

echo "<script> alert('ok');</script>";
?>