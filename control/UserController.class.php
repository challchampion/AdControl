<?php 
	
	error_reporting(E_ALL);

	class UserController {
		private static $controller;
		
		private $userlogic;
		
		private function __construct(){			
			$this->userlogic = UserLogic::newInstance();
		}
		
		public static function newInstance(){
			if(self::$controller == null){
				self::$controller = new UserController();
			}
			return self::$controller;
		}
		
		public function login($request, $response){
			$name = $request->param('name');
			$passwd = $request->param('passwd');
			$enterprise = $request->param('enterprise');
			
			if(isset($name) && isset($passwd) && isset($enterprise)){
				if($this->userlogic->verifyUser($name, $passwd, $enterprise)){
					$res = array('success'=>true, 'msg'=>'welcome, ' . $name);
					
					$response->json($res);
				} else {
					$res = array('success'=>false, 'msg'=>'could not log you in');
					
					$response->json($res);
				}
			} else {
				$res = array('success'=>false, 'msg'=>'please enter the necessary item');
					
				$response->json($res);
			}
			
		}
		
		public function logout($request, $response){
			if($this->userlogic->hasLogin()){
				$this->userlogic->logout();
				
				$res = array('success'=>true, 'msg'=>'log out');
				$response->json($res);
			} else {
				$res = array('success'=>false, 'msg'=>'you are not log in yet');
				$response->json($res);
			}
		}
		
		public function addUser($request, $response){
			$name = $request->param('name');
			$passwd = $request->param('passwd');
			$auth = $request->param('auth');
			
			$res = $this->userlogic->addUser($name, $passwd, $auth);
			
			$response->json($res);
		}
		
		public function deleteUser($request, $response){
			$name = $request->param('name');
			
			$res = $this->userlogic->deleteUser($name);
			
			$response->json($res);
		}

		public function updateUser($request, $response){
			$oldname = $request->param('oldname');
			$newname = $request->param('newname');
			$oldauth = $request->param('oldauth');
			$newauth = $request->param('newauth');
			
			$res = $this->userlogic->updateUser($oldname, $newname, $oldauth, $newauth);
			
			$response->json($res);
		}
		
		public function queryUser($request, $response){
			$name = $request->param('name');
			
			$res = $this->userlogic->updateUser($name);
			
			$response->json($res);
		}
		
		public function alterPasswd($request, $response){
			$name = $request->param('name');
			$oldpass = $request->param('oldpasswd');
			$newpass = $request->param('newpasswd');
			
			$res = $this->userlogic->updateUser($name, $oldpass, $newpass);
			
			$response->json($res);
		}
		
	}

?>