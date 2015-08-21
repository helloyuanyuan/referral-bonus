<?php
class commission_m extends Model
{
	function __construct()
	{
		parent::Model();
	}

	function commission_m()
	{
		$this->__construct();
	}

	function get_list($uid,$offset=0,$psize=30)
	{
		$sql = "SELECT * FROM ".$this->db->prefix."commission WHERE uid='".$uid."' ORDER BY postdate DESC,id DESC LIMIT ".$offset.",".$psize;
		return $this->db->get_all($sql);
	}
	function get_count($uid)
	{
		$sql = "SELECT count(id) total FROM ".$this->db->prefix."commission WHERE uid='".$uid."' ";
		return $this->db->count($sql);
	}
	function get_count_cur($uid,$status=0)
	{
		$sql = "SELECT sum(money) total FROM ".$this->db->prefix."commission WHERE uid='".$uid."' and status='".$status."' ";
		return $this->db->count($sql);
	}
}
?>