<?php
/**
 * Class that operate on table 'user_tgroup'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2011-12-26 11:17
 */
class UserTgroupMySqlExtDAO extends UserTgroupMySqlDAO{

	public function deleteByUser($userid){
		$sql = 'DELETE FROM user_tgroup WHERE userid = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($userid);
		
		return $this->executeUpdate($sqlQuery);
	}
	
	public function deleteByGroup($groupid){
		$sql = 'DELETE FROM user_tgroup WHERE groupid = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($userid);
		
		return $this->executeUpdate($sqlQuery);
	}
	
}
?>