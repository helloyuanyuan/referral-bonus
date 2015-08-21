<?php
class home_c extends Control
{
	function __construct()
	{
		parent::Control();
		$this->load_model("user");
	}

	function home_c()
	{
		$this->__construct();
	}

	function index_f()
	{
		$urs = $this->user_m->user_from_id($_SESSION["user_id"]);
		$this->tpl->assign("urs",$urs);
		$total = $this->user_m->get_count($_SESSION["user_id"]);
		$money = $this->user_m->get_money($_SESSION["user_id"]);
		if(!$money){
			$money ='0';
		}
		$this->tpl->assign("total",$total);
		$this->tpl->assign("money",$money);
		$this->tpl->display("index.".$this->tpl->ext);
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