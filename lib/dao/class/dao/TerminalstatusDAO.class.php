<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2011-12-29 14:21
 */
interface TerminalstatusDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return Terminalstatus 
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
 	 * @param terminalstatu primary key
 	 */
	public function delete($mac);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param Terminalstatus terminalstatu
 	 */
	public function insert($terminalstatu);
	
	/**
 	 * Update record in table
 	 *
 	 * @param Terminalstatus terminalstatu
 	 */
	public function update($terminalstatu);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByStatus($value);

	public function queryByHbtime($value);


	public function deleteByStatus($value);

	public function deleteByHbtime($value);


}
?>