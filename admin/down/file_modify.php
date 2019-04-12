<?
$protectid="132";
include("../protect.php");
include("../../class/mysqldb.inc.php");
$db=new mysqldb();
$id=$_GET['id'];
$downloadsql="select * from hy_download where download_id='$id'";
$db->query($downloadsql);
$downloadnum=$db->get_num1();
$downloadresult=$db->get_data();
$downloadsortsql="select * from hy_downloadsort order by downloadsort_id desc";
$db->query($downloadsortsql);
$downloadsortnum=$db->get_num1();
$downloadsortresult=$db->get_data();
?>


<?php include_once("../common/files.php"); ?>
<html>
<head>
<title>广告添加</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script language="javascript">
function check()
{
  if (document.ad.downloadsort.value=="")
        {
        alert("必须选择下载类别")
        document.ad.downloadsort.focus()
        return false;
         }
  if (document.ad.pic_url.value=="")
        {
        alert("下载文件必须存在")
        document.ad.pic_url.focus()
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
  <form name="ad" enctype="multipart/form-data" method="post" action="downloadfile_edit.php" onSubmit="return check();">
    <tr>
      <td height="31" colspan="2" > <table width="100%" border="0" cellpadding="0" cellspacing="0">
                      <tr class="bgtitle">
                        <td height="30"><table width="100%" height="24" border="0" align="left" cellpadding="0" cellspacing="0">
                            <tr>
                              <td width="175"><div align="center"><strong><img src="../images/ad.jpg"> 下 载 文 件 修 改</strong></div></td>
                              <td align="right">说明:带<font color="#FF0000">*</font>为必填项</td>
                            </tr>
                        </table></td>
                      </tr>
                    </table></td>
    </tr>
    <tr>
      <td height="30">下载名称：</td>
      <td><input type="text" name="download_name" size="50" value="<? echo $downloadresult[0]['download_name'];?>"></td>
    </tr>
    <tr>
      <td width="284" height="30">下载类别选择：<font color="#FF0000">*</font></td>
      <td width="719"><select name="downloadsort">
	   <option value="-1">--请选择下载类别--</option>
	  <? for ($z=0;$z<$downloadsortnum;$z++){?>
        <option value=<? echo $downloadsortresult[$z]['downloadsort_id'];?> <? if ($downloadresult[0]['download_sort']==$downloadsortresult[$z]['downloadsort_id']){?>selected <? }?> ><? echo $downloadsortresult[$z]['downloadsort_name'];?></option>
           <? }?>
      </select>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    </tr>
    <tr style="display:none;">
      <td height="30">是否为会员下载文件:</td>
      <td height="30"><input type="radio" name="file_member" value="1" <? if ($downloadresult[0]['download_member']==1){?>checked<? }?>>
是
  <input name="file_member" type="radio" value="0"  <? if ($downloadresult[0]['download_member']==0){?>checked<? }?>>
不是</td>
    </tr>
    <tr>
      <td height="30">文件内容(允许上传小于2M的RAR,ZIP,JPG,GIF格式)<font color="#FF0000">*</font>
      </td>
      <td height="30"> <input name="pic_url" type="text"  size="30" value="<? echo $downloadresult[0]['download_url'];?>">
       
		
		<input type="button" value="上传"  onclick="PopupWindow('../upload.php?dir=6&input=pic_url', 380, 140);" class="submit">
		
		<input type="button" value="选择" onclick="PopupWindow('../pic_list.php?dir=6&input=pic_url', 712, 600);">
        文件大小（kb）：
        <input type="text" name="downloadfile_size" value="<? echo $downloadresult[0]['download_filesize'];?>"></td>
    </tr>
    <tr>
      <td height="30" >下载内容简介：</td>
      <td height="30" ><textarea name="download_content" cols="50" rows="6"><? echo $downloadresult[0]['download_content'];?></textarea>
      <input type="hidden" name="downloadid" value="<? echo $downloadresult[0]['download_id'];?>"></td>
    </tr>
    <tr>
      <td height="32" colspan="2" align="center" class="bgtitle"> <input type="submit" name="Submit" value="修   改" >
        &nbsp;&nbsp;&nbsp;&nbsp; <input type="reset" name="Submit2" value="重　写">
      </td>
    </tr>
 </form>
  </table>
</body>
</html>
