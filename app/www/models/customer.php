<?php
class customer_m extends Model
{
	function __construct()
	{
		parent::Model();
	}

	function customer_m()
	{
		$this->__construct();
	}

	function get_list($uid,$offset=0,$psize=30)
	{
		$sql = "SELECT * FROM ".$this->db->prefix."customer WHERE uid='".$uid."' ORDER BY postdate DESC,id DESC LIMIT ".$offset.",".$psize;
		return $this->db->get_all($sql);
	}
	function get_count($uid)
	{
		$sql = "SELECT count(id) total FROM ".$this->db->prefix."customer WHERE uid='".$uid."' ";
		return $this->db->count($sql);
	}
	function customer_from_id($id)
	{
		$this->db->close_cache();
		$sql = "SELECT * FROM ".$this->db->prefix."customer WHERE id='".$id."'";
		$rs = $this->db->get_one($sql);
		if(!$rs) return false;
		$this->db->open_cache();
		return $rs;
	}
}
?>