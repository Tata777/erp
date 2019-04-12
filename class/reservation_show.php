<?php
session_cache_limiter(‘nocache’);
session_cache_limiter(‘private’);
session_cache_limiter(‘public’);
include "includeFiles.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $C['Title'];?></title>
<Link href="../uploadfile/ico/<?php echo $C['ICO'];?>" rel="Shortcut Icon">
<meta name="Keywords" content="<?php echo $C['Keywords'];?>">
<meta name="description" content="<?php echo $C['Description'];?>">
<Meta name="Copyright" Content="<?php echo $C['CopyRight'];?>">
<link href="style/style.css" rel="stylesheet" type="text/css" />
<script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
<script src="js/MSClass.js" language="javascript"></script>
<script type="text/javascript">
<!--
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>
<script language="javascript">
//var pic1=eval('document.'+_all+'pic1'+_style);
//getwindowsize();
</script>
<?php include_once('qq.php');?>
<SCRIPT LANGUAGE="JavaScript">
function moveit() //这个函数用于设置层在浏览器中的位置
{
top1=document.body.scrollTop;
top2=document.documentElement.scrollTop;
if(top1>=top2){mytop=top1}else{mytop=top2;}
//alert(top2);
thisTop=document.getElementById('yyy').style.pixelTop;
scrollY=Math.floor((mytop-thisTop)/10 + 28);
//alert(thisTop);
if(scrollY){
	nowTop=thisTop+scrollY;
	document.getElementById('yyy').style.top=nowTop+"px";
}
}
moveit(); //网面打开时时执行moveit()
//window.onresize=moveit; //当调整浏览器大小时执行moveit()
window.setInterval('moveit()',1);
//window.onscroll=moveit; //当拉动滚动条时执行moveit()

             function hidden_div(){
				 document.getElementById("yyy").style.display="none";
}

</SCRIPT>
<script src="./admin/js/checkSubmit.js"></script>
<script language="javascript">
	 function checkContent(dom){
	if(!check_empty(dom.guest_name,"姓名不能为空！")) return false;	
	//if(!check_empty(dom.guest_name,"名字不能为空！")) return false;	
	if(!check_empty(dom.guest_email,"邮箱不能为空！")) return false;
	if(!check_isemail(dom.guest_email,"邮箱格式不正确！")) return false;
	if(!check_empty(dom.guest_contact,"电话不能为空！")) return false;
	if(!check_istel(dom.guest_contact,"请输入正确的联系电话，只可以由数字和“/”和“-”组成！")) return false;
	if(!check_empty(dom.guest_start,"入住时间不能为空！")) return false;
	if(!check_empty(dom.guest_end,"离开时间不能为空！")) return false;
	if(!check_empty(dom.guest_content,"备注内容不能为空！")) return false;	
	if(!check_empty(dom.yancode,"验证码不能为空！")) return false;
		return true;
	 }
	 
	
	 function mm(dom){
	 	document.getElementById("messageform").reset();
	 }
</script>
<script language=javascript>
var DS_x,DS_y;

function dateSelector() //构造dateSelector对象，用来实现一个日历形式的日期输入框。
{
var myDate=new Date();

this.year=myDate.getFullYear(); //定义year属性，年份，默认值为当前系统年份。
this.month=myDate.getMonth()+1; //定义month属性，月份，默认值为当前系统月份。
this.date=myDate.getDate(); //定义date属性，日，默认值为当前系统的日。
this.inputName=''; //定义inputName属性，即输入框的name，默认值为空。注意：在同一页中出现多个日期输入框，不能有重复的name！
this.display=display; //定义display方法，用来显示日期输入框。
}

