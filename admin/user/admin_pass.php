<?
session_start();
if ($_SESSION["ad_id"]=="" || $_SESSION["ad_flag"]!="demo")
{
echo "<script>
alert('您没有登录或不是管理员，请重新登录！')
top.location.href='../index.php'
</script>";
}
?>