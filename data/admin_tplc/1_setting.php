<?php if(!defined('PHPOK_SET')){die('<h3>Error...</h3>');}?><?php $APP->tpl->p("header","","0");?>
<script type="text/javascript">
function tab_set(v)
{
	getid("_tab_main").className = "out";
	getid("_tab_smtp").className = "out";
	getid("_tab_ext").className = "out";
	getid("_msg_main").style.display = "none";
	getid("_msg_smtp").style.display = "none";
	getid("_msg_ext").style.display = "none";
	getid("_tab_"+v).className = "over";
	getid("_msg_"+v).style.display = "";
}

function setting_web(t)
{
	if(t == "html")
	{
		$("#html_setting").show();
	}
	else
	{
		$("#html_setting").hide();
	}
}
</script>
<div class="notice"><div class="p">
	<table width="100%" cellpadding="0" cellspacing="0">
	<tr>
		<td><span class="lead">&nbsp;&raquo; 网站信息配置</span></td>
	</tr>
	</table>
</div></div>

<div class="tab">
	<table cellpadding="0" cellspacing="0">
	<tr>
		<td width="150px">&nbsp;</td>
		<td class="over" id="_tab_main" title="网站信息" onclick="tab_set('main')">网站信息</td>
		<td width="20px">&nbsp;</td>
		<td class="out" id="_tab_smtp" title="SMTP邮件发送通知设置" onclick="tab_set('smtp')">邮件通知设置</td>
		<td width="20px">&nbsp;</td>
		<td class="out" id="_tab_ext" title="其他设置" onclick="tab_set('ext')">其他设置</td>
		<td width="10px">&nbsp;</td>
		<td>（<span style="color:red;">*</span> 号必填）</td>
	</tr>
	</table>
</div>


<form method="post" action="<?php echo site_url('setting,setok');?>id=<?php echo $groupid;?>" onsubmit="return to_submit();">

<div id="_msg_main">
	<div class="table">
		<div class="left">网站名称：</div>
		<input type="text" name="sitename" id="sitename" class="long_input" value="<?php echo $rs[sitename];?>">
	</div>

	<div class="table">
		<div class="left">标题附加字：</div>
		<input type="text" name="seotitle" id="seotitle" class="long_input" value="<?php echo $rs[seotitle];?>">
	</div>

	<div class="table">
		<div class="left">网站网址：</div>
		<input type="text" name="siteurl" id="siteurl" class="long_input" value="<?php echo $rs[siteurl];?>">
		<span class="clue_on">[输入网址，最后要带/]</span>
	</div>

	<div class="table">
		<div class="left">动态页首页：</div>
		<input type="text" name="indexphp" id="indexphp" value="<?php echo $rs[indexphp];?>">
		<span class="clue_on">[默认或是为空使用index.php，如要修改，请同时修改前台的常量HOME_PAGE参数]</span>
	</div>

	<div class="table">
		<div class="left">网站关键字：</div>
		<input type="text" name="keywords" id="keywords" class="long_input" value="<?php echo $rs[keywords];?>">
		<span class="clue_on">[多个关键字用英文逗号隔开，用于SEO]</span>
	</div>

	<div class="table">
		<div class="left">网站描述：</div>
		<input type="text" name="description" id="description" class="long_input" value="<?php echo $rs[description];?>">
		<span class="clue_on">[简单描述一下站点的信息，用于SEO]</span>
	</div>
	<div class="table">
		<div class="left">背景LOGO：</div>
		<input type="text" name="logo" id="logo" value="<?php echo $rs[logo];?>" class="long_input clue_on" readonly />
		<input type="button" class="btn2" value="选择" onclick="phpjs_onepic('logo')" />
		<input type="button" class="btn2" value="预览" onclick="phpjs_onepic_view('logo')" />
		<input type="button" class="btn2" value="清空" onclick="phpjs_onepic_clear('logo')" />
	</div>
	<div class="table">
		<div class="left">按钮标题：</div>
		<input type="text" name="tj_title" id="tj_title" class="long_input" value="<?php echo $rs[tj_title];?>" />
		<span class="clue_on">首页推荐</span>
	</div>
	<div class="table">
		<div class="left">按钮标题：</div>
		<input type="text" name="kh_title" id="kh_title" class="long_input" value="<?php echo $rs[kh_title];?>" />
		<span class="clue_on">首页客户</span>
	</div>
	<div class="table">
		<div class="left">按钮标题：</div>
		<input type="text" name="yj_title" id="yj_title" class="long_input" value="<?php echo $rs[yj_title];?>" />
		<span class="clue_on">首页佣金</span>
	</div>
	<div class="table">
		<div class="left">按钮标题：</div>
		<input type="text" name="xz_title" id="xz_title" class="long_input" value="<?php echo $rs[xz_title];?>" />
		<span class="clue_on">首页细则</span>
	</div>
	<div class="table">
		<div class="left">项目标题：</div>
		<input type="text" name="itemtitle" id="itemtitle" class="long_input" value="<?php echo $rs[itemtitle];?>" />
		<span class="clue_on"></span>
	</div>
	<div class="table">
		<div class="left">版权所有：</div>
		<input type="text" name="copyright" id="copyright" class="long_input" value="<?php echo $rs[copyright];?>" />
		<span class="clue_on"></span>
	</div>
	<div class="table">
		<div class="left">分享有礼：</div>
		<input type="text" name="sharegift" id="sharegift" class="long_input" value="<?php echo $rs[sharegift];?>" />
		<span class="clue_on"></span>
	</div>
	<div class="table">
		<div class="left">弹出提示：</div>
		<input type="text" name="sharetips" id="sharetips" value="<?php echo $rs[sharetips];?>" class="long_input clue_on" readonly />
		<input type="button" class="btn2" value="选择" onclick="phpjs_onepic('sharetips')" />
		<input type="button" class="btn2" value="预览" onclick="phpjs_onepic_view('sharetips')" />
		<input type="button" class="btn2" value="清空" onclick="phpjs_onepic_clear('sharetips')" />
	</div>
	<div class="table">
		<div class="left">分享成功：</div>
		<input type="text" name="sharegiftyes" id="sharegiftyes" class="long_input" value="<?php echo $rs[sharegiftyes];?>" />
		<span class="clue_on">[成功后文字提示]</span>
	</div>
	<div class="table">
		<div class="left">分享成功：</div>
		<input type="text" name="shareyeslink" id="shareyeslink" class="long_input" value="<?php echo $rs[shareyeslink];?>" />
		<span class="clue_on">[成功后文字链接]</span>
	</div>
	<div class="table">
		<div class="left">微信分享链接：</div>
		<input type="text" name="wx_link" id="wx_link" class="long_input" value="<?php echo $rs[wx_link];?>">
		<span class="clue_on">[供微信用户分享时用]</span>
	</div>
	<div class="table">
		<div class="left">微信分享标题：</div>
		<input type="text" name="wx_title" id="wx_title" class="long_input" value="<?php echo $rs[wx_title];?>">
		<span class="clue_on">[供微信用户分享时用]</span>
	</div>
	<div class="table">
		<div class="left">微信分享简介：</div>
		<input type="text" name="wx_description" id="wx_description" class="long_input" value="<?php echo $rs[wx_description];?>">
		<span class="clue_on">[供微信用户分享时用]</span>
	</div>
	<div class="table">
		<div class="left">微信分享图标：</div>
		<input type="text" name="wx_logo" id="wx_logo" value="<?php echo $rs[wx_logo];?>" class="long_input clue_on" readonly>
		<input type="button" class="btn2" value="选择" onclick="phpjs_onepic('wx_logo')">
		<input type="button" class="btn2" value="预览" onclick="phpjs_onepic_view('wx_logo')">
		<input type="button" class="btn2" value="清空" onclick="phpjs_onepic_clear('wx_logo')">
	</div>
