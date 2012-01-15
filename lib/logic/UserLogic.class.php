<?php
	
	error_reporting(E_ALL);
    
    class UserLogic {
    	const ADDUSER = 1;
    	const DELETEUSER = 2;
    	const UPDATEUSER = 3;
    	const QUERYUSER = 4;
    	const ALTERPASSWD = 5;
    	
    	const ADDTERMINALGROUP = 6;
    	const DELETETERMINALGROUP = 7;
    	const UPDATETERMINALGROUP = 8;
    	const QUERYTERMINALGROUP = 9;
    	
    	const ADDTERMINAL = 10;
    	const DELETETERMINAL = 11;
    	const UPDATETERMINAL = 12;
    	const QUERYTERMINAL = 13;
    	
    	private static $userlogic;
    	
    	private $userDAO;
    	
    	private function __construct(){
    		$this->userDAO = DAOFactory::getUserDAO();
    	}
    	
    	public static function newInstance(){
    		if(self::$userlogic == null){
    			self::$userlogic = new UserLogic();
    		}
    		
    		return self::$userlogic;
    	}
    	
    	public function verifyUser($user, $pass, $enterprise){
    		session_start();
    	
    		$users = $this->userDAO->queryUser($user, $pass, $enterprise);
    	
    		if(count($users) == 1){    			
    			$_SESSION['curUserID'] = $users[0]->userid;
    			$_SESSION['curUserName'] = $users[0]->username;
    			$_SESSION['curEnterprise'] = $users[0]->enterprisename;
    			$_SESSION['curUserAuth'] = $users[0]->userauthority;
    	
    			$enterpriseDAO = DAOFactory::getEnterpriseDAO();
    			$enterp = $enterpriseDAO->load($_SESSION['curEnterprise']);
    			//TODO
    			if($enterp->level == '0' && hasSysAdminAuth($_SESSION['curUserAuth'])){
    				$_SESSION['isSuperUser'] = true;
    			}
    			return true;
    		}
    	
    		return false;
    	}
    	
    	public function logout(){
    		$_SESSION = array();
    	
    		session_destroy();
    	}
    	
        public function addUser($name, $passwd, $auth) {
        	if(!$this->hasLogin()){
        		$res = array('success'=>false, 'errno'=>1, 'msg'=>'not login yet');
        		goto End;	
        	}
        	
        	if(!$this->checkUserAuth(self::ADDUSER)){
        		$res = array('success'=>false, 'errno'=>2, 'msg'=>'no authority');
        		goto End;
        	}
        	
        	$users = $this->userDAO->queryCertainUser($name, $_SESSION['curEnterprise']);
        	if(count($users) != 0){
        		$res = array('success'=>false, 'errno'=>3, 'msg'=>'already exist');
        		goto End;
        	}
        	
		   	$user = new User();
		   	$user->username = $name;
		   	$user->passwd = $passwd;
		   	$user->userauthority = $auth;
		   	$user->enterprisename = $_SESSION['curEnterprise'];
	
		    try {
		    	$id = $this->userDAO->insert($user);
		    	
		    	$res = array('success'=>true, array('id'=>$id, 'name'=>$user->username));
		    } catch (Exception $e) {
		    	$res = array('success'=>false, 'errno=>4', 'msg'=>$e->getMessage());
		    } 
		End:    
		    return $res;
		}

		public function deleteUser($name){
			if(!$this->hasLogin()){
				$res = array('success'=>false, 'errno'=>1, 'msg'=>'not login yet');
				goto End;
			}
			
			if(!$this->checkExist($name)){
				$res = array('success'=>false, 'errno'=>6, 'msg'=>'not exist');
				goto End;
			}
			
			if(!$this->checkUserAuth(self::DELETEUSER, $name)){
				$res = array('success'=>false, 'errno'=>2, 'msg'=>'no authority');
				goto End;
			}
			
			try {
				$this->userDAO->deleteCertainUser($name, $_SESSION['curEnterprise']);				
				$res = array('success'=>true);
			} catch (Exception $e) {
				$res = array('success'=>false, 'errno=>4', 'msg'=>$e->getMessage());
			}

		End:
			return $res;
		}

		public function updateUser($oldname, $newname, $oldauth, $newauth){
			if(!$this->hasLogin()){
				$res = array('success'=>false, 'errno'=>1, 'msg'=>'not login yet');
				goto End;
			}
			
			if(!$this->checkExist($oldname)){
				$res = array('success'=>false, 'errno'=>6, 'msg'=>'not exist');
				goto End;
			}
			
			if(!$this->checkUserAuth(self::UPDATEUSER, $oldname)){
				$res = array('success'=>false, 'errno'=>2, 'msg'=>'no authority');
				goto End;
			}
			
			if($oldname == $newname && $oldauth == $newauth){
				$res = array('success'=>false, 'errno'=>5, 'msg'=>'equal to old one');
				goto End;
			}
			
			try {
				$users = $this->userDAO->queryCertainUser($oldname, $_SESSION['curEnterprise']);
				if(count($users) == 1){
					$user = $users[0];
					$user->username = $newname;
					$user->userauthority = $newauth;
					
					$this->userDAO->update($user);
					
					$res = array('success'=>true);
				}
			} catch (Exception $e) {
				$res = array('success'=>false, 'errno=>4', 'msg'=>$e->getMessage());
			}

		End:
			return $res;
		}
		
		public function queryUser($name){
			if(!$this->hasLogin()){
				$res = array('success'=>false, 'errno'=>1, 'msg'=>'not login yet');
				goto End;
			}
			
			if(!$this->checkUserAuth(self::QUERYUSER)){
				$res = array('success'=>false, 'errno'=>2, 'msg'=>'no authority');
				goto End;
			}
			
			try {
				$users = $this->userDAO->queryCertainUser($name, $_SESSION['curEnterprise']);
				if(count($users) == 1){
					$user = $users[0];
					$res = array('success'=>true, 'users'=>array('id'=>$user->userid, 'name'=>$user->username, 
							'enterprise'=>$user->enterprisename, 'auth'=>$user->userauthority));
				}
			} catch (Exception $e) {
				$res = array('success'=>false, 'errno=>4', 'msg'=>$e->getMessage());
			}
			
		End:
			return $res;
		}
		
		public function alterPasswd($name, $oldpass, $newpass){
			if(!$this->hasLogin()){
				$res = array('success'=>false, 'errno'=>1, 'msg'=>'not login yet');
				goto End;
			}
			
			if(!$this->checkExist($name)){
				$res = array('success'=>false, 'errno'=>6, 'msg'=>'not exist');
				goto End;
			}
			
			if(!$this->checkUserAuth(self::ALTERPASSWD, $name)){
				$res = array('success'=>false, 'errno'=>2, 'msg'=>'no authority');
				goto End;
			}
						
			try {
				$users = $this->userDAO->queryUser($name, $oldpass, $_SESSION['curEnterprise']);
				
				if(count($users) == 1){
					$user = $users[0];
					$user->passwd = $newpass;
					
					$this->userDAO->update($user);
					$res = array('success'=>true);
				} 			
				
			} catch (Exception $e) {
				$res = array('success'=>false, 'errno=>4', 'msg'=>$e->getMessage());
			}

		End:
			return $res;
		}
		
		
    	public function hasLogin(){
    		return (isset($_SESSION['curUserID']) && isset($_SESSION['curUserName']) 
    				&& isset($_SESSION['curEnterprise']) && $_SESSION['curUserAuth']);
    	}
    	
    	public function checkExist($name){
    		$users = $this->userDAO->queryCertainUser($name, $_SESSION['curEnterprise']);
    		
    		if(count($users) == 1){
    			return true;
    		}
    		
    		return false;
    	}
    	
    	public function checkUserAuth($type){
    		if($_SESSION['isSuperUser'])
    			return true;
			$argList = func_get_args();
			switch ($argList[0]){
				case self::QUERYUSER:
				case self::ADDUSER:
					if(hasUserAdminAuth($_SESSION['curUserAuth'])){
						return true;
					}
					return false;
				case self::UPDATEUSER:
				case self::DELETEUSER:
				case self::ALTERPASSWD:
					try {
						$users = $this->userDAO->queryCertainUser($argList[1], $_SESSION['curEnterprise']);
						if(count($users) == 1){
							$user = $users[0];
							if(isDefaultAdmin($user->userauthority)){
								return false;
							} elseif (isUserAdmin($_SESSION['curUserAuth']) && hasSysAdminAuth($user->userauthority)) {
								return false;
							} else {
								return true;
							}
						}
							
					} catch (Exception $e) {											
					}
					return false;		
					
				case self::ADDTERMINALGROUP: 
				case self::UPDATETERMINALGROUP:
				case self::QUERYTERMINALGROUP:
				case self::DELETETERMINALGROUP:
					if(hasTerminalAdminAuth(currentUserAuth())){
						$groupid = $argList[1];
						$usertgroupDAO = DAOFactory::getUserTgroupDAO();
						$result = $usertgroupDAO->load(currentUserId(), $groupid);
						
						if(isset($result))
							return true;
					}
					return false;
				case self::ADDTERMINAL: //only super user has auth to add terminal
					if($this->isSuperUser()){
						return true;
					}
					return false;
				case self::DELETETERMINAL:
				case self::UPDATETERMINAL:
				case self::QUERYTERMINAL:
					if(hasTerminalAdminAuth(currentUserAuth())){
						$mac = $argList[1];
						$terminalDAO = DAOFactory::getTerminalDAO();
						$terminal = $terminalDAO->load($mac);
						if($terminal->groupid == 0)
							return false;
						$usertgroupDAO = DAOFactory::getUserTgroupDAO();
						$result = $usertgroupDAO->load(currentUserId(), $terminal->groupid);
						
						if(isset($result))
							return true;
					}
					return fasle;
			}
    	}
    
    	public function isSuperUser(){
    		return isset($_SESSION['isSuperUser']) && $_SESSION['isSuperUser'] == true;
    	}
    	
    }

?>
