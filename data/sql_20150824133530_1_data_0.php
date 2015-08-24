<?php die('forbidden'); ?>
#PHPOK Full 数据备份


#table : yuantest_admin , backup time 2015-08-24 13:35:32
INSERT INTO yuantest_admin VALUES('1','YuanAdmin','YuanAdmin@YuanAdmin.com','2c9ecf53b6195fda274f2f3ce6e93d2b','1','1','','');

#table : yuantest_customer , backup time 2015-08-24 13:35:40
INSERT INTO yuantest_customer VALUES('22','33','测试员01','客户01','13222222222','四海逸家1期','2015-08-31','11:35','','','','','1440387369','','','','','','','','','','');

#table : yuantest_gd , backup time 2015-08-24 13:35:42
INSERT INTO yuantest_gd VALUES('1','thumb','头像缩图','75','75','','middle-middle','50','','80','','','','CD332C','','1','1','');
INSERT INTO yuantest_gd VALUES('3','big','大图','600','600','','bottom-right','70','2','80','','','','FFFFFF','','1','2','1');
INSERT INTO yuantest_gd VALUES('2','mid','项目标志','282','120','','middle-middle','50','1','60','','','','CD332C','','1','2','');

#table : yuantest_identifier , backup time 2015-08-24 13:35:44
INSERT INTO yuantest_identifier VALUES('1','popedom','权限管理','zh','1','1','','255');
INSERT INTO yuantest_identifier VALUES('2','module','模块管理','zh','2','1','','255');
INSERT INTO yuantest_identifier VALUES('3','add','添加','zh','','1','popedom','201');
INSERT INTO yuantest_identifier VALUES('4','modify','修改','zh','','1','popedom','202');
INSERT INTO yuantest_identifier VALUES('5','check','审核','zh','','1','popedom','203');
INSERT INTO yuantest_identifier VALUES('6','delete','删除','zh','','1','popedom','204');
INSERT INTO yuantest_identifier VALUES('7','list','查看','zh','','1','popedom','200');
INSERT INTO yuantest_identifier VALUES('8','setting','设置','zh','','1','popedom','205');
INSERT INTO yuantest_identifier VALUES('9','save','存储','zh','','1','popedom','206');
INSERT INTO yuantest_identifier VALUES('10','group','组管理','zh','','1','popedom','255');

#table : yuantest_input , backup time 2015-08-24 13:35:46
INSERT INTO yuantest_input VALUES('text','zh','文本框','10','1');
INSERT INTO yuantest_input VALUES('radio','zh','单选框','20','1');
INSERT INTO yuantest_input VALUES('checkbox','zh','复选框','30','1');
INSERT INTO yuantest_input VALUES('textarea','zh','文本区域','40','1');
INSERT INTO yuantest_input VALUES('edit','zh','可视化编辑器','50','');
INSERT INTO yuantest_input VALUES('select','zh','下拉菜单','60','1');
INSERT INTO yuantest_input VALUES('img','zh','图片选择器','70','1');
INSERT INTO yuantest_input VALUES('video','zh','影音选择器','80','1');
INSERT INTO yuantest_input VALUES('download','zh','下载框选择器','90','1');
INSERT INTO yuantest_input VALUES('opt','zh','联动选择','100','1');
INSERT INTO yuantest_input VALUES('simg','zh','图片选择器（单张）','75','1');
INSERT INTO yuantest_input VALUES('module','zh','内联模块','110','');

#table : yuantest_lang , backup time 2015-08-24 13:35:49
INSERT INTO yuantest_lang VALUES('zh','简体中文','1','','1','1','1','','','','');

