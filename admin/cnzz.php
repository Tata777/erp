<?php

 #初始化curl
$curlPost='password=yl123456';
$ch = curl_init() or die (curl_error());
//设置URL参数


curl_setopt($ch,CURLOPT_URL,"http://new.cnzz.com/v1/login.php?t=login&siteid=5223618");
//要求CURL返回数据
curl_setopt($ch,CURLOPT_HEADER,1);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
//执行请求
curl_setopt($ch,CURLOPT_POST,1);

curl_setopt($ch,CURLOPT_POSTFIELDS,$curlPost);
$result = curl_exec($ch) or die (curl_error());

//取得返回的结果，并显示
echo $result;
//echo curl_error($ch);
//关闭CURL
curl_close($ch);
 