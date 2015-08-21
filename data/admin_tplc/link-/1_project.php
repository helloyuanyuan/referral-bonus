<?php if(!defined('PHPOK_SET')){die('<h3>Error...</h3>');}?><?php $APP->tpl->p("header","","0");?>
<script type="text/javascript">
var input_d = "<?php echo $input_d;?>";
function to_link(sign,id,msign,c_sign,dtime,htmltype)
{
	parent.$("#"+input_d).attr("value",sign);
	parent.Layer.over();
}
</script>
<div class="notice"><div class="p">
	<table width="100%" cellpadding="0" cellspacing="0">
	<tr>
		<td width="130px"><span class="lead">&nbsp;&raquo; 主题</span></td>
		<form method="post" action="<?php echo site_url('link,project');?>input_d=<?php echo rawurlencode($input_d);?>">
		<td align="left">
			搜索：<input type="text" name="keywords" id="keywords" value="<?php echo $keywords;?>">
			<input type="submit" class="btn2" value="查询">
		</td>
		</form>
	</tr>
	</table>
</div></div>

<div class="main">
<table width="100%" style="layout:fixed;" cellpadding="0" cellspacing="0">
<tr>
	<td class="t_sub" width="50px">ID</td>
	<td class="t_sub" width="35px">状态</td>
	<td class="t_sub">名称</td>
	<td class="t_sub" width="110px">发布时间</td>
	<td class="t_sub" width="60px">操作</td>
</tr>
<?php $_i=0;$rslist=(is_array($rslist))?$rslist:array();foreach($rslist AS  $key=>$value){$_i++; ?>
<tr class="tr_out" onMouseOver="over_tr(this)" onMouseOut="out_tr(this)">
	<td align='center' class="tc_left"><?php echo $value[id];?></td>
	<td align="center" class="tc_right"><a class="status<?php echo intval($value['status']);?>"></a></td>
	<td align='left' class="tc_right" style="<?php echo $value[style];?>;padding:2px 0;">&nbsp;<?php echo $value[title];?></td>
	<td  align='center' class="tc_right"><?php echo date('Y-m-d H:i',$value[post_date]);?></td>
	<td align="center" class="tc_right"><input type="button" value="提交" onclick="to_link('<?php echo $value[title];?>','','','','','')" class="btn2" /></td>
</tr>
<?php } ?>
</table>
</div>
<div class="table"><?php echo $pagelist;?></div>
<?php $APP->tpl->p("footer_open","","0");?>