#table : yuantest_lang_msg , backup time 2015-08-24 13:35:51
INSERT INTO yuantest_lang_msg VALUES('1','zh','admin','cp_name','后台管理');
INSERT INTO yuantest_lang_msg VALUES('2','zh','all','error_note','如果系统不能在 <span style=\"color:red;\">{time}</span> 秒后自动返回，请点这里');
INSERT INTO yuantest_lang_msg VALUES('11','zh','admin','select_cate','请选择分类');
INSERT INTO yuantest_lang_msg VALUES('4','zh','admin','no_popedom','Error: 对不起，您没有操作此功能权限');
INSERT INTO yuantest_lang_msg VALUES('5','zh','admin','login_false','管理员登录失败，请检查…');
INSERT INTO yuantest_lang_msg VALUES('6','zh','admin','login_not_user_pass','账号或密码不能为空');
INSERT INTO yuantest_lang_msg VALUES('7','zh','admin','login_success','欢迎您 <span style=\'color:red;\'>{admin_realname}</span> 登录网站系统后台，请稍候…');
INSERT INTO yuantest_lang_msg VALUES('8','zh','all','login_vcode_empty','验证码不能为空');
INSERT INTO yuantest_lang_msg VALUES('9','zh','all','login_vcode_false','验证码填写错误');
INSERT INTO yuantest_lang_msg VALUES('10','zh','admin','logout_success','管理员 <span style=\'color:red;\'>{admin_realname}</span> 成功退出！');
INSERT INTO yuantest_lang_msg VALUES('23','zh','www','login_false_empty','登录失败，账号或密码为空！');
INSERT INTO yuantest_lang_msg VALUES('24','zh','www','login_false_rs','登录失败，会员信息不存在，请检查。');
INSERT INTO yuantest_lang_msg VALUES('25','zh','www','login_false_password','登录失败，会员密码不正确。');
INSERT INTO yuantest_lang_msg VALUES('26','zh','www','login_false_lock','登录失败，会员账号已被管理员锁定，请联系管理员。');
INSERT INTO yuantest_lang_msg VALUES('27','zh','www','login_false_check','登录失败，您的账号尚未激活！');
INSERT INTO yuantest_lang_msg VALUES('28','zh','www','login_usccess','您的账号已经正常登录，请稍候……');
INSERT INTO yuantest_lang_msg VALUES('29','zh','www','login_exists','您已经登录，请返回…');
INSERT INTO yuantest_lang_msg VALUES('30','zh','www','module_is_close','模块未启用');
INSERT INTO yuantest_lang_msg VALUES('31','zh','www','not_any_title_in_module','没有任何相关主题');
INSERT INTO yuantest_lang_msg VALUES('32','zh','www','not_found_any_module','没有找到模块信息！');
INSERT INTO yuantest_lang_msg VALUES('34','zh','www','not_any_cate_in_module','当前模块中没有任何分类信息');
INSERT INTO yuantest_lang_msg VALUES('59','zh','www','download_error','没有指定附件信息！');
INSERT INTO yuantest_lang_msg VALUES('60','zh','www','download_empty','附件已经不存在！');
INSERT INTO yuantest_lang_msg VALUES('61','zh','www','login','合伙人登录');
INSERT INTO yuantest_lang_msg VALUES('63','zh','www','login_user_email_chk','账号或邮箱不允许为空！');
INSERT INTO yuantest_lang_msg VALUES('64','zh','www','login_not_user_email','账号不存在或是邮箱填写不正确！');
INSERT INTO yuantest_lang_msg VALUES('467','zh','www','recommend','推荐客户');
INSERT INTO yuantest_lang_msg VALUES('468','zh','www','customer','我的客户');
INSERT INTO yuantest_lang_msg VALUES('67','zh','www','login_not_code_user','会员账号或验证串不允许为空');
INSERT INTO yuantest_lang_msg VALUES('68','zh','www','login_not_user','账号不存在！');
INSERT INTO yuantest_lang_msg VALUES('71','zh','www','login_not_pass','密码不允许为空！');
INSERT INTO yuantest_lang_msg VALUES('72','zh','www','login_error_pass','两次输入的密码不一致！');
INSERT INTO yuantest_lang_msg VALUES('73','zh','www','login_update','会员密码更新成功！');
INSERT INTO yuantest_lang_msg VALUES('74','zh','www','msg_not_id','获取数据失败，没有指定主题标识串或ID');
INSERT INTO yuantest_lang_msg VALUES('75','zh','www','msg_not_rs','无法获取内容信息，请检查');
INSERT INTO yuantest_lang_msg VALUES('76','zh','www','open_user','非会员不支持此功能！');
INSERT INTO yuantest_lang_msg VALUES('77','zh','all','open_not_picture','批量生成图片错误，没有取得一张有效图片');
INSERT INTO yuantest_lang_msg VALUES('78','zh','all','open_not_id','没有指定要生成的图片ID');
INSERT INTO yuantest_lang_msg VALUES('79','zh','all','open_pl_ok','图片批量生成完毕');
INSERT INTO yuantest_lang_msg VALUES('80','zh','all','open_pl_wait','请稍候，系统正在批量生成新的图片方案');
INSERT INTO yuantest_lang_msg VALUES('81','zh','all','open_not_pre_id','没有选择要预览的ID');
INSERT INTO yuantest_lang_msg VALUES('82','zh','www','please_login','请先登录！');
INSERT INTO yuantest_lang_msg VALUES('83','zh','www','usercp','会员中心');
INSERT INTO yuantest_lang_msg VALUES('86','zh','all','error','操作有错误，请检查！');
INSERT INTO yuantest_lang_msg VALUES('93','zh','all','all_category','全部分类');
INSERT INTO yuantest_lang_msg VALUES('94','zh','all','category_select','请选择分类');
INSERT INTO yuantest_lang_msg VALUES('97','zh','all','error_save','数据存储失败，请检查！');
INSERT INTO yuantest_lang_msg VALUES('98','zh','all','save_success','数据存储成功，请稍候…');
INSERT INTO yuantest_lang_msg VALUES('99','zh','all','del_not_id','error：删除失败，没有指定ID');
INSERT INTO yuantest_lang_msg VALUES('101','zh','www','is_logined','您已经登录了，不能使用注册功能');
INSERT INTO yuantest_lang_msg VALUES('102','zh','all','register','合伙人注册');
INSERT INTO yuantest_lang_msg VALUES('103','zh','www','empty_pass','密码不允许为空！');
INSERT INTO yuantest_lang_msg VALUES('104','zh','www','pass_not_right','两次输入的密码不一致');
INSERT INTO yuantest_lang_msg VALUES('106','zh','www','register_ok','恭喜您注册成为我们的合伙人');
INSERT INTO yuantest_lang_msg VALUES('107','zh','www','user_exists','账号已经存在');
INSERT INTO yuantest_lang_msg VALUES('108','zh','www','empty_user','账号不允许为空');
INSERT INTO yuantest_lang_msg VALUES('109','zh','all','error_not_id','error：操作错误，没有取得ID信息');
INSERT INTO yuantest_lang_msg VALUES('110','zh','all','error_not_rs','error：操作错误，没有取得数据信息');
INSERT INTO yuantest_lang_msg VALUES('114','zh','all','search','站内搜索');
INSERT INTO yuantest_lang_msg VALUES('116','zh','www','user_not_login','非会员不允许执行此操作，请先登录！');
INSERT INTO yuantest_lang_msg VALUES('117','zh','www','usercp_info','修改资料');
INSERT INTO yuantest_lang_msg VALUES('118','zh','www','usercp_save_success','会员信息更新成功！');
INSERT INTO yuantest_lang_msg VALUES('119','zh','www','usercp_changepass','修改个人密码');
INSERT INTO yuantest_lang_msg VALUES('120','zh','www','usercp_not_oldpass','旧密码为空或是旧密码填写不正确！');
INSERT INTO yuantest_lang_msg VALUES('121','zh','www','usercp_not_newpass','新密码不允许为空或是两次输入的新密码不一致！');
INSERT INTO yuantest_lang_msg VALUES('122','zh','www','usercp_old_new','新旧密码一致，不需要修改！');
INSERT INTO yuantest_lang_msg VALUES('123','zh','www','pass_save_success','密码已经更新成功，下次请用新密码登录。');
INSERT INTO yuantest_lang_msg VALUES('344','zh','all','page_home','首页');
INSERT INTO yuantest_lang_msg VALUES('345','zh','all','page_prev','上一页');
INSERT INTO yuantest_lang_msg VALUES('346','zh','all','page_next','下一页');
INSERT INTO yuantest_lang_msg VALUES('347','zh','all','page_last','尾页');
INSERT INTO yuantest_lang_msg VALUES('348','zh','all','not_popedom','您没有此权限！');
INSERT INTO yuantest_lang_msg VALUES('349','zh','www','logout_user_success','成功退出');

