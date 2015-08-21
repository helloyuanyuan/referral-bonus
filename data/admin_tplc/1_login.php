<?php if(!defined('PHPOK_SET')){die('<h3>Error...</h3>');}?><?php $APP->tpl->p("header","","0");?>
<script type="text/javascript">
if (self.location != top.location) top.location = self.location; 
</script>
<style type="text/css">
body{background:#0F4C5E}
.login{position:absolute;top:50%;left:50%;margin:-120px 0 0 -300px;border:1px #05799E solid;width:600px;height:110px;background:#0C5870;}
.title-text{margin:5px 5px 0 0;text-align:right;color:#FFF;}
input{border:1px #ddd solid;}
.button{padding:2px 4px 0 4px;font-size:12px;height:23;background-color:#ece9d8;border-width:1px;}
#foot{position:absolute;margin:0 auto;left:50%;top:50%;width:600px;margin:-6px 0 0 -300px;}
</style>
<div class="login">
	<div>
		<div class="f-right title-text">后台管理<br /></div>
		<img src="./app/admin/view/images/login-logo.gif">
	</div>
	<div>
		<table>
		<form action="<?php echo site_url('login,login_ok');?>" method="post" target="_top" onsubmit="return chklogin()">
		<tr>
			<td width="75px" align="right" height="45px">用户名：</td>
			<td><input name="username" id="username" type="text" style="width:75px;" tabindex="1" /></td>
			<td align="right">&nbsp; 密　码：</td>
			<td><input name="password" id="password" type="password" style="width:75px;" tabindex="2" /></td>
			<?php if(function_exists("imagecreate") && defined("SYS_VCODE_USE") && SYS_VCODE_USE == true){?>
			<td align="right">&nbsp; 验证码：</td>
			<td><input name="chk" id="chk" type="text" style="width:50px;" tabindex="3" /></td>
			<td id="phpok_update_code"><img src="<?php echo site_url('login,codes');?>" border="0" align="absmiddle" style="cursor:pointer;" onclick="phpok_update_code()"></td>
			<?php } ?>
			<td style="padding-left:5px;"><input type="submit" value=" 登录 " class="btn3"></td>
		</tr>
        </form>
		</table>
	</div>
</div>
<?php if(function_exists("imagecreate") && defined("SYS_VCODE_USE") && SYS_VCODE_USE == true){?>
<script type="text/javascript">
function phpok_update_code()
{
	var rand = Math.random();
	var msg = '<img src="'+get_url("login,codes")+'rand='+rand+'" border="0" align="absmiddle" style="cursor:pointer;" onclick="phpok_update_code()">';
	getid("phpok_update_code").innerHTML = msg;
}
</script>
<?php } ?>
<script type="text/javascript">
function chklogin()
{
	var username = getid("username").value;
	var password = getid("password").value;
	if(!username)
	{
		alert("账号不允许为空");
		getid("username").focus();
		return false;
	}
	if(!password)
	{
		alert("密码不允许为空");
		getid("password").focus();
		return false;
	}
	<?php if(function_exists("imagecreate") && defined("SYS_VCODE_USE") && SYS_VCODE_USE == true){?>
	var chk = getid("chk").value;
	if(!chk)
	{
		alert("验证码不允许为空");
		getid("chk").focus();
		return false;
	}
	<?php } ?>
}
</script>
<?php $APP->tpl->p("footer","","0");?>