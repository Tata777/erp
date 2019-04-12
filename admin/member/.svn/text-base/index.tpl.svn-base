<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>汇享生活-惠州优惠券-惠州美食</title>
<meta name="Keywords" content="惠州美食攻略, 惠州美食, 惠州美食网,优惠券,优惠券网, 惠州社区, 惠州论坛, 惠州门户网站, 惠州生活, 惠州消费,汇享家园,汇享社区,汇享圈子,汇享优惠券,汇享网,汇享社区中心">
<meta name="description" content="汇享网是提供惠州美食攻略、惠州美食优惠券、惠州餐饮优惠、惠州打折信息的惠州生活消费网站，也是最具人气的惠州社区论坛之一。提供惠州美食优惠券、惠州美食攻略.是惠州网友的社区论坛生活家园。">
<Meta name="Copyright" Content="汇享生活版权所有">
<link href="css/layout.css" type="text/css" rel="Stylesheet" />
<link href="css/skin.css" type="text/css" rel="Stylesheet" />

<script src="js/jquery-1.4a2.min.js" type="text/javascript"></script>
<script src="js/ad.js" type="text/javascript"></script>
<script src="js/jquery.KinSlideshow-1.2.1.min.js" type="text/javascript"></script>
<script type="text/javascript">
$(function(){
	$("#KinSlideshow").KinSlideshow();
})


	$(document).ready(function(){
  
	   $.ajax({
	   type: "GET",
	   url: "hxlife.php",
	   data: "",
	   success: function(msg){
		 $("#hxlife").html(msg);
	   }
	});
});



</script>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>





<!--页头--> 
{include file="header.tpl" title=foo} 
<!--页中-->
<div class="content">
  <div class="clearfix"> 
    <!--主区域-->
    <div class="con_areaL1">
      <div class="clearfix">
        <div class="con_areaL2"> 
          <!--左导航--> 
          {include file="conav.tpl" title=foo} 
          <!--左广告-->
		  		{section name=sec1 loop=$rightAD start=0} 
          <div class="con_advertisement1"> 
		  <a href="{$rightAD[sec1].LinkUrl}" title="{$rightAD[sec1].LinkName}"> <img   width="160" height="115" src="uploadfile/link/{$rightAD[sec1].LogoPic}" /> </a> 
		  </div>
          {/section}
        </div>
        <div class="con_areaR2"> 
          <!--主图区域-->
          <div class="con_imgBox">
            <div class="con_imgBoxImg"> 
			
		
				

<div class="ad" >
			 <script>
			  var pic_width=530; //图片宽度
var pic_height=190; //图片高度
var button_pos=2; //按扭位置 1左 2右 3上 4下
var stop_time=5000; //图片停留时间(1000为1秒钟)
var show_text=0; //是否显示文字标签 1显示 0不显示
var txtcolor="0000ff"; //文字色
var bgcolor="DDDDDD"; //背景色

//可编辑内容结束


var pics="", mylinks="", texts="";
pics='uploadfile/link/{$AD[0].LogoPic}|uploadfile/link/{$AD[1].LogoPic}|uploadfile/link/{$AD[2].LogoPic}|uploadfile/link/{$AD[3].LogoPic}|uploadfile/link/{$AD[4].LogoPic}'
mylinks='{$AD[0].LinkUrl}|{$AD[1].LinkUrl}|{$AD[2].LinkUrl}|{$AD[3].LinkUrl}|{$AD[4].LinkUrl}';
texts='{$AD[0].LinkName}|{$AD[1].LinkName}|{$AD[2].LinkName}|{$AD[3].LinkName}|{$AD[4].LinkName}';
			  </script>
