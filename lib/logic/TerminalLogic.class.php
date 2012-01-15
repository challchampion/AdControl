<?php 

	error_reporting(E_ALL);

	class TerminalLogic {
		private static $terminallogic;
		
		private $userlogic;
		private $terminalDAO;
		private $terminalgroupDAO;
		private $commandDAO;
		private $statusDAO;
		
		private function __construct(){
			$this->userlogic = UserLogic::newInstance();
			$this->terminalDAO = DAOFactory::getTerminalDAO();
			$this->terminalgroupDAO = DAOFactory::getTerminalgroupDAO();
			$this->commandDAO = DAOFactory::getCommandDAO();
			$this->statusDAO = DAOFactory::getTerminalstatusDAO();
		}
		
		public static function newInstance(){
			if(self::$terminallogic == null){
				self::$terminallogic = new TerminalLogic();
			}
			
			return self::$terminallogic;
		}
		
		
		//除超级用户之外，普通用户将不具有添加终端的权限，拥有终端管理权限的普通企业用户，只可删除，修改，查询终端。
		public function addTerminal($terminal, $enterprisename){
			if(!hasLogin()){
				$res = array('success'=>false, 'errno'=>1, 'msg'=>'not login yet');
				goto End;
			}
			
			if(!$this->userlogic->checkUserAuth(UserLogic::ADDTERMINAL)){
				$res = array('success'=>false, 'errno'=>2, 'msg'=>'no authority');
				goto End;
			}
						
			try {
				if(EnterpriseLogic::isExist($enterprisename)){
					$terminal->groupid = EnterpriseLogic::getDefaultGroupId($enterprisename);
					$this->terminalDAO->insert($terminal);
				} else {
					$terminal->groupid = 0;
					$this->terminalDAO->insert($terminal);
				}	
					
				$terminalstatus = new Terminalstatu();
				$terminalstatus->mac = $terminal->mac;
				$this->statusDAO->insertOneRecord($terminalstatus);
					
				$res = array('success'=>true);								
			} catch (Exception $e) {
				$res = array('success'=>false, 'errno=>4', 'msg'=>$e->getMessage());
			}
			
		End:
			return $res;
		}
		
		public function getTerminalByMac($mac){
			if(!hasLogin()){
				$res = array('success'=>false, 'errno'=>1, 'msg'=>'not login yet');
				goto End;
			}
			
			if(!$this->userlogic->checkUserAuth(UserLogic::QUERYTERMINAL, $mac)){
				$res = array('success'=>false, 'errno'=>2, 'msg'=>'no authority');
				goto End;
			}
			
			if(!$this->isExist($terminal->mac)){
				$res = array('success'=>false, 'errno'=>6, 'msg'=>'not exist');
				goto End;
			}
			
			try {
				$terminal = $this->terminalDAO->load($mac);
				
				$res = array('success'=>true, 'terminal'=>$terminal);
			} catch (Exception $e) {
				$res = array('success'=>false, 'errno=>4', 'msg'=>$e->getMessage());
			}

		End:
			return $rs;
		}
		
		public function getTerminalStausByMac($mac){
			if(!hasLogin()){
				$res = array('success'=>false, 'errno'=>1, 'msg'=>'not login yet');
				goto End;
			}
			
			if(!$this->userlogic->checkUserAuth(UserLogic::QUERYTERMINAL, $mac)){
				$res = array('success'=>false, 'errno'=>2, 'msg'=>'no authority');
				goto End;
			}
			
			if(!$this->isExist($terminal->mac)){
				$res = array('success'=>false, 'errno'=>6, 'msg'=>'not exist');
				goto End;
			}
			
			try {
				$status = $this->statusDAO->queryStatusByMac($mac);
				$res = array('success'=>true, 'status'=>$status);
			} catch (Exception $e) {
				$res = array('success'=>false, 'errno=>4', 'msg'=>$e->getMessage());
			}

		End:
			return $res;
		}
		
		public function getTerminalsByGroup($groupid){
			if(!hasLogin()){
				$res = array('success'=>false, 'errno'=>1, 'msg'=>'not login yet');
				goto End;
			}
			
			if(!$this->userlogic->checkUserAuth(UserLogic::QUERYTERMINALGROUP, $groupid)){
				$res = array('success'=>false, 'errno'=>2, 'msg'=>'no authority');
				goto End;
			}
			
			if(!TerminalGroupLogic::isExist($groupid)){
				$res = array('success'=>false, 'errno'=>6, 'msg'=>'not exist');
				goto End;
			}
			
			try {
				$terminals = $this->terminalDAO->queryByGroupid($groupid);
				$res = array('success'=>true, 'terminals'=>$terminals);
			} catch (Exception $e) { 
				$res = array('success'=>false, 'errno=>4', 'msg'=>$e->getMessage());
			}

		End:
			return $res;
		}
		
		public function deleteTerminalByMac($mac){
			if(!hasLogin()){
				$res = array('success'=>false, 'errno'=>1, 'msg'=>'not login yet');
				goto End;
			}
			
			if(!$this->userlogic->checkUserAuth(UserLogic::DELETETERMINAL, $mac)){
				$res = array('success'=>false, 'errno'=>2, 'msg'=>'no authority');
				goto End;
			}
			
			if(!$this->isExist($terminal->mac)){
				$res = array('success'=>false, 'errno'=>6, 'msg'=>'not exist');
				goto End;
			}
			
			try {
				$this->terminalDAO->delete($mac);
				
				$this->statusDAO->delete($mac);
				
				$res = array('success'=>true);
			} catch (Exception $e) {
				$res = array('success'=>false, 'errno=>4', 'msg'=>$e->getMessage());
			}
		
		End:
			return $res;
		}
		
		public function updateTerminalInfo($terminalname, $mac){
			if(!hasLogin()){
				$res = array('success'=>false, 'errno'=>1, 'msg'=>'not login yet');
				goto End;
			}
			
			if(!$this->userlogic->checkUserAuth(UserLogic::UPDATETERMINAL, $mac)){
				$res = array('success'=>false, 'errno'=>2, 'msg'=>'no authority');
				goto End;
			}
			
			if(!$this->isExist($terminal->mac)){
				$res = array('success'=>false, 'errno'=>6, 'msg'=>'not exist');
				goto End;
			}
			
			try {
				$this->terminalDAO->updateTerminalNameByMac($terminalname, $mac);
				$res = array('success'=>true);
			} catch (Exception $e) {
				$res = array('success'=>false, 'errno=>4', 'msg'=>$e->getMessage());
			}
			
		End:
			return $res;	
		}

		
		
		//when terminal request coming 
		public function updateTerminalState($mac){
			$status = new Terminalstatus();
			$status->mac = $mac;
			$status->status = 'online';
			if(self::isExist($mac)){// exist
				$this->statusDAO->update($status);
				
				self::checkTerminalStatus();
			} 
			
		}
		
		//everytime user request or terminal request coming, need to check terminal status
		public function checkTerminalStatus(){
			try {
				$this->statusDAO->checkHBStatus();
			} catch (Exception $e) {
			}
		}
		
		
		
		public function noParamCmdOnTerminalOrGroup($command, $macs, $groupid){
			if($groupid == 0)
				return;
			
			$cmd = new Command();
			
			if(isset($group)){
				$cmd->sendtype = '1';
				$cmd->groupid = $groupid;
				$cmd->command = self::constructCmd($groupid, $command);
				$this->commandDAO->insert($cmd);
			} elseif (isset($macs)){
				foreach ($macs as $mac){
					if(self::isExist($mac)){
						$cmd->mac = $mac;
						$cmd->sendtype = '0';
						$cmd->command = self::constructCmd($mac, $command);
		
						$this->commandDAO->insert($cmd);
					}
				}
			}						
		}
		
		public function timeonoffTerminalOrGroup($macs, $groupid, $poweron, $poweroff){
			if($groupid == 0)
				return;
			$cmd = new Command();
			
			if(isset($groupid)){
				$cmd->sendtype = '1';
				$cmd->groupid = $groupid;
				$cmd->command = self::constructCmd($groupid, 'config|PowerOn=' . $poweron);		
				$this->commandDAO->insert($cmd);
				
				$cmd->command = self::constructCmd($groupid, 'config|PowerOff=' . $poweroff);
				$this->commandDAO->insert($cmd);
			} elseif (isset($macs)){
				foreach ($macs as $mac){
					if(self::isExist($mac)){
						$cmd->mac = $mac;
						$cmd->sendtype = '0';
						$cmd->command = self::constructCmd($mac, 'config|PowerOn=' . $poweron);		
						$this->commandDAO->insert($cmd);
				
						$cmd->command = self::constructCmd($mac, 'config|PowerOff=' . $poweroff);
						$this->commandDAO->insert($cmd);
					}
				}
			}
		}
		
		public function cancelTimeTerminalOrGroup($macs, $groupid){
			if($groupid == 0)
				return;
			$cmd = new Command();
			
			if(isset($groupid)){
				$cmd->sendtype = '1';
				$cmd->groupid = $groupid;
				$cmd->command = self::constructCmd($groupid, 'config|PowerOn=');
				$this->commandDAO->insert($cmd);
			} elseif (isset($macs)){
				foreach ($macs as $mac){
					if(self::isExist($mac)){
						$cmd->mac = $mac;
						$cmd->sendtype = '0';
						$cmd->command = self::constructCmd($mac, 'config|PowerOn=');
			
						$this->commandDAO->insert($cmd);
					}
				}
			}
		}
		
		public function deleteFileTerminalOrGroup($macs, $groupid, $fileArray){
			if($groupid == 0)
				return;
			$c = '';
			foreach ($fileArray as $file){
				$c = $c . '|' . $file;
			}
			
			$cmd = new Command();
			
			if(isset($groupid)){
				$cmd->sendtype = '1';
				$cmd->groupid = $groupid;
				$cmd->command = self::constructCmd($groupid, 'delete' . $c);
				$this->commandDAO->insert($cmd);
			} elseif (isset($macs)){
				foreach ($macs as $mac){
					if(self::isExist($mac)){
						$cmd->mac = $mac;
						$cmd->sendtype = '0';
						$cmd->command = self::constructCmd($mac, 'delete' . $c);
			
						$this->commandDAO->insert($cmd);
					}
				}
			}
		}

		public function updateTerminalOrGroup($macs, $groupid, $updatefile){
			if($groupid == 0)
				return;
			$cmd = new Command();
			
			if(isset($groupid)){
				$cmd->sendtype = '1';
				$cmd->groupid = $groupid;
				$cmd->command = self::constructCmd($groupid, 'update|' . UPDATEDIR . $updatefile);
				$this->commandDAO->insert($cmd);
			} elseif (isset($macs)){
				foreach ($macs as $mac){
					if(self::isExist($mac)){
						$cmd->mac = $mac;
						$cmd->sendtype = '0';
						$cmd->command = self::constructCmd($mac, 'update|' . UPDATEDIR . $updatefile);
			
						$this->commandDAO->insert($cmd);
					}
				}
			}
		}
		
		public function catFileTerminalOrGroup($macs, $groupid, $catfile){
			if($groupid == 0)
				return;
			$cmd = new Command();
		
			if(isset($groupid)){
				$cmd->sendtype = '1';
				$cmd->groupid = $groupid;
				$cmd->command = self::constructCmd($groupid, 'cat|' . $catfile);
				$this->commandDAO->insert($cmd);
			} elseif (isset($macs)){
				foreach ($macs as $mac){
					if(self::isExist($mac)){
						$cmd->mac = $mac;
						$cmd->sendtype = '0';
						$cmd->command = self::constructCmd($mac, 'cat|' . $catfile);
		
						$this->commandDAO->insert($cmd);
					}
				}
			}
		}
		
		public function shellTerminalOrGroup($macs, $groupid, $shellcmd){
			if($groupid == 0)
				return;
			$cmd = new Command();
		
			if(isset($groupid)){
				$cmd->sendtype = '1';
				$cmd->groupid = $groupid;
				$cmd->command = self::constructCmd($groupid, 'shell|' . $shellcmd);
				$this->commandDAO->insert($cmd);
			} elseif (isset($macs)){
				foreach ($macs as $mac){
					if(self::isExist($mac)){
						$cmd->mac = $mac;
						$cmd->sendtype = '0';
						$cmd->command = self::constructCmd($mac, 'shell|' . $shellcmd);
		
						$this->commandDAO->insert($cmd);
					}
				}
			}
		}

		public function scheduleTerminalOrGroup($macs, $groupid, $scheduleurl){
			if($groupid == 0)
				return;
			$cmd = new Command();
		
			if(isset($groupid)){
				$cmd->sendtype = '1';
				$cmd->groupid = $groupid;
				$cmd->command = self::constructCmd($groupid, 'schedule|' . $scheduleurl);
				$this->commandDAO->insert($cmd);
			} elseif (isset($macs)){
				foreach ($macs as $mac){
					if(self::isExist($mac)){
						$cmd->mac = $mac;
						$cmd->sendtype = '0';
						$cmd->command = self::constructCmd($mac, 'schedule|' . $scheduleurl);
		
						$this->commandDAO->insert($cmd);
					}
				}
			}
		}

		public function setComTerminalOrGroup($macs, $groupid, $port, $baudrate, $len, $text){
			if($groupid == 0)
				return;
			$cmd = new Command();
		
			if(isset($groupid)){
				$cmd->sendtype = '1';
				$cmd->groupid = $groupid;
				$cmd->command = self::constructCmd($groupid, 'comcmd|' . $port . '|' . $baudrate . '|' . $len . '|' . $text);
				$this->commandDAO->insert($cmd);
			} elseif (isset($macs)){
				foreach ($macs as $mac){
					if(self::isExist($mac)){
						$cmd->mac = $mac;
						$cmd->sendtype = '0';
						$cmd->command = self::constructCmd($mac, 'comcmd|' . $port . '|' . $baudrate . '|' . $len . '|' . $text);
		
						$this->commandDAO->insert($cmd);
					}
				}
			}
		}
		
		
		public function getOldestCmdByMac($mac){
			try {
				$terminal = $this->terminalDAO->queryByMac($mac);
				
				if(!isset($terminal)){
					return null;
				}
				
				$groupid = $terminal->groupid;
				
				$cmd = $this->commandDAO->getOldestCmd($mac, $groupid);
			} catch (Exception $e) {
			}
			
			return $cmd;
		}
		
		
		private function isExist($mac){
			try {
				$rs1 = $this->terminalDAO->queryByMac($mac);
				$rs2 = $this->statusDAO->queryStatusByMac($mac);
			} catch (Exception $e) {
			}
			
			return count($rs1) != 0 && count($rs2) != 0;
		}
		
		private function constructCmd($mac, $cmd){
			$c = '';
			$c = $c . 'term_id=' . $mac . '|' . 'svr_time=' . date("Y-m-d H:i:s") . '|' . 'web_cmd=' . $cmd;
			
			return $c;
		}
		
		
		
	}

?>

