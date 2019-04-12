<?php
	include_once('../../class/mysqldb.inc.php');
	$db=new mysqldb();
	
	$comID=intval($_REQUEST['comID']);
	$sql_cnt="delete from hy_b_comment where ID=".$comID;
	$db->query($sql_cnt);
		
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" /><script>
alert('删除成功！');\n
location.href='commentlist.php';\n
</script>";
	
	
	//header("location:commentlist.php");
?>