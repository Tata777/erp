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

$str_tmp .= "\r\n";
$str_tmp .= '<table id="pagehead" cellpadding="0" cellspacing="0" border="0" width="100%">
    <tr>
        <td width="23%"><h1>'.$managername.'</h1></td>
        <td width="77%" class="actions"><table summary="" cellpadding="0" cellspacing="0" border="0" align="right">
                <tr>
                    <td><a href="index.php" class="view">管理列表</a></td>
                    <td ><a href="'.$filename.'_add.php" class="edit">新增</a></td>
					<td   class="active"><a href="'.$filename.'_search.php" class="edit">高级搜索</a></td>
					
                </tr>
            </table></td>
    </tr>
</table>';

$str_tmp .='<h2>搜索一下</h2>';
$str_tmp .= "\r\n";
$str_tmp .='<table  cellspacing="0" cellpadding="0" width="100%"  class="listtable">';
$str_tmp .= "\r\n";
$str_tmp .='<form method="get" name="searchfrom" id="searchfrom" action="'.$filename.'_admin_list.php" >';
$str_tmp .= "\r\n";
if ($result) {
	foreach ($result as $key => $value) {
		//if ($key == 0) continue;
		if($value['IS_NULLABLE'] == 'NO'){
			$str_tmp .= '<tr><td align="right">';
			$str_tmp.='<label><b>'.$value['column_comment'].'</b></label></td><td><input type="text" name="'.$value['COLUMN_NAME'].'" id="'.$value['COLUMN_NAME'].'" />';
			$str_tmp .='</td></tr>';
			
			$str_tmp .= "\r\n";
		}

	}
}

$str_tmp .='<tr><td colspan="2" ><center><input  type="submit" value="搜索" /></center></td></tr>';
$str_tmp .= "\r\n";
$str_tmp .='</form>';
$str_tmp .= "\r\n";
$str_tmp .= '</table>
</body>
</html>
';


//保存文件
$sf=$dir.$filename."_search.php"; //文件名
$fp=fopen($sf,"w"); //写方式打开文件
fwrite($fp,$str_tmp); //存入内容
fclose($fp); //关闭文件

echo "<script> location.href='d.php';</script>";
?>