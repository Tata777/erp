<?php
	class clsFile
	{
		/**************************************************************
		depiction：用于锁定文件
		@param strFileName 锁定文件名
		@returns void
		Creater：sun
		Create Date：2007-12-15
		***************************************************************/
		public function vodLock($strFileName)
		{
			ignore_user_abort(true);
			
			$intCount = 0;
			
			do
			{
				sleep($intCount * $intCount);
				
				$blnSuccess = @mkdir("{$strFileName}.dirlock");
			}
			while(!($blnSuccess) && ($intCount++ < 2));
			
			if($intCount == 11)
			{
				die("错误：无法锁定文件！");
			}
		}
		
		/**************************************************************
		depiction：用于消除文件锁定
		@param strFileName 解除锁定文件名
		@returns void
		Creater：sun
		Create Date：2007-12-15
		***************************************************************/
		public function vodUnLock($strFileName)
		{
			if(!(rmdir("{$strFileName}.dirlock")))
			{
				dir("错误：无法消除文件锁！");
			}
			
			ignore_user_abort(false);
		}
		
		/**************************************************************
		depiction：用于写入文件,写入前会锁定文件,写入完毕后消除文件锁定
		@param strFileName 文件名
		@param strContent 需要写入文件的内容
		@returns void
		Creater：sun
		Create Date：2007-12-15
		***************************************************************/		
		public function vodWriteFile($strFileName, $strContent)
		{
			$this->vodLock($strFileName);
			file_put_contents($strFileName, $strContent);
			$this->vodUnLock($strFileName);			
		}
	}
?>