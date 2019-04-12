<?php
include "includeFiles.php";

echo $SQL = " update hy_b_ppc set `clicks`=`clicks`+1,`money`=(`money`+`myPrice`) where  `key` = '".$_GET['key']."'  ";

$msg = $objDb->query( $SQL );





?>