<?  
$datafile   =   'online.txt ';   //   �����ļ��������linux/unixϵͳ����Ҫ���ļ���������Ϊ777����666  
$onlineTime   =   30;   //   ���ߵ�ʱ�����������������Ϊ�����  

$timestamp   =   time();   //   ȡ�õ�ǰ��Unixʱ���  
$dat   =   file($datafile);   //   �������ļ���������  
$count   =   count($dat);   //   ȡ�õ�ǰ�����ݼ�¼��Ŀ  
$onlineCount   =   1;   //   ������������ʼ����1����ǰ���������Լ�  
$insertMe   =   true;   //   �ж��Ƿ�Ҫ���뵱ǰ�����ߵļ�¼�������ǰ������û�д�IP�ļ�¼�ͼ���  

for($i   =   0;   $i   <   $count;   $i++)   {  
$dat[$i]   =   chop($dat[$i]);   //   ȥ����¼β����\n  

list($ipadd,   $requestUri,   $lastRequest)   =   explode( '�� ',   $dat[$i]);   //   ȡ������  
if($ipadd   ==   $REMOTE_ADDR)   {   //   ���IP�͵�ǰ�����ߵ�IPһ�£��͸���Unixʱ���  
$dat[$i]   =   $ipadd. '�� '.$requestUri. '�� '.$timestamp. "\n ";  
$insertMe   =   false;  
}   else   {  
//   ���IP�͵�ǰ������IP��һ�£���ô�ж��Ƿ�����  
if($lastRequest   <   ($timestamp   -   $onlineTime))   {  
//   �����ߣ�ɾ���������ݼ�¼  
$dat[$i]   =   ' ';  
}   else   {  
//   ���ߣ�����β����\n  
$dat[$i]   .=   "\n ";  
$onlineCount++;   //   ����������1  
}  
}  
}  
//   ��Javas   cript������  
  echo "$onlineCount ";  
 
//   ���µ��������ϳ�Ϊ�ַ���  
$newDat   =   join( ' ',   $dat);  
if($insertMe)   {  
//   �ж��Ƿ���Ҫ���뵱ǰ�����ߵļ�¼  
$newDat   .=   $REMOTE_ADDR. '�� '.$REQUEST_URI. '�� '.$timestamp. "\n ";  
}  
//   д�������ļ�  
$fp   =   fopen($datafile,   'w ');  
fwrite($fp,   $newDat);  
fclose($fp);  
?> 