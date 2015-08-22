<?php if(!defined('PHPOK_SET')){die('<h3>Error...</h3>');}?><?php $APP->tpl->p("header","","0");?>
<div class="main">
<table width="100%" style="layout:fixed;" cellpadding="0" cellspacing="0">
<tr>
	<td class="t_sub"><div align="left">&nbsp; 信息提醒</div></td>
</tr>
<tr class="tr_out">
	<td class="tc_left" height="25px">
		&nbsp; &nbsp;合伙人统计： 你有 <span class="red" id="ajax_user"><?php echo $user_count;?></span> 条合伙人信息
	</td>
</tr>
<tr class="tr_out">
	<td class="tc_left" height="25px">
		&nbsp; &nbsp;推荐人统计： 你有 <span class="red" id="ajax_customer"><?php echo $customer_count;?></span> 条推荐人信息
	</td>
</tr>
</table>
</div>


<div class="main">
<table width="100%" style="layout:fixed;" cellpadding="0" cellspacing="0">
<tr>
	<td class="t_sub" width="50%"><div align="left">&nbsp; 服务器环境，<a href="<?php echo site_url('home,info');?>" target="_blank" style="color:#FFF;">点此查看PHPINFO信息</a></div></td>
	<td class="t_sub">&nbsp;</td>
</tr>
<tr class="tr_out">
	<td class="tc_left" height="25px">
		&nbsp; &nbsp;服务器系统： <span class="darkblue"><?php echo php_uname();?></span>
	</td>
	<td class="tc_right">
		&nbsp; &nbsp;PHP版本：<span class="darkblue"><?php echo PHP_VERSION;?></span>
	</td>
</tr>
<tr class="tr_out">
	<td class="tc_left" height="25px">
		&nbsp; &nbsp;附件上传： <span class="darkblue"><?php echo get_cfg_var("upload_max_filesize");?></span>
	</td>
	<td class="tc_right">
		&nbsp; &nbsp;GD信息：<span class="darkblue"><?php echo $gdinfo;?></span>
	</td>
</tr>
<tr class="tr_out">
	<td class="tc_left" height="25px">
		&nbsp; &nbsp;服务器引擎： <span class="darkblue"><?php echo $_SERVER['SERVER_SOFTWARE'];?></span>
	</td>
	<td class="tc_right">
		&nbsp; &nbsp;PHP运行方式：<span class="darkblue"><?php echo php_sapi_name();?></span>
	</td>
</tr>
<tr class="tr_out">
	<td class="tc_left" height="25px">
		&nbsp; &nbsp;Socket支持： <span class="darkblue"><?php echo function_exists('socket_accept') ? '<span class="darkblue">支持</span>' :'<span class="red">不支持</span>';?>
	</td>
	<td class="tc_right">
		&nbsp; &nbsp;程序最长运行时间：<span class="darkblue"><?php echo get_cfg_var('max_execution_time');?> 秒</span>
	</td>
</tr>
<tr class="tr_out">
	<td class="tc_left" height="25px">
		&nbsp; &nbsp;自动定义全局变量： <?php echo function_exists('register_globals') ? '<span class="darkblue"><b>YES</b></span>' :'<span class="red"><b>NO</b></span>';?>
	</td>
	<td class="tc_right">
		&nbsp; &nbsp;使用URL打开文件：<?php echo function_exists('allow_url_fopen') ? '<span class="darkblue">是，允许</span>' : '<span class="red">不允许</span>';?>
	</td>
</tr>
</table>
</div>
<script language="JavaScript">
var url = "admin.php?c=home&f=ajax_user";
function historyorder(){
	$.ajax({
	type: 'POST',    
	url : url,  
	success: function(data){ 
		$("#ajax_user").html(data);
		setTimeout(historyorder,1000);
	}
	});
}
setTimeout(historyorder,1000);

var urls = "admin.php?c=home&f=ajax_customer";
function historyrecharge(){
	$.ajax({
	type: 'POST',    
	url : urls,  
	success: function(datas){ 
		$("#ajax_customer").html(datas);
		setTimeout(historyrecharge,1000);
	}
	});
}
setTimeout(historyrecharge,1000);
</script>
<?php $APP->tpl->p("footer","","0");?>