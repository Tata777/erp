<? 
	$protectid="6"; 
	include("../protect.php");
	
	include_once("../../config.inc.php");
	
	include_once(CFG_LIB_DIR.'mysqldb.inc.php');
	$objDb = new mysqldb();
   
   $id=$_GET['id'];
	 $ProductID = $_GET['ProductID'];
   $sql="delete from `".con_strPREFIX."pro_order` where OrderID=".$id;

   $rt=$objDb->query($sql);
   if($rt){
			   echo "<script language=\"javascript\">\n";
               echo "alert('删除成功!');\n";
			   echo "location.href='order.php?id=".$ProductID."';\n";
               echo "</script>";
            }else{
               echo "<script language=\"javascript\">\n";
               echo "alert('删除失败!');\n";
               echo "history.back();\n";
               echo "</script>";
             }

?>