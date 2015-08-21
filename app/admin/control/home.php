<?php
class home_c extends Control
{
	function __construct()
	{
		parent::Control();
		$this->load_model("home");
		$this->load_model("user");
		$this->load_model("customer");
	}

	function home_c()
	{
		$this->__construct();
	}

	function index_f()
	{
		$this->home_m->langid($_SESSION["sys_lang_id"]);
		if(function_exists("gd_info"))
		{
			$gd = gd_info();
			$gdinfo = $gd["GD Version"];
		}
		else
		{
			$gdinfo = "不支持";
		}
		$this->tpl->assign("gdinfo",$gdinfo);
		$condition = " 1=1 ";
		$conditio = " 1=1 ";
		$user_count = $this->user_m->get_count($condition);
		$customer_count = $this->customer_m->get_count($conditio);
		$this->tpl->assign("user_count",$user_count);
		$this->tpl->assign("customer_count",$customer_count);
		$this->tpl->display("home.html");
	}

	function info_f()
	{
		phpinfo();
		exit;
	}
	function ajax_user_f()
	{
		$this->home_m->langid($_SESSION["sys_lang_id"]);
		$condition = " 1=1 ";
		$user_count = $this->user_m->get_count($condition);
		echo $user_count;
	}
	function ajax_customer_f()
	{
		$this->home_m->langid($_SESSION["sys_lang_id"]);
		$condition = " 1=1 ";
		$customer_count = $this->customer_m->get_count($condition);
		echo $customer_count;
	}
}
?>