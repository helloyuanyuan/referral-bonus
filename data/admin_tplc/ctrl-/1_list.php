<?php if(!defined('PHPOK_SET')){die('<h3>Error...</h3>');}?><?php $APP->tpl->p("header","","0");?>
<div class="notice"><div class="p">
	<table width="100%" cellpadding="0" cellspacing="0">
	<tr>
		<td><span class="lead">&nbsp;&raquo; 模块管理</span></td>
		<td>
			<select name="groupid" id="groupid" onchange="to_update_g(this.value)">
			<option value="0">全部模块组</option>
			<?php $_i=0;$grouplist=(is_array($grouplist))?$grouplist:array();foreach($grouplist AS  $key=>$value){$_i++; ?>
			<option value="<?php echo $value[id];?>"<?php if($value[id] == $groupid){?> selected<?php } ?>><?php echo $value[title];?><?php if(!$value[status]){?>【暂停使用】<?php } ?></option>
			<?php } ?>
			</select>
			<input type="button" value="搜索" class="btn2" onclick="to_search();">
			<input type="button" value="添加" class="btn2" onclick="to_group_set();" id="to_g_title">
			<span id="g_del_if" style="display:none;"><input type="button" value="删除" class="btn2" onclick="to_group_del();"></span>
		</td>
		<td align="right"><a href="<?php echo site_url('ctrl,set');?>" class="button">添加新组</a></td>
	</tr>
	</table>
</div></div>

<div class="main">
<table width="100%" style="layout:fixed;" cellpadding="0" cellspacing="0">
<tr>
	<td width="8%" class="t_sub">ID</td>
	<td width="5%" class="t_sub">状态</td>
	<td width="110px" class="t_sub">组</td>
	<td class="t_sub">名称</td>
	<td width="15%" class="t_sub">标识</td>
	<td class="t_sub">排序</td>
	<td width="65px" class="t_sub">操作</td>
</tr>
<?php $_i=0;$rslist=(is_array($rslist))?$rslist:array();foreach($rslist AS  $key=>$value){$_i++; ?>
<tr class="tr_out" onMouseOver="over_tr(this)" onMouseOut="out_tr(this)">
	<td align='center' class="tc_left" height="25px"><?php echo $value[id];?></td>
	<td align="center" class="tc_right" id="status_<?php echo $value['id'];?>"><a href="javascript:status(<?php echo $value[id];?>,<?php echo intval($value['status']);?>);void(0);" class="status<?php echo intval($value['status']);?>"></a></td>
	<td align="center" class="tc_right"><?php echo $value[g_title] ? $value[g_title] : '<span class="red">全部组</span>';?></td>
	<td  align='left' class="tc_right">&nbsp;<?php echo $value[title];?><?php if($value[note]){?><span class="clue_on"> [<?php echo $value[note];?>]</span><?php } ?></td>
	<td align="center" class="tc_right"><?php echo $value[identifier];?></td>
	<td align="center" class="tc_right"><?php echo $value[taxis];?></td>
	<td align="center" class="tc_right">
		<a href="<?php echo site_url('ctrl,set');?>id=<?php echo $value[id];?>" class="btn edit" title="编辑"></a>
		<a href="javascript:del(<?php echo $value['id'];?>);void(0);" class="btn del" title="删除"></a>
		<?php if($value[ctrl_init] == 'list'){?>
		<a href="<?php echo site_url('ctrl,fields');?>id=<?php echo $value[id];?>" class="btn key" title="字段管理"></a>
		<?php } ?>
	</td>
</tr>
<?php } ?>
</table>
</div>
<?php if($pagelist){?><div class="table"><?php echo $pagelist;?></div><?php } ?>
<?php $APP->tpl->p("footer","","0");?>