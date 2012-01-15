<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2011-12-29 14:21
 */
interface EnterpriseDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return Enterprise 
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
 	 * @param enterprise primary key
 	 */
	public function delete($enterprisename);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param Enterprise enterprise
 	 */
	public function insert($enterprise);
	
	/**
 	 * Update record in table
 	 *
 	 * @param Enterprise enterprise
 	 */
	public function update($enterprise);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByLevel($value);


	public function deleteByLevel($value);


}
?>