<?php 

	error_reporting(E_ALL);
	
	class TerminalGroupLogic {
		
		private static $terminalGroupLogic;
		private $terminalgroupDAO;
		private $userlogic;
		
		private function __construct(){
			$this->terminalgroupDAO = DAOFactory::getTerminalgroupDAO();
			$this->userlogic = UserLogic::newInstance();
		}
		
		public static function newInstance(){
			if(self::$terminalGroupLogic == null){
				self::$terminalGroupLogic = new TerminalGroupLogic();
			}
			
			return self::$terminalGroupLogic;
		}
		
		
		public function addTerminalGroup($parentgroupid, $groupname){
			if(!$this->userlogic->hasLogin()){
				$res = array('success'=>false, 'errno'=>1, 'msg'=>'not login yet');
				goto End;
			}
			
			if(!$this->userlogic->checkUserAuth(UserLogic::ADDTERMINALGROUP, $parentgroupid)){
				$res = array('success'=>false, 'errno'=>2, 'msg'=>'no authority');
				goto End;
			}
			
			if($this->isDefaultGroup($parentgroupid)){
				$res = array('success'=>false, 'errno'=>8, 'msg'=>'default group can\'t be operated');
				goto End;
			}
			
			if($this->isRepeatedNameOfChildLevel($groupname, $parentgroupid)){
				$res = array('success'=>false, 'errno'=>7, 'msg'=>'name repeated');
				goto End;
			}
			
			try {
				$terminalgroup = new Terminalgroup();
				$terminalgroup->enterprisename = currentEnterprise();
				$terminalgroup->groupname = $groupname;
				$terminalgroup->parent = $parentgroupid;
				
				$groupid = $this->terminalgroupDAO->insert($terminalgroup);
				
				$res = array('success'=>true, 'groupid'=>$groupid);
			} catch (Exception $e) {
				$res = array('success'=>false, 'errno=>4', 'msg'=>$e->getMessage());
			}
			
		End:
			return $res;
		}
		
		public function deleteTerminalGroup($groupid){
			if(!$this->userlogic->hasLogin()){
				$res = array('success'=>false, 'errno'=>1, 'msg'=>'not login yet');
				goto End;
			}
			
			if(!$this->userlogic->checkUserAuth(UserLogic::DELETETERMINALGROUP, $groupid)){
				$res = array('success'=>false, 'errno'=>2, 'msg'=>'no authority');
				goto End;
			}
			
			if($this->isDefaultGroup($groupid)){
				$res = array('success'=>false, 'errno'=>8, 'msg'=>'default group can\'t be operated');
				goto End;
			}
			
			try {
				$commandDAO = DAOFactory::getCommandDAO();
				$terminalstatusDAO = DAOFactory::getTerminalstatusDAO();
				$terminalDAO = DAOFactory::getTerminalDAO();
				$userTGroupDAO = DAOFactory::getUserTgroupDAO();
				
				$terminals = $terminalDAO->queryByGroupid($groupid);
				
				foreach($terminals as $terminal){
					$commandDAO->deleteByMac($terminal->mac);
					$terminalstatusDAO->delete($terminal->mac);
				}
				$commandDAO->deleteByGroupid($groupid);
				$terminalDAO->deleteByGroupid($groupid);
				
				$userTGroupDAO->deleteByGroup($groupid);
				
				$this->terminalgroupDAO->delete($groupid);
				
				$res = array('success'=>true);
			} catch (Exception $e) {
				$res = array('success'=>false, 'errno=>4', 'msg'=>$e->getMessage());
			}
			
		End:
			return $res;
		}
		
		public function updateTerminalGroup($groupid, $newgroupname){
			if(!$this->userlogic->hasLogin()){
				$res = array('success'=>false, 'errno'=>1, 'msg'=>'not login yet');
				goto End;
			}
			
			if($this->isRepeatedNameOfThisLevel($newgroupname, $groupid)){
				$res = array('success'=>false, 'errno'=>7, 'msg'=>'name repeated');
				goto End;
			}
			
			if(!$this->userlogic->checkUserAuth(UserLogic::UPDATETERMINALGROUP, $groupid)){
				$res = array('success'=>false, 'errno'=>2, 'msg'=>'no authority');
				goto End;
			}
			
			if($this->isDefaultGroup($groupid)){
				$res = array('success'=>false, 'errno'=>8, 'msg'=>'default group can\'t be operated');
				goto End;
			}
			
			try {
				$this->terminalgroupDAO->updateTGroupNameById($groupid, $newgroupname);
				$res = array('success'=>true);
			} catch (Exception $e) {
				$res = array('success'=>false, 'errno=>4', 'msg'=>$e->getMessage());
			}
			
		End:	
			return $res;
		}
		
		public function queryTerminalGroups($parentgroupid){
			if(!$this->userlogic->hasLogin()){
				$res = array('success'=>false, 'errno'=>1, 'msg'=>'not login yet');
				goto End;
			}
			
			if(!$this->userlogic->checkUserAuth(UserLogic::QUERYTERMINALGROUP, $parentgroupid)){
				$res = array('success'=>false, 'errno'=>2, 'msg'=>'no authority');
				goto End;
			}
			
			try {
				$terminalgroups = $this->terminalgroupDAO->queryGroupsByEnterprise(currentEnterprise(), $parentgroupid);
				if(count($terminalgroups) == 0){
					$res = array('success'=>false, 'errno'=>6, 'msg'=>'not exist');
				} else {
					$res = array('success'=>true, 'terminalgroups'=>$terminalgroups);
				}
			} catch (Exception $e) {
				$res = array('success'=>false, 'errno=>4', 'msg'=>$e->getMessage());
			}		
			
		End:
			goto End;	
		}
		
		public function queryCertainTerminalGroup($groupid){
			if(!$this->userlogic->hasLogin()){
				$res = array('success'=>false, 'errno'=>1, 'msg'=>'not login yet');
				goto End;
			}
			
			if($groupid == 0){
				$res = array('success'=>false, 'errno'=>6, 'msg'=>'not exist');
				goto End;
			}
			
			if(!$this->userlogic->checkUserAuth(UserLogic::QUERYTERMINALGROUP, $groupid)){
				$res = array('success'=>false, 'errno'=>2, 'msg'=>'no authority');
				goto End;
			}	
			
			try {
				$terminalgroup = $this->terminalgroupDAO->load($groupid);
				if(isset($terminalgroup)){
					$res = array('success'=>true, 'terminalgroup'=>$terminalgroup);
				} else {
					$res = array('success'=>false, 'errno'=>6, 'msg'=>'not exist');
				}
			} catch (Exception $e) {
				$res = array('success'=>false, 'errno=>4', 'msg'=>$e->getMessage());
			}
			
		End:
			return $res;	
		}
		
		public static function isExist($groupid){			
			try {
				$group = $this->terminalgroupDAO->load($groupid);
				if(isset($group))
					return true;
				else 
					return false;
			} catch (Exception $e) {
				
			}
		}
		
		private function isDefaultGroup($groupid){
			if($groupid == 0)
				return true;
			try {
				$terminalgroup = $this->terminalgroupDAO->load($groupid);
				if($terminalgroup->parent == 0 && $terminalgroup->groupname == 'default')
					return true;
			} catch (Exception $e) {
			}
			
			return false;
		}
		
		private function isRepeatedNameOfChildLevel($groupname, $parentgroupid){
			try {
				$groups = $this->terminalgroupDAO->queryCertainGroupByEnterprise($groupname, currentEnterprise(), $parentgroupid);
				if(count($groups) == 0)
					return false;
				else 
					return true;
			} catch (Exception $e) {
			}
		}
		
		private function isRepeatedNameOfThisLevel($groupname, $groupid){
			try {
				$group = $this->terminalgroupDAO->load($groupid);
				
				$groups = $this->terminalgroupDAO->queryCertainGroupByEnterprise($groupname, currentEnterprise(), $group->parent);
				if(count($groups) == 0)
					return false;
				else
					return true;
			} catch (Exception $e) {
			}
		}
	}

?>