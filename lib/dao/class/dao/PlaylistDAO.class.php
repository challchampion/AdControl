<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2011-12-13 09:00
 */
interface PlaylistDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return Playlist 
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
 	 * @param playlist primary key
 	 */
	public function delete($playlistid);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param Playlist playlist
 	 */
	public function insert($playlist);
	
	/**
 	 * Update record in table
 	 *
 	 * @param Playlist playlist
 	 */
	public function update($playlist);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByName($value);

	public function queryByPatternid($value);

	public function queryByUserid($value);


	public function deleteByName($value);

	public function deleteByPatternid($value);

	public function deleteByUserid($value);


}
?>