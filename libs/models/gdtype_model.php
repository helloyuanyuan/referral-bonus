<?php
class gdtype_model extends Model
{
	function __construct()
	{
		parent::Model();
	}

	function gdtype_model()
	{
		$this->__construct();
	}

	function get_all($status=0)
	{
		$sql = "SELECT * FROM ".$this->db->prefix."gd WHERE 1=1 ";
		if($status)
		{
			$sql .= " AND status='1' ";
		}
		$sql.= " ORDER BY taxis ASC,id DESC";
		$rslist = $this->db->get_all($sql);
		return $rslist;
	}

}
?>