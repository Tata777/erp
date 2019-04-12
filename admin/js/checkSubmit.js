 
//检查是否为空
//yield:校验字段的名称，例:bao.yong
//alertstring:提示内容
function check_empty(yield,alertstring){
  if(yield==null) return true;
  if((yield.value).trim()==""||yield.value==null)  {
    yield.focus();
    alert(alertstring);
    return false;
  }
  return true;
}
//校验函数
//yield:页面中的对象名
//alertstring:提示时要显示的字符串
//检查是否为数字 "必须是正整数
function check_isnum(yield,alertstring){
  if(yield==null){
        alert(alertstring);
		    yield.value='';
        yield.focus();
        return false;
      }
  var str=yield.value;
  if(str==null||str==""){
        alert(alertstring);
		yield.value='';
        yield.focus();
        return false;
      }
  else{
    var re =/\d/;
    var i=0;
    var len=str.length;
    for(i=0;i<len;i++){
      if(str.charAt(i).match(re)==null){
        alert(alertstring);
		yield.value='';
        yield.focus();
        return false;
      }
    }
  }
  return true;
}

function check_isnumprice(yield,alertstring){
 var pattern = /^(|(0|([1-9]\d*)|((0|([1-9]\d*))?\.\d{1,2})){1,1})$/;
 var strValue=yield.value;
if (strValue.length==0)
 return true;
 if(strValue.match(pattern)==null){
  alert("“"+alertstring+"”要求是输入非负数字，不要输入正负号，小数点后最多两位，请检查!");
  yield.focus();
  return false;
 }else{
 return true;
 }
}

//yield:页面中的对象名
//len:最大字符长度
//alertstring:提示时要显示的字符串
//检查是否输入的长度是否超过数据库中该字段的最大值
//+"长度应该小于"+len+"位！"
function check_maxlen(yield,len,alertstring){
  if(yield==null) return true;
  if (StrLenthByByte(yield.value)>len){
    yield.focus();
    alert(alertstring);
    return false;
  }
  return true;
}
//yield:页面中的对象名
//len:最大字符长度
//alertstring:提示时要显示的字符串
//检查是否输入的长度是否超过数据库中该字段的最小值
//+"长度应该大于"+len+"位！"
function check_minlen(yield,len,alertstring){
  if(yield==null){
		yield.focus();
		alert(alertstring);
	  }
  if (StrLenthByByte(yield.value)<len){
    yield.focus();
    alert(alertstring);
    return false;
  }
  return true;
}
//yield:页面中的对象名
//len:最大字符长度
//alertstring:提示时要显示的字符串
//检查是否输入的长度是否超过数据库中该字段的最小值和最大值
//+"长度应该为"+minlen+"~"+maxlen+"个字符！"
function check_zhonglen(yield,minlen,maxlen,alertstring){
  if(yield==null) return true;
  if (StrLenthByByte(yield.value)<minlen||StrLenthByByte(yield.value)>maxlen){
    yield.focus();
    alert(alertstring);
    return false;
  }
  return true;
}
//检查是否相等
//yield，yield1:校验字段的名称，例:f1.aaa
//alertstring:提示内容 +"不相同！"
function check_even(yield,str,alertstring){
  if(yield.value!=str.value){
    yield.focus();
    alert(alertstring);
    return false;
  }
  return true;
}
//检查是否为空
//yield:校验字段的名称，例:f1.aaa
//alertstring:提示内容
//arraylen：数组的非空字段个数
function check_empty_array(yield,alertstring,arraylen){
  var alen=arraylen;
  if(alen>yield.length) alen=yield.length;
  for(i=0;i<alen;i++){
    if(!check_empty(yield[i],alertstring)) return false;
  }
  return true;
}
//检查复选框是否为空
//yield:校验字段的名称，例:f1.aaa
//alertstring:提示内容
function check_checkbox(yield,alertstring){
  var count=0;
  for(i=0;i<yield.length;i++){
    if(yield[i].checked) return true;
    else count++;
  }
  if(count>=yield.length) {
    yield[0].focus();
    alert(alertstring);
    return false;
  }
}
function check_checkradio(yield,alertstring){
  var count=0; 
  for(i=0;i<yield.length;i++){
    if(yield[i].checked) return true;
    else count++;
  }
  if(count==yield.length) {
    yield[0].focus();
    alert(alertstring);
    return false;
  }
}
//检查日期字段
//yield:校验字段的名称，例:f1.aaa
//alertstring:提示内容
function check_newdate(yield,alertstring) {
  var strDate=yield.value;
  var flag=true;
  if (strDate==""||strDate==null) return true;
  var year=strDate.substr(0,4);
  var mon=strDate.substr(5,2);
  var date=strDate.substr(8,2);

  if (strDate.length!=10) flag=false;
  else if (year>"2099"||year<"1900") flag=false;
  else if(mon>"12"||mon<"01") flag=false;
  else if(date<"01"||date>"31"||
   (mon=="02"&&(date>"29"||(date>"28"&&(year % 4)>0)))||
   ((mon=="04"||mon=="06"||mon=="09"||mon=="11")&&date>"30")) flag=false;

  if(flag==false)  {
    yield.focus();
    alert(alertstring+"必须为日期格式(YYYY-MM-DD)！");
    return false;
  }
  yield.value=year+"-"+mon+"-"+date;
  return true;
}

