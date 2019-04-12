<?php	
	require_once("./user_chksession.php");
	include_once("../config.inc.php");
	
	include_once(CFG_LIB_DIR.'check.php');
	$info = new check_ifno();
	
	if(isset($_POST['path']))
	{
		$path=$_POST['path'];
	}
	
  if(isset($_POST['choice']))
	{
		$choice = $_POST['choice'];
	}
	else
	{
		$info->popup('请选择要删除的记录');
	}

  if(count($choice) > 0)
  {
		for($i=0;$i<count($choice);$i++)
		{
			unlink($path."/".$choice[$i]);
		}
  }
	
	$info->popup('删除成功', 'pic_list.php?p='.$_POST['path']."&tablename=".$_POST['tablename']."&inputname=".$_POST['inputname']);
?>