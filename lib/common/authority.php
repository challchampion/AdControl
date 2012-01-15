<?php 

function isDefaultAdmin($auth){
	return $auth == DEFAULTSYSADMIN;
}

function hasSysAdminAuth($auth){
	return ($auth & DEFAULTSYSADMIN || $auth & SYSADMIN);
}

function hasUserAdminAuth($auth){
	if(hasSysAdminAuth($auth))
		return true;
	
	if($auth & USERADMIN){
		return true;
	}
	return false;
}

function isUserAdmin($auth){
	if($auth & USERADMIN){
		return true;
	}
	return false;
}

function hasMediaUploaderAuth($auth){
	if(hasSysAdminAuth($auth))
		return true;
	
	if($auth & MEDIAUPLOADER)
		return true;
	return false;
}

function isMediaUploader($auth){
	if($auth & MEDIAUPLOADER)
		return true;
	return false;
}

function hasMediaExaminerAuth($auth){
	if(hasSysAdminAuth($auth))
		return true;
	
	if($auth & MEDIAEXAMINER)
		return true;
	return false;
}

function isMediaExaminer($auth){
	if($auth & MEDIAEXAMINER)
		return true;
	return false;
}

function hasListMakerAuth($auth){
	if(hasSysAdminAuth($auth))
		return true;
	
	if($auth & LISTMAKER)
		return true;
	return false;
}

function isListMaker($auth){
	if($auth & LISTMAKER)
		return true;
	return false;
}

function hasListIssuerAuth($auth){
	if(hasSysAdminAuth($auth))
		return true;
	
	if($auth & LISTISSUER)
		return true;
	return false;
}

function isListIssuer($auth){
	if($auth & LISTISSUER)
		return true;
	return false;
}

function hasReportMakerAuth($auth){
	if(hasSysAdminAuth($auth))
		return true;
	
	if($auth & REPORTMAKER)
		return true;
	return false;
}

function isReportMaker($auth){
	if($auth & REPORTMAKER)
		return true;
	return false;
}

function hasTerminalAdminAuth($auth){
	if(hasSysAdminAuth($auth))
		return true;
	
	if($auth & TERMINALADMIN)
		return true;
	return false;
}

function isTerminalAdmin($auth){
	if($auth & TERMINALADMIN)
		return true;
	return false;
}

?>