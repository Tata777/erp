<?php
	class check_ifno
	{
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