<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2011-12-29 14:21
 */
interface TerminalDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return Terminal 
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
 	 * @param terminal primary key
 	 */
	public function delete($mac);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param Terminal terminal
 	 */
	public function insert($terminal);
	
	/**
 	 * Update record in table
 	 *
 	 * @param Terminal terminal
 	 */
	public function update($terminal);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByGroupid($value);

	public function queryByIp($value);

	public function queryByTerminalname($value);

	public function queryByDiscinfo($value);

	public function queryByAddress($value);

	public function queryByTerminaltype($value);

	public function queryByVersion($value);


	public function deleteByGroupid($value);

	public function deleteByIp($value);

	public function deleteByTerminalname($value);

	public function deleteByDiscinfo($value);

	public function deleteByAddress($value);

	public function deleteByTerminaltype($value);

	public function deleteByVersion($value);


}
?>