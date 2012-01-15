<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2011-12-29 14:21
 */
interface UserTgroupDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return UserTgroup 
	 */
	public function load($userid, $groupid);

	/**
	 * Get all records from table
	 */
	public function queryAll();
	
	/**
	 * Get all records from table ordered by field
	 * @Param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn);
	
	/**
 	 * Delete record from table
 	 * @param userTgroup primary key
 	 */
	public function delete($userid, $groupid);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param UserTgroup userTgroup
 	 */
	public function insert($userTgroup);
	
	/**
 	 * Update record in table
 	 *
 	 * @param UserTgroup userTgroup
 	 */
	public function update($userTgroup);	

	/**
	 * Delete all rows
	 */
	public function clean();



}
?>