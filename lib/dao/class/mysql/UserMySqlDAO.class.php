<?php
/**
 * Class that operate on table 'user'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2011-12-15 02:58
 */
class UserMySqlDAO implements UserDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return UserMySql 
	 */
	public function load($username){
		$sql = 'SELECT * FROM user WHERE username = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($username);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM user';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM user ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param user primary key
 	 */
	public function delete($username){
		$sql = 'DELETE FROM user WHERE username = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($username);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param UserMySql user
 	 */
	public function insert($user){
		$sql = 'INSERT INTO user (passwd, email, userstatus, usergroupname, authority) VALUES (?, ?, ?, ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($user->passwd);
		$sqlQuery->set($user->email);
		$sqlQuery->set($user->userstatus);
		$sqlQuery->set($user->usergroupname);
		$sqlQuery->set($user->authority);

		$id = $this->executeInsert($sqlQuery);	
		$user->username = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param UserMySql user
 	 */
	public function update($user){
		$sql = 'UPDATE user SET passwd = ?, email = ?, userstatus = ?, usergroupname = ?, authority = ? WHERE username = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($user->passwd);
		$sqlQuery->set($user->email);
		$sqlQuery->set($user->userstatus);
		$sqlQuery->set($user->usergroupname);
		$sqlQuery->set($user->authority);

		$sqlQuery->set($user->username);
		return $this->executeUpdate($sqlQuery);
	}
	
	public function updatePasswd($user){
		$sql = 'UPDATE user SET passwd = ? WHERE username = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($user->passwd);
		$sqlQuery->set($user->username);
		return $this->executeUpdate($sqlQuery);
	}
	
	public function updateUsergroup($user){
		$sql = 'UPDATE user SET usergroupname = ? WHERE username = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($user->usergroupname);
		$sqlQuery->set($user->username);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM user';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryByPasswd($value){
		$sql = 'SELECT * FROM user WHERE passwd = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByEmail($value){
		$sql = 'SELECT * FROM user WHERE email = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByUserstatus($value){
		$sql = 'SELECT * FROM user WHERE userstatus = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByUsergroupname($value){
		$sql = 'SELECT * FROM user WHERE usergroupname = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByAuthority($value){
		$sql = 'SELECT * FROM user WHERE authority = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByPasswd($value){
		$sql = 'DELETE FROM user WHERE passwd = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByEmail($value){
		$sql = 'DELETE FROM user WHERE email = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByUserstatus($value){
		$sql = 'DELETE FROM user WHERE userstatus = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByUsergroupname($value){
		$sql = 'DELETE FROM user WHERE usergroupname = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByAuthority($value){
		$sql = 'DELETE FROM user WHERE authority = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return UserMySql 
	 */
	protected function readRow($row){
		$user = new User();
		
		$user->username = $row['username'];
		$user->passwd = $row['passwd'];
		$user->email = $row['email'];
		$user->userstatus = $row['userstatus'];
		$user->usergroupname = $row['usergroupname'];
		$user->authority = $row['authority'];

		return $user;
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
	 * @return UserMySql 
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