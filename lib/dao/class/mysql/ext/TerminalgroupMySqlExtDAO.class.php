<?php
/**
 * Class that operate on table 'terminalgroup'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2011-12-26 11:17
 */
class TerminalgroupMySqlExtDAO extends TerminalgroupMySqlDAO{

	public function updateTGroupNameById($groupid, $groupname){
		$sql = 'UPDATE terminalgroup SET groupname = ? WHERE groupid = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($terminalgroup->groupname);
		
		$sqlQuery->setNumber($terminalgroup->groupid);
		return $this->executeUpdate($sqlQuery);
	}
	
	public function queryDefaultGroupByEnterprise($enterprisename){
		$sql = 'SELECT * FROM terminalgroup WHERE groupname = ? AND enterprisename = ? AND parent = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setString('default');
		$sqlQuery->set($enterprisename);
		$sqlQuery->setNumber(0);
		return $this->getList($sqlQuery);
	}
	
	public function queryCertainGroupByEnterprise($groupname, $enterprisename, $parentid){
		$sql = 'SELECT * FROM terminalgroup WHERE groupname = ? AND enterprisename = ? AND parent = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($groupname);
		$sqlQuery->set($enterprisename);
		$sqlQuery->setNumber($parentid);
		return $this->getList($sqlQuery);
	}
	
	public function queryGroupsByEnterprise($enterprise, $parentid){
		$sql = 'SELECT * FROM terminalgroup WHERE enterprisename = ? AND parent = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($enterprisename);
		$sqlQuery->setNumber($parentid);
		return $this->getList($sqlQuery);
	}
	
}
?>