//=========================================================
//函 数 名：check_isurl
//功能描述：检验Url地址格式是否正确
//调用方法：MyStr=check_isurl(MyStr,"说明文字")
//========================================================
function check_isurl(yield,alertstring){
 var pattern = /^http:\/\/[A-Za-z0-9]+\.[A-Za-z0-9]+[\/=\?%\-&_~`@[\]\':+!]*([^<>""])*$/;
 var strValue=yield.value;
if (strValue.length==0)
 return true;
 if(strValue.match(pattern)==null){
  alert("“"+alertstring+"”格式错误,正确格式如：http://www.hy8.cn，请检查!");
  yield.focus();
  return false;
 }else{
 return true;
 }
}

function check_date(Object,Desc){
 var pattern = /^([1-2]\d{3})[\-]([1-9]|10|11|12)[\-]([1-2][0-9]|[1-9]|30|31)$/;
 var strValue=Object.value;
if (strValue.length==0)
 return true;
 if(strValue.match(pattern)==null){
  alert("“"+Desc+"”必须为日期格式(2006-1-1)！");
  Object.focus();
  return false;
 }else{
 return true;
 }
}

//校验函数
//str:许校验的字符
//检查是否为数字
function check_number_val(str){
  if(str==null||str=="") return true;
  else{
    var re =/\d/;
    var i=0;
    var len=str.length;
    for(i=0;i<len;i++){
      if(str.charAt(i).match(re)==null) return false;
    }
  }
  return true;
}

//
function check_isemail(Object,Desc){
 var pattern = /[a-zA-Z0-9_.]{1,}@[a-zA-Z0-9_]{1,}.[a-zA-Z0-9_]{1,}/;
 var strValue=Object.value;
 if(strValue.match(pattern)==null){
  alert("“"+Desc+"”必须为合法的email，请修改！");
  Object.focus();
  return false;
 }else{
 return true;
 }
} 

function check_isqq(Object,Desc){
 var pattern = /^[1-9]\d{4,10}$/;
 var strValue=Object.value;
if (strValue.length==0)
 return true;
 if(strValue.match(pattern)==null){
  alert("“"+Desc+"”号码错误，必须为数字且长度为5－11位，请检查！");
  Object.focus();
  return false;
 }else{
 return true;
 }
} 

//校验函数
//box：要检验的文本框；button：要控制的按钮
//检查是否输入字符，如果不为空，则可以使相应按钮可用
function Check_BoxAdd(box, button)
{
 var buttonCtrl = document.getElementById( button );
 if ( buttonCtrl != null )
 {
 if (box.value == "" || box.value == box.helptext)
 {
 buttonCtrl.disabled = true;
 }
 else
 {
 buttonCtrl.disabled = false;
 }
 }
}

String.prototype.trim = function()
{
    return this.replace(/(^[\s]*)|([\s]*$)/g, "");
}
String.prototype.lTrim = function()
{
    return this.replace(/(^[\s]*)/g, "");
}
String.prototype.rTrim = function()
{
    return this.replace(/([\s]*$)/g, "");
}
/********************************** chinese ***************************************/
/**
*校验字符串是否为中文
*返回值：
*如果为空，定义校验通过，           返回true
*如果字串为中文，校验通过，         返回true
*如果字串为非中文，             返回false    参考提示信息：必须为中文！
*/
function checkischinese(str)
{
    //如果值为空，通过校验
    if (str == "")
        return true;
    var pattern = /^([\u4E00-\u9FA5]|[\uFE30-\uFFA0])*$/gi;
    if (pattern.test(str))
        return true;
    else
        return false;
}//~~~
/**
 * 计算字符串的长度，一个汉字两个字符
 */
String.prototype.realLength = function()
{
  return this.replace(/[^\x00-\xff]/g,"**").length;
}

function StrLenthByByte(str) 
{ 
var len; 
var i; 
len = 0; 
for (i=0;i<str.length;i++) 
{ 
if (str.charCodeAt(i)>255) len+=2; else len++; 
} 
return len; 
} 

//截取文本框中字符的长度，如果大于规定值将自动消除
//一个汉字算两个字符
function textLimitCheck(thisArea, maxLength,messageCount,Myspan){
	var MyStr=StrLenthByByte(thisArea.value);
	var messageCount;
	var Myspan;
if (MyStr > maxLength){
  alert(maxLength + ' 个字符限制. \r超出的将自动去除.');
  thisArea.value = (thisArea.value.substring(0, maxLength)).rTrim();
  thisArea.focus();
  var MyStr=maxLength;
}
if (Myspan==0){
/*回写span的值，当前填写文字的数量*/
messageCount.innerText = MyStr;}
}

<!--
//
function unselectall()
{
    if(document.form.chkAll.checked){
	document.form.chkAll.checked = document.form.chkAll.checked&0;
    } 	
}

function CheckAll(form)
{
  for (var i=0;i<form.elements.length;i++)
    {
    var e = form.elements[i];
    if (e.Name != "chkAll"&&e.disabled!=true)
       e.checked = form.chkAll.checked;
    }
}
//-->
//=========================================================
//函 数 名：check_grname
//功能描述：检验用户名格式是否正确 英文、数字、下划线、中文正则表达式 
//调用方法：MyStr=check_grname(MyStr,"说明文字")
//========================================================
function check_grname(yield,alertstring){
 var pattern = /^[\w\u4E00-\u9FA5\uF900-\uFA2D]*$/;
 var strValue=yield.value;
 if(strValue.length==0||yield.value==null||strValue.match(pattern)==null){
  alert(""+alertstring+"");
  yield.focus();
  return false;
 }else{
 return true;
 }
}

//=========================================================
//函 数 名：check_qyname
//功能描述：检验用户名格式是否正确 英文、数字、下划线、中文正则表达式 
//调用方法：MyStr=check_grname(MyStr,"说明文字")
//========================================================
function check_qyname(yield,alertstring){
 var pattern = /^[a-zA-Z]{1}([a-zA-Z0-9]|[_]){1,15}$/;
 var strValue=yield.value;
 if(strValue.length==0||yield.value==null||strValue.match(pattern)==null){
  alert(""+alertstring+"");
  yield.focus();
  return false;
 }else{
 return true;
 }
}

//=========================================================
//函 数 名：check_pwdlen
//功能描述：检验密码名格式是否正确 英文、数字、下划线、中文正则表达式 
//调用方法：MyStr=check_grname(MyStr,"说明文字")
//========================================================
function check_pwdlen(yield,alertstring){
 var pattern = /^\s*[A-Za-z0-9]{4,20}\s*$/;
 var strValue=yield.value;
 if(strValue.length==0||yield.value==null||strValue.match(pattern)==null){
  alert(""+alertstring+"");
  yield.focus();
  return false;
 }else{
 return true;
 }
}

//=========================================================
//函 数 名：check_istel
//功能描述：检验电话格式
//调用方法：MyStr=check_grname(MyStr,"说明文字")
//========================================================
function check_istel(yield,alertstring){
 var pattern = /^[0-9]{1}([0-9]|[\/]|[-－])*$/;
 var strValue=yield.value;
 if(strValue.length==0||yield.value==null||strValue.match(pattern)==null){
  alert(""+alertstring+"");
  yield.focus();
  return false;
 }else{
 return true;
 }
}

//=========================================================
//函 数 名：check_cardid
//功能描述：检验身份证 不严格 
//调用方法：MyStr=check_cardid(MyStr,"说明文字")
//========================================================
function check_cardid(str,alertstring){
 var pattern = /^\d{15}|\d{18}$/;
 var strValue=str.value;
if (strValue.length==0)
 return true;
 if(strValue.match(pattern)==null){
  alert(""+alertstring+"");
  str.focus();
  return false;
 }else{
 return true;
 }
}
{   
  var   flag=false; 
  function   DrawImage(ImgD,ImgW,ImgH){   
        var   image=new   Image();   
        image.src=ImgD.src;   
        if(image.width>0   &&   image.height>0){   
          flag=true;   
          if(image.width/image.height>=0){   
            if(image.width>ImgW){       
            ImgD.width=ImgW;   
            ImgD.height=(image.height*ImgW)/image.width;   
            }else{   
            ImgD.width=image.width;       
            ImgD.height=image.height;   
            }   
           // ImgD.alt=image.width+"×"+image.height;   
            }   
          else{   
            if(image.height>ImgH){       
            ImgD.height=ImgH;   
            ImgD.width=(image.width*ImgH)/image.height;             
            }else{   
            ImgD.width=image.width;       
            ImgD.height=image.height;   
            }   
            //ImgD.alt=image.width+"×"+image.height;   
            }   
          }   
  }     
  } 