#table : yuantest_list , backup time 2015-08-24 13:35:53
INSERT INTO yuantest_list VALUES('1','2','','注册协议','','','1','','','','YuanAdmin','','','','','','54','','','1407889552','1440386612','','','','','zh','','127.0.0.1','','','cateid','','','','');
INSERT INTO yuantest_list VALUES('2','2','','活动细则','','','1','','','','YuanAdmin','','','','','','105','','','1407889644','1440386624','','','','','zh','','127.0.0.1','','','cateid','','','','');
INSERT INTO yuantest_list VALUES('3','2','','推荐流程','','','1','','','','YuanAdmin','','','','','','','','','1407889679','1407918347','','','','','zh','','127.0.0.1','','','cateid','','','','');
INSERT INTO yuantest_list VALUES('11','3','','四海逸家2期','','','1','','http://127.0.0.1:8080/upfiles/201508/24/2be7e594e0247786.jpg','','YuanAdmin','','','','','','','','','1440387143','1440387597','21','','','','zh','','127.0.0.1','','','cateid','','','5000','到访奖励200元');
INSERT INTO yuantest_list VALUES('10','3','','四海逸家1期','','','1','','http://127.0.0.1:8080/upfiles/201508/24/2be7e594e0247786.jpg','','YuanAdmin','','','','','','','','','1440387091','1440387605','21','','','','zh','','127.0.0.1','','','cateid','','','3000','到访奖励100元');

