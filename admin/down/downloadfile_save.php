<?
include("../protect.php");
include("../../class/mysqldb.inc.php");
$db=new mysqldb();
$downloadsort=$_POST["downloadsort"];
$pic_url=$_POST["pic_url"];
$download_name=$_POST['download_name'];
$download_content=$_POST['download_content'];
$download_filesize=$_POST['downloadfile_size'];
//$donwload_member=$_POST['file_member'];
$donwload_member=0;
$sql="INSERT INTO  hy_download (download_name,download_sort,download_url,downloadfile_date,download_content,download_filesize,download_member) VALUES ('$download_name','$downloadsort','$pic_url',now(),'$download_content','$download_filesize','$donwload_member')";


$db->query($sql);
$num=$db->get_num1();
if ($num>0){;
    echo "<script language=\"javascript\">\n";
    echo "alert('恭喜你添加成功')\n";
    echo "window.location.href='index.php';";
    echo "</script>";
	exit();
   }else{
    echo "<script language=\"javascript\">\n";
    echo "alert('添加失败')\n";
    echo "history.back();";
    echo "</script>";
	exit();
  }
?>
