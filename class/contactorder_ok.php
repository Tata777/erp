<?php
include "includeFiles.php";

//留言版
 if($pay=="alipy"){

	if($action=="guestmessage"&&$guest_content!=""){
				
			/* 减少已订购的客房*/
		 	$SQL="update  `hy_b_sys_products_order` set `Unit`=Unit-1 where `SysProductsID`='$prid'";
		//die;
			 $objDb->query($SQL);
	
			 $arr=array(
				//"guest_xingSi"=>"$guest_xingSi",
				"guest_name"=>"$guest_name",
				"guest_contact"=>"$guest_contact",
				"guest_email"=>"$guest_email",
				"guest_sex"=>"$guest_sex",
				"guest_num"=>"$guest_num",
				"guest_start"=>"$guest_start",
				"guest_end"=>"$guest_end",
				"guest_price"=>"$houseprice",
				"guest_fuwu"=>"$guest_fuwu",
				"guest_date"=>date('Y-m-d,H:i:s',time()),
				"guest_title"=>"$guest_title",
				"guest_content"=>"$guest_content",
			//	"guest_MBID"=>"$guest_MBID"
				);
		
			include_once ("MFI.php");
			$strSql=MultiFieldInput(hy_b_guest_order,$arr,0);	
			
			
		// echo $strSql;exit;
			  $objDb->query($strSql);
			$blnReSult=$objDb->get_data();
			//var_dump($blnReSult);
			//die;
			
			$toalipay='';
			foreach( $arr as $key=>$value)
			{
		      $toalipay.=$key."=";
		      $toalipay.= $value."&";
	       }	
		   //  $toalipay=urlencode($toalipay);
		if(!$blnReSult){exit("<script type=\"text/javascript\">alert('已下预订！请付款！');location.href='./alipay/index.php?$toalipay'</script>");}
	}
	
}else{
exit("<script type=\"text/javascript\">alert('请打我们的热线电话:0834-6391111 将会有专人为你服务!');history.go(-2);</script>");
}	
?>
