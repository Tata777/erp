<script type="text/javascript">
function initcity(city) {
    switch (document.memberadd["CmpProvince"].value) {
<?php
/*include_once("../../config.inc.php");
include_once(CFG_LIB_DIR.'generic.lib.php');
$objBasic = new clsBase();
include_once(CFG_LIB_DIR.'mysqldb.inc.php');		
$objDb = new mysqldb();
*/
$sql = "select CityID,CateName from ".con_strPREFIX."city where ParentID = 1 order by SortNum asc";
$objDb->query($sql);
$arrRsProvince = $objDb->get_data();
$arrProvince = array();
foreach($arrRsProvince as $Province){
    /*$objBasic->vardump($Province);*/
    $strCase = "case \"".$Province['CateName']."\" :";
		$arrProvince[] = $Province['CityID'].",'".$Province['CateName']."'"; 
    $sqlCity = "select CityID,CateName from ".con_strPREFIX."city where ParentID = '".$Province['CityID']."' order by SortNum asc";
    $objDb->query($sqlCity);
    $arrRsCity = $objDb->get_data();
    $arrCity = array();
		$arrCity[] = "\"选择城市\", \"\"";
    foreach($arrRsCity as $City){
        $arrCity[] = "\"".$City['CateName']."\", \"".$City['CityID']."\"";
    }
    $strCity = implode(",",$arrCity);	

?>
        case "<?=$Province['CityID']?>" :
             var cityOptions = new Array(
						 <?php echo $strCity;?>);
             break;
             <?php }?>
        default:
            var cityOptions = new Array("选择城市", "");
            break;
    }
		document.memberadd["CmpCity"].options.length = 0; 
        for(var i = 0; i < cityOptions.length / 2; i++) {
						if(cityOptions[i*2]){
            document.memberadd["CmpCity"].options[i]=new Option(cityOptions[i*2],cityOptions[i*2+1]);
						}
            if (document.memberadd["CmpCity"].options[i].value==city){
                document.memberadd["CmpCity"].selectedIndex = i;
            }
        }
}

function creatprovince(CmpProvince){
        var provinces = new Array(<?php echo implode(",\n",$arrProvince);?>);
         document.memberadd["CmpProvince"].options[0]=new Option("选择省份","");
        for(var i = 0; i < provinces.length; i++) {
						if(provinces[i*2]){
            document.memberadd["CmpProvince"].options[i+1]=new Option(provinces[i*2+1],provinces[i*2]);
                 if (document.memberadd["CmpProvince"].options[i+1].value==CmpProvince)
								 {
                	document.memberadd["CmpProvince"].selectedIndex = i+1;
            		}
						}
        }
}
/*function pro_info(){
	citys = document.memberadd["CmpProvince"].value + '省';
	document.getElementById("citypr_info").innerHTML =citys ; 
	
}
function city_info(){
	var bb = citys = document.memberadd["CmpProvince"].value + '省' +  document.memberadd["CmpCity"].value + '市';
	document.getElementById("CmpAddress").value = bb;
}*/
</script>

