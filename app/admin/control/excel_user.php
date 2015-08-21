<?php
class excel_user_c extends Control
{
	function __construct()
	{
		parent::Control();
	}

	//兼容PHP4的写法
	function excel_user_c()
	{
		$this->__construct();
	}

	function index_f()
	{
		sys_popedom("excel_user:list","tpl");
		$DB_Server = $this->db->host; 
		$DB_Username = $this->db->user; 
		$DB_Password = $this->db->pass; 
		$DB_DBName = $this->db->data; 
		$savename = date("YmjHis"); 
		$Connect = @mysql_connect($DB_Server, $DB_Username, $DB_Password) or die("Couldn't connect."); 
		mysql_query("Set Names gb2312"); $file_type = "vnd.ms-excel"; 
		$file_ending = "xls"; 
		header("Content-Type: application/$file_type;charset=utf-8"); 
		header("Content-Disposition: attachment; filename=".$savename.".$file_ending"); 
		//header("Pragma: no-cache"); 
		$now_date = date("Y-m-j H:i:s");
		$sql = "Select id,username,phone,regdate,status,fxstatus,job,company,bankAccount,cardCode,bankName from ".$this->db->prefix."user "; 
		
		$ALT_Db = @mysql_select_db($DB_DBName, $Connect) or die("Couldn't select database"); 
		$result = @mysql_query($sql,$Connect) or die(mysql_error()); 
		$sep = "\t";
		for ($i = 0; $i < mysql_num_fields($result); $i++){ 
		echo mysql_field_name($result,$i)."\t"; 
		} 
		print("\n"); 
		$i = 0; 
		while($row = mysql_fetch_row($result)){ 
		$schema_insert = ""; 
		for($j=0; $j<mysql_num_fields($result);$j++){ 
		if(!isset($row[$j])) 
		$schema_insert .= "NULL".$sep; 
		elseif ($row[$j] != "")
			if ($j=="3"){
				$postdate=date('Y-m-d h:m:s',$row[$j]);
				$schema_insert .= "$postdate".$sep; 
			}else{
				$schema_insert .= "$row[$j]".$sep; 
			}
		else 
		$schema_insert .= "".$sep; 
		} 
		$schema_insert = str_replace($sep."$", "", $schema_insert); 
		$schema_insert .= "\t"; 
		print(trim($schema_insert)); 
		print "\n"; 
		$i++; 
		} 
		return (true); 
		$this->tpl->display("home.html");
	}
}
?>