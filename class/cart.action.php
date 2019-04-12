<?php	
	if( !class_exists('cart') )
	{
		include_once(dirname(__FILE__).'/cart.class.php');
	}
	
	class clsJsCart
	{
		public $cart;
		public $strPriceColumn;
		public $strProNameColumn;
	
		// 构造函数 (购物车标识, $session_id, 存储类型(session或cookie), 默认是一天时间, $cookiepath, $cookiedomain)
		function __construct($cartname = 'myCart', $session_id = '', $savetype = 'session', $cookietime = 86400, $cookiepath = '/', $cookiedomain = '')
		{			
			$this->cart = new cart($cartname.$lan, $session_id.$lan, $savetype, $cookietime, $cookiepath, $cookiedomain);
		}
		
		//执行购物车操作
		//$strAction为购物车动作add为添加到购物车;modify为修改购物车里的内容
		public function vodExcute($strAction)
		{
			$id = $_REQUEST['id'];//产品ID 唯一
			$count = $_REQUEST['count'];//产品数量
			$name = $_GET['name'];//产品名称
			$url = $_GET['url'];//产品的URL
			$price = $_GET['price'];//价格
			
			
			switch(strtolower($strAction))
			{
				case "add":
					// 商品已经存在 修改数据
					if ($this->cart->data[$id])
					{
						$this->cart->data[$id]['count'] += $count;
						$this->cart->data[$id]['money'] += $this->cart->data[$id]['price'] * $count;					
					}
					// 添加商品
					else
					{
						//将各项参数赋值到购物车数组中
						$this->cart->data[$id]['name'] = $name;//产品名称
						$this->cart->data[$id]['url'] = $url;//产品的URL 地址
						$this->cart->data[$id]['price'] = $price;//产品价格
						$this->cart->data[$id]['count'] = 1;//产品数量默认为1
						$this->cart->data[$id]['money'] = $price;//当前同一款产品的数量总价(产品数*产品单价==['money'])
					}
					break;
					
				case "modify":
				//$_POST['proID'] array 为产品的数量值，数组形式
					if(is_array($_POST['proID']))
					{
						foreach($_POST['proID'] as $key => $value)
						{
							// 商品已经存在 修改数据
							if (isset($this->cart->data[$value]))
							{
								$this->cart->data[$value]['count'] = $_POST['proQuan'][$key];
								$this->cart->data[$value]['money'] = $this->cart->data[$value]['price'] * $_POST['proQuan'][$key];
							}
						}
					}
					break;
					//删除购物车里的内容
				case "del":
					unset($this->cart->data[$id]);
					break;
			}
			
			// 保存购物车数据
			$this->cart->save();
		}
	}
?>