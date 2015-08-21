<?php
class usercp_c extends Control
{
	function __construct()
	{
		parent::Control();
		$this->load_model("user");
		$this->load_model("usergroup");
	}

	function usercp_c()
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
		$sitetitle = $this->lang["usercp_changepass"]." - ".$this->lang["usercp"];
		$this->tpl->assign("sitetitle",$sitetitle);
		$array[0]["title"] = $this->lang["usercp"];
		$array[0]["url"] = site_url("usercp");
		$array[1]["title"] = $this->lang["usercp_changepass"];
		$this->tpl->assign("leader",$array);
		$this->tpl->display("usercp.".$this->tpl->ext);
	}
	function info_f()
	{
		if(!$_SESSION["user_id"])
		{
			error('',$this->url('login'));
		}
		$rs = $this->user_m->user_from_id($_SESSION["user_id"]);
		$this->tpl->assign("rs",$rs);
		$this->tpl->display("usercp_info.".$this->tpl->ext);
	}
	function ok_f()
	{
		if(!$_SESSION["user_id"])
		{
			error('',$this->url('login'));
		}
		$rs = $this->user_m->user_from_id($_SESSION["user_id"]);
		$array = array();
		$array["username"] = $this->trans_lib->safe("name");
		$array["job"] = $this->trans_lib->safe("job");
		$array["company"] = $this->trans_lib->safe("company");
		if(!$array["username"] || !$array["job"])
		{
			echo "信息输入不完整";
			exit;
		}
		//更新密码
		$this->user_m->update($array,$_SESSION["user_id"]);
		echo "1";
		exit;
	}
	function bank_f()
	{
		if(!$_SESSION["user_id"])
		{
			error('',$this->url('login'));
		}
		$rs = $this->user_m->user_from_id($_SESSION["user_id"]);
		$this->tpl->assign("rs",$rs);
		$this->tpl->display("usercp_bank.".$this->tpl->ext);
	}
	function savebank_f()
	{
		if(!$_SESSION["user_id"])
		{
			error('',$this->url('login'));
		}
		$rs = $this->user_m->user_from_id($_SESSION["user_id"]);
		$array = array();
		$array["bankAccount"] = $this->trans_lib->safe("bankAccount");
		$array["cardCode"] = $this->trans_lib->safe("cardCode");
		$array["bankName"] = $this->trans_lib->safe("bankName");
		if(!$array["bankAccount"] || !$array["cardCode"] || !$array["bankName"])
		{
			echo "信息输入不完整";
			exit;
		}
		//更新密码
		$this->user_m->update($array,$_SESSION["user_id"]);
		echo "1";
		exit;
	}
}
?>