<?php 

function hasLogin(){
	return (isset($_SESSION['curUserID']) && isset($_SESSION['curUserName'])
			&& isset($_SESSION['curEnterprise']) && $_SESSION['curUserAuth']);
}

function currentEnterprise(){
	return $_SESSION['curEnterprise'];
}

function currentUserId(){
	return $_SESSION['curUserID'];
}

function currentUserAuth(){
	return $_SESSION['curUserAuth'];
}

function currentUserName(){
	return $_SESSION['curUserName'];
}

?>