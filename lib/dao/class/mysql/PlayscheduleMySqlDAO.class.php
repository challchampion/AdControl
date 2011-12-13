<?php
/**
 * Class that operate on table 'playschedule'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2011-12-13 09:00
 */
class PlayscheduleMySqlDAO implements PlayscheduleDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return PlayscheduleMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM playschedule WHERE playscheduleid = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM playschedule';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM playschedule ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param playschedule primary key
 	 */
	public function delete($playscheduleid){
		$sql = 'DELETE FROM playschedule WHERE playscheduleid = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($playscheduleid);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param PlayscheduleMySql playschedule
 	 */
	public function insert($playschedule){
		$sql = 'INSERT INTO playschedule (name, userid, scheduledate, starttime, endtime, scheduletypeid) VALUES (?, ?, ?, ?, ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($playschedule->name);
		$sqlQuery->setNumber($playschedule->userid);
		$sqlQuery->set($playschedule->scheduledate);
		$sqlQuery->set($playschedule->starttime);
		$sqlQuery->set($playschedule->endtime);
		$sqlQuery->setNumber($playschedule->scheduletypeid);

		$id = $this->executeInsert($sqlQuery);	
		$playschedule->playscheduleid = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param PlayscheduleMySql playschedule
 	 */
	public function update($playschedule){
		$sql = 'UPDATE playschedule SET name = ?, userid = ?, scheduledate = ?, starttime = ?, endtime = ?, scheduletypeid = ? WHERE playscheduleid = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($playschedule->name);
		$sqlQuery->setNumber($playschedule->userid);
		$sqlQuery->set($playschedule->scheduledate);
		$sqlQuery->set($playschedule->starttime);
		$sqlQuery->set($playschedule->endtime);
		$sqlQuery->setNumber($playschedule->scheduletypeid);

		$sqlQuery->setNumber($playschedule->playscheduleid);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM playschedule';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryByName($value){
		$sql = 'SELECT * FROM playschedule WHERE name = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByUserid($value){
		$sql = 'SELECT * FROM playschedule WHERE userid = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryByScheduledate($value){
		$sql = 'SELECT * FROM playschedule WHERE scheduledate = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByStarttime($value){
		$sql = 'SELECT * FROM playschedule WHERE starttime = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByEndtime($value){
		$sql = 'SELECT * FROM playschedule WHERE endtime = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByScheduletypeid($value){
		$sql = 'SELECT * FROM playschedule WHERE scheduletypeid = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByName($value){
		$sql = 'DELETE FROM playschedule WHERE name = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByUserid($value){
		$sql = 'DELETE FROM playschedule WHERE userid = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByScheduledate($value){
		$sql = 'DELETE FROM playschedule WHERE scheduledate = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByStarttime($value){
		$sql = 'DELETE FROM playschedule WHERE starttime = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByEndtime($value){
		$sql = 'DELETE FROM playschedule WHERE endtime = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByScheduletypeid($value){
		$sql = 'DELETE FROM playschedule WHERE scheduletypeid = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return PlayscheduleMySql 
	 */
	protected function readRow($row){
		$playschedule = new Playschedule();
		
		$playschedule->playscheduleid = $row['playscheduleid'];
		$playschedule->name = $row['name'];
		$playschedule->userid = $row['userid'];
		$playschedule->scheduledate = $row['scheduledate'];
		$playschedule->starttime = $row['starttime'];
		$playschedule->endtime = $row['endtime'];
		$playschedule->scheduletypeid = $row['scheduletypeid'];

		return $playschedule;
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
	 * @return PlayscheduleMySql 
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