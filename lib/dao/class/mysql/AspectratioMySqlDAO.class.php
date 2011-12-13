<?php
/**
 * Class that operate on table 'aspectratio'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2011-12-13 09:00
 */
class AspectratioMySqlDAO implements AspectratioDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return AspectratioMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM aspectratio WHERE aspectratioid = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM aspectratio';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM aspectratio ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param aspectratio primary key
 	 */
	public function delete($aspectratioid){
		$sql = 'DELETE FROM aspectratio WHERE aspectratioid = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($aspectratioid);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param AspectratioMySql aspectratio
 	 */
	public function insert($aspectratio){
		$sql = 'INSERT INTO aspectratio (name) VALUES (?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($aspectratio->name);

		$id = $this->executeInsert($sqlQuery);	
		$aspectratio->aspectratioid = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param AspectratioMySql aspectratio
 	 */
	public function update($aspectratio){
		$sql = 'UPDATE aspectratio SET name = ? WHERE aspectratioid = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($aspectratio->name);

		$sqlQuery->setNumber($aspectratio->aspectratioid);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM aspectratio';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryByName($value){
		$sql = 'SELECT * FROM aspectratio WHERE name = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByName($value){
		$sql = 'DELETE FROM aspectratio WHERE name = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return AspectratioMySql 
	 */
	protected function readRow($row){
		$aspectratio = new Aspectratio();
		
		$aspectratio->aspectratioid = $row['aspectratioid'];
		$aspectratio->name = $row['name'];

		return $aspectratio;
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
	 * @return AspectratioMySql 
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