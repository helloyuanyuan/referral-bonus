<?php
class recommend_c extends Control
{
	var $subject;
	function __construct()
	{
		parent::Control();
		$this->load_model("user");
		$this->load_model("recommend");
	}

	function recommend_c()
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
		$this->tpl->assign("rs",$rs);
		
		$rslist = $this->recommend_m->get_list(3);
		$this->tpl->assign("rslist",$rslist);

		$sitetitle = $this->lang["recommend"];
		$this->tpl->assign("sitetitle",$sitetitle);
		$this->tpl->display("recommend.".$this->tpl->ext);
	}

	function save_f()
	{
		if(!$_SESSION["user_id"])
		{
			error('',$this->url('login'));
		}
		$array = array();
		$array["username"] = $this->trans_lib->safe("username");
		$array["cellphone"] = $this->trans_lib->safe("cellphone");
		$array["proname"] = $this->trans_lib->safe("proname");
		$array["appointment_date"] = $this->trans_lib->safe("selorderTime");
		$array["appointment_time"] = $this->trans_lib->safe("selorderTime2");
		$array["remark"] = $this->trans_lib->safe("remark");
		$array["uid"] = $_SESSION["user_id"];
		$array["uname"] = $_SESSION["user_name"];
		$array["postdate"] = $this->system_time;
		$array["status"] = 0;
		if(!$array["username"])
		{
			echo "请输入被推荐人的姓名";
			exit;
		}
		if(!$array["cellphone"])
		{
			echo "请输入被推荐人的手机号码";
			exit;
		}
		if(!$array["proname"])
		{
			echo "请选择意向项目";
			exit;
		}
		$checkcellphone = $this->checkcellphone($array["cellphone"]);
		if($checkcellphone != "0")
		{
			echo "该手机号用户已被推荐过了";
			exit;
		}
		$this->recommend_m->save($array);
		echo "1";
		exit;
	}
	
	
	
	//检测手机号是否存在
	function checkcellphone_f()
	{
		$cellphone = $this->trans_lib->safe("cellphone");
		exit($this->checkcellphone($cellphone));
	}
	function checkcellphone($cellphone)
	{
		if(!$cellphone)
		{
			return "1";
		}
		$rs = $this->recommend_m->customer_from_cellphone($cellphone);
		if($rs)
		{
			return "1";
		}
		else
		{
			return "0";
		}
	}
	
	//检测是否自己手机号
	function checkismycellphone_f()
	{
		$cellphone = $this->trans_lib->safe("cellphone");
		exit($this->checkismycellphone($cellphone));
	}
	function checkismycellphone($cellphone)
	{
		if(!$cellphone)
		{
			return "1";
		}
		if($_SESSION["user_id"])
		{
			$rs = $this->user_m->user_my_cellphone($_SESSION["user_id"],$cellphone);
			if($rs)
			{
				return "1";
			}
			else
			{
				return "0";
			}
		}
	}
}
?>