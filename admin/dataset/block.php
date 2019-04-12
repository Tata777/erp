<?php
	$protectid="132"; 
	include("../protect.php");
	
	include_once("../../config.inc.php");
	
	$strID = $_GET['id'];	
	$strAct = (empty($_GET['act'])) ? "add" : $_GET['act'];
	$strOperation = ( $strAct == "add" ) ? "创建" : "修改";
	
	include_once(CFG_LIB_DIR.'mysqldb.inc.php');		
	$objDb = new mysqldb();
	
	$strSQL = "SELECT b.*, c.`CateName`, c.`CateType` FROM `".con_strPREFIX."blocks` AS b LEFT JOIN `".con_strPREFIX."blockcategory` AS c ON b.`CateID` = c.`BlockCategoryID` WHERE BlocksID = ".$strID." LIMIT 1";
	$objDb->query($strSQL);
	$tmpResult = $objDb->get_data();
	$SettingResult = $tmpResult[0];
	$BlockSetting = unserialize($SettingResult['BlockText']);
	
	$ctype = $_GET['ctype'];
	$cid = $_GET['cid'];
	
	include_once(CFG_LIB_DIR."manage_block.php");
	$objManBlock = new clsManageBlock();
	
	include_once(CFG_LIB_DIR."selector.php");
	$SelCate = new clsSelCate();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $strOperation; ?>模块</title>
<?php include_once("../common/files.php"); ?>
<style type="text/css">
	th { width: 180px; }
</style>
<script type="text/javascript" src="../js/jquery-1.2.6.min.js"></script>
<script type="text/javascript">	
	function DisplayElement(strElementID, strNum)
	{
		var strOppNum = (strNum == "0") ? "1" : "0";
		document.getElementById(strElementID + strNum).style.display = '';
		document.getElementById(strElementID + strOppNum).style.display = 'none';
	}
	
	function DisSelectCate(strElementID)
	{
		var objCate = document.getElementById(strElementID);
		for(intCount = 0; intCount < objCate.length; intCount++)
		{
			objCate.options[intCount].selected = false;
		}
	}
</script>
<?php
	if(in_array("SysCate", $objManBlock->arrBlockCate[$ctype]['arrFilter']))
	{
?>
		<script type="text/javascript">
      $(function()
        {
          $("input[name*='SysCateType']").click
          (
            function()
            {
              changeSysCate($(this).attr("value"), "");
            }
          )
					
					<?php
						if(isset($BlockSetting['SysCateType']))
						{
							$strSelectID 	= isset($BlockSetting['SysCateID']) ? serialize($BlockSetting['SysCateID']) : "";
							
							$arrOrderColumn = array();							
							$arrOrderColumn[]	= (isset($BlockSetting['OrderColumn'][0]) ? "'".$BlockSetting['OrderColumn'][0]."'" : "");
							$arrOrderColumn[]	= (isset($BlockSetting['OrderColumn'][1]) ? "'".$BlockSetting['OrderColumn'][1]."'" : "");
							$arrOrderColumn[]	= (isset($BlockSetting['OrderColumn'][2]) ? "'".$BlockSetting['OrderColumn'][2]."'" : "");
							
							echo "initSysCate('".$BlockSetting['SysCateType']."', '".$strSelectID."', [".implode("," , $arrOrderColumn)."]);\n";
						}
					?>
        }
      )
      
			//生成'系统分类'列表框,并且更改'列表排序'中'默认ID'的value
      function changeSysCate(strSysType, strSelectID)
      {						
        $("#syscateSpan").html('<img src="../images/loading.gif" />');
				$.ajax
				(
					{
						type: 	"POST",
						url:		"syscate_ajax_handler.php",
						data:		"strCateType=" + strSysType + "&strCateID=" + strSelectID,
						async:	false,
						success:function(xml)
						{
							$("#syscateSpan").html($(xml).find("Response").text());
							$("select[name*='OrderColumn[]']").each
							(
								function()
								{
									$(this).find("option").eq(1).attr("value", "sc." + $(xml).find("keyname").text());
								}
							)							
						}
					}
				);
      }
			
			//恢复'系统分类'以前选中的项
			function initSysCate(strSysType, strSelectID, arrOrderColumn)
			{
				$("input[name*='SysCateType']").each
				(
					function()
					{
						if($(this).val() == strSysType)
						{
							$(this).attr("checked", "checked");
							changeSysCate(strSysType, strSelectID);
						}
					}
				);
				
				$("select[name*='OrderColumn[]']").each
				(
					function(i)
					{						
          	var strOptionValue = $(this).find("option").eq(1).val();
						if(strOptionValue == arrOrderColumn[i])
							$(this).find("option").eq(1).attr("selected", "selected");
					}
				);
			}
    </script>
<?php
	}
?>
</head>

<body id="main">
<table summary="" id="pagehead" cellpadding="0" cellspacing="0" border="0" width="100%">
	<tr>
		<td><h1>模块</h1></td>
		<td class="actions">
			<table summary="" cellpadding="0" cellspacing="0" border="0" align="right">
				<tr>
					<td><a href="index.php?act=add&cid=<?php echo $cid; ?>&ctype=<?php echo $ctype; ?>" class="view">浏览模块</a></td>
					<td class="active"><a href="#" class="<?php echo ($strAct == "modify") ? "edit" : "add"; ?>"><?php echo $strOperation; ?>模块</a></td>	
				</tr>
			</table>
		</td>
	</tr>
</table>

