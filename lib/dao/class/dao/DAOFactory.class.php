<?php

/**
 * DAOFactory
 * @author: http://phpdao.com
 * @date: ${date}
 */
class DAOFactory{
	
	/**
	 * @return AspectratioDAO
	 */
	public static function getAspectratioDAO(){
		return new AspectratioMySqlExtDAO();
	}

	/**
	 * @return DisplayportDAO
	 */
	public static function getDisplayportDAO(){
		return new DisplayportMySqlExtDAO();
	}

	/**
	 * @return MediaDAO
	 */
	public static function getMediaDAO(){
		return new MediaMySqlExtDAO();
	}

	/**
	 * @return MediacategoryDAO
	 */
	public static function getMediacategoryDAO(){
		return new MediacategoryMySqlExtDAO();
	}

	/**
	 * @return MediainfoDAO
	 */
	public static function getMediainfoDAO(){
		return new MediainfoMySqlExtDAO();
	}

	/**
	 * @return PatternDAO
	 */
	public static function getPatternDAO(){
		return new PatternMySqlExtDAO();
	}

	/**
	 * @return PatternareaDAO
	 */
	public static function getPatternareaDAO(){
		return new PatternareaMySqlExtDAO();
	}

	/**
	 * @return PlaylistDAO
	 */
	public static function getPlaylistDAO(){
		return new PlaylistMySqlExtDAO();
	}

	/**
	 * @return PlaylistitemDAO
	 */
	public static function getPlaylistitemDAO(){
		return new PlaylistitemMySqlExtDAO();
	}

	/**
	 * @return PlayscheduleDAO
	 */
	public static function getPlayscheduleDAO(){
		return new PlayscheduleMySqlExtDAO();
	}

	/**
	 * @return PlayscheduleitemDAO
	 */
	public static function getPlayscheduleitemDAO(){
		return new PlayscheduleitemMySqlExtDAO();
	}

	/**
	 * @return ResolutionDAO
	 */
	public static function getResolutionDAO(){
		return new ResolutionMySqlExtDAO();
	}

	/**
	 * @return ScheduletypeDAO
	 */
	public static function getScheduletypeDAO(){
		return new ScheduletypeMySqlExtDAO();
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
	 * @return TerminalinfoDAO
	 */
	public static function getTerminalinfoDAO(){
		return new TerminalinfoMySqlExtDAO();
	}

	/**
	 * @return UserDAO
	 */
	public static function getUserDAO(){
		return new UserMySqlExtDAO();
	}

	/**
	 * @return UsergroupDAO
	 */
	public static function getUsergroupDAO(){
		return new UsergroupMySqlExtDAO();
	}


}
?>