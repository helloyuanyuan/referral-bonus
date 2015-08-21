<?php
class usergroup_m extends Model
{
	function __construct()
	{
		parent::Model();
	}

	function usergroup_m()
	{
		$this->__construct();
	}

	function get_default()
	{
		$sql = "SELECT * FROM ".$this->db->prefix."user_group WHERE ifdefault='1' AND group_type='user'";
		return $this->db->get_one($sql);
	}

	function get_one($id)
	{
		if(!$id)
		{
			return false;
		}
		$sql = "SELECT * FROM ".$this->db->prefix."user_group WHERE id='".$id."'";
		return $this->db->get_one($sql);
	}

	function get_all()
	{
		$sql = "SELECT * FROM ".$this->db->prefix."user_group ORDER BY id DESC";
		return $this->db->get_all($sql);
	}


	//存储会员数据
	function save($data,$id=0)
	{
		if($id)
		{
			$this->db->update_array($data,"user_group",array("id"=>$id));
			return true;
		}
		else
		{
			$insert_id = $this->db->insert_array($data,"user_group");
			return $insert_id;
		}
	}

	function set_default($id)
	{
		$sql = "UPDATE ".$this->db->prefix."user_group SET ifdefault='0' WHERE group_type='user' AND ifdefault='1'";
		$this->db->query($sql);
		$sql = "UPDATE ".$this->db->prefix."user_group SET ifdefault='1' WHERE group_type='user' AND id='".$id."'";
		return $this->db->query($sql);
	}

	//删除操作
	function del($id)
	{
		//取得默认数
		$rs = $this->get_default();
		if(!$rs) return false;
		$new_id = $rs["id"];
		$sql = "UPDATE ".$this->db->prefix."user SET groupid='".$new_id."' WHERE groupid='".$id."'";
		$this->db->query($sql);
		$sql = "DELETE FROM ".$this->db->prefix."user_group WHERE id='".$id."'";
		return $this->db->query($sql);
	}
}
?>