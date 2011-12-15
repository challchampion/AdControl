<?php
/**
 * Class that operate on table 'mediainfo'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2011-12-15 02:58
 */
class MediainfoMySqlDAO implements MediainfoDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return MediainfoMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM mediainfo WHERE mediaid = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM mediainfo';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM mediainfo ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param mediainfo primary key
 	 */
	public function delete($mediaid){
		$sql = 'DELETE FROM mediainfo WHERE mediaid = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($mediaid);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param MediainfoMySql mediainfo
 	 */
	public function insert($mediainfo){
		$sql = 'INSERT INTO mediainfo (verifycomment, illustration) VALUES (?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($mediainfo->verifycomment);
		$sqlQuery->set($mediainfo->illustration);

		$id = $this->executeInsert($sqlQuery);	
		$mediainfo->mediaid = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param MediainfoMySql mediainfo
 	 */
	public function update($mediainfo){
		$sql = 'UPDATE mediainfo SET verifycomment = ?, illustration = ? WHERE mediaid = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($mediainfo->verifycomment);
		$sqlQuery->set($mediainfo->illustration);

		$sqlQuery->setNumber($mediainfo->mediaid);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM mediainfo';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryByVerifycomment($value){
		$sql = 'SELECT * FROM mediainfo WHERE verifycomment = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByIllustration($value){
		$sql = 'SELECT * FROM mediainfo WHERE illustration = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByVerifycomment($value){
		$sql = 'DELETE FROM mediainfo WHERE verifycomment = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByIllustration($value){
		$sql = 'DELETE FROM mediainfo WHERE illustration = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return MediainfoMySql 
	 */
	protected function readRow($row){
		$mediainfo = new Mediainfo();
		
		$mediainfo->mediaid = $row['mediaid'];
		$mediainfo->verifycomment = $row['verifycomment'];
		$mediainfo->illustration = $row['illustration'];

		return $mediainfo;
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
	 * @return MediainfoMySql 
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