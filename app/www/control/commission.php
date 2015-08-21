<?php
class commission_c extends Control
{
	var $subject;
	function __construct()
	{
		parent::Control();
		$this->load_model("user");
		$this->load_model("commission");
	}

	function commission_c()
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
		$rslist = $this->commission_m->get_list($id,$offset,SYS_PSIZE);
		$this->tpl->assign("rslist",$rslist);
		$total = $this->commission_m->get_count($id);
		$totalcur_wj = $this->commission_m->get_count_cur($id,0);
		$totalcur_yj = $this->commission_m->get_count_cur($id,1);
		if(!$totalcur_wj){
			$totalcur_wj='0';
		}
		if(!$totalcur_yj){
			$totalcur_yj='0';
		}
		$this->tpl->assign("total",$total);
		$this->tpl->assign("totalcur_wj",$totalcur_wj);
		$this->tpl->assign("totalcur_yj",$totalcur_yj);
		$pageurl = site_url("commission","uid=".$id);
		$this->page_lib->set_psize(SYS_PSIZE);
		$pagelist = $this->page_lib->page($pageurl,$total,true);//分页数组
		$this->tpl->assign("pagelist",$pagelist);
		$this->tpl->assign("rslist",$rslist);

		$this->tpl->display("commission.".$this->tpl->ext);
	}
}
?>