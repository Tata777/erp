<?php include_once '../../includeFiles.php'?>
<?php include_once '../../page.php'?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">


<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title></title>

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link href="../../lib/ligerUI/skins/Aqua/css/ligerui-all.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="../../lib/css/stylepc.css">
    <script src="../../lib/js/jquery-latest.js" type="text/javascript"></script>
<!--    <script src="../../lib/jquery/jquery-1.3.2.min.js" type="text/javascript"></script>-->
<!--    <script src="../../lib/ligerUI/js/core/base.js" type="text/javascript"></script>-->
<!--    <script src="../../lib/ligerUI/js/plugins/ligerDrag.js" type="text/javascript"></script>-->
<!--    <script src="../../lib/ligerUI/js/plugins/ligerResizable.js" type="text/javascript"></script>-->
<!--	<script type="text/javascript">-->
<!--	    $(function ()-->
<!--	    {-->
<!--	        $('#rr1,#rr2,#rr3').ligerDrag();-->
<!--	        $('#rr1,#rr2,#rr3').ligerResizable();-->
<!--	    });-->
<!---->
<!--	</script>-->
</head>
<body style="padding:30px">
<style>
    #aaa {
        float: left;
        margin-top: 10px;
    }
    #sss {
        float: right;
        margin-right:10px;
        margin-top: 7px;
    }
</style>
<script>
    document.getElementById("tab<?=$value['InfoID']?>").onclick=function(){onclick()};
    function onclick()
    {
        document.getElementById("tab<?=$value['InfoID']?>").innerHTML=<?=$value['Content']?>;
    }
</script>
    <div class="container">
        <div class="menu">
            <h3>新闻公告</h3>
            <ul class="ulmenu1" style="height: 427px;">


                <?php


                $SQL="  select * from hy_b_info where CateID = 112";
                $result=mysql_query($SQL);
                $total=@mysql_num_rows($result);
                _PAGEFT($total,3);
                if($total==0) echo "<h3>对不起！没有相关资料</h3>";
                $SQL2=$SQL." order by  SortNum asc ,`InfoID` desc limit $firstcount,$displaypg  ";
                $result=mysql_query($SQL2);
                $i = 1;
                while($value=mysql_fetch_array($result)) {?>

                <li>
                    <a id="aaa" href="#tab<?=$value['InfoID']?>" <?php if ($i==1){echo 'class="selected"';}?>><?=getsubstr($value['Title'],13)?></a>
                    <span id="sss"><?=date('Y-m-d',$value['CreationDate'])?></span>
                </li>
                <? $i ++;}?>

            </ul>

            <li><?php include_once 'up_down_list.php'?></li>
<!--            <div style="text-align: center;margin-bottom:50px;font-size:18px;"></div>-->
        </div>

        <div class="content">
            <div class="get-menu">
                <a href="#">新闻详情</a>
            </div>

            <div class="menu1 menu_tab">
                <?php

                $SQL="  select * from hy_b_info where CateID = 112";
                $result=mysql_query($SQL);
                $total=@mysql_num_rows($result);
                _PAGEFT($total,3);
                if($total==0) echo "<h3>对不起！没有相关资料</h3>";
                $SQL2=$SQL." order by  SortNum asc ,`InfoID` desc limit $firstcount,$displaypg  ";
                $result=mysql_query($SQL2);
                $i = 1;
                while($value=mysql_fetch_array($result)) {?>
<!--                foreach ($new as $key => $value) {-->
<!--                    ?>-->
                    <div id="tab<?=$value['InfoID']?>" class="tab <?php if ($i==1){echo 'active';} ?>">
                        <h2 style="text-align: center"><?=$value['Title']?></h2>
                        <p><?=$value['Content']?></p>
                    </div>
                <? $i++;}?>

            </div>
        </div>

    </div>








</body>
<script type="text/javascript" src="../../lib/js/pc.js"></script>
</html>