<script src="js/fun.js"></script>
		</div>

			</div>
            <script>
							
							/*Tab 选项卡 标签*/
						$(function(){
								var $div_li =$("#zhongkong a");
								$div_li.mouseover(function(){
									$(this).addClass("c")            //当前<li>元素高亮
										   .siblings().removeClass("c");  //去掉其他同辈<li>元素的高亮
										   
									     var index =  $div_li.index(this);  // 获取当前点击的<li>元素 在 全部li元素中的索引。
									$("div.con_hotBox > div")   
											.eq(index).show()   //显示 <li>元素对应的<div>元素
											.siblings().hide(); //隐藏其他几个同辈的<div>元素
											
								}).hover(function(){
									$(this).addClass("hover");
								},function(){
									$(this).removeClass("hover");
								})
						})

							</script>
            <div class="con_imgBoxNav clearfix" id="zhongkong"> <a class="c" href="#">最新推荐</a> <a href="#">天天优惠 </a> <a href="#">推荐促销</a> <a href="#">最爱消费</a> </div>
          </div>
          <div class="con_hotBox"> 
            <!--返利内测火热开启-->
            <div>
              <ul>
                {section name=sec1 loop=$yharr1}
                <li>
                  <div class="hotBox_img"> <a href="shopDetail.php?prid={$yharr1[sec1].SysProductsID}" title="{$yharr1[sec1].ProductName}"> <img width="75" height="50" alt="" src="admin/pic.php?imagename=../uploadfile/product_b/{$yharr1[sec1].Photos}&amp;imagewidth=75&amp;imageheight=50&amp;cuteit=1}" /></a></div>
                  <div class="hotBox_con"> <b><a href="shopDetail.php?prid={$yharr1[sec1].SysProductsID}">[{$yharr1[sec1].Material}]</a></b><strong><a href="shopDetail.php?prid={$yharr1[sec1].SysProductsID}" title="{$yharr1[sec1].ProductName}">{$yharr1[sec1].ProductName|truncate:20}</a></strong>
                    <p> <em>{$yharr1[sec1].Size|truncate:28}</em></p>
                  </div>
                </li>
                {/section}
              </ul>
            </div>
            <!--返利内测火热开启END--> 
            
            <!--汇享年中庆-->
            <div style="display:none" >
              <ul>
                {section name=sec1 loop=$yharr2}
                <li>
                  <div class="hotBox_img"> <a href="shopDetail.php?prid={$yharr2[sec1].SysProductsID}" title="{$yharr2[sec1].ProductName}"> <img width="75" height="50" alt="" src="admin/pic.php?imagename=../uploadfile/product_b/{$yharr2[sec1].Photos}&amp;imagewidth=75&amp;imageheight=50&amp;cuteit=1}" /></a></div>
                  <div class="hotBox_con"> <b><a href="shopDetail.php?prid={$yharr2[sec1].SysProductsID}">[{$yharr2[sec1].Material}]</a></b><strong><a href="shopDetail.php?prid={$yharr2[sec1].SysProductsID}" title="{$yharr2[sec1].ProductName}">{$yharr2[sec1].ProductName|truncate:20}</a></strong>
                    <p> <em>{$yharr2[sec1].Size|truncate:28}</em></p>
                  </div>
                </li>
                {/section}
              </ul>
            </div>
            <!--汇享年中庆END--> 
            
            <!--MIOOK上线众亲有礼-->
            <div style="display:none">
              <ul>
                {section name=sec1 loop=$yharr3}
                <li>
                  <div class="hotBox_img"> <a href="shopDetail.php?prid={$yharr3[sec1].SysProductsID}" title="{$yharr3[sec1].ProductName}"> <img width="75" height="50" alt="" src="admin/pic.php?imagename=../uploadfile/product_b/{$yharr3[sec1].Photos}&amp;imagewidth=75&amp;imageheight=50&amp;cuteit=1}" /></a></div>
                  <div class="hotBox_con"> <b><a href="shopDetail.php?prid={$yharr3[sec1].SysProductsID}">[{$yharr3[sec1].Material}]</a></b><strong><a href="shopDetail.php?prid={$yharr3[sec1].SysProductsID}" title="{$yharr3[sec1].ProductName}">{$yharr3[sec1].ProductName|truncate:20}</a></strong>
                    <p> <em>{$yharr3[sec1].Size|truncate:28}</em></p>
                  </div>
                </li>
                {/section}
              </ul>
            </div>
            <!--MIOOK上线众亲有礼END--> 
            
            <!--耐克年中促销-->
            <div style="display:none">
              <ul>
                {section name=sec1 loop=$yharr4}
                <li>
                  <div class="hotBox_img"> <a href="shopDetail.php?prid={$yharr4[sec1].SysProductsID}" title="{$yharr4[sec1].ProductName}"> <img width="75" height="50" alt="" src="admin/pic.php?imagename=../uploadfile/product_b/{$yharr4[sec1].Photos}&amp;imagewidth=75&amp;imageheight=50&amp;cuteit=1}" /></a></div>
                  <div class="hotBox_con"> <b><a href="shopDetail.php?prid={$yharr4[sec1].SysProductsID}">[{$yharr4[sec1].Material}]</a></b><strong><a href="shopDetail.php?prid={$yharr4[sec1].SysProductsID}" title="{$yharr4[sec1].ProductName}">{$yharr4[sec1].ProductName|truncate:20}</a></strong>
                    <p> <em>{$yharr4[sec1].Size|truncate:28}</em></p>
                  </div>
                </li>
                {/section}
              </ul>
              
              <!--耐克年中促销END--> 
              
            </div>
          </div>
          
          <!--公交区域-->
          <div class="con_carBox">
            <div class="carBox_nav"> <a href="#" class="c">公交换乘</a> <!--<a href="#">开车路线</a> <a href="#">公 交 车</a> <a href="#">
                                    公 交 站</a> <a href="#" class="r">地 图</a>--> 
            </div>
            <div class="carBox_con">
              <ul class="radio">
                <li class="radioC">
                  <input type="radio" checked="" value="11" name="g_bstype">
                  <label> 最优推荐</label>
                  <input type="radio" value="51" name="g_bstype">
                  <label> 地铁优先</label>
                  <input type="radio" value="41" name="g_bstype">
                  <label> 只乘地铁</label>
                  <input type="radio" value="10" name="g_bstype">
                  <label> 只坐公交</label>
                </li>
              </ul>
              <form  method="get" action="map.php" >
                <input name="city" value="广州"  type="hidden" />
                <ul class="idxSrh1">
                  <li class="S_input3">
                    <div class="S_input3Div"> <span>起点</span>
                      <input type="text" onkeyup="mst_sg.show2(this,event,1,2);" name="start" onfocus="javascript:this.style.color='#666';if(this.value == '请输入起点'){ this.value = '';}"
                                                id="g_from" tabindex="1"  value="请输入起点">
                    </div>
                  </li>
                  <li class="S_input3">
                    <div class="S_input3Div"> <span>终点</span>
                      <input type="text" onkeyup="mst_sg.show2(this,event,1,2);" onfocus="javascript:this.style.color='#666';if(this.value == '请输入终点'){ this.value = '';}"
                                                value="请输入终点" maxlength="180" tabindex="2"  name="end" id="g_to">
                    </div>
                  </li>
                  <li class="srhBtn">
                    <input type="submit" value="查 询">
                  </li>
                </ul>
              </form>
              <div class="block2">
                <ul class="clearfix">
                  <li>常用地图：</li>
                  <li><a target="_blank" href="http://map.baidu.com">百度地图</a></li>
                  <li><a target="_blank" href="http://map.google.com">谷歌地图</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="con_areaC2"> 
        <!--优惠促销-->
        <div class="con_SalesBox con_MainBox">
          <div class="SalesBoxTitle MainBoxTitle">
            <h2> 优惠促销</h2>
          </div>
          <div class="SalesBoxCon clearfix">
            <div class="SalesBox_fla hdUpL"> 
              <script type="text/javascript" src="js/xixi.js"></script>
              <div id="imager_div"></div>
			  
              <script language="javascript" type="text/javascript">
