<?php
class msg_m extends Model
{
	function __construct()
	{
		parent::Model();
	}

	function msg_m()
	{
		$this->__construct();
	}

	//取得单独内容信息
	function get_c($id,$field)
	{
		if(!$id || !$field)
		{
			return false;
		}
		$sql = "SELECT val FROM ".$this->db->prefix."list_c WHERE id='".$id."' AND `field`='".$field."'";
		$rs = $this->db->get_one($sql);
		if(!$rs) return false;
		return $rs["val"];
	}

	function get_one($id)
	{
		$this->db->close_cache();
		$sql = " SELECT * ";
		$sql.= " FROM ".$this->db->prefix."list ";
		$sql.= " WHERE id='".$id."'";
		$sql.= " AND status='1' ";
		$rs = $this->db->get_one($sql);
		if(!$rs)
		{
			$this->db->open_cache();
			return false;
		}
		if($rs["thumb_id"])
		{
			$tmp_thumb = sys_format_list($rs["thumb_id"],"img");
			$rs["thumb"] = $tmp_thumb[0];
			unset($tmp_thumb);
		}
		$sql = "SELECT field,val FROM ".$this->db->prefix."list_c WHERE id='".$id."'";
		$tmp_rs = $this->db->get_all($sql);
		if($tmp_rs && is_array($tmp_rs) && count($tmp_rs)>0)
		{
			foreach($tmp_rs AS $key=>$value)
			{
				$value["val"] = sys_format_content($value["val"]);
				$rs[$value["field"]] = $value["val"];
			}
		}
		$this->db->open_cache();
		return $rs;
	}

	function get_one_fromtype($typeid,$langid="zh")
	{
		$sql = "SELECT id,langid FROM ".$this->db->prefix."list WHERE identifier='".$typeid."'";
		$rslist = $this->db->get_all($sql);
		if(!$rslist)
		{
			return false;
		}
		$id = 0;
		foreach($rslist AS $key=>$value)
		{
			if($value["langid"] == $langid)
			{
				$id = $value["id"];
				break;
			}
		}
		if(!$id)
		{
			$id = $rslist[0]["id"];
		}
		return $this->get_one($id);
	}

	//更新点击率
	function update_hits($id)
	{
		$sql = "UPDATE ".$this->db->prefix."list SET hits=hits+1 WHERE id='".$id."'";
		return $this->db->query($sql);
	}
}
?>