<?
include ("../protect.php");
include "../../class/page.php";
require("../../class/mysqldb.inc.php");
$db=new mysqldb();
$page = new ShowPage;
$page->PageSize = 20;
$totalnumsql = "select * from hy_member_stock order by id";
$db->query($totalnumsql);
$recordcount = $db->get_num1();
$page->Total = $recordcount;
$sql = "select * from hy_member_stock order by id desc limit ".$page->OffSet();
$db->query($sql);
$news_result=$db->get_data();
$news_num=$db->get_num1();
?>
<html>
<head>
<title>产品管理</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="../css/css.css" type="text/css">
<script language="javascript">
var imgPlus		= new Image();
var imgMinus	= new Image();
imgPlus.src		= '../images/xiang.gif';
imgMinus.src	= '../images/xiang1.gif';
			
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
 
function war(str)
{
  if(confirm("确认删除吗"))
    {
	  window.navigate("del_pro.php?id="+str)
	 }
}

			
</script>
<style type="text/css">
<!--
.style1 {
	color: #666666;
	font-weight: bold;
}
body {
	background-color: #F7F7F7;
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
-->
</style>
</head>
<body text="#000000">
<br>
  <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="word">
 
    <tr valign="top">
      <td colspan="3" height="2">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="100%" height="41" valign="top">
              <table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolorlight="#999999" bordercolordark="#FFFFFF" bgcolor="#FFFFFF" class="word">
				 <tr>
                  <td height="30" colspan="9" valign="top"> <div align="center">
                    <table width="100%" border="0" cellpadding="0" cellspacing="0" class="bgtitle">
                      <tr>
                        <td height="30" background="../images/center1t.jpg"><table width="33%" height="24"  border="0" align="right" cellpadding="0" cellspacing="0">
                          <form name="form1" method="post" action="stock_search.php">
                            <tr>
                              <td width="53%" height="24" nowrap><span class="style1">会员名称:</span>&nbsp;&nbsp;
                                  <input name="keywords" type="text"  size="20"></td>
                              <td width="13%"><input type="submit" name="Submit2" value="搜索"></td>
                            </tr>
                          </form>
                        </table>
                        <table width="332" height="18" border="0" align="left" cellpadding="0" cellspacing="0">
                          <tr>
                            <td width="151"><div align="center"><strong> <img src="../images/pro.jpg" width="24" height="24">会 员 管 理</strong></div></td>
                            <td width="181">&nbsp;</td>
                          </tr>
                        </table></td>
                      </tr>
                    </table>
                    </div></td>
                </tr>
				 <form name="fm2"  method="post" action="del_stock.php" >
				<tr >
                  <td width="7%" height="30" background="../images/title3.gif" align="center">&nbsp;</td>
                  <td width="15%" background="../images/title3.gif" align="center"><span class="style1">用户名</span></td>
                  <td width="16%" align="center" background="../images/title3.gif"><span class="style1">UTOP品名</span></td>
                  <td width="11%" align="center" background="../images/title3.gif"><span class="style1">客户料号</span></td>
                  <td width="20%" align="center" background="../images/title3.gif"><span class="style1">单位</span></td>
                  <td width="18%" align="center" background="../images/title3.gif"><span class="style1">库存量</span></td>
                  <td width="18%" align="center" background="../images/title3.gif"><span class="style1">时间</span></td>
				  <td width="18%" align="center" background="../images/title3.gif"><span class="style1">备注</span></td>
                  <td width="13%" align="center" background="../images/title3.gif"><span class="style1">删除</span></td>
                </tr>
                <?
				$j=0;
				 if ($news_num>0){
				  for ($i=0;$i<$news_num;$i++){
              ?>
                <?
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
                  <td height="28" align="center">&nbsp;</td>
                  <td height="28" align="center"><?=$news_result[$i]['customer'];?>&nbsp;</td>
                  <td width="16%" align="center"><?=$news_result[$i]['pro_name'];?>&nbsp;</td>
                  <td width="11%" align="center"> <?=$news_result[$i]['code'];?>&nbsp;                  </td>
                  <td width="20%" align="center"> <?=$news_result[$i]['unit']; ?></td>
				  <td width="20%" align="center"> <?=$news_result[$i]['number']; ?></td>
				  <td width="20%" align="center"> <?=$news_result[$i]['time']; ?></td>
				  <td width="20%" align="center"> <?=$news_result[$i]['remark']; ?></td>
                  <td width="13%" align="center">
                    <input type="checkbox" name="choice[]" value="<?= $news_result[$i]['id'];?>">
				  </td>
                </tr>
				  <?
			           }
					}
			   ?>
                <tr class="bgtitle">
                  <td height="30" colspan="9"  background="../images/title3.gif" > <div align="center">
                       <input type="button" name="Buttonfff" value="删除所选" onClick="warn1()"> &nbsp;&nbsp;
                      <input type="button" name="Button" value="全部选中" onClick="selectall()">
                  </div></td>
                </tr>
			    </form>
              </table>
            </td>
          </tr>
		
        </table>
      </td>
    </tr>
	
  </table>

  <table width="762" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr>
      <td align="center"><? $showpage = $page->ShowLink(); echo $showpage; echo "共有".$recordcount."条库存记录";?></td>
    </tr>
</table>
</body>
</html>