<?php
	if( !class_exists('mysqldb') )
	{
		require_once(dirname(__FILE__)."/../../config.inc.php");
		include_once(CFG_LIB_DIR.'mysqldb.inc.php');
	}
	if( !class_exists('clsBase') )
	{
		include_once (CFG_LIB_DIR.'generic.lib.php');
	}
class clsCategoryAct extends mysqldb
{
		private $objBase;
	
    function __construct($p_strTbName = '', $p_strTbList = '', $p_strCateID = '', $p_strCategoryId = '', $p_strLinkFiled = '')
		{
				parent::__construct();
        $this->strTbName = con_strPREFIX.$p_strTbName;
        $this->strTbList = con_strPREFIX.$p_strTbList;
        $this->strCateID = $p_strCateID;
        $this->strCategoryId = $p_strCategoryId;
				$this->strLinkFiled = $p_strLinkFiled;
				
				$this->objBase = new clsBase();
    }
    function vodCategoryAct($p_arrRequest)
    {	
				/*
				获取父类名称
				 */
        if($p_arrRequest['ParentID']==1){
            $p_arrRequest['ParentName']= "根类";
        }else{
						$sql = "SELECT CateName FROM {$this->strTbName} WHERE {$this->strCategoryId} = {$p_arrRequest['ParentID']}";
						parent::query($sql);
						$res = parent::get_data();
						if($res){
								$p_arrRequest['ParentName']= $res[0]['CateName'];
						}else{
								$p_arrRequest['ParentName']= "类别不存在！";
						}
        }
        switch($_REQUEST['act'])
        {
						case "add":
						{
								$this->vodAdd($p_arrRequest);
						}
						break;
						case "edit":
						{
								$this->vodEdit($p_arrRequest);
						}
								break;
						case "del":
						{
								$this->vodDel($p_arrRequest);
						}
								break;
						case "changeorder":
						{
								$this->vodChangeOrder($p_arrRequest);
						}
								break;
						default:
						{
								$p_arrRequest=$this->arrShowData($p_arrRequest);
						}
        }
        return $p_arrRequest;
    }
    function vodAdd($p_arrRequest)
    {


        $SortSql="select MAX(".$this->strCategoryId.") as maxid from ".$this->strTbName." where ParentID=".$p_arrRequest['ParentID'];
        parent::query($SortSql);
        $SortResult=parent::get_data();
        $p_arrRequest[$this->strCategoryId]=$SortResult[0]['maxid'];

        if($p_arrRequest[$this->strCategoryId]==0){
            $p_arrRequest[$this->strCategoryId]=$p_arrRequest['ParentID']*100+10;
        }else{
            $p_arrRequest[$this->strCategoryId]=$p_arrRequest[$this->strCategoryId]+1;
        }
        /*动态获取表字段和字段值*/
        $arrIsSelect = explode(",", $_POST['IsSelect']);
        $arrIsNum = explode(",", $_POST['IsNum']);
        $arrFields = array();
        $arrValue = array();
				if($p_arrRequest)
				{
					foreach($p_arrRequest as $key=>$val)
					{
							if(in_array($key, $arrIsSelect))
							{
									$arrFields[] = $key;
									if(in_array($key, $arrIsNum)){
											$arrValue[] = $val;
									}else{
											$arrValue[] = "'".$val."'";
									}
							}
					}
				}
        $strTableField=implode(",",$arrFields);
        $strFieldValue=implode(",",$arrValue);
        /*------end--------*/
        $sql="INSERT INTO ".$this->strTbName." (".$strTableField.") VALUES(".$strFieldValue.")";
        $queryresult=parent::query($sql);
        $sql2="select Level from ".$this->strTbName." where ".$this->strCategoryId." = '".$p_arrRequest['ParentID']."'";
        parent::query($sql2);
        $result= parent::get_data();
        $sortlevel=$result[0]['Level'];
        if($p_arrRequest['ParentID']!=1){
            $sqlc="update ".$this->strTbName." set HasChild=1 where ".$this->strCategoryId."=".$p_arrRequest['ParentID'];
            parent::query($sqlc);
        }
        $sql1="update ".$this->strTbName." set Level=$sortlevel+1 where ".$this->strCategoryId."=".$p_arrRequest[$this->strCategoryId];
        parent::query($sql1);
        $tips = "添加";
        $location = $this->strLinkFiled."?ParentID=".$p_arrRequest['ParentID'];
        if($queryresult){
            $this->objBase->popup('恭喜你'.$tips.'成功',$location);
        }else{
            $this->objBase->popup('对不起，'.$tips.'失败');
        }
    }
    function vodEdit($p_arrRequest)
    {


        /*动态获取表字段和字段值*/
        $arrIsSelect = explode(",", $_POST['IsSelect']);
        $arrIsNum = explode(",", $_POST['IsNum']);
        $arrFields = array();
        foreach($p_arrRequest as $key=>$val)
        {
            if(in_array($key, $arrIsSelect))
            {
                if(in_array($key, $arrIsNum)){
                    $arrFields[] = $key." = ".$val;
                }else{
                    $arrFields[] = $key." = '".$val."'";
                }
            }
        }
        $strTableField=implode(",",$arrFields);
        /*------end--------*/
        $sql = "Update ".$this->strTbName." Set ".$strTableField." Where ".$this->strCategoryId." = ".$p_arrRequest[$this->strCategoryId];
        $tips = "修改";
        $location = $this->strLinkFiled."?ParentID=".$p_arrRequest['ParentID']."&".$this->strCategoryId."=".$p_arrRequest[$this->strCategoryId];

        if(parent::query($sql))
            $this->objBase->popup("恭喜您, ".$tips."成功!", $location);
        else
            $this->objBase->popup("对不起, ".$tips."失败!");

    }
    function vodDel($p_arrRequest)
    {


       /* $SelChild="select ".$this->strCategoryId." from ".$this->strTbName." where ParentID=".$p_arrRequest[$this->strCategoryId];
        parent::query($SelChild);
        $arrGetChild=parent::get_data();
        if (parent::get_num()>0){
            $this->objBase->popup("对不起，请先删除子类!");
        }*/  

        $SelCate="select * from ".$this->strTbName." where IsLock='1' and ".$this->strCategoryId." = '".$p_arrRequest[$this->strCategoryId]."'";
        parent::query($SelCate);
        $intCateNum=parent::get_num1();
        if($intCateNum>0)
        {
            $this->objBase->popup("对不起，该分类为锁定保护状态\\n为保证您的网站能正常运行，请不要删除此分类!");
        }
        else
        {		
            $DelInfo = "delete from ".$this->strTbList." where ".$this->strCateID." like '%".$p_arrRequest[$this->strCategoryId]."%'";
            parent::query($DelInfo);
            $DelCate = "delete from ".$this->strTbName." where ".$this->strCategoryId." = '".$p_arrRequest[$this->strCategoryId]."' || ParentID like '%".$p_arrRequest[$this->strCategoryId]."%'";
            $DelRs=parent::query($DelCate);
            if($DelRs)
            {
						/*
						查询该类的父类是否还有子类
						没有子类就将"HasChild"的值更新为"0".
						 */
                $HasChild="select ".$this->strCategoryId." from ".$this->strTbName." where ParentID=".$p_arrRequest['ParentID'];
                parent::query($HasChild);
                $arrGetChild=parent::get_data();
                if (parent::get_num()==0){
                    $sqlc="update ".$this->strTbName." set HasChild=0 where ".$this->strCategoryId."=".$p_arrRequest['ParentID'];
                    parent::query($sqlc);
                }
                $this->objBase->popup("恭喜你操作成功!");
            }
            else
            {
                $this->objBase->popup("对不起，操作失败!");
            }
        }
    }

