<?php
/**
 * Class that operate on table 'terminal'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2011-12-29 14:21
 */
class TerminalMySqlDAO implements TerminalDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return TerminalMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM terminal WHERE mac = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($id);
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
	public function delete($mac){
		$sql = 'DELETE FROM terminal WHERE mac = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($mac);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param TerminalMySql terminal
 	 */
	public function insert($terminal){
		$sql = 'INSERT INTO terminal (groupid, ip, terminalname, discinfo, address, terminaltype, version) VALUES (?, ?, ?, ?, ?, ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->setNumber($terminal->groupid);
		$sqlQuery->set($terminal->ip);
		$sqlQuery->set($terminal->terminalname);
		$sqlQuery->setNumber($terminal->discinfo);
		$sqlQuery->set($terminal->address);
		$sqlQuery->set($terminal->terminaltype);
		$sqlQuery->set($terminal->version);

		$id = $this->executeInsert($sqlQuery);	
		$terminal->mac = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param TerminalMySql terminal
 	 */
	public function update($terminal){
		$sql = 'UPDATE terminal SET groupid = ?, ip = ?, terminalname = ?, discinfo = ?, address = ?, terminaltype = ?, version = ? WHERE mac = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->setNumber($terminal->groupid);
		$sqlQuery->set($terminal->ip);
		$sqlQuery->set($terminal->terminalname);
		$sqlQuery->setNumber($terminal->discinfo);
		$sqlQuery->set($terminal->address);
		$sqlQuery->set($terminal->terminaltype);
		$sqlQuery->set($terminal->version);

		$sqlQuery->set($terminal->mac);
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

	public function queryByGroupid($value){
		$sql = 'SELECT * FROM terminal WHERE groupid = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryByIp($value){
		$sql = 'SELECT * FROM terminal WHERE ip = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByTerminalname($value){
		$sql = 'SELECT * FROM terminal WHERE terminalname = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByDiscinfo($value){
		$sql = 'SELECT * FROM terminal WHERE discinfo = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryByAddress($value){
		$sql = 'SELECT * FROM terminal WHERE address = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByTerminaltype($value){
		$sql = 'SELECT * FROM terminal WHERE terminaltype = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByVersion($value){
		$sql = 'SELECT * FROM terminal WHERE version = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByGroupid($value){
		$sql = 'DELETE FROM terminal WHERE groupid = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByIp($value){
		$sql = 'DELETE FROM terminal WHERE ip = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByTerminalname($value){
		$sql = 'DELETE FROM terminal WHERE terminalname = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByDiscinfo($value){
		$sql = 'DELETE FROM terminal WHERE discinfo = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByAddress($value){
		$sql = 'DELETE FROM terminal WHERE address = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByTerminaltype($value){
		$sql = 'DELETE FROM terminal WHERE terminaltype = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByVersion($value){
		$sql = 'DELETE FROM terminal WHERE version = ?';
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
		
		$terminal->mac = $row['mac'];
		$terminal->groupid = $row['groupid'];
		$terminal->ip = $row['ip'];
		$terminal->terminalname = $row['terminalname'];
		$terminal->discinfo = $row['discinfo'];
		$terminal->address = $row['address'];
		$terminal->terminaltype = $row['terminaltype'];
		$terminal->version = $row['version'];

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