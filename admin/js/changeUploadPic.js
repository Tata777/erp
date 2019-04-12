function changeImg(strInput, strPic, strImgName, strDir)
{
	try
	{
		var second = (new Date()).getSeconds();
		var targetImg = document.getElementById(strPic);
		targetImg.setAttribute("src", "../../uploadfile/" + strDir + "/" + strImgName + '?' + second);
		targetImg.onload = function () { if(targetImg.width > 104)targetImg.width = 104; }
	}
	catch(e)
	{
		//do nothing!
	}
	
	try
	{
		document.getElementById(strInput).setAttribute("value", strImgName);
		//document.getElementById(down).setAttribute("value", downUploadSize);
	}
	catch(e)
	{
		//do nothing!
	}
}