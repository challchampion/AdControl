<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2011-12-13 09:00
 */
interface ScheduletypeDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return Scheduletype 
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
 	 * @param scheduletype primary key
 	 */
	public function delete($scheduletypeid);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param Scheduletype scheduletype
 	 */
	public function insert($scheduletype);
	
	/**
 	 * Update record in table
 	 *
 	 * @param Scheduletype scheduletype
 	 */
	public function update($scheduletype);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByName($value);


	public function deleteByName($value);


}
?>