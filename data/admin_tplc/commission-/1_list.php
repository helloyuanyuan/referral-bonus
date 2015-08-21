<?php if(!defined('PHPOK_SET')){die('<h3>Error...</h3>');}?><?php $APP->tpl->p("header","","0");?>
<div class="notice"><div class="p">
	<table width="100%" cellpadding="0" cellspacing="0">
	<tr>
		<td><span class="lead">&nbsp;&raquo; 佣金列表</span></td>
		<td>
			<table>
			<form method="post" action="#" onsubmit="to_search();return false;">
			<tr>
				<td>
					<select name="status" id="status">
						<option value="">不限状态</option>
						<option value="1"<?php if($status == 1){?> selected<?php } ?>>已结佣</option>
						<option value="2"<?php if($status == 2){?> selected<?php } ?>>未结佣</option>
					</select>
				</td>
				<td>&nbsp; 时间：</td>
				<td><input type="text" name="startdate" id="startdate" onfocus="show_date('startdate')" style="width:75px;" value="<?php echo $startdate;?>"></td>
				<td>&nbsp;－&nbsp;</td>
				<td><input type="text" name="enddate" id="enddate" onfocus="show_date('enddate')" style="width:75px;" value="<?php echo $enddate;?>"></td>
				<td>&nbsp; 关键字：</td>
				<td>
					<select name="keytype" id="keytype">
						<option value="">不限</option>
						<option value="uname"<?php if($keytype == "uname"){?> selected<?php } ?>>合伙人</option>
						<option value="username"<?php if($keytype == "username"){?> selected<?php } ?>>客户</option>
						<option value="proname"<?php if($keytype == "proname"){?> selected<?php } ?>>项目</option>
					</select>
				</td>
				<td><input type="text" name="keywords" value="<?php echo $keywords;?>" id="keywords"></td>
				<td><input type="submit" value="搜索" class="btn2"></td>
			</tr>
			</form>
			</table>
		</td>
		<td align="right"><a class="status0"></a></td>
		<td>未结佣</td>
		<td align="right"><a class="status1"></a></td>
		<td>已结佣</td>
		<td align="right"><a href="<?php echo site_url('commission,set');?>module_id=<?php echo $m_rs[id];?>&" class="button">添加佣金</a></td>
	</tr>
	</table>
</div></div>

<div class="main">
<table width="100%" style="layout:fixed;" cellpadding="0" cellspacing="0">
<tr>
	<td class="t_sub" width="40px">&nbsp;</td>
	<td class="t_sub" width="50px">ID</td>
	<td class="t_sub" width="35px">状态</td>
	<td class="t_sub">合伙人</td>
	<td class="t_sub">客户姓名</td>
	<td class="t_sub">项目名称</td>
	<td class="t_sub">类别</td>
	<td class="t_sub">金额</td>
	<td class="t_sub" width="110px">注册时间</td>
	<td class="t_sub" width="45px">操作</td>
</tr>
<?php $_i=0;$rslist=(is_array($rslist))?$rslist:array();foreach($rslist AS  $key=>$value){$_i++; ?>
<tr class="tr_out" onMouseOver="over_tr(this)" onMouseOut="out_tr(this)">
	<td align="center" class="tc_left"><input type="checkbox" value="<?php echo $value[id];?>"></td>
	<td align="center" class="tc_right"><?php echo $value[id];?></td>
	<td align="center" class="tc_right" id="status_<?php echo $value['id'];?>"><a href="javascript:status(<?php echo $value[id];?>,<?php echo intval($value['status']);?>);void(0);" class="status<?php echo intval($value['status']);?>"></a></td>
	<td align='center' class="tc_right">&nbsp;<a href="javascript:show_user('<?php echo $value[uid];?>');void(0);"><?php echo $value[uname];?></a></a></td>
	<td align='center' class="tc_right">&nbsp;<?php echo $value[username];?></a></td>
	<td align='center' class="tc_right">&nbsp;<?php echo $value[proname];?></td>
	<td align='center' class="tc_right">&nbsp;<?php echo $value[ctype];?></td>
	<td align='center' class="tc_right">&nbsp;<?php echo $value[money];?></td>
	<td  align='center' class="tc_right"><?php echo date('Y-m-d H:i',$value[postdate]);?></td>
	<td align="center" class="tc_right">
		<a href="<?php echo site_url('commission,set');?>module_id=<?php echo $m_rs[id];?>&id=<?php echo $value[id];?>" class="btn edit" title="编辑"></a>
		<a href="javascript:del(<?php echo $value['id'];?>);void(0);" class="btn del" title="删除"></a>
	</td>
</tr>
<?php } ?>
</table>
</div>
<div class="table">
	<table width="100%">
	<tr>
		<td>
			<input type="button" value="全选" onclick="select_all()" class="btn2">
			<input type="button" value="全不选" onclick="select_none()" class="btn3">
			<input type="button" value="反选" onclick="select_anti()" class="btn2">
			&nbsp;
			<input type="button" value="批量结佣" onclick="update_pl('1')" class="btn4">
			<input type="button" value="批量未结佣" onclick="update_pl('0')" class="btn4">
			&nbsp;
			<input type="button" value="批量删除" onclick="del_pl()" class="btn4">
		</td>
		<td align="right"><?php echo $pagelist;?></td>
	</tr>
	</table>
</div>

<script type="text/javascript">
function to_search()
{
	url = base_url;
	//状态
	var st = getid("status").value;
	if(st)
	{
		url += "status="+st+"&";
	}
	var startdate = getid("startdate").value;
	if(startdate)
	{
		url += "startdate="+EncodeUtf8(startdate)+"&";
	}
	var enddate = getid("enddate").value;
	if(enddate)
	{
		url += "enddate="+EncodeUtf8(enddate)+"&";
	}
	var keytype = getid("keytype").value;
	var keywords = getid("keywords").value;
	if(keytype && keywords)
	{
		url += "keytype="+EncodeUtf8(keytype)+"&keywords="+EncodeUtf8(keywords)+"&";
	}
	direct(url);
	return false;
}
function update_pl(st)
{
	var id = join_checkbox();
	if(!id)
	{
		alert("请选择要更新的信息");
		return false;
	}
	var url = base_url + base_func + "=pl_status&status="+st+"&id="+id;
	var msg = get_ajax(url);
	if(msg == "ok")
	{
		direct(window.location.href);
		return true;
	}
	else
	{
		if(!msg) msg = "error: 操作错误";
		alert(msg);
		return false;
	}
}
function del_pl()
{
	var id = join_checkbox();
	if(!id)
	{
		alert("请选择要删除的信息");
		return false;
	}
	var qc = confirm("确定要删除该信息吗？删除后是不能恢复！");
	if(qc == "0")
	{
		return false;
	}
	var url = base_url + base_func + "=pl_del&id="+id;
	var msg = get_ajax(url);
	if(msg == "ok")
	{
		direct(window.location.href);
		return true;
	}
	else
	{
		if(!msg) msg = "error: 操作错误";
		alert(msg);
		return false;
	}
}
function to_del(id)
{
	var qc = confirm("确定要删除该信息吗？删除后是不能恢复！");
	if(qc == "0")
	{
		return false;
	}
	var url = base_url + base_func + "=del&id="+id;
	var msg = get_ajax(url);
	if(msg == "ok")
	{
		direct(window.location.href);
		return true;
	}
	else
	{
		if(!msg) msg = "error: 操作错误";
		alert(msg);
		return false;
	}
}

</script>
<?php $APP->tpl->p("footer","","0");?>