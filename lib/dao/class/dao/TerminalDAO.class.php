<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2011-12-13 09:00
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
	public function delete($terminalid);
	
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

	public function queryByTerminalName($value);

	public function queryByTerminalType($value);

	public function queryByIp($value);

	public function queryByMac($value);

	public function queryByVolume($value);

	public function queryByTerminalStatus($value);

	public function queryByTerminalGroupid($value);

	public function queryByUserid($value);


	public function deleteByTerminalName($value);

	public function deleteByTerminalType($value);

	public function deleteByIp($value);

	public function deleteByMac($value);

	public function deleteByVolume($value);

	public function deleteByTerminalStatus($value);

	public function deleteByTerminalGroupid($value);

	public function deleteByUserid($value);


}
?>