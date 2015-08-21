<?php if(!defined('PHPOK_SET')){die('<h3>Error...</h3>');}?><div class="main">
<table width="100%" style="layout:fixed;" cellpadding="0" cellspacing="0">
<tr>
	<td class="t_sub" width="33px">&nbsp;</td>
	<td class="t_sub" width="30px">状态</td>
	<?php if($ifcate){?>
	<td class="t_sub" width="120px">分类名称</td>
	<?php } ?>
	<td class="t_sub"><?php echo $m_rs[title_nickname] ? $m_rs[title_nickname] : '主题';?></td>
	<?php if($m_rs[if_biz]){?>
		<td class="t_sub" width="100px">售价（RMB）</td>
	<?php } ?>
	<?php $_i=0;$mlist=(is_array($mlist))?$mlist:array();foreach($mlist AS  $key=>$value){$_i++; ?>
		<td class="t_sub"><?php echo $value;?></td>
	<?php } ?>
	<td class="t_sub" width="120px">发布时间</td>
	<td class="t_sub" width="50px">排序</td>
	<td class="t_sub" width="<?php echo $m_rs[if_reply] ? '65' : '45';?>px">操作</td>
</tr>
<?php $_i=0;$rslist=(is_array($rslist))?$rslist:array();foreach($rslist AS  $key=>$value){$_i++; ?>
<tr class="tr_out" onMouseOver="over_tr(this)" onMouseOut="out_tr(this)">
	<td align='center' class="tc_left"><input type="checkbox" value="<?php echo $value[id];?>" /></td>
	<td align="center" class="tc_right" id="status_<?php echo $value[id];?>"><a href="javascript:status(<?php echo $value[id];?>,<?php echo intval($value[status]);?>);void(0);" class="status<?php echo intval($value[status]);?>"></a></td>
	<?php if($ifcate){?>
	<td align="center" class="tc_right"><?php echo $value[cate_name] ? $value[cate_name] : '-';?></td>
	<?php } ?>
	<td align='left' class="tc_right">
		<div style="padding:2px 5px;">
			【<?php echo $value[id];?>】
			<span style="<?php echo $value[style];?>"><?php echo $value[title];?></span>
			<?php if($value[thumb]){?><a href="javascript:phpjs_preview('<?php echo $value[thumb_id];?>');void(0);" title="点击查看大图"><span class="darkred">【图片】</span></a><?php } ?>
			<?php if($value[virtual]){?> <span class="red">虚拟产品</span><?php } ?>
			<?php if($value[istop]){?> <span class="red">[顶]</span><?php } ?>
			<?php if($value[isvouch]){?> <span class="darkblue">[荐]</span><?php } ?>
			<?php if($value[isbest]){?> <span class="darkred">[精]</span><?php } ?>
			<?php if($value[identifier]){?><span class="clue_on">【<?php echo $value[identifier];?>】</span><?php } ?>
		</div>
	</td>
	<?php if($m_rs[if_biz]){?>
		<td align="center" class="tc_right"><?php echo $value[free] ? '免费' : $value[price];?> <?php if($value[ifspecial] && !$value[free]){?><span style="color:red;">特价</span><?php } ?></td>
	<?php } ?>
	<?php $_i=0;$mlist=(is_array($mlist))?$mlist:array();foreach($mlist AS  $k=>$v){$_i++; ?>
		<td  align="center" class="tc_right"><?php echo $value[$k];?></td>
	<?php } ?>
	<td  align="center" class="tc_right"><?php echo date('Y-m-d H:i',$value[post_date]);?></td>
	<td  align="center" class="tc_right"><input type="text" class="center" style="width:40px;" id="taxis_<?php echo $value[id];?>" value="<?php echo $value[taxis];?>" /></td>
	<td align="center" class="tc_right">
		<?php if($m_rs[if_reply]){?><a href="<?php echo site_url('reply');?>tid=<?php echo $value[id];?>" class="btn reply" title="留言"></a><?php } ?>
		<a href="<?php echo site_url('list,set');?>id=<?php echo $value[id];?>" class="btn edit" title="编辑"></a>
		<a href="javascript:del(<?php echo $value['id'];?>);void(0);" class="btn del" title="删除"></a>
	</td>
</tr>
<?php } ?>
</table>
</div>