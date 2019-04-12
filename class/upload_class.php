<?php
/**************************************************************
depiction：文件上传类
Creater：sun
Create Date：2007-12-4
***************************************************************/
class uploadclass
{
	function upload($strUploadDir, $strImg, $intImgSize, $strTmpFile, $strMimeType, $input, $pic = "", $other = ""
	,$form,$downsize)
	{
		//$uploaddir = "../".UPLOAD_DIR;
		$uploaddir = CFG_WEB_ROOT.UPLOAD_DIR;
		
		//上传路径控制参数
		$mainuploaddir = $uploaddir."/".$strUploadDir."/";
		//echo $strTmpFile;
		/*if (is_dir($mainuploaddir))
			chmod($mainuploaddir,0777);
		else
		{
			mkdir($mainuploaddir);
			chmod($mainuploaddir,0777);
		}*/
		 
		//MIME类型参考http://bbs.blueidea.com/archiver/tid-2195037.html
		$typeArray = array(
								"icon" => "image/x-icon",  
								"gif" => "image/gif",  
								"jpgc" => "image/jpg",
								"png" => "image/png",
								"x-png" => "image/x-png",
								"jpeg" => "image/jpeg", 
								"jpep" => "image/pjpeg", 
								"doc" => "application/msword",
								"swf" => "application/x-shockwave-flash",
								"wmv" => "audio/x-ms-wmv",
								"wmv" => "video/x-ms-wmv",
								"pdf" => "application/pdf",
								"rar" => "application/octet-stream",
								"zip" => "application/x-zip-compressed",
								"rm" => "audio/x-pn-realaudio",
								"rmf" => "audio/x-rmf",
								"rmm" => "audio/x-pn-realaudio",
								"rmvb" => "audio/x-pn-realaudio"
								);
								
			if($intImgSize !=0)
			{
				if ($intImgSize > 8000000 or !in_array($strMimeType, $typeArray))
					$this->popup($strMimeType.'对不起，添加格式不正确(正确格式为GIF,JPG,PNG文件,且不能大于8M)');
				else
				{
					if(move_uploaded_file($strTmpFile, $mainuploaddir.$strImg))
					{
						$strExt = array_search($strMimeType, $typeArray);
						$strExt = preg_replace("/jp[a-zA-Z]+$/i", "jpg", $strExt);
						$strNewName = date("YmdHis").".".$strExt;
						rename($mainuploaddir.$strImg, $mainuploaddir.$strNewName);
						$intUploadSize = $intImgSize / 1024;
	
						echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">
									<script type=\"text/javascript\">\n
										alert('添加成功,上传文件改名为$strNewName');\n
										opener.changeImg('$input', '$pic', '$strNewName', '$strUploadDir');\n";
						if ($other=="true")
					    {
         			    echo "self.opener.document.".$form.".".$downsize.".value='".$intUploadSize."'\n";
		  			    }
						echo	"window.close();\n</script>\n";
						exit();	
					}
					else
						$this->popup("上传失败");
			}
		}
		else
				$this->popup('请选择上传文件');
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