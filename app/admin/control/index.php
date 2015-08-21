<?php
class index_c extends Control
{
	function __construct()
	{
		parent::Control();
		$this->load_model("module");
		$this->load_model("admin");
	}

	function index_c()
	{
		$this->__construct();
	}

	function index_f()
	{
		$this->tpl->p("index");
	}

	function top_f()
	{
		$popedom = $this->admin_m->get_module_id($_SESSION["admin_id"]);
		//加载头部信息
		//读取头部信息
		$rslist = $this->module_m->top(0,1);
		if(!is_array($rslist)) $rslist = array();
		$newlist = array();
		$tmp_i = 0;
		foreach($rslist AS $key=>$value)
		{
			$value["left_url"] = $this->url("index,left","id=".$value["id"]);
			if($value["js_function"])
			{
				$value["onclick"] = $value["js_function"]."()";
				$newlist[] = $value;
				$tmp_i++;
				continue;
			}
			if($popedom == "all")
			{
				$value["onclick"] = "change_this('".$tmp_i."','".$value["left_url"]."')";
				$newlist[] = $value;
				$tmp_i++;
				continue;
			}
			if($popedom && $popedom != "all")
			{
				//判断子级是否有适合的权限
				$sonlist = $this->module_m->left($value["id"],1);
				$tmp_son = false;
				if($sonlist && is_array($sonlist) && count($sonlist)>0)
				{
					foreach($sonlist AS $k=>$v)
					{
						if(in_array($v["id"],$popedom))
						{
							$tmp_son = true;
							break;
						}
					}
				}
				if($tmp_son)
				{
					$value["onclick"] = "change_this('".$tmp_i."','".$value["left_url"]."')";
					$newlist[] = $value;
					$tmp_i++;
					continue;
				}
			}
		}
		$this->tpl->assign("rslist",$newlist);
		//加载语言包
		$this->load_model("lang");
		$tmp_langlist = $this->lang_m->get_list();
		if($tmp_langlist)
		{
			$langlist = array();
			foreach($tmp_langlist AS $key=>$value)
			{
				if($value["status"])
				{
					$langlist[] = $value;
				}
			}
			if(count($langlist)<1)
			{
				unset($langlist);
			}
		}
		if(!$langlist)
		{
			$langlist = array();
			$langlist[0]["langid"] = "zh";
			$langlist[0]["title"] = "简体中文";
			$langlist[0]["status"] = 1;
		}
		$admin_rs = $this->admin_m->get_one($_SESSION["admin_id"]);
		if(!$admin_rs["if_system"])
		{
			$lang_popedom = sys_id_list($admin_rs["langid"]);
			if($lang_popedom && is_array($lang_popedom) && count($lang_popedom)>0)
			{
				$new_langlist = array();
				foreach($langlist AS $key=>$value)
				{
					if(in_array($value["langid"],$lang_popedom))
					{
						$new_langlist[] = $value;
					}
				}
				if(count($new_langlist)>0)
				{
					$langlist = $new_langlist;
				}
			}
		}
		//判断是否有语言权限
		$this->tpl->assign("langlist",$langlist);
		$this->tpl->p("top");
	}

	function left_f()
	{
		$popedom = $this->admin_m->get_module_id($_SESSION["admin_id"]);
		$id = $this->trans_lib->int("id");
		$rslist = $this->module_m->left($id,1);
		if(!is_array($rslist)) $rslist = array();
		$newlist = array();
		foreach($rslist AS $key=>$value)
		{
			$ctrl_init = $value["ctrl_init"] ? $value["ctrl_init"] : "right";
			$func_init = $value["func_init"] ? $value["func_init"] : "index";
			if($popedom && is_array($popedom))
			{
				if(in_array($value["id"],$popedom))
				{
					$value["menu_url"] = $this->url($ctrl_init.",".$func_init,"module_id=".$value["id"]);
					$newlist[] = $value;
				}
			}
			else
			{
				if($popedom)
				{
					$value["menu_url"] = $this->url($ctrl_init.",".$func_init,"module_id=".$value["id"]);
					$newlist[] = $value;
				}
			}
		}
		$this->tpl->assign("rslist",$newlist);
		$this->tpl->p("left");
	}

	function right_f()
	{
		$this->tpl->p("right");
	}

	//更新语言包
	function chang_langid_f()
	{
		$langid = $this->trans_lib->safe("langid");
		if(!$langid)
		{
			$langid = $_SESSION["sys_lang_id"];
		}
		$this->load_model("lang");
		$rs = $this->lang_m->get_one($langid);
		if($rs)
		{
			$_SESSION["sys_lang_id"] = $langid;
			error("数据管理切换至：<span style='color:red;'>".$rs["title"]."</span>，请稍候",site_url("index"));
		}
		else
		{
			error("语言包切换失败，请检查",site_url("index"));
		}
	}

	//清空缓存
	function clear_cache_f()
	{
		$this->file_lib->rm(ROOT_DATA."admin_tplc/");
		$this->file_lib->rm(ROOT_DATA."tpl_c/");
		//判断是否有启用缓存
		$this->cache_lib->load_setting();
		$this->cache_lib->cache_status(true);
		$this->cache_lib->cache_clear();
		//清除超过当前时间60分钟的购物车信息
		$this->cache_lib->cache_cart();
		//更新语言包缓存
		$this->load_model("lang");
		$rslist = $this->lang_m->get_list();
		if($rslist && is_array($rslist))
		{
			foreach($rslist AS $key=>$value)
			{
				$tlist = $this->lang_m->lang_list_www($value["langid"]);
				$this->file_lib->vi($tlist,ROOT_DATA."lang_".$value["langid"].".php","_lang");
			}
		}
		exit("ok");
	}
}
?>