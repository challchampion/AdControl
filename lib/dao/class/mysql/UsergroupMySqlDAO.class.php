<?php
/**
 * Class that operate on table 'usergroup'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2011-12-13 09:00
 */
class UsergroupMySqlDAO implements UsergroupDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return UsergroupMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM usergroup WHERE usergroupid = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM usergroup';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM usergroup ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param usergroup primary key
 	 */
	public function delete($usergroupid){
		$sql = 'DELETE FROM usergroup WHERE usergroupid = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($usergroupid);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param UsergroupMySql usergroup
 	 */
	public function insert($usergroup){
		$sql = 'INSERT INTO usergroup (usergroupname, group_authority) VALUES (?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($usergroup->usergroupname);
		$sqlQuery->set($usergroup->groupAuthority);

		$id = $this->executeInsert($sqlQuery);	
		$usergroup->usergroupid = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param UsergroupMySql usergroup
 	 */
	public function update($usergroup){
		$sql = 'UPDATE usergroup SET usergroupname = ?, group_authority = ? WHERE usergroupid = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($usergroup->usergroupname);
		$sqlQuery->set($usergroup->groupAuthority);

		$sqlQuery->setNumber($usergroup->usergroupid);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM usergroup';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryByUsergroupname($value){
		$sql = 'SELECT * FROM usergroup WHERE usergroupname = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByGroupAuthority($value){
		$sql = 'SELECT * FROM usergroup WHERE group_authority = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByUsergroupname($value){
		$sql = 'DELETE FROM usergroup WHERE usergroupname = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByGroupAuthority($value){
		$sql = 'DELETE FROM usergroup WHERE group_authority = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return UsergroupMySql 
	 */
	protected function readRow($row){
		$usergroup = new Usergroup();
		
		$usergroup->usergroupid = $row['usergroupid'];
		$usergroup->usergroupname = $row['usergroupname'];
		$usergroup->groupAuthority = $row['group_authority'];

		return $usergroup;
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
	 * @return UsergroupMySql 
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