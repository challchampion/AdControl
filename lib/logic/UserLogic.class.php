<?php
	namespace lib\logic;
	
	error_reporting(E_ALL);

    require_once('base.inc.php');
    
    class UserLogic {
    	const USERSUCCESS = 0;
    	
    	const USERNOTCOMPLETE = 1;
    	const USERNOAUTHORITY = 2;
    	const USERADDEXIST = 3;
    	
    	const USERNOTEXIST = 4;
    	const USERDELETEERR = 5;
    	
        public static function addUser(&$user) {
		    if(!isset($user->username) || !isset($user->passwd) || isset($user->usergroupname)){
		    	 return self::USERNOTCOMPLETE;
		    } 
	
		    if(!isset($user->userstatus)){
		        $user->userstatus = 'offline';
		    }
		    
		    if(!isset($user->authority)){
		        $user->authority = '';
		    }
	
		    $userDAO = DAOFactory::getUserDAO();
		    if($userDAO->load($user->username) != null){
		    	return self::USERADDEXIST;
		    } else {
		    	$userDAO->insert($user);
		    }
		    
		    return self::USERSUCCESS;
		}

		public static function deleteUser(&$user){
			$userDAO = DAOFactory::getUserDAO();
			
			if($userDAO->load($user->username) == null){
				return self::USERNOTEXIST;
			}
			
			$affectedRows = $userDAO->deleteByUsername($user->username);
			
			if($affectedRows == 0){
				return self::USERDELETEERR;
			} else {
				return self::USERSUCCESS;
			}
		}

    	public static function verifyUser(&$user){
    		$userDAO = DAOFactory::getUserDAO();
    		
    		if($userDAO->load($user->$username) != null)return self::USERSUCCESS;
    		else return self::USERNOTEXIST;
    	}
    	
    	public static function alterPasswd(&$user){
    		$userDAO = DAOFactory::getUserDAO();
    		
    		if($userDAO->load($user->username) == null){
    			return self::USERNOTEXIST;
    		} else {
    			$userDAO->updatePasswd($user);
    		}
    	}
    	
    	public static function alterGroup(&$user){
    		$userDAO = DAOFactory::getUserDAO();
    		
    		if($userDAO->load($user->username) == null){
    			return self::USERNOTEXIST;
    		} else {
    			$userDAO->updateUsergroup($user);
    		}
    	}
    }

?>
