<?php
/**************************************************************
depiction：文件上传类
Creater：sun
Create Date：2007-12-4
***************************************************************/
class uploadclass
{
	function upload($strUploadDir, $strImg, $intImgSize, $strTmpFile, $strMimeType, $input, $pic = "", $other = "")
	{
		$uploaddir = "../".UPLOAD_DIR;
		//上传路径控制参数
		$mainuploaddir = $uploaddir."/".$strUploadDir."/";
	
		/*if (is_dir($mainuploaddir))
			chmod($mainuploaddir,0777);
		else
		{
			mkdir($mainuploaddir);
			chmod($mainuploaddir,0777);
		}*/
		 
		//MIME类型参考http://bbs.blueidea.com/archiver/tid-2195037.html
		$typeArray = array(
								"pdf" => "application/pdf", 
								"xls" => "application/vnd.ms-excel",
								"zip" => "application/octet-stream",
								"doc" => "application/msword"，
								"x-png" => "image/x-png",
								"png" => "image/png",
								);
								
			if($intImgSize !=0)
			{
				if ($intImgSize > 2000000 or !in_array($strMimeType, $typeArray))
					$this->popup('对不起，添加'.$strMimeType.'格式不正确(正确格式为pdf,xls,doc文件,且不能大于2M)');
				else
				{
					if(move_uploaded_file($strTmpFile, $mainuploaddir.$strImg))
					{
						$strExt = array_search($strMimeType, $typeArray);
						$strNewName = date("YmdHis").".".$strExt;
						rename($mainuploaddir.$strImg, $mainuploaddir.$strNewName);
						$intUploadSize = $intImgSize / 1024;
	
						echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">
									<script type=\"text/javascript\">\n
										alert('添加成功,上传图片改名为$strNewName');\n
										opener.changeImg('$input', '$pic', '$strNewName', '$strUploadDir');\n
										window.close();\n
									</script>\n";
						exit();	
					}
					else
						$this->popup("上传失败");
			}
		}
		else
				$this->popup('请选择上传图片');
	}

	function popup($tips,$location='')
	{
		if(!empty($location))
			$location = "window.location.href = '$location'";
		else
			$location = "history.back();";
	
		echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">
					<script type=\"text/javascript\">\n
						alert('$tips');\n
						$location;\n
					</script>\n";
		exit();		
	}
}
?>