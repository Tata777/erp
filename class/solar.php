<?php
include "includeFiles.php";
include "page.php";
$hcateid=$_GET['hcateid'];
if(empty($hcateid)) $hcateid=110;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta http-equiv="X-UA-Compatible" content="IE=7" />

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $C['Title'];?></title>
<Link href="../uploadfile/ico/<?php echo $C['ICO'];?>" rel="Shortcut Icon">
<meta name="Keywords" content="<?php echo $C['Keywords'];?>">
<meta name="description" content="<?php echo $C['Description'];?>">
<Meta name="Copyright" Content="<?php echo $C['CopyRight'];?>">
<link href="css/reset.css" rel="stylesheet" type="text/css" media="screen" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="screen" />
<script src="Scripts/scroll.js" type="text/javascript"></script>
<script src="Scripts/jquery-1.3.1.js" type="text/javascript"></script>
<script language="javascript" src="Scripts/MSClass.js"></script>
<!--[if lte ie 6]>
<script type="text/javascript" language="javascript"> 
function imgFix() { 
  var widthRestriction = 124; 
  var heightRestriction = 99; 
  var allElements = document.getElementsByTagName('*')   
  for (var i = 0; i < allElements.length; i++) 
  { 
    if (allElements[i].className.indexOf('product_pic') >= 0) 
        { 
      var imgElements = allElements[i].getElementsByTagName('img'); 
      for (var j=0; j < imgElements.length; j++) 
          { 
        if ( imgElements[j].width > widthRestriction || imgElements[j].height > heightRestriction ) 
                { 
          if ( imgElements[j].width > imgElements[j].height) 
                  { 
            imgElements[j].height = imgElements[j].height*(widthRestriction/imgElements[j].width); 
            imgElements[j].width = widthRestriction; 
          } else 
                  { 
            imgElements[j].width = imgElements[j].width*(heightRestriction/imgElements[j].height); 
            imgElements[j].height = heightRestriction; 
          } 
        } 
                if ( imgElements[j].height < heightRestriction ) 
                { 
                  imgElements[j].style.paddingTop = ( heightRestriction -imgElements[j].height ) /9 + "px"; 
                } 
      } /*for j*/ 
    } 
  }/*for i*/ 
} 
window.onload = imgFix; 
</script> 
<![endif]-->
</head>
<body>
<!--顶部banner-->
<?php include_once('header.php');?>
<!--end-->
<!--中部-->
<div class="main_top mid"></div>
<div class="main_nr mid">
   <div class="main_left">
      <div class="list_bt">Product list</div>
              <div class="list">
                 <ul>
<script language="JavaScript">
     <!--
function ShowHideMenu(obj,n) {
var i;

// for(i=1;i<=n;i++){overMenu(obj);}

	if(obj.style.display=="none")
		obj.style.display="block";
	else
		obj.style.display="none";
}

function overMenu(obj) {


		obj.style.display = "none";
}




function ShowHideMenuB(obj,n) {  
var j;

 //for(i=1;j<=n;i++){overMenuB(obj);}

	if(obj.style.display=="none")
		obj.style.display="block";
	else
		obj.style.display="none";
}

function overMenuB(obj) {


		obj.style.display = "none";
}


//function ShowHideMenu2(obj,n) {

//	if(Kav1.style.display=="none")
//		eval("Kav1").style.display="block";
//	else
//		eval("Kav1").style.display="none";
//}

-->

