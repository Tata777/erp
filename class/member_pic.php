<?php
require_once(dirname(__FILE__)."/../config.inc.php");

class clsMemberPic
{
		/**************************************************************
		depiction：输出上传图片
		@param p_intTotal 需要输出上传的图片个数
		@param p_intUpDir 上传路径
		@param p_intWidth 图片宽度
		@param p_intHeight 图片高度
		@param p_strElementName 记录图片名的Element Name
		@param p_strCountElementName 记录图片名的元素个数的Element Name
		@param p_strNoImg 没图片时，显示的图片路径
		@param p_strULName UL Element Name
		@param p_strStyle 风格代码
		@param p_strJS JS代码
		@returns string
		Creater：sun
		Create Date：2008-1-4
		***************************************************************/
		public function strAddUploadfile($p_intTotal = 1, $p_intUpDir, $p_intWidth = 100, $p_intHeight = 125, $p_strElementName = 'member_pic', $p_strCountElementName = 'pic_count', $p_strNoImg = '', $p_strULName = 'picUL', $p_strStyle = '', $p_strJS = '')
		{
			$p_strNoImg = ($p_strNoImg) ? $p_strNoImg : '../images/detail_no_pic.gif';
		
			$strOut  = ($p_strJS) ? $p_strJS : '<script type="text/javascript" src="../../Scripts/member_pic.js"></script>';
		
			if($p_strStyle)
			{
				$strOut .= $p_strStyle;
			}
			else
			{
				$strOut .= '<style type="text/css">
										<!--
										#'.$p_strULName.' { padding: 0; margin: 0; }
										#'.$p_strULName.' li { list-style: none; float: left; display: block; margin: 0 5px 10px 0; width: '.$p_intWidth.'px; }
										-->
										</style>';
			}
						
			$strOut .= '<ul id="'.$p_strULName.'">';
			
			for($intCount = 0; $intCount < $p_intTotal; $intCount++ )
			{
				$strOut .= '
					<li>
					<img name="m_'.$p_strElementName.$intCount.'" id="m_'.$p_strElementName.$intCount.'" src="'.$p_strNoImg.'" />
					<input type="hidden" id="h_'.$p_strElementName.$intCount.'" name="'.$p_strElementName.'[]" /><br />
					<input type="button" value="上传" onclick="Uppic(\''.$p_strElementName.'\', \''.$intCount.'\', '.$p_intUpDir.')" />
					<input type="button" value="删除" onclick="Delpic(\''.$p_strElementName.'\', \''.$intCount.'\', \''.$p_strNoImg.'\')" />
					</li>
				';
			}
			
			$strOut .= '</ul>';
			
			$strOut .= '<input type="hidden" name="'.$p_strCountElementName.'" value="'.$p_intTotal.'" />';
			
			return $strOut;
		}
		
