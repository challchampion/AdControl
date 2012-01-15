<?php 

	error_reporting(E_ALL);
	
	class EnterpriseController {
		
		private static $controller;
		
		private $enterpriselogic;
		
		private function __construct(){
			$this->enterpriselogic = EnterpriseLogic::newInstance();
		}
		
		public static function newInstance(){
			if(self::$controller == null){
				self::$controller = new EnterpriseController();
			}
			
			return self::$controller;
		}

		
		public function addEnterprise($request, $response){
			$enterprisename = $request->param('enterprisename');
			$adminname = $request->param('adminname');
			$adminpasswd = $request->param('adminpasswd');
		
			$res = $this->enterpriselogic->addEnterprise($enterprisename, $adminname, $adminpasswd);
			
			$response->json($res);
		}
		
		public function deleteEnterprise($request, $response){
			$enterprisename = $request->param('enterprisename');
			
			$res = $this->enterpriselogic->deleteEnterprise($enterprisename);
			
			$response->json($res);
		}
		
		//TODO
		public function updateEnterprise($request, $response){
			
		}
		
		public function queryEnterprise($request, $response){

			$res = $this->enterpriselogic->queryEnterprise();
			
			$response->json($res);
		}
		
		
		
		
	}


?>