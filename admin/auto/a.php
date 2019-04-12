<?php
include_once('config.php');
$str_php = "<?php\n"; //得到php的起始符。$str_tmp将累加
$str_end = "?>\r\n"; //php结束符
$str_tmp = $str_php;
$str_tmp.= " include \"includeFiles.php\";\r\n"; 
$str_tmp.= " include \"../../page.php\";\r\n"; 
$str_tmp.= $str_end;
$str_tmp.= '
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
    $aduf->actionDelete('.$tablename.','.$frstid.');
}
?>
';

$SQL3 = "  select column_comment,COLUMN_NAME,DATA_TYPE,IS_NULLABLE from INFORMATION_SCHEMA.Columns where table_name= '".$tablename."' and table_schema='".$database."' ";
$objDb->query($SQL3);
$result = $objDb->get_data();
$str_tmp .= "\r\n";
$str_tmp .= '<table id="pagehead" cellpadding="0" cellspacing="0" border="0" width="100%">
    <tr>
        <td width="23%"><h1>'.$managername.'</h1></td>
        <td width="77%" class="actions"><table summary="" cellpadding="0" cellspacing="0" border="0" align="right">
                <tr>
                    <td class="active"><a href="index.php" class="view">管理列表</a></td>
                    <td ><a href="'.$filename.'_add.php" class="edit">新增</a></td>
					<td ><a href="'.$filename.'_search.php" class="edit">高级搜索</a></td>
					
                </tr>
            </table></td>
    </tr>
</table>';
$str_tmp .= "\r\n";
$str_tmp .= "<?php ";
$str_tmp .= "\r\n";
$str_tmp .= 'echo "您搜索对应的关键字为<font color='."'".'#FF0000'."'".'>".implode(",",$_GET)."</font>"; ';

$str_tmp .= "\r\n";

if ($result) {
	foreach ($result as $key => $value) {
		if($value['IS_NULLABLE'] == 'NO'){
			$str_tmp .= ' if($_GET['."'".$value['COLUMN_NAME']."'".']){';
			$str_tmp .= "\r\n";
			$str_tmp .= '    $con .=" AND '.$value['COLUMN_NAME'].' ='."'".'".$_GET['."'".$value['COLUMN_NAME']."'".']'.'."'."'".'"; ';
			$str_tmp .= "\r\n";
			$str_tmp .= " } ";
			$str_tmp .= "\r\n";
		}
	}
}

$str_tmp .='
$sql = "SELECT * FROM `'.$tablename.'` WHERE  1  $con ";
$result = mysql_query($sql);
$total = mysql_num_rows($result);
_PAGEFT($total, 20);
echo "结果数为:".  $total;
$SQL2 = $sql . " order by `'.$frstid.'` DESC limit $firstcount,$displaypg  ";
$objDb->query($SQL2);
$result = $objDb->get_data();
?>';
$str_tmp .= "\r\n";
$str_tmp .= '<form action="#" method="post" name="form1" onsubmit="return isDel();">
    <table cellspacing="0" cellpadding="0" width="100%"  class="listtable">
        <tr id="first">
            <td><input name="action" type="hidden" value="del" >
                <input type="button" value="全选/全不选" id="unSelect"></td>';
              
        $SQL3 =   "select COLUMN_NAME,column_comment from INFORMATION_SCHEMA.Columns where table_name= '".$tablename."' and table_schema='".$database."' ";
        
		$objDb->query($SQL3);
        $result2 = $objDb->get_data();
        if ($result2) {
            foreach ($result2 as $keys => $val) {
                if($keys >10) continue;
                $str_tmp  .= "<td> ".$val['column_comment']."</td>";
        }}
           $str_tmp .= "\r\n";
           $str_tmp .= ' <td>操作</td>
        </tr>
        
        <?php
        if (empty($total))
            echo "<tr><Td colspan=\"8\"><center>对不起！资料暂时为空！</center></td></tr>";
        if ($result) {
            foreach ($result as $key => $value) {
                ?>
                <tr id="content">
                    <td><input name="ID[]"  id="ID[]" type="checkbox" value="<?php echo $value['.$frstid.']; ?>" /></td>';
             $str_tmp .= "\r\n";
                     if ($result2) {
                         foreach ($result2 as $key2 => $val2) {
                             if($key2 > 10) continue;
                                $str_tmp .= '<td><?=$value['.$val2['COLUMN_NAME'].']?></td>';
                                $str_tmp .= "\n";
                       }} 
                   $str_tmp .= ' <td><sapn class="buttons"><input type="button" onclick="location.href='."'".$filename.'_add.php?id=<? echo $value['.$frstid.']; ?>\'" value="编辑" class="submit"></span></td>
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
';


//保存文件
$sf=$dir."index.php"; //文件名
$fp=fopen($sf,"w"); //写方式打开文件
fwrite($fp,$str_tmp); //存入内容
fclose($fp); //关闭文件

echo "<script> location.href='b.php';</script>";
?>