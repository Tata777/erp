<?
$protectid="201"; 
include ("../protect.php");
include "../../class/page.php";
require("../../class/mysqldb.inc.php");
$db = new mysqldb();

if($action == "auto"){
	$sql = "update hy_b_cj set state = $state  where id = $ids ";
	$msg = $db->query($sql); 
	
	if($state == 3){
	    //向客户虚拟币充钱
		$sql = "update hy_member set `money` = (`money`+$money ) where user_id = $memberID ";
     	$msg = $db->query($sql); 
	}
	
	if($msg) echo "<script>alert('处理成功！');</script>";
	else echo "<script>alert('处理失败！');</script>";
}

if($action == 'search'){
	if($keywords){  $con .= " and c.orderNum like '%$keywords%'"; }
	if($money){  $con .= " and c.price  = '$money' "; }
	if($startDate && $endDate) {
	   $startDate = strtotime($startDate);
	   $endDate = strtotime($endDate);
	   $con .= " and c.createdate between $startDate  and  $endDate ";
	} 
	
	if($member){
	    $con .= " and memberID in (select user_id from hy_member where user_name like  '%".$member."%')";
	}
	if($s_county){
	    $con .= " and c.memberID in (select user_id from hy_member where s_county =".$s_county." )";
	}
	if($s_city){
		$con .= " and c.memberID in (select user_id from hy_member where s_city =".$s_city." )";
	}
	
	if($shop){
	    $con .= " and memberID in (select user_id from hy_member where user_shopname like  '%".$shop."%')";
	}
	
} else {
	if($id){
	   $con .= " and  c.memberID = $id ";
	}
}

$sql = "select c.* from hy_b_cj as c where 1 $con order by c.orderNum desc";
$db->query($sql);
$result=$db->get_data();

