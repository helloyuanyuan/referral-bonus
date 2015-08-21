<?php if(!defined('PHPOK_SET')){die('<h3>Error...</h3>');}?><?php $APP->tpl->p("header","","0");?>
<script type="text/javascript">
function to_link(t)
{
	var turl = base_file + "?"+base_ctrl+"=link&"+base_func+"="+t+"&input_id=uid&input_i=uname&input_d=proname&input_cid=cid&input_c=username";
	Layer.init(turl,550,400);
}
</script>
<div class="notice"><div class="p">
	<table width="100%" cellpadding="0" cellspacing="0">
	<tr>
		<td><span class="lead">&nbsp;&raquo; <a href="<?php echo site_url('customer');?>">佣金管理</a> &raquo; 添加/编辑信息</span></td>
	</tr>
	</table>
</div></div>

<form method="post" action="<?php echo site_url('commission,setok');?>id=<?php echo $id;?>" onsubmit="return to_submit();">
<div class="table">
	<div class="left"><span class="red">*</span> 合伙人ID：</div>
	<input type="text" name="uid" id="uid" value="<?php echo $rs[uid];?>" />
</div>
<div class="table">
	<div class="left"><span class="red">*</span> 合伙人姓名：</div>
	<input type="text" name="uname" id="uname" value="<?php echo $rs[uname];?>" />
    <span class="clue_on">合伙人ID和姓名，请点击下面【合伙人】按钮自动选择</span>
</div>
	
<div class="table">
	<div class="left">&nbsp;</div>
	<input type="button" class="btn2" value="合伙人" onclick="to_link('user')" />
	<span class="clue_on"></span>
</div>
<div class="table">
	<div class="left"><span class="red">*</span> 客户ID：</div>
	<input type="text" name="cid" id="cid" value="<?php echo $rs[cid];?>" />
</div>
<div class="table">
	<div class="left"><span class="red">*</span> 客户姓名：</div>
	<input type="text" name="username" id="username" value="<?php echo $rs[username];?>" />
    <span class="clue_on">客户ID和姓名，请点击下面【客户】按钮自动选择</span>
</div>

<div class="table">
	<div class="left">&nbsp;</div>
	<input type="button" class="btn2" value="客户" onclick="to_link('customer')" />
	<span class="clue_on"></span>
</div>

<div class="table">
	<div class="left"><span class="red">*</span> 项目名称：</div>
	<input type="text" name="proname" id="proname" value="<?php echo $rs[proname];?>" />
    <span class="clue_on">项目名称，请点击下面【项目】按钮自动选择</span>
</div>

<div class="table">
	<div class="left">&nbsp;</div>
	<input type="button" class="btn2" value="项目" onclick="to_link('project')" />
	<span class="clue_on"></span>
</div>

<div class="table">
	<div class="left"><span class="red">*</span> 类别：</div>
	<select id="ctype" name="ctype" class="select">
        <option value="佣金"<?php if($rs[jindu]=='佣金'){?> selected='selected'<?php } ?>>佣金</option>
		<option value="激励"<?php if($rs[jindu]=='激励'){?> selected='selected'<?php } ?>>激励</option>
	</select>	
</div>
<div class="table">
	<div class="left">金额：</div>
	<input type="text" name="money" id="money" value="<?php echo $rs[money];?>" />
</div>
<div class="table">
	<div class="left">添加时间：</div>
	<input type="text" name="postdate" id="postdate" onfocus="show_date('postdate')" value="<?php echo $rs[postdate] ? date('Y-m-d H:i',$rs[postdate]) : date('Y-m-d H:i',$sys_app->system_time);?>" />
</div>

<div class="table">
	<div class="left">&nbsp;</div>
	<input type="submit" class="btn3" id="_phpok_submit" name="article_submit" value=" 提交 ">
</div>
</form>

<script type="text/javascript">
function to_submit()
{
	var uid= getid("uid").value;
	if(!uid)
	{
		alert("合伙人ID不允许为空");
		getid("uid").focus();
		return false;
	}
	var uname= getid("uname").value;
	if(!uname)
	{
		alert("合伙人姓名不允许为空");
		getid("uname").focus();
		return false;
	}
	var cid= getid("cid").value;
	if(!cid)
	{
		alert("客户ID不允许为空");
		getid("cid").focus();
		return false;
	}
	var username= getid("username").value;
	if(!username)
	{
		alert("客户姓名不允许为空");
		getid("username").focus();
		return false;
	}
	var proname = getid("proname").value;
	if(!proname)
	{
		alert("项目名称不允许为空");
		getid("proname").focus();
		return false;
	}
	var money = getid("money").value;
	if(!money)
	{
		alert("金额不允许为空");
		getid("money").focus();
		return false;
	}
	var postdate = getid("postdate").value;
	if(!postdate)
	{
		alert("日期不允许为空");
		getid("postdate").focus();
		return false;
	}
	getid("_phpok_submit").disabled = true;
}
</script>
<?php $APP->tpl->p("footer","","0");?>