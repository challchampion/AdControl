<?php
/**
 * Class that operate on table 'user_tgroup'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2011-12-29 14:21
 */
class UserTgroupMySqlDAO implements UserTgroupDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return UserTgroupMySql 
	 */
	public function load($userid, $groupid){
		$sql = 'SELECT * FROM user_tgroup WHERE userid = ?  AND groupid = ? ';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($userid);
		$sqlQuery->setNumber($groupid);

		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM user_tgroup';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM user_tgroup ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param userTgroup primary key
 	 */
	public function delete($userid, $groupid){
		$sql = 'DELETE FROM user_tgroup WHERE userid = ?  AND groupid = ? ';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($userid);
		$sqlQuery->setNumber($groupid);

		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param UserTgroupMySql userTgroup
 	 */
	public function insert($userTgroup){
		$sql = 'INSERT INTO user_tgroup ( userid, groupid) VALUES ( ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		

		
		$sqlQuery->setNumber($userTgroup->userid);

		$sqlQuery->setNumber($userTgroup->groupid);

		$this->executeInsert($sqlQuery);	
		//$userTgroup->id = $id;
		//return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param UserTgroupMySql userTgroup
 	 */
	public function update($userTgroup){
		$sql = 'UPDATE user_tgroup SET  WHERE userid = ?  AND groupid = ? ';
		$sqlQuery = new SqlQuery($sql);
		

		
		$sqlQuery->setNumber($userTgroup->userid);

		$sqlQuery->setNumber($userTgroup->groupid);

		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM user_tgroup';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}



	
	/**
	 * Read row
	 *
	 * @return UserTgroupMySql 
	 */
	protected function readRow($row){
		$userTgroup = new UserTgroup();
		
		$userTgroup->userid = $row['userid'];
		$userTgroup->groupid = $row['groupid'];

		return $userTgroup;
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
	 * @return UserTgroupMySql 
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