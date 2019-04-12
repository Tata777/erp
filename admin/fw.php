



<HTML xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<TITLE>欢迎进入系统后台</TITLE>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8" />
<META NAME="copyright" CONTENT="Copyright 2004-2008 - xinxi2433.com-STUDIO" />
<META NAME="Author" CONTENT="华景信息科技,wwxinxi2433.com" />
<META NAME="Keywords" CONTENT="" />
<META NAME="Description" CONTENT="" />
<link rel="stylesheet" href="Images/CssAdmin.css">
</HEAD>

<body leftMargin=0 topMargin=0 marginwidth="0" marginheight="0" onload=init();>
<div align="center">
<br />
<h2>
<font color="#FF0000"><strong>欢迎使用企业网站管理系统V2011 SKY 007<br></strong></font></h2>
<table width="819" border="0" cellpadding="3" cellspacing="1" bgcolor="#6298E1">
  <tr>
    <td width="50%" height="24" bgcolor="#EBF2F9"><?php         echo   $_SERVER['USERDOMAIN'] ?>
      当前使用版本：V2011 SKY 007 </td>
    <td width="50%" height="24" bgcolor="#EBF2F9">当前官方版本：V2011 SKY 007 </td>
  </tr>
</table>
<br>
<table width="821" border="0" cellpadding="3" cellspacing="1" bgcolor="#6298E1">
  <tr>
    <td height="24" colspan="2"><font color="#FFFFFF"><img src="images/Explain.gif" width="18" height="18" border="0" align="absmiddle">&nbsp;<strong>服务器信息</strong></font></td>
    </tr>
  <tr>
    <td width="50%" height="24" bgcolor="#EBF2F9">系统类型及版本号:<?php   echo  php_uname(); ?></td>
    <td width="50%" height="24" bgcolor="#EBF2F9">系统类型:<?php        echo   php_uname('s') ?>  </td>
  </tr>
  <tr>
    <td width="50%" height="24" bgcolor="#EBF2F9">系统版本号:<?php      echo   php_uname('r')   ?> </td>
    <td width="50%" height="24" bgcolor="#EBF2F9">PHP运行方式:<?php        echo  php_sapi_name()   ?>   </td>
  </tr>
  <tr>
    <td height="24" bgcolor="#EBF2F9">当前进程用户名:<?php      echo  Get_Current_User() ?></font></td>
    <td height="24" bgcolor="#EBF2F9">PHP版本:<?php            echo  PHP_VERSION ?><!--<font color=red>×</font>--></td>
  </tr>
  <tr>
    <td height="24" bgcolor="#EBF2F9">返回服务器处理请求的端口：<?php    echo   $_SERVER['SERVER_PORT']  ?></td>
    <td height="24" bgcolor="#EBF2F9">服务器IP<?php        echo     GetHostByName($_SERVER['SERVER_NAME']) ?></td>
  </tr>
  <tr>
    <td height="24" bgcolor="#EBF2F9">当前文件绝对路径:<?php  echo   __FILE__ ?></td>
    <td height="24" bgcolor="#EBF2F9">客户端IP<?php          echo  $_SERVER['REMOTE_ADDR'] ?><font color=red>√</font>，支持</td>
  </tr>
  <tr>
    <td height="24" bgcolor="#EBF2F9">PHP安装路径:<?php         echo DEFAULT_INCLUDE_PATH ?></td>
    <td height="24" bgcolor="#EBF2F9">接受请求的服务器IP<?php   echo    $_SERVER["SERVER_ADDR"]    ?></td>
  </tr>
  <tr>
    <td width="50%" height="24" bgcolor="#EBF2F9">域名:<?php        echo  $_SERVER['SERVER_NAME']  ?> </td>
    <td width="50%" height="24" bgcolor="#EBF2F9">Http请求中Host值:<?php  echo   $_SERVER["HTTP_HOST"]  ?></td>
  </tr>
    <tr>
    <td width="50%" height="24" bgcolor="#EBF2F9">服务器语言:<?php        echo  $_SERVER['HTTP_ACCEPT_LANGUAGE']  ?> </td>
    <td width="50%" height="24" bgcolor="#EBF2F9">用户域名:<?php         echo   $_SERVER['USERDOMAIN'] ?></td>
  </tr>
    <tr>
    <td width="50%" height="24" bgcolor="#EBF2F9">服务器域名:<?php        echo  $_SERVER['SERVER_NAME']  ?>  </td>
    <td width="50%" height="24" bgcolor="#EBF2F9">服务器系统目录:<?php    echo  $_SERVER['SystemRoot'] ?></td>
  </tr>
    <tr>
    <td width="50%" height="24" bgcolor="#EBF2F9">服务器CPU数量:<?php     echo  $_SERVER['PROCESSOR_IDENTIFIER'];  ?> </td>
    <td width="50%" height="24" bgcolor="#EBF2F9">服务器解译引擎:<?php   echo   $_SERVER['SERVER_SOFTWARE']  ?></td>
  </tr>
  <tr>
    <td height="24" colspan="2" bgcolor="#D7E4F7">客户端浏览器要求： IE6.0或以上，并关闭所有弹窗的阻拦程序；服务器建议采用：Windows 2000或Windows 2003 Server。</td>
    </tr>
