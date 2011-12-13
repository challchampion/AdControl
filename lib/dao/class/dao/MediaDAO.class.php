<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2011-12-13 09:00
 */
interface MediaDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return Media 
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
 	 * @param media primary key
 	 */
	public function delete($mediaid);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param Media media
 	 */
	public function insert($media);
	
	/**
 	 * Update record in table
 	 *
 	 * @param Media media
 	 */
	public function update($media);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByCategoryid($value);

	public function queryByMediapath($value);

	public function queryByMediastatus($value);

	public function queryByMediasize($value);

	public function queryByUploadtime($value);

	public function queryByUserid($value);


	public function deleteByCategoryid($value);

	public function deleteByMediapath($value);

	public function deleteByMediastatus($value);

	public function deleteByMediasize($value);

	public function deleteByUploadtime($value);

	public function deleteByUserid($value);


}
?>