<?php
if(!function_exists("error"))
{
	function error($msg="",$url="",$time=2)
	{
		$app = sys_init();
		//哪果没有内容
		if(!$msg && !$url)
		{
			exit("error: false");
		}
		//如果没有内容提示，则直接跳转
		if(!$msg)
		{
			sys_header($url);
		}
		//如果有内容提示跳转
		$app->tpl->assign("msg",$msg);
		$app->tpl->assign("error_url",$url);
		if($url)
		{
			$error_note = sys_eval($app->lang["error_note"],$time);
			$app->tpl->assign("error_note",$error_note);
		}
		$app->tpl->assign("time",$time);
		//毫秒级，在JS中应用
		$app->tpl->assign("micro_time",$time*1000);
		$app->tpl->display("error.".$app->tpl->ext);
		exit();
	}
}

//rs是数组，根据数组原则生成静态页及伪静态页链接
function msg_url($rs,$format=true)
{
	$app = sys_init();
	if(!$rs)
	{
		return $app->url();
	}
	if(!$format || ($app->sys_config["site_type"] != "html" && $app->sys_config["site_type"] != "rewrite"))
	{
		$ext = $rs["identifier"] ? "ts=".$rs["identifier"] : "id=".$rs["id"];
		return $app->url("msg",$ext);
	}
	if($app->sys_config["site_type"] == "html" && !$app->sys_config["sitehtml"])
	{
		$app->sys_config["sitehtml"] = $app->sys_config["siteurl"]."html/".$app->langid."/";
	}
	if($app->sys_config["site_type"] == "rewrite")
	{
		$url = "c".$rs["id"].".html";
		if($rs["identifier"])
		{
			$url = $rs["identifier"].".html";
		}
		return $url;
	}
	//格式化网址
	$url = $app->sys_config["sitehtml"];
	if(substr($url,-1) != "/")
	{
		$url .= "/";
	}
	$this_url_end = ($rs["identifier"] && $rs["identifier"] != "index") ? $rs["identifier"].".html" : "c".$rs["id"].".html";
	if($rs["htmltype"] == "root")
	{
		$url .= $this_url_end;
	}
	elseif($rs["htmltype"] == "mid" || $rs["htmltype"] == "cateid")
	{
		$url .= $app->module_idlist[$rs["module_id"]]."/";
		if($rs["htmltype"] == "cateid" && $rs["cate_id"])
		{
			$url .= $app->cate_idlist[$rs["cate_id"]]."/";
		}
		$url .= $this_url_end;
	}
	else
	{
		$url .= date("Ym/d/",$rs["post_date"]);
		$url .= $this_url_end;
	}
	return $url;
}

//模块列表
function module_url($rs,$pageid=0,$format=true,$ifindex=true)
{
	$app = sys_init();
	if(!$rs)
	{
		return $app->url();
	}
	if(!$format || ($app->sys_config["site_type"] != "html" && $app->sys_config["site_type"] != "rewrite"))
	{
		$ext = $rs["identifier"] ? "ms=".$rs["identifier"] : "mid=".$rs["id"];
		if($pageid>1)
		{
			$ext .= "&".SYS_PAGEID."=".$pageid;
		}
		return $app->url("list",$ext);
	}
	if($app->sys_config["site_type"] == "html" && !$app->sys_config["sitehtml"])
	{
		$app->sys_config["sitehtml"] = $app->sys_config["siteurl"]."html/".$app->langid."/";
	}
	if($app->sys_config["site_type"] == "rewrite")
	{
		$url = $rs["identifier"] ? "ms-".$rs["identifier"] : "mid-".$rs["id"];
		$url.= $pageid<2 ? ".html" : "-".$pageid.".html";
		return $url;
	}
	//针对HTML的格式化
	$url = $app->sys_config["sitehtml"];
	if(substr($url,-1) != "/")
	{
		$url .= "/";
	}
	$url.= $rs["identifier"]."/";
	if($pageid<2)
	{
		if($ifindex)
		{
			$url .= "index.html";
		}
	}
	else
	{
		$url .= $pageid.".html";
	}
	return $url;
}


