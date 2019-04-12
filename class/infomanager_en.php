<?php
/**
 *    @Note:Conventional enterprise stand base class
 *    @author:    Haibo
 *    @time: 2010.11.16
 *    @email:zhonghaibo2@126.com 
 */
if( !class_exists('mysqldb') )
{
	require_once(dirname(__FILE__)."/../config.inc.php");
	include_once(CFG_LIB_DIR.'mysqldb.inc.php');
}
/*  导入分页数据 */
include_once(CFG_LIB_DIR.'num_page.php');

class Info extends mysqldb
{
   var $cateid;	
	
	 /* 获取关于企业（我们）左边栏二级菜单 */
   function getAboutMenu($cateid)
   {
	 	$SQL="SELECT * FROM `hy_b_infocategory` where ParentID='$cateid'   order by `SortNum` asc,`InfoCategoryID`  desc ";
        $result=$this->commonQuery($SQL);
	  	 return $result;
   }
   
   	 /* 获取新闻类别单条信息 */
   function getAboutNews($cateid)
   {
	  	$SQL="SELECT * FROM `hy_b_info` where CateID='$cateid' and Lang='en' limit 1 ";
        $result=$this->commonQuery($SQL);
	  	 return $result;
   }
   
     /* 获取新闻单条信息 */
   function getNewsOne($id)
   {
   		$SQL="update  `hy_b_info` set `Clicks`=Clicks+1 where `InfoID`='$id'  ";
		parent::query($SQL);
	  	$SQL="SELECT * FROM `hy_b_info` where InfoID='$id' and Lang='en' ";
        $result=$this->commonQuery($SQL);
	  	 return $result;
   }
   
        /* 获取新闻多条条信息 */
   function getNewsMore($cateid,$limit)
   {
	   	$SQL="SELECT * FROM `hy_b_info` where CateID='$cateid' and Lang='en' and $limit  ";
        $result=$this->commonQuery($SQL);
	  	return $result;
   }
   
   	 /* 获取新闻导航栏信息 */
   function getLinks($cateid)
   {
	   $SQL="SELECT * FROM `hy_b_infocategory` where InfoCategoryID ='$cateid'    order by `SortNum` asc,`InfoCategoryID` desc";
	   $result=$this->commonQuery($SQL);
	   return $result[0][CateNameEn];
   }
   
      	 /* 获取新闻导航栏信息 */
   function getEnLinks($cateid)
   {
	   $SQL="SELECT `CateNameEn` FROM `hy_b_infocategory` where InfoCategoryID ='$cateid'    order by `SortNum` asc,`InfoCategoryID` desc";
	   $result=$this->commonQuery($SQL);
	   return $result[0][CateNameEn];
   }
   
   	/* 获得信息列表 */
     function getNewList($infocateid,$pagesize)
  {
		 $countSql="SELECT * FROM hy_b_info  where Lang='en'  and `CateID`=".$infocateid; //sql语句
		$pageSize=$pagesize; //每页显示数
		$curPage=@$_GET['curPage'];//通过GET传来的当前页数
	   // $urlPara="id=".$id."&cateid=".$cid;//这是URL后面跟的参数，也就是问号传值
		
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
  
  /**
   * @Note:The following product release system for public methods
   * @Authour:ZhongHaibo
   * @Email:zhonghaibo2@126.com
   * @Time:2010.11.17
   */
   
   	 /* 产品左边栏二级菜单 */
   function getProMenu($cateid)
   {
		$SQL="SELECT * FROM `hy_b_sys_procategory`  where ParentID ='$cateid' order by `SortNum` asc,`SysProCategoryID`  desc ";        		        $result=$this->commonQuery($SQL);
	  	return $result;
   }
   
      	 /* 获取产品导航栏信息 */
   function getProLinks($cateid)
   {
	   $SQL="SELECT * FROM `hy_b_sys_procategory`  where SysProCategoryID = '$cateid' order by `SortNum` asc,`SysProCategoryID`  desc";
	   $result=$this->commonQuery($SQL);
	   return $result[0][CateNameEn];
   }
   
   
      	 /* 获取产品单条信息 */
   function getProOne($pid)
   {
		$SQL="update  `hy_b_sys_products` set `Clicks`=Clicks+1 where `SysProductsID`='$pid'";
		parent::query($SQL);
	    $SQL="SELECT * FROM `hy_b_sys_products` where SysProductsID='$pid'";
		$result=$this->commonQuery($SQL);
		return $result;
   }
      	 /* 获取订购产品单条信息 */
   function getProOrderOne($pid,$limit)
   {
		$SQL="update  `hy_b_sys_products_order` set `Clicks`=Clicks+1 where `SysProductsID`='$pid' limit 0,$limit ";
		parent::query($SQL);
	    $SQL="SELECT * FROM `hy_b_sys_products_order` where SysProductsID='$pid'";
		$result=$this->commonQuery($SQL);
		return $result;
   } 
          /* 获取订购产品多条信息 */
   function getProOrderMore($procateid,$limit)
   {
	   	$SQL="SELECT * FROM `hy_b_sys_products_order` where Lang='en'  and `CateID`='$procateid' and Unit>0 limit 0, $limit";//sql语句
         $result=$this->commonQuery($SQL);
	  	return $result;
   }
        /* 获取产品多条信息 */
   function getProMore($procateid,$limit)
   {
	   	$SQL="SELECT * FROM `hy_b_sys_products` where Lang='en'  and `CateID`='$procateid' limit 0, $limit";//sql语句
         $result=$this->commonQuery($SQL);
	  	return $result;
   }
  
	   //获得产品列表
	  function getProductList($procateid){
	 			
             $countSql="SELECT * FROM  `hy_b_sys_products` where Lang='en'  and `CateID`=".$procateid;//sql语句
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
	  
	  	   //获得预订产品列表
	  function getProductOrderList($procateid){
	 			
             $countSql="SELECT * FROM  `hy_b_sys_products_order` where Lang='en' and Unit>0  and `CateID`=".$procateid;//sql语句
            $pageSize="12"; //每页显示数
            $curPage=@$_GET['curPage'];//通过GET传来的当前页数
           // $urlPara="id=".$id."&cid=".$cid;//这是URL后面跟的参数，也就是问号传值
            
            $pageOutStr=reterPageStrSam($pageSize,$curPage,$countSql,$urlPara);
            $pageOutStrArr=explode("||",$pageOutStr);
            $rsStart=$pageOutStrArr[0];//limit 后的第一个参数
            $pageStr=$pageOutStrArr[2];//limit 后的第二个参数
            $pageCount=$pageOutStrArr[1];//总页数
            $sql = "SELECT * FROM  hy_b_sys_products_order  where   Lang='en' and Unit>0  and `CateID` ='$procateid' order by SysProductsID DESC limit $rsStart, $pageSize";
            //$res = mysql_query($sql);
			$objDb = new mysqldb();
            $objDb->query($sql);
            $row1=$objDb->get_data();
			$doublelist=array("page"=>$pageStr,"list"=>$row1);
			return $doublelist;
  		
	  }
	  
   
    /* 本类中公共调用的查询语句方法*/
   function commonQuery($SQL)
   { 
   		parent::query($SQL);
		$result = parent::get_data();
        if($result)
		{
		   return  $result;
        }
		else
		{
            // echo "没有内容！";
			//var_dump($result);
        }
   
   }
}