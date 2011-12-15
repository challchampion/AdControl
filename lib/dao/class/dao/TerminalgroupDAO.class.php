<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2011-12-15 02:58
 */
interface TerminalgroupDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return Terminalgroup 
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
 	 * @param terminalgroup primary key
 	 */
	public function delete($terminal_groupid);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param Terminalgroup terminalgroup
 	 */
	public function insert($terminalgroup);
	
	/**
 	 * Update record in table
 	 *
 	 * @param Terminalgroup terminalgroup
 	 */
	public function update($terminalgroup);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByGroupname($value);


	public function deleteByGroupname($value);


}
?>