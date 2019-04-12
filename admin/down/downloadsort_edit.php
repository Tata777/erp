<?
$protectid="133";
include("../protect.php");
include("../../class/mysqldb.inc.php");
$db=new mysqldb();
$sortid=$_POST['sortid'];
$downloadsortname=$_POST["downloadsort_name"];
$sql="update hy_downloadsort set downloadsort_name='$downloadsortname' where downloadsort_id='$sortid'";
$db->query($sql);
$num=$db->get_num1();
if ($num>0){;
    echo "<script language=\"javascript\">\n";
    echo "alert('恭喜你修改成功')\n";
    echo "window.location.href='downloadsort_index.php';";
    echo "</script>";
   } else {
    echo "<script language=\"javascript\">\n";
    echo "alert('修改失败')\n";
    echo "history.back();";
    echo "</script>";
   }
?>
