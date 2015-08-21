<?php
class user_m extends Model
{
	var $psize = 20;
	function __construct()
	{
		parent::Model();
		$this->psize = defined("SYS_PSIZE") ? SYS_PSIZE : 20;
	}

	function user_m()
	{
		$this->__construct();
	}

	function get_one($id)
	{
		if(!$id)
		{
			return false;
		}
		$sql = "SELECT u.*,f.thumb picture FROM ".$this->db->prefix."user u LEFT JOIN ".$this->db->prefix."upfiles f ON(u.thumb_id=f.id) WHERE u.id='".$id."'";
		$rs = $this->db->get_one($sql);
		if(!$rs) return false;
		//取得扩展内容
		//取得扩展字段信息
		$sql = "SELECT field,val FROM ".$this->db->prefix."user_ext WHERE id='".$id."'";
		$tmp_rs = $this->db->get_all($sql);
		if($tmp_rs && is_array($tmp_rs) && count($tmp_rs)>0)
		{
			foreach($tmp_rs AS $key=>$value)
			{
				$rs[$value["field"]] = $value["val"];
			}
		}
		return $rs;
	}

	//读取会员列表数据
	function get_list($offset=0,$condition="")
	{
		$sql = "SELECT * FROM ".$this->db->prefix."user ";
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
		$sql = "SELECT count(id) FROM ".$this->db->prefix."user ";
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
			$this->db->update_array($data,"user",array("id"=>$id));
			return $id;
		}
		else
		{
			$insert_id = $this->db->insert_array($data,"user");
			return $insert_id;
		}
	}

	function set_status($id,$status=0)
	{
		$sql = "UPDATE ".$this->db->prefix."user SET status='".$status."' WHERE id='".$id."'";
		return $this->db->query($sql);
	}
	function status($id,$status=0)
	{
		$sql = "UPDATE ".$this->db->prefix."user SET status='".$status."'  WHERE id IN(".$id.")";
		return $this->db->query($sql);
	}

	function del($id)
	{
		$sql = "DELETE FROM ".$this->db->prefix."user WHERE id='".$id."'";
		return $this->db->query($sql);
	}
	function pl_del($id)
	{
		$sql = "DELETE FROM ".$this->db->prefix."user WHERE id IN(".$id.")";
		return $this->db->query($sql);
	}

	//检测电话是否冲突
	function chk_phone($phone,$id=0)
	{
		$sql = "SELECT id FROM ".$this->db->prefix."user WHERE phone='".$phone."' ";
		if($id)
		{
			$sql.= " AND id!='".$id."' ";
		}
		return $this->db->get_one($sql);
	}

	//检测身份证号是否冲突
	function chk_usercard($usercard,$id=0)
	{
		$sql = "SELECT id FROM ".$this->db->prefix."user WHERE usercard='".$usercard."' ";
		if($id)
		{
			$sql.= " AND id!='".$id."' ";
		}
		return $this->db->get_one($sql);
	}

}
?>