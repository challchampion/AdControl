<?php
/**
 * Class that operate on table 'pattern'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2011-12-13 09:00
 */
class PatternMySqlDAO implements PatternDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return PatternMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM pattern WHERE patternid = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM pattern';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM pattern ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param pattern primary key
 	 */
	public function delete($patternid){
		$sql = 'DELETE FROM pattern WHERE patternid = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($patternid);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param PatternMySql pattern
 	 */
	public function insert($pattern){
		$sql = 'INSERT INTO pattern (name, categoryid, userid, resolutionid, aspectratioid, maketime) VALUES (?, ?, ?, ?, ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($pattern->name);
		$sqlQuery->setNumber($pattern->categoryid);
		$sqlQuery->setNumber($pattern->userid);
		$sqlQuery->setNumber($pattern->resolutionid);
		$sqlQuery->setNumber($pattern->aspectratioid);
		$sqlQuery->set($pattern->maketime);

		$id = $this->executeInsert($sqlQuery);	
		$pattern->patternid = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param PatternMySql pattern
 	 */
	public function update($pattern){
		$sql = 'UPDATE pattern SET name = ?, categoryid = ?, userid = ?, resolutionid = ?, aspectratioid = ?, maketime = ? WHERE patternid = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($pattern->name);
		$sqlQuery->setNumber($pattern->categoryid);
		$sqlQuery->setNumber($pattern->userid);
		$sqlQuery->setNumber($pattern->resolutionid);
		$sqlQuery->setNumber($pattern->aspectratioid);
		$sqlQuery->set($pattern->maketime);

		$sqlQuery->setNumber($pattern->patternid);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM pattern';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryByName($value){
		$sql = 'SELECT * FROM pattern WHERE name = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByCategoryid($value){
		$sql = 'SELECT * FROM pattern WHERE categoryid = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryByUserid($value){
		$sql = 'SELECT * FROM pattern WHERE userid = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryByResolutionid($value){
		$sql = 'SELECT * FROM pattern WHERE resolutionid = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryByAspectratioid($value){
		$sql = 'SELECT * FROM pattern WHERE aspectratioid = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryByMaketime($value){
		$sql = 'SELECT * FROM pattern WHERE maketime = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByName($value){
		$sql = 'DELETE FROM pattern WHERE name = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByCategoryid($value){
		$sql = 'DELETE FROM pattern WHERE categoryid = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByUserid($value){
		$sql = 'DELETE FROM pattern WHERE userid = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByResolutionid($value){
		$sql = 'DELETE FROM pattern WHERE resolutionid = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByAspectratioid($value){
		$sql = 'DELETE FROM pattern WHERE aspectratioid = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByMaketime($value){
		$sql = 'DELETE FROM pattern WHERE maketime = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return PatternMySql 
	 */
	protected function readRow($row){
		$pattern = new Pattern();
		
		$pattern->patternid = $row['patternid'];
		$pattern->name = $row['name'];
		$pattern->categoryid = $row['categoryid'];
		$pattern->userid = $row['userid'];
		$pattern->resolutionid = $row['resolutionid'];
		$pattern->aspectratioid = $row['aspectratioid'];
		$pattern->maketime = $row['maketime'];

		return $pattern;
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
	 * @return PatternMySql 
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