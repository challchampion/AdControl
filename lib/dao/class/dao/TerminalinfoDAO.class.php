<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2011-12-13 09:00
 */
interface TerminalinfoDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return Terminalinfo 
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
 	 * @param terminalinfo primary key
 	 */
	public function delete($terminalid);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param Terminalinfo terminalinfo
 	 */
	public function insert($terminalinfo);
	
	/**
 	 * Update record in table
 	 *
 	 * @param Terminalinfo terminalinfo
 	 */
	public function update($terminalinfo);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByHardwareinfo($value);

	public function queryBySoftwareinfo($value);

	public function queryByWeatheraddress($value);

	public function queryByRemark($value);

	public function queryByDiscinfo($value);

	public function queryByAddressinfo($value);

	public function queryByDisplayportid($value);

	public function queryByResolutionid($value);

	public function queryByAspectratioid($value);


	public function deleteByHardwareinfo($value);

	public function deleteBySoftwareinfo($value);

	public function deleteByWeatheraddress($value);

	public function deleteByRemark($value);

	public function deleteByDiscinfo($value);

	public function deleteByAddressinfo($value);

	public function deleteByDisplayportid($value);

	public function deleteByResolutionid($value);

	public function deleteByAspectratioid($value);


}
?>