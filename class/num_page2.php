<?php
	function reterPageStrSam($pageSize,$curPage,$countSql,$pagePara){ 
			 mysql_query("SET NAMES 'uft8'"); 
			 $result = mysql_query($countSql);
			 $rsCount  = @mysql_num_rows($result);
			 $pageCount=ceil($rsCount/$pageSize);
			
			 if (!isset($curPage)) $curPage=1;
			 if($curPage<=1) $curPage=1;
			  if(empty($curPage)) $curPage=1;
	
			 if($curPage>=$pageCount) $curPage=$pageCount;
			 $rsStart=(int)($curPage-1)*$pageSize;
			 if($rsStart<0)
			 {
				$rsStart = 0;
			 }
			if($curPage==0) $curPage=1;
			 $pageStr=outPageListSam($pageCount,$curPage,$pagePara);
			 $outStr=$rsStart."||". $pageCount."||".$pageStr."||".$rsCount;
			 return $outStr;
	}
	function outPageListSam($pageCount,$curPage,$pagePara){ 
			 $pageListNum=10;
			 $step=5;
			 $pageStr=""; 
			 $prePage=$curPage-1;
			 $nextPage=$curPage+1; 
			 $pageFromNum=$curPage-$step;
			 $pageToNum=$curPage+$step;
		if($pageCount<$step){
			  $pageFromNum=1;
			  $pageToNum=$pageCount;
		}else if($pageCount<$pageListNum){
			  $pageFromNum=1;
			  $pageToNum=$pageCount;
		} else if ($pageToNum>$pageCount){ 
			  $pageToNum=$pageCount;
				 if(($pageToNum-$pageFromNum)<$pageListNum){
						  $pageFromNum=$pageToNum-$pageListNum+1;
				 }
		}else{
				if($pageFromNum<1){
						   $pageFromNum=1;
						   $pageToNum=$curPage+$step-1;
				}
	}
	 /*开始输出 */
	 $pageStr.=" 
	 <style>
	 /*分页样式*/
	DIV.scott {
		PADDING-RIGHT: 3px; PADDING-LEFT: 3px; PADDING-TOP: 3px; TEXT-ALIGN: center
	}
	DIV.scott A {
		MARGIN-RIGHT: 5px; PADDING-TOP: 2px; TEXT-DECORATION: none; COLOR: #000;
	}
	DIV.scott SPAN.current {
		 PADDING-RIGHT: 5px; PADDING-TOP: 2px; font-weight:bold;
	}
	DIV.scott SPAN.disabled {
		BORDER-RIGHT: #f3f3f3 1px solid; PADDING-RIGHT: 5px; BORDER-TOP: #f3f3f3 1px solid; PADDING-LEFT: 5px; PADDING-BOTTOM: 2px; BORDER-LEFT: #f3f3f3 1px solid; COLOR: #ccc; MARGIN-RIGHT: 2px; PADDING-TOP: 2px; BORDER-BOTTOM: #f3f3f3 1px solid
	}
	 </style>
	 <div class=\"scott\">
		";
	  $curPage!=1?$pageStr.="<a href=?curPage=1&$pagePara> Up </a>":$pageStr.="<a href='javascript:void(0);'> Up</a>";
	 for($i=$pageFromNum;$i<=$pageToNum;$i++){
		$curPage==$i ? $pageStr.="<span class='current'>$i</span>" : 
		$pageStr.="<a href=?curPage=$i&$pagePara>$i</a>";
	  }  
		$curPage!=$pageCount ? $pageStr.="<a href=?curPage=$nextPage&$pagePara> Next</a>" : 
		$pageStr.="<a href='javascript:void(0);'> Next </a>";
	 $pageStr.="</div>";
	
	 /*输出分页结束 */ 
	 return $pageStr;
	}
?> 