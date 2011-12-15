<?php
/**
 * Class that operate on table 'mediacategory'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2011-12-15 02:58
 */
class MediacategoryMySqlDAO implements MediacategoryDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return MediacategoryMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM mediacategory WHERE categoryid = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM mediacategory';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM mediacategory ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param mediacategory primary key
 	 */
	public function delete($categoryid){
		$sql = 'DELETE FROM mediacategory WHERE categoryid = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($categoryid);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param MediacategoryMySql mediacategory
 	 */
	public function insert($mediacategory){
		$sql = 'INSERT INTO mediacategory (name) VALUES (?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($mediacategory->name);

		$id = $this->executeInsert($sqlQuery);	
		$mediacategory->categoryid = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param MediacategoryMySql mediacategory
 	 */
	public function update($mediacategory){
		$sql = 'UPDATE mediacategory SET name = ? WHERE categoryid = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($mediacategory->name);

		$sqlQuery->setNumber($mediacategory->categoryid);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM mediacategory';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryByName($value){
		$sql = 'SELECT * FROM mediacategory WHERE name = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByName($value){
		$sql = 'DELETE FROM mediacategory WHERE name = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return MediacategoryMySql 
	 */
	protected function readRow($row){
		$mediacategory = new Mediacategory();
		
		$mediacategory->categoryid = $row['categoryid'];
		$mediacategory->name = $row['name'];

		return $mediacategory;
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
	 * @return MediacategoryMySql 
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