var swf = new sinaFlash("swf/shis.swf", "", "240", "250", "8", "2", true,"120");
swf.addParam("allowScriptAccess", "always");
swf.addParam("wmode", "opaque");
swf.addVariable("p_array", "uploadfile/link/{$xuanzhuanAD[0].LogoPic}|uploadfile/link/{$xuanzhuanAD[1].LogoPic}|uploadfile/link/{$xuanzhuanAD[2].LogoPic}");
swf.addVariable("txt_array", "{$xuanzhuanAD[0].LinkName}|{$xuanzhuanAD[1].LinkName} |{$xuanzhuanAD[2].LinkName}");
swf.addVariable("link_array", "{$xuanzhuanAD[0].LinkUrl}|{$xuanzhuanAD[1].LinkUrl}|{$xuanzhuanAD[2].LinkUrl}");
swf.write("imager_div");
</script> 
            </div>
            <div class="SalesBox_con hdUpL">
              <ul>
                {section name=sec1 loop=$yharr5 start=3 max=3}
                <li>
                  <h2> <span><a target="_blank" href="#">{$yharr5[sec1].Material}</a></span> <a target="_blank" href="shopDetail.php?prid={$yharr5[sec1].SysProductsID}"  title="{$yharr5[sec1].ProductName}">{$yharr5[sec1].ProductName|truncate:23}</a></h2>
                  <p> {$yharr5[sec1].Tag}  </p>
                </li>
                {/section}
              </ul>
            </div>
          </div>
          <div class="SalesBoxBtm">
              {include file="gdimags.tpl"} 
          </div>
        </div>
        <!--长广告-->
        <div class="con_advertisement3"> 
		{section name=sec1 loop=$zhongAD start=0} <a href="{$zhongAD[sec1].LinkUrl}" title="{$zhongAD[sec1].LinkName}"> <img width="705" height="100" src="uploadfile/link/{$zhongAD[sec1].LogoPic}" /> </a> {/section}
		</div>
        <!--汇享生活-->
        <div id="hxlife"><img src="images/loding.gif"/>数据正在加载中... </div>
      </div>
    </div>
    <!--右区域-->
    <div class="con_areaR1"> 
      <!--订阅优惠券-->
    <!--  <div class="con_FeedBox">
        <div class="FeedBoxTitle"> <b></b>
          <h2> 订阅优惠券</h2>
        </div>
        <div class="FeedBoxCon">
          <p>
            <input type="text" onkeyup="mst_sg.show2(this,event,1,2);" onfocus="javascript:this.style.color='#666';if(this.value == '请输入起点'){ this.value = '';}"
                                name="g_from" id="Text1" tabindex="1" value="请输入起点">
            <a href="#">订阅</a></p>
          <p>
            <input type="text" onkeyup="mst_sg.show2(this,event,1,2);" onfocus="javascript:this.style.color='#666';if(this.value == '请输入起点'){ this.value = '';}"
                                name="g_from" id="Text2" tabindex="1" value="请输入起点">
            <a href="#">订阅</a></p>
        </div>
      </div>-->
      <!--下载排行--> 
      {include file="downlin.tpl"} 
      <!--最新优惠券--> 
      {include file="newsyou.tpl"} 
      <div class="con_advertisement2"> {section name=sec1 loop=$AD2 start=0} <a href="{$AD2[sec1].LinkUrl}" title="{$AD2[sec1].LinkName}"> <img width="230" height="230"  src="uploadfile/link/{$AD2[sec1].LogoPic}" /> </a> {/section} </div>
      <!--社区新闻-->
      <div class="con_SideBox con_NewCouponBox">
        <div class="SideBoxTitle">
          <h2> 社区新闻</h2>
          <span><a href="./bbsx/">更多>></a></span> </div>
        <div class="SideBoxCon NewCouponBoxCon"> {section name=sec1 loop=$hxlifenewsarr}
          <p> <a href="bbsx/forum.php?mod=viewthread&tid={$hxlifenewsarr[sec1].tid}&extra=page%3D1" title="{$hxlifenewsarr[sec1].subject}">{$hxlifenewsarr[sec1].subject|truncate:18}</a></p>
          {/section} </div>
      </div>
      <!--右广告-->
      
       <div class="con_SideBox con_NewCouponBox">
	   
	   
	   <!--关于我们-->
     
    <div class="SideBoxTitle">
      <h2> 汇享推荐</h2>
      <span><!--<a href="#">更多>></a>--></span> </div>
    <div class="SideBoxCon NewCouponBoxCon"> {section name=sec1 loop=$tuiarr}
      <p> <a target="_blank" href="shopDetail.php?prid={$tuiarr[sec1].SysProductsID}">{$tuiarr[sec1].ProductName}</a></p>
      {/section} </div>
  </div> 
  <div class="con_SideBox con_AboutUsBox">
        <div class="SideBoxTitle">
          <h2> 关注我们</h2>
          <span><a href="#">更多>></a></span> </div>
        <div class="SideBoxCon AboutUsBoxCon clearfix"> <a href="http://weibo.com/2383440552"> <img width="106" height="33" alt="" src="images/btn_AboutUs1.png" /></a> <a href="http://t.qq.com/E771041783"> <img width="106" height="33" alt="" src="images/btn_AboutUs2.png" /></a> </div>
      </div>
    </div>
  </div>
</div>
<!--页脚--> 
{include file="footer.tpl"}
</body>
</html>
