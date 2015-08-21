<?php
class list_m extends Model
{
	var $sql_ext;
	var $condition = " WHERE 1=1 ";
	var $psize = 20;
	function __construct()
	{
		parent::Model();
		$this->psize = defined("SYS_PSIZE") ? SYS_PSIZE : 20;
	}

	function list_m()
	{
		$this->__construct();
	}

	function set_condition($string="")
	{
		if($string)
		{
			$this->condition .= " AND ".$string." ";
		}
		return true;
	}

	function chk_sign($sign,$id=0,$langid="zh")
	{
		$sql = "SELECT id FROM ".$this->db->prefix."list WHERE identifier='".$sign."'";
		if($id)
		{
			$sql .= " AND id!='".$id."'";
		}
		$sql.= " AND langid='".$langid."'";
		return $this->db->get_one($sql);
	}

	//查询文章数
	function get_list($pageid=0,$iscate=false,$ifbiz=false,$ifthumb=false)
	{
		$this->sql_ext = " FROM ".$this->db->prefix."list m ";
		$offset = $pageid>0 ? ($pageid-1)*$this->psize : 0;
		$sql_fields = "m.*";
		if($iscate)
		{
			$this->sql_ext .= " LEFT JOIN ".$this->db->prefix."cate c ON(m.cate_id=c.id) ";
			$sql_fields .= ",c.cate_name";
		}
		if($ifthumb)
		{
			$this->sql_ext .= " LEFT JOIN ".$this->db->prefix."upfiles u ON(m.thumb_id=u.id) ";
			$sql_fields .= ",u.thumb";
		}
		$sql = "SELECT ".$sql_fields." ".$this->sql_ext." ".$this->condition." ORDER BY m.taxis DESC,m.post_date DESC,m.id DESC ";
		$sql.= " LIMIT ".$offset.",".$this->psize;
		$rslist = $this->db->get_all($sql,"id");
		if(!$rslist) return false;
		$tmplist = array();
		foreach($rslist AS $key=>$value)
		{
			$tmplist[] = $value;
		}
		return $tmplist;
	}

	//取得链接数列表
	function get_link($pageid=0,$condition="")
	{
		$offset = $pageid>0 ? ($pageid-1)*$this->psize : 0;
		$sql = "SELECT l.*,m.title m_title,c.cate_name,m.identifier m_sign,c.identifier c_sign FROM ".$this->db->prefix."list l LEFT JOIN ".$this->db->prefix."module m ON(l.module_id=m.id) LEFT JOIN ".$this->db->prefix."cate c ON(l.cate_id=c.id) WHERE 1=1 ";
		if($condition)
		{
			$sql .= " AND ".$condition;
		}
		$sql.= " LIMIT ".$offset.",".$this->psize;
		return $this->db->get_all($sql);
	}

	function get_link_count($condition="")
	{
		$sql = "SELECT count(l.id) FROM ".$this->db->prefix."list l LEFT JOIN ".$this->db->prefix."module m ON(l.module_id=m.id) LEFT JOIN ".$this->db->prefix."cate c ON(l.cate_id=c.id) WHERE 1=1 ";
		if($condition)
		{
			$sql .= " AND ".$condition;
		}
		return $this->db->count($sql);
	}

	//查询数量
	function get_count()
	{
		$this->sql_ext = " FROM ".$this->db->prefix."list m ";
		$sql = "SELECT count(m.id) total ".$this->sql_ext." ".$this->condition;
		$rs = $this->db->count($sql);
		return $rs;
	}

