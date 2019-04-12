<?php
	if( !class_exists('clsOperationBase') )
	{
		require_once(dirname(__FILE__)."/../config.inc.php");
		include_once(CFG_LIB_DIR.'operation.php');
	}
	
	class clsAddModify extends clsOperationBase
	{
		public function vodExecute($p_strAction, $p_strSQL, $p_strSucceedUrl)
		{
			switch ($p_strAction)
			{
				case "add":
					$result = parent::query($p_strSQL);
					if($result)
						parent::popup('恭喜你添加成功', $p_strSucceedUrl);
					else
						parent::popup('对不起，添加失败');
					break;
					
				case "modify":
					$result = parent::query($p_strSQL);
					if($result)
						parent::popup('恭喜你修改成功', $p_strSucceedUrl);
					else
						parent::popup('对不起，修改失败');
					break;					
			}
		}
	}
?>