<?php 
class cart
{
	// 购物车标识
	public $cartname = '';
	
	// 存储类型
	public $savetype = '';
	
	// 购物车中商品数据
	public $data = array();
	
	// Cookie 数据
	public $cookietime = 0;
	public $cookiepath = '/';
	public $cookiedomain = '';
	
	// 构造函数 (购物车标识, $session_id, 存储类型(session或cookie), 默认是一天时间, $cookiepath, $cookiedomain)
	function __construct($cartname = 'myCart', $session_id = '', $savetype = 'session', $cookietime = 864000, $cookiepath = '/', $cookiedomain = '')
	{
		
		// 采用 session 存储
		if ($savetype == 'session')
		{	
			if (!$session_id && $_COOKIE[$cartname.'_session_id'])
			{
				session_id($_COOKIE[$cartname.'_session_id']);
			}
			elseif($session_id)
				session_id($session_id);
			
			session_start();
			
			if (!$session_id && !$_COOKIE[$cartname.'_session_id'])
				setcookie($cartname.'_session_id', session_id(), $cookietime + time(), $cookiepath, $cookiedomain);
		}
		
		$this->cartname = $cartname;
		$this->savetype = $savetype;
		$this->cookietime = $cookietime;
		$this->cookiepath = $cookiepath;
		$this->cookiedomain = $cookiedomain;
		$this->readdata();
	}
	
	// 读取数据
	public function readdata()
	{
		if ($this->savetype == 'session')
		{
			if ($_SESSION[$this->cartname] && is_array($_SESSION[$this->cartname]))
			$this->data = $_SESSION[$this->cartname];
			else 
				$this->data = array();
		}
		elseif ($this->savetype == 'cookie')
		{
			if ($_COOKIE[$this->cartname])
			{
				if(get_magic_quotes_gpc() == 1)
					$this->data = unserialize(stripslashes($_COOKIE[$this->cartname]));
				else
					$this->data = unserialize($_COOKIE[$this->cartname]);
			}
			else 
				$this->data = array();
		}	
	}
	
	
	// 保存购物车数据
	public function save()
	{
		if ($this->savetype == 'session')
		{
			$_SESSION[$this->cartname] = $this->data;
		}
		elseif ($this->savetype == 'cookie')
		{
			if ($this->data)
				setcookie($this->cartname, serialize($this->data), $this->cookietime + time(), $this->cookiepath, $this->cookiedomain);
			else				
				setcookie($this->cartname, serialize(''), $this->cookietime + time(), $this->cookiepath, $this->cookiedomain);
		}
	}
	
	// 返回商品某字段累加
	public function sum($field)
	{		
		$sum = 0;
		
		if ($this->data)
			foreach ($this->data AS $v)
				if ($v[$field])
					$sum += $v[$field] + 0;
		
		return $sum;
	}

}
?>