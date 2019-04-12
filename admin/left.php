<?
session_start();
if (!isset($_SESSION["ad_id"])){
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">
<script>
alert('您没有登录或不是管理员，请重新登录！')
<!--top.location.href='index.php'-->
</script>";
}
include_once("../class/mysqldb.inc.php");
$db=new mysqldb();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sidemenu</title>
<link href="css/style.css" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript" src="../include/js/admin.js"></script>
<base target="mainframe" />
</head>

<body id="side">
<!--基本设置-->
<?
        $ad_flag=$_SESSION['ad_flag'];
				$cate=$_GET['cate'];
				$SqlWhere = " where parentid=0 and ifdisplay=1 and sort_id in ($leftflag) ";
				$SqlWhere .= $ad_flag != "demo"?" and sort_id in ($ad_flag)":"";
				$SqlWhere .= $cate ? " and cate = $cate ":"";
        $websortsql="select * from websort ".$SqlWhere."order by sort_id asc";
				//echo $websortsql;
        $db->query($websortsql);
        $websortnum=$db->get_num1();
        $websortresult=$db->get_data();
        for ($y=0;$y<$websortnum;$y++){
        $sort_icon_href=$websortresult[$y]["sort_icon_href"];
        if($sort_icon_href=="") $sort_icon_href="open2.gif";
        ?>
<div id="config" style="display: block;">
<h3><? echo $websortresult[$y]["sort_name"];?></h3>
<ul>
		   <?
          $parentid=$websortresult[$y]["sort_id"];
          if ($ad_flag=="demo"){
         $websortsql1="select * from websort where parentid=$parentid and  ifdisplay=1 order by sort_id asc";
         }else{
          $websortsql1="select * from websort where sort_id in ($ad_flag) and ifdisplay=1 and parentid=$parentid order by sort_id asc";
          }
          $db->query($websortsql1);
          $websortnum1=$db->get_num1();
          $websortresult1=$db->get_data();
          for ($x=0;$x<$websortnum1;$x++){
          $sort_icon_href1=$websortresult1[$x]["sort_icon_href"];
          if($sort_icon_href1=="") $sort_icon_href1="open2.gif";
          ?>
<li><a href="<? echo $websortresult1[$x]["sort_href"];?>"><? echo $websortresult1[$x]["sort_name"];?></a></li>
				 <? }?>

</ul>
</div>

 <? }?>
 
 
 
<script type="text/javascript">
treeView();
</script>
</body>
</html>
<?php	$db->close(); ?>