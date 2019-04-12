<?php
	if( !class_exists('mysqldb') )
	{
		require_once(dirname(__FILE__)."/../config.inc.php");
		include_once(CFG_LIB_DIR.'mysqldb.inc.php');
	}
	
	class clsResearch extends mysqldb
	{
		function GetResearch($CateID)
		{			
			$strSQL = "SELECT sortName FROM `".con_strPREFIX."researchcategory` WHERE id = ".$CateID;
			parent::query($strSQL);
			$voteSortResult = parent::get_data();
			$questionSort = $voteSortResult[0]['sortName'];
			
			$strSQL = "SELECT * FROM `".con_strPREFIX."research` WHERE vote_sort = ".$CateID." and inq_all = 1 order by inq_order";
			parent::query($strSQL);
			$questionTitleResult = parent::get_data();
			$questionTitleCount = parent::get_num1();
			
			for($intTCount = 0; $intTCount < $questionTitleCount; $intTCount++)
			{
				$questionArray[$intTCount]['title'] = $questionTitleResult[$intTCount]['inq_title']; //存放问题的数组
				$questionArray[$intTCount]['selectType'] = $questionTitleResult[$intTCount]['radio'];				//存放选项类型的数组
				$questionArray[$intTCount]['textboxType'] = $questionTitleResult[$intTCount]['textbox'];			//存放'其它'框类型的数组
			
				$strSQL = "SELECT * FROM `".con_strPREFIX."research` WHERE inq_title_id  = ".$questionTitleResult[$intTCount]['id']." ORDER BY id";
				parent::query($strSQL);
				$questionResult = parent::get_data();
				$questionCount = parent::get_num1();
				
				//显示问题答案选项******************************************************************************************************
				switch($questionTitleResult[$intTCount]['radio'])
				{
					case "no":
						break;
						
					case "radio":
						for($intQCount = 0; $intQCount < $questionCount; $intQCount++)
						{
							$selectArray[$intTCount][$intQCount]['option'] = '<input type="radio" name="voteChoice'.$intTCount.'" value="'.$questionResult[$intQCount]['id'].'" />';
							$selectArray[$intTCount][$intQCount]['optionTips'] = $questionResult[$intQCount]['inq_content'];
						}
						$choiceArray[count($choiceArray)] = $intTCount;
						break;
						
					case "check":
						for($intQCount = 0; $intQCount < $questionCount; $intQCount++)
						{
							$selectArray[$intTCount][$intQCount]['option'] = '<input type="checkbox" name="voteChoice'.$intTCount.'" value="'.$questionResult[$intQCount]['id'].'" />';
							$selectArray[$intTCount][$intQCount]['optionTips'] = $questionResult[$intQCount]['inq_content'];
						}
						$choiceArray[count($choiceArray)] = $intTCount;
						break;
				}
				
				//显示'其它'框******************************************************************************************************
				switch($questionTitleResult[$intTCount]['textbox'])
				{
					case "no":
						$questionArray[$intTCount]['textbox'] = "no";
						break;
						
					case "normal":
						$questionArray[$intTCount]['textbox'] = '<input type="text" name="answer[]" value="" id="textbox'.$questionTitleResult[$intTCount]['id'].'" class="answerNormalText" /><input type="hidden" name="answerID[]" value="'.$questionTitleResult[$intTCount]['id'].'" />';
						$questionArray[$intTCount]['textboxTips'] = $questionResult[0]['tips'];
						break;
						
					case "big":
						$questionArray[$intTCount]['textbox'] = '<textarea name="answer[]" id="textbox'.$questionTitleResult[$intTCount]['id'].'" class="answerBigText"></textarea><input type="hidden" name="answerID[]" value="'.$questionTitleResult[$intTCount]['id'].'" />';
						$questionArray[$intTCount]['textboxTips'] = $questionResult[0]['tips'];
						break;
				}
			}
			
			$strChoice = (count($choiceArray) > 0) ?  ",".implode(",", $choiceArray) : "";
			$getPostValueFunction = '<script type="text/javascript">
																function getVotePostStr(formObj)
																{
																	var f = formObj;
																	var selectedVoteArray = new Array();
																	var choiceArray = new Array(-2, -1'.$strChoice.');
																	
																	if(choiceArray.length > 2)
																	{
																		for(var intChoiceCount = 2; intChoiceCount < choiceArray.length; intChoiceCount++)
																		{
																			flag = false;
																			var choice = eval("f.voteChoice" + choiceArray[intChoiceCount]);
																			for(var intKeyCount = 0; intKeyCount < choice.length; intKeyCount++)
																			{
																				if(choice[intKeyCount].checked == true)
																				{
																					flag = true;
																					selectedVoteArray[selectedVoteArray.length] = choice[intKeyCount].value;
																				}
																			}
																			if(flag == false)
																			{
																				alert("必须选中其中的一个项!");
																				return false;
																			}
																		}
																	}
																	
																	f.action = "research_save.php?cid='.$CateID.'&id=" + encodeURI(encodeURI(selectedVoteArray.join(",")));
																	return true;
																}
																</script>';
			
			//返回值 检测问卷答案函数, 问卷名称, 调查问题, 选项
			return array("getPostValueFunction" => $getPostValueFunction, "questionSort" => $questionSort, "questionArray" => $questionArray, "selectArray" => $selectArray);
		}
	}
?>