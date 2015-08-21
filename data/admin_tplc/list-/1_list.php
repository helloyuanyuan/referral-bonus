<?php if(!defined('PHPOK_SET')){die('<h3>Error...</h3>');}?><?php $APP->tpl->p("header","","0");?>
<div class="notice"><div class="p">
	<table width="100%" cellpadding="0" cellspacing="0">
	<tr>
		<td width="130px"><span class="lead">&nbsp;&raquo; <?php echo $m_rs[title];?></span></td>
		<form method="post" action="<?php echo site_url('list');?>module_id=<?php echo $module_id;?>">
		<td align="left">
			搜索：<?php if($ifcate){?><?php echo $cate_html;?><?php } ?>
			<input type="text" name="keywords" id="keywords" value="<?php echo $keywords;?>">
			<input type="submit" class="btn2" value="查询">
		</td>
		</form>
		<td align="right"><a href="<?php echo site_url('list,set');?>module_id=<?php echo $m_rs[id];?>&" class="button">添加内容</a></td>
	</tr>
	</table>
</div></div>



<?php if($m_rs[tplset] == 'pic'){?>
	<?php $APP->tpl->p("list/list_pic","","0");?>
<?php }else{ ?>
	<?php $APP->tpl->p("list/list_txt","","0");?>
<?php } ?>

<div class="table">
	<table width="100%">
	<tr>
		<td>
			<input type="button" value="全选" onclick="select_all()" class="btn2">
			<input type="button" value="全不选" onclick="select_none()" class="btn3">
			<input type="button" value="反选" onclick="select_anti()" class="btn2">
			<select name="act_plset" id="act_plset">
				<option value="">请选择操作方案</option>
				<optgroup label="批处理">
					<?php if($m_rs[if_propety]){?>
					<option value="istop:1">置顶</option>
					<option value="isvouch:1">推荐</option>
					<option value="isbest:1">精华</option>
					<?php } ?>
					<option value="status:1">审核</option>
					<?php if($m_rs[if_propety]){?>
					<option value="istop:0">取消置顶</option>
					<option value="isvouch:0">取消推荐</option>
					<option value="isbest:0">取消精华</option>
					<?php } ?>
					<option value="status:0">取消审核</option>
					<option value="taxis">更新排序</option>
					<option value="del">批量删除</option>
				</optgroup>
				<?php if($ifcate){?>
				<optgroup label="移动主题分类">
					<?php $_i=0;$cate_list_array=(is_array($cate_list_array))?$cate_list_array:array();foreach($cate_list_array AS  $key=>$value){$_i++; ?>
						<option value="cate:<?php echo $value[id];?>"><?php echo $value[space];?><?php echo $value[cate_name];?><?php if(!$value[status]){?>【暂停使用】<?php } ?></option>
					<?php } ?>
				</optgroup>
				<?php } ?>
			</select>
			<input type="button" value="提交" onclick="update_pl()" class="btn2">
		</td>
		<td align="right"><?php echo $pagelist;?></td>
	</tr>
	</table>
</div>
<?php $APP->tpl->p("footer","","0");?>