<?
session_start();
if ($_SESSION["ad_id"]=="")
{
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />\n<script>
alert('您没有登录或不是管理员，请重新登录！')
top.location.href='index.php'
</script>";
}
?>