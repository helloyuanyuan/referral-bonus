<?php
class commission_c extends Control
{
	function __construct()
	{
		parent::Control();
		$this->load_model("commission");
	}

	//兼容PHP4的写法
	function commission_c()
	{
		$this->__construct();
	}

	//会员列表
	function index_f()
	{
		sys_popedom("commission:list","tpl");
		$pageid = $this->trans_lib->int(SYS_PAGEID);
		$offset = $pageid>0 ? ($pageid-1)*SYS_PSIZE : 0;
		$condition = " 1=1 ";
		$startdate = $this->trans_lib->safe("startdate");
		$page_url = $this->url("commission");
		if($startdate)
		{
			$this->tpl->assign("startdate",$startdate);
			$condition .= " AND postdate>='".strtotime($startdate)."'";
			$page_url .= "startdate=".rawurlencode($startdate)."&";
		}
		$enddate = $this->trans_lib->safe("enddate");
		if($enddate)
		{
			$this->tpl->assign("enddate",$enddate);
			$condition .= " AND postdate<='".strtotime($enddate)."'";
			$page_url .= "enddate=".rawurlencode($enddate)."&";
		}
		$status = $this->trans_lib->int("status");
		if($status)
		{
			$this->tpl->assign("status",$status);
			$condition .= " AND status='".($status == 1 ? 1 : 0)."'";
			$page_url .= "status=".$status."&";
		}
		$keytype = $this->trans_lib->safe("keytype");
		$keywords = $this->trans_lib->safe("keywords");
		if($keytype && $keywords)
		{
			$this->tpl->assign("keytype",$keytype);
			$this->tpl->assign("keywords",$keywords);
			$condition .= " AND ".$keytype." LIKE '%".$keywords."%' ";
			$page_url .= "keytype=".rawurlencode($keytype)."&keywords=".rawurlencode($keywords)."&";
		}
		$total = $this->commission_m->get_count($condition);
		$rslist = $this->commission_m->get_list($offset,$condition);
		$this->tpl->assign("total",$total);
		$this->tpl->assign("rslist",$rslist);
		$pagelist = $this->page_lib->page($page_url,$total);
		$this->tpl->assign("pagelist",$pagelist);
		$this->tpl->display("commission/list.html");
	}

	function set_f()
	{
		$id = $this->trans_lib->int("id");
		if($id)
		{
			sys_popedom("commission:modify","tpl");
			$rs = $this->commission_m->get_one($id);
			$this->tpl->assign("rs",$rs);
		}
		else
		{
			sys_popedom("commission:add","tpl");
		}
		$this->tpl->display("commission/set.html");
	}

	//存储信息
	function setok_f()
	{
		$id = $this->trans_lib->int("id");
		if($id)
		{
			sys_popedom("commission:modify","tpl");
		}
		else
		{
			sys_popedom("commission:add","tpl");
		}
		$array = array();
		$array["uid"] = $this->trans_lib->safe("uid");
		$array["uname"] = $this->trans_lib->safe("uname");
		$array["cid"] = $this->trans_lib->safe("cid");
		$array["username"] = $this->trans_lib->safe("username");
		$array["proname"] = $this->trans_lib->safe("proname");
		$array["ctype"] = $this->trans_lib->safe("ctype");
		$array["money"] = $this->trans_lib->safe("money");
		$array["postdate"] = $this->system_time;
		$insert_id = $this->commission_m->save($array,$id);
		error("佣金明细添加/存储成功",site_url("commission"));
	}

	function ajax_status_f()
	{
		$id = $this->trans_lib->int("id");
		if(!$id)
		{
			exit("error:没有指定ID");
		}
		sys_popedom("commission:check","ajax");
		$rs = $this->commission_m->get_one($id);
		if($rs["status"]==1)
		{
			$status=2;
		}
		elseif($rs["status"]==2)
		{
			$status=0;
		}
		else
		{
			$status=1;
		}
		$this->commission_m->set_status($id,$status);
		exit("ok");
	}

	function ajax_del_f()
	{
		$id = $this->trans_lib->int("id");
		if(!$id)
		{
			exit("error:没有指定ID");
		}
		sys_popedom("commission:delete","ajax");
		$this->commission_m->del($id);
		exit("ok");
	}
	function pl_status_f()
	{
		sys_popedom("commission:check","ajax");
		$id = $this->trans_lib->safe("id");
		$status = $this->trans_lib->int("status");
		$this->commission_m->status($id,$status);
		exit("ok");
	}
	function del_f()
	{
		sys_popedom("commission:delete","ajax");
		$id = $this->trans_lib->safe("id");
		if(!$id)
		{
			exit("操作错误，没有指定ID！");
		}
		$this->commission_m->del($id);
		exit("ok");
	}
	function pl_del_f()
	{
		sys_popedom("commission:delete","ajax");
		$id = $this->trans_lib->safe("id");
		if(!$id)
		{
			exit("操作错误，没有指定ID！");
		}
		$this->commission_m->pl_del($id);
		exit("ok");
	}
}
?>