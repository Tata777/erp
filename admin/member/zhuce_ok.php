<?php
include "includeFiles.php";
if(empty($cateid)) $cateid=11010;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $C['Title'];?></title>
<Link href="./uploadfile/ico/<?php echo $C['ICO'];?>" rel="Shortcut Icon">
<meta name="Keywords" content="<?php echo $C['Keywords'];?>">
<meta name="description" content="<?php echo $C['Description'];?>">
<Meta name="Copyright" Content="<?php echo $C['CopyRight'];?>">
<link type="text/css" href="./css/layout.css" rel="stylesheet" />
<link type="text/css" href="./css/skin.css" rel="stylesheet" />
<link type="text/css" href="./css/font.css" rel="stylesheet" />
<?php
$action=$_POST["action"];

$yancode=$_POST['yancode'];
	if ($_SESSION['seccode']=="" || trim($yancode)!=$_SESSION['seccode']){
		echo "<script>alert('验证码错误。');location.href='member.php';</script>";
		exit;
	}

if($action=="add"){
	$sql="select * from hy_member where user_name='$user_name'";
	$objDb->query($sql);
	$row=$objDb->get_data();
	if($row){
		echo "<script>alert('用户名已经存在，请另选其他。');location.href='member.php';</script>";
		exit;
	}
	$user_regtime=date("Y-m-d H:i:s",time());
	 $sql="insert into hy_member(`user_name`,`user_truename`,`user_pws`,`user_sex`,`user_email`,`user_zipcode`,`user_add`,`user_tel`,`user_mobile`,`user_company`,`user_intro`,`user_regtime`,`xingzhi`,`tel`,`qq`,`msn`,`other`,`desc`) values('$user_name','$user_truename','$user_pws','$user_sex','$user_email','$user_zipcode','$user_add','$user_tel','$user_mobile','$user_company','$user_intro','$user_regtime','$xingzhi','$tel','$qq','$msn','$other','$desc')";
	$result=$objDb->query($sql);
	
		
	 	$SQL2=" SELECT user_id FROM hy_member WHERE user_name='$user_name' ";
		$objDb->query($SQL2);
		$result2 = $objDb->get_data();
		//print_r($result2);
//die;
	
	if($result){
		$_SESSION["user_id"]=$result2[0]['user_id'];
			$_SESSION["user_name"]=$user_name;
			$_SESSION["islogin"]="1";
		echo "<script>alert('注册成功。');location.href='modify.php?email=$user_email';</script>";
		exit;
	}
	else{
		echo "<script>alert('注册失败，请重试。');history.go(-1);</script>";
		exit;
	}
}

?>