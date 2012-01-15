<?php
/**
 * Class that operate on table 'command'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2011-12-29 14:21
 */
class CommandMySqlDAO implements CommandDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return CommandMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM command WHERE id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM command';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM command ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param command primary key
 	 */
	public function delete($id){
		$sql = 'DELETE FROM command WHERE id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param CommandMySql command
 	 */
	public function insert($command){
		$sql = 'INSERT INTO command (sendtype, mac, groupid, command, commandtime) VALUES (?, ?, ?, ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($command->sendtype);
		$sqlQuery->set($command->mac);
		$sqlQuery->setNumber($command->groupid);
		$sqlQuery->set($command->command);
		$sqlQuery->set($command->commandtime);

		$id = $this->executeInsert($sqlQuery);	
		$command->id = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param CommandMySql command
 	 */
	public function update($command){
		$sql = 'UPDATE command SET sendtype = ?, mac = ?, groupid = ?, command = ?, commandtime = ? WHERE id = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($command->sendtype);
		$sqlQuery->set($command->mac);
		$sqlQuery->setNumber($command->groupid);
		$sqlQuery->set($command->command);
		$sqlQuery->set($command->commandtime);

		$sqlQuery->setNumber($command->id);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM command';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryBySendtype($value){
		$sql = 'SELECT * FROM command WHERE sendtype = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByMac($value){
		$sql = 'SELECT * FROM command WHERE mac = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByGroupid($value){
		$sql = 'SELECT * FROM command WHERE groupid = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryByCommand($value){
		$sql = 'SELECT * FROM command WHERE command = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByCommandtime($value){
		$sql = 'SELECT * FROM command WHERE commandtime = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}


	public function deleteBySendtype($value){
		$sql = 'DELETE FROM command WHERE sendtype = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByMac($value){
		$sql = 'DELETE FROM command WHERE mac = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByGroupid($value){
		$sql = 'DELETE FROM command WHERE groupid = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByCommand($value){
		$sql = 'DELETE FROM command WHERE command = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByCommandtime($value){
		$sql = 'DELETE FROM command WHERE commandtime = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return CommandMySql 
	 */
	protected function readRow($row){
		$command = new Command();
		
		$command->id = $row['id'];
		$command->sendtype = $row['sendtype'];
		$command->mac = $row['mac'];
		$command->groupid = $row['groupid'];
		$command->command = $row['command'];
		$command->commandtime = $row['commandtime'];

		return $command;
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
	 * @return CommandMySql 
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