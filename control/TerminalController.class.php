<?php 
	
	error_reporting(E_ALL);

	/*
	 * 此控制器内只为terminal保留一个action，负责具体事务的分发
	 */
	class TerminalController {
		
		private static $terminalcontroller;
		private $terminallogic;
		
		private function __construct(){
			$this->terminallogic = TerminalLogic::newInstance();
		}
		
		public static function newInstance(){
			if(self::$terminalcontroller == null){
				self::$terminalcontroller = new TerminalController();
			}
			
			return self::$terminalcontroller;
		}
		
		/*
		 * only for test
		 */
		public function test($request, $response){
			$this->onTerminalInput($request, $response);
		}
		
		
		public function onTerminalInput($request, $response){
			
			$time = $request->param('t');
			$id = $request->param('id');
			$ip = $request->param('ip');
			$ver = $request->param('ver');
			$error = $request->param('error');
			$status = $request->param('status');
			$cmd = $request->param('cmd');
			$rt = $request->param('rt');
			
			if(!isset($id) || !isset($ip) || !isset($ver)){
				return;
			}
			
			$terminal = new Terminal();
			$terminal->mac = $request->param('id');
			$terminal->ip = $request->param('ip');
			$terminal->version = $request->param('ver');
			
			/*
			 * dispatch and process terminal request
			 */
			$this->terminallogic->updateTerminalState($terminal->mac);
			
			if(isset($error) && isset($status)){
				$this->logStatus($time, $terminal, $status, $error);
					
			} elseif (isset($status)){
				$this->logStatus($time, $terminal, $status);
								
			} elseif (isset($error) && isset($cmd) && isset($rt)){
				$this->logCmd($time, $terminal, $cmd, $rt, $error);
								
			} elseif (isset($cmd) && isset($rt)){
				$this->logCmd($time, $terminal, $cmd, $rt);
				
			}
			
			/*
			 * response to terminal
			 */
			$cmd = $this->terminallogic->getOldestCmdByMac($id);
			//TODO
			echo $cmd;
		}

		
		//除超级用户之外，普通用户将不具有添加终端的权限，拥有终端管理权限的普通企业用户，只可删除，修改，查询终端。
		public function addTerminal($request, $response){
			$terminal = new Terminal();
			
			$terminal->mac = $request->param('mac');
			$terminal->address = $request->param('address');
			$terminal->terminalname = $request->param('terminalname');
			$enterprisename = $request->param('enterprisename');
			
			$res = $this->terminallogic->addTerminal($terminal, $enterprisename);
			
			$response->json($res);
			
			$this->terminallogic->checkTerminalStatus();
		}
		
		public function getGroupTerminals($request, $response){
			$groupid = $request->param('groupid');
			
			$res = $this->terminallogic->getTerminalsByGroup($groupid);
			
			$response->json($res);
			
			$this->terminallogic->checkTerminalStatus();
		}
		
		public function updateTerminalInfo($request, $response){
			$terminal = new Terminal();
			
			$mac = $request->param('mac');
			$terminalname = $request->param('terminalname');
			
			$res = $this->terminallogic->updateTerminalInfo($terminalname, $mac);
			
			$response->json($res);
			
			$this->terminallogic->checkTerminalStatus();
		}

		public function deleteTerminals($request, $response){
			$macs = $request->param('macs');
			
			foreach ($macs as $mac){
				$this->terminallogic->deleteTerminalByMac($mac);
			}
			
			$res = array('success'=>true);
			$response->json($res);
			
			$this->terminallogic->checkTerminalStatus();
		}
		
		
		
		public function poweroffTerminals($request, $response){
			$macs = $request->param('macs');
			$groupid = $request->param('groupid');
			
			$this->terminallogic->noParamCmdOnTerminalOrGroup('poweroff', $macs, $groupid);
			
			$res = array('success'=>true);
			$response->json($res);
			
			$this->terminallogic->checkTerminalStatus();
		}
		
		public function rebootTerminals($request, $response){
			$macs = $request->param('macs');
			$groupid = $request->param('groupid');
			
			$this->terminallogic->noParamCmdOnTerminalOrGroup('reboot', $macs, $groupid);
			
			$res = array('success'=>true);
			$response->json($res);
			
			$this->terminallogic->checkTerminalStatus();
		}
		
		public function sleepTerminals($request, $response){
			$macs = $request->param('macs');
			$groupid = $request->param('groupid');
			
			$this->terminallogic->noParamCmdOnTerminalOrGroup('sleep', $macs, $groupid);
			
			$res = array('success'=>true);
			$response->json($res);
			
			$this->terminallogic->checkTerminalStatus();
		}
		
		public function syncTime($request, $response){
			$macs = $request->param('macs');
			$groupid = $request->param('groupid');
			
			$this->terminallogic->noParamCmdOnTerminalOrGroup('synctime', $macs, $groupid);
			
			$res = array('success'=>true);
			$response->json($res);
			
			$this->terminallogic->checkTerminalStatus();
		}
		
		public function fileList($request, $response){
			$macs = $request->param('macs');
			$groupid = $request->param('groupid');
			
			$this->terminallogic->noParamCmdOnTerminalOrGroup('filelist', $macs, $groupid);
			
			$res = array('success'=>true);
			$response->json($res);
			
			$this->terminallogic->checkTerminalStatus();
		}

		public function playList($request, $response){
			$macs = $request->param('macs');
			$groupid = $request->param('groupid');
		
			$this->terminallogic->noParamCmdOnTerminalOrGroup('playlist', $macs, $groupid);
		
			$res = array('success'=>true);
			$response->json($res);
		
			$this->terminallogic->checkTerminalStatus();
		}
		
		public function screen($request, $response){
			$macs = $request->param('macs');
			$groupid = $request->param('groupid');
			
			$this->terminallogic->noParamCmdOnTerminalOrGroup('screen', $macs, $groupid);
			
			$res = array('success'=>true);
			$response->json($res);
			
			$this->terminallogic->checkTerminalStatus();
		}
		
		public function getMemoryInfo($request, $response){
			$macs = $request->param('macs');
			$groupid = $request->param('groupid');
		
			$this->terminallogic->noParamCmdOnTerminalOrGroup('memory', $macs, $groupid);
		
			$res = array('success'=>true);
			$response->json($res);
		
			$this->terminallogic->checkTerminalStatus();
		}
		
		public function getDiskInfo($request, $response){
			$macs = $request->param('macs');
			$groupid = $request->param('groupid');
		
			$this->terminallogic->noParamCmdOnTerminalOrGroup('disk', $macs, $groupid);
		
			$res = array('success'=>true);
			$response->json($res);
		
			$this->terminallogic->checkTerminalStatus();
		}
	
		public function timeonoff($request, $response){
			$macs = $request->param('macs');
			$groupid = $request->param('groupid');
			$poweron = $request->param('poweron');
			$poweroff = $request->param('poweroff');

			$this->terminallogic->timeonoffTerminalOrGroup($macs, $groupid, $poweron, $poweroff);
			
			$res = array('success'=>true);
			$response->json($res);
			
			$this->terminallogic->checkTerminalStatus();
		}
		
		public function cancelTimeonoff($request, $response){
			$macs = $request->param('macs');
			$groupid = $request->param('groupid');
			
			$this->terminallogic->cancelTimeTerminalOrGroup($macs, $groupid);
			
			$res = array('success'=>true);
			$response->json($res);
			
			$this->terminallogic->checkTerminalStatus();
		}	
		
		public function deleteFile($request, $response){
			
		}
		
		public function transCmd($request, $response){
			
		}
		
		
		
		private function logStatus($time, &$terminal, $status, $error = null){
			$fp = @fopen(ROOT . '/log/status.txt', 'a');
			
			$outputstr = '' . $terminal->mac . "\t";
			$outputstr = $outputstr . $time . "\tError:" . $error . "\tStatus:" . $status;
			$outputstr = $outputstr . "\n";

			fwrite($fp, $outputstr);
		}
		
		private function logCmd($time, &$terminal, $cmd, $rt, $error = null){
			$fp = @fopen(ROOT . '/log/cmd.txt', 'a');
			
			$outputstr = '' . $terminal->mac . "\t";
			$outputstr = $outputstr . $time . "\tError:" . $error . "\tCmd:" . $cmd . "\tResult:" . $rt;
			
			fwrite($fp, $outputstr);
		}
	}
	
?>