<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2011-12-15 02:58
 */
interface PatternDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return Pattern 
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
 	 * @param pattern primary key
 	 */
	public function delete($patternid);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param Pattern pattern
 	 */
	public function insert($pattern);
	
	/**
 	 * Update record in table
 	 *
 	 * @param Pattern pattern
 	 */
	public function update($pattern);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByName($value);

	public function queryByCategoryid($value);

	public function queryByUsername($value);

	public function queryByResolutionid($value);

	public function queryByAspectratioid($value);

	public function queryByMaketime($value);


	public function deleteByName($value);

	public function deleteByCategoryid($value);

	public function deleteByUsername($value);

	public function deleteByResolutionid($value);

	public function deleteByAspectratioid($value);

	public function deleteByMaketime($value);


}
?>