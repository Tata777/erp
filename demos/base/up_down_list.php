<?php

//总记录数

$count = mysql_result(mysql_query("SELECT COUNT(*) from hy_b_info  where CateID = '112' and Lang = 'cn'"),0);
if ($count != 0) {
//每页显示

$size = 3;

//总页数

$pagecount = ceil($count/$size);

//获取浏览器传来的PAGE值 去除两边空格 转成整数 无则赋值1

$page = isset($_GET['page']) ? intval(trim($_GET['page'])) : 1;

//如果小于1或大于总页数则等于1

if($page < 1 || $page > $pagecount) $page = 1;

//从第几条记录开始显示

$begin = ($page - 1) * $size;

$sql = mysql_query("SELECT * FROM hy_b_info where Lang = 'cn' ORDER BY InfoID DESC LIMIT $begin,$size");

while($count && $arr = mysql_fetch_array($sql)){

    //这里是你要输出的内容 如：

    $id = $arr['info_id'];

    echo $id;

}

?>

<?php

//翻页

$last = $page - 1;//前页

$next = $page + 1;//后页

?>

    <a style="display:inline;width: 40px" href="<? if ($page==1) {

        echo "javascript:";

    }else {echo "?page=1";}?>"> |<</a><a style="display:inline;width: 40px"  href="<? if ($page==1) {

        echo "javascript:";

    }else {echo "?page=$last";}?>"><</a>

    <?php echo "$page/$pagecount"?>

    <a style="display:inline;width: 40px" href="<? if ($page>=$pagecount) {

        echo "javascript:";

    } else { echo "?page=$next";} ?>">></a> <a style="display:inline;width: 40px" href="<? if ($page>=$pagecount) {

        echo "javascript:";

    } else { echo "?page=$pagecount";} ?>">>|</a> <span style="float: right;font-size: 13px">每页显示<span style="color: #ff6966"><?=$size?></span>条,总共有<span style="color: #ff2222;"><?=$count?></span>条公告</span>

<? }?>