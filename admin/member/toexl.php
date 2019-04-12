<?php   
header("Content-Type: application/vnd.ms-execl");   
header("Content-Disposition: attachment; filename=myExcel.xls");   
header("Pragma: no-cache");   
header("Expires: 0");   
   
$protectid="201"; 
include ("../protect.php");
include "../../class/page.php";

require("../../class/mysqldb.inc.php");
include "../../class/infomanager.php";
$db=new mysqldb();

$sql = "select * from hy_member  ";
$db->query($sql);
$result=$db->get_data();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table>
<tr><td>学号</td><td>用户名</td><td>性别</td><td>民族</td><td>政治面貌</td><td>真实姓名</td><td>年级</td><td>系别</td><td>专业</td><td>班级</td>
<td>工作单位</td>
<td>职务</td>
<td>工作地点</td>
<td>联系电话</td>
<td>QQ号码</td>

<td>Email</td><td>出生年月</td> <td>注册时间</td> </tr>
<?
if($result){
  foreach($result as $key=>$value){
       ?>
	   <tr><td><? echo $value['xh'];?></td><td><? echo $value['user_name'];?></td><td><? echo $value['user_truename'];?></td>
	   <td><? echo $value['user_sex'] == 1? '男':'女';?></td>
       <td><? echo $value['minzhu'];?></td>
       <td><? echo $value['zhengzhi'];?></td>
       <td><? echo $value['nj'];?></td>
	   <td><? echo $value['yuanxi'];?></td><td><? echo $value['zy'];?></td><td>  <? echo $value['banji'];?></td>
	   
	   <td><? echo $value['workunit'];?></td>
<td><? echo $value['job'];?></td>
<td><? echo $value['workingplace'];?></td>
<td><? echo $value['contactnumber'];?></td>
<td><? echo $value['qq'];?></td>
	   
	   
	   <td><? echo $value['user_email'];?></td><td><? echo $value['csny'];?></td>
	   <td><? echo $value['user_regtime'];?></td>
	    </tr>
	   
	   <?
  }
}  
?>
</table>