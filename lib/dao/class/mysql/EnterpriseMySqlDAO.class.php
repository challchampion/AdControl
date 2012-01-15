<?php
/**
 * Class that operate on table 'enterprise'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2011-12-29 14:21
 */
class EnterpriseMySqlDAO implements EnterpriseDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return EnterpriseMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM enterprise WHERE enterprisename = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM enterprise';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM enterprise ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param enterprise primary key
 	 */
	public function delete($enterprisename){
		$sql = 'DELETE FROM enterprise WHERE enterprisename = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($enterprisename);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param EnterpriseMySql enterprise
 	 */
	public function insert($enterprise){
		$sql = 'INSERT INTO enterprise (level) VALUES (?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($enterprise->level);

		$id = $this->executeInsert($sqlQuery);	
		$enterprise->enterprisename = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param EnterpriseMySql enterprise
 	 */
	public function update($enterprise){
		$sql = 'UPDATE enterprise SET level = ? WHERE enterprisename = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($enterprise->level);

		$sqlQuery->set($enterprise->enterprisename);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM enterprise';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryByLevel($value){
		$sql = 'SELECT * FROM enterprise WHERE level = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByLevel($value){
		$sql = 'DELETE FROM enterprise WHERE level = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return EnterpriseMySql 
	 */
	protected function readRow($row){
		$enterprise = new Enterprise();
		
		$enterprise->enterprisename = $row['enterprisename'];
		$enterprise->level = $row['level'];

		return $enterprise;
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
	 * @return EnterpriseMySql 
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