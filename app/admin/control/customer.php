<?php
class customer_c extends Control
{
	function __construct()
	{
		parent::Control();
		$this->load_model("customer");
	}

	//兼容PHP4的写法
	function customer_c()
	{
		$this->__construct();
	}

	//会员列表
	function index_f()
	{
		sys_popedom("customer:list","tpl");
		$pageid = $this->trans_lib->int(SYS_PAGEID);
		$offset = $pageid>0 ? ($pageid-1)*SYS_PSIZE : 0;
		$condition = " 1=1 ";
		$startdate = $this->trans_lib->safe("startdate");
		$page_url = $this->url("customer");
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
			if($status==1){
				$sta=1;
			}
			elseif($status==3){
				$sta=2;
			}
			else{
				$sta=0;
			}
			$condition .= " AND status='".$sta."'";
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
		$total = $this->customer_m->get_count($condition);
		$rslist = $this->customer_m->get_list($offset,$condition);
		$this->tpl->assign("total",$total);
		$this->tpl->assign("rslist",$rslist);
		$pagelist = $this->page_lib->page($page_url,$total);
		$this->tpl->assign("pagelist",$pagelist);
		$this->tpl->display("customer/list.html");
	}

	function set_f()
	{
		$id = $this->trans_lib->int("id");
		if($id)
		{
			sys_popedom("customer:modify","tpl");
			$rs = $this->customer_m->get_one($id);
			$this->tpl->assign("rs",$rs);
		}
		else
		{
			sys_popedom("customer:add","tpl");
		}
		$this->tpl->display("customer/set.html");
	}

	//存储信息
	function setok_f()
	{
		$id = $this->trans_lib->int("id");
		if($id)
		{
			sys_popedom("customer:modify","tpl");
		}
		else
		{
			sys_popedom("customer:add","tpl");
		}
		$array = array();
		$array["uid"] = $this->trans_lib->safe("uid");
		$array["daofang"] = $this->trans_lib->safe("daofang");
		$array["dfnote"] = $this->trans_lib->html("dfnote");
		$array["renchou"] = $this->trans_lib->safe("renchou");
		$array["rcnote"] = $this->trans_lib->html("rcnote");
		$array["rengou"] = $this->trans_lib->safe("rengou");
		$array["rgnote"] = $this->trans_lib->html("rgnote");
		$array["qianyue"] = $this->trans_lib->safe("qianyue");
		$array["qynote"] = $this->trans_lib->html("qynote");
		$array["huikuan"] = $this->trans_lib->safe("huikuan");
		$array["hknote"] = $this->trans_lib->html("hknote");
		$array["guwenname"] = $this->trans_lib->safe("guwenname");
		$array["guwentel"] = $this->trans_lib->safe("guwentel");
		$array["uname"] = $this->trans_lib->safe("uname");
		$array["username"] = $this->trans_lib->safe("username");
		$array["cellphone"] = $this->trans_lib->safe("cellphone");
		$array["proname"] = $this->trans_lib->safe("proname");
		$array["appointment_date"] = $this->trans_lib->safe("appointment_date");
		$array["appointment_time"] = $this->trans_lib->safe("appointment_time");
		$array["postdate"] = $this->system_time;
		$insert_id = $this->customer_m->save($array,$id);
		error("推荐人信息添加/存储成功",site_url("customer"));
	}

	function ajax_status_f()
	{
		$id = $this->trans_lib->int("id");
		if(!$id)
		{
			exit("error:没有指定ID");
		}
		sys_popedom("customer:check","ajax");
		$rs = $this->customer_m->get_one($id);
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
		$this->customer_m->set_status($id,$status);
		exit("ok");
	}

	function ajax_del_f()
	{
		$id = $this->trans_lib->int("id");
		if(!$id)
		{
			exit("error:没有指定ID");
		}
		sys_popedom("customer:delete","ajax");
		$this->customer_m->del($id);
		exit("ok");
	}
	function pl_status_f()
	{
		sys_popedom("customer:check","ajax");
		$id = $this->trans_lib->safe("id");
		$status = $this->trans_lib->int("status");
		$this->customer_m->status($id,$status);
		exit("ok");
	}
	function del_f()
	{
		sys_popedom("customer:delete","ajax");
		$id = $this->trans_lib->safe("id");
		if(!$id)
		{
			exit("操作错误，没有指定ID！");
		}
		$this->customer_m->del($id);
		exit("ok");
	}
	function pl_del_f()
	{
		sys_popedom("customer:delete","ajax");
		$id = $this->trans_lib->safe("id");
		if(!$id)
		{
			exit("操作错误，没有指定ID！");
		}
		$this->customer_m->pl_del($id);
		exit("ok");
	}
}
?>