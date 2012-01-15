<?php
	
	error_reporting(E_ALL);
	
	require_once('lib/base.inc.php');
	require_once('control/UserController.class.php');
	require_once 'control/TerminalController.class.php';
	require_once 'control/TerminalGroupController.class.php';
	
	respond('GET', '/Commheart.[php]?', function ($request, $response){
			
		$controller = new TerminalController();
			
		$controller->onTerminalInput($request, $response);
	});
	
	respond('GET', '/?', function ($request, $response){
		$response->render('view/login.html');
	});
	
	with('/Advertise/user', function (){
		respond('/login', function ($request, $response){
			$controller = UserController::newInstance();
			
			$controller->login($request, $response);
		});
		
		respond('/logout', function ($request, $response){
			$controller = UserController::newInstance();
			
			$controller->logout($request, $response);
		});
		
		respond('/adduser', function ($request, $response){
			$controller = UserController::newInstance();
			
			$controller->addUser($request, $response);
		});
		
		respond('/deleteuser', function ($request, $response){
			$controller = UserController::newInstance();
			
			$controller->deleteUser($request, $response);
		});
		
		respond('/updateuser', function ($request, $response){
			$controller = UserController::newInstance();
			
			$controller->updateUser($request, $response);
		});
		
		respond('/queryuser', function ($request, $response){
			$controller = UserController::newInstance();
			
			$controller->queryUser($request, $response);
		});
		
		respond('/alterpasswd', function ($request, $response){
			$controller = UserController::newInstance();
			
			$controller->alterPasswd($request, $response);
		});
		
	});

// 	respond('GET', '/Advertise/?', function ($request, $response){
// 		$response->escape = function ($str){
// 			return htmlentities($str);
// 		};
		
// 		$response->render("view/html/login.html");
// 	});
	
	with('/Advertise/enterprise', function (){
		
		respond('/addenterprise', function ($request, $response){
			$controller = EnterpriseController::newInstance();
			$controller->addEnterprise($request, $response);
		});
		
		respond('/deleteenterprise', function ($request, $response){
			$controller = EnterpriseController::newInstance();
			$controller->deleteEnterprise($request, $response);	
		});
		
		respond('/updateenterprise', function ($request, $response){
			$controller = EnterpriseController::newInstance();
			$controller->updateEnterprise($request, $response);
		});
		
		respond('/queryenterprise', function ($request, $response){
			$controller = EnterpriseController::newInstance();
			$controller->queryEnterprise($request, $response);
		});
		
	});
	
	with('/Advertise/terminal', function (){

		respond('/getallterminal', function ($request, $response){
			$controller = TerminalController::newInstance();	
			$controller->getAllTerminals($request, $response);
		});
		
		respond('/addterminal', function ($request, $response){
			$controller = TerminalController::newInstance();
			$controller->addTerminal($request, $response);
		});
		
		respond('/updateterminal', function ($request, $response){
			$controller = TerminalController::newInstance();
			$controller->updateTerminalInfo($request, $response);
		});
		
		respond('/deleteterminal', function ($request, $response){
			$controller = TerminalController::newInstance();
			$controller->deleteTerminals($request, $response);
		});
		
		respond('/poweroffterminal', function ($request, $response){
			$controller = TerminalController::newInstance();
			$controller->poweroffTerminals($request, $response);
		});
		
		respond('/rebootterminal', function ($request, $response){
			$controller = TerminalController::newInstance();
			$controller->rebootTerminals($request, $response);
		});
		
		respond('/sleepterminal', function ($request, $response){
			$controller = TerminalController::newInstance();
			$controller->sleepTerminals($request, $response);
		});
		
		respond('/test', function ($request, $response){
			$controller = TerminalController::newInstance();
			$controller->test($request, $response);
		});
		
	});
	
	with('/Advertise/tgroup', function (){
		
		respond('/addtgroup', function ($request, $response){
			$controller = TerminalGroupController::newInstance();
			$controller->addTGroup($request, $response);
		});
		
		respond('/deletetgroup', function ($request, $response){
			$controller = TerminalGroupController::newInstance();
			$controller->deleteTGroup($requset, $response);
		});
		
		respond('/updatetgroup', function ($request, $response){
			$controller = TerminalGroupController::newInstance();
			$controller->updateTGroup($request, $response);
		});
		
		respond('/gettgroup', function ($request, $response){
			$controller = TerminalGroupController::newInstance();
			$controller->queryTgroups($request, $response);
		});
		
		respond('/querytgroup', function ($request, $response){
			$controller = TerminalGroupController::newInstance();
			$controller->queryCertainTGroup($request, $response);
		});
		
	});
	
// 	foreach ($myrouter as $route){
// 		with("/$route", "control/$route.php");
// 	}
	
	dispatch();
?>