		/**************************************************************
		depiction：输出上传图片
		@param p_intTotal 需要输出上传的图片个数
		@param p_strAllPic 已上传的图片，用','隔开
		@param p_intUpDir 上传路径
		@param p_intWidth 图片宽度
		@param p_intHeight 图片高度
		@param p_strElementName 记录图片名的Element Name
		@param p_strCountElementName 记录图片名的元素个数的Element Name
		@param p_strNoImg 没图片时，显示的图片路径
		@param p_strULName UL Element Name
		@param p_strStyle 风格代码
		@param p_strJS JS代码
		@returns string
		Creater：sun
		Create Date：2008-1-4
		***************************************************************/
		public function strModifyUploadfile($p_intTotal = 1, $p_strAllPic = '', $p_intUpDir, $p_intWidth = 100, $p_intHeight = 125, $p_strElementName = 'member_pic', $p_strCountElementName = 'pic_count', $p_strNoImg = '', $p_strULName = 'picUL', $p_strStyle = '', $p_strJS = '')
		{
			global $uploaddirarray;
		
			if($p_strAllPic)
			{
				$picArray = explode(",", $p_strAllPic);
				$picCount = count($picArray);
			}
			else
			{
				$picCount = 0;
			}
			
			$p_strNoImg = ($p_strNoImg) ? $p_strNoImg : '../images/detail_no_pic.gif';
		
			$strOut  = ($p_strJS) ? $p_strJS : '<script type="text/javascript" src="../../Scripts/member_pic.js"></script>';
		
			if($p_strStyle)
			{
				$strOut .= $p_strStyle;
			}
			else
			{
				$strOut .= '<style type="text/css">
										<!--
										#'.$p_strULName.' { padding: 0; margin: 0; }
										#'.$p_strULName.' li { list-style: none; float: left; display: block; margin: 0 5px 10px 0; width: '.$p_intWidth.'px; }
										-->
										</style>';
			}
						
			$strOut .= '<ul id="'.$p_strULName.'">';
			
			if($picCount <= $p_intTotal)
			{
				for($intCount = 0; $intCount < $picCount; $intCount++)
				{
					$strOut .= '
						<li>
						<img name="m_'.$p_strElementName.$intCount.'" id="m_'.$p_strElementName.$intCount.'" src="../../uploadfile/'.$uploaddirarray[$p_intUpDir].'/'.$picArray[$intCount].'" />
						<input type="hidden" id="h_'.$p_strElementName.$intCount.'" name="'.$p_strElementName.'[]" value="'.$picArray[$intCount].'" /><br />
						<input type="button" value="上传" onclick="Uppic(\''.$p_strElementName.'\', \''.$intCount.'\', '.$p_intUpDir.')" />
						<input type="button" value="删除" onclick="Delpic(\''.$p_strElementName.'\', \''.$intCount.'\', \''.$p_strNoImg.'\')" />
						</li>
					';
				}
				for($intCount2 = 0; $intCount2 < $p_intTotal - $picCount; $intCount2++ )
				{
					$strOut .= '
						<li>
						<img name="m_'.$p_strElementName.$intCount.'" id="m_'.$p_strElementName.$intCount.'" src="'.$p_strNoImg.'" />
						<input type="hidden" id="h_'.$p_strElementName.$intCount.'" name="'.$p_strElementName.'[]" /><br />
						<input type="button" value="上传" onclick="Uppic(\''.$p_strElementName.'\', \''.$intCount.'\', '.$p_intUpDir.')" />
						<input type="button" value="删除" onclick="Delpic(\''.$p_strElementName.'\', \''.$intCount.'\', \''.$p_strNoImg.'\')" />
						</li>
					';
					
					$intCount++;
				}
			}
			else
			{
				return $this->strAddUploadfile($p_intTotal, $p_intUpDir, $p_intWidth, $p_intHeight, $p_strElementName, $p_strCountElementName, $p_strNoImg, $p_strULName, $p_strStyle, $p_strJS);
			}
			
			$strOut .= '</ul>';
			
			$strOut .= '<input type="hidden" name="'.$p_strCountElementName.'" value="'.$p_intTotal.'" />';
			
			return $strOut;
		}
		
		/**************************************************************
		depiction：获得上传图片
		@param p_strElementName 记录图片名的Element Name
		@param p_strCountElementName 记录图片名的元素个数的Element Name
		@returns string
		Creater：sun
		Create Date：2008-1-5
		***************************************************************/
		public function arrGetPic($p_strElementName, $p_strCountElementName)
		{
			$picArray = array();	
			$arrayLength = $_POST[$p_strCountElementName];
			
			$strTitle = "";
			$strPic = "";
			
			if($arrayLength > 0)
			{
				for($intCount = 0; $intCount < $arrayLength; $intCount++)
				{
					if(!empty($_POST[$p_strElementName][$intCount]))
					{
						array_push($picArray, $_POST[$p_strElementName][$intCount]);
					}
				}
			}
			
			if(count($picArray) > 0)
			{			
				return array("strFirstPic" => $picArray[0], "strAllPic" => implode(",", $picArray));
			}
			else
			{			
				return array("strFirstPic" => '', "strAllPic" => '');
			}
		}
}
?>