#table : yuantest_list_c , backup time 2015-08-24 13:35:55
INSERT INTO yuantest_list_c VALUES('1','content','这里是注册协议。');
INSERT INTO yuantest_list_c VALUES('10','content','');
INSERT INTO yuantest_list_c VALUES('11','content','');
INSERT INTO yuantest_list_c VALUES('2','content','这里是活动细则。');
INSERT INTO yuantest_list_c VALUES('3','content','推荐流程');

#table : yuantest_module , backup time 2015-08-24 13:35:57
INSERT INTO yuantest_module VALUES('16','1','zh','module','模块管理','','ctrl','1','16','1','','','','','','','','','','','','','','','','30','','','','','','list','','','','','1','1','1','1','');
INSERT INTO yuantest_module VALUES('8','1','zh','setting','网站信息','','setting','1','8','1','','','','','8','','','','','','','','','','','30','','','','','','list','','','','','1','1','1','1','');
INSERT INTO yuantest_module VALUES('13','1','zh','mypass','修改密码','','mypass','1','13','1','','','','','8','','','','','','','','','','','30','','','','','','list','','','','','1','1','1','1','');
INSERT INTO yuantest_module VALUES('3','3','zh','projects','项目管理','','list','1','3','','','','','1','7,3,4,5,6','1','1','','1','','1','1','','','','30','','','','','','list','','','','','1','','1','1','hits');
INSERT INTO yuantest_module VALUES('7','4','zh','customer','客户管理','','customer','1','7','','','','','','7,3','','','','','','','','','','','30','','','','','','list','','','','','1','1','1','1','');
INSERT INTO yuantest_module VALUES('14','1','zh','tpl','前台风格','','tpl','1','14','','','','','','','','','','','','','','','','','30','','','','','','list','','','','','1','1','1','1','');
INSERT INTO yuantest_module VALUES('15','1','zh','lang','语言设置','','lang','','15','','','','','','','','','','','','','','','','','30','','','','','','list','','','','','1','1','1','1','');
INSERT INTO yuantest_module VALUES('6','6','zh','user','会员列表','','user','1','6','','','','','','7,3,4,5,6','','','','','','','','','','','30','','','','','','list','','','','','1','1','1','1','');
INSERT INTO yuantest_module VALUES('10','1','zh','admin','管理权限','','admin','1','10','','','','','','7,3,4,5,6','','','','','','','','','','','30','','','','','','list','','','','','1','1','1','1','');
INSERT INTO yuantest_module VALUES('9','6','zh','commission','佣金明细','','commission','1','9','','','','','','7,3,4,5,6','','','','','','','','','','','30','','','','','','list','','','','','1','1','1','1','');
INSERT INTO yuantest_module VALUES('2','3','zh','onepage','单页管理','','list','1','2','','','','','','7,3,4,5,6','','','','','thumb','','','','','','30','','','','','','list','','','','','','','','1','');
INSERT INTO yuantest_module VALUES('11','1','zh','gd','图片设置','','gd','1','11','','','','','','7,4','','','','','','','','','','','30','','','','','','list','','','','','1','1','1','1','');
INSERT INTO yuantest_module VALUES('4','3','zh','files','附件管理','','files','1','4','','','','','','7,6','','','','','','','','','','','30','','','','','','list','','','','','1','1','1','1','');
INSERT INTO yuantest_module VALUES('1','','zh','home','后台首页','','home','1','1','','','','','','','','','','','','','','','','','30','','','','','','list','','','','','1','1','1','1','');
INSERT INTO yuantest_module VALUES('12','1','zh','phpoksql','数据备份','','phpoksql','1','12','','','','','','7,8','','','','','','','','','','','30','','','','','','list','','','','','1','1','1','1','');
INSERT INTO yuantest_module VALUES('5','6','zh','usergroup','会员组别','','usergroup','1','5','','','','','','7,3,4,6','','','','','','','','','','','30','','','','','','list','','','','','1','1','1','1','');
INSERT INTO yuantest_module VALUES('17','6','zh','excel_user','导出会员','','excel_user','1','17','','','','','','7','','','','','','','','','','','30','','','','','','list','','','','','1','1','1','1','');