<?php	
	$objManBlock->vodPirntSelector();
?>

<form method="post" action="block_ok.php?act=<?php echo $strAct; ?>&id=<?php echo $strID; ?>&cid=<?php echo $_GET['cid']; ?>&ctype=<?php echo $_GET['ctype']; ?>">

<div class="colorarea02">
  <h2><?php echo $SettingResult['CateName']; ?></h2>
  <table class="maintable" width="100%" cellspacing="0" cellpadding="0">
    <tbody>
      <tr id="tr_blockname">
        <th>模块名</th>
        <td>
        	<input type="text" name="BlockName" id="BlockName" value="<?php if(isset($BlockSetting['BlockName']))echo $BlockSetting['BlockName']; ?>" size="60" />
        </td>
      </tr>
      <tr id="tr_blockmodel">
        <th>向导模式</th>
        <td>
          <input type="radio" name="BlockModel" id="BlockModel1" value="1" <?php if(!isset($BlockSetting['BlockModel']) || isset($BlockSetting['BlockModel']) && $BlockSetting['BlockModel'] == "1")echo 'checked="checked"'; ?> onclick="jsblockmodel(this.value)" />
          <label for="BlockModel1">向导模式</label>
          <input type="radio" name="BlockModel" id="BlockModel2" value="2" <?php if(isset($BlockSetting['BlockModel']) && $BlockSetting['BlockModel'] == "2")echo 'checked="checked"'; ?> onclick="jsblockmodel(this.value)" />
          <label for="BlockModel2">高级模式</label>
        </td>
      </tr>
    </tbody>
  </table>
</div>

