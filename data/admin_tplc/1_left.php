<?php if(!defined('PHPOK_SET')){die('<h3>Error...</h3>');}?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台管理</title>
<meta http-equiv="expires" content="wed, 26 feb 1997 08:21:57 gmt" />
<meta http-equiv="pragma" content="no-cach" />
<script type="text/javascript">
var base_file = "<?php echo HOME_PAGE;?>";
var base_url = "<?php echo $sys_app->url;?>";
var base_ctrl = "<?php echo $sys_app->config->c;?>";
var base_func = "<?php echo $sys_app->config->f;?>";
var base_dir = "<?php echo $sys_app->config->d;?>";
</script>
<link href="./app/admin/view/images/left.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="./app/admin/view/images/global.js"></script>
</head>
<body>
<div id="bodyid" style="padding-top:0px;">
	<div style="height:5px;"></div>
	<ol>
		<?php $_i=0;$rslist=(is_array($rslist))?$rslist:array();foreach($rslist AS  $key=>$value){$_i++; ?>
		<li class="son" id="son_<?php echo $key;?>"><a href="javascript:change_this('<?php echo $key;?>','<?php echo $value['menu_url'];?>');void(0);" title="<?php echo $value['note'];?>"><?php echo $value[title];?></a></li>
		<?php } ?>
	</ol>
</div>
<script type="text/javascript">
function change_this(high_id,url)
{
	var total = parseInt("<?php echo count($rslist);?>");
	var class_name = "son";
	for(var i=0;i<total;i++)
	{
		class_name = i == high_id ? "click" : "son";
		getid("son_"+i).className = class_name;
	}
	if(url && url != "undefined")
	{
		window.parent.frames["frame_right"].location.href = url;
	}
}
</script>
<?php if($rslist && count($rslist)>0){?>
<script type="text/javascript">
var url = "<?php echo $rslist[0]['menu_url'];?>";
change_this(0,url);
</script>
<?php } ?>
</body>
</html>