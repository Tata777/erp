<?php
require_once(dirname(__FILE__)."/../config.inc.php");//主要是主机名,用户名与密码等
class mysqldb{
    var $host=DB_HOST;
    var $user=DB_USER;
    var $pass=DB_PASSWORD;
    var $database=DB_DATABASE;
    var $conn;
    var $sql;
    var $n=0;
    var $m=0;
    var $result="";
    var $debug=false;
    var $err='';
    var $dbcharset;

    function __construct($host="",$user="",$pass="",$database=""){
        if ($host!="")$this->host=$host;
        if ($user!="")$this->user=$user;
        if ($pass!="")$this->pass=$pass;
        if ($database!="")$this->database=$database;

        if (!$this->conn = @mysql_connect($this->host,$this->user,$this->pass)){
            return $this->output("连接数据库 '".$this->host."' 失败。".mysql_error());
        }

        if(in_array(strtolower(DB_CHARSET), array('gbk', 'big5', 'utf-8'))) {
            $this->dbcharset = str_replace('-', '', DB_CHARSET);
        }
		
        if($this->dbcharset) {
            mysql_query("SET character_set_connection=".$this->dbcharset.", character_set_results=".$this->dbcharset.", character_set_client=binary", $this->conn);
        }

        if($this->version() > '5.0.1') {
            mysql_query("SET sql_mode=''", $this->conn);
        }
        $this->selectdb();
    }
		
		function __destruct()
		{
			$this->close();
		}

    function selectdb($database=''){
	 mysql_query( "set   names   'UTF8' ");
        if ($database!=""&&$database!=$this->database)
            $this->database=$database;

        if (!mysql_select_db($this->database,$this->conn)){
            return $this->output("无法使用数据库 '".$this->database."'。");
        }
    }

    function query($sql="",$database=""){
        if ($sql!="")$this->sql=$sql;
        if ($database!=""&&$database!=$this->database){
            $olddb=$this->database;
            $this->selectdb($database);
        }
        $this->result= @mysql_query($this->sql,$this->conn);
        if (mysql_error() != ""){
            return $this->output("执行以下SQL语句时失败：'".$this->sql."' <br><br>".mysql_error());
        }
        $this->n = @mysql_affected_rows();

        if (!empty($olddb)) $this->selectdb($olddb);
        return $this->result;
    }

    function get_data(){
        if(!$this->result || !eregi("^Resource",$this->result)){
            return $this->output("没有数据，请先执行SQL的'select'语句!");
        }
        $count=0;
        $this->m = @mysql_num_rows($this->result);
        if ($this->m>0){
            while($row=mysql_fetch_array($this->result)){
                $data[$count]=$row;
                $count++;
            }
            return $this->result=$data;
        }else{
            return $this->output("数据为空!");
        }
        mysql_free_result($this->result);
    }
		
	function getOne($sql, $limited = false)
	{
		if ($limited == true)
		{
			$sql = trim($sql . ' LIMIT 1');
		}

		$res = $this->query($sql);
		if ($res !== false)
		{
			$row = mysql_fetch_row($res);

			return $row[0];
		}
		else
		{
			return false;
		}
	}

    function getAll($sql)
    {
        $res = $this->query($sql);
        if ($res !== false)
        {
            $arr = array();
            while ($row = mysql_fetch_assoc($res))
            {
                $arr[] = $row;
            }
            if (count($arr) > 0) {
                return $arr;
            } else {
                return false;
            }
        }
        else
        {
            return false;
        }
    }

	function getRow($sql, $limited = false)
	{
		if ($limited == true)
		{
			$sql = trim($sql . ' LIMIT 1');
		}

		$res = $this->query($sql);
		if ($res !== false)
		{
			return mysql_fetch_assoc($res);
		}
		else
		{
			return false;
		}
	}

    function get_insertid(){
        return mysql_insert_id();
    }

    function get_num(){
        return $this->m;
    }

    function get_num1(){
        return $this->n;
    }

    function close(){
			if(is_resource($this->conn))
        mysql_close($this->conn);
    }
		
    function output($msg){
        $this->err=$msg;
        if ($this->debug)echo $msg;
        return false;
    }

    function version() {
        return mysql_get_server_info($this->conn);
    }
}
?>
