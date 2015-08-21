<?php
class list_c extends Control
{
	function __construct()
	{
		parent::Control();
		$this->load_model("list");
		$this->load_model("module");
	}

	function list_c()
	{
		$this->__construct();
	}

	function index_f()
	{
		$page_url = $this->url("list,index");
		$module_id = $this->trans_lib->int("module_id");
		if(!$module_id)
		{
			error("没有指定模块ID");
		}
		//判断是否有此操作权限
		sys_popedom($module_id.":list","tpl");
		$page_url .= "module_id=".$module_id."&";
		//取得模块列表
		$m_rs = $this->_load_module($module_id);
		$this->tpl->assign("m_rs",$m_rs);
		$ifcate = $m_rs["if_cate"] ? true : false;
		$ifbiz = $m_rs["if_biz"] ? true : false;
		$ifthumb = $m_rs["if_thumb"] ? true : false;
		$this->tpl->assign("ifcate",$ifcate);
		$pageid = $this->trans_lib->int(SYS_PAGEID);
		$this->list_m->set_condition("m.langid='".$_SESSION["sys_lang_id"]."'");//区分语言
		$this->list_m->set_condition("m.module_id='".$module_id."'");
		if($ifcate)
		{
			$cate_id = $this->trans_lib->int("cate_id");
			if($cate_id>0)
			{
				$page_url .= "cate_id=".$cate_id."&";
				$this->list_m->set_condition("m.cate_id='".$cate_id."'");
			}
		}
		$keywords = $this->trans_lib->safe("keywords");
		if($keywords)
		{
			$this->list_m->set_condition("m.title LIKE '%".$keywords."%'");
			$page_url .= "keywords=".rawurlencode($keywords)."&";
		}
		$rslist = $this->list_m->get_list($pageid,$ifcate,$ifbiz,$ifthumb);
		$this->tpl->assign("rslist",$rslist);
		$total_count = $this->list_m->get_count();//取得总数
		$pagelist = $this->page_lib->page($page_url,$total_count);
		$this->tpl->assign("pagelist",$pagelist);
		//如果有分类
		if($ifcate)
		{
			$this->_load_cate($module_id,$cate_id,true,true);
		}
		//加载模块配置字段
		$this->layout($module_id,$m_rs);
		$this->tpl->display("list/list.html");
	}

	function layout($mid,$m_rs)
	{
		$layout = array();
		$layout["subtitle"] = $m_rs["subtitle_nickname"] ? $m_rs["subtitle_nickname"] : "副主题";
		$layout["hits"] = "查看次数";
		$layout["good_hits"] = "好评";
		$layout["bad_hits"] = "差评";
		$layout["author"] = "发布人";
		$layout["link_url"] = "链接地址";
		//取得扩展字段的名字
		$mlist = $this->module_m->fields_index_identifier($mid);
		if($mlist)
		{
			foreach($mlist AS $key=>$value)
			{
				$layout[$key] = $value["title"];
			}
			unset($mlist);
		}
		if(!$m_rs["layout"]) return false; //如果未设置，直接返空
		//合并
		$keylist = sys_id_list($m_rs["layout"]);
		$mlist = array();
		foreach($keylist AS $key=>$value)
		{
			$mlist[$value] = $layout[$value];
		}
		$this->tpl->assign("mlist",$mlist);
		return $mlist;
	}

	function chkone_f()
	{
		$id = $this->trans_lib->int("id");
		$sign = $this->trans_lib->safe("sign");
		if(!$sign)
		{
			exit("error: 没有指定标识串");
		}
		$rs = $this->list_m->chk_sign($sign,$id,$_SESSION["sys_lang_id"]);
		if($rs)
		{
			exit("error: 标识串已被使用！");
		}
		exit("ok");
	}

