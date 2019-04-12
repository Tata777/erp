<?
	session_start();
	require("../../class/mysqldb.inc.php");
	$db=new mysqldb();
	
	$action=$_POST["action"];
	if ($action=="save")
	{
		$uid=$_POST["uid"];
		$customer=$_POST["username"];
		$pro_name=$_POST["pro_name"];
		$code=$_POST["code"];
		$unit=$_POST["unit"];
		$number=$_POST["number"];
		$remark=$_POST["remark"];
		$time=date("Y-m-d H:i:s");
		
		
		$sql="insert into hy_member_stock (uid,customer,pro_name,code,unit,number,remark,time) values('$uid','$customer','$pro_name','$code','$unit','$number','$remark','$time')";
		$rs=$db->query($sql);
		if($rs)
		{
			 
			 echo "<script language=\"javascript\">\n";
			 echo "alert('客户库存量添加成功')\n";
			 echo "location.href=\"stock_view.php\"";
			 echo "</script>";
			 exit;
		}
		else
		{
			 echo "<script language=\"javascript\">\n";
			 echo "alert('数据提交有误');\n";
			 echo "history.back()\n";
			 echo "</script>";
			 exit;
		}
	}
	else
	{
			 echo "<script language=\"javascript\">\n";
			 echo "history.back()\n";
			 echo "</script>";
			 exit;
	}
?>