#table : yuantest_module_fields , backup time 2015-08-24 13:35:59
INSERT INTO yuantest_module_fields VALUES('1','2','content','内容','','','','','edit','650px','400px','','','','1','1','1','请输入内容','1','','c','','1','');
INSERT INTO yuantest_module_fields VALUES('2','3','content','内容','','','','','edit','650px','400px','','','','2','','1','请输入内容','1','','c','','1','');

#table : yuantest_module_group , backup time 2015-08-24 13:36:01
INSERT INTO yuantest_module_group VALUES('1','zh','网站配置','1','4','','1');
INSERT INTO yuantest_module_group VALUES('2','zh','退出','1','7','logout','1');
INSERT INTO yuantest_module_group VALUES('3','zh','内容管理','1','1','','1');
INSERT INTO yuantest_module_group VALUES('4','zh','客户管理','1','3','','1');
INSERT INTO yuantest_module_group VALUES('5','zh','网站首页','1','6','gohome','1');
INSERT INTO yuantest_module_group VALUES('6','zh','会员管理','1','2','','');
INSERT INTO yuantest_module_group VALUES('7','zh','清空缓存','1','5','clear_cache','1');

#table : yuantest_session , backup time 2015-08-24 13:36:03
INSERT INTO yuantest_session VALUES('j89204i105e87frl6a2hgfvuh1','sys_lang_id|s:2:\"zh\";admin_id|s:1:\"1\";admin_name|s:9:\"YuanAdmin\";admin_realname|s:9:\"YuanAdmin\";admin_md5|s:32:\"9f4b1d03db9ccbd35d0196add001dfcc\";','1440394562');

