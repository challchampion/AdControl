<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2011-12-13 09:00
 */
interface MediainfoDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return Mediainfo 
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
 	 * @param mediainfo primary key
 	 */
	public function delete($mediaid);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param Mediainfo mediainfo
 	 */
	public function insert($mediainfo);
	
	/**
 	 * Update record in table
 	 *
 	 * @param Mediainfo mediainfo
 	 */
	public function update($mediainfo);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByVerifycomment($value);

	public function queryByIllustration($value);


	public function deleteByVerifycomment($value);

	public function deleteByIllustration($value);


}
?>