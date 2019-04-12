<?
  $protectid="202";
  include ("../protect.php");
  require("../../class/mysqldb.inc.php");
  $db=new mysqldb();
  $id=$_GET['id'];
  $sql="update hy_member set user_shen='1' where user_id=$id";
  $result=$db->query($sql);
   if($result)
             {
               echo "<script language=\"javascript\">\n";
               echo "alert('恭喜你审核成功')\n";
               echo "location.href=\"index.php\"\n";
               echo "</script>";
             }else{
               echo "<script language=\"javascript\">\n";
               echo "alert('对不起，审核失败')\n";
               echo "history.back()\n";
               echo "</script>";
             }
?>