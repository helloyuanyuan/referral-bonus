<?php
class customer_c extends Control
{
	var $subject;
	function __construct()
	{
		parent::Control();
		$this->load_model("user");
		$this->load_model("customer");
	}

	function customer_c()
	{
		$this->__construct();
	}

	function index_f()
	{
		if(!$_SESSION["user_id"])
		{
			error('',$this->url('login'));
		}
		$rs = $this->user_m->user_from_id($_SESSION["user_id"]);
		$id=$rs["id"];
		$this->tpl->assign("rs",$rs);
		
		
		$pageid = $this->trans_lib->int(SYS_PAGEID);
		$offset = $pageid>0 ? ($pageid-1)*SYS_PSIZE : 0;
		$rslist = $this->customer_m->get_list($id,$offset,SYS_PSIZE);
		$this->tpl->assign("rslist",$rslist);
		$total = $this->customer_m->get_count($id);
		$this->tpl->assign("total",$total);
		$pageurl = site_url("customer","uid=".$id);
		$this->page_lib->set_psize(SYS_PSIZE);
		$pagelist = $this->page_lib->page($pageurl,$total,true);//分页数组
		$this->tpl->assign("pagelist",$pagelist);
		$this->tpl->assign("rslist",$rslist);

		$sitetitle = $this->lang["customer"];
		$this->tpl->assign("sitetitle",$sitetitle);
		$this->tpl->display("customer.".$this->tpl->ext);
	}
	function view_f()
	{
		if(!$_SESSION["user_id"])
		{
			error('',$this->url('login'));
		}
		$cid = $this->trans_lib->safe("id");
		$rs = $this->customer_m->customer_from_id($cid);
		$this->tpl->assign("rs",$rs);
		$this->tpl->display("msg_customer.".$this->tpl->ext);
	}
}
?>