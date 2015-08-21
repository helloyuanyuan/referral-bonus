<?php
class usergroup_model extends Model
{
	function __construct()
	{
		parent::Model();
	}

	function usergroup_model()
	{
		$this->__construct();
	}

	function fields_one($id)
	{
		if(!$id)
		{
			return false;
		}
		$sql = "SELECT * FROM ".$this->db->prefix."user_fields WHERE id='".$id."'";
		$rs = $this->db->get_one($sql);
		return $rs;
	}

}
?>