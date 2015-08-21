<?php
class login_c extends Control
{
	function __construct()
	{
		parent::Control();
		$this->load_model("user");
	}

	function login_c()
	{
		$this->__construct();
	}

	//会员登录界面
	function index_f()
	{
		if(!$this->sys_config["login_status"])
		{
			$message = $this->sys_config["close_login"] ? $this->sys_config["close_login"] : "Not Login!";
			error($message,$this->url());
		}
		$b_url = $_SESSION["last_url"] ? $_SESSION["last_url"] : ($_SERVER["HTTP_REFERER"] ? $_SERVER["HTTP_REFERER"] : site_url("index"));
		if($_SESSION["user_id"] && $_SESSION["user_name"])
		{
			error('',$this->url('home'));
		}
		//登录后的向导
		$leader[0] = array("url"=>site_url("login","",false),"title"=>$this->lang["login"]);
		$this->tpl->assign("leader",$leader);
		$this->tpl->display("login.".$this->tpl->ext);
	}

	function ok_f()
	{
		if(!$this->sys_config["login_status"])
		{
			$message = $this->sys_config["close_login"] ? $this->sys_config["close_login"] : "Not Login!";
			echo $message;
			exit;
		}
		$phone = $this->trans_lib->safe("phone");
		$password = $this->trans_lib->safe("password");
		//账号和密码为空时警告
		if(!$phone || !$password)
		{
			echo $this->lang["login_false_empty"];
			exit;
		}
		//检查会员不存在时的警告
		$rs = $this->user_m->user_from_phone($phone);
		if(!$rs)
		{
			echo $this->lang["login_false_rs"];
			exit;
		}
		//密码检测
		$password = sys_md5($password);
		if($rs["pass"] != $password)
		{
			echo $this->lang["login_false_password"];
			exit;
		}
		//检查会员状态的警告
		if(!$rs["status"])
		{
			echo $this->lang["login_false_check"];
			exit;
		}
		//检查会员是否被锁定
		if($rs["status"] == 2)
		{
			echo $this->lang["login_false_check"];
			exit;
		}
		//将数据存到session中
		if($rs["status"] == 1 && $rs["pass"] == $password)
		{
			$_SESSION["user_id"] = $rs["id"];
			$_SESSION["user_name"] = $rs["username"];
			$_SESSION["group_id"] = $rs["groupid"];
			$_SESSION["user_rs"]= $rs;
			echo "1";
			exit;
		}
	}

	function codes_f()
	{
		$x_size=76;
		$y_size=23;
		if(!defined("SYS_VCODE_VAR"))
		{
			define("SYS_VCODE_VAR","phpok_login_chk");
		}
		$aimg = imagecreate($x_size,$y_size);
		$back = imagecolorallocate($aimg, 255, 255, 255);
		$border = imagecolorallocate($aimg, 0, 0, 0);
		imagefilledrectangle($aimg, 0, 0, $x_size - 1, $y_size - 1, $back);
		$txt="0123456789";
		$txtlen=strlen($txt);

		$thetxt="";
		for($i=0;$i<4;$i++)
		{
			$randnum=mt_rand(0,$txtlen-1);
			$randang=mt_rand(-10,10);	//文字旋转角度
			$rndtxt=substr($txt,$randnum,1);
			$thetxt.=$rndtxt;
			$rndx=mt_rand(1,5);
			$rndy=mt_rand(1,4);
			$colornum1=($rndx*$rndx*$randnum)%255;
			$colornum2=($rndy*$rndy*$randnum)%255;
			$colornum3=($rndx*$rndy*$randnum)%255;
			$newcolor=imagecolorallocate($aimg, $colornum1, $colornum2, $colornum3);
			imageString($aimg,3,$rndx+$i*21,5+$rndy,$rndtxt,$newcolor);
		}
		unset($txt);
		$thetxt = strtolower($thetxt);
		$_SESSION[SYS_VCODE_VAR] = md5($thetxt);#[写入session中]
		@session_write_close();#[关闭session写入]
		imagerectangle($aimg, 0, 0, $x_size - 1, $y_size - 1, $border);
		$newcolor="";
		$newx="";
		$newy="";
		$pxsum=30;	//干扰像素个数
		for($i=0;$i<$pxsum;$i++)
		{
			$newcolor=imagecolorallocate($aimg, mt_rand(0,254), mt_rand(0,254), mt_rand(0,254));
			imagesetpixel($aimg,mt_rand(0,$x_size-1),mt_rand(0,$y_size-1),$newcolor);
		}
		header("Pragma:no-cache");
		header("Cache-control:no-cache");
		header("Content-type: image/png");
		imagepng($aimg);
		imagedestroy($aimg);
		exit;
	}

}
?>