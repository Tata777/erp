<?php
include "includeFiles.php";
include "checklogin.php";
if(empty($cateid)) $cateid=11010;
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
<script language="javascript">
now = new Date();
erke = now.getSeconds();
erke = erke - parseInt(erke/3)*3 + 1;//定义张数
</script>
</head>
<script language="javascript">
document.write("<body style='background:url(images/bg"+erke+".jpg) repeat-y center; background-attachment: fixed;'>")
</script>
<?php include_once('header.php');?>
<div class="mainbg mid">
  <div class="main-content mid transparent-w">
    <div class="main-list">
      <div class="main-list-bt">我的班(年)级 <span>Class</span></div>
      <ul>
        <li><a href="class.php">班级列表</a></li>
        <li><a href="myClass.php">我的班级</a></li>
        <li class="current"><a href="addClass.php">创建班级</a></li>
      </ul>
    </div>
    <div class="main-txt">
      <div class="main-bt">
        <div class="main-bt-l">创建班级</div>
        <div class="main-bt-r"><a href="index.php">首页</a> > <a href="class.php">我的班(年)级</a> > 创建班级</div>
      </div>
      <div class="main-searchbg blank2">
        <?PHP
  
   if($action == 'createClass'){
        if(empty($agree)){
		   echo "<script>alert('必须阅读并同意以下《申请须知》!');history.go(-1);</script>";
			 exit;
		}
  
  	include("UpImage.php");
	
 
	if($_FILES['pic']['size'] > 0)
	{
	
	 $luji="./uploadfile/head/";
	 $PhotoName=UpPhoto($luji,$_FILES);
	} else {
	$PhotoName = $pic;
	}
  

  
     //   mysql_query("BEGIN"); //或者mysql_query("START TRANSACTION");
		$SQL=" insert into  hy_b_class (`className`,`nianJi`,`memberID`,`xuanYuan`,`banji`,`pic`,`zhuanye`)values
    ('".$className."','".$nianJi."','".$_SESSION['user_id']."','".$xuanyuan."','".$banji."','".$PhotoName."','".$zhuanye."');  ";
		$result1 = $objDb->query($SQL);
		
		$SQL=" SELECT id FROM hy_b_class where memberID ='".$_SESSION['user_id']."' order by id desc limit 1 ";
		$objDb->query($SQL);
		$result2 = $objDb->get_data();
		
		$SQL=" insert into  hy_b_classitem (`classid`,`memberID`,`position`,`state`)values('".$result2[0]['id']."','".$_SESSION['user_id']."','创建者',1);  ";
		$result3 = $objDb->query($SQL);
	
	  
	    $msg = $_SESSION['user_name'].'创建了班级！';
	    $sql = " insert into hy_b_dongtai(`classid`,`msg`,`date`,`memberID`)values('".$result2[0]['id']."','".$msg."','".time()."','".$_SESSION['user_id']."')";
		$objDb->query($sql);
	
		if($result1 && $result2 && $result3){
		//	mysql_query("COMMIT");
			echo "<script>alert('创建班级成功!');history.go(-1);</script>";
			exit;
		}else{
		//	mysql_query("ROLLBACK");
 			echo "<script>alert('创建班级失败，请稍候再试!');history.go(-1);</script>";
		    exit;
		}
		
		mysql_query("END"); 
					
		 
 }
  
  ?>
        <form action="" method="post"  enctype="multipart/form-data">
          <input name="action" type="hidden" value="createClass" />
          <table>
            <tr>
              <td> 入学年份:</td>
              <td><select class="s1" name="nianJi">
                  <option>选择入学年份</option>
                  <?php	
	$vm=$info->getProMenu(110);
	if($vm){
	foreach($vm as $key=>$value){
	 ?>
                  <option>
                  <?=$value['CateName']?>
                  年</option>
                  <? } } ?>
                </select></td>
            </tr>
            <tr>
              <td> 系别:</td>
              <td><select  name="className" class="s1">
                  <option>选择院系专业</option>
                  <?php	
				$vm=$info->getProMenu(111);
				if($vm){
				foreach($vm as $key=>$value){
		  ?>
                  <option>
                  <?=$value['CateName']?>
                  </option>
                  <? } } ?>
                </select></td>
            </tr>
            <tr>
              <td> 专业:</td>
              <td><select  name="zhuanye"  id="zhuanye"  class="s1">
                  <option>选择专业</option>
                  <?php	
				$vm=$info->getProMenu(112);
				if($vm){
				foreach($vm as $key=>$value){
		  ?>
                  <option>
                  <?=$value['CateName']?>
                  </option>
                  <? } } ?>
                </select></td>
            </tr>
             <tr>
              <td> 班级 : </td>
              <td><input name="banji"   id="banji" /></td>
            </tr>
            <tr>
              <td> 宣言 : </td>
              <td><textarea name="xuanyuan" cols="30" rows="5" id="xuanyuan"></textarea></td>
            </tr>
            <tr>
              <td> 班级图片：</td>
              <td><input name="pic" type="file" /></td>
            </tr>
          </table>
          <div class="main-search-m2-2"><!--<input name="keyword" class="inputs2" type="text"  value="请输入关键字"  onfocus="this.value=''" />--></div>
          <div class="main-search-r"><!--<input type="image" class="go2"  img src="images/go2.jpg"  name="" alt="Search" border="0" />--></div>
          <div class="addclass blank2">
            <input name="agree" type="checkbox" />
            我已阅读并同意以下《申请须知》
            <input class="btn" type="submit" value="申请班级"/>
          </div>
        </form>
        <div class="addclass blank">
          <textarea cols="80" rows="5" readonly="readonly"> 
          <?
          $SQL="SELECT Intro FROM `hy_b_infocategory` where  `InfoCategoryID`  =117";
		  	$objDb->query($SQL);
		$result = $objDb->get_data();
		  echo $result[0]['Intro'];
		  		  ?>
          </textarea>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include_once('footer.php');?>
</body></html>
