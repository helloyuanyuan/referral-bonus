<?php
require_once("global.php");

if(file_exists("lock.php"))
{
	error("安程程序已经锁定！如果您要重新安装，请删除 lock.php 文件！");
}

if(!file_exists("install.sql"))
{
	error("缺少安装文件：install.sql，请检查!");
}

//判断是否支持附件上传
$act = safe_html($act);
if(!$act)
{
	$ifupload = get_cfg_var("upload_max_filesize");
	if(function_exists("gd_info"))
	{
		$gd = gd_info();
		$gdinfo = $gd["GD Version"];
	}
	else
	{
		$gdinfo = "不支持";
	}
	$tpl->display("index.html");
}
elseif($act == "setconfig")
{
	$site_url = base_url();
	$site_url = str_replace(strstr($site_url,"install/"),"",$site_url);
	$tpl->display("setconfig.html");
}
elseif($act == "save")
{
	$tmp_type = safe_html($db_type);
	$db_type_array = explode(":",$tmp_type);
	$db_type = $db_type_array[0];
	$db_engine = $db_type_array[1];
	$db_host = safe_html($db_host);
	$db_port = safe_html($db_port);
	if(!$db_port)
	{
		$db_port = "3306";
	}
	$db_user = safe_html($db_user);
	$db_pass = safe_html($db_pass);
	$db_data = safe_html($db_data);
	if(!$db_data)
	{
		error("数据库名称不允许为空","index.php?act=setconfig");
	}
	$prefix = safe_html($prefix) ? safe_html($prefix) : "qinggan_";
	if(substr($prefix,-1) != "_")
	{
		$prefix .= "_";
	}

	include_once("../libs/db_engine/".$db_engine.".php");

	$tmp_config = array();
	$tmp_config["host"] = $db_host;
	$tmp_config["port"] = $db_port;
	$tmp_config["user"] = $db_user;
	$tmp_config["pass"] = $db_pass;
	//$tmp_config["data"] = $db_data;
	$tmp_config["data"] = "";//先清空
	$tmp_config["prefix"] = $prefix;
	$cls_name = "db_".$db_engine;
	$db = new $cls_name($tmp_config);
	if(!$db->connect($db_data))
	{
		error("无法连接到数据库上，请检查配置是否正确...","index.php?act=setconfig");
	}
	$tmp_config["data"] = $db_data;
	$cache_type = safe_html($cache_type);
	$cache_time = safe_html($cache_time);
	$cache_server = safe_html($cache_server);
	$cache_port = safe_html($cache_port);

	$content = file_get_contents("../app/database.config.php");
	$content = preg_replace("/[$]_db_config\[\"type\"\]\s*\=\s*[\"'].*?[\"'];/is", "\$_db_config[\"type\"] = \"".$db_type."\";",$content);
	$content = preg_replace("/[$]_db_config\[\"engine\"\]\s*\=\s*[\"'].*?[\"'];/is", "\$_db_config[\"engine\"] = \"".$db_engine."\";",$content);
	$content = preg_replace("/[$]_db_config\[\"host\"\]\s*\=\s*[\"'].*?[\"'];/is", "\$_db_config[\"host\"] = \"".$db_host."\";",$content);
	$content = preg_replace("/[$]_db_config\[\"port\"\]\s*\=\s*[\"'].*?[\"'];/is", "\$_db_config[\"port\"] = \"".$db_port."\";",$content);
	$content = preg_replace("/[$]_db_config\[\"user\"\]\s*\=\s*[\"'].*?[\"'];/is", "\$_db_config[\"user\"] = \"".$db_user."\";",$content);
	$content = preg_replace("/[$]_db_config\[\"pass\"\]\s*\=\s*[\"'].*?[\"'];/is", "\$_db_config[\"pass\"] = \"".$db_pass."\";",$content);
	$content = preg_replace("/[$]_db_config\[\"data\"\]\s*\=\s*[\"'].*?[\"'];/is", "\$_db_config[\"data\"] = \"".$db_data."\";",$content);
	$content = preg_replace("/[$]_db_config\[\"prefix\"\]\s*\=\s*[\"'].*?[\"'];/is", "\$_db_config[\"prefix\"] = \"".$prefix."\";",$content);
	$content = preg_replace("/[$]_db_config\[\"cache_type\"\]\s*\=\s*[\"'].*?[\"'];/is", "\$_db_config[\"cache_type\"] = \"".$cache_type."\";",$content);
	$content = preg_replace("/[$]_db_config\[\"cache_server\"\]\s*\=\s*[\"'].*?[\"'];/is", "\$_db_config[\"cache_server\"] = \"".$cache_server."\";",$content);
	$content = preg_replace("/[$]_db_config\[\"cache_port\"\]\s*\=\s*[\"'].*?[\"'];/is", "\$_db_config[\"cache_port\"] = \"".$cache_port."\";",$content);
	$content = preg_replace("/[$]_db_config\[\"cache_time\"\]\s*\=\s*[\"'].*?[\"'];/is", "\$_db_config[\"cache_time\"] = \"".$cache_time."\";",$content);
	file_put_msg("../app/database.config.php",$content);
	unset($content);
	//更新网站域名
	$siteurl = safe_html($siteurl);
	$handle = opendir("../data");
	$array = array();
	while(false !== ($myfile = readdir($handle)))
	{
		if($myfile != "." && $myfile != ".." && $myfile !=".svn") $array[] = "../data/".$myfile;
	}
	closedir($handle);
	foreach($array AS $key=>$value)
	{
		if(file_exists($value) && is_file($value))
		{
			if(substr(basename($value),0,6) == "system")
			{
				$content = file_get_contents($value);
				$content = preg_replace("/[$]_sys\[\"siteurl\"\]\s*\=\s*[\"'].*?[\"'];/is", "\$_sys[\"siteurl\"] = \"".$siteurl."\";",$content);
				$content = preg_replace("/[$]_sys\[\"shareyeslink\"\]\s*\=\s*[\"'].*?[\"'];/is", "\$_sys[\"shareyeslink\"] = \"".$siteurl."\";",$content);
				$content = preg_replace("/[$]_sys\[\"wx_link\"\]\s*\=\s*[\"'].*?[\"'];/is", "\$_sys[\"wx_link\"] = \"".$siteurl."\";",$content);
				file_put_msg($value,$content);
			}
		}
	}

	//导入数据库
	$sql = file_get_contents("install.sql");
	if($prefix != "YuanTest_")
	{
		$sql = str_replace("YuanTest_",$prefix,$sql);
	}
	format_sql($sql);

	//更新管理员信息
	$admin_user = safe_html($admin_user);
	$admin_pass = safe_html($admin_pass);
	$sql = "TRUNCATE TABLE `".$prefix."admin`";
	$db->query($sql);
	$sql = "INSERT INTO ".$prefix."admin(name,email,pass,status,if_system,popedom) VALUES('".$admin_user."','YuanAdmin@YuanAdmin.com','".sys_md5($admin_pass)."','1','1','')";
	$db->query($sql);

	@touch("lock.php");
	$tpl->display("success.html");
}
?>