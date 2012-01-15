<?php
/**
 * Class that operate on table 'terminalstatus'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2011-12-26 11:17
 */
class TerminalstatusMySqlExtDAO extends TerminalstatusMySqlDAO{

	public function insertOneRecord($terminalstatus){
		$sql = 'INSERT INTO terminalstatus (mac, status, hbtime) VALUES (?, ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($terminalstatus->mac);
		$sqlQuery->set($terminalstatus->status);
		$sqlQuery->set($terminalstatus->hbtime);
		
		$id = $this->executeInsert($sqlQuery);
		$terminalstatus->mac = $id;
		return $id;
	}
	
	public function queryStatusByMac($mac){
		$sql = 'SELECT * FROM terminalstatus WHERE mac = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($id);
		$status = $this->getRow($sqlQuery);
		return $status->status;
	}
	
	public function checkHBStatus(){
		$sql = "UPDATE terminalstatus SET status = 'offline' WHERE " .
				"timestamp('" . date("Y-m-d H:i:s", time()-60) . "') > hbtime AND status = 'online'";
	
		$sqlQuery = new SqlQuery($sql);
	
		return $this->executeUpdate($sqlQuery);
	}
	
}
?>