<div class="colorarea03">
  <h2>过滤设置</h2>
  <table id="divblockmodel1" style="" class="maintable" cellpadding="0" cellspacing="0">
  <tbody>
  
    <tr id="tr_setitemid">
    <th>指定的itemid(s)</th>
    	<td>
        <input type="radio" name="SetItemID" id="SetItemID0" value="0" <?php if(!isset($BlockSetting['SetItemID']) || isset($BlockSetting['SetItemID']) && $BlockSetting['SetItemID'] == "0")echo 'checked="checked"'; ?> onclick="DisplayElement('divsettid', this.value)">
        <label for="SetItemID0">不指定</label>&nbsp;&nbsp;
        <input type="radio" name="SetItemID" id="SetItemID1" value="1" <?php if(isset($BlockSetting['SetItemID']) && $BlockSetting['SetItemID'] == "1")echo 'checked="checked"'; ?> onclick="DisplayElement('divsettid', this.value)">
        <label for="SetItemID1">指定</label>&nbsp;&nbsp;
      </td>
    </tr>
    
  </tbody>
  
  <tbody id="divsettid1" <?php if(!isset($BlockSetting['SetItemID']) || isset($BlockSetting['SetItemID']) && $BlockSetting['SetItemID'] == "0")echo 'style="display: none;"'; ?>>    
  
    <tr id="tr_itemid">
      <th>输入的itemid(s)</th>
      <td><input type="text" name="ItemID" id="ItemID" size="60" value="<?php if(isset($BlockSetting['ItemID']))echo $BlockSetting['ItemID']; ?>"></td>
    </tr>   
     
  </tbody>


  <tbody id="divsettid0" <?php if(isset($BlockSetting['SetItemID']) && $BlockSetting['SetItemID'] == "1")echo 'style="display: none;"'; ?>>
	<?php
		if(in_array("SysCate", $objManBlock->arrBlockCate[$ctype]['arrFilter']))
		{
	?>    
    <tr id="tr_syscateid">
      <th>系统分类</th>
      <td>
      	<table width="100%"><tr><td>
				<?php
					if(isset($BlockSetting['SetItemID']))
	          $objManBlock->vodPirntRadioSelector($BlockSetting['SetItemID']);
					else
						$objManBlock->vodPirntRadioSelector();
        ?>
        </td></tr></table>
        <div>
          <span id="syscateSpan"></span>
          <input type="checkbox" name="SubSysCate" id="SubSysCate" value="1" <?php if(isset($BlockSetting['SubSysCate']) && $BlockSetting['SubSysCate'] == "1")echo 'checked="checked"'; ?> /> <label for="SubSysCate">读取子分类</label>
          <span class="buttons"><input type="button" value="取消所有选中分类" onclick="DisSelectCate('SysCateID[]');" /></span>
        </div>
      </td>
    </tr>
	<?php
		}
		if(in_array("NormalCate", $objManBlock->arrBlockCate[$ctype]['arrFilter']))
		{
	?>    
    <tr id="tr_cateid">
      <th>站点分类</th>
      <td>
        <?php
          echo $SelCate->strSelCate("1", (isset($BlockSetting['CateID']) ? $BlockSetting['CateID'] : ""), con_strPREFIX.$objManBlock->arrBlockCate[$ctype]['strCateTable'], "CateID[]", "10", "multiple");
        ?> 
        <input type="checkbox" name="SubCate" id="SubCate" value="1" <?php if(isset($BlockSetting['SubCate']) && $BlockSetting['SubCate'] == "1")echo 'checked="checked"'; ?> /> <label for="SubCate">读取子分类</label>
        <span class="buttons"><input type="button" value="取消所有选中分类" onclick="DisSelectCate('CateID[]');" /></span>
      </td>
    </tr>
	<?php
		}
		if(in_array("SpecialCate", $objManBlock->arrBlockCate[$ctype]['arrFilter']))
		{
	?>    
    <tr id="tr_cateid">
      <th>专题分类</th>
      <td>
        <?php
          echo $SelCate->strSelCate("1", (isset($BlockSetting['SpecialID']) ? $BlockSetting['SpecialID'] : ""), con_strPREFIX.$objManBlock->arrBlockCate[$ctype]['strSpeCateTable'], "SpecialID[]", "10", "multiple");
        ?> 
        <input type="checkbox" name="SubSpecCate" id="SubSpecCate" value="1" <?php if(isset($BlockSetting['SubSpecCate']) && $BlockSetting['SubSpecCate'] == "1")echo 'checked="checked"'; ?> /> <label for="SubSpecCate">读取子分类</label>
        <span class="buttons"><input type="button" value="取消所有选中分类" onclick="DisSelectCate('SpecialID[]');" /></span>
      </td>
    </tr>
	<?php
		}
		
		if(in_array("SndType", $objManBlock->arrBlockCate[$ctype]['arrFilter']))
		{
	?>
    
    <tr id="tr_createtime">
      <th>买卖方向</th>
      <td><?php echo $SelCate->strRadSndCate("SndType", (isset($BlockSetting['SndType']) ? $BlockSetting['SndType'] : ""), true); ?></td>
    </tr>

	<?php
		}
		
		if(in_array("CreateTime", $objManBlock->arrBlockCate[$ctype]['arrFilter']))
		{
	?>
    
    <tr id="tr_createtime">
      <th>创建时间范围</th>
      <td><?php echo $SelCate->strSelTime("CreateTime", (isset($BlockSetting['CreateTime']) ? $BlockSetting['CreateTime'] : "")); ?></td>
    </tr>

	<?php
		}
		
		if(in_array("StartTime", $objManBlock->arrBlockCate[$ctype]['arrFilter']))
		{
	?>
    
    <tr id="tr_starttime">
      <th>开始时间范围</th>
      <td><?php echo $SelCate->strSelTime("StartTime", (isset($BlockSetting['StartTime']) ? $BlockSetting['StartTime'] : "")); ?></td>
    </tr>

	<?php
		}
		
		if(in_array("EndTime", $objManBlock->arrBlockCate[$ctype]['arrFilter']))
		{
	?>
    
    <tr id="tr_endtime">
      <th>结束时间范围</th>
      <td><?php echo $SelCate->strSelTime("EndTime", (isset($BlockSetting['EndTime']) ? $BlockSetting['EndTime'] : "")); ?></td>
    </tr>

	<?php
		}
		
		if(in_array("SortNum", $objManBlock->arrBlockCate[$ctype]['arrFilter']))
		{
	?>
    
    <tr id="tr_sortnum">
      <th>排序号范围</th>
      <td><input type="text" name="SortNum[]" id="SortNum0" size="10" value="<?php if(isset($BlockSetting['SortNum'][0]))echo $BlockSetting['SortNum'][0]; ?>"> ~ <input type="text" name="SortNum[]" id="SortNum1" size="10" value="<?php if(isset($BlockSetting['SortNum'][1]))echo $BlockSetting['SortNum'][1]; ?>"></td>
    </tr>

	<?php
		}
		
		if(in_array("TopNum", $objManBlock->arrBlockCate[$ctype]['arrFilter']))
		{
	?>
    
    <tr id="tr_topnum">
      <th>置顶权值范围</th>
      <td><input type="text" name="TopNum[]" id="TopNum0" size="10" value="<?php if(isset($BlockSetting['TopNum'][0]))echo $BlockSetting['TopNum'][0]; ?>"> ~ <input type="text" name="TopNum[]" id="TopNum1" size="10" value="<?php if(isset($BlockSetting['TopNum'][1]))echo $BlockSetting['TopNum'][1]; ?>"></td>
    </tr>

	<?php
		}
		
		if(in_array("ExtractNum", $objManBlock->arrBlockCate[$ctype]['arrFilter']))
		{
	?>
    
    <tr id="tr_extractnum">
      <th>精华权值范围</th>
      <td><input type="text" name="ExtractNum[]" id="ExtractNum0" size="10" value="<?php if(isset($BlockSetting['ExtractNum'][0]))echo $BlockSetting['ExtractNum'][0]; ?>"> ~ <input type="text" name="ExtractNum[]" id="ExtractNum1" size="10" value="<?php if(isset($BlockSetting['ExtractNum'][1]))echo $BlockSetting['ExtractNum'][1]; ?>"></td>
    </tr>
	<?php
		}
		
		
		if(in_array("IsMember", $objManBlock->arrBlockCate[$ctype]['arrFilter']))
		{
	?>
    <tr id="tr_auditing">
      <th>是否会员</th>
      <td>
      	<input type="radio" name="IsMember" id="IsMember1" value="1" <?php if(!isset($BlockSetting['IsMember']) || isset($BlockSetting['IsMember']) && $BlockSetting['IsMember'] != "0")echo 'checked="checked"'; ?> />
        <label for="IsMember1">是</label>
        <input type="radio" name="IsMember" id="IsMember0" value="0" <?php if(isset($BlockSetting['IsMember']) && $BlockSetting['IsMember'] == "0")echo 'checked="checked"'; ?> />
        <label for="IsMember0">不是</label>
      </td>
    </tr>
	<?php 
	}
		if(in_array("Lang", $objManBlock->arrBlockCate[$ctype]['arrFilter']))
		{
	?>
    
	<?php
		}
		
		
		if(in_array("IsAuditing", $objManBlock->arrBlockCate[$ctype]['arrFilter']))
		{
	?>
    <tr id="tr_auditing">
      <th>审核</th>
      <td>
      	<input type="radio" name="IsAuditing" id="IsAuditing1" value="1" <?php if(!isset($BlockSetting['IsAuditing']) || isset($BlockSetting['IsAuditing']) && $BlockSetting['IsAuditing'] != "0")echo 'checked="checked"'; ?> />
        <label for="IsAuditing1">已审核</label>
        <input type="radio" name="IsAuditing" id="IsAuditing0" value="0" <?php if(isset($BlockSetting['IsAuditing']) && $BlockSetting['IsAuditing'] == "0")echo 'checked="checked"'; ?> />
        <label for="IsAuditing0">未审核</label>
      </td>
    </tr>
	<?php 
	}
		if(in_array("Lang", $objManBlock->arrBlockCate[$ctype]['arrFilter']))
		{
	?>
    <tr id="tr_auditing">
      <th>语言</th>
      <td>
      	<input type="radio" name="Lang" id="Lang1" value="cn" <?php if(!isset($BlockSetting['Lang']) || isset($BlockSetting['Lang']) && $BlockSetting['Lang'] === "cn")echo 'checked="checked"'; ?> />
        <label for="Lang1">中文</label>
        <input type="radio" name="Lang" id="Lang0" value="en" <?php if(isset($BlockSetting['Lang']) && $BlockSetting['Lang'] === "en")echo 'checked="checked"'; ?> />
        <label for="Lang0">英文</label>
      </td>
    </tr>

	<?php
		}
		
		if(in_array("HasImg", $objManBlock->arrBlockCate[$ctype]['arrFilter']))
		{
	?>
    
    <tr id="tr_img">
      <th>是否有图片</th>
      <td>
      	<input type="radio" name="HasImg" id="HasImgNL" value="NoLimit" <?php if(!isset($BlockSetting['HasImg']) || isset($BlockSetting['HasImg']) && $BlockSetting['HasImg'] == "NoLimit")echo 'checked="checked"'; ?> />
        <label for="HasImgNL">不限制</label>
      	<input type="radio" name="HasImg" id="HasImg1" value="1" <?php if(isset($BlockSetting['HasImg']) && $BlockSetting['HasImg'] == "1")echo 'checked="checked"'; ?> />
        <label for="HasImg1">有图片</label>
        <input type="radio" name="HasImg" id="HasImg0" value="0" <?php if(isset($BlockSetting['HasImg']) && $BlockSetting['HasImg'] == "0")echo 'checked="checked"'; ?> />
        <label for="HasImg0">无图片</label>
      </td>
    </tr>

	<?php
		}
		
		if(in_array("MemberID", $objManBlock->arrBlockCate[$ctype]['arrFilter']))
		{
	?>
    
    <tr id="tr_memberid">
      <th>指定会员ID(s)</th>
      <td>
      	<input type="text" name="MemberID" id="MemberID" size="60" value="<?php if(isset($BlockSetting['MemberID']))echo $BlockSetting['MemberID']; ?>">
      </td>
    </tr>

	<?php
		}
		
		if(in_array("ParentID", $objManBlock->arrBlockCate[$ctype]['arrFilter']))
		{
	?>
    
    <tr id="tr_memberid">
      <th>父级ID(s)</th>
      <td>
      	<input type="text" name="ParentID" id="ParentID" size="60" value="<?php if(isset($BlockSetting['ParentID']))echo $BlockSetting['ParentID']; ?>">
      </td>
    </tr>

	<?php
		}
		
		if(in_array("ParentID", $objManBlock->arrBlockCate[$ctype]['arrFilter']))
		{
	?>
    
    <tr id="tr_memberid">
      <th>父级ID(s)</th>
      <td>
      	<input type="text" name="ParentID" id="ParentID" size="60" value="<?php if(isset($BlockSetting['ParentID']))echo $BlockSetting['ParentID']; ?>">
      </td>
    </tr>

	<?php
		}
	?>
  
  </tbody>  
  </table>
