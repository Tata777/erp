<?
$protectid="134";
include("../protect.php");
include("../../class/mysqldb.inc.php");
$db=new mysqldb();
$downloadsortname=$_POST["downloadsort_name"];
$sql="INSERT INTO  hy_downloadsort (downloadsort_name,downloadsort_date) VALUES ('$downloadsortname','".time()."')";
//exit($sql);
$db->query($sql);
$num=$db->get_num1();
if ($num>0){;
    echo "<script language=\"javascript\">\n";
    echo "alert('恭喜你添加成功')\n";
    echo "window.location.href='downloadsort_index.php';";
    echo "</script>";
    exit();
   } else {
    echo "<script language=\"javascript\">\n";
    echo "alert('添加失败')\n";
    echo "history.back();";
    echo "</script>";
    exit();
  }
?>
