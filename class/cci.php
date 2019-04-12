<?php
class cci
{
/****** 产生Session ID ******/
/*
函数名称：create_sess_id()
函数作用：产生以个随机的会话ID
参    数：$len: 需要会话字符串的长度，默认为32位，不要低于16位
返 回 值：返回会话ID
*/
function create_sess_id($len=32)
{
// 校验提交的长度是否合法
 if( !is_numeric($len) || ($len>32) || ($len<16)) { return; }
// 获取当前时间的微秒
 list($u, $s) = explode(' ', microtime());
 $time = (float)$u + (float)$s;
// 产生一个随机数
 $rand_num = rand(100000, 999999);
 $rand_num = rand($rand_num, $time);
 mt_srand($rand_num);
 $rand_num = mt_rand();
// 产生SessionID
 $sess_id = md5( md5($time). md5($rand_num) );
// 截取指定需要长度的SessionID
 $sess_id = substr($sess_id, 0, $len);
 return $sess_id;
}


/****** 产生校验码 ******/

/*
函数名称：create_check_code()
函数作用：产生以个随机的校验码
参    数：$len: 需要校验码的长度, 请不要长于16位,缺省为4位
返 回 值：返回指定长度的校验码
*/
function create_check_code($len=4)
{
 if ( !is_numeric($len) || ($len>6) || ($len<1)) { return; }

 $check_code = substr($this->create_sess_id(), 16, $len );
 return strtoupper($check_code);
}


/******  生成校验码的图片 ******/


/*
函数名称：create_check_image()
函数作用：产生一个校验码的图片
参    数：$check_code: 校验码字符串，一般由create_check_code()函数来获得
返 回 值：返回该图片
*/
function create_check_image( $check_code )
{
 // 产生一个图片
 $im = imagecreate(50,20);
 $black = ImageColorAllocate($im, 255,255,255);  // 背景颜色
 $white = ImageColorAllocate($im, 0,0,0);  // 前景颜色
 $gray = ImageColorAllocate($im, 200,200,200);
 imagefill($im,68,30,$gray);

 // 将四位整数验证码绘入图片
 imagestring($im, 5, 8, 3, $check_code, $white);
 // 加入干扰象素
 for($i=0;$i<200;$i++)
 {
     $randcolor = ImageColorallocate($im,rand(0,255),rand(0,255),rand(0,255));
     imagesetpixel($im, rand()%70 , rand()%30 , $randcolor);
 }
 // 输出图像
 Header("Content-type: image/PNG");
 ImagePNG($im);
 ImageDestroy($im);
}

}

?>