#table : yuantest_tpl , backup time 2015-08-24 13:36:05
INSERT INTO yuantest_tpl VALUES('1','zh','前台默认风格','www','html','1','1','','1','1');

#table : yuantest_upfiles , backup time 2015-08-24 13:36:07
INSERT INTO yuantest_upfiles VALUES('21','四海.png','upfiles/201508/24/0816d77a49d95297.png','upfiles/201508/24/thumb21.png','1440387513','png','','','');
INSERT INTO yuantest_upfiles VALUES('20','四海03.jpg','upfiles/201508/24/2be7e594e0247786.jpg','upfiles/201508/24/thumb20.jpg','1440387076','jpg','','','');
INSERT INTO yuantest_upfiles VALUES('19','四海02.jpg','upfiles/201508/24/965b54a9c32d90a5.jpg','upfiles/201508/24/thumb19.jpg','1440387059','jpg','','','');
INSERT INTO yuantest_upfiles VALUES('18','四海01.jpg','upfiles/201508/24/644e9855f34ced76.jpg','upfiles/201508/24/thumb18.jpg','1440387042','jpg','','','');
INSERT INTO yuantest_upfiles VALUES('17','微信分享.png','upfiles/201508/24/aefc1453f0a85c4e.png','upfiles/201508/24/thumb17.png','1440386670','png','','','');

#table : yuantest_upfiles_gd , backup time 2015-08-24 13:36:09
INSERT INTO yuantest_upfiles_gd VALUES('21','mid','upfiles/201508/24/mid_21.png');
INSERT INTO yuantest_upfiles_gd VALUES('21','big','upfiles/201508/24/big_21.png');
INSERT INTO yuantest_upfiles_gd VALUES('21','thumb','upfiles/201508/24/thumb_21.png');
INSERT INTO yuantest_upfiles_gd VALUES('20','mid','upfiles/201508/24/mid_20.jpg');
INSERT INTO yuantest_upfiles_gd VALUES('20','big','upfiles/201508/24/big_20.jpg');
INSERT INTO yuantest_upfiles_gd VALUES('20','thumb','upfiles/201508/24/thumb_20.jpg');
INSERT INTO yuantest_upfiles_gd VALUES('19','mid','upfiles/201508/24/mid_19.jpg');
INSERT INTO yuantest_upfiles_gd VALUES('19','big','upfiles/201508/24/big_19.jpg');
INSERT INTO yuantest_upfiles_gd VALUES('19','thumb','upfiles/201508/24/thumb_19.jpg');
INSERT INTO yuantest_upfiles_gd VALUES('18','mid','upfiles/201508/24/mid_18.jpg');
INSERT INTO yuantest_upfiles_gd VALUES('18','big','upfiles/201508/24/big_18.jpg');
INSERT INTO yuantest_upfiles_gd VALUES('18','thumb','upfiles/201508/24/thumb_18.jpg');
INSERT INTO yuantest_upfiles_gd VALUES('17','mid','upfiles/201508/24/mid_17.png');
INSERT INTO yuantest_upfiles_gd VALUES('17','big','upfiles/201508/24/big_17.png');
INSERT INTO yuantest_upfiles_gd VALUES('17','thumb','upfiles/201508/24/thumb_17.png');

#table : yuantest_user , backup time 2015-08-24 13:36:12
INSERT INTO yuantest_user VALUES('33','2','测试员01','14e1b600b1fd579f47433b88e8d85291','13111111111','1440387240','1','','WXFS','','','','','');

#table : yuantest_user_group , backup time 2015-08-24 13:36:14
INSERT INTO yuantest_user_group VALUES('1','guest','游客','','','all','','','1','1');
INSERT INTO yuantest_user_group VALUES('2','user','初级合伙人','','','all','1','','1','1');
INSERT INTO yuantest_user_group VALUES('3','user','金牌合伙人','','','','','','','');
