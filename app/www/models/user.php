<?php
class user_m extends Model
{
	function __construct()
	{
		parent::Model();
	}

	function user_m()
	{
		$this->__construct();
	}

	//通过账号登录验证
	function user_from_name($username)
	{
		$this->db->close_cache();
		$sql = "SELECT id FROM ".$this->db->prefix."user WHERE username='".$username."'";
		$tmprs = $this->db->get_one($sql);
		if(!$tmprs) return false;
		$rs = $this->user_from_id($tmprs["id"]);
		$this->db->open_cache();
		return $rs;
	}
	//通过手机号登录验证
	function user_from_phone($phone)
	{
		$this->db->close_cache();
		$sql = "SELECT id FROM ".$this->db->prefix."user WHERE phone='".$phone."'";
		$tmprs = $this->db->get_one($sql);
		if(!$tmprs) return false;
		$rs = $this->user_from_id($tmprs["id"]);
		$this->db->open_cache();
		return $rs;
	}

	//通过ID登录验证
	function user_from_id($id)
	{
		$this->db->close_cache();
		$sql = "SELECT u.*,f.thumb picture FROM ".$this->db->prefix."user u LEFT JOIN ".$this->db->prefix."upfiles f ON(u.thumb_id=f.id) WHERE u.id='".$id."'";
		$rs = $this->db->get_one($sql);
		if(!$rs) return false;
		$this->db->open_cache();
		return $rs;
	}

	function user_my_cellphone($id,$phone)
	{
		$this->db->close_cache();
		$sql = "SELECT id FROM ".$this->db->prefix."user WHERE id='".$id."' AND phone='".$phone."'";
		$rs = $this->db->get_one($sql);
		if(!$rs) return false;
		$this->db->open_cache();
		return $rs;
	}

	function update($data,$uid)
	{
		if(!$data || !$uid)
		{
			return false;
		}
		return $this->db->update_array($data,"user",array("id"=>$uid));
	}
	function update_group($uid)
	{
		if(!$uid)
		{
			return false;
		}
		$sql = "UPDATE ".$this->db->prefix."user SET groupid='3', fxstatus='1' WHERE id='".$uid."'";
		return $this->db->query($sql);
	}

	//存储会员信息
	function save($data)
	{
		if(!$data || !is_array($data))
		{
			return false;
		}
		return $this->db->insert_array($data,"user");
	}
	function get_count($uid)
	{
		$sql = "SELECT count(id) total FROM ".$this->db->prefix."customer WHERE uid='".$uid."' ";
		return $this->db->count($sql);
	}
	function get_money($uid)
	{
		$sql = "SELECT sum(money) total FROM ".$this->db->prefix."commission WHERE uid='".$uid."' ";
		return $this->db->count($sql);
	}
}
?>