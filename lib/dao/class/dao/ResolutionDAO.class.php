<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2011-12-15 02:58
 */
interface ResolutionDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return Resolution 
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
 	 * @param resolution primary key
 	 */
	public function delete($resolutionid);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param Resolution resolution
 	 */
	public function insert($resolution);
	
	/**
 	 * Update record in table
 	 *
 	 * @param Resolution resolution
 	 */
	public function update($resolution);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByName($value);


	public function deleteByName($value);


}
?>