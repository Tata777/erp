<?
 class ShowPage {

	var $PageSize;     //每页显示的记录数

	var $Total;        //记录总数

	var $LinkAry;      //Url参数数组

//取得总页数
	function PageCount() {
		$TotalPage = ($this->Total % $this->PageSize == 0) ? floor($this->Total / $this->PageSize) :  floor($this->Total / $this->PageSize)+1;
		return $TotalPage;
		}
//取得当前页
	function PageNum() {
		//if (isset($_GET['page']))
		$page =  (isset( $_GET['page'])!="") ? $_GET['page'] :  $page = 1;
		return $page;
	}
//查询语句定位指针
	function OffSet() {
		if ($this->PageNum() > $this->PageCount()) {
	        //$this->PageNum = $this->PageCount();
	        $pagemin = max(0,$this->Total - $this->PageSize - 1);
        }else if ($this->PageNum() == 1){
		        $pagemin = 0;
	        }else {
		        $pagemin = min($this->Total - 1,$this->PageSize * ($this->PageNum() - 1));
	          }
		return $pagemin . "," . $this->PageSize;
	    }
//定位首页
	function FristPage() {
		$Frist = ($this->PageNum() <= 1) ? "First  " : "<a href=\"?page=1".$this->Url($this->LinkAry)."\">First</a> ";
		return $Frist;
	}
//定位上一页
	function PrePage() {
		$prepage=$this->PageNum() - 1;
		$Previous = ($this->PageNum() >= 2) ? " <a href=\"?page=".$prepage.$this->Url($this->LinkAry)."\">Prev</a> " : "Prev ";
		return $Previous;
	}
//定位下一页
	function NextPage() {
		$nextpage = $this->PageNum() + 1;
		$Next = ($this->PageNum() <= $this->PageCount()-1) ? " <a href=\"?page=".$nextpage.$this->Url($this->LinkAry)."\">Next</a> " : "Next ";
		return $Next;
	}
//定位最后一页
	function LastPage() {
		$Last = ($this->PageNum() >= $this->PageCount()) ? "Last  " : " <a href=\"?page=".$this->PageCount().$this->Url($this->LinkAry)."\">Last</a> ";
		return $Last;
	}
//下拉跳转页面
	function JumpPage() {
		$Jump = " The <b>".$this->PageNum()."th</b> Page  Total <b>".$this->PageCount()."</b> Page(s) GoTo <select name=page onchange=\"javascript:location=this.options[this.selectedIndex].value;\">";
		for ($i=1; $i<=$this->PageCount(); $i++) {
		if ($i==$this->PageNum())
			$Jump .= "<option value=\"?page=".$i.$this->Url($this->LinkAry)."\" selected>$i</option>";
		else
			$Jump .="<option value=\"?page=".$i.$this->Url($this->LinkAry)."\">$i</option> ";
		}
	    $Jump .= "</select> Page   <b>[".$this->PageSize."Record(s)/Page]</b>";
		return $Jump;
	}
//URL参数处理
	function Url($ary) {
		$Linkstr = "";
		if (count($ary) > 0) {
			foreach ($ary as $key => $val) {
			$Linkstr .= "&".$key."=".$val;
			}
		}
		return $Linkstr;
	}
//总条数
	function Totalnum() {
		$tnum = "Total ".$this->Total." Record(s)  ";
		return $tnum;
	}
	
//生成导航条
	function ShowLink() {
		return $this->Totalnum().$this->FristPage().$this->PrePage().$this->NextPage().$this->LastPage().$this->JumpPage();
	}
 }
?>