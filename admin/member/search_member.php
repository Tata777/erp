<?
$protectid="201"; 
include ("../protect.php");
include "../../class/page.php";
require("../../class/mysqldb.inc.php");
$db=new mysqldb();
$page = new ShowPage;
$page->PageSize = 20;
if (isset($_POST['keywords'])){
$keywords=trim($_POST['keywords']);
}else{
$keywords=trim($_GET['keywords']);
}
$totalnumsql = "select * from hy_member where user_name like '%$keywords%' order by user_id";
$db->query($totalnumsql);
$recordcount = $db->get_num1();
$page->Total = $recordcount;
$page->LinkAry = array("keywords"=>$keywords);
$sql = "select * from hy_member where user_name like '%$keywords%' order by user_id desc limit ".$page->OffSet();
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

function Detail(imgObj,divObj)
			{
				if(divObj.style.display == 'block')
				{
					divObj.style.display = 'none';
					imgObj.src = imgPlus.src;
				}
				else
				{
					divObj.style.display = 'block';
					imgObj.src = imgMinus.src;
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
                  <td height="30" colspan="8" valign="top"> <div align="center">
                    <table width="100%" border="0" cellpadding="0" cellspacing="0" class="bgtitle">
                      <tr>
                        <td height="30" background="../images/center1t.jpg"><table width="33%" height="24"  border="0" align="right" cellpadding="0" cellspacing="0">
                          <form name="form1" method="post" action="search_member.php">
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
				 <form name="fm2"  method="post" action="del_member.php" >
				<tr >
                  <td width="7%" height="30" background="../images/title3.gif" align="center"><span class="style1">详细</span></td>
                  <td width="15%" background="../images/title3.gif" align="center"><span class="style1">用户名</span></td>
                  <td width="18%" align="center" background="../images/title3.gif"><span class="style1">姓 名</span></td>
                  <td width="11%" align="center" background="../images/title3.gif"><span class="style1">性别</span></td>
                  <td width="16%" align="center" background="../images/title3.gif"><span class="style1">所在城市</span></td>
                  <td width="21%" align="center" background="../images/title3.gif"><span class="style1">电话</span></td>
      
                  <td width="12%" align="center" background="../images/title3.gif"><span class="style1">删除</span></td>
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
                  <td height="28" align="center"><img src="../images/xiang.gif" width="9" height="9" onClick='Detail(this, <? echo 'subDiv_'.$news_result[$i]['user_id']?>);' style='cursor:hand'></td>
                  <td height="28" align="center"><? echo $news_result[$i]['user_name'];?>&nbsp;</td>
                  <td width="18%" align="center"><? echo $news_result[$i]['user_truename'];?>&nbsp;</td>
                  <td width="11%" align="center"> <? echo $news_result[$i]['user_sex'];?>&nbsp;                  </td>
                  <td width="16%" align="center"> <? echo $news_result[$i]['user_city']; ?></td>
                  <td width="21%" align="center"><? echo $news_result[$i]['user_tel'];?>&nbsp;</td>
                 
                  <td width="12%" align="center">
                    <input type="checkbox" name="choice[]" value="<? echo $news_result[$i]['user_id'];?>">
                  </td>
                </tr>
                <tr id='<? echo 'subDiv_'.$news_result[$i]['user_id'];?>' style="display:none">
                  <td height="30" colspan="8"  bgcolor="#F5F5F5">
				  <table width="100%"  border="1" cellpadding="0" cellspacing="0" bordercolor="#999999" bordercolorlight="#999999" bordercolordark="#FFFFFF" bgcolor="#FFF7EE">
                    <tr>
                      <td height="28" align="center">所在省份:</td>
                      <td><? echo $news_result[$i]['user_province']; ?>&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="28" align="center">注册时间:</td>
                      <td><? echo $news_result[$i]['user_regtime'];?>&nbsp;</td>
                    </tr>
                    <tr>
                      <td width="14%" height="28" align="center">地址：</td>
                      <td width="86%"><? echo $news_result[$i]['user_add'];?></td>
                    </tr>
					
                    <tr>
                      <td height="28" align="center">信箱：</td>
                      <td><? echo $news_result[$i]['user_email'];?></td>
                    </tr>
                    <tr>
                      <td height="29" align="center">邮政编码：</td>
                      <td><? echo $news_result[$i]['user_zipcode'];?>&nbsp;</td>
                    </tr>
                  </table>
				  </td>
                </tr>
				  <?
			           }
					}
			   ?>
                <tr class="bgtitle">
                  <td height="30" colspan="8"  background="../images/title3.gif" > <div align="center">
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

  <table width="500" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr>
      <td><? $showpage = $page->ShowLink(); echo $showpage; echo "共有".$recordcount."个会员";?></td>
    </tr>
</table>
</body>
</html>