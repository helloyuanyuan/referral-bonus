-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2015-08-24 07:40:08
-- 服务器版本： 5.6.25
-- PHP Version: 5.6.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `referralbonus`
--

-- --------------------------------------------------------

--
-- 表的结构 `yuantest_admin`
--

CREATE TABLE IF NOT EXISTS `yuantest_admin` (
  `id` mediumint(8) unsigned NOT NULL COMMENT 'ID号',
  `name` varchar(50) NOT NULL COMMENT '账号',
  `email` varchar(100) NOT NULL COMMENT '邮箱',
  `pass` varchar(50) NOT NULL COMMENT '密码',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1正常0锁定',
  `if_system` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1系统管理员0普通管理员',
  `popedom` text NOT NULL COMMENT '权限',
  `langid` varchar(255) NOT NULL COMMENT '可操作的语言权限，系统管理员不限'
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `yuantest_admin`
--

INSERT INTO `yuantest_admin` (`id`, `name`, `email`, `pass`, `status`, `if_system`, `popedom`, `langid`) VALUES
(1, 'YuanAdmin', 'YuanAdmin@YuanAdmin.com', '2c9ecf53b6195fda274f2f3ce6e93d2b', 1, 1, '', '');

-- --------------------------------------------------------

--
-- 表的结构 `yuantest_cache`
--

CREATE TABLE IF NOT EXISTS `yuantest_cache` (
  `id` varchar(50) NOT NULL COMMENT 'ID号',
  `langid` varchar(5) NOT NULL DEFAULT 'zh' COMMENT '语言ID',
  `content` longtext NOT NULL COMMENT '缓存内容',
  `postdate` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '缓存时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `yuantest_cate`
--

CREATE TABLE IF NOT EXISTS `yuantest_cate` (
  `id` mediumint(8) unsigned NOT NULL COMMENT '自增ID号',
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
  `fields` varchar(255) NOT NULL COMMENT '有效字段'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `yuantest_commission`
--

CREATE TABLE IF NOT EXISTS `yuantest_commission` (
  `id` int(10) unsigned NOT NULL COMMENT '自增ID号',
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `uname` varchar(200) NOT NULL,
  `cid` mediumint(8) NOT NULL,
  `username` varchar(100) NOT NULL COMMENT '会员名称',
  `proname` varchar(220) NOT NULL DEFAULT '0',
  `ctype` varchar(20) NOT NULL DEFAULT '0',
  `money` float NOT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0未审核1正常2锁定',
  `postdate` int(10) unsigned NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `yuantest_customer`
--

CREATE TABLE IF NOT EXISTS `yuantest_customer` (
  `id` int(10) unsigned NOT NULL COMMENT '自增ID号',
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
  `hknote` text NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `yuantest_customer`
--

INSERT INTO `yuantest_customer` (`id`, `uid`, `uname`, `username`, `cellphone`, `proname`, `appointment_date`, `appointment_time`, `remark`, `guwenname`, `guwentel`, `status`, `postdate`, `daofang`, `dfnote`, `renchou`, `rcnote`, `rengou`, `rgnote`, `qianyue`, `qynote`, `huikuan`, `hknote`) VALUES
(22, 33, '测试员01', '客户01', '13222222222', '四海逸家1期', '2015-08-31', '11:35', '', '', '', 0, 1440387369, 0, '', 0, '', 0, '', 0, '', 0, '');

-- --------------------------------------------------------

--
-- 表的结构 `yuantest_gd`
--

CREATE TABLE IF NOT EXISTS `yuantest_gd` (
  `id` mediumint(8) unsigned NOT NULL COMMENT '自增ID号',
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
  `edit_default` tinyint(1) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `yuantest_gd`
--

INSERT INTO `yuantest_gd` (`id`, `pictype`, `picsubject`, `width`, `height`, `water`, `picposition`, `trans`, `cuttype`, `quality`, `border`, `bordercolor`, `padding`, `bgcolor`, `bgimg`, `status`, `taxis`, `edit_default`) VALUES
(1, 'thumb', '头像缩图', 75, 75, '', 'middle-middle', 50, 0, 80, 0, '', 0, 'CD332C', '', 1, 1, 0),
(3, 'big', '大图', 600, 600, '', 'bottom-right', 70, 2, 80, 0, '', 0, 'FFFFFF', '', 1, 2, 1),
(2, 'mid', '项目标志', 282, 120, '', 'middle-middle', 50, 1, 60, 0, '', 0, 'CD332C', '', 1, 2, 0);

-- --------------------------------------------------------

--
-- 表的结构 `yuantest_identifier`
--

CREATE TABLE IF NOT EXISTS `yuantest_identifier` (
  `id` mediumint(8) unsigned NOT NULL COMMENT '自增ID',
  `sign` varchar(32) NOT NULL COMMENT '标识符，用于本系统内所有需要此功能，仅限字母数字及下划线且第一个必须是字母',
  `title` varchar(100) NOT NULL COMMENT '名称',
  `langid` varchar(5) NOT NULL COMMENT '语言编号，如zh,en等',
  `module_id` mediumint(8) unsigned NOT NULL COMMENT '一个标识符只能用于一个模块，一个模块有多个标识符',
  `if_system` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1系统0自定义',
  `g_sign` varchar(100) NOT NULL COMMENT '组标识，仅在核心技术中使用',
  `taxis` tinyint(3) unsigned NOT NULL DEFAULT '255' COMMENT '排序'
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `yuantest_identifier`
--

INSERT INTO `yuantest_identifier` (`id`, `sign`, `title`, `langid`, `module_id`, `if_system`, `g_sign`, `taxis`) VALUES
(1, 'popedom', '权限管理', 'zh', 1, 1, '', 255),
(2, 'module', '模块管理', 'zh', 2, 1, '', 255),
(3, 'add', '添加', 'zh', 0, 1, 'popedom', 201),
(4, 'modify', '修改', 'zh', 0, 1, 'popedom', 202),
(5, 'check', '审核', 'zh', 0, 1, 'popedom', 203),
(6, 'delete', '删除', 'zh', 0, 1, 'popedom', 204),
(7, 'list', '查看', 'zh', 0, 1, 'popedom', 200),
(8, 'setting', '设置', 'zh', 0, 1, 'popedom', 205),
(9, 'save', '存储', 'zh', 0, 1, 'popedom', 206),
(10, 'group', '组管理', 'zh', 0, 1, 'popedom', 255);

-- --------------------------------------------------------

--
-- 表的结构 `yuantest_input`
--

CREATE TABLE IF NOT EXISTS `yuantest_input` (
  `input` varchar(50) NOT NULL COMMENT '扩展框类型',
  `langid` varchar(5) NOT NULL DEFAULT 'zh' COMMENT '语言ID',
  `name` varchar(100) NOT NULL COMMENT '名字',
  `taxis` tinyint(3) unsigned NOT NULL DEFAULT '255' COMMENT '排序',
  `ifuser` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否允许会员表使用0否1是'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `yuantest_input`
--

INSERT INTO `yuantest_input` (`input`, `langid`, `name`, `taxis`, `ifuser`) VALUES
('text', 'zh', '文本框', 10, 1),
('radio', 'zh', '单选框', 20, 1),
('checkbox', 'zh', '复选框', 30, 1),
('textarea', 'zh', '文本区域', 40, 1),
('edit', 'zh', '可视化编辑器', 50, 0),
('select', 'zh', '下拉菜单', 60, 1),
('img', 'zh', '图片选择器', 70, 1),
('video', 'zh', '影音选择器', 80, 1),
('download', 'zh', '下载框选择器', 90, 1),
('opt', 'zh', '联动选择', 100, 1),
('simg', 'zh', '图片选择器（单张）', 75, 1),
('module', 'zh', '内联模块', 110, 0);

-- --------------------------------------------------------

--
-- 表的结构 `yuantest_lang`
--

CREATE TABLE IF NOT EXISTS `yuantest_lang` (
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
  `big_pic` varchar(255) NOT NULL COMMENT '大图'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `yuantest_lang`
--

INSERT INTO `yuantest_lang` (`langid`, `title`, `status`, `note`, `taxis`, `ifdefault`, `ifsystem`, `ico`, `small_pic`, `medium_pic`, `big_pic`) VALUES
('zh', '简体中文', 1, '', 1, 1, 1, '', '', '', '');

-- --------------------------------------------------------

--
-- 表的结构 `yuantest_lang_msg`
--

CREATE TABLE IF NOT EXISTS `yuantest_lang_msg` (
  `id` mediumint(8) unsigned NOT NULL COMMENT '自增ID号',
  `langid` varchar(5) NOT NULL DEFAULT 'zh' COMMENT '语言ID',
  `ltype` enum('www','admin','all') NOT NULL DEFAULT 'all' COMMENT '语言包应用范围',
  `var` varchar(100) NOT NULL COMMENT '语言变量名，仅英文数字及下划线',
  `val` varchar(255) NOT NULL COMMENT '语言值'
) ENGINE=MyISAM AUTO_INCREMENT=469 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `yuantest_lang_msg`
--

INSERT INTO `yuantest_lang_msg` (`id`, `langid`, `ltype`, `var`, `val`) VALUES
(1, 'zh', 'admin', 'cp_name', '后台管理'),
(2, 'zh', 'all', 'error_note', '如果系统不能在 <span style="color:red;">{time}</span> 秒后自动返回，请点这里'),
(11, 'zh', 'admin', 'select_cate', '请选择分类'),
(4, 'zh', 'admin', 'no_popedom', 'Error: 对不起，您没有操作此功能权限'),
(5, 'zh', 'admin', 'login_false', '管理员登录失败，请检查…'),
(6, 'zh', 'admin', 'login_not_user_pass', '账号或密码不能为空'),
(7, 'zh', 'admin', 'login_success', '欢迎您 <span style=''color:red;''>{admin_realname}</span> 登录网站系统后台，请稍候…'),
(8, 'zh', 'all', 'login_vcode_empty', '验证码不能为空'),
(9, 'zh', 'all', 'login_vcode_false', '验证码填写错误'),
(10, 'zh', 'admin', 'logout_success', '管理员 <span style=''color:red;''>{admin_realname}</span> 成功退出！'),
(23, 'zh', 'www', 'login_false_empty', '登录失败，账号或密码为空！'),
(24, 'zh', 'www', 'login_false_rs', '登录失败，会员信息不存在，请检查。'),
(25, 'zh', 'www', 'login_false_password', '登录失败，会员密码不正确。'),
(26, 'zh', 'www', 'login_false_lock', '登录失败，会员账号已被管理员锁定，请联系管理员。'),
(27, 'zh', 'www', 'login_false_check', '登录失败，您的账号尚未激活！'),
(28, 'zh', 'www', 'login_usccess', '您的账号已经正常登录，请稍候……'),
(29, 'zh', 'www', 'login_exists', '您已经登录，请返回…'),
(30, 'zh', 'www', 'module_is_close', '模块未启用'),
(31, 'zh', 'www', 'not_any_title_in_module', '没有任何相关主题'),
(32, 'zh', 'www', 'not_found_any_module', '没有找到模块信息！'),
(34, 'zh', 'www', 'not_any_cate_in_module', '当前模块中没有任何分类信息'),
(59, 'zh', 'www', 'download_error', '没有指定附件信息！'),
(60, 'zh', 'www', 'download_empty', '附件已经不存在！'),
(61, 'zh', 'www', 'login', '合伙人登录'),
(63, 'zh', 'www', 'login_user_email_chk', '账号或邮箱不允许为空！'),
(64, 'zh', 'www', 'login_not_user_email', '账号不存在或是邮箱填写不正确！'),
(467, 'zh', 'www', 'recommend', '推荐客户'),
(468, 'zh', 'www', 'customer', '我的客户'),
(67, 'zh', 'www', 'login_not_code_user', '会员账号或验证串不允许为空'),
(68, 'zh', 'www', 'login_not_user', '账号不存在！'),
(71, 'zh', 'www', 'login_not_pass', '密码不允许为空！'),
(72, 'zh', 'www', 'login_error_pass', '两次输入的密码不一致！'),
(73, 'zh', 'www', 'login_update', '会员密码更新成功！'),
(74, 'zh', 'www', 'msg_not_id', '获取数据失败，没有指定主题标识串或ID'),
(75, 'zh', 'www', 'msg_not_rs', '无法获取内容信息，请检查'),
(76, 'zh', 'www', 'open_user', '非会员不支持此功能！'),
(77, 'zh', 'all', 'open_not_picture', '批量生成图片错误，没有取得一张有效图片'),
(78, 'zh', 'all', 'open_not_id', '没有指定要生成的图片ID'),
(79, 'zh', 'all', 'open_pl_ok', '图片批量生成完毕'),
(80, 'zh', 'all', 'open_pl_wait', '请稍候，系统正在批量生成新的图片方案'),
(81, 'zh', 'all', 'open_not_pre_id', '没有选择要预览的ID'),
(82, 'zh', 'www', 'please_login', '请先登录！'),
(83, 'zh', 'www', 'usercp', '会员中心'),
(86, 'zh', 'all', 'error', '操作有错误，请检查！'),
(93, 'zh', 'all', 'all_category', '全部分类'),
(94, 'zh', 'all', 'category_select', '请选择分类'),
(97, 'zh', 'all', 'error_save', '数据存储失败，请检查！'),
(98, 'zh', 'all', 'save_success', '数据存储成功，请稍候…'),
(99, 'zh', 'all', 'del_not_id', 'error：删除失败，没有指定ID'),
(101, 'zh', 'www', 'is_logined', '您已经登录了，不能使用注册功能'),
(102, 'zh', 'all', 'register', '合伙人注册'),
(103, 'zh', 'www', 'empty_pass', '密码不允许为空！'),
(104, 'zh', 'www', 'pass_not_right', '两次输入的密码不一致'),
(106, 'zh', 'www', 'register_ok', '恭喜您注册成为我们的合伙人'),
(107, 'zh', 'www', 'user_exists', '账号已经存在'),
(108, 'zh', 'www', 'empty_user', '账号不允许为空'),
(109, 'zh', 'all', 'error_not_id', 'error：操作错误，没有取得ID信息'),
(110, 'zh', 'all', 'error_not_rs', 'error：操作错误，没有取得数据信息'),
(114, 'zh', 'all', 'search', '站内搜索'),
(116, 'zh', 'www', 'user_not_login', '非会员不允许执行此操作，请先登录！'),
(117, 'zh', 'www', 'usercp_info', '修改资料'),
(118, 'zh', 'www', 'usercp_save_success', '会员信息更新成功！'),
(119, 'zh', 'www', 'usercp_changepass', '修改个人密码'),
(120, 'zh', 'www', 'usercp_not_oldpass', '旧密码为空或是旧密码填写不正确！'),
(121, 'zh', 'www', 'usercp_not_newpass', '新密码不允许为空或是两次输入的新密码不一致！'),
(122, 'zh', 'www', 'usercp_old_new', '新旧密码一致，不需要修改！'),
(123, 'zh', 'www', 'pass_save_success', '密码已经更新成功，下次请用新密码登录。'),
(344, 'zh', 'all', 'page_home', '首页'),
(345, 'zh', 'all', 'page_prev', '上一页'),
(346, 'zh', 'all', 'page_next', '下一页'),
(347, 'zh', 'all', 'page_last', '尾页'),
(348, 'zh', 'all', 'not_popedom', '您没有此权限！'),
(349, 'zh', 'www', 'logout_user_success', '成功退出');

-- --------------------------------------------------------

--
-- 表的结构 `yuantest_list`
--

CREATE TABLE IF NOT EXISTS `yuantest_list` (
  `id` int(10) unsigned NOT NULL COMMENT '自增ID',
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
  `jili` varchar(200) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `yuantest_list`
--

INSERT INTO `yuantest_list` (`id`, `module_id`, `cate_id`, `title`, `subtitle`, `style`, `status`, `hidden`, `link_url`, `target`, `author`, `author_type`, `keywords`, `description`, `note`, `identifier`, `hits`, `good_hits`, `bad_hits`, `post_date`, `modify_date`, `thumb_id`, `istop`, `isvouch`, `isbest`, `langid`, `points`, `ip`, `replydate`, `taxis`, `htmltype`, `tplfile`, `star`, `yongjin`, `jili`) VALUES
(1, 2, 0, '注册协议', '', '', 1, 0, '', 0, 'YuanAdmin', '', '', '', '', '', 54, 0, 0, 1407889552, 1440386612, 0, 0, 0, 0, 'zh', 0, '127.0.0.1', 0, 0, 'cateid', '', 0, '', ''),
(2, 2, 0, '活动细则', '', '', 1, 0, '', 0, 'YuanAdmin', '', '', '', '', '', 105, 0, 0, 1407889644, 1440386624, 0, 0, 0, 0, 'zh', 0, '127.0.0.1', 0, 0, 'cateid', '', 0, '', ''),
(3, 2, 0, '推荐流程', '', '', 1, 0, '', 0, 'YuanAdmin', '', '', '', '', '', 0, 0, 0, 1407889679, 1407918347, 0, 0, 0, 0, 'zh', 0, '127.0.0.1', 0, 0, 'cateid', '', 0, '', ''),
(11, 3, 0, '四海逸家2期', '', '', 1, 0, 'http://127.0.0.1:8080/upfiles/201508/24/2be7e594e0247786.jpg', 0, 'YuanAdmin', '', '', '', '', '', 0, 0, 0, 1440387143, 1440387597, 21, 0, 0, 0, 'zh', 0, '127.0.0.1', 0, 0, 'cateid', '', 0, '5000', '到访奖励200元'),
(10, 3, 0, '四海逸家1期', '', '', 1, 0, 'http://127.0.0.1:8080/upfiles/201508/24/2be7e594e0247786.jpg', 0, 'YuanAdmin', '', '', '', '', '', 0, 0, 0, 1440387091, 1440387605, 21, 0, 0, 0, 'zh', 0, '127.0.0.1', 0, 0, 'cateid', '', 0, '3000', '到访奖励100元');

-- --------------------------------------------------------

--
-- 表的结构 `yuantest_list_c`
--

CREATE TABLE IF NOT EXISTS `yuantest_list_c` (
  `id` int(10) unsigned NOT NULL COMMENT '主题ID',
  `field` varchar(30) NOT NULL DEFAULT '' COMMENT '字段名',
  `val` text NOT NULL COMMENT '内容'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `yuantest_list_c`
--

INSERT INTO `yuantest_list_c` (`id`, `field`, `val`) VALUES
(1, 'content', '这里是注册协议。'),
(10, 'content', ''),
(11, 'content', ''),
(2, 'content', '这里是活动细则。'),
(3, 'content', '推荐流程');

-- --------------------------------------------------------

--
-- 表的结构 `yuantest_module`
--

CREATE TABLE IF NOT EXISTS `yuantest_module` (
  `id` mediumint(8) unsigned NOT NULL COMMENT '自增ID',
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
  `layout` varchar(255) NOT NULL COMMENT '后台布局设置'
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `yuantest_module`
--

INSERT INTO `yuantest_module` (`id`, `group_id`, `langid`, `identifier`, `title`, `note`, `ctrl_init`, `status`, `taxis`, `if_system`, `if_cate`, `if_biz`, `if_propety`, `if_hits`, `popedom`, `if_thumb`, `if_thumb_m`, `if_point`, `if_url_m`, `inpic`, `insearch`, `if_content`, `if_email`, `link_id`, `search_id`, `psize`, `if_subtitle`, `ico`, `small_pic`, `medium_pic`, `big_pic`, `tplset`, `title_nickname`, `subtitle_nickname`, `sign_nickname`, `if_sign_m`, `if_ext`, `if_des`, `if_list`, `if_msg`, `layout`) VALUES
(16, 1, 'zh', 'module', '模块管理', '', 'ctrl', 1, 16, 1, 0, 0, 0, 0, '', 0, 0, 0, 0, '', 0, 0, 0, 0, '', 30, 0, '', '', '', '', 'list', '', '', '', 0, 1, 1, 1, 1, ''),
(8, 1, 'zh', 'setting', '网站信息', '', 'setting', 1, 8, 1, 0, 0, 0, 0, '8', 0, 0, 0, 0, '', 0, 0, 0, 0, '', 30, 0, '', '', '', '', 'list', '', '', '', 0, 1, 1, 1, 1, ''),
(13, 1, 'zh', 'mypass', '修改密码', '', 'mypass', 1, 13, 1, 0, 0, 0, 0, '8', 0, 0, 0, 0, '', 0, 0, 0, 0, '', 30, 0, '', '', '', '', 'list', '', '', '', 0, 1, 1, 1, 1, ''),
(3, 3, 'zh', 'projects', '项目管理', '', 'list', 1, 3, 0, 0, 0, 0, 1, '7,3,4,5,6', 1, 1, 0, 1, '', 1, 1, 0, 0, '', 30, 0, '', '', '', '', 'list', '', '', '', 0, 1, 0, 1, 1, 'hits'),
(7, 4, 'zh', 'customer', '客户管理', '', 'customer', 1, 7, 0, 0, 0, 0, 0, '7,3', 0, 0, 0, 0, '', 0, 0, 0, 0, '', 30, 0, '', '', '', '', 'list', '', '', '', 0, 1, 1, 1, 1, ''),
(14, 1, 'zh', 'tpl', '前台风格', '', 'tpl', 1, 14, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '', 0, 0, 0, 0, '', 30, 0, '', '', '', '', 'list', '', '', '', 0, 1, 1, 1, 1, ''),
(15, 1, 'zh', 'lang', '语言设置', '', 'lang', 0, 15, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '', 0, 0, 0, 0, '', 30, 0, '', '', '', '', 'list', '', '', '', 0, 1, 1, 1, 1, ''),
(6, 6, 'zh', 'user', '会员列表', '', 'user', 1, 6, 0, 0, 0, 0, 0, '7,3,4,5,6', 0, 0, 0, 0, '', 0, 0, 0, 0, '', 30, 0, '', '', '', '', 'list', '', '', '', 0, 1, 1, 1, 1, ''),
(10, 1, 'zh', 'admin', '管理权限', '', 'admin', 1, 10, 0, 0, 0, 0, 0, '7,3,4,5,6', 0, 0, 0, 0, '', 0, 0, 0, 0, '', 30, 0, '', '', '', '', 'list', '', '', '', 0, 1, 1, 1, 1, ''),
(9, 6, 'zh', 'commission', '佣金明细', '', 'commission', 1, 9, 0, 0, 0, 0, 0, '7,3,4,5,6', 0, 0, 0, 0, '', 0, 0, 0, 0, '', 30, 0, '', '', '', '', 'list', '', '', '', 0, 1, 1, 1, 1, ''),
(2, 3, 'zh', 'onepage', '单页管理', '', 'list', 1, 2, 0, 0, 0, 0, 0, '7,3,4,5,6', 0, 0, 0, 0, 'thumb', 0, 0, 0, 0, '', 30, 0, '', '', '', '', 'list', '', '', '', 0, 0, 0, 0, 1, ''),
(11, 1, 'zh', 'gd', '图片设置', '', 'gd', 1, 11, 0, 0, 0, 0, 0, '7,4', 0, 0, 0, 0, '', 0, 0, 0, 0, '', 30, 0, '', '', '', '', 'list', '', '', '', 0, 1, 1, 1, 1, ''),
(4, 3, 'zh', 'files', '附件管理', '', 'files', 1, 4, 0, 0, 0, 0, 0, '7,6', 0, 0, 0, 0, '', 0, 0, 0, 0, '', 30, 0, '', '', '', '', 'list', '', '', '', 0, 1, 1, 1, 1, ''),
(1, 0, 'zh', 'home', '后台首页', '', 'home', 1, 1, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '', 0, 0, 0, 0, '', 30, 0, '', '', '', '', 'list', '', '', '', 0, 1, 1, 1, 1, ''),
(12, 1, 'zh', 'phpoksql', '数据备份', '', 'phpoksql', 1, 12, 0, 0, 0, 0, 0, '7,8', 0, 0, 0, 0, '', 0, 0, 0, 0, '', 30, 0, '', '', '', '', 'list', '', '', '', 0, 1, 1, 1, 1, ''),
(5, 6, 'zh', 'usergroup', '会员组别', '', 'usergroup', 1, 5, 0, 0, 0, 0, 0, '7,3,4,6', 0, 0, 0, 0, '', 0, 0, 0, 0, '', 30, 0, '', '', '', '', 'list', '', '', '', 0, 1, 1, 1, 1, ''),
(17, 6, 'zh', 'excel_user', '导出会员', '', 'excel_user', 1, 17, 0, 0, 0, 0, 0, '7', 0, 0, 0, 0, '', 0, 0, 0, 0, '', 30, 0, '', '', '', '', 'list', '', '', '', 0, 1, 1, 1, 1, '');

-- --------------------------------------------------------

--
-- 表的结构 `yuantest_module_fields`
--

CREATE TABLE IF NOT EXISTS `yuantest_module_fields` (
  `id` mediumint(8) unsigned NOT NULL COMMENT '自增ID',
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
  `if_search` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否允许搜索'
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `yuantest_module_fields`
--

INSERT INTO `yuantest_module_fields` (`id`, `module_id`, `identifier`, `title`, `if_post`, `if_guest`, `sub_left`, `sub_note`, `input`, `width`, `height`, `default_val`, `list_val`, `link_id`, `taxis`, `if_must`, `if_html`, `error_note`, `status`, `if_system`, `tbl`, `show_html`, `if_js`, `if_search`) VALUES
(1, 2, 'content', '内容', 0, 0, '', '', 'edit', '650px', '400px', '', '', 0, 1, 1, 1, '请输入内容', 1, 0, 'c', 0, 1, 0),
(2, 3, 'content', '内容', 0, 0, '', '', 'edit', '650px', '400px', '', '', 0, 2, 0, 1, '请输入内容', 1, 0, 'c', 0, 1, 0);

-- --------------------------------------------------------

--
-- 表的结构 `yuantest_module_group`
--

CREATE TABLE IF NOT EXISTS `yuantest_module_group` (
  `id` mediumint(8) unsigned NOT NULL COMMENT '自增ID',
  `langid` varchar(32) NOT NULL DEFAULT 'zh' COMMENT '语言编号，如zh,en等',
  `title` varchar(100) NOT NULL COMMENT '组名称',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0不使用1使用',
  `taxis` tinyint(3) unsigned NOT NULL DEFAULT '255' COMMENT '值越小越往靠，最小为0',
  `js_function` varchar(100) NOT NULL DEFAULT '' COMMENT 'JS控制器，为空使用系统自动生成',
  `if_system` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1系统0自定义'
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `yuantest_module_group`
--

INSERT INTO `yuantest_module_group` (`id`, `langid`, `title`, `status`, `taxis`, `js_function`, `if_system`) VALUES
(1, 'zh', '网站配置', 1, 4, '', 1),
(2, 'zh', '退出', 1, 7, 'logout', 1),
(3, 'zh', '内容管理', 1, 1, '', 1),
(4, 'zh', '客户管理', 1, 3, '', 1),
(5, 'zh', '网站首页', 1, 6, 'gohome', 1),
(6, 'zh', '会员管理', 1, 2, '', 0),
(7, 'zh', '清空缓存', 1, 5, 'clear_cache', 1);

-- --------------------------------------------------------

--
-- 表的结构 `yuantest_session`
--

CREATE TABLE IF NOT EXISTS `yuantest_session` (
  `id` varchar(32) NOT NULL COMMENT 'session_id',
  `data` text NOT NULL COMMENT 'session 内容',
  `lasttime` int(10) unsigned NOT NULL COMMENT '时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `yuantest_session`
--

INSERT INTO `yuantest_session` (`id`, `data`, `lasttime`) VALUES
('j89204i105e87frl6a2hgfvuh1', 'sys_lang_id|s:2:"zh";admin_id|s:1:"1";admin_name|s:9:"YuanAdmin";admin_realname|s:9:"YuanAdmin";admin_md5|s:32:"9f4b1d03db9ccbd35d0196add001dfcc";', 1440394633);

-- --------------------------------------------------------

--
-- 表的结构 `yuantest_tpl`
--

CREATE TABLE IF NOT EXISTS `yuantest_tpl` (
  `id` mediumint(8) unsigned NOT NULL COMMENT '自增ID号',
  `langid` varchar(5) NOT NULL DEFAULT 'zh' COMMENT '语言ID，默认是zh',
  `title` varchar(100) NOT NULL COMMENT '名称',
  `folder` varchar(50) NOT NULL COMMENT '文件夹',
  `ext` varchar(10) NOT NULL DEFAULT 'html' COMMENT '模板后缀',
  `autoimg` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否自动解析图片地址',
  `ifdefault` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否默认',
  `ifsystem` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1系统模板0用户模板',
  `taxis` tinyint(3) unsigned NOT NULL DEFAULT '255' COMMENT '排序',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1正在使用0未使用'
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `yuantest_tpl`
--

INSERT INTO `yuantest_tpl` (`id`, `langid`, `title`, `folder`, `ext`, `autoimg`, `ifdefault`, `ifsystem`, `taxis`, `status`) VALUES
(1, 'zh', '前台默认风格', 'www', 'html', 1, 1, 0, 1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `yuantest_upfiles`
--

CREATE TABLE IF NOT EXISTS `yuantest_upfiles` (
  `id` mediumint(8) unsigned NOT NULL COMMENT '图片ID',
  `title` varchar(100) NOT NULL COMMENT '标题',
  `filename` varchar(255) NOT NULL COMMENT '图片路径，基于网站根目录的相对路径',
  `thumb` varchar(255) NOT NULL COMMENT '缩略图路径，基于网站根目录的相对路径',
  `postdate` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上传时间',
  `ftype` varchar(10) NOT NULL COMMENT '附件类型',
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '会员ID号，0表示管理员上传',
  `flv_pic` varchar(255) NOT NULL COMMENT 'FLV封面图片',
  `sessid` varchar(50) NOT NULL COMMENT '游客上传标识串'
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `yuantest_upfiles`
--

INSERT INTO `yuantest_upfiles` (`id`, `title`, `filename`, `thumb`, `postdate`, `ftype`, `uid`, `flv_pic`, `sessid`) VALUES
(21, '四海.png', 'upfiles/201508/24/0816d77a49d95297.png', 'upfiles/201508/24/thumb21.png', 1440387513, 'png', 0, '', ''),
(20, '四海03.jpg', 'upfiles/201508/24/2be7e594e0247786.jpg', 'upfiles/201508/24/thumb20.jpg', 1440387076, 'jpg', 0, '', ''),
(19, '四海02.jpg', 'upfiles/201508/24/965b54a9c32d90a5.jpg', 'upfiles/201508/24/thumb19.jpg', 1440387059, 'jpg', 0, '', ''),
(18, '四海01.jpg', 'upfiles/201508/24/644e9855f34ced76.jpg', 'upfiles/201508/24/thumb18.jpg', 1440387042, 'jpg', 0, '', ''),
(17, '微信分享.png', 'upfiles/201508/24/aefc1453f0a85c4e.png', 'upfiles/201508/24/thumb17.png', 1440386670, 'png', 0, '', '');

-- --------------------------------------------------------

--
-- 表的结构 `yuantest_upfiles_gd`
--

CREATE TABLE IF NOT EXISTS `yuantest_upfiles_gd` (
  `pid` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '图片ID，对应upfiles里的ID',
  `gdtype` varchar(100) NOT NULL COMMENT '图片类型',
  `filename` varchar(255) NOT NULL COMMENT '图片地址（生成类型的图片地址）'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `yuantest_upfiles_gd`
--

INSERT INTO `yuantest_upfiles_gd` (`pid`, `gdtype`, `filename`) VALUES
(21, 'mid', 'upfiles/201508/24/mid_21.png'),
(21, 'big', 'upfiles/201508/24/big_21.png'),
(21, 'thumb', 'upfiles/201508/24/thumb_21.png'),
(20, 'mid', 'upfiles/201508/24/mid_20.jpg'),
(20, 'big', 'upfiles/201508/24/big_20.jpg'),
(20, 'thumb', 'upfiles/201508/24/thumb_20.jpg'),
(19, 'mid', 'upfiles/201508/24/mid_19.jpg'),
(19, 'big', 'upfiles/201508/24/big_19.jpg'),
(19, 'thumb', 'upfiles/201508/24/thumb_19.jpg'),
(18, 'mid', 'upfiles/201508/24/mid_18.jpg'),
(18, 'big', 'upfiles/201508/24/big_18.jpg'),
(18, 'thumb', 'upfiles/201508/24/thumb_18.jpg'),
(17, 'mid', 'upfiles/201508/24/mid_17.png'),
(17, 'big', 'upfiles/201508/24/big_17.png'),
(17, 'thumb', 'upfiles/201508/24/thumb_17.png');

-- --------------------------------------------------------

--
-- 表的结构 `yuantest_user`
--

CREATE TABLE IF NOT EXISTS `yuantest_user` (
  `id` mediumint(8) unsigned NOT NULL COMMENT '自增ID',
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
  `bankName` varchar(100) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `yuantest_user`
--

INSERT INTO `yuantest_user` (`id`, `groupid`, `username`, `pass`, `phone`, `regdate`, `status`, `fxstatus`, `job`, `company`, `thumb_id`, `bankAccount`, `cardCode`, `bankName`) VALUES
(33, 2, '测试员01', '14e1b600b1fd579f47433b88e8d85291', '13111111111', 1440387240, 1, 0, 'WXFS', '', 0, '', '', '');

-- --------------------------------------------------------

--
-- 表的结构 `yuantest_user_group`
--

CREATE TABLE IF NOT EXISTS `yuantest_user_group` (
  `id` mediumint(8) unsigned NOT NULL COMMENT '会员组ID',
  `group_type` enum('user','guest') NOT NULL DEFAULT 'user' COMMENT '用户组类型',
  `title` varchar(100) NOT NULL COMMENT '组名称',
  `popedom_post` text NOT NULL COMMENT '发布权限',
  `popedom_reply` text NOT NULL COMMENT '回复权限',
  `popedom_read` text NOT NULL COMMENT '阅读权限，默认为all',
  `post_cert` tinyint(1) NOT NULL DEFAULT '0' COMMENT '发布0需要验证1免验证',
  `reply_cert` tinyint(1) NOT NULL DEFAULT '0' COMMENT '回复0需要验证1免验证',
  `ifsystem` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否系统组0否1是',
  `ifdefault` tinyint(1) NOT NULL DEFAULT '0' COMMENT '会员注册后默认选择的组'
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `yuantest_user_group`
--

INSERT INTO `yuantest_user_group` (`id`, `group_type`, `title`, `popedom_post`, `popedom_reply`, `popedom_read`, `post_cert`, `reply_cert`, `ifsystem`, `ifdefault`) VALUES
(1, 'guest', '游客', '', '', 'all', 0, 0, 1, 1),
(2, 'user', '初级合伙人', '', '', 'all', 1, 0, 1, 1),
(3, 'user', '金牌合伙人', '', '', '', 0, 0, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `yuantest_admin`
--
ALTER TABLE `yuantest_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `yuantest_cache`
--
ALTER TABLE `yuantest_cache`
  ADD PRIMARY KEY (`id`,`langid`);

--
-- Indexes for table `yuantest_cate`
--
ALTER TABLE `yuantest_cate`
  ADD PRIMARY KEY (`id`),
  ADD KEY `module_id` (`module_id`);

--
-- Indexes for table `yuantest_commission`
--
ALTER TABLE `yuantest_commission`
  ADD PRIMARY KEY (`id`),
  ADD KEY `listid` (`uid`);

--
-- Indexes for table `yuantest_customer`
--
ALTER TABLE `yuantest_customer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `listid` (`uid`);

--
-- Indexes for table `yuantest_gd`
--
ALTER TABLE `yuantest_gd`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `yuantest_identifier`
--
ALTER TABLE `yuantest_identifier`
  ADD PRIMARY KEY (`id`),
  ADD KEY `module_id` (`module_id`);

--
-- Indexes for table `yuantest_input`
--
ALTER TABLE `yuantest_input`
  ADD PRIMARY KEY (`input`);

--
-- Indexes for table `yuantest_lang`
--
ALTER TABLE `yuantest_lang`
  ADD PRIMARY KEY (`langid`);

--
-- Indexes for table `yuantest_lang_msg`
--
ALTER TABLE `yuantest_lang_msg`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `yuantest_list`
--
ALTER TABLE `yuantest_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `module_id` (`module_id`,`cate_id`,`title`);

--
-- Indexes for table `yuantest_list_c`
--
ALTER TABLE `yuantest_list_c`
  ADD PRIMARY KEY (`id`,`field`);

--
-- Indexes for table `yuantest_module`
--
ALTER TABLE `yuantest_module`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_id` (`group_id`);

--
-- Indexes for table `yuantest_module_fields`
--
ALTER TABLE `yuantest_module_fields`
  ADD PRIMARY KEY (`id`),
  ADD KEY `module_id` (`module_id`);

--
-- Indexes for table `yuantest_module_group`
--
ALTER TABLE `yuantest_module_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `yuantest_session`
--
ALTER TABLE `yuantest_session`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `yuantest_tpl`
--
ALTER TABLE `yuantest_tpl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `yuantest_upfiles`
--
ALTER TABLE `yuantest_upfiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `yuantest_upfiles_gd`
--
ALTER TABLE `yuantest_upfiles_gd`
  ADD PRIMARY KEY (`pid`,`gdtype`);

--
-- Indexes for table `yuantest_user`
--
ALTER TABLE `yuantest_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `yuantest_user_group`
--
ALTER TABLE `yuantest_user_group`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `yuantest_admin`
--
ALTER TABLE `yuantest_admin`
  MODIFY `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID号',AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `yuantest_cate`
--
ALTER TABLE `yuantest_cate`
  MODIFY `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID号';
--
-- AUTO_INCREMENT for table `yuantest_commission`
--
ALTER TABLE `yuantest_commission`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID号',AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `yuantest_customer`
--
ALTER TABLE `yuantest_customer`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID号',AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `yuantest_gd`
--
ALTER TABLE `yuantest_gd`
  MODIFY `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID号',AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `yuantest_identifier`
--
ALTER TABLE `yuantest_identifier`
  MODIFY `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `yuantest_lang_msg`
--
ALTER TABLE `yuantest_lang_msg`
  MODIFY `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID号',AUTO_INCREMENT=469;
--
-- AUTO_INCREMENT for table `yuantest_list`
--
ALTER TABLE `yuantest_list`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `yuantest_module`
--
ALTER TABLE `yuantest_module`
  MODIFY `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `yuantest_module_fields`
--
ALTER TABLE `yuantest_module_fields`
  MODIFY `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `yuantest_module_group`
--
ALTER TABLE `yuantest_module_group`
  MODIFY `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `yuantest_tpl`
--
ALTER TABLE `yuantest_tpl`
  MODIFY `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID号',AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `yuantest_upfiles`
--
ALTER TABLE `yuantest_upfiles`
  MODIFY `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '图片ID',AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `yuantest_user`
--
ALTER TABLE `yuantest_user`
  MODIFY `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `yuantest_user_group`
--
ALTER TABLE `yuantest_user_group`
  MODIFY `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '会员组ID',AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
