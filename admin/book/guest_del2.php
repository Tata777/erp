<? 
	$protectid="6"; 
	include("../protect.php");
	
	include_once("../../config.inc.php");
	
	include_once(CFG_LIB_DIR.'mysqldb.inc.php');
	$objDb = new mysqldb();
   
   $id=$_GET['id'];
   $sql="delete from `".con_strPREFIX."zfresult` where guest_id=".$id;

   $rt=$objDb->query($sql);
   if($rt){
			   echo "<script language=\"javascript\">\n";
               echo "alert('删除成功!');\n";
			   echo "location.href='index.php';\n";
               echo "</script>";
            }else{
               echo "<script language=\"javascript\">\n";
               echo "alert('删除失败!');\n";
               echo "history.back();\n";
               echo "</script>";
             }

?>