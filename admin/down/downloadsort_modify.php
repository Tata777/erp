<?
$protectid="133";
include("../protect.php");
include("../../class/mysqldb.inc.php");
$db=new mysqldb();
$download_id=$_GET['id'];
$sortsql="select * from hy_downloadsort where downloadsort_id='$download_id'";
$db->query($sortsql);
$sortresult=$db->get_data();
?>
<html>
<head>
<title>广告添加</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script language="javascript">
function check()
{
 if (document.downloadsort_name.value=="")
        {
        alert("下载类别名称必须存在")
        document.downloadsort_name.focus()
        return false;
         }
   // document.ad.submit()
}
</script>
<link rel="stylesheet" href="../css/css.css" type="text/css">
<style type="text/css">
<!--
.style1 {color: #FF0000}
-->
</style>
</head>
<body text="#000000" topmargin="0">
<br>
<table width="100%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#999999" bordercolorlight="#999999" bordercolordark="#FFFFFF" class="word">
  <form name="ad" enctype="multipart/form-data" method="post" action="downloadsort_edit.php" onSubmit="return check();">
    <tr>
      <td height="31" colspan="2" > <table width="100%" border="0" cellpadding="0" cellspacing="0">
                      <tr class="bgtitle">
                        <td height="30"><table width="100%" height="24" border="0" align="left" cellpadding="0" cellspacing="0">
                            <tr>
                              <td width="175"><div align="center"><strong><img src="../images/ad.jpg"> 下 载 类 别 添 加</strong></div></td>
                              <td align="right">说明:带<font color="#FF0000">*</font>为必填项</td>
                            </tr>
                        </table></td>
                      </tr>
                    </table></td>
    </tr>
    <tr>
      <td width="243" height="30" align="center">类 别 名 称<font color="#FF0000"> *</font>
      </td>
      <td width="637" height="30"> <input name="downloadsort_name" type="text"  size="30" value="<? echo $sortresult[0]['downloadsort_name'];?>">
      <font color="#FF0000">*</font> <input type="hidden" name="sortid" value="<? echo $sortresult[0]['downloadsort_id'];?>"></td>
    </tr>
    <tr>
      <td height="32" colspan="2" align="center" class="bgtitle"> <input type="submit" name="Submit" value="修  改" >
        &nbsp;&nbsp;&nbsp;&nbsp; <input type="reset" name="Submit2" value="重　写">
      </td>
    </tr>
        </form>
  </table>
</body>
</html>