function display() //定义dateSelector的display方法，它将实现一个日历形式的日期选择框。
{
var week=new Array('日','一','二','三','四','五','六');

document.write("<style type=text/css>");
document.write(" .ds_font td,span { font: normal 12px 宋体; color: #000000; }");
document.write(" .ds_border { border: 1px solid #000000; cursor: hand; background-color: #DDDDDD }");
document.write(" .ds_border2 { border: 1px solid #000000; cursor: hand; background-color: #DDDDDD }");
document.write("</style>");

var M=new String(this.month);
var d=new String(this.date);

if(M.length==1&&d.length==1){
document.write("<input style='text-align:center;' id='DS_"+this.inputName+"' name='"+this.inputName+"' value='"+this.year+"-0"+this.month+"-0"+this.date+"' title=双击可进行编缉 ondblclick='this.readOnly=false;this.focus()' onblur='this.readOnly=true' readonly>");}
else if(M.length==1&&d.length==2){
document.write("<input style='text-align:center;' id='DS_"+this.inputName+"' name='"+this.inputName+"' value='"+this.year+"-0"+this.month+"-"+this.date+"' title=双击可进行编缉 ondblclick='this.readOnly=false;this.focus()' onblur='this.readOnly=true' readonly>");}
else if(M.length==2&&d.length==1){
document.write("<input style='text-align:center;' id='DS_"+this.inputName+"' name='"+this.inputName+"' value='"+this.year+"-"+this.month+"-0"+this.date+"' title=双击可进行编缉 ondblclick='this.readOnly=false;this.focus()' onblur='this.readOnly=true' readonly>");}
else if(M.length==2&&d.length==2){
document.write("<input style='text-align:center;' id='DS_"+this.inputName+"' name='"+this.inputName+"' value='"+this.year+"-"+this.month+"-"+this.date+"' title=双击可进行编缉 ondblclick='this.readOnly=false;this.focus()' onblur='this.readOnly=true' readonly>");}

document.write("<button style='width:60px;height:18px;font-size:12px;margin:1px;border:1px solid #A4B3C8;background-color:#DFE7EF;' type=button onclick=this.nextSibling.style.display='block' onfocus=this.blur()>选择日期</button>");

document.write("<div style='position:absolute;display:none;text-align:center;width:0px;height:0px;overflow:visible' onselectstart='return false;'>");
document.write(" <div style='position:absolute;left:-60px;top:20px;width:142px;height:165px;background-color:#F6F6F6;border:1px solid #245B7D;' class=ds_font>");
document.write(" <table cellpadding=0 cellspacing=1 width=140 height=20 bgcolor=#CEDAE7 onmousedown='DS_x=event.x-parentNode.style.pixelLeft;DS_y=event.y-parentNode.style.pixelTop;setCapture();' onmouseup='releaseCapture();' onmousemove='dsMove(this.parentNode)' style='cursor:move;'>");
document.write(" <tr align=center>");
document.write(" <td width=12% onmouseover=this.className='ds_border' onmouseout=this.className='' onclick=subYear(this) title='减小年份'><<</td>");
document.write(" <td width=12% onmouseover=this.className='ds_border' onmouseout=this.className='' onclick=subMonth(this) title='减小月份'><</td>");
document.write(" <td width=52%><b>"+this.year+"</b><b>年</b><b>"+this.month+"</b><b>月</b></td>");
document.write(" <td width=12% onmouseover=this.className='ds_border' onmouseout=this.className='' onclick=addMonth(this) title='增加月份'>></td>");
document.write(" <td width=12% onmouseover=this.className='ds_border' onmouseout=this.className='' onclick=addYear(this) title='增加年份'>>></td>");
document.write(" </tr>");
document.write(" </table>");

document.write(" <table cellpadding=0 cellspacing=0 width=140 height=20 onmousedown='DS_x=event.x-parentNode.style.pixelLeft;DS_y=event.y-parentNode.style.pixelTop;setCapture();' onmouseup='releaseCapture();' onmousemove='dsMove(this.parentNode)' style='cursor:move;'>");
document.write(" <tr align=center>");
for(i=0;i<7;i++)
  document.write(" <td>"+week[i]+"</td>");
document.write(" </tr>");
document.write(" </table>");

document.write(" <table cellpadding=0 cellspacing=2 width=140 bgcolor=#EEEEEE>");
for(i=0;i<6;i++)
{
document.write(" <tr align=center>");
  for(j=0;j<7;j++)
document.write(" <td width=10% height=16 onmouseover=if(this.innerText!=''&&this.className!='ds_border2')this.className='ds_border' onmouseout=if(this.className!='ds_border2')this.className='' onclick=getValue(this,document.all('DS_"+this.inputName+"'))></td>");
document.write(" </tr>");
}
document.write(" </table>");

document.write(" <span style=cursor:hand onclick=this.parentNode.parentNode.style.display='none'>【关闭】</span>");
document.write(" </div>");
document.write("</div>");

dateShow(document.all("DS_"+this.inputName).nextSibling.nextSibling.childNodes[0].childNodes[2],this.year,this.month)
}

function subYear(obj) //减小年份
{
var myObj=obj.parentNode.parentNode.parentNode.cells[2].childNodes;
myObj[0].innerHTML=eval(myObj[0].innerHTML)-1;
dateShow(obj.parentNode.parentNode.parentNode.nextSibling.nextSibling,eval(myObj[0].innerHTML),eval(myObj[2].innerHTML))
}

function addYear(obj) //增加年份
{
var myObj=obj.parentNode.parentNode.parentNode.cells[2].childNodes;
myObj[0].innerHTML=eval(myObj[0].innerHTML)+1;
dateShow(obj.parentNode.parentNode.parentNode.nextSibling.nextSibling,eval(myObj[0].innerHTML),eval(myObj[2].innerHTML))
}

