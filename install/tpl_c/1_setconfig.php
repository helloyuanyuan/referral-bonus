<?php if(!defined('PHPOK_SET')){die('<h3>Error...</h3>');}?><?php $APP->tpl->p("head","","0");?>
<script type="text/javascript">
function to_engine(val)
{
	if(!val)
	{
		getid("db_host").disabled = false;
		getid("db_port").disabled = false;
		getid("db_user").disabled = false;
		getid("db_pass").disabled = false;
		getid("db_host").value = "";
		getid("db_port").value = "";
		getid("db_user").value = "";
		getid("db_pass").value = "";
		return false;
	}
	var t = val.split(":");
	if(t[0] == "mysql")
	{
		getid("db_host").disabled = false;
		getid("db_port").disabled = false;
		getid("db_user").disabled = false;
		getid("db_pass").disabled = false;
		getid("db_host").value = "localhost";
		getid("db_port").value = "3306";
		getid("db_user").value = "root";
		getid("db_pass").value = "";
	}
	else if(t[0] == "sqlite")
	{
		getid("db_host").disabled = true;
		getid("db_port").disabled = true;
		getid("db_user").disabled = true;
		getid("db_pass").disabled = true;
		getid("db_host").value = "localhost";
		getid("db_port").value = "3306";
		getid("db_user").value = "root";
		getid("db_pass").value = "**********";
	}
	else if(t[0] == "mssql")
	{
		getid("db_host").disabled = false;
		getid("db_port").disabled = false;
		getid("db_user").disabled = false;
		getid("db_pass").disabled = false;
		getid("db_host").value = "(local)";
		getid("db_port").value = "1433";
		getid("db_user").value = "Administrator";
		getid("db_pass").value = "";
	}
	else if(t[0] == "pgsql")
	{
		getid("db_host").disabled = false;
		getid("db_port").disabled = false;
		getid("db_user").disabled = false;
		getid("db_pass").disabled = false;
		getid("db_host").value = "localhost";
		getid("db_port").value = "5432";
		getid("db_user").value = "postgres";
		getid("db_pass").value = "";
	}
	return true;
}

function check()
{
	var db_data = getid("db_data").value;
	if(!db_data)
	{
		alert("数据库名称不允许为空！");
		return false;
	}
	var admin_user = getid("admin_user").value;
	if(!admin_user)
	{
		alert("管理员账号不允许为空！");
		return false;
	}
	var admin_pass = getid("admin_pass").value;
	if(!admin_pass)
	{
		alert("管理员密码不允许为空！");
		return false;
	}
	getid("phpok_submit").disabled = true;
}
</script>
<div class="div_w m_top">
	<div class="left">
		<div class="model"><div class="bg">
			<h5>安装步骤</h5>
			<ol class="ol">
				<li><a href="index.php">安装说明</a></li>
				<li class="red">配置安装参数</li>
				<li><a href="#">完成</a></li>
			</ol>
		</div></div>
		<div class="space"></div>
	</div>
	<div class="right">
		<div class="model"><div class="bg">
			<form method="post" action="index.php?act=save" onsubmit="return check();">
			<h5>设置数据库</h5>
			<div class="msg" style="padding:5px 15px;">
				<table>
				<tr>
					<td width="160px" align="right">数据库类型：</td>
					<td>
						<select id="db_type" name="db_type" onchange="to_engine(this.value)">
							<option value="mysql:mysql">MySQL（MySQL引挈）</option>
						</select>
					</td>
				</tr>
				<tr>
					<td align="right">服务器：</td>
					<td><input type="text" id="db_host" name="db_host" class="input_login" /></td>
				</tr>
				<tr>
					<td align="right">端口：</td>
					<td><input type="text" id="db_port" name="db_port" class="short_input" /></td>
				</tr>
				<tr>
					<td align="right">账号：</td>
					<td><input type="text" id="db_user" name="db_user" class="input_login" /></td>
				</tr>
				<tr>
					<td align="right">密码：</td>
					<td><input type="text" id="db_pass" name="db_pass" class="input_login" /></td>
				</tr>
				<tr>
					<td align="right">数据库名：</td>
					<td><input type="text" id="db_data" name="db_data" class="input_login" /> 数据库必须存在！</td>
				</tr>
				<input type="hidden" id="prefix" name="prefix" class="input_login" value="yehnet_" />
				<tr>
					<td align="right"></td>
					<td></td>
				</tr>
				<tr>
					<td align="right"></td>
					<td></td>
				</tr>
				</table>
			</div>
		</div></div>
		<div class="space"></div>
		<div class="model"><div class="bg">
			<h5>缓存设置</h5>
			<div class="msg" style="padding:5px 15px;">
				<table>
				<tr>
					<td width="160px" align="right" valign="top">缓存类型：</td>
					<td><input type="radio" name="cache_type" value="txt" checked /> 文本缓存 &nbsp; <input type="radio" name="cache_type" value="mem" /> Memcache缓存 &nbsp; <input type="radio" name="cache_type" value="sql" /> 数据库缓存<br />如果有独立服务器且支持Memcache，推荐使用Memcache缓存</td>
				</tr>
				<tr>
					<td align="right">缓存时间：</td>
					<td><input type="text" id="cache_time" name="cache_time" class="short_input" value="3600" /> 秒</td>
				</tr>
				<tr>
					<td align="right">Memcache 服务器：</td>
					<td><input type="text" id="cache_server" name="cache_server" class="input_login" value="localhost" /></td>
				</tr>
				<tr>
					<td align="right">Memcache 端口：</td>
					<td><input type="text" id="cache_port" name="cache_port" value="11211" class="short_input" /></td>
				</tr>
				</table>
			</div>
		</div></div>
		<div class="space"></div>
		<div class="model"><div class="bg">
			<h5>网站 / 管理员设置</h5>
			<div class="msg" style="padding:5px 15px;">
				<table>
				<tr>
					<td align="right" width="160px">网站网址：</td>
					<td><input type="text" id="siteurl" name="siteurl" class="long_input" value="<?php echo $site_url;?>" /> 请填写网站地址</td>
				</tr>
				<tr>
					<td align="right">管理员账号：</td>
					<td><input type="text" id="admin_user" name="admin_user" class="input_login" value="admin" /></td>
				</tr>
				<tr>
					<td align="right">管理员密码：</td>
					<td><input type="text" id="admin_pass" name="admin_pass" class="input_login" /></td>
				</tr>
				</table>
			</div>
		</div></div>
		<div class="space"></div>
		<div align="right"><button type="submit" class="btn" id="phpok_submit"><span><span>完成安装</span></span></button></div>
	</div>
	</form>
	<div class="clear"></div>
</div>
<script type="text/javascript">to_engine("mysql:mysql");</script>
<?php $APP->tpl->p("foot","","0");?>