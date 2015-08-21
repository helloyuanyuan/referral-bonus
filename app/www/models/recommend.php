<?php
class recommend_m extends Model
{
	function __construct()
	{
		parent::Model();
	}

	function recommend_m()
	{
		$this->__construct();
	}

	function save($data)
	{
		if(!$data || !is_array($data))
		{
			return false;
		}
		return $this->db->insert_array($data,"customer");
	}

	function get_list($mid)
	{
		$this->db->close_cache();
		$sql = "SELECT * FROM ".$this->db->prefix."list where status='1' ";
		if($mid)
		{
			$sql .= " AND  module_id='".$mid."' ";
		}
		$sql.= " ORDER BY post_date DESC,id DESC ";
		return $this->db->get_all($sql);
	}
	//通过手机号登录验证
	function customer_from_cellphone($cellphone)
	{
		$this->db->close_cache();
		$sql = "SELECT id FROM ".$this->db->prefix."customer WHERE cellphone='".$cellphone."'";
		$rs = $this->db->get_one($sql);
		if(!$rs) return false;
		$this->db->open_cache();
		return $rs;
	}
}
?>