function subMonth(obj) //减小月份
{
var myObj=obj.parentNode.parentNode.parentNode.cells[2].childNodes;
var month=eval(myObj[2].innerHTML)-1;
if(month==0)
{
month=12;
subYear(obj);
}
myObj[2].innerHTML=month;
dateShow(obj.parentNode.parentNode.parentNode.nextSibling.nextSibling,eval(myObj[0].innerHTML),eval(myObj[2].innerHTML))
}

function addMonth(obj) //增加月份
{
var myObj=obj.parentNode.parentNode.parentNode.cells[2].childNodes;
var month=eval(myObj[2].innerHTML)+1;
if(month==13)
{
month=1;
addYear(obj);
}
myObj[2].innerHTML=month;
dateShow(obj.parentNode.parentNode.parentNode.nextSibling.nextSibling,eval(myObj[0].innerHTML),eval(myObj[2].innerHTML))
}

function dateShow(obj,year,month) //显示各月份的日
{
var myDate=new Date(year,month-1,1);
var today=new Date();
var day=myDate.getDay();
var selectDate=obj.parentNode.parentNode.previousSibling.previousSibling.value.split('-');
var length;
switch(month)
{
case 1:
case 3:
case 5:
case 7:
case 8:
case 10:
case 12:
length=31;
break;
case 4:
case 6:
case 9:
case 11:
length=30;
break;
case 2:
if((year%4==0)&&(year%100!=0)||(year%400==0))
length=29;
else
length=28;
}
for(i=0;i<obj.cells.length;i++)
{
obj.cells[i].innerHTML='';
obj.cells[i].style.color='';
obj.cells[i].className='';
}
for(i=0;i<length;i++)
{
obj.cells[i+day].innerHTML=(i+1);
if(year==today.getFullYear()&&(month-1)==today.getMonth()&&(i+1)==today.getDate())
obj.cells[i+day].style.color='red';
if(year==eval(selectDate[0])&&month==eval(selectDate[1])&&(i+1)==eval(selectDate[2]))
obj.cells[i+day].className='ds_border2';
}
}

function getValue(obj,inputObj) //把选择的日期传给输入框
{
var myObj=inputObj.nextSibling.nextSibling.childNodes[0].childNodes[0].cells[2].childNodes;
if(obj.innerHTML)
if(obj.innerHTML.length==1&&myObj[2].innerHTML.length==1)
inputObj.value=myObj[0].innerHTML+"-0"+myObj[2].innerHTML+"-0"+obj.innerHTML;
  else if(obj.innerHTML.length==1&&myObj[2].innerHTML.length==2)
inputObj.value=myObj[0].innerHTML+"-"+myObj[2].innerHTML+"-0"+obj.innerHTML;
  else if(obj.innerHTML.length==2&&myObj[2].innerHTML.length==1)
inputObj.value=myObj[0].innerHTML+"-0"+myObj[2].innerHTML+"-"+obj.innerHTML;
  else if(obj.innerHTML.length==2&&myObj[2].innerHTML.length==2)
inputObj.value=myObj[0].innerHTML+"-"+myObj[2].innerHTML+"-"+obj.innerHTML;
inputObj.nextSibling.nextSibling.style.display='none';
for(i=0;i<obj.parentNode.parentNode.parentNode.cells.length;i++)
obj.parentNode.parentNode.parentNode.cells[i].className='';
obj.className='ds_border2'
}

function dsMove(obj) //实现层的拖移
{
if(event.button==1)
{
var X=obj.clientLeft;
var Y=obj.clientTop;
obj.style.pixelLeft=X+(event.x-DS_x);
obj.style.pixelTop=Y+(event.y-DS_y);
}
}
</script>

</head>
<body onload="MM_preloadImages('images/nav11.jpg','images/nav22.jpg','images/nav33.jpg','images/nav44.jpg','images/nav55.jpg','images/nav66.jpg','images/nav77.jpg','images/nav88.jpg')">
<?php include_once('header.php');?>
<div id="banner">
  <DIV class=b245>
    
  </DIV>
