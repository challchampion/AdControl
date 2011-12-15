<?php
/**
 * Class that operate on table 'media'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2011-12-15 02:58
 */
class MediaMySqlDAO implements MediaDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return MediaMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM media WHERE mediaid = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM media';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM media ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param media primary key
 	 */
	public function delete($mediaid){
		$sql = 'DELETE FROM media WHERE mediaid = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($mediaid);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param MediaMySql media
 	 */
	public function insert($media){
		$sql = 'INSERT INTO media (categoryid, mediapath, mediastatus, mediasize, uploadtime, username) VALUES (?, ?, ?, ?, ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->setNumber($media->categoryid);
		$sqlQuery->set($media->mediapath);
		$sqlQuery->set($media->mediastatus);
		$sqlQuery->setNumber($media->mediasize);
		$sqlQuery->set($media->uploadtime);
		$sqlQuery->set($media->username);

		$id = $this->executeInsert($sqlQuery);	
		$media->mediaid = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param MediaMySql media
 	 */
	public function update($media){
		$sql = 'UPDATE media SET categoryid = ?, mediapath = ?, mediastatus = ?, mediasize = ?, uploadtime = ?, username = ? WHERE mediaid = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->setNumber($media->categoryid);
		$sqlQuery->set($media->mediapath);
		$sqlQuery->set($media->mediastatus);
		$sqlQuery->setNumber($media->mediasize);
		$sqlQuery->set($media->uploadtime);
		$sqlQuery->set($media->username);

		$sqlQuery->setNumber($media->mediaid);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM media';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryByCategoryid($value){
		$sql = 'SELECT * FROM media WHERE categoryid = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryByMediapath($value){
		$sql = 'SELECT * FROM media WHERE mediapath = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByMediastatus($value){
		$sql = 'SELECT * FROM media WHERE mediastatus = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByMediasize($value){
		$sql = 'SELECT * FROM media WHERE mediasize = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryByUploadtime($value){
		$sql = 'SELECT * FROM media WHERE uploadtime = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByUsername($value){
		$sql = 'SELECT * FROM media WHERE username = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByCategoryid($value){
		$sql = 'DELETE FROM media WHERE categoryid = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByMediapath($value){
		$sql = 'DELETE FROM media WHERE mediapath = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByMediastatus($value){
		$sql = 'DELETE FROM media WHERE mediastatus = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByMediasize($value){
		$sql = 'DELETE FROM media WHERE mediasize = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByUploadtime($value){
		$sql = 'DELETE FROM media WHERE uploadtime = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByUsername($value){
		$sql = 'DELETE FROM media WHERE username = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return MediaMySql 
	 */
	protected function readRow($row){
		$media = new Media();
		
		$media->mediaid = $row['mediaid'];
		$media->categoryid = $row['categoryid'];
		$media->mediapath = $row['mediapath'];
		$media->mediastatus = $row['mediastatus'];
		$media->mediasize = $row['mediasize'];
		$media->uploadtime = $row['uploadtime'];
		$media->username = $row['username'];

		return $media;
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
	 * @return MediaMySql 
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