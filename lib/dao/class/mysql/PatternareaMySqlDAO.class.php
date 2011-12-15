<?php
/**
 * Class that operate on table 'patternarea'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2011-12-15 02:58
 */
class PatternareaMySqlDAO implements PatternareaDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return PatternareaMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM patternarea WHERE areaid = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM patternarea';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM patternarea ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param patternarea primary key
 	 */
	public function delete($areaid){
		$sql = 'DELETE FROM patternarea WHERE areaid = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($areaid);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param PatternareaMySql patternarea
 	 */
	public function insert($patternarea){
		$sql = 'INSERT INTO patternarea (areatype, patternid, width, height, layer, xcoordinate, ycoordinate, transparency) VALUES (?, ?, ?, ?, ?, ?, ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($patternarea->areatype);
		$sqlQuery->setNumber($patternarea->patternid);
		$sqlQuery->set($patternarea->width);
		$sqlQuery->set($patternarea->height);
		$sqlQuery->setNumber($patternarea->layer);
		$sqlQuery->setNumber($patternarea->xcoordinate);
		$sqlQuery->setNumber($patternarea->ycoordinate);
		$sqlQuery->setNumber($patternarea->transparency);

		$id = $this->executeInsert($sqlQuery);	
		$patternarea->areaid = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param PatternareaMySql patternarea
 	 */
	public function update($patternarea){
		$sql = 'UPDATE patternarea SET areatype = ?, patternid = ?, width = ?, height = ?, layer = ?, xcoordinate = ?, ycoordinate = ?, transparency = ? WHERE areaid = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($patternarea->areatype);
		$sqlQuery->setNumber($patternarea->patternid);
		$sqlQuery->set($patternarea->width);
		$sqlQuery->set($patternarea->height);
		$sqlQuery->setNumber($patternarea->layer);
		$sqlQuery->setNumber($patternarea->xcoordinate);
		$sqlQuery->setNumber($patternarea->ycoordinate);
		$sqlQuery->setNumber($patternarea->transparency);

		$sqlQuery->setNumber($patternarea->areaid);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM patternarea';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryByAreatype($value){
		$sql = 'SELECT * FROM patternarea WHERE areatype = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByPatternid($value){
		$sql = 'SELECT * FROM patternarea WHERE patternid = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryByWidth($value){
		$sql = 'SELECT * FROM patternarea WHERE width = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByHeight($value){
		$sql = 'SELECT * FROM patternarea WHERE height = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByLayer($value){
		$sql = 'SELECT * FROM patternarea WHERE layer = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryByXcoordinate($value){
		$sql = 'SELECT * FROM patternarea WHERE xcoordinate = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryByYcoordinate($value){
		$sql = 'SELECT * FROM patternarea WHERE ycoordinate = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryByTransparency($value){
		$sql = 'SELECT * FROM patternarea WHERE transparency = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByAreatype($value){
		$sql = 'DELETE FROM patternarea WHERE areatype = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByPatternid($value){
		$sql = 'DELETE FROM patternarea WHERE patternid = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByWidth($value){
		$sql = 'DELETE FROM patternarea WHERE width = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByHeight($value){
		$sql = 'DELETE FROM patternarea WHERE height = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByLayer($value){
		$sql = 'DELETE FROM patternarea WHERE layer = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByXcoordinate($value){
		$sql = 'DELETE FROM patternarea WHERE xcoordinate = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByYcoordinate($value){
		$sql = 'DELETE FROM patternarea WHERE ycoordinate = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByTransparency($value){
		$sql = 'DELETE FROM patternarea WHERE transparency = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return PatternareaMySql 
	 */
	protected function readRow($row){
		$patternarea = new Patternarea();
		
		$patternarea->areaid = $row['areaid'];
		$patternarea->areatype = $row['areatype'];
		$patternarea->patternid = $row['patternid'];
		$patternarea->width = $row['width'];
		$patternarea->height = $row['height'];
		$patternarea->layer = $row['layer'];
		$patternarea->xcoordinate = $row['xcoordinate'];
		$patternarea->ycoordinate = $row['ycoordinate'];
		$patternarea->transparency = $row['transparency'];

		return $patternarea;
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
	 * @return PatternareaMySql 
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