<?php if(!defined('PHPOK_SET')){die('<h3>Error...</h3>');}?><?php $APP->tpl->p("header","","0");?>
<div class="notice"><div class="p">
	<table width="100%" cellpadding="0" cellspacing="0">
	<tr>
		<td width="130px"><span class="lead">&nbsp;&raquo; 图片方案列表</span></td>
		<td align="right"><a href="<?php echo site_url('gd,set');?>" class="button">添加新方案</a></td>
	</tr>
	</table>
</div></div>

<div class="main">
<table width="100%" style="layout:fixed;" cellpadding="0" cellspacing="0">
<tr>
	<td class="t_sub" width="50px">ID</td>
	<td class="t_sub" width="35px">状态</td>
	<td class="t_sub">名称</td>
	<td class="t_sub" width="100px">标识</td>
	<td class="t_sub" width="40px">版权</td>
	<td class="t_sub" width="150px">图片宽高</td>
	<td class="t_sub" width="60px">排序</td>
	<td class="t_sub" width="45px">操作</td>
</tr>
<?php $_i=0;$rslist=(is_array($rslist))?$rslist:array();foreach($rslist AS  $key=>$value){$_i++; ?>
<tr class="tr_out" onMouseOver="over_tr(this)" onMouseOut="out_tr(this)">
	<td align="center" class="tc_left"><?php echo $value[id];?></td>
	<td align="center" class="tc_right"><a class="status<?php echo intval($value['status']);?>"></a></td>
	<td class="tc_right">&nbsp;<?php echo $value[picsubject];?><?php if($value[edit_default]){?><span class="clue_on">【允许在编辑器中使用】</span><?php } ?></td>
	<td class="tc_right" align="center"><?php echo $value[pictype];?></td>
	<td align="center" class="tc_right"><?php if($value[water]){?><span style="color:darkblue;">使用</span><?php }else{ ?>禁用<?php } ?></td>
	<td class="tc_right" align="center"><?php echo $value[width];?>px &#215; <?php echo $value[height];?>px</td>
	<td class="tc_right" align="center"><?php echo $value[taxis];?></td>
	<td class="tc_right">
		<a href="<?php echo site_url('gd,set');?>id=<?php echo $value[id];?>" class="btn edit" title="编辑"></a>
		<a href="javascript:to_delete(<?php echo $value['id'];?>);void(0);" class="btn del" title="删除"></a>
	</td>
</tr>
<?php } ?>
</table>
</div>
<script type="text/javascript">
var gd_url = base_file + "?"+base_ctrl+"=gd&"+base_func+"=";
function to_delete(id)
{
	if(!id)
	{
		alert("操作非法，没有指定ID");
		return false;
	}
	var qc = confirm("确定要删除当前图片生成方案吗？\n\n删除操作将同时删除相应的已经生成的图片，请慎用");
	if(qc == "0")
	{
		return false;
	}
	var url = gd_url + "del_gd&id="+id;
	var msg = get_ajax(url);
	if(msg == "ok")
	{
		direct(window.location.href);
		return true;
	}
	else
	{
		if(!msg) msg = "error: 删除失败！";
		alert(msg);
		return false;
	}
}
</script>
<?php $APP->tpl->p("footer","","0");?>