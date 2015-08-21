<?php
class setting_c extends Control
{
	var $module_sign = "setting";
	function __construct()
	{
		parent::Control();
	}

	function setting_c()
	{
		$this->__construct();
	}

	function index_f()
	{
		sys_popedom($this->module_sign.":setting","tpl");
		$file = ROOT_DATA."system_".$_SESSION["sys_lang_id"].".php";
		$_sys = array();
		if(file_exists($file))
		{
			include($file);
		}
		$this->tpl->assign("rs",$_sys);
		$if_modify = sys_popedom($this->module_sign.":modify");
		$this->tpl->assign("if_modify",$if_modify);
		$this->load_model("gdtype");
		$gdlist = $this->gdtype_m->get_all();
		$this->tpl->assign("gdlist",$gdlist);
		$this->tpl->display("setting.html");
	}

	function setok_f()
	{
		sys_popedom($this->module_sign.":setting","tpl");
		$rs = array();
		if($_POST && is_array($_POST) && count($_POST)>0)
		{
			foreach($_POST AS $key=>$value)
			{
				$rs[$key] = $this->trans_lib->safe($key);
			}
		}
		$this->file_lib->vi($rs,ROOT_DATA."system_".$_SESSION["sys_lang_id"].".php","_sys");
		error("数据更新成功！",site_url("setting"));
	}
}
?>