<?php
if( !class_exists('mysqldb') )
{
    require_once(dirname(__FILE__)."/../config.inc.php");
    include_once(CFG_LIB_DIR.'mysqldb.inc.php');
}

if( !class_exists('clsFile') )
{
    require_once(dirname(__FILE__)."/../config.inc.php");
    include_once(CFG_LIB_DIR.'file.php');
}

if( !class_exists('ShowPage') )
{
    require_once(dirname(__FILE__)."/../config.inc.php");
    include_once(CFG_LIB_DIR.'page.php');
}

class clsBlock extends mysqldb
{
    private $strBlockDir;
    private $strTmpDir;
    private $arrMapColumn;
    private $strHash;
    private $strFileName;
    private $intTotalRecord;
    public $arrLinkAry;

    function __construct()
    {
        parent::__construct();
        $this->strCacheDir = dirname(__FILE__)."/../cache/";
        $this->strBlockDir = dirname(__FILE__)."/../blocks/";

        $this->arrMapColumn = array(
            "info" => array(
                "ID" => "i.`InfoID`",
                "CateID" => "i.`CateID`",
                "SpecialID" => "i.`SpecialID`",
                "CreateTime" => "i.`CreationDate`",
                "StartTime" => "i.`PublishDate`",
                "SortNum" => "i.`SortNum`",
                "TopNum" => "i.`TopNum`",
                "ExtractNum" => "i.`ExtractNum`",
                "IsAuditing" => "i.`IsAuditing`",
                "Lang" => "i.`Lang`",
                "Img" => "i.`FirstPhoto`",
                "Subject" => "Title",
                "SubjectColor" => "TitleColor",
                "Intro" => "Intro",
                "Content" => "Content",
                "CustomLinks" => "CustomLinks",
                "Table" => "`".con_strPREFIX."info` AS i",
                "Column" => "i.*",
                "JoinCate" => array("Column" => "ic.`CateName`", "Table" => "`".con_strPREFIX."infocategory` AS ic ON i.`CateID` = ic.`InfoCategoryID`"),
                "JoinSpecial" => array("Column" => "sp.`CateName` AS `SpecialName`", "Table" => "`".con_strPREFIX."specialcate` AS sp ON i.`SpecialID` = sp.`SpecialCateID`")
            ),
            "sysproduct" => array(
                "ID" => "i.`SysProductsID`",
								"Tag" => "i.`Tag`",
                "CateID" => "i.`CateID`",
								"SpecialID" => "i.`BrandID`",
                "StartTime" => "i.`PublishDate`",
                "SortNum" => "i.`SortNum`",
                "TopNum" => "i.`TopNum`",
                "ExtractNum" => "i.`ExtractNum`",
                "Lang" => "i.`Lang`",
                "Img" => "i.`FirstPhoto`",
								"Keyword" => "i.`Material`",
                "Subject" => "ProductName",
                "Search" => "ProductName",
                "Content" => "Note",
								"Photos1" => "Photos1",
								"Photos2" => "Photos2",
								"Photos3" => "Photos3",
                "Table" => "`".con_strPREFIX."sys_products` AS i",
                "Column" => "i.*",
                "JoinCate" => array("Column" => "ic.`CateName`", "Table" => "`".con_strPREFIX."sys_procategory` AS ic ON i.`CateID` = ic.`SysProCategoryID`"),
                "JoinSpecial" => array("Column" => "sp.`CateName` AS `SpecialName`", "Table" => "`".con_strPREFIX."brandcategory` AS sp ON i.`BrandID` = sp.`BrandCategoryID`")
            ),
            "link" => array(
                "ID" => "i.`LinkID`",
                "CateID" => "i.`CateID`",
                "StartTime" => "i.`PublishDate`",
                "SortNum" => "i.`SortNum`",
                "IsAuditing" => "i.`IsAuditing`",
                "Lang" => "i.`Lang`",
                "Img" => "i.`LogoPic`",
                "Subject" => "LinkName",
                "Table" => "`".con_strPREFIX."link` AS i",
                "Column" => "i.*",
                "JoinCate" => array("Column" => "ic.`CateName`", "Table" => "`".con_strPREFIX."linkcategory` AS ic ON i.`CateID` = ic.`LinkCategoryID`")
            ),






            //
            "cart_order" => array(
                "ID" => "i.`c_id`",
                //"CateID" => "i.`CateID`",
                "StartTime" => "i.`c_date`",
                "MemberID" => "i.`MemberID`",
                //"SortNum" => "i.`SortNum`",
                //"IsAuditing" => "i.`IsAuditing`",
                "Lang" => "i.`Lang`",
                //"Img" => "i.`LogoPic`",
                "Subject" => "sn",
                "Table" => "`".con_strPREFIX."cart_order` AS i",
                "Column" => "i.*",
                "JoinMember" => array("Column" => "im.`MemberName`, im.`Honesty`, im.`PerlName`, im.`PerlSex`, im.`PerlPost`, im.`PerlEmail`, im.`PerlPhone`, im.`PerlFax`, im.`PerlMobile`, im.`CmpType`, im.`CmpName`, im.`CmpProvince`, im.`CmpCity`, im.`CmpAddress`, im.`CateID` AS MemberCateID, im.`CmpAim`, im.`CmpSell`, im.`CmpStock`, im.`CmpIntro`, im.`RegistDate`, im.`Role`, im.`Clicks`, pv.`CateName` AS Province, ct.`CateName` AS City", "Table" => "`".con_strPREFIX."member` AS im ON i.`MemberID` = im.`MemberID`")																							),
            //																							



            "down" => array(
                "ID" => "i.`DownID`",
                "CateID" => "i.`CateID`",
                "StartTime" => "i.`PublishDate`",
                "SortNum" => "i.`SortNum`",
                "IsAuditing" => "i.`IsAuditing`",
                "IsMember" => "i.`IsMember`",
                "Lang" => "i.`Lang`",
                //"Img" => "i.`LogoPic`",
                "Subject" => "DownName",
                "Table" => "`".con_strPREFIX."down` AS i",
                "Column" => "i.*",
                "JoinCate" => array("Column" => "ic.`CateName`", "Table" => "`".con_strPREFIX."downcategory` AS ic ON i.`CateID` = ic.`DownCategoryID`")
            ),

            "recruitment" => array(
                "ID" => "i.`RecruitmentID`",
                "Subject" => "JobName",
                "CateID" => "i.`CateID`",
                "IsAuditing" => "i.`IsAuditing`",
                "CreateTime" => "i.`PublishDate`",
                "StartTime" => "i.`StartDate`",
                "EndTime" => "i.`EndDate`",
                "SortNum" => "i.`SortNum`",
                "Lang" => "i.`Lang`",
                "Table" => "`".con_strPREFIX."recruitment` AS i",
                "Column" => "i.*",
                "JoinCate" => array("Column" => "ic.`CateName`", "Table" => "`".con_strPREFIX."recruitmentcategory` AS ic ON i.`CateID` = ic.`RecruitmentCategoryID`")
            ),
            "research" => array(
                "ID" => "i.`id`",
                "Subject" => "i.`sortName`",
                "Table" => "`".con_strPREFIX."researchcategory` AS i",
                "IsAuditing" => "i.`ifdisplay`",
                "Column" => "i.*"
            ),

            "guestbook" => array(
                "ID" => "i.`guest_id`",
                "Subject" => "i.`guest_title`",
                "StartTime" => "i.`guest_date`",
                "Lang" => "i.`guest_lan`",
                "Table" => "`".con_strPREFIX."guestbook` AS i",
                "Column" => "i.*"
            ),
            "syscatemap" => array(
                "info" => array
                (
                    "SysCateID"		=> "sc.`InfoCategoryID`",
                    "Table"				=> "`".con_strPREFIX."infocategory` AS sc"
                ),
                "link" => array
                (
                    "SysCateID"		=> "sc.`LinkCategoryID`",
                    "Table" 			=> "`".con_strPREFIX."linkcategory` AS sc"
                ),
                "down" => array
                (
                    "SysCateID"		=> "sc.`DownCategoryID`",
                    "Table" 			=> "`".con_strPREFIX."downcategory` AS sc"
                ),
                "recruitment" => array
                (
                    "SysCateID"		=> "sc.`RecruitmentCategoryID`",
                    "Table" 			=> "`".con_strPREFIX."recruitmentcategory` AS sc"
                ),
                "sysproduct" => array
                (
                    "SysCateID"		=> "sc.`SysProCategoryID`",
                    "Table" 			=> "`".con_strPREFIX."sys_procategory` AS sc"
                )
            )
        );
    }

