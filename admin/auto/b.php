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
<script language="javascript">
    function checkContent(dom){';
		  $SQL3 = "  select column_comment,COLUMN_NAME,DATA_TYPE,IS_NULLABLE from INFORMATION_SCHEMA.Columns where table_name= '".$tablename."' and table_schema='".$database."' ";
        $objDb->query($SQL3);
        $result = $objDb->get_data();
		 $str_tmp .= "\r\n";
        if ($result) {
            foreach ($result as $key => $value) {
				if ($key == 0) continue;
				if($value['IS_NULLABLE'] == 'NO'){
					
                    $str_tmp.='if(!check_empty(dom.'.$value['COLUMN_NAME'].',"'.$value['column_comment'].'不能为空！")) return false;';
				
				    if($value['DATA_TYPE'] == 'int'){
						 $str_tmp .= "\r\n";
        			     $str_tmp.='if(!check_isnum(dom.'.$value['COLUMN_NAME'].',"'.$value['column_comment'].'只能为数字！")) return false;';
				    }
					$str_tmp .= "\r\n";
				}
			
		
			}
		}
		
		
      $str_tmp.='  //if(!check_istel(dom.guest_contact,"请输入正确的联系电话，只可以由数字和“/”和“-”组成！")) return false;
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
                    <td class="active"><a href="'.$filename.'_add.php" class="edit">新增</a></td>
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
                if ($key == 0)
                    continue;
                
                $str_tmp .= "<tr><td>

                        <label> ".$value["column_comment"]."</label></td>
                    <td>";
					$str_tmp .= "\r\n";
					if($value['CHARACTER_MAXIMUM_LENGTH'] == '199'){
					    $str_tmp .= '	<input name="'.$value['COLUMN_NAME'].'" type="text" id="'.$value['COLUMN_NAME'].'" size="60" value="<?php echo $msg[0]['."'".$value['COLUMN_NAME']."'".']; ?>" />&nbsp;&nbsp;
      <span class="buttons">
        <input type="button" value="上传"  onclick="'. "PopupWindow('../upload.php?dir=17&input=".$value['COLUMN_NAME']."', 380, 140);".'" class="submit">
				<input type="button" value="选择" onclick="'."PopupWindow('../pic_list.php?dir=17&input=".$value['COLUMN_NAME']."', 712, 600);".'">
			</span>
			';	
			            $str_tmp .= "\r\n";
					}
					
					//根据字段类型选择相关的编辑框	
                    else if($value['DATA_TYPE'] == 'text'){
						

						
						$str_tmp .= '<textarea name="'.$value["COLUMN_NAME"].'" id="'.$value["COLUMN_NAME"].'"><?=$msg[0]['."'".$value["COLUMN_NAME"] ."'".']; ?></textarea>';
						$str_tmp .= '
							<script type="text/javascript">
								var editor = new UE.ui.Editor();
								editor.render("'.$value["COLUMN_NAME"].'");
							</script>
						';     
					}else{
						
						$str_tmp .= '<input name="'.$value["COLUMN_NAME"].'" id="'.$value["COLUMN_NAME"].'"  type="text" value="<?=$msg[0]['."'".$value["COLUMN_NAME"] ."'".']; ?>" />';
					}
					$str_tmp .= '</td> </tr>';
			}
		}         
		$str_tmp .= '<tr><td colspan="2">
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
';


//保存文件
$sf=$dir.$filename."_add.php"; //文件名
$fp=fopen($sf,"w"); //写方式打开文件
fwrite($fp,$str_tmp); //存入内容
fclose($fp); //关闭文件

echo "<script> location.href='c.php';</script>";
?>