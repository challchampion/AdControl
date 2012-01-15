<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2011-12-29 14:21
 */
interface CommandDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return Command 
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
 	 * @param command primary key
 	 */
	public function delete($id);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param Command command
 	 */
	public function insert($command);
	
	/**
 	 * Update record in table
 	 *
 	 * @param Command command
 	 */
	public function update($command);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryBySendtype($value);

	public function queryByMac($value);

	public function queryByGroupid($value);

	public function queryByCommand($value);

	public function queryByCommandtime($value);


	public function deleteBySendtype($value);

	public function deleteByMac($value);

	public function deleteByGroupid($value);

	public function deleteByCommand($value);

	public function deleteByCommandtime($value);


}
?>