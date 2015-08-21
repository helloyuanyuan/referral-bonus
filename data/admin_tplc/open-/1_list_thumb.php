<?php if(!defined('PHPOK_SET')){die('<h3>Error...</h3>');}?><?php $APP->tpl->p("header","","0");?>
<script type="text/javascript">
function clickpic(id,view)
{
	parent.getid("<?php echo $input_id;?>").value = id;
	var viewhtml = '<img src="'+view+'" class="hand" width="80px" height="80px" onclick="phpjs_preview(\''+id+'\')" />';
	parent.getid("<?php echo $input_view;?>").innerHTML = viewhtml;
	parent.Layer.over();
}
</script>
<?php $APP->tpl->p("swfupload","","0");?>
<div class="main">
<table width="100%" style="layout:fixed;">
<tr>
	<?php $_i=0;$rslist=(is_array($rslist))?$rslist:array();foreach($rslist AS  $key=>$value){$_i++; ?>
	<td style="text-align:center;padding-top:5px;"><img src="<?php echo $value[thumb];?>" width='80px' height='80px' class="hand" onclick="clickpic('<?php echo $value[id];?>',this.src);" title="上传时间：<?php echo date('Y-m-d H:i:s',$value[postdate]);?>&#13;&#10;文件名称：<?php echo $value[title] ? $value[title] : basename($value[filename]);?>" /></td>
	<?php if($_i%5===0){echo '</tr><tr>';}?>
	<?php } ?>
</tr>
</table>
</div>
<?php if($pagelist){?><div class="table"><?php echo $pagelist;?></div><?php } ?>
<?php $APP->tpl->p("footer_open","","0");?>