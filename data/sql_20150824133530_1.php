<?php die('forbidden'); ?>
DROP TABLE IF EXISTS yuantest_admin;
CREATE TABLE `yuantest_admin` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID号',
  `name` varchar(50) NOT NULL COMMENT '账号',
  `email` varchar(100) NOT NULL COMMENT '邮箱',
  `pass` varchar(50) NOT NULL COMMENT '密码',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1正常0锁定',
  `if_system` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1系统管理员0普通管理员',
  `popedom` text NOT NULL COMMENT '权限',
  `langid` varchar(255) NOT NULL COMMENT '可操作的语言权限，系统管理员不限',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS yuantest_cache;
CREATE TABLE `yuantest_cache` (
  `id` varchar(50) NOT NULL COMMENT 'ID号',
  `langid` varchar(5) NOT NULL DEFAULT 'zh' COMMENT '语言ID',
  `content` longtext NOT NULL COMMENT '缓存内容',
  `postdate` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '缓存时间',
  PRIMARY KEY (`id`,`langid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS yuantest_cate;
CREATE TABLE `yuantest_cate` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID号',
  `identifier` varchar(30) NOT NULL COMMENT '标识串，必须是唯一的',
  `langid` varchar(5) NOT NULL COMMENT '语言标识',
  `cate_name` varchar(100) NOT NULL COMMENT '分类名称',
  `parentid` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '父级ID，如果为根分类，则使用0',
  `module_id` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '模块ID',
  `tpl_index` varchar(100) NOT NULL COMMENT '封面模板',
  `tpl_list` varchar(100) NOT NULL COMMENT '列表模板',
  `tpl_file` varchar(100) NOT NULL COMMENT '内容模板',
  `if_index` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否是封面，0否1是',
  `taxis` tinyint(3) unsigned NOT NULL DEFAULT '255' COMMENT '排序，值越小越往前靠',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1使用中0禁用',
  `if_hidden` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1隐藏0显示',
  `keywords` varchar(255) NOT NULL COMMENT 'SEO关键字',
  `description` varchar(255) NOT NULL COMMENT 'SEO描述',
  `ifspec` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0非单页1单页',
  `note` text NOT NULL COMMENT '简要描述',
  `psize` tinyint(3) unsigned NOT NULL DEFAULT '30' COMMENT '每页显示数量，默认30',
  `inpic` varchar(100) NOT NULL COMMENT '前台默认图片关联',
  `linkurl` varchar(255) NOT NULL COMMENT '自定义链接',
  `target` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '新窗口打开1是0否',
  `ordertype` varchar(100) NOT NULL DEFAULT 'post_date:desc' COMMENT '排序类型，默认是发布时间',
  `subcate` varchar(100) NOT NULL COMMENT '分类副标题',
  `ico` varchar(255) NOT NULL COMMENT '图标',
  `small_pic` varchar(255) NOT NULL COMMENT '小图',
  `medium_pic` varchar(255) NOT NULL COMMENT '中图',
  `big_pic` varchar(255) NOT NULL COMMENT '大图',
  `fields` varchar(255) NOT NULL COMMENT '有效字段',
  PRIMARY KEY (`id`),
  KEY `module_id` (`module_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS yuantest_commission;
CREATE TABLE `yuantest_commission` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID号',
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `uname` varchar(200) NOT NULL,
  `cid` mediumint(8) NOT NULL,
  `username` varchar(100) NOT NULL COMMENT '会员名称',
  `proname` varchar(220) NOT NULL DEFAULT '0',
  `ctype` varchar(20) NOT NULL DEFAULT '0',
  `money` float NOT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0未审核1正常2锁定',
  `postdate` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `listid` (`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS yuantest_customer;
CREATE TABLE `yuantest_customer` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID号',
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `uname` varchar(200) NOT NULL,
  `username` varchar(100) NOT NULL COMMENT '会员名称',
  `cellphone` varchar(20) NOT NULL,
  `proname` varchar(220) NOT NULL DEFAULT '0',
  `appointment_date` varchar(10) NOT NULL DEFAULT '0',
  `appointment_time` varchar(10) NOT NULL,
  `remark` text NOT NULL,
  `guwenname` varchar(100) NOT NULL,
  `guwentel` varchar(100) NOT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0未审核1正常2锁定',
  `postdate` int(10) unsigned NOT NULL DEFAULT '0',
  `daofang` int(1) NOT NULL DEFAULT '0',
  `dfnote` text NOT NULL,
  `renchou` int(1) NOT NULL DEFAULT '0',
  `rcnote` text NOT NULL,
  `rengou` int(1) NOT NULL DEFAULT '0',
  `rgnote` text NOT NULL,
  `qianyue` int(1) NOT NULL DEFAULT '0',
  `qynote` text NOT NULL,
  `huikuan` int(1) NOT NULL DEFAULT '0',
  `hknote` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `listid` (`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS yuantest_gd;
CREATE TABLE `yuantest_gd` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID号',
  `pictype` varchar(50) NOT NULL DEFAULT '' COMMENT '图片类型标识',
  `picsubject` varchar(255) NOT NULL DEFAULT '' COMMENT '类型名称',
  `width` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '图片宽度',
  `height` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '图片高度',
  `water` varchar(255) NOT NULL DEFAULT '' COMMENT '水印图片位置',
  `picposition` varchar(100) NOT NULL DEFAULT '' COMMENT '水印位置',
  `trans` tinyint(3) unsigned NOT NULL DEFAULT '65' COMMENT '透明度，默认是60',
  `cuttype` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '图片生成方式，支持缩放法和裁剪法两种，默认使用缩放法',
  `quality` tinyint(3) unsigned NOT NULL DEFAULT '80' COMMENT '图片生成质量，默认是80',
  `border` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否支持边框，1是0否',
  `bordercolor` varchar(10) NOT NULL DEFAULT 'FFFFFF' COMMENT '边框颜色',
  `padding` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '间距，默认是0,最大不超过255',
  `bgcolor` varchar(10) NOT NULL DEFAULT 'FFFFFF' COMMENT '补白背景色，默认是白色',
  `bgimg` varchar(255) NOT NULL DEFAULT '' COMMENT '背景图片，默认为空',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否使用，默认是使用',
  `taxis` tinyint(3) unsigned NOT NULL DEFAULT '255' COMMENT '排序，值越小越往前靠，最大不超过255，最小为0',
  `edit_default` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS yuantest_identifier;
CREATE TABLE `yuantest_identifier` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `sign` varchar(32) NOT NULL COMMENT '标识符，用于本系统内所有需要此功能，仅限字母数字及下划线且第一个必须是字母',
  `title` varchar(100) NOT NULL COMMENT '名称',
  `langid` varchar(5) NOT NULL COMMENT '语言编号，如zh,en等',
  `module_id` mediumint(8) unsigned NOT NULL COMMENT '一个标识符只能用于一个模块，一个模块有多个标识符',
  `if_system` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1系统0自定义',
  `g_sign` varchar(100) NOT NULL COMMENT '组标识，仅在核心技术中使用',
  `taxis` tinyint(3) unsigned NOT NULL DEFAULT '255' COMMENT '排序',
  PRIMARY KEY (`id`),
  KEY `module_id` (`module_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS yuantest_input;
CREATE TABLE `yuantest_input` (
  `input` varchar(50) NOT NULL COMMENT '扩展框类型',
  `langid` varchar(5) NOT NULL DEFAULT 'zh' COMMENT '语言ID',
  `name` varchar(100) NOT NULL COMMENT '名字',
  `taxis` tinyint(3) unsigned NOT NULL DEFAULT '255' COMMENT '排序',
  `ifuser` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否允许会员表使用0否1是',
  PRIMARY KEY (`input`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS yuantest_lang;
CREATE TABLE `yuantest_lang` (
  `langid` varchar(5) NOT NULL DEFAULT 'zh' COMMENT '语言ID',
  `title` varchar(100) NOT NULL COMMENT '显示名',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '状态1不使用2使用',
  `note` varchar(255) NOT NULL COMMENT '描述',
  `taxis` tinyint(3) unsigned NOT NULL DEFAULT '255' COMMENT '排序，小值排前',
  `ifdefault` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否是系统默认',
  `ifsystem` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1系统语言0应用语言',
  `ico` varchar(255) NOT NULL COMMENT '图标',
  `small_pic` varchar(255) NOT NULL COMMENT '小图',
  `medium_pic` varchar(255) NOT NULL COMMENT '中图',
  `big_pic` varchar(255) NOT NULL COMMENT '大图',
  PRIMARY KEY (`langid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS yuantest_lang_msg;
CREATE TABLE `yuantest_lang_msg` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID号',
  `langid` varchar(5) NOT NULL DEFAULT 'zh' COMMENT '语言ID',
  `ltype` enum('www','admin','all') NOT NULL DEFAULT 'all' COMMENT '语言包应用范围',
  `var` varchar(100) NOT NULL COMMENT '语言变量名，仅英文数字及下划线',
  `val` varchar(255) NOT NULL COMMENT '语言值',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=469 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS yuantest_list;
CREATE TABLE `yuantest_list` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `module_id` mediumint(8) unsigned NOT NULL COMMENT '模块ID',
  `cate_id` mediumint(8) unsigned NOT NULL COMMENT '分类ID',
  `title` varchar(255) NOT NULL COMMENT '主题',
  `subtitle` varchar(255) NOT NULL COMMENT '副标题',
  `style` varchar(255) NOT NULL COMMENT '主题样式',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态，1正常0锁定',
  `hidden` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1隐藏0显示',
  `link_url` varchar(255) NOT NULL COMMENT '访问网址',
  `target` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否在新窗口打开1是0否',
  `author` varchar(100) NOT NULL COMMENT '发布人',
  `author_type` enum('admin','user','guest') NOT NULL DEFAULT 'user' COMMENT '发布人类型',
  `keywords` varchar(255) NOT NULL COMMENT '关键字，标签',
  `description` varchar(255) NOT NULL COMMENT '简要描述用于SEO优化',
  `note` text NOT NULL COMMENT '简要描述，用于列表简要说明',
  `identifier` varchar(100) NOT NULL COMMENT '访问标识串，为空时使用系统ID',
  `hits` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '点击率',
  `good_hits` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '支持次数',
  `bad_hits` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '拍砖次数',
  `post_date` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '发布时间',
  `modify_date` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后修改时间',
  `thumb_id` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '缩略图ID',
  `istop` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1置顶0非置顶',
  `isvouch` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1推荐0非推荐',
  `isbest` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1精华0非精华',
  `langid` varchar(5) NOT NULL DEFAULT 'zh' COMMENT '语言ID，默认是中文',
  `points` int(10) NOT NULL DEFAULT '0' COMMENT '积分，点数',
  `ip` varchar(100) NOT NULL COMMENT '发布人IP号',
  `replydate` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后回复时间',
  `taxis` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '自定义排序，值越大越往前靠',
  `htmltype` enum('mid','cateid','date','root') NOT NULL DEFAULT 'date' COMMENT 'HTML存储方式，默认是以时间来存储',
  `tplfile` varchar(100) NOT NULL COMMENT '模板文件',
  `star` float unsigned NOT NULL DEFAULT '0' COMMENT '星级评论，默认为0，根据评论表中的星数来决定',
  `yongjin` varchar(200) NOT NULL,
  `jili` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `module_id` (`module_id`,`cate_id`,`title`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS yuantest_list_c;
CREATE TABLE `yuantest_list_c` (
  `id` int(10) unsigned NOT NULL COMMENT '主题ID',
  `field` varchar(30) NOT NULL DEFAULT '' COMMENT '字段名',
  `val` text NOT NULL COMMENT '内容',
  PRIMARY KEY (`id`,`field`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS yuantest_module;
CREATE TABLE `yuantest_module` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `group_id` mediumint(8) unsigned NOT NULL COMMENT '组ID',
  `langid` varchar(5) NOT NULL DEFAULT 'zh' COMMENT '语言ID，默认是zh',
  `identifier` varchar(32) NOT NULL DEFAULT '0' COMMENT '标识符',
  `title` varchar(100) NOT NULL COMMENT '名称',
  `note` varchar(255) NOT NULL COMMENT '备注',
  `ctrl_init` varchar(100) NOT NULL COMMENT '执行文件，不同模块可能执行相同的文件，使用标识符区分',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0不使用1使用',
  `taxis` tinyint(3) unsigned NOT NULL DEFAULT '255' COMMENT '排序值越小越往靠，最小为0',
  `if_system` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1系统模块2自定义添加模块',
  `if_cate` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否启用分类功能，1使用0不使用',
  `if_biz` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否支持电子商务，0否1是',
  `if_propety` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0不支持属性，1支持',
  `if_hits` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0不持点击1支持',
  `popedom` varchar(255) NOT NULL COMMENT '权限ID，多个权限ID用英文逗号隔开',
  `if_thumb` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1支持缩略图0不支持',
  `if_thumb_m` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1必填0非必填',
  `if_point` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0不支持点数1支持点数',
  `if_url_m` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0不支持自定义网址，1支持，2支持且必填',
  `inpic` varchar(100) NOT NULL COMMENT '前台默认图片关联',
  `insearch` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '支持前台搜索',
  `if_content` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0不支持读取内容1读取内容及管理员回复',
  `if_email` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1邮件通知0不通知',
  `link_id` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '联动ID，0为不使用联动搜索',
  `search_id` varchar(30) NOT NULL COMMENT '联动搜索的字段名',
  `psize` tinyint(3) unsigned NOT NULL DEFAULT '30' COMMENT '默认分页数量',
  `if_subtitle` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否启用副标题0否1是',
  `ico` varchar(255) NOT NULL COMMENT '图标',
  `small_pic` varchar(255) NOT NULL COMMENT '小图',
  `medium_pic` varchar(255) NOT NULL COMMENT '中图',
  `big_pic` varchar(255) NOT NULL COMMENT '大图',
  `tplset` enum('list','pic') NOT NULL DEFAULT 'list' COMMENT 'list列表，pic图文',
  `title_nickname` varchar(50) NOT NULL COMMENT '主题别称',
  `subtitle_nickname` varchar(50) NOT NULL COMMENT '副标题别称',
  `sign_nickname` varchar(50) NOT NULL COMMENT '标识串别称',
  `if_sign_m` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '标识串是否必填',
  `if_ext` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '可选扩展1使用0不使用',
  `if_des` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '简短描述1允许0不使用',
  `if_list` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '1支持0不支持',
  `if_msg` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '1支持0不支持',
  `layout` varchar(255) NOT NULL COMMENT '后台布局设置',
  PRIMARY KEY (`id`),
  KEY `group_id` (`group_id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS yuantest_module_fields;
CREATE TABLE `yuantest_module_fields` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `module_id` mediumint(8) unsigned NOT NULL COMMENT '模块ID',
  `identifier` varchar(32) NOT NULL COMMENT '标识符',
  `title` varchar(100) NOT NULL COMMENT '主题',
  `if_post` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1支持会员0不支持',
  `if_guest` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1支持游客0不支持',
  `sub_left` varchar(60) NOT NULL COMMENT '左侧主题',
  `sub_note` varchar(120) NOT NULL COMMENT '右侧备注信息',
  `input` varchar(50) NOT NULL DEFAULT 'text' COMMENT '表单类型',
  `width` varchar(20) NOT NULL COMMENT '宽度',
  `height` varchar(20) NOT NULL COMMENT '高度',
  `default_val` varchar(50) NOT NULL COMMENT '默认值',
  `list_val` varchar(255) NOT NULL COMMENT '值列表',
  `link_id` int(10) NOT NULL DEFAULT '0' COMMENT '联动组ID',
  `taxis` tinyint(3) unsigned NOT NULL DEFAULT '255' COMMENT '自定义排序，值越小越往前靠',
  `if_must` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1必填0非必填',
  `if_html` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1支持HTML，0不支持',
  `error_note` varchar(255) NOT NULL COMMENT '错误时的提示',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1启用0禁用',
  `if_system` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1系统字段，0用户配置字段',
  `tbl` enum('ext','c') NOT NULL COMMENT 'ext指长度不大于255的表中，c指长度大于255的数据',
  `show_html` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0不显示源码1显示源码',
  `if_js` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1支持0不支持',
  `if_search` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否允许搜索',
  PRIMARY KEY (`id`),
  KEY `module_id` (`module_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS yuantest_module_group;
CREATE TABLE `yuantest_module_group` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `langid` varchar(32) NOT NULL DEFAULT 'zh' COMMENT '语言编号，如zh,en等',
  `title` varchar(100) NOT NULL COMMENT '组名称',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0不使用1使用',
  `taxis` tinyint(3) unsigned NOT NULL DEFAULT '255' COMMENT '值越小越往靠，最小为0',
  `js_function` varchar(100) NOT NULL DEFAULT '' COMMENT 'JS控制器，为空使用系统自动生成',
  `if_system` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1系统0自定义',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS yuantest_session;
CREATE TABLE `yuantest_session` (
  `id` varchar(32) NOT NULL COMMENT 'session_id',
  `data` text NOT NULL COMMENT 'session 内容',
  `lasttime` int(10) unsigned NOT NULL COMMENT '时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS yuantest_tpl;
CREATE TABLE `yuantest_tpl` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID号',
  `langid` varchar(5) NOT NULL DEFAULT 'zh' COMMENT '语言ID，默认是zh',
  `title` varchar(100) NOT NULL COMMENT '名称',
  `folder` varchar(50) NOT NULL COMMENT '文件夹',
  `ext` varchar(10) NOT NULL DEFAULT 'html' COMMENT '模板后缀',
  `autoimg` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否自动解析图片地址',
  `ifdefault` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否默认',
  `ifsystem` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1系统模板0用户模板',
  `taxis` tinyint(3) unsigned NOT NULL DEFAULT '255' COMMENT '排序',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1正在使用0未使用',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS yuantest_upfiles;
CREATE TABLE `yuantest_upfiles` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '图片ID',
  `title` varchar(100) NOT NULL COMMENT '标题',
  `filename` varchar(255) NOT NULL COMMENT '图片路径，基于网站根目录的相对路径',
  `thumb` varchar(255) NOT NULL COMMENT '缩略图路径，基于网站根目录的相对路径',
  `postdate` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上传时间',
  `ftype` varchar(10) NOT NULL COMMENT '附件类型',
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '会员ID号，0表示管理员上传',
  `flv_pic` varchar(255) NOT NULL COMMENT 'FLV封面图片',
  `sessid` varchar(50) NOT NULL COMMENT '游客上传标识串',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS yuantest_upfiles_gd;
CREATE TABLE `yuantest_upfiles_gd` (
  `pid` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '图片ID，对应upfiles里的ID',
  `gdtype` varchar(100) NOT NULL COMMENT '图片类型',
  `filename` varchar(255) NOT NULL COMMENT '图片地址（生成类型的图片地址）',
  PRIMARY KEY (`pid`,`gdtype`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS yuantest_user;
CREATE TABLE `yuantest_user` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `groupid` mediumint(8) unsigned NOT NULL DEFAULT '1' COMMENT '会员组ID',
  `username` varchar(100) NOT NULL COMMENT '会员名称',
  `pass` varchar(50) NOT NULL COMMENT '密码',
  `phone` varchar(100) NOT NULL COMMENT '手机',
  `regdate` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '注册时间',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '状态1已审核0未审核2锁定',
  `fxstatus` tinyint(1) NOT NULL,
  `job` varchar(150) NOT NULL,
  `company` varchar(20) NOT NULL,
  `thumb_id` int(10) unsigned NOT NULL COMMENT '个性头像ID',
  `bankAccount` varchar(100) NOT NULL,
  `cardCode` varchar(100) NOT NULL,
  `bankName` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS yuantest_user_group;
CREATE TABLE `yuantest_user_group` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '会员组ID',
  `group_type` enum('user','guest') NOT NULL DEFAULT 'user' COMMENT '用户组类型',
  `title` varchar(100) NOT NULL COMMENT '组名称',
  `popedom_post` text NOT NULL COMMENT '发布权限',
  `popedom_reply` text NOT NULL COMMENT '回复权限',
  `popedom_read` text NOT NULL COMMENT '阅读权限，默认为all',
  `post_cert` tinyint(1) NOT NULL DEFAULT '0' COMMENT '发布0需要验证1免验证',
  `reply_cert` tinyint(1) NOT NULL DEFAULT '0' COMMENT '回复0需要验证1免验证',
  `ifsystem` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否系统组0否1是',
  `ifdefault` tinyint(1) NOT NULL DEFAULT '0' COMMENT '会员注册后默认选择的组',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