function list_url($rs,$pageid=0,$format=true,$ifindex=true)
{
	$app = sys_init();
	if(!$rs)
	{
		return $app->url();
	}
	if(!$format || ($app->sys_config["site_type"] != "html" && $app->sys_config["site_type"] != "rewrite"))
	{
		$ext = $rs["identifier"] ? "cs=".$rs["identifier"] : "id=".$rs["id"];
		if($pageid>1)
		{
			$ext .= "&".SYS_PAGEID."=".$pageid;
		}
		return $app->url("list",$ext);
	}
	if($app->sys_config["site_type"] == "html" && !$app->sys_config["sitehtml"])
	{
		$app->sys_config["sitehtml"] = $app->sys_config["siteurl"]."html/".$app->langid."/";
	}
	if($app->sys_config["site_type"] == "rewrite")
	{
		$url = $rs["identifier"] ? "cs-".$rs["identifier"] : "cid-".$rs["id"];
		$url.= $pageid<2 ? ".html" : "-".$pageid.".html";
		return $url;
	}
	//针对HTML的格式化
	$url = $app->sys_config["sitehtml"];
	if(substr($url,-1) != "/")
	{
		$url .= "/";
	}
	$url .= $app->module_idlist[$rs["module_id"]] . "/";
	$url .= $app->cate_idlist[$rs["id"]]."/";
	if($pageid<2)
	{
		if($ifindex)
		{
			$url .= "index.html";
		}
	}
	else
	{
		$url .= $pageid.".html";
	}
	return $url;
}

if(!function_exists("site_url"))
{
	function site_url($value,$extend="",$format=true,$format_type_ext="&amp;")
	{
		$app = sys_init();
		if(!$value)
		{
			return $app->url();
		}
		if(!$format || ($app->sys_config["site_type"] != "html" && $app->sys_config["site_type"] != "rewrite"))
		{
			return $app->url($value,$extend,$format_type_ext);
		}
		if($app->sys_config["site_type"] == "html" && !$app->sys_config["sitehtml"])
		{
			$app->sys_config["sitehtml"] = $app->sys_config["siteurl"]."html/".$app->langid."/";
		}
		$format_type = $app->sys_config["site_type"];
		//切分地址
		$ext = explode(",",$value);
		$c = $ext[0];
		if(!$c)
		{
			return false;
		}
		if(!$c != "list" || $c != "msg")
		{
			return $app->url($value,$extend,$format_type_ext);
		}
		$f = $ext[1] ? $ext[1] : "";
		$d = $ext[2] ? $ext[2] : "";
		if($extend)
		{
			$array = explode("&",$extend);
			foreach($array AS $k=>$v)
			{
				$tmp_array = explode("=",$v);
				$$tmp_array[0] = $tmp_array[1];
			}
		}
		if($c == "list" && $extend)
		{
			if($cid || $cs)
			{
				if($format_type == "rewrite")
				{
					$url = $cid ? "cid-".$cid : "cs-".$cs;
					if($pageid && $pageid>1)
					{
						$url .= "-".$pageid;
					}
					$url .= ".html";
					return $url;
				}
				else
				{
					$app->load_model("cate");
					if(!$cid && $cs)
					{
						$cid = $app->cate_m->get_cid_from_code($cs);
					}
					if($cid)
					{
						$rs = $app->cate_m->get_one($cid);
						return list_url($rs);
					}
				}
			}
			else
			{
				if($format_type == "rewrite")
				{
					$url = $mid ? "mid-".$mid : "ms-".$ms;
					if($pageid && $pageid>1)
					{
						$url .= "-".$pageid;
					}
					$url .= ".html";
					return $url;
				}
				else
				{
					$app->load_model("module");
					if($ms && !$mid)
					{
						$mid = $app->module_m->get_mid_from_code($ms);
					}
					if($mid)
					{
						$rs = $app->module_m->get_one($mid);
						return module_url($rs);
					}
				}
			}
		}
		elseif($c == "msg" && $extend)
		{
			if($format_type == "rewrite")
			{
				$url = $id ? "c".$id.".html" : $ts.".html";
				return $url;
			}
			else
			{
				$app->load_model("msg");
				if($id)
				{
					$rs = $app->msg_m->get_one($id);
				}
				else
				{
					$rs = $app->msg_m->get_one_fromtype($ts,$_SESSION["sys_lang_id"]);
				}
				return msg_url($rs);
			}
		}
		return $app->url($value,$extend,$format_type_ext);
	}
}

if(!function_exists("sys_format_content"))
{
	function sys_format_content($msg)
	{
		if(!$msg)
		{
			return false;
		}
		$msg = str_replace("[:page:]","",$msg);
		$list = array();
		preg_match_all("/\[((download|video):([0-9]+))\]/isU",$msg,$list);
		$list = array_unique($list[1]);
		if(!$list || !is_array($list) || count($list)<1)
		{
			return $msg;
		}
		$app = sys_init();
		$app->load_model("upfile");
		if(!$app->lang["download"])
		{
			$app->lang["download"] = "download";
		}
		foreach($list AS $key=>$value)
		{
			$array = explode(":",$value);
			if(!$array[1])
			{
				continue;
			}
			if(!$array[0])
			{
				$array[0] = "download";
			}
			$type = in_array($array[0],array("download","video")) ? $array[0] : "download";
			$id = $array[1];
			$rs = $app->upfile_m->get_one($id);
			if(!$rs)
			{
				continue;
			}
			if($type == "video")
			{
				$width = $app->sys_config["video_width"] ? $app->sys_config["video_width"] : "500";
				$height = $app->sys_config["video_height"] ? $app->sys_config["video_height"] : "400";
				$pre_image = $rs["flv_pic"] ? $rs["flv_pic"] : $app->sys_config["video_image"];
				$n_msg = "<div class='video'>";
				$n_msg.= "<script type='text/javascript'>";
				$n_msg.= 'var htmlmsg = Media.init("'.$rs["filename"].'","'.$width.'","'.$height.'","'.$pre_image.'");';
				$n_msg.= "document.write(htmlmsg);</script>";
				$n_msg.= "</div>";
			}
			else
			{
				$n_msg = "<div class='download'><a href='".site_url("download","id=".$id)."'>";
				$n_msg.= "<img src='images/download.gif' align='absmiddle'> ";

				$n_msg.= $app->lang["download"].": ".$rs["title"];
				$n_msg.= "</a></div>";
			}
			$msg = str_replace("[".$value."]",$n_msg,$msg);
		}
		return $msg;
	}
}

