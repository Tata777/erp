<?php include_once 'includeFiles.php'?>
<?php include_once 'page.php'?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>erp管理系统</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
</head>

<body>


<?php


$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "weili";

// 创建连接
$con =mysqli_connect($servername, $username, $password, $dbname);
mysqli_set_charset($con,'utf8');
// 检测连接


$sql = "SELECT InfoID,Title,Author,CreationDate FROM hy_b_info";
$result = mysqli_query($con,$sql);

if (!$result) {
    printf("Error: %s\n", mysqli_error($con));
    exit();
}
$jarr = array();
while ($rows=mysqli_fetch_array($result,MYSQL_ASSOC)){
    $count=count($rows);//不能在循环语句中，由于每次删除 row数组长度都减小
    for($i=0;$i<$count;$i++){
        unset($rows[$i]);//删除冗余数据
    }
    array_push($jarr,$rows);
}
//print_r($jarr);//查看数组
//echo "<br/>";
//
//echo '<hr>';

//echo '编码后的json字符串：';
 $str=json_encode($jarr);//将数组进行json编码
?>

</body>
</html>
