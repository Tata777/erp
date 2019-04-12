<?php
$protectid="7"; 
include("../protect.php");
/*include_once("../../config.inc.php");
include_once(CFG_LIB_DIR.'mysqldb.inc.php');
$objDb = new mysqldb();
*/
$Lang=$_GET['Lang']?$_GET['Lang']:"cn";
include("../common/categoryact.php");
$objSortList = new clsCategoryAct('linkcategory', 'link', 'CateID', 'LinkCategoryID', 'linkcateform.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>信息类别</title>
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<link href="../css/edit.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../js/commentJS.js"></script>
<script type="text/javascript">
function war(cid,pid)
{	
  if(confirm("确认删除吗"))
    {
	  window.location.href="linkcateform.php?act=del&LinkCategoryID="+cid+"&ParentID="+pid;
	 }
}
</script>
</head>
<body id="main">
<table summary="" id="pagehead" cellpadding="0" cellspacing="0" border="0" width="100%">
  <tr>
    <td><h1>资讯分类</h1></td>
    <td class="actions"><table summary="" cellpadding="0" cellspacing="0" border="0" align="right">
        <tr>
          <td class="active"><a href="linkcatelist.php" class="view">浏览分类</a></td>
          <td><a href="linkcateform.php?ParentID=1" class="add">添加分类</a></td>
        </tr>
      </table></td>
  </tr>
</table>
<table summary="" cellpadding="0" cellspacing="0" border="0" width="100%">
	<tr>
		<td class="actions">
			<table cellpadding="0" cellspacing="0" border="0" align="right">
				<tr>
        
					<td <?php if($Lang == "cn"){?> class="active"<?php }?>><a href="linkcatelist.php?Lang=cn">简体中文</a></td>
					<td<?php if($Lang == "en"){?> class="active"<?php }?>><a href="linkcatelist.php?Lang=en">英文</a></td>	
				</tr>
</table>
		</td>
	</tr>
</table>
<form method="post" name="CateForm" id="CateForm" action="linkcateform.php?act=changeorder" enctype="multipart/form-data">
  <table cellspacing="0" cellpadding="0" width="100%"  class="listtable">
    <tr>
      <th>分类名称</th>
      <th width="10%">显示顺序</th>
      <th width="40%">操作</th>
    </tr>
		<?php
		$objSortList->travelTree(1,'linkcateform.php',$Lang);
		?>
  </table>
  <div class="buttons">
    <input type="submit" name="listsubmit" value="更改排序" class="submit">
    <input type="reset" name="listreset" value="重置">
  </div>
</form>
<br>
<?php include "../bottom.php"; ?>
</div>
</body>
</html>