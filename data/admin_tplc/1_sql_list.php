<?php if(!defined('PHPOK_SET')){die('<h3>Error...</h3>');}?><?php $APP->tpl->p("header","","0");?>
<div class="notice"><div class="p">
	<table width="100%" cellpadding="0" cellspacing="0">
	<tr>
		<td><span class="lead">&nbsp;&raquo; <a href="<?php echo site_url('phpoksql');?>">数据库管理</a> &raquo; 已备份列表</span></td>
	</tr>
	</table>
</div></div>

<div class="main">
<table width="100%" style="layout:fixed;" cellpadding="0" cellspacing="0">
<tr>
	<td class="t_sub" width="140px">备份时间</td>
	<td class="t_sub">文件[仅列出表结构文件]</td>
    <td class="t_sub" width="140px">管理员</td>
	<td class="t_sub" width="80px">大小</td>
	<?php if($set_popedom){?>
	<td class="t_sub" width="45px">操作</td>
	<?php } ?>
</tr>
<?php $_i=0;$rslist=(is_array($rslist))?$rslist:array();foreach($rslist AS  $key=>$value){$_i++; ?>
<tr class="tr_out" onMouseOver="over_tr(this)" onMouseOut="out_tr(this)">
	<td align="center" class="tc_left"><?php echo $value[postdate];?></td>
	<td class="tc_right">&nbsp;<?php echo $value[filename];?></td>
	<td align="center" class="tc_right">&nbsp;<?php echo $value[admin];?></td>
	<td align="center" class="tc_right"><?php echo sys_numformat($value[psize]);?></td>
	<?php if($set_popedom){?>
	<td align="center" class="tc_right">
		<a href="javascript:recover_sql('<?php echo $value[basename];?>');void(0);" class="btn sqlback" title="还原"></a>
		<a href="javascript:to_del('<?php echo $value[basename];?>');void(0);" class="btn del" title="删除"></a>
	</td>
	<?php } ?>
</tr>
<?php } ?>
</table>
</div>
&nbsp; &nbsp;<input type="button" value="还原SESSION表" onclick="to_session();" class="btn9" />
<?php if($set_popedom){?>
<script type="text/javascript">
function to_session()
{
	var qu = confirm("确定要初始化SESSION表结构信息吗？操作完后，您需要重新登录！");
	if(qu == "0")
	{
		return false;
	}
	var url = base_url + base_func + "=recover_session";
	direct(url);
}

function to_del(id)
{
	var qu = confirm("确定要删除当备份文件："+id);
	if(qu == "0")
	{
		return false;
	}
	var url = base_url + base_func + "=del&id="+encode_utf8(id);
	direct(url);
}
function recover_sql(id)
{
	var qu = confirm("确定要恢复当前数据表吗？恢复前请先备份当前系统");
	if(qu == "0")
	{
		return false;
	}
	var url = base_url + base_func + "=recover&id="+encode_utf8(id);
	direct(url);
}
</script>
<?php } ?>

<?php $APP->tpl->p("footer","","0");?>