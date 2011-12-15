create database adcontrol;
use adcontrol;

create table user (
	username char(20) not null primary key,
	passwd char(40) not null,
	email char(100),
	userstatus enum('online', 'offline') not null,
	usergroupname char(20) not null,
	authority enum('province', 'country') not null
);

create table usergroup(
	usergroupname char(20) not null primary key,
	group_authority enum('province', 'country') not null
);

insert into usergroup values
	('defalt', 'province'),
	('bsq', 'province');
	
insert into user (username, passwd, userstatus, usergroupname, authority) values
	('root', sha1('root'), 'offline', 'default', 'province'),
	('admin', sha1('admin'), 'offline', 'default', 'province');

	
	
create table terminal (
	terminalid int unsigned not null auto_increment primary key,
	terminal_name char(30) not null,
	terminal_type char(20) not null,
	ip char(20) not null,
	mac char(30) not null,
	volume tinyint not null,
	terminal_status enum('online', 'offline') not null,
	terminal_groupid int unsigned not null,
	username char(20) not null
);

create table terminalinfo (
	terminalid int unsigned not null auto_increment primary key,
	hardwareinfo text,
	softwareinfo text,
	weatheraddress text,
	remark text,
	discinfo text,
	addressinfo text,
	displayportid int unsigned  not null,
	resolutionid int unsigned not null,
	aspectratioid int unsigned not null
);

create table terminalgroup (
	terminal_groupid int unsigned not null primary key,
	groupname char(20) not null
);

create table displayport (
	displayportid int unsigned not null primary key,
	name char(25) not null
);

insert into displayport values 
	(1, 'hdmi'),
	(2, 'lvds'),
	(3, 'av'),
	(4, 'vga'),
	(5, 'component');

create table resolution (
	resolutionid int unsigned not null primary key,
	name char(25) not null
);

insert into resolution values 
	(1, 'hdmi1080p60'),
	(2, 'hdmi720p60');

create table aspectratio (
	aspectratioid int unsigned not null primary key,
	name char(25) not null
);
 
insert into aspectratio values 
	(1, '16:9'),
	(2, '4:3'),
	(3, '16:10');
	
	
	
	
create table media (
	mediaid int unsigned not null primary key,
	categoryid tinyint unsigned not null,
	mediapath char(80) not null,
	mediastatus enum('verified', 'verifying', 'denied') not null,
	mediasize int not null,
	uploadtime datetime not null,
	username char(20) not null
);

create table mediainfo (
	mediaid int unsigned not null primary key,
	verifycomment text,
	illustration text
);

create table mediacategory (
	categoryid tinyint unsigned not null primary key,
	name char(20) not null
);



create table pattern (
	patternid int unsigned not null primary key,
	name char(30) not null,
	categoryid int,
	username char(20) not null,
	resolutionid int unsigned not null,
	aspectratioid int unsigned not null,
	maketime datetime not null
);

create table patternarea (
	areaid int unsigned not null primary key,
	areatype enum('video', 'text', 'date', 'week', 'picture', 'weather', 'time') not null,
	patternid int unsigned not null,
	width smallint unsigned not null,
	height smallint unsigned not null,
	layer tinyint unsigned not null,
	xcoordinate tinyint not null,
	ycoordinate tinyint not null,
	transparency tinyint unsigned not null
);



create table playlist (
	playlistid int unsigned not null primary key,
	name char(30) not null,
	patternid int unsigned not null,
	username char(20) not null
);

create table playlistitem (
	itemid int unsigned not null primary key,
	areaid int unsigned not null,
	mediaid int unsigned not null,
	playlistid int unsigned not null
);



create table playschedule (
	playscheduleid int unsigned not null primary key,
	name char(30) not null,
	username char(20) not null,
	scheduledate date not null,
	starttime time not null,
	endtime time not null,
	scheduletypeid tinyint not null
);

create table playscheduleitem (
	scheduleitemid int unsigned not null primary key,
	playlistid int unsigned not null,
	starttime time not null,
	endtime time not null,
	playtimes tinyint,
	playscheduleid int unsigned not null
);

create table scheduletype (
	scheduletypeid tinyint not null primary key,
	name char(20) not null
);
	
	
	