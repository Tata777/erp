<?
	session_start();
	include ("../protect.php");
	require("../../class/mysqldb.inc.php");
	$db=new mysqldb();
	
	$action=$_POST["action"];
	$yancode=$_POST["yancode"];
	////////////////////////////////////////////////
	if ($_SESSION['verfycode']=="" || trim($yancode)!=$_SESSION['verfycode'])
	{
			popup('提示：请输入正确的验证码！');
	}
	/////////////////////////////////////////////////
	if ($action=="save")
	{
		$username=$_POST["username"];
		$password=$_POST["password"];
		$passalt=$_POST["passalt"];
		$passda=$_POST["passda"];
		$name=$_POST["name"];
		$phone=$_POST["phone"];
		$email=$_POST["email"];
		$sex=$_POST["sex"];
		$user_add=$_POST["area"];
		$post=$_POST["post"];
		$regdate=date("Y-m-d H:i:s");
		$shenhe="1";
		$num=0;
		
		
		$sql="select user_name from hy_member where user_name='$username'";
		$db->query($sql);
		$num=$db->get_num1();
		if ($num>0)
		{
			//popup('用户名已存在，请另选用户名！');
			 echo("<script>alert('用户名已存在，请另选用户名！');history.go(-1);</script>");
			 exit;
		}

		/////---------------------------------------
		$sql="insert into hy_member (user_name,user_pws,passalt,passda,user_email,user_truename,user_tel,user_zipcode,user_regtime,user_shen,user_sex,user_add) values('$username','$password','$passalt','$passda','$email','$name','$phone','$post','$regdate',$shenhe,$sex,'$user_add')";
		$rs=$db->query($sql);
		if($rs)
		{
			 echo("<script>alert('提示：恭喜注册成功！');location.href='index.php';</script>");
			 exit;
		}
		else
		{
		 	 //popup('提示：注册失败，请重试！
			 echo("<script>alert('提示：注册失败，请重试！');history.go(-1);</script>");
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