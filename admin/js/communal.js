// JavaScript Document
//验证批量管理页面,将选中的'选择'框的值组合成字符串,并赋值
function validForm(strItem, strTargetItem)
{
 var arrChecked = Array();
 var arrItem = document.getElementsByName(strItem);
 for(intCount = 0; intCount < arrItem.length; intCount++)
 {
  if(arrItem[intCount].checked)
  {
   arrChecked[arrChecked.length] = arrItem[intCount].value;
  }
 }
 
 if(arrChecked.length == 0)
 {
  alert('请至少选中一条记录');
  return false;
 }
 else
 {
  document.getElementById(strTargetItem).value = arrChecked.join(",");
  return true;
 }
}