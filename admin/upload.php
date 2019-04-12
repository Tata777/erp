<?php
	require_once("./user_chksession.php");
	$dir = $_GET['dir'];
	$input = $_GET['input'];
	$pic = $_GET['pic'];
	$other = $_GET['other'];
	$form = $_GET['form'];
	$downsize = $_GET['downsize'];
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
</style>
</head>

<body>
<table summary="" id="pagehead" cellpadding="0" cellspacing="0" border="0" width="100%">
  <tr>
    <td><h1>上传文件</h1></td>
  </tr>
</table>

<form method="post" action="uploaddata.php" enctype="multipart/form-data">
<table cellspacing="0" cellpadding="0" width="100%"  class="maintable">
  <tr id="tr_subject">
    <th>
    	<input name="imagefile" type="file" size="25" />
      <span class="buttons">
      &nbsp;<input type="submit" value="上传" class="submit" />
      &nbsp;<input type="button" value="取消" onclick="window.close();">
      </span>
      <input type="hidden" name="dir" value="<?php echo $dir;?>">
      <input type="hidden" name="input" value="<?php echo $input;?>">
      <input type="hidden" name="pic" value="<?php echo $pic;?>">
      <input type="hidden" name="other" value="<?php echo $other;?>">
      <input type="hidden" name="form" value="<?php echo $form;?>">
      <input type="hidden" name="downsize" value="<?php echo $downsize;?>">
     

    </th>
  </tr>
 </table>
</form>
</body>
</html>