<?php
class index_c extends Control
{
	function __construct()
	{
		parent::Control();
		$this->load_model("user");
	}

	function index_c()
	{
		$this->__construct();
	}

	function index_f()
	{
		$this->tpl->display("home.".$this->tpl->ext);
	}

	//网站关闭说明
	function close_f()
	{
		$this->tpl->display("close.".$this->tpl->ext);
	}
	function updategroup_f()
	{
		if(!$_SESSION["user_id"])
		{
			echo "分享成功";
			exit;
		}else{
			$uid = $_SESSION["user_id"];
			$this->user_m->update_group($uid);
			echo "分享成功，你已经升级为金牌合伙人";
			exit;
		}
	}
}
?>