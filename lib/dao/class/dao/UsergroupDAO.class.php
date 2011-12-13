<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2011-12-13 09:00
 */
interface UsergroupDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return Usergroup 
	 */
	public function load($id);

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
 	 * @param usergroup primary key
 	 */
	public function delete($usergroupid);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param Usergroup usergroup
 	 */
	public function insert($usergroup);
	
	/**
 	 * Update record in table
 	 *
 	 * @param Usergroup usergroup
 	 */
	public function update($usergroup);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByUsergroupname($value);

	public function queryByGroupAuthority($value);


	public function deleteByUsergroupname($value);

	public function deleteByGroupAuthority($value);


}
?>