<?php
session_start();
$_SESSION['ad_id']="";
$_SESSION['ad_flag']="";
$_SESSION['ad_username']="";
$_SESSION['ad_truename']="";
$_SESSION['ad_activetime']="";
$_SESSION['IP']="";
session_unset();
session_destroy();
?>
<script lanuage="javascript">
top.location.href="index.php"
</script>