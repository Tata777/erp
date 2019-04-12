<?php include_once './includeFiles.php'?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>erp管理系统</title>
    <link href="lib/ligerUI/skins/Aqua/css/ligerui-all.css" rel="stylesheet" type="text/css" />  
    <link rel="stylesheet" type="text/css" id="mylink"/>   
    <script src="lib/jquery/jquery-1.3.2.min.js" type="text/javascript"></script>    
    <script src="lib/ligerUI/js/ligerui.all.js" type="text/javascript"></script> 
    <script src="lib/ligerUI/js/plugins/ligerTab.js"></script>
    <script src="lib/jquery.cookie.js"></script>
    <script src="lib/json2.js"></script>
    <script src="indexdata.js" type="text/javascript"></script>
        <script type="text/javascript">
     
            var tab = null;
            var accordion = null;
            var tree = null;
            var tabItems = [];
	
            $(function ()
            {

                //布局
                $("#layout1").ligerLayout({ leftWidth: 95, height: '100%',heightDiff:-34,space:0, onHeightChanged: f_heightChanged,
										  allowLeftResize:false });

                var height = $(".l-layout-center").height();

                //Tab
                $("#framecenter").ligerTab({
                    height: height,
                    showSwitchInTab : true,
                    showSwitch: true,
                    onAfterAddTabItem: function (tabdata)
                    {
                        tabItems.push(tabdata);
                        saveTabStatus();
                    },
                    onAfterRemoveTabItem: function (tabid)
                    { 
                        for (var i = 0; i < tabItems.length; i++)
                        {
                            var o = tabItems[i];
                            if (o.tabid == tabid)
                            {
                                tabItems.splice(i, 1);
                                saveTabStatus();
                                break;
                            }
                        }
                    },
                    onReload: function (tabdata)
                    {
                        var tabid = tabdata.tabid;
                        addFrameSkinLink(tabid);
                    }
                });

                //面板
                $("#accordion1").ligerAccordion({
                    height: height - 24, speed: null
                });

                $(".l-link").hover(function ()
                {
                    $(this).addClass("l-link-over");
                }, function ()
                {
                    $(this).removeClass("l-link-over");
                });
                //树
                $("#tree1").ligerTree({
                    data : indexdata,
                    checkbox: false,
                    slide: false,
                    nodeWidth: 29,
                    attribute: ['nodename', 'url'],
                    onSelect: function (node)
                    {
                        if (!node.data.url) return;
                        var tabid = $(node.target).attr("tabid");
                        if (!tabid)
                        {
                            tabid = new Date().getTime();
                            $(node.target).attr("tabid", tabid)
                        } 
                        f_addTab(tabid, node.data.text, node.data.url);
                    }
                });

                tab = liger.get("framecenter");
                accordion = liger.get("accordion1");
                tree = liger.get("tree1");
                $("#pageloading").hide();

                css_init();
                pages_init();
            });
            function f_heightChanged(options)
            {  
                if (tab)
                    tab.addHeight(options.diff);
                if (accordion && options.middleHeight - 24 > 0)
                    accordion.setHeight(options.middleHeight - 24);
            }
            function f_addTab(tabid, text, url)
            {
                tab.addTabItem({
                    tabid: tabid,
                    text: text,
                    url: url,
                    callback: function ()
                    {
                        addShowCodeBtn(tabid); 
                        addFrameSkinLink(tabid); 
                    }
                });
            }
       /*     function addShowCodeBtn(tabid)
            {
                var viewSourceBtn = $('<a class="viewsourcelink" href="javascript:void(0)">查看源码</a>');
                var jiframe = $("#" + tabid);
                viewSourceBtn.insertBefore(jiframe);
                viewSourceBtn.click(function ()
                {
                    showCodeView(jiframe.attr("src"));
                }).hover(function ()
                {
                    viewSourceBtn.addClass("viewsourcelink-over");
                }, function ()
                {
                    viewSourceBtn.removeClass("viewsourcelink-over");
                });
            }
            function showCodeView(src)
            {
                $.ligerDialog.open({
                    title : '源码预览',
                    url: 'dotnetdemos/codeView.aspx?src=' + src,
                    width: $(window).width() *0.9,
                    height: $(window).height() * 0.9
                });

            }*/
            function addFrameSkinLink(tabid)
            {
                var prevHref = getLinkPrevHref(tabid) || "";
                var skin = getQueryString("skin");
                if (!skin) return;
                skin = skin.toLowerCase();
                attachLinkToFrame(tabid, prevHref + skin_links[skin]);
            }
        /*    var skin_links = {
                "aqua": "lib/ligerUI/skins/Aqua/css/ligerui-all.css",
                "gray": "lib/ligerUI/skins/Gray/css/all.css",
                "silvery": "lib/ligerUI/skins/Silvery/css/style.css",
                "gray2014": "lib/ligerUI/skins/gray2014/css/all.css"
            };*/
            function pages_init()
            {
                var tabJson = $.cookie('liger-home-tab'); 
                if (tabJson)
                { 
                    var tabitems = JSON2.parse(tabJson);
                    for (var i = 0; tabitems && tabitems[i];i++)
                    { 
                        f_addTab(tabitems[i].tabid, tabitems[i].text, tabitems[i].url);
                    } 
                }
            }
            function saveTabStatus()
            { 
                $.cookie('liger-home-tab', JSON2.stringify(tabItems));
            }
            function css_init()
            {
                var css = $("#mylink").get(0), skin = getQueryString("skin");
                $("#skinSelect").val(skin);
                $("#skinSelect").change(function ()
                { 
                    if (this.value)
                    {
                        location.href = "index.htm?skin=" + this.value;
                    } else
                    {
                        location.href = "index.htm";
                    }
                });

               
                if (!css || !skin) return;
                skin = skin.toLowerCase();
                $('body').addClass("body-" + skin); 
                $(css).attr("href", skin_links[skin]); 
            }
            function getQueryString(name)
            {
                var now_url = document.location.search.slice(1), q_array = now_url.split('&');
                for (var i = 0; i < q_array.length; i++)
                {
                    var v_array = q_array[i].split('=');
                    if (v_array[0] == name)
                    {
                        return v_array[1];
                    }
                }
                return false;
            }
            function attachLinkToFrame(iframeId, filename)
            { 
                if(!window.frames[iframeId]) return;
                var head = window.frames[iframeId].document.getElementsByTagName('head').item(0);
                var fileref = window.frames[iframeId].document.createElement("link");
                if (!fileref) return;
                fileref.setAttribute("rel", "stylesheet");
                fileref.setAttribute("type", "text/css");
                fileref.setAttribute("href", filename);
                head.appendChild(fileref);
            }
            function getLinkPrevHref(iframeId)
            {
                if (!window.frames[iframeId]) return;
                var head = window.frames[iframeId].document.getElementsByTagName('head').item(0);
                var links = $("link:first", head);
                for (var i = 0; links[i]; i++)
                {
                    var href = $(links[i]).attr("href");
                    if (href && href.toLowerCase().indexOf("ligerui") > 0)
                    {
                        return href.substring(0, href.toLowerCase().indexOf("lib") );
                    }
                }
            }
     </script> 
     <script type="text/javascript">
    $(function(){
        $("#tree1 > li").hover(function(){
            $(this).find(".l-children").show();
        }, 
     function(){
             $(this).find(".l-children").hide();
        });
    });
	     