</div>

<div class="colorarea01">
	<h2>排序设置</h2>
  <table id="divblockmodel11" style="" class="maintable" cellpadding="0" cellspacing="0">
  <tbody>
    <tr id="tr_order">
      <th>列表排序</th>
      <td>
        <table class="freetable">
        <tbody>
        	<tr>
          	<td>第一排序</td>
            <td><?php echo $SelCate->strSelOrderColumn("OrderColumn[]", $objManBlock->arrBlockCate[$ctype]['arrOrder'], (isset($BlockSetting['OrderColumn'][0]) ? $BlockSetting['OrderColumn'][0] : "")); ?></td>
            <td><?php echo $SelCate->strSelOrder("Order[]", (isset($BlockSetting['Order'][0]) ? $BlockSetting['Order'][0] : "")); ?></td>
        	</tr>
        	<tr>
          	<td>第二排序</td>
            <td><?php echo $SelCate->strSelOrderColumn("OrderColumn[]", $objManBlock->arrBlockCate[$ctype]['arrOrder'], (isset($BlockSetting['OrderColumn'][1]) ? $BlockSetting['OrderColumn'][1] : "")); ?></td>
            <td><?php echo $SelCate->strSelOrder("Order[]", (isset($BlockSetting['Order'][1]) ? $BlockSetting['Order'][1] : "")); ?></td>
        	</tr>
        	<tr>
          	<td>第三排序</td>
            <td><?php echo $SelCate->strSelOrderColumn("OrderColumn[]", $objManBlock->arrBlockCate[$ctype]['arrOrder'], (isset($BlockSetting['OrderColumn'][2]) ? $BlockSetting['OrderColumn'][2] : "")); ?></td>
            <td><?php echo $SelCate->strSelOrder("Order[]", (isset($BlockSetting['Order'][2]) ? $BlockSetting['Order'][2] : "")); ?></td>
        	</tr>
        </tbody>
        </table>
      </td>
    </tr>  
  </tbody>
  </table>
