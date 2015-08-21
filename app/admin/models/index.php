<?php
class index_m extends Model
{
	var $langid = "zh";
	function __construct()
	{
		parent::Model();
		$this->langid = $_SESSION["sys_lang_id"];
	}

	function index_m()
	{
		$this->__construct();
	}

	//加载模块数
	//groupid：组ID
	//status：状态
	function module_group($groupid="",$status="0")
	{
		$sql = "SELECT * FROM ".$this->db->prefix."module_group WHERE 1=1 ";
		if($status)
		{
			$sql .= " AND status='1' ";
		}
		if($groupid)
		{
			$sql .= " AND id='".$groupid."' ";
			return $this->db->get_one($sql);
		}
		else
		{
			$sql .= " ORDER BY taxis ASC,id DESC ";
			return $this->db->get_all($sql);
		}
	}

}
?>