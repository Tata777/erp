 <?php
	if( !class_exists('mysqldb') )
	{
		require_once(dirname(__FILE__)."/../config.inc.php");
		include_once(CFG_LIB_DIR.'mysqldb.inc.php');
	}
class clsRollingShow extends mysqldb
{
    function RollShow($picArray = Null, $linkArray = Null, $textArray = Null, $Width = "", $Height ="", $Text_Height ="")
		{
?>

<script type="text/javascript">
	var focus_width=<?php echo $Width;?>;

	var focus_height=<?php echo $Height;?>;

	var text_height=<?php echo $Text_Height;?>;

	var swf_height = focus_height+text_height;
	
	var pics='<?php echo implode("|", $picArray); ?>';

	var links='<?php echo implode("|", $linkArray); ?>';

	var texts='<?php echo implode("|", $textArray); ?>';

	
	document.write('<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="'+ focus_width +'" height="'+ swf_height +'">');

	document.write('<param name="allowScriptAccess" value="sameDomain"><param name="movie" value="images/viewer.swf"><param name="quality" value="high"><param name="bgcolor" value="#DADADA">');

	document.write('<param name="menu" value="false"><param name=wmode value="opaque">');

	document.write('<param name="FlashVars" value="pics='+pics+'&links='+links+'&texts='+texts+'&borderwidth='+focus_width+'&borderheight='+focus_height+'&textheight='+text_height+'">');

	document.write('<embed src="images/viewer.swf" wmode="opaque" FlashVars="pics='+pics+'&links='+links+'&texts='+texts+'&borderwidth='+focus_width+'&borderheight='+focus_height+'&textheight='+text_height+'" menu="false" bgcolor="#DADADA" quality="high" width="'+ focus_width +'" height="'+ focus_height +'" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />');

	document.write('</object>');

</script>
<?php

	}
}
?>