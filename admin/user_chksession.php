<?php
	session_start();
	header("content-type:text/html; charset=utf-8");
	if (!isset($_SESSION['ad_id']))
	{
		echo "<script>
		alert('您没有登录或不是管理员，请重新登录！')
		top.location.href='../index.php'
		</script>";
		exit();
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
?>