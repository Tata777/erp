<?
$protectid="51";
include ("../protect.php");
 require("../../class/mysqldb.inc.php");
   $db=new mysqldb();
$customer=$_POST['customer'];
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
	 $sql="delete from hy_member_stock where id in ($choice1)";
	 $result=$db->query($sql);
      if ($result){
      echo "<script language=\"javascript\">\n";
     echo "alert(\"删除成功\")\n";
     echo "location.href=\"stock_search.php?customer=".$customer."\"";
     echo "</script>";
     }else{
     echo "<script language=\"javascript\">\n";
     echo "alert(\"删除失败\")\n";
     echo "location.href=\"stock_search.php?customer=".$customer."\"";
     echo "</script>";
     }
  }
  else
  {
     $sql="delete from hy_member_stock where id=".$id;
	 $result=$db->query($sql);
      if ($result){
      echo "<script language=\"javascript\">\n";
     echo "alert(\"删除成功\")\n";
      echo "location.href=\"stock_search.php?customer=".$customer."\"";
     echo "</script>";
     }else{
     echo "<script language=\"javascript\">\n";
     echo "alert(\"删除失败\")\n";
      echo "location.href=\"stock_search.php?customer=".$customer."\"";
     echo "</script>";
     }
  }
?>
