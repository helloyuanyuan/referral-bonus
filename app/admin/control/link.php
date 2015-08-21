<?php
class link_c extends Control
{
	function __construct()
	{
		parent::Control();
		$this->load_model("module");
		$this->load_model("cate");
		$this->load_model("list");
		$this->load_model("user");
		$this->load_model("customer");
	}

	function link_c()
	{
		$this->__construct();
	}

	//读取列表
	function index_f()
	{
		exit("ERROR!");
	}

	//加载配置参数
	function auto_load()
	{
		if(!file_exists(ROOT_DATA."system_".$_SESSION["sys_lang_id"].".php"))
		{
			error("请先配置好，网站信息！");
		}
		include_once(ROOT_DATA."system_".$_SESSION["sys_lang_id"].".php");
		if(!$_sys["indexphp"])
		{
			$_sys["indexphp"] = "index.php";
		}
		if(!$_sys["sitehtml"])
		{
			$_sys["sitehtml"] = $_sys["siteurl"]."html/".$_SESSION["sys_lang_id"]."/";
		}
		$this->tpl->assign("phpfile",$_sys["indexphp"]);
		$input_id = $this->trans_lib->safe("input_id");
		if(!$input_id) $input_id = "link,link_rewrite,link_html";
		$this->tpl->assign("input_id",$input_id);
		$this->tpl->assign("htmlfile",$_sys["sitehtml"]);
	}

	function module_f()
	{
		$this->auto_load();
		$condition = array();
		$condition["langid"] = $_SESSION["sys_lang_id"];
		$condition["ctrl_init"] = "list";
		$condition["array"]["if_list"] = 1;
		$condition["array"]["if_msg"] = 1;
		$pageid = $this->trans_lib->int(SYS_PAGEID);
		$rslist = $this->module_m->get_list($pageid,$condition);
		$this->tpl->assign("rslist",$rslist);
		$total = $this->module_m->get_count();//读取模块总数
		$page_url = $this->url("link,module");
		$pagelist = $this->page_lib->page($page_url,$total);
		$this->tpl->assign("pagelist",$pagelist);
		$this->tpl->assign("type","module");
		$input_id = $this->trans_lib->safe("input_id");
		if(!$input_id) $input_id = "link,link_rewrite,link_html";
		$this->tpl->assign("input_id",$input_id);
		$this->tpl->display("link/module.html");
	}

	function cate_f()
	{
		$this->auto_load();
		$this->cate_m->langid($_SESSION["sys_lang_id"]);
		$this->cate_m->get_all();
		$this->cate_m->format_list(0,0);
		$catelist = $this->cate_m->flist();
		if(!is_array($catelist)) $catelist = array();
		foreach($catelist AS $key=>$value)
		{
			$value["space"] = "";
			for($i=0;$i<$value["level"];$i++)
			{
				$value["space"] .= "　　";
			}
			$catelist[$key] = $value;
		}
		$this->tpl->assign("catelist",$catelist);
		$input_id = $this->trans_lib->safe("input_id");
		if(!$input_id) $input_id = "link,link_rewrite,link_html";
		$this->tpl->assign("input_id",$input_id);
		$this->tpl->display("link/cate.html");
	}

	function subject_f()
	{
		$this->auto_load();
		$input_id = $this->trans_lib->safe("input_id");
		if(!$input_id) $input_id = "link,link_rewrite,link_html";
		$this->tpl->assign("input_id",$input_id);
		$page_url = $this->url("link,subject","input_id=".rawurlencode($input_id));
		$pageid = $this->trans_lib->int(SYS_PAGEID);
		$condition = "l.langid='".$_SESSION["sys_lang_id"]."' ";
		$condition.= " AND m.ctrl_init='list' AND m.if_msg='1' ";
		$keywords = $this->trans_lib->safe("keywords");
		if($keywords)
		{
			$condition .= " AND l.title LIKE '%".$keywords."%' ";
			$page_url .= "keywords=".rawurlencode($keywords)."&";
		}
		$rslist = $this->list_m->get_link($pageid,$condition);
		$this->tpl->assign("rslist",$rslist);
		$total_count = $this->list_m->get_link_count($condition);//取得总数
		$pagelist = $this->page_lib->page($page_url,$total_count);
		$this->tpl->assign("pagelist",$pagelist);
		$this->tpl->display("link/subject.html");
	}
	