	//取得值
	function get_one($id)
	{
		$sql = " SELECT m.*,u.thumb ";
		$sql.= " FROM ".$this->db->prefix."list m ";
		$sql.= " LEFT JOIN ".$this->db->prefix."upfiles u ON(m.thumb_id=u.id) ";
		$sql.= " WHERE m.id='".$id."'";
		$rs = $this->db->get_one($sql);
		$sql = "SELECT field,val FROM ".$this->db->prefix."list_c WHERE id='".$id."'";
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

	//存储核心数据
	function save_sys($array,$id=0)
	{
		if($id)
		{
			$this->db->update_array($array,"list",array("id"=>$id));
			return $id;
		}
		else
		{
			$insert_id = $this->db->insert_array($array,"list");
			return $insert_id;
		}
	}


	//存储扩展信息
	function save_ext($array,$tbltype="ext")
	{
		return $this->db->insert_array($array,"list_".$tbltype,"replace");
	}

	function set_pl($id,$field,$val)
	{
		$sql = "UPDATE ".$this->db->prefix."list SET ".$field."='".$val."' WHERE id IN(".$id.")";
		return $this->db->query($sql);
	}

	//更新分类
	function set_cate($id,$cateid)
	{
		if(!$id || !$cateid)
		{
			return false;
		}
		$sql = "UPDATE ".$this->db->prefix."list SET cate_id='".$cateid."' WHERE id IN(".$id.")";
		return $this->db->query($sql);
	}

	//删除数据
	function del($id)
	{
		$sql = "DELETE FROM ".$this->db->prefix."list WHERE id IN(".$id.")";
		$this->db->query($sql);
		$sql = "DELETE FROM ".$this->db->prefix."list_ext WHERE id IN(".$id.")";
		$this->db->query($sql);
		$sql = "DELETE FROM ".$this->db->prefix."list_c WHERE id IN(".$id.")";
		$this->db->query($sql);
		$sql = "DELETE FROM ".$this->db->prefix."list_biz WHERE id IN(".$id.")";
		$this->db->query($sql);
		$sql = "DELETE FROM ".$this->db->prefix."reply WHERE tid IN(".$id.")";
		$this->db->query($sql);
		return true;
	}

	//取得分类下的数目
	function get_count_from_cate($idstring)
	{
		$sql = "SELECT count(l.id) FROM ".$this->db->prefix."list l WHERE l.status='1' AND l.hidden='0' AND l.cate_id IN(".$idstring.") ";
		return $this->db->count($sql);
	}

	function get_count_from_module($mid)
	{
		$sql = "SELECT count(id) FROM ".$this->db->prefix."list WHERE status='1' AND hidden='0' AND module_id='".$mid."'";
		return $this->db->count($sql);
	}

	//取得指定分类下的最大主题和最小主题ID
	function max_min_id($cateid="",$mid=0,$langid="zh",$if_msg=0)
	{
		$sql = "SELECT max(l.id) max_id,min(l.id) min_id FROM ".$this->db->prefix."list l JOIN ".$this->db->prefix."module m ON(l.module_id=m.id) WHERE l.status='1'";
		if($cateid)
		{
			$sql .= " AND l.cate_id IN(".$cateid.") ";
		}
		if($mid)
		{
			$sql .= " AND l.module_id='".$mid."' ";
		}
		$sql.= " AND l.langid='".$langid."' ";
		if($if_msg)
		{
			$sql.= " AND m.if_msg='1' ";
		}
		return $this->db->get_one($sql);
	}

	function get_next_id($cateid="",$mid=0,$langid="zh",$tid=0,$if_msg=0)
	{
		$sql = "SELECT l.id FROM ".$this->db->prefix."list l JOIN ".$this->db->prefix."module m ON(l.module_id=m.id) WHERE l.status='1'";
		if($cateid)
		{
			$sql .= " AND l.cate_id IN(".$cateid.") ";
		}
		if($mid)
		{
			$sql .= " AND l.module_id='".$mid."' ";
		}
		$sql.= " AND l.langid='".$langid."' ";
		if($tid)
		{
			$sql .= " AND l.id>'".$tid."' ";
		}
		if($if_msg)
		{
			$sql.= " AND m.if_msg='1' ";
		}
		$sql .= " ORDER BY l.id ASC LIMIT 1";
		$rs = $this->db->get_one($sql);
		return $rs["id"] ? $rs["id"] : false;
	}

	function set_taxis($id,$taxis=0)
	{
		$sql = "UPDATE ".$this->db->prefix."list SET taxis='".$taxis."' WHERE id='".$id."'";
		return $this->db->query($sql);
	}

}
?>