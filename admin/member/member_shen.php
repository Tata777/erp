<?
$protectid="201";
include ("../protect.php");
include "../../class/page.php";
require("../../class/mysqldb.inc.php");
$db=new mysqldb();
$page = new ShowPage;
$page->PageSize = 20;
$totalnumsql = "select * from hy_member where user_shen=0 order by user_id";
$db->query($totalnumsql);
$recordcount = $db->get_num1();
$page->Total = $recordcount;
$sql = "select * from hy_member where user_shen=0 order by user_id desc limit ".$page->OffSet();
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
var imgPlus                = new Image();
var imgMinus        = new Image();
imgPlus.src                = '../images/xiang.gif';
imgMinus.src        = '../images/xiang1.gif';

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
.style2 {color: #000000}
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
                        <td height="30" background="../images/center1t.jpg"><table width="332" height="18" border="0" align="left" cellpadding="0" cellspacing="0">
                          <tr>
                            <td width="151"><div align="center"><strong> <img src="../images/pro.jpg" width="24" height="24">会 员 审 核</strong></div></td>
                            <td width="181">&nbsp;</td>
                          </tr>
                        </table></td>
                      </tr>
                    </table>
                    </div></td>
                </tr>
                                 <form name="fm2"  method="post" action="del_member.php" >
                                <tr >
                  <td width="5%" height="30" background="../images/title3.gif" align="center"><span class="style1">详细</span></td>
                  <td width="12%" background="../images/title3.gif" align="center"><span class="style1">用户名</span></td>
                  <td width="10%" align="center" background="../images/title3.gif"><span class="style1">姓 名</span></td>
                  <td width="6%" align="center" background="../images/title3.gif"><span class="style1">性别</span></td>
                  <td width="13%" align="center" background="../images/title3.gif"><span class="style1">所在城市</span></td>
                  <td width="13%" align="center" background="../images/title3.gif"><span class="style1">电话</span></td>
                  <td width="16%" align="center" background="../images/title3.gif"><span class="style1">注册时间</span></td>
                  <td width="6%" align="center" background="../images/title3.gif"><span class="style1">审核</span></td>
                  <td width="6%" align="center" background="../images/title3.gif"><span class="style1">删除</span></td>
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
                  <td width="10%" align="center"><? echo $news_result[$i]['user_truename'];?>&nbsp;</td>
                  <td width="6%" align="center"> <? echo $news_result[$i]['user_sex'];?>&nbsp;
                  </td>
                  <td width="13%" align="center"><? echo $news_result[$i]['user_city']; ?>&nbsp;</td>
                  <td width="13%" align="center"><? echo $news_result[$i]['user_tel'];?>&nbsp;</td>
                  <td width="16%" align="center"> <? echo $news_result[$i]['user_regtime'];?>&nbsp;</td>
                  <td width="6%" align="center"><a href="shen_ok.php?id=<? echo $news_result[$i]['user_id'];?>"><span class="style2">{审核}</span></a></td>
                  <td width="6%" align="center">
                    <input type="checkbox" name="choice[]" value="<? echo $news_result[$i]['user_id'];?>">
                  </td>
                </tr>
                <tr id='<? echo 'subDiv_'.$news_result[$i]['user_id'];?>' style="display:none">
                  <td height="30" colspan="9"  bgcolor="#F5F5F5">
                                  <table width="100%"  border="1" cellpadding="0" cellspacing="0" bordercolor="#999999" bordercolorlight="#999999" bordercolordark="#FFFFFF" bgcolor="#FFF7EE">
                    <tr>
                      <td height="28" align="center">所在省份：</td>
                      <td><? echo $news_result[$i]['user_province']; ?>&nbsp;</td>
                    </tr>
                    <tr>
                      <td width="14%" height="28" align="center">地址：</td>
                      <td width="86%"><? echo $news_result[$i]['user_add'];?>&nbsp;</td>
                    </tr>

                    <tr>
                      <td height="28" align="center">信箱：</td>
                      <td><? echo $news_result[$i]['user_email'];?>&nbsp;</td>
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

  <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr>
      <td  align="center"><? $showpage = $page->ShowLink(); echo $showpage; echo "共有".$recordcount."待审会员";?></td>
    </tr>
</table>
</body>
</html>