<?php
	require_once("./user_chksession.php");
	include_once("../config.inc.php");
	
	//先读取文件信息到数组
	if(isset($_GET['dir']))
	{
		$d_p = "../".UPLOAD_DIR."/".$uploaddirarray[$_GET['dir']];
	}
	else
	{
		$d_p = "../".UPLOAD_DIR;
	}
	
	include_once(CFG_LIB_DIR.'page.php');
	$page = new ShowPage();
	$page->PageSize = 21;
	$page->LinkAry = array("dir" => $_GET['dir'], "input" => $_GET['input'], "pic" =>$_GET['pic']);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $companyname;?></title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="css/edit.css" rel="stylesheet" type="text/css" />
<style type="text/css">
	body { margin: 10px; }
	#picUL { margin: 0; padding: 0; }
	#picUL li { margin: 2px 2px; padding: 0; list-style: none; width: 220px; height: 240px; float: left; display: block; }
	th.pic { height: 170px; }
</style>
<script type="text/javascript">
<!--
	function formatonlinpic()
	{
		var picobj = document.getElementsByName("onlinepic");
		var picnum = picobj.length;
		
		for(var i = 0; i < picnum; i++)
		{
			if(picobj[i].width > 200)
			{
				picobj[i].width = 200;
			}
			if(picobj[i].height > 150)
			{
				picobj[i].height = 150;
			}
		}
	}
	

	function change_pic_name(pic_name)
	{
		self.opener.changeImg(<?php echo "'".$_GET['input']."', '".$_GET['pic']."', pic_name, '".$uploaddirarray[$_GET['dir']]."'"; ?>);
		window.close();
	}
	
	function warn()
	{
		return confirm("请注意，一旦删除，将不可恢复");
	}
	
	function RevChk()
	{
		var arrInput = document.getElementsByTagName('input');
		var intInputNum = arrInput.length;
		for(intCount = 0; intCount < intInputNum; intCount++)
		{
			if(arrInput[intCount].type == "checkbox")
				arrInput[intCount].checked = !arrInput[intCount].checked;
		}
	}
//-->
</script>
</head>

<body onload="formatonlinpic()">
<form method="post" action="del_pic.php" onsubmit="return warn();">
<table summary="" id="pagehead" cellpadding="0" cellspacing="0" border="0" width="100%">
  <tr>
    <td><h1>选择图片(当前目录：<?php echo $d_p;?>)</h1></td>
  </tr>
</table>

<ul id="picUL">
<?php
	$d = dir($d_p);
	$img = array(); //保存文件名
	$img_time = array(); //保存文件创建时间
	while($f = $d->read())
	{
		$file = $d->path."/".$f;
		if(is_file($file))
		{
			$img[] = $f;
			$img_time[] = date("Y-m-d H:i:s", filectime($file));
		}
	}
	$d->close();
	
	if(is_array($img))
	{
		//排序
		array_multisort($img_time, SORT_DESC, $img);
		
		//输出
		$intImgNum = count($img);
		
		$page->Total = $intImgNum;
		$arrPost = explode(",", $page->OffSet());
		$intStart = intval($arrPost[0]);
		$intEnd = $intStart + intval($arrPost[1]);
		if($intImgNum < $intEnd)
		{
			$intEnd = $intImgNum;
		}
		
		for($intCount = $intStart; $intCount < $intEnd; $intCount++)
		{
?>
  <li>
      <table cellspacing="0" cellpadding="0" width="100%"  class="maintable">
        <tr>
          <th class="pic">
            <a href="#" onclick="return change_pic_name('<?php echo $img[$intCount];?>');"><?php echo $d_p."/".$img[$intCount];?></a>
          </th>
        </tr>
        <tr>
          <th>
            <?php echo $img_time[$intCount];?>
          </th>
        </tr>
        <tr>
          <th>
            <input type="checkbox" name="choice[]" id="choice<?php echo $intCount; ?>" value="<?php echo $img[$intCount]; ?>">
            <label for="choice<?php echo $intCount; ?>">删除图片</label>
          </th>
        </tr>
      </table>
  </li>
<?php
		}
	}
?>
<li style="width: 99.5%; margin-top: 10px;">
<table cellspacing="0" cellpadding="0" width="100%"  class="maintable" align="center">
	<tr>
  	<th>
    	<?php echo $page->ShowLink(); ?>
    </th>
  </tr>
  <tr>
  	<th>
    	<span class="buttons">      	
        <input type="hidden" name="path" value="<?php echo $d_p;?>">
        <input type="hidden" name="tablename" value="<?php echo $tablename; ?>" />
        <input type="hidden" name="inputname" value="<?php echo $inputname; ?>" />
        <input type="submit" value="删除所选" class="submit" />&nbsp;&nbsp;
        <input type="button" value="反选" onclick="RevChk()" />
      </span>
    </th>
  </tr>
</table>
</li>
</ul>
</form>
</body>
</html>