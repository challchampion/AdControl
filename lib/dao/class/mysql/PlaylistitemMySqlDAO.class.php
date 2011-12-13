<?php
/**
 * Class that operate on table 'playlistitem'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2011-12-13 09:00
 */
class PlaylistitemMySqlDAO implements PlaylistitemDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return PlaylistitemMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM playlistitem WHERE itemid = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM playlistitem';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM playlistitem ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param playlistitem primary key
 	 */
	public function delete($itemid){
		$sql = 'DELETE FROM playlistitem WHERE itemid = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($itemid);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param PlaylistitemMySql playlistitem
 	 */
	public function insert($playlistitem){
		$sql = 'INSERT INTO playlistitem (areaid, mediaid, playlistid) VALUES (?, ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->setNumber($playlistitem->areaid);
		$sqlQuery->setNumber($playlistitem->mediaid);
		$sqlQuery->setNumber($playlistitem->playlistid);

		$id = $this->executeInsert($sqlQuery);	
		$playlistitem->itemid = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param PlaylistitemMySql playlistitem
 	 */
	public function update($playlistitem){
		$sql = 'UPDATE playlistitem SET areaid = ?, mediaid = ?, playlistid = ? WHERE itemid = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->setNumber($playlistitem->areaid);
		$sqlQuery->setNumber($playlistitem->mediaid);
		$sqlQuery->setNumber($playlistitem->playlistid);

		$sqlQuery->setNumber($playlistitem->itemid);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM playlistitem';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryByAreaid($value){
		$sql = 'SELECT * FROM playlistitem WHERE areaid = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryByMediaid($value){
		$sql = 'SELECT * FROM playlistitem WHERE mediaid = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryByPlaylistid($value){
		$sql = 'SELECT * FROM playlistitem WHERE playlistid = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByAreaid($value){
		$sql = 'DELETE FROM playlistitem WHERE areaid = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByMediaid($value){
		$sql = 'DELETE FROM playlistitem WHERE mediaid = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByPlaylistid($value){
		$sql = 'DELETE FROM playlistitem WHERE playlistid = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return PlaylistitemMySql 
	 */
	protected function readRow($row){
		$playlistitem = new Playlistitem();
		
		$playlistitem->itemid = $row['itemid'];
		$playlistitem->areaid = $row['areaid'];
		$playlistitem->mediaid = $row['mediaid'];
		$playlistitem->playlistid = $row['playlistid'];

		return $playlistitem;
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
	 * @return PlaylistitemMySql 
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