<?php
/**
 * Class that operate on table 'terminalinfo'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2011-12-15 02:58
 */
class TerminalinfoMySqlDAO implements TerminalinfoDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return TerminalinfoMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM terminalinfo WHERE terminalid = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM terminalinfo';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM terminalinfo ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param terminalinfo primary key
 	 */
	public function delete($terminalid){
		$sql = 'DELETE FROM terminalinfo WHERE terminalid = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($terminalid);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param TerminalinfoMySql terminalinfo
 	 */
	public function insert($terminalinfo){
		$sql = 'INSERT INTO terminalinfo (hardwareinfo, softwareinfo, weatheraddress, remark, discinfo, addressinfo, displayportid, resolutionid, aspectratioid) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($terminalinfo->hardwareinfo);
		$sqlQuery->set($terminalinfo->softwareinfo);
		$sqlQuery->set($terminalinfo->weatheraddress);
		$sqlQuery->set($terminalinfo->remark);
		$sqlQuery->set($terminalinfo->discinfo);
		$sqlQuery->set($terminalinfo->addressinfo);
		$sqlQuery->setNumber($terminalinfo->displayportid);
		$sqlQuery->setNumber($terminalinfo->resolutionid);
		$sqlQuery->setNumber($terminalinfo->aspectratioid);

		$id = $this->executeInsert($sqlQuery);	
		$terminalinfo->terminalid = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param TerminalinfoMySql terminalinfo
 	 */
	public function update($terminalinfo){
		$sql = 'UPDATE terminalinfo SET hardwareinfo = ?, softwareinfo = ?, weatheraddress = ?, remark = ?, discinfo = ?, addressinfo = ?, displayportid = ?, resolutionid = ?, aspectratioid = ? WHERE terminalid = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($terminalinfo->hardwareinfo);
		$sqlQuery->set($terminalinfo->softwareinfo);
		$sqlQuery->set($terminalinfo->weatheraddress);
		$sqlQuery->set($terminalinfo->remark);
		$sqlQuery->set($terminalinfo->discinfo);
		$sqlQuery->set($terminalinfo->addressinfo);
		$sqlQuery->setNumber($terminalinfo->displayportid);
		$sqlQuery->setNumber($terminalinfo->resolutionid);
		$sqlQuery->setNumber($terminalinfo->aspectratioid);

		$sqlQuery->setNumber($terminalinfo->terminalid);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM terminalinfo';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryByHardwareinfo($value){
		$sql = 'SELECT * FROM terminalinfo WHERE hardwareinfo = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryBySoftwareinfo($value){
		$sql = 'SELECT * FROM terminalinfo WHERE softwareinfo = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByWeatheraddress($value){
		$sql = 'SELECT * FROM terminalinfo WHERE weatheraddress = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByRemark($value){
		$sql = 'SELECT * FROM terminalinfo WHERE remark = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByDiscinfo($value){
		$sql = 'SELECT * FROM terminalinfo WHERE discinfo = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByAddressinfo($value){
		$sql = 'SELECT * FROM terminalinfo WHERE addressinfo = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByDisplayportid($value){
		$sql = 'SELECT * FROM terminalinfo WHERE displayportid = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryByResolutionid($value){
		$sql = 'SELECT * FROM terminalinfo WHERE resolutionid = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryByAspectratioid($value){
		$sql = 'SELECT * FROM terminalinfo WHERE aspectratioid = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByHardwareinfo($value){
		$sql = 'DELETE FROM terminalinfo WHERE hardwareinfo = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteBySoftwareinfo($value){
		$sql = 'DELETE FROM terminalinfo WHERE softwareinfo = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByWeatheraddress($value){
		$sql = 'DELETE FROM terminalinfo WHERE weatheraddress = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByRemark($value){
		$sql = 'DELETE FROM terminalinfo WHERE remark = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByDiscinfo($value){
		$sql = 'DELETE FROM terminalinfo WHERE discinfo = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByAddressinfo($value){
		$sql = 'DELETE FROM terminalinfo WHERE addressinfo = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByDisplayportid($value){
		$sql = 'DELETE FROM terminalinfo WHERE displayportid = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByResolutionid($value){
		$sql = 'DELETE FROM terminalinfo WHERE resolutionid = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByAspectratioid($value){
		$sql = 'DELETE FROM terminalinfo WHERE aspectratioid = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return TerminalinfoMySql 
	 */
	protected function readRow($row){
		$terminalinfo = new Terminalinfo();
		
		$terminalinfo->terminalid = $row['terminalid'];
		$terminalinfo->hardwareinfo = $row['hardwareinfo'];
		$terminalinfo->softwareinfo = $row['softwareinfo'];
		$terminalinfo->weatheraddress = $row['weatheraddress'];
		$terminalinfo->remark = $row['remark'];
		$terminalinfo->discinfo = $row['discinfo'];
		$terminalinfo->addressinfo = $row['addressinfo'];
		$terminalinfo->displayportid = $row['displayportid'];
		$terminalinfo->resolutionid = $row['resolutionid'];
		$terminalinfo->aspectratioid = $row['aspectratioid'];

		return $terminalinfo;
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
	 * @return TerminalinfoMySql 
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