<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2011-12-13 09:00
 */
interface PlaylistitemDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return Playlistitem 
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
 	 * @param playlistitem primary key
 	 */
	public function delete($itemid);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param Playlistitem playlistitem
 	 */
	public function insert($playlistitem);
	
	/**
 	 * Update record in table
 	 *
 	 * @param Playlistitem playlistitem
 	 */
	public function update($playlistitem);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByAreaid($value);

	public function queryByMediaid($value);

	public function queryByPlaylistid($value);


	public function deleteByAreaid($value);

	public function deleteByMediaid($value);

	public function deleteByPlaylistid($value);


}
?>