</div>

<div id="_msg_smtp">
	<div class="table">
		<div class="left">SMTP服务器：</div>
		<input type="text" name="smtp_server" id="smtp_server" value="<?php echo $rs[smtp_server];?>">
	</div>
	<div class="table">
		<div class="left">端口：</div>
		<input type="text" name="smtp_port" id="smtp_port" class="short_input" value="<?php echo $rs[smtp_port];?>">
		<span class="clue_on">默认是 25</span>
	</div>
	<div class="table">
		<div class="left">编码：</div>
		<table cellpadding="0" cellspacing="0">
		<tr>
			<td><input type="radio" name="smtp_charset" value="gbk"<?php if($rs[smtp_charset] == "gbk"){?> checked<?php } ?> /></td>
			<td>&nbsp;GBK &nbsp; &nbsp;</td>
			<td><input type="radio" name="smtp_charset" value="utf8"<?php if($rs[smtp_charset] == "utf8"){?> checked<?php } ?> /></td>
			<td>&nbsp;UTF-8 &nbsp; &nbsp;</td>
			<td class="clue_on">国内邮件服务器一般不支持UTF-8，建议您使用GBK</td>
		</tr>
		</table>
	</div>
	<div class="table">
		<div class="left">SSL：</div>
		<table cellpadding="0" cellspacing="0">
		<tr>
			<td><input type="radio" name="smtp_ssl" value="1"<?php if($rs[smtp_ssl]){?> checked<?php } ?> /></td>
			<td>&nbsp;启用 &nbsp; &nbsp;</td>
			<td><input type="radio" name="smtp_ssl" value="0"<?php if(!$rs[smtp_ssl]){?> checked<?php } ?> /></td>
			<td>&nbsp;禁用 &nbsp; &nbsp;</td>
			<td class="clue_on">一般情况下不需要启用此功能（Google邮箱需要启用此功能）</td>
		</tr>
		</table>
	</div>
	<div class="table">
		<div class="left">登录账号：</div>
		<input type="text" name="smtp_user" id="smtp_user" value="<?php echo $rs[smtp_user];?>">
	</div>
	<div class="table">
		<div class="left">登录密码：</div>
		<input type="password" name="smtp_pass" id="smtp_pass" value="<?php echo $rs[smtp_pass];?>">
	</div>
	<div class="table">
		<div class="left">回复邮箱：</div>
		<input type="text" name="smtp_reply" id="smtp_reply" value="<?php echo $rs[smtp_reply];?>">
	</div>
	<div class="table">
		<div class="left">管理员邮箱：</div>
		<input type="text" name="smtp_admin" id="smtp_admin" value="<?php echo $rs[smtp_admin];?>">
	</div>
	<div class="table">
		<div class="left">发件人名称：</div>
		<input type="text" name="smtp_fromname" id="smtp_fromname" value="<?php echo $rs[smtp_fromname];?>">
		<span class="clue_on">未设置，将使用系统的：Webmaster</span>
	</div>

	<div class="table">
		<div class="left">注册通知：</div>
		<table cellpadding="0" cellspacing="0">
		<tr>
			<td><input type="radio" name="smtp_reg" value="1"<?php if($rs[smtp_reg]){?> checked<?php } ?> /></td>
			<td>&nbsp;启用 &nbsp; &nbsp;</td>
			<td><input type="radio" name="smtp_reg" value="0"<?php if(!$rs[smtp_reg]){?> checked<?php } ?> /></td>
			<td>&nbsp;禁用 &nbsp; &nbsp;</td>
			<td class="clue_on"> 不推荐使用</td>
		</tr>
		</table>
	</div>