</div>

<?php
	if(isset($objManBlock->arrBlockCate[$ctype]['arrDisplay']))
	{
?> 
<div class="colorarea02">

  <h2>显示处理</h2>
  <table width="100%" cellspacing="0" cellpadding="0" class="maintable">
  
  <tbody>
	<?php
		if(in_array("Subject", $objManBlock->arrBlockCate[$ctype]['arrDisplay']))
		{		
	?>  
    <tr id="tr_subjectlen">
      <th>标题长度</th>
      <td><input type="text" name="SubjectLen" id="SubjectLen" value="<?php if(isset($BlockSetting['SubjectLen']))echo $BlockSetting['SubjectLen']; ?>" size="10" /></td>
    </tr>
    
    <tr id="tr_subjectdot">
      <th>标题截取省略号</th>
      <td>
        <input type="radio" name="SubjectDot" id="SubjectDot0" <?php if(!isset($BlockSetting['SubjectDot']) || isset($BlockSetting['SubjectDot']) && $BlockSetting['SubjectDot'] == "0")echo 'checked="checked"'; ?> value="0" />
        <label for="SubjectDot0">无省略号</label>  
        <input type="radio" name="SubjectDot" id="SubjectDot1" <?php if(isset($BlockSetting['SubjectDot']) && $BlockSetting['SubjectDot'] == "1")echo 'checked="checked"'; ?> value="1" />
        <label for="SubjectDot1">有省略号</label>  
      </td>
    </tr>
	<?php
		}
		
		if(in_array("BelongCate", $objManBlock->arrBlockCate[$ctype]['arrDisplay']))
		{
	?>    
    <tr id="tr_showcategory">
      <th>读取所在分类栏目名</th>
      <td>
        <input type="radio" name="ShowCategory" id="ShowCategory0" value="0" <?php if(!isset($BlockSetting['ShowCategory']) || isset($BlockSetting['ShowCategory']) && $BlockSetting['ShowCategory'] == "0")echo 'checked="checked"'; ?> />
        <label for="ShowCategory0">不读取</label>  
        <input type="radio" name="ShowCategory" id="ShowCategory1" value="1" <?php if(isset($BlockSetting['ShowCategory']) && $BlockSetting['ShowCategory'] == "1")echo 'checked="checked"'; ?> />
        <label for="ShowCategory1">读取</label>  
      </td>
    </tr>
    <?php
		}
		
		if(in_array("BelongSpecial", $objManBlock->arrBlockCate[$ctype]['arrDisplay']))
		{
	?>    
    <tr id="tr_showcategory">
      <th>读取所在专题栏目名</th>
      <td>
        <input type="radio" name="ShowSpecial" id="ShowSpecial0" value="0" <?php if(!isset($BlockSetting['ShowSpecial']) || isset($BlockSetting['ShowSpecial']) && $BlockSetting['ShowSpecial'] == "0")echo 'checked="checked"'; ?> />
        <label for="ShowSpecial0">不读取</label>  
        <input type="radio" name="ShowSpecial" id="ShowSpecial1" value="1" <?php if(isset($BlockSetting['ShowSpecial']) && $BlockSetting['ShowSpecial'] == "1")echo 'checked="checked"'; ?> />
        <label for="ShowSpecial1">读取</label>  
      </td>
    </tr>
	<?php
		}
		
		if(in_array("ReadSndType", $objManBlock->arrBlockCate[$ctype]['arrDisplay']))
		{
	?>    
    <tr id="tr_showsndtype">
      <th>读取买卖方向</th>
      <td>
        <input type="radio" name="ShowSndType" id="ShowSndType0" value="0" <?php if(!isset($BlockSetting['ShowSndType']) || isset($BlockSetting['ShowSndType']) && $BlockSetting['ShowSndType'] == "0")echo 'checked="checked"'; ?> />
        <label for="ShowSndType0">不读取</label>  
        <input type="radio" name="ShowSndType" id="ShowSndType1" value="1" <?php if(isset($BlockSetting['ShowSndType']) && $BlockSetting['ShowSndType'] == "1")echo 'checked="checked"'; ?> />
        <label for="ShowSndType1">读取</label>  
      </td>
    </tr>
	<?php
		}		
		
		if(in_array("MemberDetail", $objManBlock->arrBlockCate[$ctype]['arrDisplay']))
		{
	?>
    <tr id="tr_showmemberdetail">
      <th>读取会员信息</th>
      <td>
        <input type="radio" name="ShowMemberDetail" id="ShowMemberDetail0" value="0" <?php if(!isset($BlockSetting['ShowMemberDetail']) || isset($BlockSetting['ShowMemberDetail']) && $BlockSetting['ShowMemberDetail'] == "0")echo 'checked="checked"'; ?> />
        <label for="ShowMemberDetail0">不读取</label>  
        <input type="radio" name="ShowMemberDetail" id="ShowMemberDetail1" value="1" <?php if(isset($BlockSetting['ShowMemberDetail']) && $BlockSetting['ShowMemberDetail'] == "1")echo 'checked="checked"'; ?> />
        <label for="ShowMemberDetail1">读取</label>  
      </td>
    </tr>
    
  </tbody>
	<?php
		}
		
		if(in_array("Intro", $objManBlock->arrBlockCate[$ctype]['arrDisplay']))
		{
	?>
  <tbody>  
    <tr id="tr_showdintro">
      <th>读取简介信息</th>
      <td>
      	<input type="radio" name="ShowIntro" id="ShowIntro0" onclick="DisplayElement('divshowintro', this.value)" value="0" <?php if(!isset($BlockSetting['ShowIntro']) || isset($BlockSetting['ShowIntro']) && $BlockSetting['ShowIntro'] == "0")echo 'checked="checked"'; ?> />
        <label for="ShowIntro0">不读取</label>  
        <input type="radio" name="ShowIntro" id="ShowIntro1" onclick="DisplayElement('divshowintro', this.value)" value="1" <?php if(isset($BlockSetting['ShowIntro']) && $BlockSetting['ShowIntro'] == "1")echo 'checked="checked"'; ?> />
        <label for="ShowIntro1">读取</label>  
      </td>
    </tr>    
  </tbody>
  
  <tbody style="display: none;" id="divshowintro0" />
  
  <tbody <?php if(!isset($BlockSetting['ShowIntro']) || isset($BlockSetting['ShowIntro']) && $BlockSetting['ShowIntro'] == "0")echo 'style="display: none;"'; ?> id="divshowintro1">
  
    <tr id="tr_introlen">
      <th>简介长度</th>
      <td><input type="text" name="IntroLen" id="IntroLen" value="<?php if(isset($BlockSetting['IntroLen']))echo $BlockSetting['IntroLen']; ?>" size="10" /></td>
    </tr>
    
    <tr id="tr_introdot">
      <th>简介截取省略号</th>
      <td>
        <input type="radio" name="IntroDot" id="IntroDot0" value="0" <?php if(!isset($BlockSetting['IntroDot']) || isset($BlockSetting['IntroDot']) && $BlockSetting['IntroDot'] == "0")echo 'checked="checked"'; ?> />
        <label for="IntroDot0">无省略号</label>  
        <input type="radio" name="IntroDot" id="IntroDot1" value="1" <?php if(isset($BlockSetting['IntroDot']) && $BlockSetting['IntroDot'] == "1")echo 'checked="checked"'; ?> />
        <label for="IntroDot1">有省略号</label>  
      </td>
    </tr>
  
  </tbody>
	<?php
		}
		
		if(in_array("Detail", $objManBlock->arrBlockCate[$ctype]['arrDisplay']))
		{
	?>
  <tbody>
    <tr id="tr_showdetail">
      <th>读取详细内容信息</th>
      <td>
      	<input type="radio" name="ShowDetail" id="ShowDetail0" onclick="DisplayElement('divshowdetail', this.value)" value="0" <?php if(!isset($BlockSetting['ShowDetail']) || isset($BlockSetting['ShowDetail']) && $BlockSetting['ShowDetail'] == "0")echo 'checked="checked"'; ?> />
        <label for="ShowDetail0">不读取</label>  
        <input type="radio" name="ShowDetail" id="ShowDetail1" onclick="DisplayElement('divshowdetail', this.value)" value="1" <?php if(isset($BlockSetting['ShowDetail']) && $BlockSetting['ShowDetail'] == "1")echo 'checked="checked"'; ?> />
        <label for="ShowDetail1">读取</label>  
      </td>
    </tr>    
  </tbody>
  
  <tbody style="display: none;" id="divshowdetail0" />
  
  <tbody <?php if(!isset($BlockSetting['ShowDetail']) || isset($BlockSetting['ShowDetail']) && $BlockSetting['ShowDetail'] == "0")echo 'style="display: none;"'; ?> id="divshowdetail1">
  
  <tr id="tr_messagelen">
    <th>内容长度</th>
    <td><input type="text" name="MessageLen" id="MessageLen" value="<?php if(isset($BlockSetting['MessageLen']))echo $BlockSetting['MessageLen']; ?>" size="10" /></td>
  </tr>
  
  <tr id="tr_messagedot">
    <th>内容截取省略号</th>
    <td>
    	<input type="radio" name="MessageDot" id="MessageDot0" value="0" <?php if(!isset($BlockSetting['MessageDot']) || isset($BlockSetting['MessageDot']) && $BlockSetting['MessageDot'] == "0")echo 'checked="checked"'; ?> />
      <label for="MessageDot0">无省略号</label>  
      <input type="radio" name="MessageDot" id="MessageDot1" value="1" <?php if(isset($BlockSetting['MessageDot']) && $BlockSetting['MessageDot'] == "1")echo 'checked="checked"'; ?> />
      <label for="MessageDot1">有省略号</label>  
    </td>
  </tr>
  
  </tbody>
	<?php
		}
	?>
  
  </table>

</div>
<?php
	}