                /**************************************************************
                depiction：截字函数
                @param p_strIn 需要截取的字符串
                @param p_intLen 截取长度
                @param p_blnDot 是否显示"..."
                @returns string
                Creater：sun
                Create Date：2007-12-15
                ***************************************************************/
    public function strSubString($p_strIn, $p_intLen, $p_blnDot)
    {
        $p_strIn = preg_replace("/<.+?>/is", "", $p_strIn);
        $p_strIn = preg_replace("/&nbsp;/is", " ", $p_strIn);

        preg_match_all("/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/", $p_strIn, $arrCharacter);
        if (count($arrCharacter[0])>$p_intLen)
        { 
            return join("", array_slice($arrCharacter[0], 0, $p_intLen)).($p_blnDot == "1" ? "..." : ""); 
        } 

        return join("",array_slice($arrCharacter[0], 0, $p_intLen));
    }

                /**************************************************************
                depiction：Dump数据集
                @param p_arrData 数据集
                @returns void
                Creater：sun
                Create Date：2008-3-3
                ***************************************************************/
    public function Dump($p_arrData)
    {
        echo "<pre>";
        var_dump($p_arrData);
        echo "</pre>";
        exit();
    }

    private function arrGetResult($p_strBlockType, $p_arrParameter)
    {
        $strColumn = $this->arrMapColumn[$p_strBlockType]['Column'];
        $strTable = $this->arrMapColumn[$p_strBlockType]['Table'];
        $strCondition = " WHERE 1 ";
        $strLimit = " LIMIT ";

        if(array_key_exists("SysCateType", $p_arrParameter) && $p_arrParameter['SysCateType'])
        {
            $arrMap = $this->arrMapColumn['syscatemap'][$p_arrParameter['SysCateType']];
            $arrMap['ID'] = $arrMap['SysCateID'];
            $arrMap['Column'] = "sc.*";
            $arrMap['Subject'] = "CateName";
            $arrMap['Intro'] = "Intro";
            $arrMap['SortNum'] = "sc.`SortNum`";
            $arrMap['CustomLinks'] = "sc.`CustomLink`";
            $arrMap['ParentID'] = "sc.`ParentID`";
						$arrMap['Photos1'] = "sc.`Photos1`";
						$arrMap['Photos2'] = "sc.`Photos2`";
						$arrMap['Photos3'] = "sc.`Photos3`";
            $this->arrMapColumn[$p_strBlockType] = $arrMap;

            $strColumn = $this->arrMapColumn[$p_strBlockType]['Column'];
            $strTable = $this->arrMapColumn[$p_strBlockType]['Table'];
        }

        if(array_key_exists("ShowCategory", $p_arrParameter) && $p_arrParameter['ShowCategory'])
        {
            $strColumn .= ",".$this->arrMapColumn[$p_strBlockType]['JoinCate']['Column'];
            $strTable .= " LEFT JOIN ".$this->arrMapColumn[$p_strBlockType]['JoinCate']['Table'];
        }

        if(array_key_exists("ShowMemberDetail", $p_arrParameter) && $p_arrParameter['ShowMemberDetail'])
        {
            $strColumn .= ",".$this->arrMapColumn[$p_strBlockType]['JoinMember']['Column'];
            $strTable .= " LEFT JOIN ".$this->arrMapColumn[$p_strBlockType]['JoinMember']['Table'];
        }

        if(array_key_exists("ShowSndType", $p_arrParameter) && $p_arrParameter['ShowSndType'])
        {
            $strColumn .= ",".$this->arrMapColumn[$p_strBlockType]['JoinSndType']['Column'];
            $strTable .= " LEFT JOIN ".$this->arrMapColumn[$p_strBlockType]['JoinSndType']['Table'];
        }

        if(array_key_exists("ShowSpecial", $p_arrParameter) && $p_arrParameter['ShowSpecial'])
        {
            $strColumn .= ",".$this->arrMapColumn[$p_strBlockType]['JoinSpecial']['Column'];
            $strTable .= " LEFT JOIN ".$this->arrMapColumn[$p_strBlockType]['JoinSpecial']['Table'];
        }


        if(array_key_exists("ItemID", $p_arrParameter))
        {
            $strCondition .= " AND ".$this->arrMapColumn[$p_strBlockType]['ID']." IN (".$p_arrParameter['ItemID'].")";
        }

        if(array_key_exists("MemberID", $p_arrParameter))
        {
            $strCondition .= " AND ".$this->arrMapColumn[$p_strBlockType]['MemberID']." IN (".$p_arrParameter['MemberID'].")";
        }

        if(array_key_exists("CateID", $p_arrParameter))
        {
            if(array_key_exists("SubCate", $p_arrParameter) && $p_arrParameter['SubCate'] == "1")
            {
                $arrTemCate = explode(",", $p_arrParameter['CateID']);
                if(is_array($arrTemCate))
                {
                    foreach ($arrTemCate as &$strCateID)
                    {
                        $strCateID = $this->arrMapColumn[$p_strBlockType]['CateID']. " LIKE '".$strCateID."%'";
                    }
                }
                $strCondition .= " AND (".implode(" OR ", $arrTemCate).")";
            }
            else
            {
                $strCondition .= " AND ".$this->arrMapColumn[$p_strBlockType]['CateID']." IN (".$p_arrParameter['CateID'].")";
            }
        }

        if(array_key_exists("SysCateID", $p_arrParameter))
        {
            if(array_key_exists("SubSysCate", $p_arrParameter) && $p_arrParameter['SubSysCate'] == "1")
            {
                $arrTemCate = explode(",", $p_arrParameter['SysCateID']);
                if(is_array($arrTemCate))
                {
                    foreach ($arrTemCate as &$strCateID)
                    {
                        $strCateID = $this->arrMapColumn[$p_strBlockType]['SysCateID']. " LIKE '".$strCateID."%'";
                    }
                }
                $strCondition .= " AND (".implode(" OR ", $arrTemCate).")";
            }
            else
            {
                $strCondition .= " AND ".$this->arrMapColumn[$p_strBlockType]['SysCateID']." IN (".$p_arrParameter['SysCateID'].")";
            }
        }

        if(array_key_exists("SpecialID", $p_arrParameter))
        {
            if(array_key_exists("SubSpecCate", $p_arrParameter) && $p_arrParameter['SubSpecCate'] == "1")
            {
                $arrTemCate = explode(",", $p_arrParameter['SpecialID']);
                if(is_array($arrTemCate))
                {
                    foreach ($arrTemCate as &$strCateID)
                    {
                        $strCateID = $this->arrMapColumn[$p_strBlockType]['SpecialID']. " LIKE '".$strCateID."%'";
                    }
                }
                $strCondition .= " AND (".implode(" OR ", $arrTemCate).")";
            }
            else
            {
                $strCondition .= " AND ".$this->arrMapColumn[$p_strBlockType]['SpecialID']." IN (".$p_arrParameter['SpecialID'].")";
            }
        }		

        if(array_key_exists("SndType", $p_arrParameter))
        {
            $strCondition .= " AND ".$this->arrMapColumn[$p_strBlockType]['SndID']." = ".$p_arrParameter['SndType'];
        }

        if(array_key_exists("CreateTime", $p_arrParameter))
        {
            $strCondition .= " AND UNIX_TIMESTAMP() - ".$this->arrMapColumn[$p_strBlockType]['CreateTime']." < ".$p_arrParameter['CreateTime'];
        }

        if(array_key_exists("StartTime", $p_arrParameter))
        {
            $strCondition .= " AND UNIX_TIMESTAMP() - ".$this->arrMapColumn[$p_strBlockType]['StartTime']." < ".$p_arrParameter['StartTime'];
        }

        if(array_key_exists("EndTime", $p_arrParameter))
        {
            $strCondition .= " AND UNIX_TIMESTAMP() - ".$this->arrMapColumn[$p_strBlockType]['EndTime']." < ".$p_arrParameter['EndTime'];
        }
				
				if(array_key_exists("Tag", $p_arrParameter))
        {
            $strCondition .= " AND ".$this->arrMapColumn[$p_strBlockType]['Tag']." BETWEEN ".str_replace(",", " AND ", $p_arrParameter['Tag']);
        }
				
				
        if(array_key_exists("SortNum", $p_arrParameter))
        {
            $strCondition .= " AND ".$this->arrMapColumn[$p_strBlockType]['SortNum']." BETWEEN ".str_replace(",", " AND ", $p_arrParameter['SortNum']);
        }
        if(array_key_exists("Search", $p_arrParameter))
        {
            $strCondition .= " AND ".$this->arrMapColumn[$p_strBlockType]['Search']." LIKE '%".$p_arrParameter['Search']."%'";
        }
        if(array_key_exists("TopNum", $p_arrParameter))
        {
            $strCondition .= " AND ".$this->arrMapColumn[$p_strBlockType]['TopNum']." BETWEEN ".str_replace(",", " AND ", $p_arrParameter['TopNum']);
        }

        if(array_key_exists("ExtractNum", $p_arrParameter))
        {
            $strCondition .= " AND ".$this->arrMapColumn[$p_strBlockType]['ExtractNum']." BETWEEN ".str_replace(",", " AND ", $p_arrParameter['ExtractNum']);
        }

        if(array_key_exists("IsAuditing", $p_arrParameter))
        {
            $strCondition .= " AND ".$this->arrMapColumn[$p_strBlockType]['IsAuditing']." = ".$p_arrParameter['IsAuditing'];
        }

        if(array_key_exists("IsMember", $p_arrParameter))
        {
            $strCondition .= " AND ".$this->arrMapColumn[$p_strBlockType]['IsMember']." = ".$p_arrParameter['IsMember'];
        }

        if(array_key_exists("Lang", $p_arrParameter))
        {
            $strCondition .= " AND ".$this->arrMapColumn[$p_strBlockType]['Lang']." = '".$p_arrParameter['Lang']."'";
        }

        if(array_key_exists("HasImg", $p_arrParameter))
        {
            if($p_arrParameter['HasImg'] == "1")
                $strCondition .= " AND ".$this->arrMapColumn[$p_strBlockType]['Img']." != ''";
            else
                $strCondition .= " AND ".$this->arrMapColumn[$p_strBlockType]['Img']." = ''";
        }

				if(array_key_exists("HasImg2", $p_arrParameter))
        {
            if($p_arrParameter['HasImg2'] == "1")
                $strCondition .= " AND ".$this->arrMapColumn[$p_strBlockType]['Photos1']." != ''";
            else
                $strCondition .= " AND ".$this->arrMapColumn[$p_strBlockType]['Photos1']." = ''";
        }

        if(array_key_exists("Keyword", $p_arrParameter))
        {
            $strCondition .= " AND ".$this->arrMapColumn[$p_strBlockType]['Keyword']." LIKE '%".str_replace("'", "''", $p_arrParameter['Keyword'])."%'";
        }

        if(array_key_exists("MemberID", $p_arrParameter))
        {
            $strCondition .= " AND ".$this->arrMapColumn[$p_strBlockType]['MemberID']." IN (".$p_arrParameter['MemberID'].")";
        }

        if(array_key_exists("ParentID", $p_arrParameter))
        {
            $strCondition .= " AND ".$this->arrMapColumn[$p_strBlockType]['ParentID']." IN (".$p_arrParameter['ParentID'].")";
        }

        if(array_key_exists("Order", $p_arrParameter))
        {
            $strCondition .= " ORDER BY ".$p_arrParameter['Order'];
        }

        if(array_key_exists("PerPage", $p_arrParameter))
        {
            $strRecordCountSQL = "SELECT COUNT(*) FROM $strTable $strCondition";
            parent::query($strRecordCountSQL);
            $arrTotalResult = parent::get_data();

            $page = new ShowPage();
            $page->Total = $arrTotalResult[0][0];
            $page->PageSize = $p_arrParameter['PerPage'];
            $page->LinkAry = $this->arrLinkAry;
            $strLimit .= $page->OffSet();
            $this->strPageLink = $page->ShowLink();				
            $this->intTotalRecord = $arrTotalResult[0][0];
        }
        else
        {
					if(array_key_exists("Limit", $p_arrParameter))
					{
						$strLimit .= $p_arrParameter['Limit'];
					}else{
						$strLimit = "";
					}
        }

        $strSQL = "SELECT $strColumn FROM $strTable $strCondition $strLimit";
        parent::query($strSQL);
        $arrResult = parent::get_data();

        //$arrResult['sql'] = $strSQL;

        return $arrResult;			
    }

