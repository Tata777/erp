﻿<?php include_once '../../includeFiles.php'?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title></title>
    <link href="../../lib/ligerUI/skins/Aqua/css/ligerui-all.css" rel="stylesheet" type="text/css" />
    <link href="../../lib/ligerUI/skins/Gray/css/all.css" rel="stylesheet" type="text/css" />
    <link href="../../lib/ligerUI/skins/ligerui-icons.css" rel="stylesheet" type="text/css" />
    <script src="../../lib/jquery/jquery-1.3.2.min.js" type="text/javascript"></script>
    <script src="../../lib/ligerUI/js/core/base.js" type="text/javascript"></script>
    <script src="../../lib/ligerUI/js/plugins/ligerToolBar.js" type="text/javascript"></script>
    <script src="../../lib/ligerUI/js/plugins/ligerDialog.js" type="text/javascript"></script>
    <script src="../../lib/ligerUI/js/plugins/ligerGrid.js" type="text/javascript"></script> 
    <script src="../../lib/ligerUI/js/plugins/ligerFilter.js" type="text/javascript"></script>
    <script src="../../lib/ligerUI/js/plugins/ligerDrag.js" type="text/javascript"></script>
    <script src="../../lib/ligerUI/js/plugins/ligerResizable.js" type="text/javascript"></script>
    <script src="ligerGrid.showFilter.js" type="text/javascript"></script>
<!--    <script src="../grid/CustomersData.js" type="text/javascript"></script>-->
    <?php include_once '../../1111.php'?>
    <script>
        var CustomersData =
            {
                Rows:<?=$str?>
            , Total: 91
        };

    </script>
    <script type="text/javascript">


<!--        --><?php
//           $new = $info->getAllNews(112,10);
//           var_dump($new);
//        ?>
    //去掉  大于小于包括,并改变顺序
    $.ligerDefaults.Filter.operators['string'] =
    $.ligerDefaults.Filter.operators['text'] =
    ["like" , "equal", "notequal", "startwith", "endwith" ];

    //这个例子展示了本地过滤，你也可以在服务器端过滤(将过滤规则组成json，以一个参数提交给服务器)
    //相见ligerGrid.showFilter.js

        $(function ()
        {
            window['g'] = 
            $("#maingrid4").ligerGrid({
                columns: [
                    { display: '主键', name: 'InfoID', align: 'left', width: 120 },
                    { display: '公司名', name: 'Title', minWidth: 60, align: 'left' },
                    { display: '联系名', name: 'Author', width: 120, align: 'left' },
                    {
                        display: '模板列',width: 120, align: 'left', isAllowHide: false,
                        render: function (row)
                        {
                            var html = '<a href="../base/dragresizable.php" onclick="onedit()">编辑</a>';
                            return html;
                        }
                    }
                    // { display: '城市', name: 'City', heightAlign: 'center' },
                    // { display: '电话', name: 'Phone', width: 170, align: 'left' },
                    // { display: '传真', name: 'Fax', width: 170, align: 'left' }
                ], data: $.extend(true,{},CustomersData), pageSize: 30,
                toolbar: { items: [{ text: '高级自定义查询', click: itemclick, icon: 'search2'}]
                },
                width: '60%', height: '80%', checkbox: false
            });
            $("#pageloading").hide();
        });
        function itemclick()
        {
            g.options.data = $.extend(true,{}, CustomersData);
            g.showFilter();
        }
        function onedit() {
            alert("1111");
        }

    </script>
</head>
<body style="padding: 4px; overflow: hidden;">
    <div class="l-loading" style="display: block" id="pageloading">

    </div>
    <div id="maingrid4" style="l-panel-bbar-innermargin: 0; padding: 0">
    </div>
    <div style="display: none;">
    </div>
</body>
</html>