</div>

<div id="_msg_ext">
	<div class="table">
		<div class="left">网站状态：</div>
		<table cellpadding="0" cellspacing="0">
		<tr>
			<td><input type="radio" name="site_status" value="1"<?php if($rs[site_status]){?> checked<?php } ?> /></td>
			<td>&nbsp;启用 &nbsp; &nbsp;</td>
			<td><input type="radio" name="site_status" value="0"<?php if(!$rs[site_status]){?> checked<?php } ?> /></td>
			<td>&nbsp;关闭 &nbsp;</td>
			<td class="clue_on">关闭网站时请写上关闭说明</td>
			<td></td>
			<td></td>
		</tr>
		</table>
	</div>
	<div class="table">
		<div class="left">关闭说明：</div>
		<input type="text" name="close_reason" id="close_reason" class="long_input" value="<?php echo $rs[close_reason];?>">
	</div>
	<div class="table">
		<div class="left">注册控制：</div>
		<table cellpadding="0" cellspacing="0">
		<tr>
			<td><input type="radio" name="reg_status" value="1"<?php if($rs[reg_status]){?> checked<?php } ?> /></td>
			<td>&nbsp;启用 &nbsp; &nbsp;</td>
			<td><input type="radio" name="reg_status" value="0"<?php if(!$rs[reg_status]){?> checked<?php } ?> /></td>
			<td>&nbsp;关闭 &nbsp;</td>
			<td class="clue_on">禁用注册功能，会员将不能注册成为新会员</td>
		</tr>
		</table>
	</div>
	<div class="table">
		<div class="left">禁用注册说明：</div>
		<input type="text" name="close_reg" id="close_reg" class="long_input" value="<?php echo $rs[close_reg];?>">
	</div>
	<div class="table">
		<div class="left">登录控制：</div>
		<table cellpadding="0" cellspacing="0">
		<tr>
			<td><input type="radio" name="login_status" value="1"<?php if($rs[login_status]){?> checked<?php } ?> /></td>
			<td>&nbsp;启用 &nbsp; &nbsp;</td>
			<td><input type="radio" name="login_status" value="0"<?php if(!$rs[login_status]){?> checked<?php } ?> /></td>
			<td>&nbsp;关闭 &nbsp;</td>
			<td class="clue_on">禁用登录功能，网站会员将不能登录！</td>
		</tr>
		</table>
	</div>
	<div class="table">
		<div class="left">禁用登录说明：</div>
		<input type="text" name="close_log" id="close_log" class="long_input" value="<?php echo $rs[close_log];?>">
	</div>
	<div class="table">
		<div class="left">访问方式：</div>
		<table cellpadding="0" cellspacing="0">
		<tr>
			<td><input type="radio" name="site_type" value="rewrite"<?php if($rs[site_type] == "rewrite"){?> checked<?php } ?> onclick="setting_web('rewrite')" /></td>
			<td>&nbsp;伪静态 &nbsp; &nbsp;</td>
			<td><input type="radio" name="site_type" value=""<?php if(!$rs[site_type]){?> checked<?php } ?> onclick="setting_web('')" /></td>
			<td>&nbsp;动态页 &nbsp;</td>
			<td class="clue_on">&nbsp;</td>
		</tr>
		</table>
	</div>
	
</div>

<div class="table">
	<div class="left">&nbsp;</div>
	<input type="submit" class="btn2" id="_phpok_submit" name="article_submit" value="提交"<?php if(!$if_modify){?> disabled<?php } ?>>
</div>

</form>

<script type="text/javascript">
function to_submit()
{
	getid("_phpok_submit").disabled = true;
}
tab_set("main");
</script>
<?php $APP->tpl->p("footer","","0");?>