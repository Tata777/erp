<?php
$protectid="2"; 
include("../protect.php");
include_once("../../config.inc.php");
include_once(CFG_LIB_DIR.'mysqldb.inc.php');
$objDb = new mysqldb();
require(CFG_LIB_DIR.'selector.php');
$SelCate = new clsSelCate();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Administrator's Control Panel</title>
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<link href="../css/edit.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../js/commentJS.js"></script>
</head>

<body id="main">
<table summary="" id="pagehead" cellpadding="0" cellspacing="0" border="0" width="100%">
  <tr>
    <td width="23%"><h1>高级搜索</h1></td>
    <td width="77%" class="actions"><table summary="" cellpadding="0" cellspacing="0" border="0" align="right">
				<tr>
					<td><a href="index.php" class="view">信息管理</a></td>
					<td class="active"><a href="advsearch.php">高级搜索</a></td>
					<td><a href="#" class="add" onclick="return PopupWindow('info.php?act=add', 800, 600);">添加信息</a></td>	
				</tr>
			</table>&nbsp;</td>
  </tr>
</table>
<form id="advsearch" name="advsearch" method="post" action="index.php">
  <table cellspacing="0" cellpadding="0" width="100%"  class="maintable" id="feedbackTable">
    <tr>
      <th width="20%" style="text-align:left;">搜索关键字</th>
      <td><input name="Tag" type="text" id="Tag" size="30" value="" />      </td>
    </tr>
    <tr>
      <th style="text-align:left;">搜索字段:
        <p> (可多选，不选择搜索所<br />
        有字段)</p></th>
      <td><select name="Field[]" size="10" multiple="multiple" id="select">
           
					 　<option value='InfoID'  >ID号</option>
					 
            <option value='Title'  >标题</option>
  		  
            <option value='Author'  >作者</option>
  		  
            <option value='Content'  >新闻内容</option>
  		  
            <option value='Tag'  >关键字</option>
  		  
            <option value='SubTitle'  >副标题</option>
  		  
            <option value='FromSite'  >来源网站</option>
  		  
            <option value='Editor'  >责任编辑</option>
  		  
            <option value='Intro'  >简介</option>
  		   
        </select></td>
    </tr>
    <tr>
      <th style="text-align:left;">搜索类型:</th>
      <td>
          <input type="radio" value="2" name="IsAuditing" id="IsAuditing2" checked="checked" />
          <label for="IsAuditing2">所有文档</label>
          <input type="radio" value="0" name="IsAuditing" id="IsAuditing0" />
          <label for="IsAuditing0">未发布文档</label>
          <input type="radio" value="1" name="IsAuditing" id="IsAuditing1" />
          <label for="IsAuditing1">已发布文档</label>
      </td>
    </tr>
    <tr>
      <th style="text-align:left;">搜索分类:
      <p>(可多选，不选择搜索该<br />
      内容模型下的所有分类)</p></th>
      <td><?php echo $SelCate->strSelCate("1", "", con_strPREFIX."infocategory", "CateID[]", "10", "multiple")?></td>
    </tr>
    <tr>
      <th style="text-align:left;">日期限制:</th>
      <td><SELECT name="PublishDate" id="PublishDate">
                     <option value="1">最近一天内的文章</option>
                   <option value="7">最近一个星期内的文章</option>
                    <option value="30">最近一个月内的文章</option>
                    <option value="60">在两个月内的文章</option>
                    <option value="90">在三个月内的文章</option>
                    <option value="180">在半年内的文章</option>
                    <option value="360">一年内的文章</option>
                    <option value="0" selected>任何时间的文章</option>
                  </SELECT></td>
    </tr>
		<tr>
      <th style="text-align:left;">排序字段:</th>
      <td><SELECT name="TaxisField" id="TaxisField">
                   <option value='InfoID' selected="selected">默认排序</option>
									 <option value='PublishDate'>创建时间</option>
									 <option value='SortNum'>排序号</option>
									 <option value='TopNum'>置顶权值</option>
									 <option value='ExtractNum'>精华权值</option>
               </SELECT></td>
    </tr>
		<tr>
      <th style="text-align:left;">排序规则:</th>
      <td>
      <input name="Taxis" type="radio" value="desc" checked="checked" />
       <label for="Taxis0"> 降序</label>
       <input type="radio" name="Taxis" value="asc" />
      <label for="Taxis1">升序</label>  
			</td>
    </tr>
  </table>
  <div class="buttons">
	<input name="act" id="act" type="hidden" value="advsearch" />
  <input type="submit" name="thevaluesubmit" value="开始搜索" class="submit" />
  <input type="reset" name="thevaluereset" value="全部重置" />
	<input type="button" id="button1" value="返回" onclick="javascript:history.back();">
</div>
</form>
<br>
<?php include "../bottom.php"?>
</div>
</body>
</html>
