<?php 
	
	$myrouter = array(
		array('/Advertise/?', 'index', 'index'),		
	);

	define('ROOT', '/Program Files/workspace/Advertise');
	define('UPDATEDIR', '');
	
	define('SUPERGROUP', 0);
	define('COMMONGROUP', 1);
	
	define('DEFAULTSYSADMIN', 0);
	define('SYSADMIN', 1);
	define('TERMINALADMIN', 2);
	define('MEDIAUPLOADER', 4);
	define('MEDIAEXAMINER', 8);
	define('LISTMAKER', 16);
	define('LISTISSUER', 32);
	define('REPORTMAKER', 64);
	define('USERADMIN', 128);
	
	
	$userAuth = array('DEFAULTSYSADMIN'=>DEFAULTSYSADMIN,
					  'SYAADMIN'=>SYSADMIN, 
			          'TERMINALADMIN'=>TERMINALADMIN,
					  'MEDIAUPLOADER'=>MEDIAUPLOADER,
					  'MEDIAEXAMINER'=>MEDIAEXAMINER,
					  'LISTMAKER'=>LISTMAKER,
					  'LISTISSUER'=>LISTISSUER,
			 		  'REPORTMAKER'=>REPORTMAKER,
					  'USERADMIN'=>USERADMIN);

	define('DEFAULTENTERPRISE', 'baisiqiao'); 
	
?>