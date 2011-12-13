<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2011-12-13 09:00
 */
interface MediacategoryDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return Mediacategory 
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
 	 * @param mediacategory primary key
 	 */
	public function delete($categoryid);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param Mediacategory mediacategory
 	 */
	public function insert($mediacategory);
	
	/**
 	 * Update record in table
 	 *
 	 * @param Mediacategory mediacategory
 	 */
	public function update($mediacategory);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByName($value);


	public function deleteByName($value);


}
?>