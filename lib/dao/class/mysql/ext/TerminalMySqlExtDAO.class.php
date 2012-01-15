<?php
/**
 * Class that operate on table 'terminal'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2011-12-26 11:17
 */
class TerminalMySqlExtDAO extends TerminalMySqlDAO{

	public function updateTerminalNameByMac($terminalname, $mac){
		$sql = 'UPDATE terminal SET terminalname = ? WHERE mac = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($terminal->terminalname);
		
		$sqlQuery->set($terminal->mac);
		return $this->executeUpdate($sqlQuery);
	}
	
	public function queryByMac($mac){
		$sql = 'SELECT * FROM terminal WHERE mac = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($mac);
		return $this->getRow($sqlQuery);
	}
	
	public function deleteByMac($mac){
		$sql = 'DELETE FROM terminal WHERE mac = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($mac);
		return $this->executeUpdate($sqlQuery);
	}
		
}
?>