    private function arrGetFilter($p_strBlockType, $p_arrParameter, $p_arrResult)
    {
        if(is_array($p_arrResult))
        {
            foreach($p_arrResult as &$Record)
            {
                if(array_key_exists("SubjectLen", $p_arrParameter))
                {
                    $Record['SubjectAll'] = $Record[$this->arrMapColumn[$p_strBlockType]['Subject']];
                    $Record[$this->arrMapColumn[$p_strBlockType]['Subject']] = $this->strSubString($Record[$this->arrMapColumn[$p_strBlockType]['Subject']], $p_arrParameter['SubjectLen'], $p_arrParameter['SubjectDot']);
                }

                if(array_key_exists($this->arrMapColumn[$p_strBlockType]['SubjectColor'], $Record) && $Record[$this->arrMapColumn[$p_strBlockType]['SubjectColor']])
                {
                    $Record[$this->arrMapColumn[$p_strBlockType]['Subject']] = "<span style=\"color: ".$Record[$this->arrMapColumn[$p_strBlockType]['SubjectColor']].";\">".$Record[$this->arrMapColumn[$p_strBlockType]['Subject']]."</span>";
                }

                if(array_key_exists("IntroLen", $p_arrParameter))
                {
                    $Record[$this->arrMapColumn[$p_strBlockType]['Intro']] = $this->strSubString($Record[$this->arrMapColumn[$p_strBlockType]['Intro']], $p_arrParameter['IntroLen'], $p_arrParameter['IntroDot']);
                }

                if(array_key_exists("MessageLen", $p_arrParameter))
                {
                    $Record[$this->arrMapColumn[$p_strBlockType]['Content']] = $this->strSubString($Record[$this->arrMapColumn[$p_strBlockType]['Content']], $p_arrParameter['MessageLen'], $p_arrParameter['MessageDot']);
                }

                if(array_key_exists("CustomLinks", $Record))
                {
                    $Record[$this->arrMapColumn[$p_strBlockType]['CustomLinks']] = "onclick=\"this.href='".$Record[$this->arrMapColumn[$p_strBlockType]['CustomLinks']]."'\"";
                }
            }
        }

        return $p_arrResult;
    }

