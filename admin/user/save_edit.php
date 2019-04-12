<?
    include "admin_pass.php";
  // include "../../web.config.php";
   include_once ("../../class/mysqldb.inc.php");
	$db=new mysqldb();

   $id=$_POST['id'];
   $admin_username=$_POST['admin_username'];
   if($_POST['admin_password']){
	  $admin_password=md5($_POST['admin_password']);
	}
   $admin_truename=$_POST['admin_truename'];
   $admin_flag=$_POST['admin_flag'];


if($admin_username!="")
{	//检查是否重名
	$sql="select * from admin where ad_username='$admin_username' and ad_id<>$id";
	$rs=mysql_query($sql);
	if(mysql_num_rows($rs)!=0)
	{	
	    echo "<script language=\"JavaScript\">";
		echo "alert(\"用户名已有，请换一个用户名！\");";
		echo "history.back()";
		echo "</script>";
        exit();    
}
   //设置权限
  $flag=0;
  if(count($admin_flag)>0)
  {
		for ($i=0;$i<count($admin_flag);$i++)
     {
      $flag=$flag.",".$admin_flag[$i];
	    }
	}
	else
	{
		$flag="demo";
	}
	
//	if($_SESSION['ad_id'] == 2) $flag="demo";
	
	
   if($_POST['admin_password']){
	$update_sql="update admin set ad_truename='$admin_truename',ad_username='$admin_username',ad_password='$admin_password',ad_flag='$flag' where ad_id=$id";
	}else{
	$update_sql="update admin set ad_truename='$admin_truename',ad_username='$admin_username',ad_flag='$flag' where ad_id=$id";
	}
	/*echo $update_sql;
	exit;*/
	mysql_query($update_sql) or die("修改用户数据库时出错!");
	echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
	echo "<script language=\"JavaScript\">";
	echo "alert(\"用户修改成功！\");";
	echo "location.href=\"index.php\";";
	echo "</script>";
}
?>