?>

<div class="colorarea02">
  <h2>数据设置</h2>
  <table cellspacing="0" cellpadding="0" class="maintable" style="" id="divblockmodel12">
  
  <tbody>
  
  <tr id="tr_showmultipage">
    <th>数据显示数目设置</th>
    <td>
    	<input type="radio" name="ShowMultiPage" id="ShowMultiPage0" value="0" <?php if(!isset($BlockSetting['ShowMultiPage']) || isset($BlockSetting['ShowMultiPage']) && $BlockSetting['ShowMultiPage'] == "0")echo 'checked="checked"'; ?> onclick="DisplayElement('divshowmulti', this.value)" />
      <label for="ShowMultiPage0">显示指定数目的信息</label>  
      <input type="radio" name="ShowMultiPage" id="ShowMultiPage1" value="1" <?php if(isset($BlockSetting['ShowMultiPage']) && $BlockSetting['ShowMultiPage'] == "1")echo 'checked="checked"'; ?> onclick="DisplayElement('divshowmulti', this.value)" />
      <label for="ShowMultiPage1">读取所有满足条件的信息，并分页显示</label>  
    </td>
  </tr>
    
  </tbody>
  
  <tbody <?php if(isset($BlockSetting['ShowMultiPage']) && $BlockSetting['ShowMultiPage'] == "1")echo 'style="display: none;"'; ?> id="divshowmulti0">
  
    <tr id="tr_start">
      <th>起始数据行数</th>
      <td><input type="text" value="<?php echo (isset($BlockSetting['Limit'][0])) ? $BlockSetting['Limit'][0] : "0"; ?>" size="10" name="Limit[]" /></td>
    </tr>
  
    <tr id="tr_limit">
      <th>显示数据条数</th>
      <td><input type="text" value="<?php echo (isset($BlockSetting['Limit'][1])) ? $BlockSetting['Limit'][1] : "10"; ?>" size="10" name="Limit[]" /></td>
    </tr>
  
  </tbody>
  
  <tbody <?php if(!isset($BlockSetting['ShowMultiPage']) || isset($BlockSetting['ShowMultiPage']) && $BlockSetting['ShowMultiPage'] == "0")echo 'style="display: none;"'; ?> id="divshowmulti1">
  
    <tr id="tr_multipageexplain">
      <th>分页调用说明</th>
      <td>
        启用数据分页显示后，在下面的"显示风格"配置环节，您必须指定"变量名"，并且模块风格文件只能选择"只获取数据"，此外，缓存更新时间设置将无效，数据不会被缓存。<br/>
        列表信息将储存到 <b><i>$_BLOCK[变量名]</i></b> 变量中<br/>
        分页信息将储存到 <b><i>$_BLOCK[变量名_multipage]</i></b> 变量中<br/>
        您只需要在模板中对列表变量、分页变量加以灵活利用就可以了
      </td>
    </tr>
  
    <tr id="tr_perpage">
      <th>每页显示数目<p>默认为20</p></th>
      <td><input type="text" value="<?php echo (isset($BlockSetting['PerPage'])) ? $BlockSetting['PerPage'] : "20"; ?>" size="10" id="PerPage" name="PerPage"/></td>
    </tr>
  
  </tbody>
  
  </table>
