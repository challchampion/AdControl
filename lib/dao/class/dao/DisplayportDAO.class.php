<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2011-12-15 02:58
 */
interface DisplayportDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return Displayport 
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
 	 * @param displayport primary key
 	 */
	public function delete($displayportid);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param Displayport displayport
 	 */
	public function insert($displayport);
	
	/**
 	 * Update record in table
 	 *
 	 * @param Displayport displayport
 	 */
	public function update($displayport);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByName($value);


	public function deleteByName($value);


}
?>