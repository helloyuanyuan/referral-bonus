<?php
class register_c extends Control
{
	function __construct()
	{
		parent::Control();
		$this->load_model("user");
	}

	function register_c()
	{
		$this->__construct();
	}

	function index_f()
	{
		if(!$this->sys_config["reg_status"])
		{
			$message = $this->sys_config["close_reg"] ? $this->sys_config["close_reg"] : "No register!";
			error($message,$this->url());
		}

		if($_SESSION["user_id"])
		{
			error('',$this->url('home'));
		}

		$sitetitle = $this->lang["register"];
		$this->tpl->assign("sitetitle",$sitetitle);
		$array[0]["title"] = $this->lang["register"];
		$this->tpl->assign("leader",$array);
		$this->tpl->display("register.".$this->tpl->ext);
	}
	//存储个人信息
	function setok_f()
	{
		if(!$this->sys_config["reg_status"])
		{
			$message = $this->sys_config["close_reg"] ? $this->sys_config["close_reg"] : "No register!";
			echo $message;
			exit;
		}
		if($_SESSION["user_id"])
		{
			error('',$this->url('home'));
		}
		$array = array();
		$array["username"] = $this->trans_lib->safe("name");
		$array["phone"] = $this->trans_lib->safe("phone");
		$newpass = $this->trans_lib->safe("password");
		$array["job"] = $this->trans_lib->safe("job");
		$array["company"] = $this->trans_lib->safe("company");
		if(!$newpass)
		{
			echo $this->lang["empty_pass"];
			exit;
		}
		$array["pass"] = sys_md5($newpass);

		$checkphone = $this->checkphone($array["phone"]);
		if($checkphone != "0")
		{
			echo $chkname;
			exit;
		}
		
		$array["regdate"] = $this->system_time;
		$array["status"] = 1;
		//会员组
		$this->load_model("usergroup");
		$group_rs = $this->usergroup_m->get_default();
		$array["groupid"] = $group_rs["id"];
		$user_id = $this->user_m->save($array);
		//会员注册成功，模拟登录
		$_SESSION["user_id"] = $user_id;
		$_SESSION["user_name"] = $array["username"];
		$_SESSION["group_id"] = $array["groupid"];
		$tmp_array = $array;
		$tmp_array["id"] = $user_id;
		$_SESSION["user_rs"] = $tmp_array;
		//发送欢迎信息
		if($this->sys_config["smtp_reg"])
		{
			$this->load_lib("email");
			$this->email_lib->reg($user_id);
		}
		echo "1";
		exit;
	}

	//检测手机号是否存在
	function checkphone_f()
	{
		$phone = $this->trans_lib->safe("phone");
		exit($this->checkphone($phone));
	}

	function checkphone($phone)
	{
		if(!$phone)
		{
			return "1";
		}
		$rs = $this->user_m->user_from_phone($phone);
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
?>