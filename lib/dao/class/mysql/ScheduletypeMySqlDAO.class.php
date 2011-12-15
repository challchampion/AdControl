<?php
/**
 * Class that operate on table 'scheduletype'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2011-12-15 02:58
 */
class ScheduletypeMySqlDAO implements ScheduletypeDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return ScheduletypeMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM scheduletype WHERE scheduletypeid = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM scheduletype';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM scheduletype ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param scheduletype primary key
 	 */
	public function delete($scheduletypeid){
		$sql = 'DELETE FROM scheduletype WHERE scheduletypeid = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($scheduletypeid);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param ScheduletypeMySql scheduletype
 	 */
	public function insert($scheduletype){
		$sql = 'INSERT INTO scheduletype (name) VALUES (?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($scheduletype->name);

		$id = $this->executeInsert($sqlQuery);	
		$scheduletype->scheduletypeid = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param ScheduletypeMySql scheduletype
 	 */
	public function update($scheduletype){
		$sql = 'UPDATE scheduletype SET name = ? WHERE scheduletypeid = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($scheduletype->name);

		$sqlQuery->setNumber($scheduletype->scheduletypeid);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM scheduletype';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryByName($value){
		$sql = 'SELECT * FROM scheduletype WHERE name = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByName($value){
		$sql = 'DELETE FROM scheduletype WHERE name = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return ScheduletypeMySql 
	 */
	protected function readRow($row){
		$scheduletype = new Scheduletype();
		
		$scheduletype->scheduletypeid = $row['scheduletypeid'];
		$scheduletype->name = $row['name'];

		return $scheduletype;
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
	 * @return ScheduletypeMySql 
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