    function vodChangeOrder($p_arrRequest)
    {

        //$this->vardump($p_arrRequest);
				if($p_arrRequest['SortNum'])
				{
					foreach($p_arrRequest['SortNum'] as $key => $SortNum)
					{
							$ChangeSql="update ".$this->strTbName." set SortNum='".$SortNum."' where ".$this->strCategoryId." = ".$p_arrRequest['CateID'][$key];
							$ChangeRs=parent::query($ChangeSql);
					}
				}
        if($ChangeRs)
        {
            $this->objBase->popup("修改成功!");
        }else{
            $this->objBase->popup("修改失败!");
        }
    }
    function arrShowData($p_arrRequest)
    {		
        //$this->vardump($p_arrRequest);

        $sql = "select * from ".$this->strTbName." where ".$this->strCategoryId." = ".$p_arrRequest[$this->strCategoryId];
       // echo $sql;
        parent::query($sql);
        $arrGetData = parent::get_data();
				if($arrGetData)
				{
					foreach($arrGetData as $Val){
							$p_arrRequest['list'] = $Val;
					}
				}
        return $p_arrRequest;
    }
    function strSortList($p_ParentID = 1, $p_strTableName, $p_strFieldID)
    {
        $arrListNode = array();
        $SortSql="select * from $p_strTableName where ParentID = $p_ParentID order by SortNum asc, ".$p_strFieldID." asc";
				//echo $SortSql;
        $SortQuery=parent::query($SortSql);
        $SortResult=parent::get_data();
				//var_dump($this);
				if($SortResult){
					foreach($SortResult as &$strVal)
					{
							$preIcon = ($strVal['Level'] > 1) ? str_repeat('<span style="color:#ddd">|--</span>', $strVal['Level'] - 1) : '';
							$strVal['CateName'] = $preIcon.$strVal['CateName'];
					}
				}
        return $SortResult;
    }
    function travelTree($p_ParentID = 1, $p_strLinkFile)
    {
        $arrListNode = $this->strSortList($p_ParentID, $this->strTbName, $this->strCategoryId);
        //var_dump($arrListNode);
        $CateNum = count($arrListNode);
        if($arrListNode)
				{
            $i=0;
            foreach($arrListNode as $arrVal)
            { 
						//循环类别列表
?>
    <tr onmouseover="chgColor(this, 'over');" onmouseout="chgColor(this, 'out');">
      <td><strong><?=$arrVal['CateName']?></strong></td>
      <td align="center">
                                <input name="SortNum[]" type="text" size="5" value="<?=$arrVal['SortNum']?>" onblur="CheckNum(this)" />
                                <input type="hidden" name="CateID[]" value="<?=$arrVal[$this->strCategoryId]?>" />
                        </td>
      <td align="center">[<a href="<?=$p_strLinkFile?>?ParentID=<?=$arrVal[$this->strCategoryId]?>">添加子分类</a>] &nbsp; [<a href="<?=$p_strLinkFile?>?<?=$this->strCategoryId?>=<?=$arrVal[$this->strCategoryId]?>&ParentID=<?=$arrVal['ParentID']?>">编辑</a>] &nbsp; [<a href="#" onClick="javascript:war('<?=$arrVal[$this->strCategoryId]?>','<?=$arrVal['ParentID']?>')">删除</a>] </td>
    </tr>
<?php
                if($arrVal['HasChild']>0)
                {
                    $this->travelTree($arrVal[$this->strCategoryId], $p_strLinkFile);
                }
            }
        }
    }
}
?>