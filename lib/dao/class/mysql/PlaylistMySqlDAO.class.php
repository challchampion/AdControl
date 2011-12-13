<?php
/**
 * Class that operate on table 'playlist'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2011-12-13 09:00
 */
class PlaylistMySqlDAO implements PlaylistDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return PlaylistMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM playlist WHERE playlistid = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM playlist';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM playlist ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param playlist primary key
 	 */
	public function delete($playlistid){
		$sql = 'DELETE FROM playlist WHERE playlistid = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($playlistid);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param PlaylistMySql playlist
 	 */
	public function insert($playlist){
		$sql = 'INSERT INTO playlist (name, patternid, userid) VALUES (?, ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($playlist->name);
		$sqlQuery->setNumber($playlist->patternid);
		$sqlQuery->setNumber($playlist->userid);

		$id = $this->executeInsert($sqlQuery);	
		$playlist->playlistid = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param PlaylistMySql playlist
 	 */
	public function update($playlist){
		$sql = 'UPDATE playlist SET name = ?, patternid = ?, userid = ? WHERE playlistid = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($playlist->name);
		$sqlQuery->setNumber($playlist->patternid);
		$sqlQuery->setNumber($playlist->userid);

		$sqlQuery->setNumber($playlist->playlistid);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM playlist';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryByName($value){
		$sql = 'SELECT * FROM playlist WHERE name = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByPatternid($value){
		$sql = 'SELECT * FROM playlist WHERE patternid = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryByUserid($value){
		$sql = 'SELECT * FROM playlist WHERE userid = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByName($value){
		$sql = 'DELETE FROM playlist WHERE name = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByPatternid($value){
		$sql = 'DELETE FROM playlist WHERE patternid = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByUserid($value){
		$sql = 'DELETE FROM playlist WHERE userid = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return PlaylistMySql 
	 */
	protected function readRow($row){
		$playlist = new Playlist();
		
		$playlist->playlistid = $row['playlistid'];
		$playlist->name = $row['name'];
		$playlist->patternid = $row['patternid'];
		$playlist->userid = $row['userid'];

		return $playlist;
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
	 * @return PlaylistMySql 
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