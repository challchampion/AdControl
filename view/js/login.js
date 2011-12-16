var bsq = bsq || {
	tv: {}
};

bsq.tv.Login = function() {

};

bsq.tv.Login.prototype.sessionId = null;

bsq.tv.Login.prototype.getUserName = function() {
	var login = this;
	var user = $("#user").val();
	return user;
};

bsq.tv.Login.prototype.getPassword = function() {
	var login = this;
	var pass = $("#password").val();
	return pass;
};

bsq.tv.Login.prototype.doLogin = function(user, password) {
	var login = this;
	var url = "http://iptv.kartina.tv/api/json/login?login=" + user + "&pass=" + password;
	
	var jsonStr = Native.getJSON(url);
	var json = eval("(" + jsonStr + ")");
	console.log(json.sid);
	this.sessionId = json.sid;
	
	if(this.sessionId)
		return true;
	else 
		return false;
};

bsq.tv.Login.prototype.submit = function() {
	var login = this;
	var user = login.getUserName();
	var password = login.getPassword();
	if(login.doLogin(user, password)){
		console.log("success");
	} else {
		console.log("fail");
	}
};

bsq.tv.Login.prototype.start = function() {
	var login = this;
	$("#submit").bind("click", function(){
		login.submit();
	});
};

window.onload = function(){
	new bsq.tv.Login().start();
}