</div>
<div id="center2">
  <div class="page_left">
    <div class="left_about">
      <div align="center"><img src="images/left_reservation.jpg" width="185" height="63" style="margin-bottom:10px;" /></div>
    </div>
    <div class="left_nav"><a href="reservation.php">客房预定</a></div>
    <div class="left_bottom">
      <div align="center"><a href="feedback.php"><img src="images/left_bottom.jpg" width="185" height="150" border="0" /></a></div>
    </div>
  </div>
  <div class="page_right_4 new_t">
    <div class="add">您的位置：首页 &gt; 客房预定</div>
    <div class="nr new_t">
      <div class="news_pic">
	  <?php	
	$vm=$info->getProOrderOne($prid,1);
	//$ssv=$vm['list'];
	if($vm){
	foreach($vm as $key=>$value){
	 ?>
        <div class="news_pic01"><a href="./uploadfile/product_b/<?=$value['Photos']?>" target="_blank"><img src="admin/pic.php?imagename=../uploadfile/product_b/<?=$value['Photos']?>&amp;imagewidth=130&amp;imageheight=100&amp;cuteit=1" alt="点击放大" width="130" height="100" border="0" /></a></div>
        <div class="news_pic02">
			 
          <div class="news_pic03"><?=$house=$value['ProductName']?><span class="red">【<?=$houseprice=$value['Price']?>元】</span> </div>
          <div class="news_pic040">当前剩下<span class="red">[<?=$value['Unit']?>间]</span><? if(empty($value['Unit'])) echo "该房已订满"; else echo "房间可预定";?>.<br />
            <span class="news_pic044">适应范围：<?=$value['Size']?></span><br />
            房型说明：<?=strip_tags($value[Note])?></div>
	
        </div>	
		<?
		}}
	?>
      </div>	
	  
	    <form id="messageform" name="messageform" method="post" action="reservation_show_ok.php" onsubmit="return checkContent(this);">
        <input name="action" type="hidden" value="guestmessage" />
		 <input name="prid" type="hidden" value="<?=$prid?>" /> <input name="houseprice" type="hidden" value="<?=$houseprice?>" />
      <table cellspacing="0" align="center" cellpadding="3" width="98%" style="margin-top:20px;">
        <tr>
          <td width="179" class="news"><div align="right"> 客户姓名：</div></td>
          <td width="527" align="left" class="news"><input name="guest_name" type="text" id="guest_name" style="width:400px; border:#deedcc 1px;" />
            *</td>
        </tr>
        <tr>
          <td class="news"><div align="right"> 客户性别：</div></td>
          <td align="left" class="news"><select name="guest_sex" id="guest_sex" style="width:130px;border:#deedcc 1px;">
            <option value="男">男</option>
            <option value="女">女</option>
            </select></td>
        </tr>
        <tr>
          <td class="news"><div align="right"> 电子邮箱：</div></td>
          <td align="left" class="news"><input name="guest_email" type="text" id="guest_email" style="width:400px;border:#deedcc 1px;" />
            *</td>
        </tr>
        <tr>
          <td class="news"><div align="right"> 手机号码：</div></td>
          <td align="left" class="news"><input name="guest_contact" type="text" id="guest_contact" style="width:400px;border:#deedcc 1px;" />
            *</td>
        </tr>
	
		
        <tr>
          <td class="news"><div align="right"> 入住时间：</div></td>
          <td align="left" class="news">
          <script language=javascript>
var myDate=new dateSelector();
myDate.year--;

myDate.inputName='guest_start'; //注意这里设置输入框的name，同一页中日期输入框，不能出现重复的name。
myDate.display();
</script>  *</td>
        </tr>
        <tr>
          <td class="news"><div align="right"> 离开时间：</div></td>
          <td align="left" class="news">
		  <script language=javascript>
myDate.year++;
myDate.inputName='guest_end'; //注意这里设置输入框的name，同一页中的日期输入框，不能出现重复的name。
myDate.display();
</script>
		  
            *</td>
        </tr>
        <tr>
          <td class="news"><div align="right"> 预定房型：</div></td>
          <td align="left" class="news"><select name="guest_fuwu" id="guest_fuwu" style="width:130px;border:#deedcc 1px;">
              <option value="<?=$house?>"><?=$house?></option>
         
            </select></td>
        </tr>
        <tr>
          <td class="news"><div align="right"> 预定数量：</div></td>
          <td align="left" class="news"><select name="guest_num" id="guest_num" style="width:130px;border:#deedcc 1px;">
		  <? for($i=1;$i<=10;$i++){?>
              <option value="<?=$i?>"><?=$i?></option>
            <? }?>
            </select></td>
        </tr>
        <tr>
          <td valign="top" class="news"><div align="right"> 备注内容：</div></td>
          <td align="left" class="news"><textarea name="guest_content" rows="5" cols="25" id="guest_content" style="width:400px; height:200px;border:#deedcc 1px;"></textarea>
            *<br /></td>
        </tr>
        <tr>
          <td class="news"><div align="right"> 验证码：</div></td>
          <td align="left" class="news"><input name="yancode" id="yancode" type="text" id="txtCoTel" style="width:100px;border:#deedcc 1px;" />&nbsp;<a href="#" onclick="this.firstChild.src='seccode.php?update=' + Math.random();return false;"><img align="absmiddle" src="seccode.php?update=<?php echo time(); ?>" border="0" /></a></td>
        </tr>
        <tr>
          <td class="news"><div align="right"></div></td>
          <td align="left" class="news"><input type="submit" name="button" id="button" value="提定预交" /></td>
        </tr>
      </table>
	  </form>
    </div>
    <div class="add2" style="clear:both;"></div>
  </div>
  <div style="clear:both;"></div>
</div>
<?php include_once('footer.php');?>




</html>
