<?php


	include_once(CFG_LIB_DIR.'num_page2.php');

	class Bobay{

		//获得单条信息
		function getAboutList($cateid){
		
		  	$strSQL="SELECT * FROM `hy_b_info` where `CateID`='$cateid' and Lang='en'  order by   SortNum ASC ,PublishDate desc  LIMIT 0,1";
			$objDb = new mysqldb();
			$objDb->query($strSQL);
		return	$Result = $objDb->get_data();
        
	}
	
	
			//获得单条信息
		function getNewShow($id){
		
		 	$strSQL="SELECT * FROM `hy_b_info` where `InfoID`='$id' and Lang='en'  ";
			$objDb = new mysqldb();
			$objDb->query($strSQL);
		return	$Result = $objDb->get_data();
        
	}
	
	
	   //获得信息列表
	  function getNewList($infocateid,$pagesize){
	 			
            $countSql="SELECT * FROM hy_b_info  where Lang='en'  and `CateID`=".$infocateid; //sql语句
            $pageSize=$pagesize; //每页显示数
            $curPage=@$_GET['curPage'];//通过GET传来的当前页数
           // $urlPara="id=".$id."&cid=".$cid;//这是URL后面跟的参数，也就是问号传值
            
            $pageOutStr=reterPageStrSam($pageSize,$curPage,$countSql,$urlPara);
            $pageOutStrArr=explode("||",$pageOutStr);
            $rsStart=$pageOutStrArr[0];//limit 后的第一个参数
            $pageStr=$pageOutStrArr[2];//limit 后的第二个参数
            $pageCount=$pageOutStrArr[1];//总页数
            $sql = "select * FROM  hy_b_info where   Lang='en'  and CateID ='$infocateid' order by InfoID DESC limit $rsStart, $pageSize";
            //echo $sql;
            //$res = mysql_query($sql);
			$objDb = new mysqldb();
            $objDb->query($sql);
            $row1=$objDb->get_data();
			$doublelist=array("page"=>$pageStr,"list"=>$row1);
			return $doublelist;
  		
	  }
	
	
	   //获得产品列表
	  function getProductList($procateid){
	 			
            $countSql="SELECT * FROM  `hy_b_sys_products`  Lang='en'  and  where `CateID`=".$procateid;//sql语句
            $pageSize="12"; //每页显示数
            $curPage=@$_GET['curPage'];//通过GET传来的当前页数
           // $urlPara="id=".$id."&cid=".$cid;//这是URL后面跟的参数，也就是问号传值
            
            $pageOutStr=reterPageStrSam($pageSize,$curPage,$countSql,$urlPara);
            $pageOutStrArr=explode("||",$pageOutStr);
            $rsStart=$pageOutStrArr[0];//limit 后的第一个参数
            $pageStr=$pageOutStrArr[2];//limit 后的第二个参数
            $pageCount=$pageOutStrArr[1];//总页数
            $sql = "SELECT * FROM  hy_b_sys_products  where   Lang='en'  and `CateID` ='$procateid' order by SysProductsID DESC limit $rsStart, $pageSize";
            //$res = mysql_query($sql);
			$objDb = new mysqldb();
            $objDb->query($sql);
            $row1=$objDb->get_data();
			$doublelist=array("page"=>$pageStr,"list"=>$row1);
			return $doublelist;
  		
	  }
	  
	  
	  	   //获得产品类别列表
	  function getProductCateList($procateid){
	 			
            $countSql="SELECT * FROM  `hy_b_sys_procategory`  where `ParentID`=".$procateid;//sql语句
            $pageSize="12"; //每页显示数
            $curPage=@$_GET['curPage'];//通过GET传来的当前页数
           // $urlPara="id=".$id."&cid=".$cid;//这是URL后面跟的参数，也就是问号传值
            
            $pageOutStr=reterPageStrSam($pageSize,$curPage,$countSql,$urlPara);
            $pageOutStrArr=explode("||",$pageOutStr);
            $rsStart=$pageOutStrArr[0];//limit 后的第一个参数
            $pageStr=$pageOutStrArr[2];//limit 后的第二个参数
            $pageCount=$pageOutStrArr[1];//总页数
            $sql = "SELECT * FROM  hy_b_sys_procategory  where  `ParentID` ='$procateid' order by SysProCategoryID DESC limit $rsStart, $pageSize";
            //$res = mysql_query($sql);
			$objDb = new mysqldb();
            $objDb->query($sql);
            $row1=$objDb->get_data();
			$doublelist=array("page"=>$pageStr,"list"=>$row1);
			return $doublelist;
  		
	  }
	  
	  
	  
	  	//获得产品单条信息
		function getProductShow($proid){
		
		 	$strSQL="SELECT * FROM `hy_b_sys_products` where `SysProductsID`='$proid' and Lang='en'  ";
			$objDb = new mysqldb();
			$objDb->query($strSQL);
			return	$Result = $objDb->get_data();
        
	}
	
	
	
}


?>