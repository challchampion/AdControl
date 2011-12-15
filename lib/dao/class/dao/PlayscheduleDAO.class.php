<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2011-12-15 02:58
 */
interface PlayscheduleDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return Playschedule 
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
 	 * @param playschedule primary key
 	 */
	public function delete($playscheduleid);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param Playschedule playschedule
 	 */
	public function insert($playschedule);
	
	/**
 	 * Update record in table
 	 *
 	 * @param Playschedule playschedule
 	 */
	public function update($playschedule);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByName($value);

	public function queryByUsername($value);

	public function queryByScheduledate($value);

	public function queryByStarttime($value);

	public function queryByEndtime($value);

	public function queryByScheduletypeid($value);


	public function deleteByName($value);

	public function deleteByUsername($value);

	public function deleteByScheduledate($value);

	public function deleteByStarttime($value);

	public function deleteByEndtime($value);

	public function deleteByScheduletypeid($value);


}
?>