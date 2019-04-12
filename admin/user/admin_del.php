<?
include "admin_pass.php";
include_once("../../class/mysqldb.inc.php");
$db=new mysqldb();
$id=$_GET['id'];

$sql="delete from admin where ad_id=$id";
/*var_dump($rs=$db->query($sql));
exit;*/
   if($db->query($sql)){
			   echo "
				 <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
				 <script language=\"javascript\">\n";
               echo "alert('删除成功!');\n";
               echo "history.back();\n";
               echo "</script>";
            }else{
               echo "
				 <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
							 <script language=\"javascript\">\n";
               echo "alert('删除失败!');\n";
               echo "history.back();\n";
               echo "</script>";
             }
?>