    private function vodCreateBlock($p_strBlockType, $p_strParameter)
    {
        $arrTem = explode("/", $p_strParameter);
        $arrParameter = array();

        if(is_array($arrTem))
        {
            $arrTemLen = count($arrTem);

            for($intCount = 0; $intCount < $arrTemLen; $intCount += 2)
            {
                $arrParameter[$arrTem[$intCount]] = $arrTem[($intCount + 1)];
            }

            $arrResult = $this->arrGetResult($p_strBlockType, $arrParameter);

            $arrResult = $this->arrGetFilter($p_strBlockType, $arrParameter, $arrResult);

            $arrParameter['VarName'] = ($arrParameter['VarName']) ? $arrParameter['VarName'] : "Last";
            $_BLOCK[$arrParameter['VarName']] = $_LBLOCK = $arrResult;

            $strContent  = "<?php\n\t global \$_BLOCK, \$_LBLOCK;\n\t \$_BLOCK['".$arrParameter['VarName']."'] = \$_LBLOCK = ".var_export($arrResult, true).";\n\t \$_BLOCK['".$arrParameter['VarName']."_multipage'] = ".var_export($this->strPageLink, true).";\n\t \$_BLOCK['".$arrParameter['VarName']."_TotalRecord'] = ".var_export($this->intTotalRecord, true).";\n ?>";

            if((isset($arrParameter['FileName']) && $arrParameter['FileName']) || $arrParameter['Tpl'])
            {
                ob_start();

                if(isset($arrParameter['FileName']) && $arrParameter['FileName'])
                {
                    include($this->strBlockDir.$arrParameter['FileName']);
                }
                else
                {
                    if($arrParameter['Tpl'] != "data")
                    {
                        include($this->strBlockDir.$arrParameter['Tpl']);
                    }
                }

                $strContent .= ob_get_contents();
                ob_end_clean();
            }

            $objFile = new clsFile();
            $objFile->vodWriteFile($this->strFileName, $strContent);				
        }
    }

