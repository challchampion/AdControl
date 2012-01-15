<?php 

	error_reporting(E_ALL);
	
	class EnterpriseLogic {
		
		private static $enterpriselogic;
		private $enterpriseDAO;
		
		private function __construct(){
			$this->enterpriseDAO = DAOFactory::getEnterpriseDAO();
		}
		
		public static function newInstance(){
			if(self::$enterpriselogic == null){
				self::$enterpriselogic = new EnterpriseLogic();
			}
			
			return self::$enterpriselogic;
		}
		
		public function addEnterprise($enterprisename, $adminname, $adminpasswd){
			if(!UserLogic::newInstance()->hasLogin()){
				$res = array('success'=>false, 'errno'=>1, 'msg'=>'not login yet');
				goto End;
			}
			
			if(UserLogic::newInstance()->isSuperUser() == false){
				$res = array('success'=>false, 'errno'=>2, 'msg'=>'no authority');
				goto End;
			}
			
			$enterprise =$this->enterpriseDAO->load($enterprisename);
			if(isset($enterprise)){
				$res = array('success'=>false, 'errno'=>3, 'msg'=>'already exist');
				goto End;
			}
			
			try {
				$enterprise = new Enterprise();
				$enterprise->enterprisename = $enterprisename;
				$enterprise->level = '1';
				$this->enterpriseDAO->insert($enterprise);
				
				$userDAO = DAOFactory::getUserDAO();
				$user = new User();
				$user->enterprisename = $enterprisename;
				$user->username = $adminname;
				$user->passwd = $adminpasswd;
				$user->userauthority = SYSADMIN;
				$userDAO->insert($user);
				
				$tgroupDAO = DAOFactory::getTerminalgroupDAO();
				$tgroup = new Terminalgroup();
				$tgroup->enterprisename = $enterprisename;
				$tgroup->parent = 0;
				$tgroupDAO->insert($tgroup);
				
				$res = array('success'=>true);
			} catch (Exception $e) {
				$res = array('success'=>false, 'errno=>4', 'msg'=>$e->getMessage());
			}
			
		End:
			return $res;
		}
		
		public function deleteEnterprise($enterprisename){
			if(!UserLogic::newInstance()->hasLogin()){
				$res = array('success'=>false, 'errno'=>1, 'msg'=>'not login yet');
				goto End;
			}
			
			if(UserLogic::newInstance()->isSuperUser() == false || $enterprisename == DEFAULTENTERPRISE){
				$res = array('success'=>false, 'errno'=>2, 'msg'=>'no authority');
				goto End;
			}
			
			$enterprise =$this->enterpriseDAO->load($enterprisename);
			if(!isset($enterprise)){
				$res = array('success'=>false, 'errno'=>6, 'msg'=>'not exist');
				goto End;
			}
			
			try {
				$userDAO = DAOFactory::getUserDAO();
				$users = $userDAO->queryByEnterprisename($enterprisename);
				foreach ($users as $user){
					$userid = $user->userid;
					$usertgroupDAO = DAOFactory::getUserTgroupDAO();
				}
				$userDAO->deleteByEnterprisename($enterprisename);
				
				$terminalgroup = DAOFactory::getTerminalgroupDAO();
				$terminalgroup->deleteByEnterprisename($enterprisename);
				
				$this->enterpriseDAO->delete($enterprisename);			
				
				$res = array('success'=>true);
			} catch (Exception $e) {
				$res = array('success'=>false, 'errno=>4', 'msg'=>$e->getMessage());
			}
			
		End:
			return $res;
		}
		
		//TODO
		public function updateEnterprise($enterprise){
			
		}
		
		public function queryEnterprise(){
			if(!UserLogic::newInstance()->hasLogin()){
				$res = array('success'=>false, 'errno'=>1, 'msg'=>'not login yet');
				goto End;
			}
			
			if(UserLogic::newInstance()->isSuperUser() == false){
				$res = array('success'=>false, 'errno'=>2, 'msg'=>'no authority');
				goto End;
			}
			
			try {
				$enterprises = $this->enterpriseDAO->queryAll();
				$eprises = array();
				for($i = 0; $i < count($enterprises); $i++){
					$enterprise = $enterprises[$i];
					$eprises[$i] = $enterprise->enterprisename;
				}
				
				$res['success'] = true;
				$res['enterprises'] = $eprises;
								
			} catch (Exception $e) {
				$res = array('success'=>false, 'errno=>4', 'msg'=>$e->getMessage());
			}
			
		End:
			return $res;
		}
	
		public static function isExist($enterprisename){
			if(!empty($enterprisename)){
				try {
					$enterprise = $this->enterpriseDAO->load($enterprisename);
					if(isset($enterprise))
						return true;
				} catch (Exception $e) {
				}
			}
			return false;
		}
		
		public static function getDefaultGroupId($enterprisename){
			if(!empty($enterprisename)){
				try {
					$terminalgroupDAO = DAOFactory::getTerminalgroupDAO();
					$groups = $terminalgroupDAO->queryDefaultGroupByEnterprise($enterprisename);
					if(count($groups) == 1){
						$group = $groups[0];
						return $group->groupid;	
					}
				} catch (Exception $e) {
				}
			}
			return null;
		}
		
	}

?>