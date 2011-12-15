<?php
/**
 * Class that operate on table 'terminal'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2011-12-15 02:58
 */
class TerminalMySqlDAO implements TerminalDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return TerminalMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM terminal WHERE terminalid = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM terminal';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM terminal ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param terminal primary key
 	 */
	public function delete($terminalid){
		$sql = 'DELETE FROM terminal WHERE terminalid = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($terminalid);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param TerminalMySql terminal
 	 */
	public function insert($terminal){
		$sql = 'INSERT INTO terminal (terminal_name, terminal_type, ip, mac, volume, terminal_status, terminal_groupid, username) VALUES (?, ?, ?, ?, ?, ?, ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($terminal->terminalName);
		$sqlQuery->set($terminal->terminalType);
		$sqlQuery->set($terminal->ip);
		$sqlQuery->set($terminal->mac);
		$sqlQuery->setNumber($terminal->volume);
		$sqlQuery->set($terminal->terminalStatus);
		$sqlQuery->setNumber($terminal->terminalGroupid);
		$sqlQuery->set($terminal->username);

		$id = $this->executeInsert($sqlQuery);	
		$terminal->terminalid = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param TerminalMySql terminal
 	 */
	public function update($terminal){
		$sql = 'UPDATE terminal SET terminal_name = ?, terminal_type = ?, ip = ?, mac = ?, volume = ?, terminal_status = ?, terminal_groupid = ?, username = ? WHERE terminalid = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($terminal->terminalName);
		$sqlQuery->set($terminal->terminalType);
		$sqlQuery->set($terminal->ip);
		$sqlQuery->set($terminal->mac);
		$sqlQuery->setNumber($terminal->volume);
		$sqlQuery->set($terminal->terminalStatus);
		$sqlQuery->setNumber($terminal->terminalGroupid);
		$sqlQuery->set($terminal->username);

		$sqlQuery->setNumber($terminal->terminalid);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM terminal';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryByTerminalName($value){
		$sql = 'SELECT * FROM terminal WHERE terminal_name = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByTerminalType($value){
		$sql = 'SELECT * FROM terminal WHERE terminal_type = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByIp($value){
		$sql = 'SELECT * FROM terminal WHERE ip = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByMac($value){
		$sql = 'SELECT * FROM terminal WHERE mac = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByVolume($value){
		$sql = 'SELECT * FROM terminal WHERE volume = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryByTerminalStatus($value){
		$sql = 'SELECT * FROM terminal WHERE terminal_status = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByTerminalGroupid($value){
		$sql = 'SELECT * FROM terminal WHERE terminal_groupid = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryByUsername($value){
		$sql = 'SELECT * FROM terminal WHERE username = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByTerminalName($value){
		$sql = 'DELETE FROM terminal WHERE terminal_name = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByTerminalType($value){
		$sql = 'DELETE FROM terminal WHERE terminal_type = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByIp($value){
		$sql = 'DELETE FROM terminal WHERE ip = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByMac($value){
		$sql = 'DELETE FROM terminal WHERE mac = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByVolume($value){
		$sql = 'DELETE FROM terminal WHERE volume = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByTerminalStatus($value){
		$sql = 'DELETE FROM terminal WHERE terminal_status = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByTerminalGroupid($value){
		$sql = 'DELETE FROM terminal WHERE terminal_groupid = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByUsername($value){
		$sql = 'DELETE FROM terminal WHERE username = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return TerminalMySql 
	 */
	protected function readRow($row){
		$terminal = new Terminal();
		
		$terminal->terminalid = $row['terminalid'];
		$terminal->terminalName = $row['terminal_name'];
		$terminal->terminalType = $row['terminal_type'];
		$terminal->ip = $row['ip'];
		$terminal->mac = $row['mac'];
		$terminal->volume = $row['volume'];
		$terminal->terminalStatus = $row['terminal_status'];
		$terminal->terminalGroupid = $row['terminal_groupid'];
		$terminal->username = $row['username'];

		return $terminal;
	}
	
	protected function getList($sqlQuery){
		$tab = QueryExecutor::execute($sqlQuery);
		$ret = array();
		for($i=0;$i<count($tab);$i++){
			$ret[$i] = $this->readRow($tab[$i]);
		}
		return $ret;
	}
	
	/**
	 * Get row
	 *
	 * @return TerminalMySql 
	 */
	protected function getRow($sqlQuery){
		$tab = QueryExecutor::execute($sqlQuery);
		if(count($tab)==0){
			return null;
		}
		return $this->readRow($tab[0]);		
	}
	
	/**
	 * Execute sql query
	 */
	protected function execute($sqlQuery){
		return QueryExecutor::execute($sqlQuery);
	}
	
		
	/**
	 * Execute sql query
	 */
	protected function executeUpdate($sqlQuery){
		return QueryExecutor::executeUpdate($sqlQuery);
	}

	/**
	 * Query for one row and one column
	 */
	protected function querySingleResult($sqlQuery){
		return QueryExecutor::queryForString($sqlQuery);
	}

	/**
	 * Insert row to table
	 */
	protected function executeInsert($sqlQuery){
		return QueryExecutor::executeInsert($sqlQuery);
	}
}
?>