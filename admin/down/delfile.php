<?
$protectid="132";
include ("../protect.php");
require("../../class/mysqldb.inc.php");
$db=new mysqldb();
if (isset($_POST['choice'])){
   $choice=$_POST['choice'];
        }else{
        echo "<script language=\"javascript\">\n";
         echo "alert(\"请选择要删除的记录\")\n";
         echo "history.back()\n";
         echo "</script>";
        }


  if(count($choice)>0)
  {
  $choice1=0;
        for ($i=0;$i<count($choice);$i++)
     {
      $choice1=$choice1.",".$choice[$i];
     }
         $sql="delete from hy_download where download_id in ($choice1)";
         $db->query($sql);
  }
  else
  {
     $sql="delete from hy_download where download_id=".$id;
     $db->query($sql);
  }
         echo "<script language=\"javascript\">\n";
         echo "alert(\"删除成功\")\n";
         echo "location.href='index.php'\n";
         echo "</script>";
?>
