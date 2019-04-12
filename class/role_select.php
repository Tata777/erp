<?php
		if( !class_exists('mysqldb') )
		{
			require_once(dirname(__FILE__)."/../config.inc.php");
			include_once(CFG_LIB_DIR.'mysqldb.inc.php');
		}
		class RolePre extends mysqldb
		{
				private $ReadingRight;
				private $IsInfo;
				private $InfoAuditing;
				private $MaxInfo;
				private $IsSnd;
				private $SndAuditing;
				private $MaxSnd;
				private $MaxSndPhoto;
				private $IsProduct;
				private $ProductAuditing;
				private $MaxProduct;
				private $MaxProductPhoto;
				
				private $InfoCount;
				private $SndCount;
				private $ProCount;
				function __construct($RoleSettingID, $M_Id)
				{
						
						parent::__construct();
						//查询会员组权限
						$sql = "SELECT * FROM `".con_strPREFIX."rolesetting`  WHERE `RoleSettingID` = $RoleSettingID";
						//echo $sql;
						parent::query($sql);
						$tempResult = parent::get_data();
						$res = $tempResult[0];
						if($res){
								$this->ReadingRight=$res['ReadingRight'];
								$this->IsInfo=$res['IsInfo'];
								$this->InfoAuditing=$res['InfoAuditing'];
								$this->MaxInfo=$res['MaxInfo'];
								$this->IsSnd=$res['IsSnd'];
								$this->SndAuditing=$res['SndAuditing'];
								$this->MaxSnd=$res['MaxSnd'];
								$this->MaxSndPhoto=$res['MaxSndPhoto'];
								$this->IsProduct=$res['IsProduct'];
								$this->ProductAuditing=$res['ProductAuditing'];
								$this->MaxProduct=$res['MaxProduct'];
								$this->MaxProductPhoto=$res['MaxProductPhoto'];
						}	
						//查询会员发布的新闻信息数量
						$InfoSql = "SELECT count(*) FROM `".con_strPREFIX."info` where `ContributionUserID` = $M_Id";
						parent::query($InfoSql);
						$this->InfoCount = parent::getOne();
						//查询会员发布的供求信息数量
						$SndSql = "SELECT count(*) FROM `".con_strPREFIX."supplyndemand` where `MemberID` = $M_Id";
						parent::query($SndSql);
						$this->SndCount = parent::getOne();
						//查询会员发布的产品数量
						$ProSql = "SELECT count(*) FROM `".con_strPREFIX."products` where `MemberID` = $M_Id";
						$ProSql;
						parent::query($ProSql);
						$this->ProCount = parent::getOne();
				}
				
				/*     获取会员所属用户组的阅读权限 */
				function GetReadingRight(){
						return $this->ReadingRight;
				}
			
				/*     获取会员所属用户组的发布信息的权限 */
				
				function GetIsInfo(){
						return $this->IsInfo;
				}
					
				/*     查询会员所属用户组的是否审核资讯信息 */
				
				function GetInfoAuditing(){
						return $this->InfoAuditing;
					}
					
				/*     查询会员所属用户组最大可以发布的信息 */
				
				function GetMaxInfo(){
						return $this->MaxInfo;
				}
					
				/*     获取会员所属用户组是否开通发布供求权限 */
				
				function GetIsSnd(){
						return $this->IsSnd;
					}
						
				/*     查询会员所属用户组是否审核供求信息 */
				
				function GetSndAuditing(){
						return $this->SndAuditing;
				}
						
				/*     获取会员所属用户组最大可以发布的供求信息 */
				
				function GetMaxSnd(){
						return $this->MaxSnd;
				}
							
				/*     获取会员所属用户组每个供求信息的最大上传图片数量 */
				
				function GetMaxSndPhoto(){
						return $this->MaxSndPhoto;
				}
									
				/*     获取会员所属用户组是否开通发布产品权限 */
				
				function GetIsProduct(){
						return $this->IsProduct;
				}
									
				/*     获取会员所属用户组是否审核产品信息 */
				
				function GetProductAuditing(){
						return $this->ProductAuditing;
				}
									
				/*     获取会员所属用户组最大可以发布的产品信息 */
				
				function GetMaxProduct(){
						return $this->MaxProduct;
				}
										
				/*     获取会员所属用户组每个产品信息的最大上传图片数量 */
				
				function GetMaxProductPhoto(){
						return $this->MaxProductPhoto;
				}
				/*     获取会员发布的新闻信息数量 */
				
				function GetInfoCount(){
						return $this->InfoCount;
				}
				/*     获取会员发布的供求信息数量 */
				
				function GetSndCount(){
						return $this->SndCount;
				}
				/*     获取会员发布的产品数量 */
				
				function GetProCount(){
						return $this->ProCount;
				}
		
	}
?>