</script>
  <?php	
	$vm=$info->getProMenu(1);
	if($vm){
	foreach($vm as $key=>$value){
		//if($value['SysProCategoryID'] == 111 || $value['SysProCategoryID'] == 112 ) continue;
		
		$vmlist=$info->getProMenu($value['SysProCategoryID']);
		if($vmlist){
	 ?>
                    <li> <a href="JavaScript:ShowHideMenu(m<?=$value['SysProCategoryID']?>);"><img src="images/dot1.jpg" />&nbsp;&nbsp;&nbsp;&nbsp;<?=$value['CateNameEn']?></a></li>    
					
		<? }else{?>
		 			 <li> <a href="product.php?cateid=<?=$value['SysProCategoryID']?>"><img src="images/dot1.jpg" />&nbsp;&nbsp;&nbsp;&nbsp;<?=$value['CateNameEn']?></a></li>    
		<? }?>			   
		
					<? //if($value['SysProCategoryID'] == 110 ) continue; ?>             
					<li id="m<?=$value['SysProCategoryID']?>">
					  <?php	
					
					if($vmlist){
					foreach($vmlist as $key=>$val){
					 ?>
                    <a id="l2" href="product.php?cateid=<?=$val['SysProCategoryID']?>"><img src="images/dot2.jpg" />&nbsp;&nbsp;&nbsp;&nbsp;<?=$val['CateNameEn']?></a>
 					<? }}?>
                    </li>
					<? }}?>
					<li><a href="news.php?cateid=113"><img src="images/dot1.jpg" />&nbsp;&nbsp;&nbsp;&nbsp;Energy solutions</a></li>
             </ul>
             </div>
   </div>
  <div class="main_right">
      <div class="main_right_bt">
         <span class="main_right_bt1"><?=$secondlink=$cateid ? $info->getProLinks($cateid):$info->getProLinks($hcateid)."All product";?></span>
         <span class="main_right_bt2"><a href="index.php">Index</a> > <a href="product.php?hcateid=<?
		  if(isset($cateid)) echo  getsubstr2($cateid,3);
		  else if(isset($hcateid)) echo getsubstr2($hcateid,3);
		 ?>"><?php
		 if(isset($cateid))
		 echo $alink=$info->getProLinks(getsubstr2($cateid,3));
		 elseif(isset($hcateid))
		 echo $alink=$info->getProLinks(getsubstr2($hcateid,3));
		 ?> </a>> <?=$secondlink?></span>
      </div>
      <div class="main_txt">
	  
	 <?php
		 $keyword=$_GET['keyword'];
	if($keyword){
		$condition=" and ProductName like '%$keyword%' ";
	}elseif($cateid){
		$condition=" and CateID='$cateid' ";
	}elseif($hcateid){
		$condition = " and CateID  like '$hcateid%' ";
	}else{
		$condition = " and CateID  like '110%' or  CateID  like '111%' or   CateID  like '112%' ";
	}
	
	
	$SQL="SELECT * FROM `hy_b_sys_products`  where 1 $condition   and Lang='".$cfg_cur_lan."'   ";
	$result=mysql_query($SQL);
	$total=mysql_num_rows($result);
	//调用pageft()，每页显示10条信息（使用默认的20时，可以省略此参数），使用本页URL（默认，所以省略掉）。
	_PAGEFT($total,15);
	if($total==0) echo "<h3>Sorry,no message!</h3>";
	  $SQL2="SELECT * FROM `hy_b_sys_products`  where 1  $condition  and Lang='".$cfg_cur_lan."'   order by `SortNum` asc,`SysProductsID`  desc limit $firstcount,$displaypg  ";
	$result=mysql_query($SQL2);
	while($value=mysql_fetch_array($result)){
	?>
			 <div class="product">
			   <div class="product_pic"><table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<td width="124" height="99" align="center" valign="middle"><a href="product_detail.php?prid=<?=$value['SysProductsID']?>&cateid=<?=$value['CateID']?>"><img src="../admin/pic.php?imagename=../uploadfile/product_b/<?=$value['Photos']?>&amp;imagewidth=125&amp;imageheight=100&amp;cuteit=0"></a></td>
	  </tr>
	</table></div>
	
			   <div class="product_bg"><?=$value['ProductName']?></div>
			 </div>
	
	<? }?>
      </div>
      <div class="page"><?php echo $pagenav; ?></div>
  </div>
      </div>
  </div>
</div>
<div class="main_bottom mid"></div>
<!--底部资料-->  
<?php include_once('footer.php');?>
</body>
</html>