</div>

<div class="colorarea03">

  <h2>高级模式</h2>
  <table cellspacing="0" cellpadding="0" class="maintable" style="display: none;" id="divblockmodel2">
  <tbody>
    <tr id="tr_sql">
      <th>输入查询SQL文<p>只支持SELECT开头的查询语句</p></th>
      <td><textarea rows="10" style="width: 98%;" name="SQL" ><?php if(isset($BlockSetting['SQL']))echo $BlockSetting['SQL']; ?></textarea></td>
    </tr>
  </tbody>
  </table>

</div>

<div class="colorarea01">

  <h2>缓存设置</h2>
  <table width="100%" cellspacing="0" cellpadding="0" class="maintable">  
  <tbody>
    <tr id="tr_cachetime">
      <th>缓存更新时间间隔<p>单位:秒</p></th>
      <td>
      	<input type="text" name="CacheTime" id="CacheTime" value="<?php echo (isset($BlockSetting['CacheTime'])) ? $BlockSetting['CacheTime'] : "900"; ?>" size="10" /> 
        <select name="CacheSelect" id="CacheSelect" onchange="this.form.CacheTime.value = this.value">
        	<option value="" <?php if(isset($BlockSetting['CacheSelect']) && $BlockSetting['CacheSelect'] == "")echo 'selected="selected"'; ?>>选择时间</option>
          <option value="900" <?php if(!isset($BlockSetting['CacheSelect']) || isset($BlockSetting['CacheSelect']) && $BlockSetting['CacheSelect'] == "900")echo 'selected="selected"'; ?>>15分钟</option>
          <option value="1800" <?php if(isset($BlockSetting['CacheSelect']) && $BlockSetting['CacheSelect'] == "1800")echo 'selected="selected"'; ?>>30分钟</option>
          <option value="3600" <?php if(isset($BlockSetting['CacheSelect']) && $BlockSetting['CacheSelect'] == "3600")echo 'selected="selected"'; ?>>1小时</option>
          <option value="7200" <?php if(isset($BlockSetting['CacheSelect']) && $BlockSetting['CacheSelect'] == "7200")echo 'selected="selected"'; ?>>2小时</option>
          <option value="43200" <?php if(isset($BlockSetting['CacheSelect']) && $BlockSetting['CacheSelect'] == "43200")echo 'selected="selected"'; ?>>12小时</option>
          <option value="86400" <?php if(isset($BlockSetting['CacheSelect']) && $BlockSetting['CacheSelect'] == "86400")echo 'selected="selected"'; ?>>24小时</option>
        </select>
      </td>
    </tr>  
  </tbody>
  </table>

</div>

