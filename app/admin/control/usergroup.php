<?php
class usergroup_c extends Control
{
	function __construct()
	{
		parent::Control();
		$this->load_model("usergroup");
	}

	//兼容PHP4的写法
	function user_c()
	{
		$this->__construct();
	}

	function index_f()
	{
		sys_popedom("usergroup:list","tpl");//查看权限
		$rslist = $this->usergroup_m->get_all();
		$this->tpl->assign("rslist",$rslist);
		$this->tpl->display("user/group_list.html");
	}

	function set_f()
	{
		$id = $this->trans_lib->int("id");
		$id ? sys_popedom("usergroup:modify","tpl") : sys_popedom("usergroup:add","tpl");
		if($id)
		{
			$rs = $this->usergroup_m->get_one($id);
			$this->tpl->assign("rs",$rs);
			$this->tpl->assign("id",$id);
		}
		$this->tpl->display("user/group_set.html");
	}

	//存储信息
	function setok_f()
	{
		$id = $this->trans_lib->int("id");
		$id ? sys_popedom("usergroup:modify","tpl") : sys_popedom("usergroup:add","tpl");
		$title = $this->trans_lib->safe("title");
		if(!$title)
		{
			error("组名称不允许为空！",$this->url("usergroup,set","id=".$id));
		}
		$array = array();
		$array["title"] = $title;
		if(!$id)
		{
			$array["group_type"] = "user";
			$array["ifsystem"] = 0;
			$array["ifdefault"] = 0;
		}
		$this->usergroup_m->save($array,$id);
		error("会员组信息添加/存储成功",$this->url("usergroup"));
	}

	//设置默认
	function ajax_default_f()
	{
		$id = $this->trans_lib->int("id");
		if(!$id)
		{
			exit("error:没有指定ID");
		}
		$rs = $this->usergroup_m->set_default($id);
		exit("ok");
	}

	function ajax_del_f()
	{
		$id = $this->trans_lib->int("id");
		if(!$id)
		{
			exit("error:没有指定ID");
		}
		sys_popedom("usergroup:delete","ajax");
		$rs = $this->usergroup_m->get_one($id);
		if($rs["ifdefault"])
		{
			exit("默认组不允许删除！");
		}
		if($rs["ifsystem"])
		{
			exit("系统组不允许删除！");
		}
		$this->usergroup_m->del($id);
		exit("ok");
	}
}
?>