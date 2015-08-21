<?php if(!defined('PHPOK_SET')){die('<h3>Error...</h3>');}?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
<title><?php if($sitetitle){?><?php echo $sitetitle;?> - <?php } ?><?php echo $_sys[sitename];?><?php if($_sys[seotitle]){?> - <?php echo $_sys[seotitle];?><?php } ?></title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0,user-scalable=no" />
<meta name="format-detection" content="telephone=no,address=no,email=no" />
<meta name="mobileOptimized" content="width" />
<meta name="handheldFriendly" content="true" />
<meta http-equiv="Cache-Control" content="max-age=0" />
<meta name="apple-touch-fullscreen" content="yes" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black" />
<meta name="keywords" content="<?php echo $_sys[keywords];?>" />
<meta name="description" content="<?php echo $_sys[description];?>" />
<script type="text/javascript">
var base_file = "<?php echo $_sys[siteurl];?><?php echo HOME_PAGE;?>";
var base_url = "<?php echo $_sys[siteurl];?><?php echo $sys_app->url;?>";
var base_ctrl = "<?php echo $sys_app->config->c;?>";
var base_func = "<?php echo $sys_app->config->f;?>";
var base_dir = "<?php echo $sys_app->config->d;?>";
</script>
<link rel="stylesheet" href="./app/www/view/images/style.css"/>
<link rel="apple-touch-icon-precomposed" href="./app/www/view/images/ico-startup-57x57.png" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>