	function project_f()
	{
		$this->auto_load();
		$input_d = $this->trans_lib->safe("input_d");
		$this->tpl->assign("input_d",$input_d);
		$page_url = $this->url("link,project","input_d=".rawurlencode($input_d));
		$pageid = $this->trans_lib->int(SYS_PAGEID);
		$condition = "l.langid='".$_SESSION["sys_lang_id"]."' ";
		$condition.= " AND l.module_id='3' ";
		$keywords = $this->trans_lib->safe("keywords");
		if($keywords)
		{
			$condition .= " AND l.title LIKE '%".$keywords."%' ";
			$page_url .= "keywords=".rawurlencode($keywords)."&";
		}
		$rslist = $this->list_m->get_link($pageid,$condition);
		$this->tpl->assign("rslist",$rslist);
		$total_count = $this->list_m->get_link_count($condition);//取得总数
		$pagelist = $this->page_lib->page($page_url,$total_count);
		$this->tpl->assign("pagelist",$pagelist);
		$this->tpl->display("link/project.html");
	}
	
	
	function user_f()
	{
		$this->auto_load();
		$input_id = $this->trans_lib->safe("input_id");
		$input_i = $this->trans_lib->safe("input_i");
		if(!$input_id) $input_id = "link,link_rewrite,link_html";
		$this->tpl->assign("input_id",$input_id);
		$this->tpl->assign("input_i",$input_i);
		$page_url = $this->url("link,user","input_i=".rawurlencode($input_i)."&input_id=".rawurlencode($input_id));
		$pageid = $this->trans_lib->int(SYS_PAGEID);
		$offset = $pageid>0 ? ($pageid-1)*SYS_PSIZE : 0;
		$condition = " 1=1 ";
		$rslist = $this->user_m->get_list($offset,$condition);
		$this->tpl->assign("rslist",$rslist);
		$total_count = $this->user_m->get_count($condition);
		$pagelist = $this->page_lib->page($page_url,$total_count);
		$this->tpl->assign("pagelist",$pagelist);
		$this->tpl->display("link/user.html");
	}
	function customer_f()
	{
		$this->auto_load();
		$input_cid = $this->trans_lib->safe("input_cid");
		$input_c = $this->trans_lib->safe("input_c");
		$this->tpl->assign("input_cid",$input_cid);
		$this->tpl->assign("input_c",$input_c);
		$page_url = $this->url("link,customer","input_cid=".rawurlencode($input_cid)."&input_c=".rawurlencode($input_c));
		$pageid = $this->trans_lib->int(SYS_PAGEID);
		$offset = $pageid>0 ? ($pageid-1)*SYS_PSIZE : 0;
		$condition = " 1=1 ";
		$rslist = $this->customer_m->get_list($offset,$condition);
		$this->tpl->assign("rslist",$rslist);
		$total_count = $this->customer_m->get_count($condition);
		$pagelist = $this->page_lib->page($page_url,$total_count);
		$this->tpl->assign("pagelist",$pagelist);
		$this->tpl->display("link/customer.html");
	}
	function email_f()
	{
		$this->auto_load();
		$page_url = $this->url("link,email");
		$pageid = $this->trans_lib->int(SYS_PAGEID);
		$condition = "l.langid='".$_SESSION["sys_lang_id"]."' ";
		$condition.= " AND m.ctrl_init='list' AND m.if_msg='1' ";
		$keywords = $this->trans_lib->safe("keywords");
		if($keywords)
		{
			$condition .= " AND l.title LIKE '%".$keywords."%' ";
			$page_url .= "keywords=".rawurlencode($keywords)."&";
		}
		$rslist = $this->list_m->get_link($pageid,$condition);
		$this->tpl->assign("rslist",$rslist);
		$total_count = $this->list_m->get_link_count($condition);//取得总数
		$pagelist = $this->page_lib->page($page_url,$total_count);
		$this->tpl->assign("pagelist",$pagelist);
		$this->tpl->display("link/email.html");
	}

	function lang_f()
	{
		$this->load_model("lang");
		$langlist = $this->lang_m->get_list();
		if(!$langlist)
		{
			error("未设置语言包！");
		}
		foreach($langlist AS $key=>$value)
		{
			$value["phpfile"] = "{index_php}";
			$value["html"] = "{site_url}{index_php}?langid=".$value["langid"];
			$langlist[$key] = $value;
		}
		$this->tpl->assign("langlist",$langlist);
		$input_id = $this->trans_lib->safe("input_id");
		if(!$input_id) $input_id = "link,link_rewrite,link_html";
		$this->tpl->assign("input_id",$input_id);
		$this->tpl->display("link/lang.html");
	}
}
?>