<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2011-12-15 02:58
 */
interface PatternareaDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return Patternarea 
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
 	 * @param patternarea primary key
 	 */
	public function delete($areaid);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param Patternarea patternarea
 	 */
	public function insert($patternarea);
	
	/**
 	 * Update record in table
 	 *
 	 * @param Patternarea patternarea
 	 */
	public function update($patternarea);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByAreatype($value);

	public function queryByPatternid($value);

	public function queryByWidth($value);

	public function queryByHeight($value);

	public function queryByLayer($value);

	public function queryByXcoordinate($value);

	public function queryByYcoordinate($value);

	public function queryByTransparency($value);


	public function deleteByAreatype($value);

	public function deleteByPatternid($value);

	public function deleteByWidth($value);

	public function deleteByHeight($value);

	public function deleteByLayer($value);

	public function deleteByXcoordinate($value);

	public function deleteByYcoordinate($value);

	public function deleteByTransparency($value);


}
?>