<?php
header("Content-type: text/html; charset=utf8");
error_reporting(0);
ob_start();
$magic_quotes_gpc = get_magic_quotes_gpc();
@extract(daddslashes($_POST));
@extract(daddslashes($_GET));
define("PHPOK_SET",true);

function sys_md5($rs)
{
	if(!$rs)
	{
		return false;
	}
	$rs = is_array($rs) ? implode("[:phpok:]",$rs) : $rs;
	return md5(md5($rs));
}

function daddslashes($string, $force = 0)
{
	if(!$GLOBALS["magic_quotes_gpc"] || $force)
	{
		if(is_array($string))
		{
			foreach($string as $key => $val)
			{
				$string[$key] = daddslashes($val, $force);
			}
		}
		else
		{
			$string = addslashes($string);
		}
	}
	return $string;
}

Function format_sql($sql)
{
	global $db;
	$sql = str_replace("\r","\n",$sql);
	$ret = array();
	$num = 0;
	foreach(explode(";\n", trim($sql)) as $query) {
		$queries = explode("\n", trim($query));
		foreach($queries as $query) {
			$ret[$num] .= $query[0] == '#' || $query[0].$query[1] == '--' ? '' : $query;
		}
		$num++;
	}
	unset($sql);

	foreach($ret as $query) {
		$query = trim($query);
		if($query) {
			if(substr($query, 0, 12) == 'CREATE TABLE') {
				//$name = preg_replace("/CREATE TABLE ([a-z0-9_]+) .*/is", "\\1", $query);
				//echo '创建表：'.$name.' ... <font color="#0000EE">'.$lang['succeed'].'</font><br>';
				$db->query(create_table($query));
			} else {
				$db->query($query);
			}
		}
	}
}

function create_table($sql)
{
	return preg_replace("/^\s*(CREATE TABLE\s+.+\s+\(.+?\)).*$/isU", "\\1", $sql).(mysql_get_server_info() > '4.1' ? " ENGINE=MyISAM DEFAULT CHARSET=utf8" : " TYPE=MYISAM");
}

function check_write($file)
{
	if(is_writeable($file))
	{
		return "<span style='color:darkgreen;font:bold 15px Tahoma,Arial;'>√</span>";
	}
	else
	{
		return "<span style='color:red;font:bold 15px Tahoma,Arial;'>×</span>";
	}
}

function safe_html($msg = "")
{
	if(empty($msg))
	{
		return false;
	}
	$msg = str_replace('&amp;','&',$msg);
	$msg = str_replace('&nbsp;',' ',$msg);
	$msg = str_replace("'","&#39;",$msg);
	$msg = str_replace('"',"&quot;",$msg);
	$msg = str_replace("<","&lt;",$msg);
	$msg = str_replace(">","&gt;",$msg);
	$msg = str_replace("\t","&nbsp; &nbsp; ",$msg);
	$msg = str_replace("\r","",$msg);
	$msg = str_replace("   ","&nbsp; &nbsp;",$msg);
	return $msg;
}

function getip()
{
	if(getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown'))
	{
		$onlineip = getenv('HTTP_CLIENT_IP');
	}
	elseif(getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown'))
	{
		$onlineip = getenv('HTTP_X_FORWARDED_FOR');
	}
	elseif(getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown'))
	{
		$onlineip = getenv('REMOTE_ADDR');
	}
	elseif(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown'))
	{
		$onlineip = $_SERVER['REMOTE_ADDR'];
	}
	return $onlineip;
}

function file_put_msg($file="",$content="")
{
	if(!$file || !$content)
	{
		return false;
	}
	if(function_exists("file_put_contents"))
	{
		file_put_contents($file,$content);
	}
	else
	{
		$handle = fopen($file,"wb");
		fwrite($handle,$content);
		fclose($handle);
	}
	return true;
}

if(!function_exists("base_url"))
{
	function base_url()
	{
		$myurl = "http://".str_replace("http://","",$_SERVER["SERVER_NAME"]);
		$docu = $_SERVER["PHP_SELF"];
		$array = explode("/",$docu);
		$count = count($array);
		if($count>1)
		{
			foreach($array AS $key=>$value)
			{
				$value = trim($value);
				if($value)
				{
					if(($key+1) < $count)
					{
						$myurl .= "/".$value;
					}
				}
			}
		}
		$myurl .= "/";
		return $myurl;
	}
}


require_once("../libs/tpl_engine/et.tpl.php");
$tplarray = array();
$tplarray["tplid"] = 1;
$tplarray["tpldir"] = "tpl";
$tplarray["cache"] = "tpl_c";
$tplarray["ext"] = "html";
$tplarray["autoimg"] = true;
$tpl = new et_tpl($tplarray);
$APP->tpl = $tpl;
unset($tplarray);


function error($title="",$url="")
{
	global $tpl;
	global $APP;
	$tpl->assign("APP",$APP);
	$tpl->assign("content",$title);
	$tpl->assign("url",$url);
	$tpl->display("error.html");
	exit();
}
?>