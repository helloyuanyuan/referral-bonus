<?php
if(!function_exists("phpok"))
{
	//标识串
	//vartext，数组，将合并到后台的参数调用中
	//格式如：array("id"=>1) 这样子的形式 或 cs=1,cid=1这样子
	function phpok($var,$vartext="")
	{
		if(!$var)
		{
			return false;
		}
		$app = sys_init();
		$app->load_lib("phpok");
		$app->phpok_lib->langid($_SESSION["sys_lang_id"]);
		$app->load_model("phpok");
		$app->phpok_m->langid($_SESSION["sys_lang_id"]);
		$rs = $app->phpok_m->get_one_sign($var);
		if(!$rs)
		{
			return false;
		}
		$in_var = array();
		if($rs["vartext"])
		{
			$varlist = explode(",",$rs["vartext"]);
			foreach($varlist AS $key=>$value)
			{
				$in_var[$value] = $app->trans_lib->safe($value);
			}
		}
		$app->phpok_lib->set_rs($rs);
		//合并传过来的数组
		if($vartext)
		{
			if(is_array($vartext) && count($vartext)>0)
			{
				$in_var = array_merge($in_var,$vartext);
			}
			else
			{
				$varlist = explode("&",$vartext);
				$v_list = array();
				foreach($varlist AS $key=>$value)
				{
					$v = explode("=",$value);
					$v_list[$v[0]] = $v[1];
				}
				$in_var = array_merge($in_var,$v_list);
			}
		}
		if(!$rs["typetext"])
		{
			return false;
		}
		$content = sys_eval($rs["typetext"],$in_var);
		$content = sys_format_content($content);//格式化内容代码信息
		return array("title"=>$rs["title"],"content"=>$content);
	}
}

//上下主题
if(!function_exists("phpok_next_prev"))
{
	//id:主题ID
	//cateid：主题所属分类ID，如果分类ID为0，将读取模块ID信息
	//pictype：关联的图片类型，不关联为空
	//num：读取数量
	function phpok_next_prev($id,$cateid=0,$pictype="",$num=1)
	{
		$app = sys_init();
		$app->load_model("np_model",true);
		$app->np_model->langid($_SESSION["sys_lang_id"]);
		$rs = array();
		$next_list = $app->np_model->get_next($id,$cateid,$pictype,$num);
		if($next_list)
		{
			$rs["next"] = $next_list;
		}
		$prev_list = $app->np_model->get_prev($id,$cateid,$pictype,$num);
		if($prev_list)
		{
			$rs["prev"] = $prev_list;
		}
		if($rs["next"] || $rs["prev"])
		{
			return $rs;
		}
		else
		{
			return false;
		}
	}
}

//读取语言包
if(!function_exists("phpok_lang"))
{
	function phpok_lang($format=true)
	{
		$app = sys_init();
		return $app->langconfig_m->get_all($format);
	}
}

//读取导航菜单
//id：主题ID
//cid：分类ID
//mid：模块ID
//在模板中，调用可以直接编写： <!-- run:$menulist = phpok_menu($id,$cid,$mid) -->
if(!function_exists("phpok_menu"))
{
	function phpok_menu($id=0,$cid=0,$mid=0)
	{
	}
}

//读取底部导航菜单
if(!function_exists("phpok_nav"))
{
	function phpok_nav()
	{
	}
}

//调用搜索支持的模块
if(!function_exists("phpok_module"))
{
	function phpok_module()
	{
		$app = sys_init();
		$app->load_model("module");
		return $app->module_m->get_all_module();
	}
}

//调用某个模块信息
//sign 模块标识符
if(!function_exists("phpok_m"))
{
	function phpok_m($sign="")
	{
		if(!$sign)
		{
			return false;
		}
		$app = sys_init();
		$app->load_model("module");
		return $app->module_m->get_one_from_code($sign);
	}
}

