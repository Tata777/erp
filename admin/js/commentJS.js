//检查搜索字符串是否为空白字符串
function blank(strValue)
{
	var s = strValue;
	for(var i = 0; i < s.length; i ++)
	{
		var c = s.charAt(i);
		if((c != ' ') && (c != '\n') && (c != ''))
		{
			return false;
		}
	}
	return true;
}

//弹出新窗口
function PopupWindow(strUrl, intWidth, intHeight)
{
  window.open(strUrl, (new Date()).getSeconds(), 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=yes,width='+intWidth+',height='+intHeight);
	return false;
}

//关闭窗口确认
function ConfirmCloseWinow(strTips)
{	
	strTips = (strTips == '') ? '真的要关闭本窗口？' : strTips;
	
	if(confirm(strTips))
	{
		window.close();
	}
	else
	{
		return false;
	}
}

//反选
function ReversSelected(strElementName)
{
	var checkboxArray = document.getElementsByName(strElementName);
	for(intCount = 0; intCount < checkboxArray.length; intCount++)
		checkboxArray[intCount].checked = !checkboxArray[intCount].checked;
}

//切换Tabs, sid为切换到第几个tab
function ShowSort(sid){
	if(sid)
	{
		var ListAll = document.getElementById('listtab').getElementsByTagName('div');
		var TabsAll = document.getElementById('TabsAll').getElementsByTagName('div');
		var ListLength = ListAll.length;
		for(intCount = 0; intCount < ListLength; intCount++)
		{
			ListAll[intCount].getElementsByTagName("a")[0].className = "listdiv";
			ListAll[intCount].getElementsByTagName("a")[0].style.borderStyle = "none";
			ListAll[intCount].getElementsByTagName("a")[0].style.backgroundColor = "#F3F7FF";
			document.getElementById('Tab_' + (intCount + 1).toString()).style.display ="none";
		}
		document.getElementById('div_'+sid).getElementsByTagName("a")[0].className = "activediv";
		document.getElementById('div_'+sid).getElementsByTagName("a")[0].style.border = "2px solid #86B9D6";
		document.getElementById('div_'+sid).getElementsByTagName("a")[0].style.borderBottomStyle = "none";
		document.getElementById('div_'+sid).getElementsByTagName("a")[0].style.backgroundColor = "#fff";
		document.getElementById('div_'+sid).getElementsByTagName("a")[0].blur();
		document.getElementById('Tab_'+sid).style.display ="";
	}
}

/************************************************************************************
depiction：验证不为空的input/textarea, 格式必须是<tr><th>提示文字</td><td>input/textarea元素</td></tr>
@param p_arrTrID 所有包含input/textarea的Tr数组, 记录的是Tr的ID值
@returns bool true为通过所有验证
Creater：sun
Create Date：2007-12-12
*************************************************************************************/
function validNotBlank(p_arrTrID)
{
	var arrLength = p_arrTrID.length;
	for(intCount = 0; intCount < arrLength; intCount++)
	{
		var tr = document.getElementById(p_arrTrID[intCount]);
		var strInputValue = (tr.getElementsByTagName('input').length != 0) ? tr.getElementsByTagName('input')[0].value : tr.getElementsByTagName('textarea')[0].value;
		var strTips = tr.getElementsByTagName('th')[0].innerHTML;
		//var strTips = tr.getElementsByTagName('th')[0].innerHTML.replace("：", "");
		
		if(blank(strInputValue))
		{
			alert("请输入 '" + strTips + "'");
			(tr.getElementsByTagName('input').length != 0) ? tr.getElementsByTagName('input')[0].focus() : tr.getElementsByTagName('textarea')[0].focus();
			return false
		}
	}
	
	return true;
}

//验证日期格式
function validDate(p_arrElementID)
{
	var arrLength = p_arrElementID.length;
	for(intCount = 0; intCount < arrLength; intCount++)
	{
		var element = document.getElementById(p_arrElementID[intCount]);
		var re = /^\d{4}-\d{1,2}-\d{1,2}$/i;
		if(!element.value.match(re))
		{
			alert("请按照正确的时间格式填写");
			element.focus();
			return false;
		}
	}
	return true;
}

//验证排序号
function validSortNum(p_arrElementID)
{
	var arrLength = p_arrElementID.length;
	for(intCount = 0; intCount < arrLength; intCount++)
	{
		var element = document.getElementById(p_arrElementID[intCount]);
		if(isNaN(element.value) || element.value < 0 || element.value > 9999)
		{
			alert("请按照正确的数字格式填写");
			element.focus();
			return false;
		}
	}
	return true;	
}

//显示批量操作的子选项, strTableID变量在batch_operationg.php中输出
function DisplaySubBO(strTrID)
{
	var arrTr = document.getElementById(strTableID).getElementsByTagName("tr");
	var arrTrLength = arrTr.length;
	for(var intCount = 0; intCount < arrTrLength; intCount++)
	{
		arrTr[intCount].style.display = 'none';
	}
	
	try
	{
		document.getElementById(strTrID).style.display = '';
	}
	catch(e)
	{
  	//Do nothing!
	}

}

//验证单个排序号
function CheckNum(objElement)
{
	if(isNaN(objElement.value) || blank(objElement.value) || objElement.value < 0 || objElement.value > 9999)
	{
		alert("请按照正确的数字格式填写");
		objElement.focus();
	}
}

//验证单个日期格式
function CheckDate(objElement)
{
	var re = /^\d{4}-\d{1,2}-\d{1,2}$/i;
	if(!objElement.value.match(re))
	{
		alert("请按照正确的时间格式填写");
		objElement.focus();
	}
}

//鼠标经过TR时，更改背景颜色
function chgColor(objTr, strStatus)
{
	if(strStatus == "over")
		objTr.style.backgroundColor='#eaeaff';
	else
		objTr.style.backgroundColor='#fff';
}

//验证批量管理页面,将选中的'选择'框的值组合成字符串,并赋值
function validManage(strItem, strSort, strTargetItem, strTargetSort)
{
	var arrChecked = Array();
	var arrSorted = Array();
	var arrItem = document.getElementsByName(strItem);
	var arrSort = document.getElementsByName(strSort);
	for(intCount = 0; intCount < arrItem.length; intCount++)
	{
		if(arrItem[intCount].checked)
		{
			arrChecked[arrChecked.length] = arrItem[intCount].value;
			arrSorted[arrSorted.length] = arrSort[intCount].value;
		}
	}
	if(arrChecked.length == 0)
	{
		alert('请至少选中一条记录');
		return false;
	}
	else
	{
		//alert("eee");
		document.getElementById(strTargetItem).value = arrChecked.join(",");
		document.getElementById(strTargetSort).value = arrSorted.join(",");
		return true;
	}
}

//验证密码与确认密码是否相同
function cmfPassword(pwdID, cmfPwdID)
{	
		var password = pwdID;
		var cpassword = cmfPwdID;
	  if(password.value != cpassword.value){
	  alert("登陆密码和确认密码不一致!");
		cpassword.focus();
		}
		return false;
}
//验证email是否合法
function check_isemail(emailID,Desc){
	 var pattern = /[a-zA-Z0-9_.]{1,}@[a-zA-Z0-9_]{1,}.[a-zA-Z0-9_]{1,}/;
	 var strValue=emailID.value;
	 if(strValue.match(pattern)==null){
		alert("“"+Desc+"”必须为合法的email，请修改！");
		emailID.focus();
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

