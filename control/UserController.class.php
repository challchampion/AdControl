<?php 
	
	error_reporting(E_ALL);

 	require_once("../lib/base.inc.php");
	use lib\logic;

	class UserController {
		
		public function login($request, $response){
			$name = $request->param('name');
			$passwd = $request->param('passwd');
			
			$user = new User();
			$user->username = $name;
			$user->passwd = $passwd;
// 			if(UserLogic::verifyUser($user) == UserLogic::USERSUCCESS){
// 				header('Location: http://www.baidu.com/');
// 			}
		}
		
	}

?>