<div class="colorarea03">

  <h2>模块风格</h2>
  <table width="100%" cellspacing="0" cellpadding="0" class="maintable">
  
  <tbody>
  <tr id="tr_cachename">
    <th>变量名<p>您可以把获取的数据集合放置到一个模块变量中。在模板文件中可以使用 $_BLOCK[变量名] 来调用该数据集合</p></th>
    <td><input type="text" name="VarName" id="VarName" value="<?php if(isset($BlockSetting['VarName']))echo $BlockSetting['VarName']; ?>" size="" /></td>
  </tr>
  
  <tr id="tr_tpl">
    <th>选择模块风格文件<p>针对不同的模块，有不同的模块风格来控制该模块数据的显示样式。您可以通过 <a href="../blockstyle/index.php">模块风格</a> 功能，来为该模块添加、设置不同的风格</p></th>
    <td>
    <?php
			$strSQL = "SELECT `StyleTitle`, `Intro`, `FileName` FROM `".con_strPREFIX."blockstyle` WHERE `CateID` = $cid ORDER BY `SortNum`";
			$objDb->query($strSQL);
			$styleResult = $objDb->get_data();
			$styleResultCount = $objDb->get_num();
		?>
      <script language="javascript">
        <!--
        function showtplnote(notekey)
        {
          var note = new Array();
          note[0] = "风格作用:获取数据集合到用户指定的模块变量中<br>展示方式:无<br>使用说明:用户可以在模板页面中利用获取到的<br />模块变量 $_BLOCK[变量名] 自由设置展示方式";
					<?php
						for($intCount = 0; $intCount < $styleResultCount; $intCount++)
						{
							echo "note[".($intCount + 1)."] = \"".preg_replace('/\r\n/', '<br />', htmlspecialchars($styleResult[$intCount]['Intro']))."\";"."\n";
						}
					?>    
          document.getElementById("div2tpl").innerHTML = note[notekey];
        }
        //-->
      </script>
      <div style="border: 1px solid rgb(127, 157, 185); overflow: auto; background-color: rgb(247, 247, 247); height: 120px;" id="divtpl">
        <table>
        <tbody>
          <tr>
            <td valign="top" style="border: 0pt none ; background: rgb(247, 247, 247) none repeat scroll 0%; -moz-background-clip: -moz-initial; -moz-background-origin: -moz-initial; -moz-background-inline-policy: -moz-initial;">
              <div style="overflow: auto;" id="div1tpl">
                <input type="radio" name="Tpl" id="Tpl0" value="data" onclick="showtplnote(0)" checked="checked" <?php if(!isset($BlockSetting['Tpl']) || isset($BlockSetting['Tpl']) && $BlockSetting['Tpl'] == "data")echo 'checked="checked"'; ?> /> <label for="Tpl0">只获取数据</label><br/>
								<?php
                  for($intCount = 0; $intCount < $styleResultCount; $intCount++)
                  {
										$strChecked = (isset($BlockSetting['Tpl']) && $BlockSetting['Tpl'] == $styleResult[$intCount]['FileName']) ? 'checked="checked"' : '';
                    echo "<input type=\"radio\" name=\"Tpl\" id=\"Tpl".($intCount + 1)."\" value=\"".$styleResult[$intCount]['FileName']."\" onclick=\"showtplnote(".strval($intCount + 1).")\" $strChecked /> <label for=\"Tpl".($intCount + 1)."\">".$styleResult[$intCount]['StyleTitle']."</label><br/>"."\n";
                  }
                ?> 
              </div>
            </td>
            <td valign="top" style="border: 0pt none ; background: rgb(247, 247, 247) none repeat scroll 0%; -moz-background-clip: -moz-initial; -moz-background-origin: -moz-initial; -moz-background-inline-policy: -moz-initial;">
              <div id="div2tpl" style="padding: 0.3em; overflow: auto; background-color: rgb(255, 252, 204);">
              	<?php
									if(!isset($BlockSetting['Tpl']) || isset($BlockSetting['Tpl']) && $BlockSetting['Tpl'] == "data")
									{
										echo '风格作用:获取数据集合到用户指定的模块变量中<br />展示方式:无<br />使用说明:用户可以在模板页面中利用获取到的<br />模块变量 $_BLOCK[变量名] 自由设置展示方式';
									}
									else
									{
										for($intCount = 0; $intCount < $styleResultCount; $intCount++)
										{
											if($BlockSetting['Tpl'] == $styleResult[$intCount]['FileName'])
											{
												echo preg_replace('/\r\n/', '<br />', htmlspecialchars($styleResult[$intCount]['Intro']));
											}
										}										
									}
								?>
                
              </div>
            </td>
          </tr>
        </tbody>
        </table>
      </div>
    </td>
  </tr>
  
  <tr id="tr_tplname">
    <th>自己输入模块风格文件<p>如果上面列表中没有您需要的模块风格文件，您可以自己指定自己的模块风格文件地址。模块风格文件必须先上传，并放置于block目录下面，后缀为.html.php</p></th>
    <td>目录名: /block/<br />文件名: <input type="text" name="FileName" size="30" value="<?php if(isset($BlockSetting['FileName']))echo $BlockSetting['FileName']; ?>" />.html.php
    </td>
  </tr>
  
  </tbody></table>

</div>

<div class="buttons">
  <input type="submit" value="提交保存" class="submit" />
  <input type="reset" value="重置" />
</div>
</form>

<br />
<?php include "../bottom.php"; ?>
</div>

</body>
</html>