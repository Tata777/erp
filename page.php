<?
  	function _PAGEFT($totle, $displaypg = 20, $url = '') {

		global $page, $firstcount, $pagenav, $_SERVER;
		$page = $_GET['page'];
		$GLOBALS["displaypg"] = $displaypg;

		if (!$page)
			$page = 1;
		if (!$url) {
			$url = $_SERVER["REQUEST_URI"];
		}

		//URL分析：
		$parse_url = parse_url($url);
		$url_query = $parse_url["query"]; //单独取出URL的查询字串
		if ($url_query) {
			$url_query = ereg_replace("(^|&)page=$page", "", $url_query);
			$url = str_replace($parse_url["query"], $url_query, $url);
			if ($url_query)
				$url .= "&page";
			else
				$url .= "page";
		} else {
			$url .= "?page";
		}
		$lastpg = ceil($totle / $displaypg); //最后页，也是总页数
		$page = min($lastpg, $page);
		$prepg = $page -1; //上一页
		$nextpg = ($page == $lastpg ? 0 : $page +1); //下一页
		$firstcount = ($page -1) * $displaypg<0?0:($page -1) * $displaypg;

		//开始分页导航条代码：
		//$pagenav = "显示第 <B>" . ($totle ? ($firstcount +1) : 0) . "</B>-<B>" . min($firstcount + $displaypg, $totle) . "</B> 条记录，共 $totle 条记录";

		//如果只有一页则跳出函数：
		if ($lastpg <= 1)
			return false;

		//$pagenav .= " <a href='$url=1'>首页</a> ";
		if ($prepg)
			$pagenav .= "<a class=\"prev\"  href='$url=$prepg'>&lt;</a>    ";
		else
			$pagenav .= " <a class=\"prev\"  >&lt;</a>   ";
			
			
			for ($i = 1; $i <= $lastpg; $i++) {
			if ($i == $page)
				$pagenav .= " <a href=\"#\" class=\"active\">$i<b></b></a>";
			else
				$pagenav .= "<a href='$url=$i'>$i<b></b></a>";
		} 
			
			
		if ($nextpg)
			$pagenav .= "   <a class=\"next\"  href='$url=$nextpg'>&gt;</a> ";
		else
			$pagenav .= " <a class=\"next\">&gt;</a>";
		//$pagenav .= " <a href='$url=$lastpg'>尾页</a> ";

		//下拉跳转列表，循环列出所有页码：
 //$pagenav .= "　到第 <select name='topage' size='1' onchange='window.location=\"$url=\"+this.value'>\n";
	 
		
		//$pagenav .= "</select> 页，共 $lastpg 页";
	}

?>
