<? 
$protectid="133";
include ("../protect.php");
include "../../class/page.php";
require("../../class/mysqldb.inc.php");
$db=new mysqldb();
$page = new ShowPage;
$page->PageSize = 20;
$totalnumsql = "select * from hy_downloadsort order by downloadsort_id desc";
$db->query($totalnumsql);
$recordcount = $db->get_num1();
$page->Total = $recordcount;
$sql = "select * from hy_downloadsort order by downloadsort_id  desc limit ".$page->OffSet();
$db->query($sql);
$news_result=$db->get_data();
$news_num=$db->get_num1();
?>
<html>
<head>
<title>广告管理</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="../css/css.css" type="text/css">
<script language="javascript">
function warn1()
{
if(confirm("请注意，一旦删除，将不可恢复"))
   {
     document.fm2.submit()
    }
}

 function turn(page){
   window.location.href="index.php?pagenum="+page
 }

 function selectall(){
   for(i=0;i<document.fm2.elements.length-2;i++)
   {
      // alert(document.fm2.elements.length)
       document.fm2.elements[i].click()

	}
	    document.fm2.Button.value=((document.fm2.Button.value=="全部选中")?"取消全选":"全部选中")
 }
</script>
<style type="text/css">
<!--
.style1 {
	color: #666666;
	font-weight: bold;
}
-->
</style>
</head>
<body text="#000000" topmargin="0"  leftmargin="0">
  <br>
  <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="word">
    <tr valign="top">
      <td colspan="3" height="2">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="97%" height="41" valign="top">
              <table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolorlight="#999999" bordercolordark="#FFFFFF" bgcolor="#FFFFFF" class="word">
				 <tr>
                  <td height="30" colspan="4" valign="top"> <div align="center">
                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                      <tr class="bgtitle">
                        <td><table width="600" height="30" border="0" align="left" cellpadding="0" cellspacing="0">
                          <tr>
                            <td width="65" height="30"><div align="right"><strong><img src="../images/ad.jpg"> </strong></div></td>
                            <td width="120"><strong> &nbsp;下 载 类 别 管 理</strong></td>
                            <td width="415">&nbsp;</td>
                          </tr>
                        </table></td>
                      </tr>
                    </table>
                    </div></td>
                </tr>
				 <form name="fm2"  method="post" action="delsort.php" >
				<tr >
				  <td height="30" align="center" background="../images/title3.gif"><span class="style1">&nbsp;类别名称</span></td>
                  <td width="20%" align="center" background="../images/title3.gif"><span class="style1">建立时间</span></td>
                  <td width="8%" align="center" background="../images/title3.gif"><span class="style1">修改</span></td>
                  <td width="6%" align="center" background="../images/title3.gif"><span class="style1">删除</span></td>
                </tr>
                <?
				$j=0;
                for ($i=0;$i<$news_num;$i++){ 
			  //色彩渐变
			  if($j==0)
			  {
			    echo "<tr>";
				$j=1;
			   }else
			   {
			     $j=0;
			  ?>
                <tr bgcolor="#f5f5f5">
				      <?
			   }
			   ?>
                      <td height="30" align="center" ><? echo $news_result[$i]['downloadsort_name']?>&nbsp;</td>                 
                  <td width="20%" align="center"><? echo $news_result[$i]['downloadsort_date']?>&nbsp;</td>
                  <td width="8%" align="center"><a href="downloadsort_modify.php?id=<? echo $news_result[$i]['downloadsort_id']?>">{编辑}</a></td>
                  <td width="6%" align="center">
                    <input type="checkbox" name="choice[]" value="<? echo $news_result[$i]['downloadsort_id'];?>">
                  </td>
                </tr>
				<?
					}
			   ?>
                <tr>
                  <td height="30" colspan="4"  background="../images/title3.gif"> <div align="center">
                       <input type="button" name="Buttonfff" value="删除所选" onClick="warn1()"> &nbsp;&nbsp;
                      <input type="button" name="Button" value="全部选中" onClick="selectall()">
                  </div></td>
                </tr></form>
              </table>
            </td>
          </tr>

        </table>
      </td>
    </tr>
</table>
  <table width="479" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr>
      <td width="479"><? $showpage = $page->ShowLink(); echo $showpage;?></td>
    </tr>
  </table>
</body>
</html>
