<?php
/**
 * Class that operate on table 'command'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2011-12-26 11:17
 */
class CommandMySqlExtDAO extends CommandMySqlDAO{

	public function getOldestCmd($mac, $groupid){
		$sql = "SELECT id, command FROM command WHERE (mac = ? AND sendtype = '0') OR (groupid = ? AND sendtype = '1') ORDER BY commandtime ASC LIMIT 1";
	
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($mac);
		$sqlQuery->set($groupid);
	
		$tab = QueryExecutor::execute($sqlQuery);
	
		$ret = "";
		if(count($tab) == 1){
			$this->delete($tab[0]['id']);
			$ret = $tab[0]['command'];
		}
	
		return $ret;
	}
	
}
?>