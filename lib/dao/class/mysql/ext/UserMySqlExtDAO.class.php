<?php
/**
 * Class that operate on table 'user'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2011-12-26 11:17
 */
class UserMySqlExtDAO extends UserMySqlDAO{
	
	public function queryUser($user, $pass, $enterprise){
		$sql = 'SELECT * FROM user WHERE username = ? AND passwd = ? AND enterprisename = ?';
		
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($user);
		$sqlQuery->set(sha1($pass));
		$sqlQuery->set($enterprise);
		
		return $this->getList($sqlQuery);
	}
	
	public function queryCertainUser($username, $enterprise){
		$sql = 'SELECT * FROM user WHERE username = ? AND enterprisename = ?';
		
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($user);
		$sqlQuery->set($enterprise);
		
		return $this->getList($sqlQuery);
	}
	
	public function deleteCertainUser($username, $enterprise){
		$users = $this->queryCertainUser($username, $enterprise);
		
		if(count($users) != 1){
			return;
		}
		
		$id = $users[0]['userid'];
		
		//delete from table user 
		$this->delete($id);
		
		//delete from table user_tgroup
		$userTgroupDAO = DAOFactory::getUserTgroupDAO();
		$userTgroupDAO->deleteByUser($id);
	}
	
}
?>