<?php
class user_model extends Model
{
	function __construct()
	{
		parent::Model();
	}

	function user_model()
	{
		$this->__construct();
	}

	//存储扩展信息
	function save_ext($array)
	{
		return $this->db->insert_array($array,"user_ext","replace");
	}
}
?>