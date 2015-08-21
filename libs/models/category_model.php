<?php
class category_model extends Model
{
	var $sql_ext;
	var $langid = "zh";
	function __construct()
	{
		parent::Model();
	}

	function category_model()
	{
		$this->__construct();
	}

	function langid($langid="zh")
	{
		$this->langid = $langid;
	}

	//读取当前分类下的子分类ID
	function get_son_cateid($id)
	{
		if(!$id)
		{
			return false;
		}
		$sql = "SELECT id FROM ".$this->db->prefix."cate WHERE parentid='".$id."' AND langid='".$this->langid."'";
		return $this->db->get_all($sql);
	}

	//读取当前分类下的GD类型
}
?>