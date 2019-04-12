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

    /* 获取新闻信息饼分页 */
    function getNewPage($cateid,$page)
    {
        $SQL="update  `hy_b_info` set `Clicks`=Clicks+1 where `InfoID`='$id'  ";
        parent::query($SQL);
        $SQL="SELECT * FROM `hy_b_info` where InfoID='$id' and Lang='cn' ";
        $result=$this->commonQuery($SQL);
        return $result[0];
    }

	
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
   		$strsql=" UPDATE  `hy_b_info` SET Clicks=Clicks+1 where CateID='$cateid' and Lang='cn' ";
		  $result=$this->commonQuery($strsql);
	   	$SQL="SELECT * FROM `hy_b_info` where CateID='$cateid' and Lang='cn' limit 1 ";
        $result=$this->commonQuery($SQL);
	  	 return $result[0];
   }
   
     /* 获取新闻单条信息 */
   function getNewsOne($id)
   {
   		$SQL="update  `hy_b_info` set `Clicks`=Clicks+1 where `InfoID`='$id'  ";
		parent::query($SQL);
	  	$SQL="SELECT * FROM `hy_b_info` where InfoID='$id' and Lang='cn' ";
        $result=$this->commonQuery($SQL);
	  	 return $result[0];
   }
    /* 获取新闻单条信息 */
    function getEnNewsOne($id)
    {
        $SQL="update  `hy_b_info` set `Clicks`=Clicks+1 where `InfoID`='$id'  ";
        parent::query($SQL);
        $SQL="SELECT * FROM `hy_b_info` where InfoID='$id' and Lang='cn' ";
        $result=$this->commonQuery($SQL);
        return $result[0];
    }

   // 获取link轮播图
       function getNavLinks($cateid,$limit)
   {
	   $SQL="SELECT * FROM `hy_b_link` where CateID ='$cateid' order by SortNum asc limit $limit ";
	   $result=$this->commonQuery($SQL);
	   if($limit ==1) $msg = @$result[0]; else $msg = $result;
	   return $msg;
   }

    /* 获取所有新闻多条信息 */
    function getAllNews($cateid,$limit)
    {
        $SQL="SELECT * FROM `hy_b_info` where CateID like '$cateid%' and Lang='cn' order by `SortNum` asc,InfoID desc limit $limit  ";
        $result=$this->commonQuery($SQL);
        return $result;
    }
    /* En获取所有新闻多条信息 */
    function getEnAllNews($cateid,$limit)
    {
        $SQL="SELECT * FROM `hy_b_info` where CateID like '$cateid%' and Lang='en' order by `SortNum` asc,InfoID desc limit $limit  ";
        $result=$this->commonQuery($SQL);
        return $result;
    }

        /* 获取新闻多条条信息 */
   function getNewsMore($cateid,$limit)
   {
	   	$SQL="SELECT * FROM `hy_b_info` where CateID='$cateid' and Lang='cn' order by `SortNum` asc,InfoID desc limit $limit  ";
        $result=$this->commonQuery($SQL);
	  	return $result;
   }
    /* EN获取新闻多条条信息 */
    function getEnNewsMore($cateid,$limit)
    {
        $SQL="SELECT * FROM `hy_b_info` where CateID='$cateid' and Lang='en' order by `SortNum` asc,InfoID desc limit $limit  ";
        $result=$this->commonQuery($SQL);
        return $result;
    }
   
   	 /* 获取新闻导航栏信息 */
   function getLinks($cateid)
   {
	   $SQL="SELECT * FROM `hy_b_infocategory` where InfoCategoryID ='$cateid'    order by `SortNum` asc,`InfoCategoryID` desc";
	   $result=$this->commonQuery($SQL);
	   return $result[0][CateName ];
   }
   
      	 /* En获取新闻导航栏信息 */
   function getEnLinks($cateid)
   {
	   $SQL="SELECT `CateNameEn` FROM `hy_b_infocategory` where InfoCategoryID ='$cateid'    order by `SortNum` asc,`InfoCategoryID` desc";
	   $result=$this->commonQuery($SQL);
	   return $result[0][CateNameEn ];
   }
   
   	/* 获得信息列表 */
     function getNewList($infocateid,$pagesize)
  {
		 $countSql="SELECT * FROM hy_b_info  where Lang='cn'  and `CateID`=".$infocateid; //sql语句
		$pageSize=$pagesize; //每页显示数
		$curPage=@$_GET['curPage'];//通过GET传来的当前页数
	   // $urlPara="id=".$id."&cateid=".$cid;//这是URL后面跟的参数，也就是问号传值
		
		$pageOutStr=reterPageStrSam($pageSize,$curPage,$countSql,$urlPara);
		$pageOutStrArr=explode("||",$pageOutStr);
		$rsStart=$pageOutStrArr[0];//limit 后的第一个参数
		$pageStr=$pageOutStrArr[2];//limit 后的第二个参数
		$pageCount=$pageOutStrArr[1];//总页数
		$sql = "select * FROM  hy_b_info where   Lang='cn'  and CateID ='$infocateid' order by SortNum asc, InfoID DESC limit $rsStart, $pageSize";
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
		$SQL="SELECT * FROM `hy_b_sys_procategory`  where ParentID ='$cateid' order by `SortNum` asc,`SysProCategoryID`  desc ";        		   
		$result=$this->commonQuery($SQL);
	  	return $result;
   }
   
      	 /* 获取产品导航栏信息 */
   function getProLinks($cateid)
   {
	   $SQL="SELECT * FROM `hy_b_sys_procategory`  where SysProCategoryID = '$cateid' order by `SortNum` asc,`SysProCategoryID`  desc";
	   $result=$this->commonQuery($SQL);
	   return $result[0][CateName];
   }
   
   
      	 /* 获取产品单条信息 */
   function getProOne($pid)
   {
		$SQL="update  `hy_b_sys_products` set `Clicks`=Clicks+1 where `SysProductsID`='$pid'";
		parent::query($SQL);
	    $SQL="SELECT * FROM `hy_b_sys_products` where SysProductsID='$pid' and Lang = 'cn'";
		$result=$this->commonQuery($SQL);
		return $result[0];
   }

    /* En获取产品单条信息 */
    function getEnProOne($pid)
    {
        $SQL="update  `hy_b_sys_products` set `Clicks`=Clicks+1 where `SysProductsID`='$pid'";
        parent::query($SQL);
        $SQL="SELECT * FROM `hy_b_sys_products` where SysProductsID='$pid' and Lang = 'en'";
        $result=$this->commonQuery($SQL);
        return $result[0];
    }


    /* 获取产品多条信息 */
    function getProMore($procateid,$limit)
    {
        $SQL="SELECT * FROM `hy_b_sys_products` where Lang='cn'  and `CateID`='$procateid' order by SortNum asc, SysProductsID desc limit 0, $limit ";//sql语句
        $result=$this->commonQuery($SQL);
        return $result;
    }


    /* En获取产品多条信息 */
    function getEnProMore($procateid,$limit)
    {
        $SQL="SELECT * FROM `hy_b_sys_products` where Lang='en'  and `CateID`='$procateid' order by SortNum asc, SysProductsID desc limit 0, $limit ";//sql语句
        $result=$this->commonQuery($SQL);
        return $result;
    }

    /* 获取网站信息 */
    function getCopyright($lang)
    {
        $SQL="SELECT * FROM `hy_b_copyright` where Lang='$lang' ";//sql语句
        $result=$this->commonQuery($SQL);
        return $result[0];
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

    /* 获取订购产品单条信息 */
    function getEnProOrderOne($pid,$limit)
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
	   	$SQL="SELECT * FROM `hy_b_sys_products_order` where Lang='cn'  and `CateID`='$procateid' and Unit>0 limit 0, $limit";//sql语句
         $result=$this->commonQuery($SQL);
	  	return $result;
   }

  
	   //获得产品列表
	  function getProductList($procateid){
	 			
             $countSql="SELECT * FROM  `hy_b_sys_products` where Lang='cn'  and `CateID`=".$procateid;//sql语句
            $pageSize="12"; //每页显示数
            $curPage=@$_GET['curPage'];//通过GET传来的当前页数
           // $urlPara="id=".$id."&cid=".$cid;//这是URL后面跟的参数，也就是问号传值
            
            $pageOutStr=reterPageStrSam($pageSize,$curPage,$countSql,$urlPara);
            $pageOutStrArr=explode("||",$pageOutStr);
            $rsStart=$pageOutStrArr[0];//limit 后的第一个参数
            $pageStr=$pageOutStrArr[2];//limit 后的第二个参数
            $pageCount=$pageOutStrArr[1];//总页数
            $sql = "SELECT * FROM  hy_b_sys_products  where   Lang='cn'  and `CateID` ='$procateid' order by SysProductsID DESC limit $rsStart, $pageSize";
            //$res = mysql_query($sql);
			$objDb = new mysqldb();
            $objDb->query($sql);
            $row1=$objDb->get_data();
			$doublelist=array("page"=>$pageStr,"list"=>$row1);
			return $doublelist;
  		
	  }
	  
	  function getcateintro($cateid){
			$SQL="SELECT * FROM `hy_b_infocategory` where InfoCategoryID = '$cateid'  ";
			$objDb = new mysqldb();
			$objDb->query($SQL);
			$result = $objDb->get_data();
			return  $result[0]['Intro'];
		}
	  
	  	   //获得预订产品列表
	  function getProductOrderList($procateid){
	 			
             $countSql="SELECT * FROM  `hy_b_sys_products_order` where Lang='cn' and Unit>0  and `CateID`=".$procateid;//sql语句
            $pageSize="12"; //每页显示数
            $curPage=@$_GET['curPage'];//通过GET传来的当前页数
           // $urlPara="id=".$id."&cid=".$cid;//这是URL后面跟的参数，也就是问号传值
            
            $pageOutStr=reterPageStrSam($pageSize,$curPage,$countSql,$urlPara);
            $pageOutStrArr=explode("||",$pageOutStr);
            $rsStart=$pageOutStrArr[0];//limit 后的第一个参数
            $pageStr=$pageOutStrArr[2];//limit 后的第二个参数
            $pageCount=$pageOutStrArr[1];//总页数
            $sql = "SELECT * FROM  hy_b_sys_products_order  where   Lang='cn' and Unit>0  and `CateID` ='$procateid' order by SysProductsID DESC limit $rsStart, $pageSize";
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
   
    function getFuHao($i,$arr,$fuhao)
   {
     if($i==sizeof($arr)-1) $douhao="";
	 else  $douhao=$fuhao;	
	 return $douhao;
   }
   
   
    function usereg( $post ){

        // 加入验证码

        $this->authcode( $post['yancode'] );

        $arr                 = $post;

        $arr['user_regtime'] = date( 'Y-m-d H:i:s', time() );

        $table               = "hy_member";

        $delarr              = array( 'user_pws2', 'yancode', 'authcode','action', 'x', 'y', 'Submit' );

        $arr                 = $this->unsetArray( $arr, $delarr );

          $sql                 = $this->insert( $table, $arr );

 
        $result              = parent::query( $sql );

        $objBase             = new clsBase();

        if ( $result )

            $objBase->popup( '成功注册!', 'vip.php' );

        else

            $objBase->popup( '注册失败!', 'reg.php' );

    }



    //修改会员资料

    function modifyreg( $post ){
	    $objBase  = new clsBase();
	    $SQL     = "select * from hy_member where  user_name ='" . $_SESSION['user_name'] . "'  and user_pws = '" . $post['oldpsw'] . "' ";
        $member  = $this->commonQuery( $SQL );
		
		if(!$member){
		   $objBase->popup( '旧密码不正确!', 'modify.php' );
		   die;
		}
	

	    
        // 加入验证码
        $this->authcode( $post['authcode'] );
        $arr      = $post;
        $table    = "hy_member";
		
        $delarr   = array( 'user_pws2', 'authcode', 'action','password1','password2','Submit','oldpsw');
		if($post['password2'] != '' && $post['password1']!= ''){
			if($post['password1'] == $post['password2']){
				 $arr['user_pws'] =  $post['password2'];
			}else{
				$objBase->popup( '两次输入密码不一致，禁止修改!', 'modify.php' );
			}
		}
		
        $arr      = $this->unsetArray( $arr, $delarr );
        $wherearr = array( 'user_id' => $_SESSION['user_id'] );
          $sql      = $this->update( $arr, $table, $wherearr );
		 
        $result   = parent::query( $sql );
       
        if ( $result )
            $objBase->popup( '修改成功!', 'modify.php' );

    }

	
	
    function mobilereg( $post ){



        $arr     = array(

        'user_tel'     => $post['mobileInfo'],

        'user_pws'     => $post['pwd2'],

        'user_regtime' => date( 'Y-m-d H:i:s', time() ),

        );

        $table   = "hy_member";

        $SQL     = $this->insert( $table, $arr );

        $result  = $this->commonQuery( $SQL );

        $objBase = new clsBase();

        if ( ! $result )

            $objBase->popup( '成功注册!', 'login.php' );

    }
	
	
	//会员登陆

    function memberlogin( $post ){
  
		$SQL     = "select * from hy_member where  user_name ='" . $post['username'] . "'  and user_pws = '" . $post['password'] . "' ";
        $member  = $this->commonQuery( $SQL );
        $objBase = new clsBase();
		/*
		if ( $member) {
		  
		  if ( $member[0]['auto'] == 0 ) {
            $objBase->popup( '账号未审核！', 'login.php' );
            exit();
			} else if ( $member[0]['auto'] == 2 ) {
				$objBase->popup( '账号审核不通过！', 'login.php' );
				exit();
			}
        }else{
		     $objBase->popup( '用户不存在！', 'login.php' );
            exit();	

		}
		*/
        if ( $member ) {
            $_SESSION['user_id']   = $member[0]['user_id'];
            $_SESSION['user_name'] = $member[0]['user_name'];
            $objBase->popup( '您好，' . $post['username'] . '，欢迎回来！', 'modify.php' );
        } else {
            $objBase->popup( '账号或密码错误！', 'vip.php' );
        }
    }



    //验证码

    function authcode( $authcode ){

        $objBase = new clsBase();

        if ( $_SESSION['seccode'] == "" || trim( $authcode ) != $_SESSION['seccode'] ) {

            $objBase->popup( '验证码错误!' );

            exit;

        }

    }
 /**

     * 

     * 删除不需要的数组

     * @param Array $array

     * @param Array $delarr

     */

    public function unsetArray( $array, $delarr ){

        foreach ( $array as $bkey => $bvalue ) {

            foreach ( $delarr as $key => $value ) {

                if ( $value == $bkey ) {

                    unset( $array[$bkey] );

                }

            }

        }

        return $array;

    }	
 

    function insert( $table, $ars ){

        if ( $ars ) {

            foreach ( $ars as $key => $value ) {

                if ( $x == sizeof( $ars ) - 1 )

                    $douhao = "";

                else

                    $douhao = ",";

                $mm.="`" . $key . "`" . $douhao;

                $nn.="'" . $value . "'" . $douhao;

                if ( $x == sizeof( $ars ) - 1 ) {

                    break;

                } else {

                    $x ++;

                }

            }



            $sql = "insert into $table ($mm)values($nn)";

            if ( $state == 1 )

                echo $sql;

            if ( $state == 0 )

                echo "";

            return $sql;

        }

    }


	
    //获取会员资料

    function memberMsg(){

        $SQL    = "select * from hy_member where  user_id = '" . $_SESSION['user_id'] . "'";

        $result = $this->commonQuery( $SQL );

        return $result[0];

    }
	

 
 
    /*

      向数据库更新符合要求的所有数据,如果成功返回true,否则返回false,参数1是要跟新的字段=>值数组，参数3是where子句数组

     */



    function update( $arr, $table, $where ){

        $str = "UPDATE `$table` SET ";

        foreach ( $arr as $key => $value ) {

            $str_key.="`" . $key . "`='" . $value . "',";

        }

        $str_key = substr( $str_key, 0, -1 );
        if($where){
			foreach ( $where as $key => $value ) {
				$sql_where.="`$key`" . "='" . $value . "' AND";
			}
        }
        $sql_where  = substr( $sql_where, 0, -4 );

        return $sql_update = $str . $str_key . " WHERE " . $sql_where . ";";

    }


 
}