//调用某个模块下的主题
//ms 模块标识符
//limit 数量
//ifpic 0不需要 1需要
//order_by 排序，支持类型，请登录官方网站查看相关帮助
//attr：属性，仅支持 空，istop，isvouch，isbest
if(!function_exists("phpok_m_list"))
{
	function phpok_m_list($ms,$limit=10,$ifpic=0,$order_by="post_desc",$attr="")
	{
		//没有指定模块标识，返回为空！
		if(!$ms) return false;
		$app = sys_init();
		$app->load_lib("phpok");
		$app->phpok_lib->langid($_SESSION["sys_lang_id"]);
		$tmp_rs = array();
		$tmp_rs["pic_required"] = $ifpic;
		$tmp_rs["attr"] = $attr;
		$tmp_rs["maxcount"] = $limit;
		$app->phpok_lib->set_rs($tmp_rs);
		$in_var = array();
		$in_var["ms"] = $ms;
		$cache_key = "list_".md5("list:".serialize($in_var)."-phpok-".$order_by."-".$limit);
		$rslist = $app->cache_lib->cache_read($cache_key);
		if(!$rslist)
		{
			$rslist = $app->phpok_lib->list_sql($in_var,$limit,$order_by);
			if($rslist)
			{
				$app->cache_lib->cache_write($cache_key,$rslist);
			}
		}
		return $rslist;
	}
}

//调用某个分类下的主题
//cs 分类标识符
//limit 数量
//ifpic 0不需要 1需要
//order_by 排序，支持类型，请登录官方网站查看相关帮助
//attr：属性，仅支持 空，istop，isvouch，isbest
if(!function_exists("phpok_c_list"))
{
	function phpok_c_list($cs,$limit=10,$ifpic=0,$order_by="post_desc",$attr="")
	{
		//没有指定模块标识，返回为空！
		if(!$cs) return false;
		$app = sys_init();
		$app->load_lib("phpok");
		$app->phpok_lib->langid($_SESSION["sys_lang_id"]);
		$tmp_rs = array();
		$tmp_rs["pic_required"] = $ifpic;
		$tmp_rs["attr"] = $attr;
		$tmp_rs["maxcount"] = $limit;
		$app->phpok_lib->set_rs($tmp_rs);
		$in_var = array();
		$in_var["cs"] = $cs;
		$cache_key = "list_".md5("list:".serialize($in_var)."-phpok-".$order_by."-".$limit);
		$rslist = $app->cache_lib->cache_read($cache_key);
		if(!$rslist)
		{
			$rslist = $app->phpok_lib->list_sql($in_var,$limit,$order_by);
			if($rslist)
			{
				$app->cache_lib->cache_write($cache_key,$rslist);
			}
		}
		return $rslist;
	}
}

//调用分类，显示两级
//cid 当前分类ID
//mid 当前模块ID，可以为空，适用于分类ID为空时使用
if(!function_exists("phpok_catelist"))
{
	function phpok_catelist($cid)
	{
		if(!$cid) return false;
		$app = sys_init();
		$app->load_lib("phpok");
		$app->phpok_lib->langid($_SESSION["sys_lang_id"]);
		$tmp_rs = array();
		$tmp_rs["maxcount"] = 999;
		$app->phpok_lib->set_rs($tmp_rs);
		$rs = $app->cate_m->get_one($cid);
		$in_var = array();
		$in_var["cid"] = $cid;
		$cache_key = "catelist_".md5("cate:".serialize($in_var)."-phpok-".$cid);
		$rslist = $app->cache_lib->cache_read($cache_key);
		if(!$rslist)
		{
			$rslist = $app->phpok_lib->cate_sql($in_var);
			if($rslist)
			{
				$app->cache_lib->cache_write($cache_key,$rslist);
			}
		}
		return $rslist;
	}
}

