<?
$protectid="132";
include("../protect.php");
include("../../class/mysqldb.inc.php");
$db=new mysqldb();
$downloadid=$_POST['downloadid'];
$downloadsort=$_POST["downloadsort"];
$pic_url=$_POST["pic_url"];
$download_content=$_POST['download_content'];
$download_filesize=$_POST['downloadfile_size'];
$download_name=$_POST['download_name'];
//$donwload_member=$_POST['file_member'];
$donwload_member=0;
$sql="update hy_download set download_sort='$downloadsort',download_url='$pic_url',download_content='$download_content',download_filesize='$download_filesize',download_name='$download_name',download_member='$donwload_member' where download_id='$downloadid'";

$db->query($sql);
$result=$db->get_num1();

if ($db->result){
    echo "<script language=\"javascript\">\n";
    echo "alert('恭喜你修改成功')\n";
    echo "window.location.href='index.php';";
    echo "</script>";
   }else {
    echo "<script language=\"javascript\">\n";
    echo "alert('修改失败')\n";
    echo "history.back();";
    echo "</script>";
  }
?>
