<?php
/**
 * Class that operate on table 'playscheduleitem'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2011-12-15 02:58
 */
class PlayscheduleitemMySqlDAO implements PlayscheduleitemDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return PlayscheduleitemMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM playscheduleitem WHERE scheduleitemid = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM playscheduleitem';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM playscheduleitem ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param playscheduleitem primary key
 	 */
	public function delete($scheduleitemid){
		$sql = 'DELETE FROM playscheduleitem WHERE scheduleitemid = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($scheduleitemid);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param PlayscheduleitemMySql playscheduleitem
 	 */
	public function insert($playscheduleitem){
		$sql = 'INSERT INTO playscheduleitem (playlistid, starttime, endtime, playtimes, playscheduleid) VALUES (?, ?, ?, ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->setNumber($playscheduleitem->playlistid);
		$sqlQuery->set($playscheduleitem->starttime);
		$sqlQuery->set($playscheduleitem->endtime);
		$sqlQuery->setNumber($playscheduleitem->playtimes);
		$sqlQuery->setNumber($playscheduleitem->playscheduleid);

		$id = $this->executeInsert($sqlQuery);	
		$playscheduleitem->scheduleitemid = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param PlayscheduleitemMySql playscheduleitem
 	 */
	public function update($playscheduleitem){
		$sql = 'UPDATE playscheduleitem SET playlistid = ?, starttime = ?, endtime = ?, playtimes = ?, playscheduleid = ? WHERE scheduleitemid = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->setNumber($playscheduleitem->playlistid);
		$sqlQuery->set($playscheduleitem->starttime);
		$sqlQuery->set($playscheduleitem->endtime);
		$sqlQuery->setNumber($playscheduleitem->playtimes);
		$sqlQuery->setNumber($playscheduleitem->playscheduleid);

		$sqlQuery->setNumber($playscheduleitem->scheduleitemid);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM playscheduleitem';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryByPlaylistid($value){
		$sql = 'SELECT * FROM playscheduleitem WHERE playlistid = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryByStarttime($value){
		$sql = 'SELECT * FROM playscheduleitem WHERE starttime = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByEndtime($value){
		$sql = 'SELECT * FROM playscheduleitem WHERE endtime = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByPlaytimes($value){
		$sql = 'SELECT * FROM playscheduleitem WHERE playtimes = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryByPlayscheduleid($value){
		$sql = 'SELECT * FROM playscheduleitem WHERE playscheduleid = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByPlaylistid($value){
		$sql = 'DELETE FROM playscheduleitem WHERE playlistid = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByStarttime($value){
		$sql = 'DELETE FROM playscheduleitem WHERE starttime = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByEndtime($value){
		$sql = 'DELETE FROM playscheduleitem WHERE endtime = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByPlaytimes($value){
		$sql = 'DELETE FROM playscheduleitem WHERE playtimes = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByPlayscheduleid($value){
		$sql = 'DELETE FROM playscheduleitem WHERE playscheduleid = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return PlayscheduleitemMySql 
	 */
	protected function readRow($row){
		$playscheduleitem = new Playscheduleitem();
		
		$playscheduleitem->scheduleitemid = $row['scheduleitemid'];
		$playscheduleitem->playlistid = $row['playlistid'];
		$playscheduleitem->starttime = $row['starttime'];
		$playscheduleitem->endtime = $row['endtime'];
		$playscheduleitem->playtimes = $row['playtimes'];
		$playscheduleitem->playscheduleid = $row['playscheduleid'];

		return $playscheduleitem;
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
	 * @return PlayscheduleitemMySql 
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