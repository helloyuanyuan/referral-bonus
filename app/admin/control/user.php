<?php
class user_c extends Control
{
	function __construct()
	{
		parent::Control();
		$this->load_model("user");
		$this->load_model("usergroup");
		$this->load_model("module");
	}

	//兼容PHP4的写法
	function user_c()
	{
		$this->__construct();
	}

	//会员列表
	function index_f()
	{
		sys_popedom("user:list","tpl");
		$pageid = $this->trans_lib->int(SYS_PAGEID);
		$offset = $pageid>0 ? ($pageid-1)*SYS_PSIZE : 0;
		$condition = " 1=1 ";
		$startdate = $this->trans_lib->safe("startdate");
		$page_url = $this->url("user");
		if($startdate)
		{
			$this->tpl->assign("startdate",$startdate);
			$condition .= " AND regdate>='".strtotime($startdate)."'";
			$page_url .= "startdate=".rawurlencode($startdate)."&";
		}
		$enddate = $this->trans_lib->safe("enddate");
		if($enddate)
		{
			$this->tpl->assign("enddate",$enddate);
			$condition .= " AND regdate<='".strtotime($enddate)."'";
			$page_url .= "enddate=".rawurlencode($enddate)."&";
		}
		$status = $this->trans_lib->int("status");
		if($status)
		{
			$this->tpl->assign("status",$status);
			$condition .= " AND status='".($status == 1 ? 1 : 0)."'";
			$page_url .= "status=".$status."&";
		}
		$fxstatus = $this->trans_lib->int("fxstatus");
		if($fxstatus)
		{
			$this->tpl->assign("fxstatus",$fxstatus);
			$condition .= " AND fxstatus='".($fxstatus == 1 ? 1 : 0)."'";
			$page_url .= "fxstatus=".$fxstatus."&";
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
		$total = $this->user_m->get_count($condition);
		$rslist = $this->user_m->get_list($offset,$condition);
		$this->tpl->assign("total",$total);
		$this->tpl->assign("rslist",$rslist);
		$pagelist = $this->page_lib->page($page_url,$total);
		$this->tpl->assign("pagelist",$pagelist);
		
		$grouplist = $this->usergroup_m->get_all();
		$this->tpl->assign("grouplist",$grouplist);
		
		$this->tpl->display("user/list.html");
	}

	function set_f()
	{
		$id = $this->trans_lib->int("id");
		$groupid = $this->trans_lib->int("groupid");
		if($id)
		{
			sys_popedom("user:modify","tpl");
			$rs = $this->user_m->get_one($id);
			$this->tpl->assign("rs",$rs);
			if(!$groupid) $groupid = $rs["groupid"];
		}
		else
		{
			sys_popedom("user:add","tpl");
		}
		if(!$groupid)
		{
			$group_rs = $this->usergroup_m->get_default();
			$groupid = $group_rs["id"];
		}
		if(!$groupid)
		{
			error("没有获取到用户组！");
		}
		$this->tpl->assign("groupid",$groupid);
		$grouplist = $this->usergroup_m->get_all();
		$this->tpl->assign("grouplist",$grouplist);
		$this->tpl->display("user/set.html");
	}

	function chk_f()
	{
		$id = $this->trans_lib->int("id");
		$phone = $this->trans_lib->safe("phone");
		if(!$phone)
		{
			exit("error: 电话不允许为空");
		}
		$rs_phone = $this->user_m->chk_phone($phone,$id);
		if($rs_phone)
		{
			exit("error:会员账号已经存在");
		}
		exit("ok");
	}

	//存储信息
	function setok_f()
	{
		$id = $this->trans_lib->int("id");
		if($id)
		{
			sys_popedom("user:modify","tpl");
		}
		else
		{
			sys_popedom("user:add","tpl");
		}
		$array = array();
		$array["username"] = $this->trans_lib->safe("username");
		$pass = $this->trans_lib->safe("pass");
		if($pass)
		{
			$array["pass"] = sys_md5($pass);
		}
		else
		{
			if(!$id)
			{
				$array["pass"] = sys_md5("123456");
			}
		}
		$array["phone"] = $this->trans_lib->safe("phone");//模板目录
		$array["job"] = $this->trans_lib->safe("job");//模板目录
		$array["company"] = $this->trans_lib->safe("company");//模板目录
		$regdate = $this->trans_lib->safe("regdate");
		$array["regdate"] = $regdate ? strtotime($regdate) : $this->system_time;
		$array["thumb_id"] = $this->trans_lib->int("thumb_id");//存储图像
		$array["groupid"] = $this->trans_lib->int("groupid");//存储会员组
		$array["fxstatus"] = $this->trans_lib->int("fxstatus");//存储会员组
		$array["bankAccount"] = $this->trans_lib->safe("bankAccount");//存储会员组
		$array["cardCode"] = $this->trans_lib->safe("cardCode");//存储会员组
		$array["bankName"] = $this->trans_lib->safe("bankName");//存储会员组
		//存储扩展表信息
		$insert_id = $this->user_m->save($array,$id);
		error("会员信息添加/存储成功",site_url("user"));
	}

	function ajax_status_f()
	{
		$id = $this->trans_lib->int("id");
		if(!$id)
		{
			exit("error:没有指定ID");
		}
		sys_popedom("user:check","ajax");
		$rs = $this->user_m->get_one($id);
		$status = $rs["status"] ? 0 : 1;
		$this->user_m->set_status($id,$status);
		exit("ok");
	}

	function ajax_del_f()
	{
		$id = $this->trans_lib->int("id");
		if(!$id)
		{
			exit("error:没有指定ID");
		}
		sys_popedom("user:delete","ajax");
		$this->user_m->del($id);
		exit("ok");
	}
	function view_f()
	{
		$id = $this->trans_lib->int("id");
		if(!$id)
		{
			error("error: 操作错误");
		}
		$rs = $this->user_m->get_one($id);
		$this->tpl->assign("rs",$rs);
		$this->tpl->display("user/view.html");
	}
	function pl_status_f()
	{
		sys_popedom("user:check","ajax");
		$id = $this->trans_lib->safe("id");
		$status = $this->trans_lib->int("status");
		$this->user_m->status($id,$status);
		exit("ok");
	}
	function del_f()
	{
		sys_popedom("user:delete","ajax");
		$id = $this->trans_lib->safe("id");
		if(!$id)
		{
			exit("操作错误，没有指定ID！");
		}
		$this->user_m->del($id);
		exit("ok");
	}
	function pl_del_f()
	{
		sys_popedom("user:delete","ajax");
		$id = $this->trans_lib->safe("id");
		if(!$id)
		{
			exit("操作错误，没有指定ID！");
		}
		$this->user_m->pl_del($id);
		exit("ok");
	}
}
?>