function sys_format_module_id_code()
{
	$app = sys_init();
	$rs = $app->module_m->get_id_code_list();
	if($rs)
	{
		$app->module_codelist = $rs["code"];
		$app->module_idlist = $rs["id"];
		unset($rs);
	}
	return true;
}
function sys_format_cate_id_code()
{
	$app = sys_init();
	$rs = $app->cate_m->get_id_code_list();
	if($rs)
	{
		$app->cate_codelist = $rs["code"];
		$app->cate_idlist = $rs["id"];
		unset($rs);
	}
	return true;
}

function sys_format_menu($rs)
{
	$app = sys_init();
	$site_html = $app->sys_config["sitehtml"] ? $app->sys_config["sitehtml"] : $app->sys_config["siteurl"]."html/".$app->langid."/";
	$index_php = $app->sys_config["indexphp"] ? $app->sys_config["indexphp"] : "index.php";
	$site_url = $app->sys_config["siteurl"] ? $app->sys_config["siteurl"] : base_url();
	if(!$rs["link_html"]) $rs["link_html"] = $rs["link"];
	if(!$rs["link_rewrite"]) $rs["link_rewrite"] = $rs["link"];
	if($app->sys_config["site_type"] == "html")
	{
		$rs["link"] = $rs["link_html"];
	}
	elseif($app->sys_config["site_type"] == "rewrite")
	{
		$rs["link"] = $rs["link_rewrite"];
	}
	$rs["link"] = str_replace("{control_trigger}",$app->config->c,$rs["link"]);
	$rs["link"] = str_replace("{site_html}",$site_html,$rs["link"]);
	$rs["link"] = str_replace("{index_php}",$index_php,$rs["link"]);
	$rs["link"] = str_replace("{site_url}",$site_url,$rs["link"]);
	unset($rs["link_html"],$rs["link_rewrite"]);
	return $rs;
}

function sys_user_popedom($chktype="read")
{
	$app = sys_init();
	$app->load_model("usergroup");
	if($_SESSION["user_id"])
	{
		$rs = $_SESSION["group_id"] ? $app->usergroup_m->get_one($_SESSION["group_id"]) : $app->usergroup_m->get_default();
		if(!$rs)
		{
			return false;
		}
	}
	else
	{
		$rs = $app->usergroup_m->get_guest();
		if(!$rs)
		{
			return false;
		}
	}
	//格式化权限
	$popedom = "";
	if($chktype == "read") $popedom = $rs["popedom_read"];
	if($chktype == "post") $popedom = $rs["popedom_post"];
	if($chktype == "reply") $popedom = $rs["popedom_reply"];
	if(!$popedom)
	{
		return false;
	}
	if($popedom == "all") return $popedom;
	//格式化权限
	$array = $m = $c = array();
	$popedom = sys_id_list($popedom);
	foreach($popedom AS $key=>$value)
	{
		$tmp = explode(":",$value);
		if($tmp[0] == "m")
		{
			$m[] = $tmp[1];
		}
		else
		{
			$c[] = $tmp[1];
		}
	}
	unset($popedom);
	if((!$m || count($m)<1) && (!$c || count($c)<1))
	{
		return false;
	}
	$popedom = array();
	$popedom["module"] = $m ? $m : false;
	$popedom["category"] = $c ? $c : false;
	return $popedom;
}

if(!function_exists("d"))
{
	function d($var,$func = "print_r")
	{
		echo "<pre>";
		$func($var);
		echo "</pre>";
	}
}
function JS2UTF8($str)
{
        for($i=0;$i<strlen($str);$i+=6){
                list($a,$b)=sscanf(substr($str,$i),"%%u%02x%02x");
                $unicode.=chr($b).chr($a);
        }
        return iconv("UNICODELITTLE","UTF-8",$unicode);
}
?>