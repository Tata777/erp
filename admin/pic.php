<?

/*
<img src='pic.php?imagename=1.gif&imagewidth=800&imageheight=600&cuteit=0' border=0>
*/

  $imagename=$_GET['imagename'];
  $imagewidth=intval($_GET["imagewidth"])?intval($_GET["imagewidth"]):1024;
  $imageheight=intval($_GET["imageheight"])?intval($_GET["imageheight"]):768;
  $cuteit=intval($_GET["cuteit"]);  // 比例大小不对时是否剪切,1 是 0 否
 
  if(!file_exists($imagename)){ //无图片处理
  	die("Image Resource Error");
		exit();
		$imagename = "images/nopic.jpg";
  }
  if(!function_exists("imagecopyresampled")) die("imagecreatetruecolor() is disabled.");
  
  $imagenametmp = "images/di-1.jpg";
  if(!file_exists($imagenametmp)){ //无图片处理
  	die("Image Resource Error");
  }
	
  $imgsrctmp    = imagecreatefromjpeg($imagenametmp); 

  if(eregi("\.jpg$",$imagename)){ 
     $imgsrc=imagecreatefromjpeg($imagename); 
  }else if(eregi("\.jpeg$",$imagename)){
     $imgsrc=imagecreatefromjpeg($imagename);
  }else if(eregi("\.gif$",$imagename)){
     $imgsrc=imagecreatefromgif($imagename);
  }else if(eregi("\.png$",$imagename)){
     $imgsrc=imagecreatefrompng($imagename);  
  }else die("file type error");
	
	if(imagesy($imgsrc)<=$imageheight and imagesx($imgsrc)<=$imagewidth){
		header("location: $imagename");
	}

    $srcx=0;
	$srcy=0;
	$srcxtmp=0;
	$srcytmp=0;
    if($cuteit==1){ //图片要剪切处理
		if(imagesx($imgsrc)/$imagewidth>imagesy($imgsrc)/$imageheight){
		  $srcx=imagesx($imgsrc)-$imagewidth*imagesy($imgsrc)/$imageheight;
		  $srcy=0;
		}else{
		  $srcx=0;
		  $srcy=imagesy($imgsrc)-$imageheight*imagesx($imgsrc)/$imagewidth;
		}
    }else if ($cuteit==0){ //图像要缩放处理
		$srcx=0;
		$srcy=0;
		$srcxtmp=0;
		$srcytmp=0;
		$percentx = imagesx($imgsrc)/$imagewidth;
		$percenty = imagesy($imgsrc)/$imageheight;
		$tmpx = $imagewidth;
		$tmpy = $imageheight;
	    if (($imageheight>=imagesy($imgsrc)) and ($imagewidth>=imagesx($imgsrc))) {
		  $srcy = imagesy($imgsrc)-$imageheight;
		  $srcx = imagesx($imgsrc)-$imagewidth ;
		}else{
          if ($percentx>$percenty){
       		$srcy =  imagesy($imgsrc)-imagesx($imgsrc)*$tmpy/$tmpx;
			$srcytmp = 1+($tmpy-$tmpx*imagesy($imgsrc)/imagesx($imgsrc))/2;
			$srcxtmp = $tmpx;
	      }else{
     		$srcx =  imagesx($imgsrc)-imagesy($imgsrc)*$tmpx/$tmpy;
			$srcxtmp = 1+($tmpx-$tmpy*imagesx($imgsrc)/imagesy($imgsrc))/2;
			$srcytmp = $tmpy;
		  }
		}
	}
	else if($cuteit==2){ //图像要调整处理
	    if (($imageheight>=imagesy($imgsrc)) and ($imagewidth>=imagesx($imgsrc))) {
		    $imageheight = imagesy($imgsrc);
		    $imagewidth  = imagesx($imgsrc);
		}else{
        	$percentx = $imagewidth/imagesx($imgsrc);
		    $percenty = $imageheight/imagesy($imgsrc);
			if ($percentx>$percenty) {
                //$imageheight = imagesy($imgsrc);
	     	    $imagewidth  = imagesx($imgsrc)*$percenty;
			} else {
                //$imagewidth  = imagesx($imgsrc);
	     	    $imageheight = imagesy($imgsrc)*$percentx;
			}
		}
	}
	
  $imgdst=imagecreatetruecolor($imagewidth,$imageheight); 
	
//  imagecopyresampled($imgdst, $imgsrc, 0, 0, $srcx/2, $srcy/2, imagesx($imgdst), //imagesy($imgdst), imagesx($imgsrc)-$srcx, imagesy($imgsrc)-$srcy); 
  imagecopyresampled($imgdst, $imgsrc, 0, 0, $srcx/2, $srcy/2, imagesx($imgdst), imagesy($imgdst), imagesx($imgsrc)-$srcx, imagesy($imgsrc)-$srcy); 
//bool imagecopyresampled ( resource dst_image, resource src_image, int dst_x, int dst_y, int src_x, int src_y, int dst_w, int dst_h, int src_w, int src_h )

  imagecopyresampled($imgdst, $imgsrctmp, 0, 0, 0, 0, $srcxtmp, $srcytmp, imagesx($imgsrctmp), imagesx($imgsrctmp));
  imagecopyresampled($imgdst, $imgsrctmp, imagesx($imgdst)-$srcxtmp, imagesy($imgdst)-$srcytmp, 0, 0, imagesx($imgdst), imagesy($imgdst), imagesx($imgsrctmp), imagesx($imgsrctmp));
  
  imagejpeg($imgdst,"",80); 

  imagedestroy($imgsrctmp);
  imagedestroy($imgsrc);

?>