	function set_f()
	{
		$id = $this->trans_lib->int("id");
		if($id)
		{
			$rs = $this->list_m->get_one($id);
			$this->tpl->assign("id",$id);
			$module_id = $rs["module_id"];
			sys_popedom($module_id.":modify","tpl");
			$cate_id = $rs["cate_id"];
		}
		else
		{
			$module_id = $this->trans_lib->int("module_id");
			sys_popedom($module_id.":add","tpl");
			$rs["post_date"] = $this->system_time;//系统时间
			$rs["ip"] = sys_ip();
			$cate_id = $this->trans_lib->int("cateid");
		}
		if(!$module_id)
		{
			error("没有指定模块ID");
		}
		$this->tpl->assign("rs",$rs);
		$this->tpl->assign("module_id",$module_id);
		$m_rs = $this->_load_module($module_id);
		//读取内容
		$ifcate = $m_rs["if_cate"] ? true : false;
		$this->tpl->assign("ifcate",$ifcate);
		$cate_key_list = false;
		if($ifcate)
		{
			$catelist = $this->_load_cate($module_id,$rs["cate_id"],true,false);
			if(!$cate_id)
			{
				$cate_id = $catelist[0]["id"];
			}
			if($cate_id)
			{
				$this->tpl->assign("cate_id",$cate_id);
				$cate_rs = $this->cate_m->get_one($cate_id);
				if($cate_rs["fields"])
				{
					$cate_key_list = array();
					$cate_key_list = sys_id_list($cate_rs["fields"]);
				}
				$this->tpl->assign("cate_rs",$cate_rs);
			}
		}
		$tmp_ext_list = $this->_load_ext_fields($module_id);//获取扩展信息
		if($cate_key_list)
		{
			$ext_list = array();
			foreach($tmp_ext_list AS $key=>$value)
			{
				if(in_array($value["identifier"],$cate_key_list))
				{
					$ext_list[] = $value;
				}
			}
		}
		else
		{
			$ext_list = $tmp_ext_list;
		}
		unset($tmp_ext_list);
		if($ext_list && is_array($ext_list) && count($ext_list)>0)
		{
			$optlist = array();
			$this->load_lib("phpok_input");
			$extlist_must = $extlist_need = array();
			foreach($ext_list AS $key=>$value)
			{
				$_field_name = $value["identifier"];
				$value["default_val"] = $rs[$_field_name] ? $rs[$_field_name] : $value["default_val"];
				$extlist = $this->phpok_input_lib->get_html($value);
				$extlist_must[] = $extlist;
				if($value["input"] == "opt")
				{
					$optlist[] = $value;
				}
				$ext_list[$key] = $value;
			}
			$this->tpl->assign("extlist_must",$extlist_must);
			$this->tpl->assign("optlist",$optlist);
			$this->tpl->assign("extlist",$ext_list);
		}
		$this->tpl->display("list/set.html");
	}

	function setok_f()
	{
		$id = $this->trans_lib->int("id");
		if(!$id)
		{
			$module_id = $this->trans_lib->int("module_id");
			if(!$module_id)
			{
				error("对不起，您的操作错误，没有指定应用模块");
			}
			sys_popedom($module_id.":add","tpl");
		}
		else
		{
			$rs = $this->list_m->get_one($id);
			$module_id = $rs["module_id"];
			sys_popedom($module_id.":modify","tpl");
		}
		//获取核心数据
		$array_sys = array();
		if(!$id)
		{
			$array_sys["module_id"] = $module_id;
		}
		$array_sys["cate_id"] = $this->trans_lib->int("cate_id");
		$cateid = $array_sys["cate_id"];
		$array_sys["yongjin"] = $this->trans_lib->safe("yongjin");
		$array_sys["jili"] = $this->trans_lib->safe("jili");
		$array_sys["title"] = $this->trans_lib->safe("subject");
		$array_sys["style"] = $this->trans_lib->safe("style");
		$array_sys["hidden"] = $this->trans_lib->int("hidden");
		$array_sys["link_url"] = $this->trans_lib->safe("link_url");
		$array_sys["target"] = $this->trans_lib->int("target");
		$array_sys["author"] = $this->trans_lib->safe("author");
		$array_sys["author_type"] = $this->trans_lib->safe("author_type");
		$array_sys["ip"] = $this->trans_lib->safe("ip");
		if(!$array_sys["ip"])
		{
			$array_sys["ip"] = sys_ip();
		}
		$array_sys["keywords"] = $this->trans_lib->safe("keywords");
		$array_sys["description"] = $this->trans_lib->safe("description");
		$array_sys["note"] = $this->trans_lib->safe("note");
		$array_sys["identifier"] = $this->trans_lib->safe("identifier");
		$array_sys["tplfile"] = $this->trans_lib->safe("tplfile");//内容模板
		$array_sys["hits"] = $this->trans_lib->int("hits");
		$array_sys["good_hits"] = $this->trans_lib->int("good_hits");
		$array_sys["bad_hits"] = $this->trans_lib->int("bad_hits");
		$post_date = $this->trans_lib->safe("post_date");
		$array_sys["post_date"] = $post_date ? strtotime($post_date) : $this->system_time;
		if($id)
		{
			//最后更改时间
			$array_sys["modify_date"] = $this->system_time;
		}
		$array_sys["thumb_id"] = $this->trans_lib->int("thumb_id");
		$array_sys["istop"] = isset($_POST["istop"]) ? 1 : 0;
		$array_sys["isvouch"] = isset($_POST["isvouch"]) ? 1 : 0;
		$array_sys["isbest"] = isset($_POST["isbest"]) ? 1 : 0;
		$array_sys["points"] = $this->trans_lib->int("points");
		if(!$id)
		{
			$array_sys["langid"] = $this->langid;
		}
		$array_sys["taxis"] = $this->trans_lib->int("taxis");
		$array_sys["htmltype"] = $this->trans_lib->safe("htmltype");//静态页存储方式
		$array_sys["subtitle"] = $this->trans_lib->safe("subtitle");//副主题
		$insert_id = $this->list_m->save_sys($array_sys,$id);//存储数据
		if(!$insert_id)
		{
			error("数据存储失败，请检查",site_url("list,set","id=".$id));
		}
		unset($array_sys);//注销存储信息
		//[读取核心模块配置信息]
		$m_rs = $this->module_m->get_one($module_id);
		if($m_rs)
		{
			//判断是否
			$extlist = $this->_load_ext_fields($module_id);
			if(!$extlist) $extlist = array();
			foreach($extlist AS $key=>$value)
			{
				$array_ext = array();
				$array_ext["id"] = $insert_id;
				$array_ext["field"] = $value["identifier"];//扩展字段信息
				$format_type = $value["if_html"] ? "html" : "safe";
				if($value["if_js"] && $format_type == "html")
				{
					$this->trans_lib->setting(true,true,true);
				}
				$val = $this->trans_lib->$format_type($value["identifier"]);
				if($value["if_js"] && $format_type == "html")
				{
					$this->trans_lib->setting(false,false,false);
				}
				if(is_array($val))
				{
					$val = implode(",",$val);
				}
				$array_ext["val"] = $val;
				$this->list_m->save_ext($array_ext,$value["tbl"]);
			}
		}
		//提示添加成功，进入跳转
		if(!$id)
		{
			$_go_action = $this->trans_lib->safe("_go_back_action");
			if($_go_action == "list")
			{
				$go_url = $this->url("list","module_id=".$module_id."&cate_id=".$cateid);
			}
			else
			{
				$go_url = $this->url("list,set","module_id=".$module_id."&cateid=".$cateid);
			}
		}
		else
		{
			$go_url = $this->url("list","module_id=".$module_id."&cate_id=".$cateid);
		}
		error("数据存储成功，请稍候……",$this->url("list",$go_url));
	}