//调用一个主题
//ts：内容标签，必填
//ifpic：是否包括图片0不限制，1包含
if(!function_exists("phpok_msg"))
{
	function phpok_msg($ts,$ifpic=0,$attr="")
	{
		if(!$ts) return false;
		$app = sys_init();
		$app->load_lib("phpok");
		$app->phpok_lib->langid($_SESSION["sys_lang_id"]);
		$tmp_rs = array();
		$tmp_rs["pic_required"] = $ifpic;
		$tmp_rs["attr"] = $attr;
		$tmp_rs["maxcount"] = 1;
		$app->phpok_lib->set_rs($tmp_rs);
		$in_var = array();
		$in_var["ts"] = $ts;
		$cache_key = "msg_".md5("list:".serialize($in_var)."-phpok");
		$rslist = $app->cache_lib->cache_read($cache_key);
		if(!$rslist)
		{
			$rslist = $app->phpok_lib->list_sql($in_var,1);
			if($rslist)
			{
				$app->cache_lib->cache_write($cache_key,$rslist);
			}
		}
		return $rslist;
	}
}

//简单分类列表，即不判断是否有父级分类，也不判断是否有子分类，只是根据标识串或ID，罗列相应的子分类
//id ：标识串或ID
//type 类型，默认是ID，支持 id 和 sign 两种类型
if(!function_exists("phpok_s_catelist"))
{
	function phpok_s_catelist($id,$type="id")
	{
		$app = sys_init();
		$app->load_model("list_model",true);
		return $app->list_model->get_s_catelist($id,$type,$_SESSION["sys_lang_id"]);
	}
}

//获取联动信息
//groupname 组名称
if(!function_exists("phpok_datalink"))
{
	function phpok_datalink($groupname="")
	{
	}
}

if(!function_exists("phpok_video"))
{
	function phpok_video($rs)
	{
		if(!$rs) return false;
		if(!is_array($rs))
		{
			$app = sys_init();
			$app->load_model("upfile");
			$rs = $app->upfile_m->get_one($rs);
		}
		$width = $app->sys_config["video_width"] ? $app->sys_config["video_width"] : "500";
		$height = $app->sys_config["video_height"] ? $app->sys_config["video_height"] : "400";
		$pre_image = $rs["flv_pic"] ? $rs["flv_pic"] : $app->sys_config["video_image"];
		$n_msg = "<script type='text/javascript'>";
		$n_msg.= 'var htmlmsg = Media.init("'.$rs["filename"].'","'.$width.'","'.$height.'","'.$pre_image.'");';
		$n_msg.= "document.write(htmlmsg);</script>";
		return $n_msg;
	}
}

//plugin_identifier，插件标识串
//function，执行函数
//ext，传递参数，数组或字符串，受插件影响，一般是传递字符串
if(!function_exists("phpok_plugin"))
{
	function phpok_plugin($plugin_identifier,$function="phpok",$ext="")
	{
	}
}

if(!function_exists("phpok_c"))
{
	function phpok_c($id,$field="content",$pageid=1,$is_span=true)
	{
		if(!$id || !$field) return false;
		$app = sys_init();
		$app->load_model("msg");
		$content = $app->msg_m->get_c($id,$field);
		if(!$content) return false;
		$content = preg_replace("/<div/isU","<p",$content);
		$content = preg_replace("/<\/div>/isU","</p>",$content);
		//格式化内容
		$rslist = explode("[:page:]",$content);
		$content_count = count($rslist);
		if($content_count < 2)
		{
			return $content;
		}
		unset($content);
		$html = "<div class='content-page' align='center'>";
		$html.= "<table cellpadding='0' cellspacing='0'><tr>";
		foreach($rslist AS $key=>$value)
		{
			$html .= '<td>';
			$html .= '<a href="javascript:phpok_content_page('.$id.',\''.$field.'\','.($key+1).');void(0);"';
			if(($key+1) == $pageid)
			{
				$html .= ' class="now"';
			}
			$html .= '>'.($key+1)."</a>";
			$html .= "</td>";
		}
		$html .= "</tr></table>";
		$html .= "</div>";
		$keyid = $pageid-1;
		$content = $rslist[$keyid] ? $rslist[$keyid] : $rslist[($content_count-1)];
		if($is_span)
		{
			return "<span id='phpok_c_".$field."'>".$content.$html."</span>";
		}
		else
		{
			return $content.$html;
		}
	}
}

?>