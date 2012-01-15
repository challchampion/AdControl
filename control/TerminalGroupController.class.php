<?php 

	error_reporting(E_ALL);
	
	class TerminalGroupController {
		
		private static $tgroupcontroller;
		private $tgrouplogic;
		
		private function __construct(){
			$this->tgrouplogic = TerminalGroupLogic::newInstance();
		}
		
		public static function newInstance(){
			if(self::$tgroupcontroller == null){
				self::$tgroupcontroller = new TerminalGroupController();
			}
			
			return self::$tgroupcontroller;
		}
		
		
		public function addTGroup($request, $response){
			$parentgroupid = $request->param('parentgroupid');
			$groupname = $request->param('groupname');
			
			$res = $this->tgrouplogic->addTerminalGroup($parentgroupid, $groupname);
			
			$response->json($res);
		}
		
		public function deleteTGroup($requset, $response){
			$groupid = $requset->param('groupid');
			
			$res = $this->tgrouplogic->deleteTerminalGroup($groupid);
			
			$response->json($res);
		}
		
		public function updateTGroup($request, $response){
			$groupid = $request->param('groupid');
			$newgroupname = $request->param('newgroupname');
			
			$res = $this->tgrouplogic->updateTerminalGroup($groupid, $newgroupname);
			
			$response->json($res);
		}
		
		/*
		 * required param :  parent groupid
		 */
		public function queryTgroups($request, $response){
			$parentgroupid = $request->param('parentgroupid');
			
			$res = $this->tgrouplogic->queryTerminalGroup($parentgroupid);
			
			$response->json($res);
		}
		
		public function queryCertainTGroup($request, $response){
			$groupid = $request->param('groupid');
			
			$res = $this->tgrouplogic->queryCertainTerminalGroup($groupid);
			
			$response->json($res);
		}		
		
	}


?>