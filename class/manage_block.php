<?php
	if( !class_exists('clsOperationBase') )
	{
		require_once(dirname(__FILE__)."/../config.inc.php");
		include_once(CFG_LIB_DIR.'operation.php');
	}
	
	class clsManageBlock extends clsOperationBase
	{
		public $arrBlockCate = array(); //存放各类Block的显示设置
		
		public $arrCodeKey = array(
															 "SysCateType", "SubSysCate", "SubCate", "IsAuditing", "MemberID", "IsMemberID", "IsMember","ParentID", "ShowCategory",  "ShowSpecial", "ShowSndType", "ShowMemberDetail", "VarName", "Tpl", "FileName"
															);
																	
		function __construct()
		{
			parent::__construct();
			$this->arrBlockCate["info"] = array(
																		 "strCateTable" => "infocategory",
																		 "strSpeCateTable" => "specialcate",
																		 "arrFilter" => array(																		 
																										 "NormalCate",
																										 "SpecialCate",
																										 "CreateTime",
																										 "StartTime",
																										 "SortNum",
																										 "TopNum",
																										 "ExtractNum",
																										 "IsAuditing",
																										 "Lang",
																										 "HasImg"
																										),
																		 "arrOrder" => array(
																		 								array("i.CreationDate", "创建时间"),
																		 								array("i.PublishDate", "开始时间"),
																		 								array("i.Clicks", "点击率"),
																		 								array("i.SortNum", "排序号"),
																		 								array("i.TopNum", "置顶权值"),
																		 								array("i.ExtractNum", "精华权值")
																									 ),
																		 "arrDisplay"=>array(
																		 								"Subject",
																										"BelongCate",
																										"Intro",
																										"Detail",
																										"BelongSpecial"
																									 )
																		);
			$this->arrBlockCate["supplyndemand"] = array(
																		 "strCateTable" => "sndcategory",
																		 "arrFilter" => array(																		 
																										 "NormalCate",
																										 "SndType",
																										 "StartTime",
																										 "EndTime",
																										 "SortNum",
																										 "IsAuditing",
																										 "HasImg",
																										 "MemberID"
																										),
																		 "arrOrder" => array(
																		 								array("i.PublishDate", "开始时间"),
																		 								array("i.ValidDate", "结束时间"),
																		 								array("i.Clicks", "点击率"),
																		 								array("i.SortNum", "排序号")
																									 ),
																		 "arrDisplay"=>array(
																		 								"Subject",
																										"BelongCate",
																										"ReadSndType",
																										"MemberDetail",
																										"Detail"
																									 )
																		);
			$this->arrBlockCate["sysproduct"] = array(
																		 "strCateTable" => "sys_procategory",
																		 "strSpeCateTable" => "brandcategory",
																		 "arrFilter" => array(																		 
																										 "NormalCate",
																										 "SpecialCate",
																										 "PublishDate",
																										 "SortNum",
																										 "TopNum",
																										 "ExtractNum",
																										 "Lang",
																										 "HasImg"
																										),
																		 "arrOrder" => array(
																		 								array("i.PublishDate", "发布时间"),
																		 								array("i.Clicks", "点击率"),
																		 								array("i.SortNum", "排序号"),
																		 								array("i.TopNum", "置顶权值"),
																		 								array("i.ExtractNum", "精华权值")
																									 ),
																		 "arrDisplay"=>array(
																		 								"Subject",
																										"BelongCate",
																										"Detail",
																										"BelongSpecial"
																									 )
																		);
			$this->arrBlockCate["link"] = array(
																		 "strCateTable" => "linkcategory",
																		 "arrFilter" => array(																		 
																										 "NormalCate",
																										 "PublishDate",
																										 "SortNum",
																										 "IsAuditing",
																										 "Lang",
																										 "HasImg"
																										),
																		 "arrOrder" => array(
																		 								array("i.PublishDate", "发布时间"),
																		 								array("i.SortNum", "排序号")
																									 ),
																		 "arrDisplay"=>array(
																		 								"Subject",
																										"BelongCate"
																									 )
																		);
			$this->arrBlockCate["down"] = array(
																		 "strCateTable" => "downcategory",
																		 "arrFilter" => array(																		 
																										 "NormalCate",
																										 "PublishDate",
																										 "SortNum",
																										 "IsAuditing",
																										 "IsMember",
																										 "Lang",
																										 "HasImg"
																										),
																		 "arrOrder" => array(
																		 								array("i.PublishDate", "发布时间"),
																		 								array("i.SortNum", "排序号")
																									 ),
																		 "arrDisplay"=>array(
																		 								"Subject",
																										"BelongCate"
																									 )
																		);
																		
			$this->arrBlockCate["recruitment"] = array(
																		 "strCateTable" => "recruitmentcategory",
																		 "arrFilter" => array(																		 
																										 "NormalCate",
																										 "PublishDate",
																										 "SortNum",
																										 "IsAuditing",
																										 "Lang",
																										 "HasImg"
																										),
																		 "arrOrder" => array(
																		 								array("i.PublishDate", "发布时间"),
																		 								array("i.SortNum", "排序号")
																									 ),
																		 "arrDisplay"=>array(
																		 								"Subject",
																										"BelongCate"
																									 )
																		);
																			
																			//
																			
																																		
			$this->arrBlockCate["cart_order"] = array(
																		 
																		 "arrFilter" => array(																		 
																										 
																										 "PublishDate",
																										 "IsMemberID"
																										),
																		 "arrOrder" => array(
																		 								array("i.c_date", "订单下单时间"),
																		 								array("i.sn", "排序号")
																									 ),
																		 "arrDisplay"=>array(
																		 								"Subject",
																										"MemberDetail"
																									 )
																		);
																		
																		
																		//
																		
																		
			$this->arrBlockCate["syscate"] = array(
																		 "arrFilter" => array(
																		 								 "SysCate",
																										 "SortNum",
																										 "ParentID"
																										),
																		 "arrOrder" => array(
																		 								array("sc.SysCateID", "默认ID"),
																		 								array("sc.SortNum", "排序号")
																									 ),
																		 "arrDisplay"=>array(
																		 								"Subject",
																										"Intro"
																									 )
																		);
			$this->arrBlockCate["guestbook"] = array(
																		 "arrFilter" => array(																		 
																										),
																		 "arrOrder" => array(
																		 								array("i.guest_date", "发布时间")
																									 ),
																		 "arrDisplay"=>array(
																		 								"Subject",
																										"BelongCate"
																									 )
																		);
																		
			$this->arrBlockCate["research"] = array(
																		 "arrFilter" => array(
																										 "IsAuditing"
																										),
																		 "arrOrder" => array(
																		 								array("i.publishTime", "添加时间"),
																		 								array("i.sortName", "调查标题")
																									 ),
																		 "arrDisplay"=>array(
																		 								"Subject"
																									 )
																		);
		}
	
		public function vodPirntSelector()
		{
			$strSQL = "SELECT `BlockCategoryID`, `CateName`, `CateType` FROM `".con_strPREFIX."blockcategory` WHERE `IsDisplay` = 1 ORDER BY `SortNum`";
			parent::query($strSQL);
			$Result = parent::get_data();
		
			$strOut = "<style type=\"text/css\">
									ul.BlockCateUL { margin: 0; padding: 0; }
									ul.BlockCateUL li { margin: 0; padding: 0; width: 20%; list-style-type: none; display:block; float: left; line-height: 24px; }
								 </style>"."\n";
			
			$strOut .= "<table class=\"maintable\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"margin: 20px 0;\">"."\n";
			$strOut .= "<tr id=\"tr_\"><th width=\"200\">选择基本模块</th>"."\n";
			$strOut	.= "<td><ul class=\"BlockCateUL\">"."\n";
			
			if(is_array($Result))
			{
				foreach($Result as $Record)
				{
					$strCateName = ($Record['BlockCategoryID'] == $_GET['cid']) ? "<strong>".$Record['CateName']."</strong>" : $Record['CateName'];
					$strOut .= "<li><img src=\"../images/icon_arrow.gif\" /> <a href=\"?act=".$_GET['act']."&cid=".$Record['BlockCategoryID']."&ctype=".$Record['CateType']."\">$strCateName</a></li>"."\n";					
				}
			}
			
			$strOut	.= "</ul></td>"."\n";
			$strOut	.= "</tr>"."\n";
			$strOut	.= "</table>"."\n";
			
			echo $strOut;
		}
	
		public function vodPirntRadioSelector($p_strSelectID = "")
		{
			$strSQL = "SELECT `BlockCategoryID`, `CateName`, `CateType` FROM `".con_strPREFIX."blockcategory` WHERE `IsSysCate` = 1 ORDER BY `SortNum`";
			parent::query($strSQL);
			$Result = parent::get_data();
						
			$strOut	.= "<ul class=\"BlockCateUL\">"."\n";
			
			if(is_array($Result))
			{
				foreach($Result as $Record)
				{
					$strChecked = ($p_strSelectID == $Record['BlockCategoryID']) ? 'checked="checked"' : "";
					$strOut .= "<li><input type=\"radio\" name=\"SysCateType\" id=\"SysCateType{$Record['BlockCategoryID']}\" value=\"{$Record['CateType']}\" />
  <label for=\"SysCateType{$Record['BlockCategoryID']}\">{$Record['CateName']}</label></li>"."\n";					
				}
			}
			
			$strOut	.= "</ul>"."\n";
			
			echo $strOut;
		}
		
		public function arrGetBlockTextAndCode()
		{
			$arrText = array();
			$arrCode = array();
			foreach($_POST as $key => $value)
			{
				$arrText[$key] = $value;
				$this->vodEstimateCodeKey($arrCode, $key, $value);
			}
			
			$arrReturn = array("Text" => serialize($arrText), "Code" => "&lt;?php\n\t//".$_POST['BlockName']."\n\t\$Block->Get(\'".$_GET['ctype']."\', \'".implode("/", $arrCode)."\', ".$_POST['CacheTime'].");\n?&gt;");
			
			return $arrReturn;
		}
															
		protected function vodEstimateCodeKey(&$arrCode, $key, $value)
		{
			switch($key)
			{
				case "BlockModel":
					if($value == "2")
					{
						array_push($arrCode, "Sql");
						array_push($arrCode, $_POST['SQL']);
					}
					break;
					
				case "SetItemID":
					if($value)
					{
						array_push($arrCode, "ItemID");
						array_push($arrCode, $_POST['ItemID']);
					}
					break;
					
					
				case "SysCateID":
				case "CateID":		
				case "SpecialID":
					array_push($arrCode, $key);
					if(is_array($value))
					{
						array_push($arrCode, implode(",", $value));
					}
					else
					{
						array_push($arrCode, $value);
					}
					break;
				
				case "SndType":
					if($value != "0")
					{
						array_push($arrCode, $key);
						array_push($arrCode, $value);
					}
					break;
				
				case "Lang":
					if($value != "")
					{
						array_push($arrCode, $key);
						array_push($arrCode, $value);
					}
					break;
					
				case "CreateTime":
				case "StartTime":
				case "EndTime":
					if(is_numeric($value) && $value != 0)
					{
						array_push($arrCode, $key);
						array_push($arrCode, $value);
					}
					break;
					
				case "SortNum":
				case "TopNum":
				case "ExtractNum":
					if(is_numeric($value[0]) && is_numeric($value[1]))
					{
						array_push($arrCode, $key);
						array_push($arrCode, implode(",", $value));
					}
					break;
					
				case "HasImg":
					if($value != "NoLimit")
					{
						array_push($arrCode, $key);
						array_push($arrCode, $value);
					}
					break;
					
				case "OrderColumn":
					$arrOrder = array();
					foreach($value as $intIndex => $strColumn)
					{
						if(!empty($strColumn))
						{
							array_push($arrOrder, $strColumn." ".(($_POST["Order"][$intIndex]) ? $_POST["Order"][$intIndex] : "ASC"));
						}
					}
					
					if(count($arrOrder) > 0)
					{
						array_push($arrCode, "Order");
						array_push($arrCode, implode(",", $arrOrder));
					}
					break;
				
				case "SubjectLen":
				case "IntroLen":
				case "MessageLen":
					if(is_numeric($value))
					{
						array_push($arrCode, $key);
						array_push($arrCode, $value);
						
						$arrLen = array("SubjectLen" => "SubjectDot", "IntroLen" => "IntroDot", "MessageLen" => "MessageDot");
						
						array_push($arrCode, $arrLen[$key]);
						array_push($arrCode, $_POST[$arrLen[$key]]);
					}
					break;
				
				case "ShowMultiPage":
					if($value == "1")
					{
						array_push($arrCode, "PerPage");
						array_push($arrCode, $_POST["PerPage"]);
					}
					else
					{						
						if(is_numeric($_POST["Limit"][0]) && is_numeric($_POST["Limit"][1]))
						{
							array_push($arrCode, "Limit");
							array_push($arrCode, implode(",", $_POST["Limit"]));
						}
					}
					break;
			
				default:
					if(in_array($key, $this->arrCodeKey) && trim($value))
					{
						array_push($arrCode, $key);
						array_push($arrCode, $value);
					}
					break;
			}
		}
	}
?>
