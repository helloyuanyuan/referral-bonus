<?php
class login_m extends Model
{
	function __construct()
	{
		parent::Model();
	}

	function login_m()
	{
		$this->__construct();
	}

	function check_login($user,$pass)
	{
		$sql = "SELECT * FROM ".$this->db->prefix."admin ";
		$sql.= " WHERE name='".$user."' AND pass='".md5($pass)."' AND status='1'";
		$rs = $this->db->get_one($sql);
		if(!$rs)
		{
			return false;
		}
		return $rs;
	}
}
?>