    public function Get($p_strBlockType, $p_strParameter, $p_intCacheTime = 900)
    {
        if(strpos($p_strParameter, "PerPage") === false)
        {
            $this->strHash = sha1($p_strBlockType.$p_strParameter);
        }
        else
        {
            $this->strHash = sha1($p_strBlockType.$p_strParameter.$_GET['page']);
        }

        if(!file_exists($this->strCacheDir.$p_strBlockType."/"))
        {
            @mkdir($this->strCacheDir.$p_strBlockType."/");
            @chmod($this->strCacheDir.$p_strBlockType."/", 0777);
        }

        $this->strFileName = $this->strCacheDir.$p_strBlockType."/".$this->strHash.".php";

        switch(CACHE_TYPE)
        {
            //缓存类型:		0.关闭		1.开启		2.所有缓存时间为'ALL_CACHE_TIME'的值
        case 0:
            $this->vodCreateBlock($p_strBlockType, $p_strParameter);
            break;

        case 1:
            if((time() - @filemtime($this->strFileName)) >= $p_intCacheTime)
            {
                $this->vodCreateBlock($p_strBlockType, $p_strParameter);
            }
            break;

        case 2:
            if((time() - @filemtime($this->strFileName)) >= ALL_CACHE_TIME)
            {
                $this->vodCreateBlock($p_strBlockType, $p_strParameter);
            }
            break;
        }

        include($this->strFileName);
    }

    public function GetBlockDir()
    {
        return $this->strBlockDir;
    }
}
?>
