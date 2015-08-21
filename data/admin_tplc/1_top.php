<?php if(!defined('PHPOK_SET')){die('<h3>Error...</h3>');}?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台管理</title>
<meta http-equiv="expires" content="wed, 26 feb 1997 08:21:57 gmt" />
<meta http-equiv="pragma" content="no-cach" />
<style type="text/css">
body{margin:0px;padding:0px;background:#0A586F;font-size:12px;}
ul{list-style:none;padding:0;margin:0;}
ul.menu li{float:left;padding:0;margin:0;margin-left:5px;}
ul.menu li.logo{margin-top:1px;}
ul.menu li.menub{cursor:pointer;height:25px;overflow:hidden;margin-top:7px;}
ul.menu li.menub div{height:25px;background:url("./app/admin/view/images/menu.gif");overflow:hidden;line-height:26px;}
ul.menu li.menub .l{float:left;width:8px;background-position:0px 0px;}
ul.menu li.menub .r{float:left;width:8px;background-position:-8px 0px;}
ul.menu li.menub .m{float:left;background-position:0px -35px;background-repeat:repeat-x;}
ul.menu li.menuh{height:25px;overflow:hidden;color:#fff;font-weight:bold;margin-top:7px;}
ul.menu li.menuh div{height:25px;background:url("./app/admin/view/images/menu.gif");overflow:hidden;line-height:26px;}
ul.menu li.menuh .l{float:left;width:8px;background-position:-16px 0px;}
ul.menu li.menuh .r{float:left;width:8px;background-position:-24px 0px;}
ul.menu li.menuh .m{float:left;background-position:0px -70px;background-repeat:repeat-x;}
ul.menu li.admin{line-height:28px;color:#fff;}
ul.menu li.lang{margin-top:6px;}
.clear{clear:both;height:0;line-height:0;}
</style>
<script type="text/javascript">
var base_file = "<?php echo HOME_PAGE;?>";
var base_url = "<?php echo $sys_app->url;?>";
var base_ctrl = "<?php echo $sys_app->config->c;?>";
var base_func = "<?php echo $sys_app->config->f;?>";
var base_dir = "<?php echo $sys_app->config->d;?>";
</script>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="./app/admin/view/images/global.js"></script>
</head>
<body>

<ul class="menu">
	<li class="logo"><img src="./app/admin/view/images/title-logo.gif" border="0"></li>
	<li class="admin">&#8251; 你好，<strong><?php echo $_SESSION[admin_realname];?></strong></li>
	<?php $_i=0;$rslist=(is_array($rslist))?$rslist:array();foreach($rslist AS  $key=>$value){$_i++; ?>
	<li class="<?php echo $key<1?'menuh':'menub';?>" id="menu_<?php echo $key;?>" onclick="<?php echo $value['onclick'];?>"><div class="l"></div><div class="m"><?php echo $value[title];?></div><div class="r"></div></li>
	<?php } ?>
	<div class="clear"></div>
</ul>
<div style="clear:both;border-top:1px solid #047A9E;border-bottom:1px solid #047A9E;height:3px;"><div></div></div>
<script type="text/javascript">
var menu_count = parseInt("<?php echo count($rslist);?>");
function change_this(key,url)
{
	if(menu_count<1)
	{
		return false;
	}
	var keyMenu = "menu_"+key;
	for(var i=0;i<menu_count;i++)
	{
		var tmpMenu = "menu_"+i;
		getid(tmpMenu).className = i == key ? "menuh" : "menub";
	}
	//执行这个URL
	if(url && url != "undefined")
	{
		url = url.replace(/&amp;/g,"&");
		window.parent.frames["frame_left"].location.href = url;
	}
}
//退出
function logout()
{
	window.parent.location.href = "<?php echo site_url('login,logout','','&');?>";
}
function gohome()
{
	window.open("<?php echo HOME_WWW;?>");
	return true;
}
function clear_cache()
{
	var url = base_file + "?"+base_func+"=clear_cache";
	var msg = get_ajax(url);
	if(msg == "ok")
	{
		alert("缓存已清空！");
		return true;
	}
	else
	{
		if(!msg) msg = "error";
		alert(msg);
		return false;
	}
}
function change_langid(val)
{
	window.parent.location.href = "<?php echo site_url('index,chang_langid','','&');?>langid="+val;
}
//执行第一个JS
<?php echo $rslist[0]["onclick"] ? $rslist[0]["onclick"] : "";?>
</script>
</body>
</html>