-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2012 年 12 月 01 日 10:35
-- 服务器版本: 5.5.16
-- PHP 版本: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `zb_oa`
--

-- --------------------------------------------------------

--
-- 表的结构 `zb_article_class`
--

CREATE TABLE IF NOT EXISTS `zb_article_class` (
  `class_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `class_name` varchar(50) NOT NULL,
  `class_no` bit(1) DEFAULT NULL,
  PRIMARY KEY (`class_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `zb_article_info`
--

CREATE TABLE IF NOT EXISTS `zb_article_info` (
  `article_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `class_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `title` varchar(50) NOT NULL,
  `content` text,
  `create_time` datetime NOT NULL,
  `ip` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`article_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `zb_customer`
--

CREATE TABLE IF NOT EXISTS `zb_customer` (
  `customer_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `class_id` int(10) NOT NULL,
  `customer_name` varchar(20) NOT NULL,
  `tel` varchar(20) NOT NULL,
  `address` varchar(50) DEFAULT NULL,
  `fax` varchar(20) DEFAULT NULL,
  `vocation` varchar(50) DEFAULT NULL,
  `from_id` int(10) unsigned NOT NULL,
  `from` varchar(50) DEFAULT NULL,
  `intention` varchar(50) DEFAULT NULL,
  `now_user_id` int(10) unsigned NOT NULL,
  `now_mark` varchar(50) DEFAULT NULL,
  `is_read` bit(1) DEFAULT NULL,
  `create_time` datetime NOT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `zb_customer_class`
--

CREATE TABLE IF NOT EXISTS `zb_customer_class` (
  `class_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `class_name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `class_introduce` varchar(90) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`class_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `zb_customer_class`
--

INSERT INTO `zb_customer_class` (`class_id`, `class_name`, `class_introduce`) VALUES
(1, '真心分组', '你好啊');

-- --------------------------------------------------------

--
-- 表的结构 `zb_customer_from`
--

CREATE TABLE IF NOT EXISTS `zb_customer_from` (
  `from_id` int(10) unsigned NOT NULL,
  `from_name` varchar(30) CHARACTER SET utf8 NOT NULL,
  `user_id` int(10) NOT NULL DEFAULT '0',
  `rate` int(2) NOT NULL,
  PRIMARY KEY (`from_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 表的结构 `zb_department`
--

CREATE TABLE IF NOT EXISTS `zb_department` (
  `department_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `department_name` varchar(20) NOT NULL,
  `post` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`department_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `zb_department`
--

INSERT INTO `zb_department` (`department_id`, `department_name`, `post`) VALUES
(1, '行政部', '我行，我是行政'),
(4, '暗黑', '123');

-- --------------------------------------------------------

--
-- 表的结构 `zb_mark`
--

CREATE TABLE IF NOT EXISTS `zb_mark` (
  `mark_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mark` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`mark_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `zb_menu`
--

CREATE TABLE IF NOT EXISTS `zb_menu` (
  `menu_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `right_id` int(10) unsigned NOT NULL,
  `menu_name` varchar(20) NOT NULL,
  `menu_level` tinyint(2) unsigned DEFAULT '0',
  `menu_parent` tinyint(10) unsigned DEFAULT '0',
  `order` int(10) unsigned NOT NULL DEFAULT '999',
  PRIMARY KEY (`menu_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

--
-- 转存表中的数据 `zb_menu`
--

INSERT INTO `zb_menu` (`menu_id`, `right_id`, `menu_name`, `menu_level`, `menu_parent`, `order`) VALUES
(1, 1, '系统', 0, 0, 1),
(2, 1, '后台首页', 1, 1, 999),
(3, 1, '后台首页', 2, 2, 999),
(4, 2, '系统设置', 1, 1, 999),
(5, 2, '站点设置', 2, 4, 3),
(10, 9, '客户管理', 1, 8, 2),
(9, 30, '电话营销', 1, 8, 1),
(8, 30, '客户关系', 0, 0, 2),
(6, 3, '后台设置', 2, 4, 2),
(7, 4, '更新缓存', 2, 4, 1),
(11, 6, '权限管理', 1, 1, 999),
(12, 6, '用户管理', 2, 11, 999),
(13, 5, '用户组管理', 2, 11, 999),
(14, 13, '人员管理', 0, 0, 3),
(15, 13, '员工信息', 1, 14, 999),
(16, 21, '绩效考核', 1, 14, 999),
(17, 17, '部门信息', 1, 14, 999),
(18, 13, '员工管理', 2, 15, 999),
(19, 21, '考核信息', 2, 16, 999),
(20, 17, '部门管理', 2, 17, 999),
(21, 32, '销售管理', 1, 8, 3),
(22, 30, '我的客户', 2, 9, 999),
(23, 31, '回访提醒', 2, 9, 999),
(24, 29, '客户资源', 2, 9, 999),
(25, 9, '新增客户', 2, 10, 999),
(26, 8, '查询客户', 2, 10, 999),
(27, 10, '客户分配', 2, 10, 999),
(28, 27, '来源管理', 2, 10, 999),
(29, 28, '分组管理', 2, 10, 999),
(30, 32, '申请发货', 2, 21, 999);

-- --------------------------------------------------------

--
-- 表的结构 `zb_post`
--

CREATE TABLE IF NOT EXISTS `zb_post` (
  `post_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `department_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `post` text,
  `create_time` datetime NOT NULL,
  `ip` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`post_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `zb_post_comment`
--

CREATE TABLE IF NOT EXISTS `zb_post_comment` (
  `post_comment_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `post_comment` text,
  `create_time` datetime NOT NULL,
  `ip` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`post_comment_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `zb_process`
--

CREATE TABLE IF NOT EXISTS `zb_process` (
  `process_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `resource_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `mark` varchar(50) DEFAULT NULL,
  `datetime` datetime NOT NULL,
  PRIMARY KEY (`process_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `zb_right`
--

CREATE TABLE IF NOT EXISTS `zb_right` (
  `right_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `right_name` varchar(20) NOT NULL,
  `right_class` varchar(150) DEFAULT NULL,
  `right_method` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`right_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=36 ;

--
-- 转存表中的数据 `zb_right`
--

INSERT INTO `zb_right` (`right_id`, `right_name`, `right_class`, `right_method`) VALUES
(1, '后台首页', 'ss', 'home'),
(2, '站点设置', 'ss_setting', 'site'),
(3, '后台设置', 'ss_setting', 'backend'),
(4, '更新缓存', 'ss_cache', 'cache'),
(5, '用户组管理（列表）', 'ss_role', 'view'),
(6, '用户管理（列表）', 'ss_user', 'view'),
(7, '编辑用户组', 'ss_role', 'edit'),
(8, '查询客户', 'cr', 'check_customer'),
(9, '新增客户', 'cr', 'add_customer'),
(10, '客户分配', 'cr', 'allot_customer'),
(11, '添加用户组', 'ss_role', 'add'),
(12, '删除用户组', 'ss_role', 'del'),
(13, '员工信息（列表）', 'em', 'view'),
(14, '录入员工信息', 'em', 'add'),
(15, '修改员工信息', 'em', 'edit'),
(16, '删除员工信息', 'em', 'del'),
(17, '部门信息（列表）', 'em_dm', 'view'),
(18, '增加部门', 'em_dm', 'add'),
(19, '修改部门', 'em_dm', 'edit'),
(20, '删除部门', 'em_dm', 'del'),
(21, '考核信息', 'em_pa', 'view'),
(22, '添加用户（员工）', 'ss_user', 'add_em_user'),
(23, '添加用户（外部）', 'ss_user', 'add_user'),
(24, '编辑用户', 'ss_user', 'edit'),
(25, '删除用户', 'ss_user', 'del'),
(26, '冻结用户', 'ss_user', 'stop'),
(27, '来源管理', 'cr_cm', 'view'),
(28, '分组管理（列表）', 'cr_gm', 'view'),
(29, '客户资源', 'cr', 'resource'),
(30, '我的客户', 'cr_tel', 'my'),
(31, '回访提醒', 'cr_tel', 'return_visit'),
(32, '申请发货', 'cr_sale', 'apply'),
(33, '编辑分组', 'cr_gm', 'edit'),
(34, '删除分组', 'cr_gm', 'del'),
(35, '增加分组', 'cr_gm', 'add');

-- --------------------------------------------------------

--
-- 表的结构 `zb_role`
--

CREATE TABLE IF NOT EXISTS `zb_role` (
  `role_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_name` varchar(20) NOT NULL,
  `rights` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `zb_role`
--

INSERT INTO `zb_role` (`role_id`, `role_name`, `rights`) VALUES
(1, '超级管理员', '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35'),
(2, '测试组1', '1,2,3,4,5'),
(4, '牛人组', '1,2,3,4,5,6,8,9,10,11,12,13,14,15');

-- --------------------------------------------------------

--
-- 表的结构 `zb_user`
--

CREATE TABLE IF NOT EXISTS `zb_user` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(20) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(10) NOT NULL,
  `fullname` varchar(20) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `tel` varchar(20) DEFAULT NULL,
  `emergency_tel` varchar(20) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `id_cart` varchar(20) DEFAULT NULL,
  `entry_time` date DEFAULT NULL,
  `leave_time` date DEFAULT NULL,
  `department_id` int(10) unsigned DEFAULT NULL,
  `post` varchar(40) DEFAULT NULL,
  `is_admin` int(1) DEFAULT '0',
  `role_id` int(10) unsigned DEFAULT '0',
  `is_leave` bit(1) DEFAULT b'0',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

--
-- 转存表中的数据 `zb_user`
--

INSERT INTO `zb_user` (`user_id`, `user_name`, `password`, `salt`, `fullname`, `email`, `tel`, `emergency_tel`, `address`, `id_cart`, `entry_time`, `leave_time`, `department_id`, `post`, `is_admin`, `role_id`, `is_leave`) VALUES
(1, 'admin', 'c5da0823ddf32a9743116d18105adb6afa79ceb5', '516f36ef1b', '周斌', 'binarx@gmail.com', '15838201264', '15903658375', '文化路5号', '410323199106197015', '2012-07-12', '0000-00-00', 4, '程序员', 1, 1, '0'),
(4, '123456', '176638168903db136bcd3e6a1551d851a279c6c7', '14810933e7', '牛二', 'binarx2@gmail.com', '15874125896', '15874125896', '中华人民共和国', '410258741258963214', '2012-11-24', '0000-00-00', 4, '范德萨', 1, 1, '0'),
(7, 'hahah', '9a6572a9801ef63b8d95dedf44419ffe51693b43', 'fad2fd8078', '好礼乐', 'binarx2@gmail.com', '15874125896', '15874125896', '中华人民共和国', '410258741258963214', '2012-11-26', '0000-00-00', 1, '辅导书', 1, 1, '0'),
(26, 'lalal', '5dc18299012cd0f0d361fd617ad5fcb0c8897a38', 'd0f1b05c0c', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 2, '0'),
(12, '', '', '', '哈利波特', 'binarx2@gmail.com', '15874125896', '15874125896', '中华人民共和国', '410258741258963214', '2012-11-12', '0000-00-00', 1, '范德萨', 0, 0, '0'),
(27, NULL, '', '', '牛二12', 'binarx2@gmail.com', '15874125896', '15874125896', '中华人民共和国', '410258741258963214', '2012-11-20', '0000-00-00', 1, '12321', 0, 0, '0');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
