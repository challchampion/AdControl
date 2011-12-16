<?php
	
	error_reporting(E_ALL);
	
	require_once('control/UserController.class.php');
	require_once('lib/base.inc.php');
	
	with('/Advertise/users', function (){
		respond('GET', '/?', function ($request, $response){
			$controller = new UserController();
			
			$controller->login($request, $response);
		});
		
		respond('GET', '/[:id]', function ($request, $response){
			$response->escape = function ($str){
				return htmlentities($str);
			};
			
			$response->render("parts/index.phtml", array('title'=>'Single'));
		});
	});

	respond('GET', '/Advertise/?', function ($request, $response){
		$response->escape = function ($str){
			return htmlentities($str);
		};
		
		$response->render("view/html/login.html");
	});
	
// 	foreach ($myrouter as $route){
// 		with("/$route", "control/$route.php");
// 	}
	
	dispatch();
?>