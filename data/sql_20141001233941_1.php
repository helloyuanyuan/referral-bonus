<?php die('forbidden'); ?>
DROP TABLE IF EXISTS YuanTest_admin;
CREATE TABLE `YuanTest_admin` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID号',
  `name` varchar(50) NOT NULL COMMENT '账号',
  `email` varchar(100) NOT NULL COMMENT '邮箱',
  `pass` varchar(50) NOT NULL COMMENT '密码',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1正常0锁定',
  `if_system` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1系统管理员0普通管理员',
  `popedom` text NOT NULL COMMENT '权限',
  `langid` varchar(255) NOT NULL COMMENT '可操作的语言权限，系统管理员不限',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO YuanTest_admin VALUES('1','YuanAdmin','YuanAdmin@YuanAdmin.com','c3284d0f94606de1fd2af172aba15bf3','1','1','','');
