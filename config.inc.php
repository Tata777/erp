<?php    
session_start();
@set_time_limit(500);							//time out setting
error_reporting(E_ALL & ~E_NOTICE);
define('IS_IN_MT' , true);
define('CFG_IS_DEBUG' , false);//is the web runing in the debug mode
define('CFG_WEB_ROOT', dirname(__FILE__) . '/'); //网站根目录
define('CFG_LIB_DIR' , CFG_WEB_ROOT.'class/');//CLASS目录
define('CFG_INDEX_DIR' , CFG_WEB_ROOT.'www/');//前台目录
define('CFG_INC_DIR' , CFG_WEB_ROOT.'www/include/');//INCLUDE目录
define('DB_CHARSET' , 'utf-8');//数据库链接编码


define('DEFAULT_PAGESIZE' , 20);
define('UPLOAD_DIR' , 'uploadfile');//上传图片路径

define('CACHE_TYPE', 0);		//缓存类型:		0.关闭		1.开启		2.所有缓存时间为'ALL_CACHE_TIME'的值
define('ALL_CACHE_TIME', 1);	//所有缓存时间

$charset = 'utf-8';//网站编码

$companyname = "erp管理系统";
$companyurl = "";

//数据库连接部分
include_once("db.config.inc.php");

$cfg_web_lan = array('cn' => '中文');//所有语言，如添加或删除，请修改数据库相应结构
define('DEF_WEB_LAN' , 'cn');		//网站默认语言
define('SEC_WEB_LAN' , 'en');		//英文版

$cfg_cur_lan = 'cn';//网站当前语言

/**
功能模块的选取

用户管理(1) 信息发布 (2) 公司信息 (3) 留 言 本 (4) 产品展示 (4)
在线调查(6) 招贤纳士(7)  广告管理 (8) 友情链接 (9) 网络营销 (10)
下载中心(13)
*/
$leftflag="1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,20,25,28,30,84,306,307,308,309,400,401,320,325";

$uploaddirarray = array('0'=>'company' , '1'=>'news' , '2'=>'product' , '3'=>'product_s' , '4'=>'Recruitment' , '5'=>'link' , '6'=>'download' , '7'=>'web' , '8'=>'guangg' , '9'=>'tuiguang','10'=>'info', '11'=>'contract', '12'=>'snd', '13'=>'meb_product', '14'=>'category', '15'=>'filed', '16'=>'ico', '17'=>'product_b', '18'=>'video', '19'=>'videophoto','20'=>'pictrue');
/*
设定
*/
$Advertisement=array("首页","行业资讯","水晶资讯","产品中心","行业库","供求信息");
/*
广告类型设定
*/
$ad_type=array("一般广告","浮动广告","弹出广告","视频广告");


$arrOrderState=array(
						"0"=>	"未付款",
						"1"=>	"等待买家付款",
						"2"=>	"已付款",
						"3"=>	"处理中",
						"4"=>	"卖家已经发货等待买家确认",
						"5"=>	"交易成功结束",
						"6"=> 	"退票"
						 );
$arrOrderType=array(
					"0"=>	"<font color=\"#0000FF\">普通订票</font>",
					"1"=>	"<strong><font color=\"#0000FF\">普通购票</font></strong>",
					"2"=>	"<font color=\"red\">会员订票</font>",
					"3"=>	"<strong><font color=\"red\">会员购票</font></strong>",
					 );

 





?>

