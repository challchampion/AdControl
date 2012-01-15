<?php

/**
 * DAOFactory
 * @author: http://phpdao.com
 * @date: ${date}
 */
class DAOFactory{
	
	/**
	 * @return CommandDAO
	 */
	public static function getCommandDAO(){
		return new CommandMySqlExtDAO();
	}

	/**
	 * @return EnterpriseDAO
	 */
	public static function getEnterpriseDAO(){
		return new EnterpriseMySqlExtDAO();
	}

	/**
	 * @return TerminalDAO
	 */
	public static function getTerminalDAO(){
		return new TerminalMySqlExtDAO();
	}

	/**
	 * @return TerminalgroupDAO
	 */
	public static function getTerminalgroupDAO(){
		return new TerminalgroupMySqlExtDAO();
	}

	/**
	 * @return TerminalstatusDAO
	 */
	public static function getTerminalstatusDAO(){
		return new TerminalstatusMySqlExtDAO();
	}

	/**
	 * @return UserDAO
	 */
	public static function getUserDAO(){
		return new UserMySqlExtDAO();
	}

	/**
	 * @return UserTgroupDAO
	 */
	public static function getUserTgroupDAO(){
		return new UserTgroupMySqlExtDAO();
	}


}
?>