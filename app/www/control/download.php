<?php
class download_c extends Control
{
	function __construct()
	{
		parent::Control();
		$this->load_model("upfile");
	}

	function download_c()
	{
		$this->__construct();
	}

	function index_f()
	{
		$id = $this->trans_lib->int("id");
		if(!$id)
		{
			error($this->lang["download_error"],$this->url());
		}
		$rs = $this->upfile_m->get_one($id);
		//执行下载操作
		if(!file_exists(ROOT.$rs["filename"]) || !$rs["filename"] || !is_file(ROOT.$rs["filename"]))
		{
			error($this->lang["download_empty"],$this->url());
		}
		$filesize = filesize(ROOT.$rs["filename"]);
		if(!$rs["title"]) $rs["title"] = $rs["filename"];
		$tmpname = str_replace(".".$rs["ftype"],"",$rs["title"]);
		$tmpname = $tmpname.".".$rs["ftype"];
		ob_end_clean();
		header("Date: ".gmdate("D, d M Y H:i:s", $rs["postdate"])." GMT");
		header("Last-Modified: ".gmdate("D, d M Y H:i:s", $rs["postdate"])." GMT");
		header("Content-Encoding: none");
		header("Content-Disposition: attachment; filename=".rawurlencode($tmpname));
		header("Content-Length: ".$filesize);
		header("Accept-Ranges: bytes");
		readfile($rs["filename"]);
		flush();
		ob_flush();
	}
}
?>