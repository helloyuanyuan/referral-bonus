<?php if(!defined('PHPOK_SET')){die('<h3>Error...</h3>');}?><?php $APP->tpl->p("header","","0");?>
<script type="text/javascript">
function to_del(id)
{
	if(!id)
	{
		alert("操作非法");
		return false;
	}
	var q = confirm("确定要删除此合伙人组吗？删除后是不能恢复的");
	if(q != 0)
	{
		var url = base_url + base_func + "=ajax_del&id="+id;
		var msg = get_ajax(url);
		if(!msg) msg = "error: 操作非法";
		if(msg == "ok")
		{
			direct(window.location.href);
		}
		else
		{
			alert(msg);
			return false;
		}
	}
}

function to_modify(id)
{
	var url = base_url + base_func + "=set&id="+id;
	direct(url);
}

function to_default(id,title)
{
	var qc = confirm("确定要将合伙人组【"+title+"】设置为默认合伙人组吗？");
	if(qc == "0")
	{
		return false;
	}
	var url = base_url + base_func + "=ajax_default&id="+id;
	var msg = get_ajax(url);
	if(!msg) msg = "error: 操作非法";
	if(msg == "ok")
	{
		direct(window.location.href);
	}
	else
	{
		alert(msg);
		return false;
	}
}
</script>
<div class="notice"><div class="p">
	<table width="100%" cellpadding="0" cellspacing="0">
	<tr>
		<td><span class="lead">&nbsp;&raquo; 合伙人组管理</span></td>
		<td align="right"><a href="<?php echo site_url('usergroup,set');?>" class="button">添加新合伙人组</a></td>
	</tr>
	</table>
</div></div>

<div class="main">
<table width="100%" style="layout:fixed;" cellpadding="0" cellspacing="0">
<tr>
	<td class="t_sub" width="50px">组ID</td>
	<td class="t_sub">组名称</td>
	<td class="t_sub" width="200px">操作</td>
</tr>
<?php $_i=0;$rslist=(is_array($rslist))?$rslist:array();foreach($rslist AS  $key=>$value){$_i++; ?>
<tr class="tr_out" onMouseOver="over_tr(this)" onMouseOut="out_tr(this)">
	<td align='center' class="tc_left" height="30px"><?php echo $value[id];?></td>
	<td align='left' class="tc_right">&nbsp;<?php echo $value[title];?> <?php if($value[group_type] == 'guest'){?><span class="red">【游客组】</span><?php } ?></td>
	<td align="left" class="tc_right">&nbsp;
		<input type="button" value="编辑" class="btn2" onclick="to_modify('<?php echo $value[id];?>')" />
		<input type="button" value="删除" class="btn2" onclick="to_del('<?php echo $value[id];?>')" />
		<?php if($value[group_type] == "user"){?>
			<?php if(!$value[ifdefault]){?>
			<input type="button" value="默认" class="btn2" onclick="to_default('<?php echo $value[id];?>','<?php echo $value[title];?>')" />
			<?php }else{ ?>
			<input type="button" value="默认" class="btn2" disabled />
			<?php } ?>
		<?php } ?>
	</td>
</tr>
<?php } ?>
</table>
</div>
<?php $APP->tpl->p("footer","","0");?>