<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2011-12-15 02:58
 */
interface UserDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return User 
	 */
	public function load($username);

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
 	 * @param user primary key
 	 */
	public function delete($username);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param User user
 	 */
	public function insert($user);
	
	/**
 	 * Update record in table
 	 *
 	 * @param User user
 	 */
	public function update($user);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByPasswd($value);

	public function queryByEmail($value);

	public function queryByUserstatus($value);

	public function queryByUsergroupname($value);

	public function queryByAuthority($value);


	public function deleteByPasswd($value);

	public function deleteByEmail($value);

	public function deleteByUserstatus($value);

	public function deleteByUsergroupname($value);

	public function deleteByAuthority($value);


}
?>