</script> 
<style type="text/css"> 
    body,html{height:100%;}
    body{ padding:0px; margin:0;   overflow:hidden;}  
    .l-link{ display:block; height:26px; line-height:26px; padding-left:10px; text-decoration:underline; color:#333;}
    .l-layout-top{background:#102A49; color:White;}
    .l-layout-bottom{ background:#E5EDEF; text-align:center;}
    #pageloading{position:absolute; left:0px; top:0px; background:white url('loading.gif') no-repeat center; width:100%; height:100%;z-index:99999;}
    .l-link{ display:block; line-height:22px; height:22px; padding-left:16px;border:1px solid white; margin:4px;}
    .l-link-over{ background:#FFEEAC; border:1px solid #DB9F00;} 
    .l-winbar{ background:#2B5A76; height:30px; position:absolute; left:0px; bottom:0px; width:100%; z-index:99999;}
    .space{ color:#E7E7E7;}
    /* 顶部 */ 
    .l-topmenu{ margin:0; padding:0; height:47px; line-height:47px; background:#2f5381;    }
    .l-topmenu-logo{ color:#E7E7E7; width:409px; height:47px;padding-left:100px; padding-top:10px;}
    .l-topmenu-welcome{  position:absolute; height:40px; line-height:24px;  right:30px; top:2px;color:#070A0C;}
    .l-topmenu-welcome a{ color:#E7E7E7; text-decoration:underline} 
     .body-gray2014 #framecenter{
        margin-top:3px;
    }
      .viewsourcelink {
         background:#B3D9F7;  display:block; position:absolute; right:10px; top:3px; padding:6px 4px; color:#333; text-decoration:underline;
    }
    .viewsourcelink-over {
        background:#81C0F2;
    }
    .l-topmenu-welcome label {color:white;
    }
    #skinSelect {
        margin-right: 6px;
    }
	.l-children li:hover,.l-tree a:hover,.l-tree span:hover{ background:none; text-decoration:none; font-weight:bold; color:#000;}
	.l-tree a,.l-tree span{color: #666;height: 30px;line-height: 30px; text-decoration:none;}
	.l-layout-left{background:#2f5381;}
 </style>
</head>
<body style="padding:0px;background:#2f5381;">  
<div id="pageloading"></div>  
<div id="topmenu" class="l-topmenu">
    <div class="l-topmenu-logo"><img style="margin-top: -20px;" src="lib/images/logo.png" /></div>
    <div class="l-topmenu-welcome">
        <a href="#" class="l-sy"></a>
        <a href="#" class="l-link2"></a>
        <a href="#" class="l-link3" target="_blank"></a>
        <a href="#" class="l-link4" target="_blank"></a>
        <a href="#" class="l-link5" target="_blank"></a>
        <a href="#" class="l-link6" target="_blank"></a>
    </div> 
</div>
  <div id="layout1" style="width:100%; margin:0 auto; margin-top:0px;  "> 
        <div position="left"> 
              <ul id="tree1" style="margin-top:-50px; padding-bottom:50px;">
              </ul>
        </div>
        <div position="center" id="framecenter" > 
            <div tabid="home" title="我的主页" style="height:300px" >
                <iframe framebsorder="0" name="home" id="home" src="welcome.htm"></iframe>
            </div> 
        </div> 
        
    </div>
    <div  style="height:32px; line-height:32px; text-indent:40px; color:#FFF;">
          
              <div style="background:url(lib/images/men.png) no-repeat; width:640px; margin-left:95px; background-position:10px 4px; float:left;">总经理-IT部-互联网研发组：郭靖［初级业务员］</div>
              <div style="background:url(lib/images/message.png) no-repeat;width:340px; background-position:10px 6px; float:left;">温馨提醒：关于“世纪风情”栋座特殊通知公告</div>
              <div style="background:url(lib/images/alert.png) no-repeat; width:340px; background-position:10px 5px; float:right;"><marquee>恭喜，11111111111朝阳中-廖龙彪于2015-06-16 18:00:08签了一单</marquee></div>
        

    </div>
  
</body>
</html>
