<?
$protectid="201"; 
include ("../protect.php");
include "../../class/page.php";
require("../../class/mysqldb.inc.php");
$db=new mysqldb();
$page = new ShowPage;
$page->PageSize = 20;

extract($_GET);
if($action == 'auto'){
	$sql = "update  hy_member  set auto = $autype where user_id = $uid ";
    $msg = $db->query($sql);
	if($msg) echo "<script>alert('操作成功');</script>";
		else echo "<script>alert('操作失败！');</script>";
}
$sqlwhere=" where 1 ";
if($keywords!=""){$sqlwhere .="  and   user_truename like '%$keywords%'    ";}
if($tel!=""){$sqlwhere .="  and   user_tel like '%$tel%'    ";}
if($mobile!=""){$sqlwhere .="  and   user_mobile like '%$mobile%'    ";}
if($jj!=""){$sqlwhere .="  and   user_intro like '%$jj%'    ";}
 

//$totalnumsql = "select * from hy_member where user_shen=1 or user_shen=2 order by user_id";
$totalnumsql = "select * from hy_member ".$sqlwhere." order by user_id";
$db->query($totalnumsql);
$recordcount = $db->get_num1();
$page->Total = $recordcount;
//$sql = "select * from hy_member where user_shen=1 or user_shen=2 order by user_id desc limit ".$page->OffSet();
$sql = "select * from hy_member ".$sqlwhere." order by user_id desc limit ".$page->OffSet();
$db->query($sql);
$news_result=$db->get_data();
$news_num=$db->get_num1();
?>
<html>
<head>
<title>客户管理</title>
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
      <td colspan="2" height="2">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="100%" height="41" valign="top">
              <table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolorlight="#999999" bordercolordark="#FFFFFF" bgcolor="#FFFFFF" class="word">
				 <tr>
                  <td height="30" colspan="9" valign="top"> <div align="center">
                    <table width="100%" border="0" cellpadding="0" cellspacing="0" class="bgtitle">
                      <tr>
                        <td height="30" colspan="2" background="../images/center1t.jpg"><table width="33%" height="24"  border="0" align="right" cellpadding="0" cellspacing="0">
                          <form name="form1" method="get" action="">
                            <tr>
                              <td width="53%" height="24" nowrap><span class="style1">姓名:</span>&nbsp;&nbsp;
                                  <input name="keywords" type="text"  size="20"  value="<? echo @$_GET['keywords'];?>">
								  <span class="style1">手机:</span>&nbsp;&nbsp;
                                  <input name="mobile" type="text"  size="20"  value="<? echo @$_GET['mobile'];?>">
								  <span class="style1">电话:</span>&nbsp;&nbsp;
                                  <input name="tel" type="text"  size="20" value="<? echo @$_GET['tel'];?>">
								    <span class="style1">简介:</span>&nbsp;&nbsp;
                                  <input name="jj" type="text"  size="20" value="<? echo @$_GET['jj'];?>">
                                  
                                  
                                  </td>
                              <td width="13%"><input type="submit" name="Submit2" value="搜索"></td>
                            </tr>
                          </form>
                        </table>
                        <table width="332" height="18" border="0" align="left" cellpadding="0" cellspacing="0">
                          <tr>
                            <td width="151"><div align="center"><strong> <img src="../images/pro.jpg" width="24" height="24">客户管理</strong></div></td>
                            <td width="181">&nbsp;</td>
                          </tr>
                        </table></td>
                      </tr>
                    </table>
                    </div></td>
                </tr>
				 <form name="fm2"  method="post" action="del_member.php" >
				<tr >
                 <td  height="30" background="../images/title3.gif" align="center"><span class="style1">  编号</span></td>
                  <td   background="../images/title3.gif" align="center"><span class="style1">姓名</span></td>
 
                  <td   background="../images/title3.gif" align="center"><span class="style1">性别</span></td>
                  <td  align="center" background="../images/title3.gif"><span class="style1">电话</span></td>
				     <td  align="center" background="../images/title3.gif"><span class="style1">手机</span></td>
					      <td  align="center" background="../images/title3.gif"><span class="style1">工作单位</span></td>
						   <td  align="center" background="../images/title3.gif"><span class="style1"> 客户简介</span></td>
                 <td width="12%" align="center" background="../images/title3.gif"><span class="style1">登记时间</span></td>
                   <td   align="center" background="../images/title3.gif"><span class="style1">删除</span></td>
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
                  <td height="28" align="center"> <? echo $news_result[$i]['user_id']?> </td>
                  <td height="28" align="center"><? echo $news_result[$i]['user_truename'];?>&nbsp;</td>
                
                   <td width="11%" align="center"> <? echo ($news_result[$i]['user_sex']=="1"?"男":"女");?>&nbsp;                  </td>
                  
                    
				 
               <td width="12%" align="center">&nbsp;<? echo $news_result[$i]['user_tel'];?></td>
			  <td width="12%" align="center">&nbsp;<? echo $news_result[$i]['user_mobile'];?></td>
			  		  <td width="12%" align="center">&nbsp;<? echo $news_result[$i]['user_company'];?></td>
           
			   <td width="12%" align="center">&nbsp;<? echo $news_result[$i]['user_intro'];?>&nbsp;</td>
             <td width="12%" align="center">&nbsp;<? echo $news_result[$i]['user_regtime'];?>&nbsp;</td>
                  <td width="3%" align="center"><input type="checkbox" name="choice[]" value="<? echo $news_result[$i]['user_id'];?>"></td>
                </tr>
<!--
                <tr id='<? echo 'subDiv_'.$news_result[$i]['user_id'];?>' style="display: none; text-align: center;">
                
				<td height="30"   bgcolor="#F5F5F5">
				  <table width="100%" style="min-width:800px"   border="1" cellpadding="0" cellspacing="0" bordercolor="#999999" bordercolorlight="#999999" bordercolordark="#FFFFFF" bgcolor="#FFF7EE">
				  
				  
				  
						 
						  <tr>
							<td align="center"></td>
							<td align="left"><? echo $news_result[$i]['user_intro'];?></td>
						  </tr>
						  
						 
          
        
                    
        
                  </table>
				  </td>
                </tr>
				-->
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
      <td align="center"><? $showpage = $page->ShowLink(); echo $showpage; echo "共有".$recordcount."个客户";?></td>
    </tr>
</table>
</body>
</html>