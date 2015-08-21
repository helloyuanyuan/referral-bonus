<?php if(!defined('PHPOK_SET')){die('<h3>Error...</h3>');}?><?php $APP->tpl->p("header","","0");?>
<div class="notice"><div class="p">
	<table width="100%" cellpadding="0" cellspacing="0">
	<tr>
		<td><span class="lead">&nbsp;&raquo; 合伙人列表</span></td>
		<td>
			<table>
			<form method="post" action="#" onsubmit="to_search();return false;">
			<tr>
				<td>
					<select name="status" id="status">
						<option value="">不限审核</option>
						<option value="1"<?php if($status == 1){?> selected<?php } ?>>已审核</option>
						<option value="2"<?php if($status == 2){?> selected<?php } ?>>未审核</option>
					</select>
				</td>
				<td>
					<select name="fxstatus" id="fxstatus">
						<option value="">不限分享</option>
						<option value="1"<?php if($fxstatus == 1){?> selected<?php } ?>>已分享</option>
						<option value="2"<?php if($fxstatus == 2){?> selected<?php } ?>>未分享</option>
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
						<option value="phone"<?php if($keytype == "phone"){?> selected<?php } ?>>手机</option>
						<option value="username"<?php if($keytype == "username"){?> selected<?php } ?>>姓名</option>
						<option value="usercard"<?php if($keytype == "usercard"){?> selected<?php } ?>>身份证号</option>
					</select>
				</td>
				<td><input type="text" name="keywords" value="<?php echo $keywords;?>" id="keywords"></td>
				<td><input type="submit" value="搜索" class="btn2"></td>
			</tr>
			</form>
			</table>
		</td>
		<td align="right"><a href="<?php echo site_url('user,set');?>module_id=<?php echo $m_rs[id];?>&" class="button">添加新合伙人</a></td>
	</tr>
	</table>
</div></div>

<div class="main">
<table width="100%" style="layout:fixed;" cellpadding="0" cellspacing="0">
<tr>
	<td class="t_sub" width="40">&nbsp;</td>
	<td class="t_sub" width="50">ID</td>
	<td class="t_sub" width="35">状态</td>
	<td class="t_sub" width="35">分享</td>
	<td class="t_sub" width="80">组别</td>
	<td class="t_sub">姓名</td>
	<td class="t_sub">手机</td>
	<td class="t_sub">身份类型</td>
	<td class="t_sub" width="110px">注册时间</td>
	<td class="t_sub" width="45px">操作</td>
</tr>
<?php $_i=0;$rslist=(is_array($rslist))?$rslist:array();foreach($rslist AS  $key=>$value){$_i++; ?>
<tr class="tr_out" onMouseOver="over_tr(this)" onMouseOut="out_tr(this)">
	<td align="center" class="tc_left"><input type="checkbox" value="<?php echo $value[id];?>"></td>
	<td align="center" class="tc_right"><?php echo $value[id];?></td>
	<td align="center" class="tc_right" id="status_<?php echo $value['id'];?>"><a href="javascript:status(<?php echo $value[id];?>,<?php echo intval($value['status']);?>);void(0);" class="status<?php echo intval($value['status']);?>"></a></td>
	<td align="center" class="tc_right"><a class="status<?php echo intval($value['fxstatus']);?>"></a></td>
	<td align="center" class="tc_right">&nbsp;<?php $_i=0;$grouplist=(is_array($grouplist))?$grouplist:array();foreach($grouplist AS  $k=>$v){$_i++; ?><?php if($v[id] == $value[groupid]){?><?php echo $v[title];?><?php } ?><?php } ?></td>
	<td align="center" class="tc_right">&nbsp;<?php echo $value[username];?></td>
	<td align="center" class="tc_right">&nbsp;<?php echo $value[phone];?></td>
	<td align="center" class="tc_right">&nbsp;<?php if($value[job]=='GSYG'){?>公司员工<?php }elseif($value[job]=='WXFS'){ ?>大众经纪人<?php }elseif($value[job]=='ZJGS'){ ?>中介公司<?php }elseif($value[job]=='DLGS'){ ?>代理公司<?php }elseif($value[job]=='HZHB'){ ?>合作伙伴<?php } ?></td>
	<td align='center' class="tc_right"><?php echo date('Y-m-d H:i',$value[regdate]);?></td>
	<td align="center" class="tc_right">
		<a href="<?php echo site_url('user,set');?>module_id=<?php echo $m_rs[id];?>&id=<?php echo $value[id];?>" class="btn edit" title="编辑"></a>
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
			<input type="button" value="批量审核" onclick="update_pl('1')" class="btn4">
			<input type="button" value="批量未审核" onclick="update_pl('0')" class="btn4">
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
	var fxst = getid("fxstatus").value;
	if(fxst)
	{
		url += "fxstatus="+fxst+"&";
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

function to_status(id,t)
{
	var url = base_url + base_func + "=status&id="+id;
	var msg = get_ajax(url);
	if(msg == "ok")
	{
		var n_t = t == 1 ? 0 : 1;
		$("#status_"+id+" > a").attr("class","status"+n_t);
		$("#status_"+id+" > a").attr("href","javascript:to_status("+id+","+n_t+");void(0)");
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