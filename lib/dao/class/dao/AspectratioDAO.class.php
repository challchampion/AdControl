<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2011-12-15 02:58
 */
interface AspectratioDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return Aspectratio 
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
 	 * @param aspectratio primary key
 	 */
	public function delete($aspectratioid);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param Aspectratio aspectratio
 	 */
	public function insert($aspectratio);
	
	/**
 	 * Update record in table
 	 *
 	 * @param Aspectratio aspectratio
 	 */
	public function update($aspectratio);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByName($value);


	public function deleteByName($value);


}
?>