?>
<html>
<head>
<title>会员管理</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="../css/css.css" type="text/css">
<script type="text/javascript" src="../js/jquery.js"></script>
<style type="text/css">
<!--
.style1 {
	color: #666666;
	font-weight: bold;
}
body {
	background-color: #F7F7F7;
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
-->
</style>
</head>
<?php include_once("../common/files.php"); ?>
<body text="#000000">
<br>
<div align="right"><a href='index.php'>返回会员中心</a></div>
<div style="height:200px;">
  <table width="33%" height="24"  border="0" align="right" cellpadding="0" cellspacing="0" class="listtable">
    <form name="form1" method="post" action="">
      <input name="action" type="hidden" value="search">
      <tr>
        <td width="15%" height="24" nowrap><span class="style1">订单号:</span>&nbsp;&nbsp; </td>
        <td><input name="keywords" type="text"  size="20" value="<?=$keywords?>"></td>
      </tr>
      <tr>
        <td><span class="style1">会员名:</span>&nbsp;&nbsp;</td>
        <td><input name="member" type="text"  size="20" value="<?=$member?>"></td>
      </tr>
      <tr>
        <td><span class="style1">金额:</span>&nbsp;&nbsp;</td>
        <td><input name="money" type="text"  size="20" value="<?=$money?>"></td>
      </tr>
       <tr>
        <td height="24" nowrap><span class="style1">网店:</span>&nbsp;&nbsp;</td>
        <td>
          <input name="shop" type="text"  size="20" value="<?=$shop?>"></td>
      </tr>
      
          <tr>
        <td height="24" nowrap><span class="style1">县份、区域:</span>&nbsp;&nbsp;</td>
        <td>
               
   <select name="s_city" id="s_city">
           <option value=''>
	       请选择
	      </option>
		    <?php	
		$SQLs=" select * from hy_b_city where ParentID =116  ";
		$db->query($SQLs);
		$results = $db->get_data();
		if($results){
		foreach($results as $key=>$values){
	 ?>
		    <option value="<?=$values['CityID']?>" >
		      <?=$values['CateName']?>
	        </option>
		    <? }}?>
	      </select>
		   <select name="s_county" id="s_county">
	    
	    <option value=''>
	       请选择
	      </option>
	    
      </select>
           <script>
          
$('#s_city').change( function () { 
		$.ajax({
		   type: "get",
		   url: "../../selectcity.php",
		   data: "pid="+this.value,
		   success: function(msg){
			  // alert(msg);
			    $('#s_county').html(msg);
		   }
		});
});


          </script>
          
          </td>
      </tr>
      
      <tr>
        <td><label> 下单时间：</label></td>
        <td><input type="text" name="startDate" id="startDate" size="10" value="<?=$startDate?>" />
          <span>*</span> <img src="../js/jscalendar/img.gif" id="f_trigger_c2"
           style="cursor: pointer; border: 1px solid red;"
           title="Date selector"
           onMouseOver="this.style.background='red';"
           onMouseOut="this.style.background=''" /> 
          <script type="text/javascript">
          Calendar.setup({
              inputField     :    "startDate",
              ifFormat       :    "%Y-%m-%d",
              button         :    "f_trigger_c2",
              align          :    "Tl",
              singleClick    :    false
          });
              </script> 
          -
          <input type="text" name="endDate" id="endDate" size="10" value="<?=$endDate?>" />
          <span>*</span> <img src="../js/jscalendar/img.gif" id="f_trigger_c2"
           style="cursor: pointer; border: 1px solid red;"
           title="Date selector"
           onMouseOver="this.style.background='red';"
           onMouseOut="this.style.background=''" /> 
          <script type="text/javascript">
          Calendar.setup({
              inputField     :    "endDate",
              ifFormat       :    "%Y-%m-%d",
              button         :    "f_trigger_c1",
              align          :    "Tl",
              singleClick    :    false
          });
      </script></td>
      </tr>
      <tr>
        <td width="13%" colspan="2"><input type="submit" name="Submit2" value="搜索"></td>
      </tr>
    </form>
  </table>
  <Br/>
</div>
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="word">
  <tr valign="top">
    <td colspan="4" height="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" height="41" valign="top"><table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolorlight="#999999" bordercolordark="#FFFFFF" bgcolor="#FFFFFF" class="word">
              <tr>
                <td height="30" colspan="12" valign="top"><div align="center">
                    <table width="100%" border="0" cellpadding="0" cellspacing="0" class="bgtitle">
                      <tr>
                        <td height="30" background="../images/center1t.jpg"><table width="332" height="18" border="0" align="left" cellpadding="0" cellspacing="0">
                            <tr>
                              <td width="216" colspan="2"><div align="center"><strong> <img src="../images/pro.jpg" width="24" height="24">会员充值管理</strong></div></td>
                              <td width="116">&nbsp;</td>
                            </tr>
                          </table></td>
                      </tr>
                    </table>
                  </div></td>
              </tr>
              <tr >
                <td width="10%" height="36" align="center" background="../images/title3.gif" ><strong>订单号</strong></td>
                <td width="7%" align="center" background="../images/title3.gif" ><strong>
                汇入我司银行账号</strong></td>
                <td width="7%" align="center" background="../images/title3.gif" ><strong>下单会员</strong></td>
                <td width="10%" align="center" background="../images/title3.gif" ><strong>汇款银行、账号</strong></td>
                <td width="5%" align="center" background="../images/title3.gif" ><strong>汇款方式</strong></td>
                 <td width="3%" align="center" background="../images/title3.gif" ><strong>用户名</strong></td>
                 <td width="5%" align="center" background="../images/title3.gif" ><strong>银行</strong></td>
                <td width="5%" align="center" background="../images/title3.gif" ><strong>存款时间</strong></td>
                <td width="4%" align="center" background="../images/title3.gif" ><strong>充值金额</strong></td>
                <td width="5%" align="center" background="../images/title3.gif" ><strong>下单时间</strong></td>
                <td width="7%" align="center" background="../images/title3.gif" ><strong>状态</strong></td>
                <td width="10%" align="center" background="../images/title3.gif" ><strong>操作</strong></td>
              </tr>
              <?
				$arr = array('1'=>'未处理','2'=>'处理中','3'=>'已处理');
				
				$j=0;
				 if ($result){
				  foreach ($result as $key=>$value){
              ?>
              <tr bgcolor="#f5f5f5">
                <td height="28" align="center"><? echo $value['orderNum'];?>&nbsp;</td>
                
                <td height="28" align="center"><? echo $value['bank'];?>&nbsp;</td>
                
                <td width="7%" align="center">
                <?
	  $SQLX="select * from hy_member  where user_id='".$value['memberID']."' ";
								//echo $SQL;
								$db->query($SQLX);
								$rssX=$db->get_data();
								echo $rssX[0]['user_name'];
								?>
                
                
                &nbsp;</td>
                <td width="8%" align="center"><? echo $value['hkzh'];?>&nbsp;</td>
                <td width="9%" align="center"><? echo $value['czfs'];?>&nbsp;</td>
                
                     <td width="13%" align="center"><? echo $value['name'];?>&nbsp;</td>
                          <td width="13%" align="center"><? echo $value['czbank'];?>&nbsp;</td><td width="13%" align="center"><? echo $value['cksj'];?>&nbsp;</td>
                
                <!--  <td width="11%" align="center"> <? echo ($value['user_sex']=="1"?"男":"女");?>&nbsp;                  </td>-->
                <td width="9%" align="center"><? echo $value['price']; ?></td>
                <td width="8%" align="center"><? echo date("Y-m-d H:i:s",$value['createdate']);?></td>
                <td width="7%" align="center">&nbsp;<? echo $arr[$value['state']];?></td>
                <td width="10%" align="center"><?
				     if($value['state'] == 3){ echo"OK";}else{
				   ?>
                  <a href="javascript:auto(<?=$value['id']?>)" ><b>处理</b></a>
                  <form action=""  id="<?=$value['id']?>" method="get" style="display:none;width:200px" >
                    <input name="action" type="hidden" value="auto">
                    <input name="ids" type="hidden" value="<?=$value['id']?>">
                    <input name="memberID" type="hidden" value="<?=$value['memberID']?>">
                    <input name="money" type="hidden" value="<?php echo $a = $value['price']; $totaoprice[]=$a;?>">
                    <input name="state" type="radio" value="1" checked>
                    未处理
                    <input name="state" type="radio" value="2">
                    处理中
                    <input name="state" type="radio" value="3">
                    已处理
                    <input name="" type="submit"  value="处理">
                  </form>
                  <? }?></td>
              </tr>
              <?
			           }
					}
			   ?>
              <tr class="bgtitle">
                <td height="30" colspan="9"  background="../images/title3.gif" ><div align="center"> </div></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
</table>
<div>
合计充值金额： <?php echo @array_sum($totaoprice);?>
</div>
<script>
  
function auto(a){

    // $("#v"+a).hide();
	 $("#"+a).toggle();
}

</script>
</body>
</html>