	function ajax_update_cate_f()
	{
		$cateid = $this->trans_lib->int("cateid");
		$id = $this->trans_lib->safe("id");
		if(!$cateid || !$id)
		{
			exit("error: 操作错误！");
		}
		$this->list_m->set_cate($id,$cateid);
		exit("ok");
	}

	function ajax_pl_f()
	{
		$id = $this->trans_lib->safe("id");
		$field = $this->trans_lib->safe("field");
		$val = $this->trans_lib->int("val");
		if(!$id)
		{
			exit("error:没有指定ID");
		}
		$array = sys_id_list($id);
		if(!$array[0])
		{
			exit("error:错误");
		}
		$rs = $this->list_m->get_one($array[0]);
		sys_popedom($rs["module_id"].":check","ajax");
		$this->list_m->set_pl($id,$field,$val);
		exit("ok");
	}

	function taxis_pl_f()
	{
		$taxis = $this->trans_lib->safe("taxis");
		if(!$taxis || !is_array($taxis) || count($taxis)<1)
		{
			exit("error: 错误，没有取得有效信息");
		}
		foreach($taxis AS $key=>$value)
		{
			$key = intval($key);
			$value = intval($value);
			$this->list_m->set_taxis($key,$value);
		}
		exit("ok");
	}

	function ajax_status_f()
	{
		$id = $this->trans_lib->int("id");
		if(!$id)
		{
			exit("error:没有指定ID");
		}
		$rs = $this->list_m->get_one($id);
		sys_popedom($rs["module_id"].":check","ajax");
		$status = $rs["status"] ? 0 : 1;
		$this->list_m->set_pl($id,"status",$status);
		exit("ok");
	}

	function ajax_del_f()
	{
		$id = $this->trans_lib->safe("id");
		if(!$id)
		{
			exit("error:没有指定ID");
		}
		$array = sys_id_list($id);
		if(!$array[0])
		{
			exit("error:错误");
		}
		$rs = $this->list_m->get_one($array[0]);
		$module_id = $rs["module_id"];
		sys_popedom($module_id.":delete","ajax");
		$this->list_m->del($id);
		exit("ok");
	}

	//加载分类
	function _load_cate($module_id,$cate_id,$if_array=false,$if_ext_select=true)
	{
		$this->load_model("cate");
		$this->cate_m->get_catelist($module_id);
		$ext_message = $if_ext_select ? $this->lang["select_cate"] : "";
		$cate_html = $this->cate_m->html_select("cate_id",$cate_id,$ext_message);
		$this->tpl->assign("cate_html",$cate_html);
		if($if_array)
		{
			$cate_list_array = $this->cate_m->html_select_array();
			$this->tpl->assign("cate_list_array",$cate_list_array);
		}
		return $cate_list_array ? $cate_list_array : $this->cate_m->catelist();
	}

	//加载模块
	function _load_module($module_id)
	{
		$m_rs = $this->module_m->get_one($module_id);
		$this->tpl->assign("m_rs",$m_rs);
		return $m_rs;
	}

	//加载扩展的字段
	function _load_ext_fields($module_id)
	{
		if(!$module_id)
		{
			return false;
		}
		//读取扩展的字段列表
		$ext_list = $this->module_m->fields_index($module_id,1);
		return $ext_list;
	}
}
?>