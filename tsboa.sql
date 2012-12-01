create database zb_oa;
use zb_oa;
-------------------------------------------------------------------------------
create table if not exists zb_user (
user_id int(10) unsigned NOT NULL AUTO_INCREMENT,
user_name varchar(20) NOT NULL,-- 用户名
password varchar(20) NOT NULL,
fullname varchar(20) DEFAULT NULL,-- 全名
email varchar(40) DEFAULT NULL,
tel varchar(20) DEFAULT NULL,
emergency_tel varchar(20) DEFAULT NULL,-- 紧急联系人电话
address varchar(50) DEFAULT NULL,
id_cart varchar(20) DEFAULT NULL,-- 身份证号码
entry_time date DEFAULT NULL,-- 入职时间
leave_time date DEFAULT NULL,-- 离职时间
department_id int(10) unsigned DEFAULT NULL,-- 部门ID
post varchar(40) DEFAULT NULL,-- 职位
is_admin bit DEFAULT NULL,-- 是否是管理员
role_id int(10) unsigned DEFAULT NULL,-- 权限ID
status int(10) unsigned DEFAULT NULL,-- 用户状态
PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
-------------------------------------------------------------------------------
create table if not exists zb_role (
role_id int(10) unsigned NOT NULL AUTO_INCREMENT,
role_name varchar(20) NOT NULL,-- 用户组名称
rights varchar(150) DEFAULT NULL,-- 权限
models varchar(150) DEFAULT NULL,-- 模块
PRIMARY KEY (`role_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
-------------------------------------------------------------------------------
create table if not exists zb_right (
right_id int(10) unsigned NOT NULL AUTO_INCREMENT,
right_name varchar(20) NOT NULL,-- 权限名称
right_class varchar(150) DEFAULT NULL,-- 权限所在类
right_method varchar(150) DEFAULT NULL,-- 权限方法
PRIMARY KEY (`right_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
-------------------------------------------------------------------------------
create table if not exists zb_resource (
resource_id int(10) unsigned NOT NULL AUTO_INCREMENT,
resource_name varchar(20) NOT NULL,-- 姓名
tel varchar(20) NOT NULL,
address varchar(50) DEFAULT NULL,
fax varchar(20) DEFAULT NULL,
vocation varchar(50) DEFAULT NULL,-- 职业
from_id int(10) unsigned NOT NULL,-- 输入人员ID
resource_from varchar(50) DEFAULT NULL,-- 信息来源
intention varchar(50) DEFAULT NULL,-- 意向
now_user_id int(10) unsigned NOT NULL,-- 目前处理人ID
now_mark varchar(50) DEFAULT NULL,-- 目前状态标记
is_read bit DEFAULT NULL,-- 是否 
create_time datetime NOT NULL,-- 输入时间
PRIMARY KEY (`resource_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
-------------------------------------------------------------------------------
create table if not exists zb_process (
process_id int(10) unsigned NOT NULL AUTO_INCREMENT,
resource_id int(10) unsigned NOT NULL,-- 资源ID
user_id int(10) unsigned NOT NULL,-- 本次处理人ID
mark varchar(50) DEFAULT NULL,-- 本次状态标记
datetime datetime NOT NULL,-- 处理时间
PRIMARY KEY (`process_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
-------------------------------------------------------------------------------
create table if not exists zb_mark (
mark_id int(10) unsigned NOT NULL AUTO_INCREMENT,
mark varchar(100) DEFAULT NULL,
PRIMARY KEY (`mark_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
-------------------------------------------------------------------------------
create table if not exists zb_department (
department_id int(10) unsigned NOT NULL AUTO_INCREMENT,
department_name varchar(20) NOT NULL,-- 部门名称
post varchar(100) DEFAULT NULL,-- 部门短语
PRIMARY KEY (`department_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
-------------------------------------------------------------------------------
create table if not exists zb_post (
post_id int(10) unsigned NOT NULL AUTO_INCREMENT,
department_id int(10) unsigned NOT NULL,
user_id int(10) unsigned NOT NULL,
post text DEFAULT NULL,-- 计划or总结
create_time datetime NOT NULL,
ip varchar(15) DEFAULT NULL,-- 发布者IP
PRIMARY KEY (`post_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
-------------------------------------------------------------------------------
create table if not exists zb_post_comment (
post_comment_id int(10) unsigned NOT NULL AUTO_INCREMENT,
post_id int(10) unsigned NOT NULL,
user_id int(10) unsigned NOT NULL,
post_comment text DEFAULT NULL,-- 回复
create_time datetime NOT NULL,
ip varchar(15) DEFAULT NULL,-- 发布者IP
PRIMARY KEY (`post_comment_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
-------------------------------------------------------------------------------
create table if not exists zb_article_info (
article_id int(10) unsigned NOT NULL AUTO_INCREMENT,
class_id int(10) unsigned NOT NULL,
user_id int(10) unsigned NOT NULL,
title varchar(50) NOT NULL,
content text DEFAULT NULL,
create_time datetime NOT NULL,
ip varchar(15) DEFAULT NULL,-- 发布者IP
PRIMARY KEY (`article_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
-------------------------------------------------------------------------------
create table if not exists zb_article_class (
class_id int(10) unsigned NOT NULL AUTO_INCREMENT,
class_name varchar(50) NOT NULL,
class_no bit DEFAULT NULL,-- 排序
PRIMARY KEY (`class_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;