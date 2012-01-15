<?php
/**
 * Class that operate on table 'terminalstatus'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2011-12-29 14:21
 */
class TerminalstatusMySqlDAO implements TerminalstatusDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return TerminalstatusMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM terminalstatus WHERE mac = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM terminalstatus';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM terminalstatus ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param terminalstatu primary key
 	 */
	public function delete($mac){
		$sql = 'DELETE FROM terminalstatus WHERE mac = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($mac);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param TerminalstatusMySql terminalstatu
 	 */
	public function insert($terminalstatu){
		$sql = 'INSERT INTO terminalstatus (status, hbtime) VALUES (?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($terminalstatu->status);
		$sqlQuery->set($terminalstatu->hbtime);

		$id = $this->executeInsert($sqlQuery);	
		$terminalstatu->mac = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param TerminalstatusMySql terminalstatu
 	 */
	public function update($terminalstatu){
		$sql = 'UPDATE terminalstatus SET status = ?, hbtime = ? WHERE mac = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($terminalstatu->status);
		$sqlQuery->set($terminalstatu->hbtime);

		$sqlQuery->set($terminalstatu->mac);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM terminalstatus';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryByStatus($value){
		$sql = 'SELECT * FROM terminalstatus WHERE status = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByHbtime($value){
		$sql = 'SELECT * FROM terminalstatus WHERE hbtime = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByStatus($value){
		$sql = 'DELETE FROM terminalstatus WHERE status = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByHbtime($value){
		$sql = 'DELETE FROM terminalstatus WHERE hbtime = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return TerminalstatusMySql 
	 */
	protected function readRow($row){
		$terminalstatu = new Terminalstatu();
		
		$terminalstatu->mac = $row['mac'];
		$terminalstatu->status = $row['status'];
		$terminalstatu->hbtime = $row['hbtime'];

		return $terminalstatu;
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
	 * @return TerminalstatusMySql 
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