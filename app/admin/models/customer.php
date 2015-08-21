<?php
class customer_m extends Model
{
	var $psize = 20;
	function __construct()
	{
		parent::Model();
		$this->psize = defined("SYS_PSIZE") ? SYS_PSIZE : 20;
	}

	function customer_m()
	{
		$this->__construct();
	}

	function get_one($id)
	{
		if(!$id)
		{
			return false;
		}
		$sql = "SELECT * FROM ".$this->db->prefix."customer WHERE id='".$id."'";
		$rs = $this->db->get_one($sql);
		if(!$rs) return false;
		return $rs;
	}

	function get_list($offset=0,$condition="")
	{
		$sql = "SELECT * FROM ".$this->db->prefix."customer ";
		if($condition)
		{
			$sql .= " WHERE ".$condition;
		}
		$sql .= " ORDER BY id DESC LIMIT ".$offset.",".$this->psize;
		return $this->db->get_all($sql);
	}

	//取得总数量
	function get_count($condition="")
	{
		$sql = "SELECT count(id) FROM ".$this->db->prefix."customer ";
		if($condition)
		{
			$sql .= " WHERE ".$condition;
		}
		return $this->db->count($sql);
	}

	//存储会员数据
	function save($data,$id=0)
	{
		if($id)
		{
			$this->db->update_array($data,"customer",array("id"=>$id));
			return $id;
		}
		else
		{
			$insert_id = $this->db->insert_array($data,"customer");
			return $insert_id;
		}
	}

	function set_status($id,$status=0)
	{
		$sql = "UPDATE ".$this->db->prefix."customer SET status='".$status."' WHERE id='".$id."'";
		return $this->db->query($sql);
	}
	function status($id,$status=0)
	{
		$sql = "UPDATE ".$this->db->prefix."customer SET status='".$status."'  WHERE id IN(".$id.")";
		return $this->db->query($sql);
	}

	function del($id)
	{
		$sql = "DELETE FROM ".$this->db->prefix."customer WHERE id='".$id."'";
		return $this->db->query($sql);
	}
	function pl_del($id)
	{
		$sql = "DELETE FROM ".$this->db->prefix."customer WHERE id IN(".$id.")";
		return $this->db->query($sql);
	}
}
?>