</table>
<br>
<table width="822" border="0" cellpadding="3" cellspacing="1" bgcolor="#6298E1">
  <tr>
    <td height="24" colspan="4"><font color="#FFFFFF"><img src="images/Explain.gif" width="18" height="18" border="0" align="absmiddle">&nbsp;<strong>系统开发，版权所有，授权使用</strong></font></td>
    </tr>
  <tr>
    <td width="15%" height="24" bgcolor="#EBF2F9">系统开发：</td>
    <td width="35%" bgcolor="#EBF2F9">绿意科技</td>
    <td width="14%" height="24" bgcolor="#EBF2F9">产品负责：</td>
    <td width="36%" bgcolor="#EBF2F9">开发组</td>
  </tr>
  <tr>
    <td width="15%" height="24" bgcolor="#EBF2F9">总机电话：</td>
    <td width="35%" height="24" bgcolor="#EBF2F9">0755-36626162</td>
    <td width="14%" height="24" bgcolor="#EBF2F9">产品咨询：</td>
    <td width="36%" height="24" bgcolor="#EBF2F9"> 0755-36626162

</td>
  </tr>
  <tr>
    <td width="15%" height="24" bgcolor="#EBF2F9">技术支持：</td>
    <td width="35%" height="24" bgcolor="#EBF2F9">13640338254</td>
    <td width="14%" height="24" bgcolor="#EBF2F9">客服电话：</td>
    <td width="36%" height="24" bgcolor="#EBF2F9">0755-36626162
</td>
  </tr>
  <tr>
    <td height="24" bgcolor="#EBF2F9">传　　真：</td>
    <td height="24" bgcolor="#EBF2F9">0755-36626162
</td>
    <td height="24" bgcolor="#EBF2F9">电子邮件：</td>
    <td height="24" bgcolor="#EBF2F9">514320008@qq.com</td>
  </tr>
  <tr>
    <td height="24" bgcolor="#EBF2F9">官方网站：</td>

    <td height="24" bgcolor="#EBF2F9"><a href="http://www.grsense.net" target="_blank">www.grsense.net</a></td>
    <td height="24" bgcolor="#EBF2F9">演示站点：</td>
    <td height="24" bgcolor="#EBF2F9"><a href="http://test.xinxi2433.com" target="_blank"></a></td>
  </tr>
  <tr>
    <td height="24" bgcolor="#EBF2F9">帮助中心：</td>
    <td height="24" bgcolor="#EBF2F9">QQ(1962008022) </td>
    <td height="24" bgcolor="#EBF2F9">技术交流：</td>
    <td height="24" bgcolor="#EBF2F9">&nbsp;</td>
  </tr>
  <tr>
    <td height="24" bgcolor="#D7E4F7">授权使用：</td>
    <td height="24" bgcolor="#D7E4F7"></td>
    <td height="24" bgcolor="#D7E4F7">版权所有</td>
    <td height="24" bgcolor="#D7E4F7">©2009-2012CopyRight cecom Co.,LTD</td>
  </tr>
</table>
</div>
</BODY>
</HTML>



