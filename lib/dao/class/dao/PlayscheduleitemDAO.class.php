<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2011-12-15 02:58
 */
interface PlayscheduleitemDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return Playscheduleitem 
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
 	 * @param playscheduleitem primary key
 	 */
	public function delete($scheduleitemid);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param Playscheduleitem playscheduleitem
 	 */
	public function insert($playscheduleitem);
	
	/**
 	 * Update record in table
 	 *
 	 * @param Playscheduleitem playscheduleitem
 	 */
	public function update($playscheduleitem);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByPlaylistid($value);

	public function queryByStarttime($value);

	public function queryByEndtime($value);

	public function queryByPlaytimes($value);

	public function queryByPlayscheduleid($value);


	public function deleteByPlaylistid($value);

	public function deleteByStarttime($value);

	public function deleteByEndtime($value);

	public function deleteByPlaytimes($value);

	public function deleteByPlayscheduleid($value);


}
?>