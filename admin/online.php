<?  
$datafile   =   'online.txt ';   //   数据文件，如果是linux/unix系统，需要把文件属性设置为777或者666  
$onlineTime   =   30;   //   在线的时间差秒数，这里设置为半分钟  

$timestamp   =   time();   //   取得当前的Unix时间戳  
$dat   =   file($datafile);   //   将数据文件读入数组  
$count   =   count($dat);   //   取得当前的数据记录数目  
$onlineCount   =   1;   //   在线人数，起始就是1，当前的请求者自己  
$insertMe   =   true;   //   判断是否要插入当前请求者的记录，如果当前数据中没有此IP的记录就加入  

for($i   =   0;   $i   <   $count;   $i++)   {  
$dat[$i]   =   chop($dat[$i]);   //   去处记录尾部的\n  

list($ipadd,   $requestUri,   $lastRequest)   =   explode( '│ ',   $dat[$i]);   //   取得数据  
if($ipadd   ==   $REMOTE_ADDR)   {   //   如果IP和当前请求者的IP一致，就更新Unix时间戳  
$dat[$i]   =   $ipadd. '│ '.$requestUri. '│ '.$timestamp. "\n ";  
$insertMe   =   false;  
}   else   {  
//   如果IP和当前请求者IP不一致，那么判断是否在线  
if($lastRequest   <   ($timestamp   -   $onlineTime))   {  
//   不在线，删除本条数据记录  
$dat[$i]   =   ' ';  
}   else   {  
//   在线，加上尾部的\n  
$dat[$i]   .=   "\n ";  
$onlineCount++;   //   在线人数加1  
}  
}  
}  
//   用Javas   cript输出结果  
  echo "$onlineCount ";  
 
//   将新的数据整合成为字符串  
$newDat   =   join( ' ',   $dat);  
if($insertMe)   {  
//   判断是否需要加入当前请求者的记录  
$newDat   .=   $REMOTE_ADDR. '│ '.$REQUEST_URI. '│ '.$timestamp. "\n ";  
}  
//   写入数据文件  
$fp   =   fopen($datafile,   'w ');  
fwrite($fp,   $newDat);  
fclose($fp);  
?> 