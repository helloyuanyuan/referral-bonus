<?php if(!defined('PHPOK_SET')){die('<h3>Error...</h3>');}?><?php $APP->tpl->p("header","","0");?>
<script type="text/javascript">
function js_copy(id)
{
	var base_folder = "<?php echo base_url();?>";
	var str = $("#"+id).attr("href");
	var content = base_folder + str.toString();
	if($.browser.msie == true) {
        clipboardData.setData('Text',content);
        alert ("该地址已经复制到剪切板");
    } else {    
        alert("浏览器不支持此操作，请移到内容区，点右键【复制链接地址】");
    }
	return false;
}
</script>
<div class="main">
<table width="100%" style="layout:fixed;" cellpadding="0" cellspacing="0">
<tr>
	<td class="t_sub" style="width:30%">说明</td>
	<td class="t_sub">内容</td>
</tr>
<?php if($ifimg){?>
<tr class="tr_out">
	<td align='left' class="tc_left">&nbsp;图片：<a class="btn reply"></a></td>
	<td align='left' class="tc_right"><img src="<?php echo $rs[thumb];?>" style="margin:3px;" /></td>
</tr>
<?php } ?>
<tr class="tr_out" onMouseOver="over_tr(this)" onMouseOut="out_tr(this)">
	<td align='left' class="tc_left">&nbsp;文件名称：<a class="btn reply"></a></td>
	<td align='left' class="tc_right">&nbsp;<?php echo $rs[title];?></td>
</tr>
<tr class="tr_out" onMouseOver="over_tr(this)" onMouseOut="out_tr(this)">
	<td align='left' class="tc_left">&nbsp;上传时间：<a class="btn reply"></a></td>
	<td align='left' class="tc_right">&nbsp;<?php echo date("Y-m-d H:i:s",$rs[postdate]);?></td>
</tr>
<tr class="tr_out" onMouseOver="over_tr(this)" onMouseOut="out_tr(this)">
	<td align='left' class="tc_left">&nbsp;原文件地址：<a href="javascript:js_copy('_filename_<?php echo $rs[id];?>');void(0);" class="btn copy" title="复制此链接"></a></td>
	<td align='left' class="tc_right">&nbsp;<a href="<?php echo $rs[filename];?>" id="_filename_<?php echo $rs[id];?>" target="_blank"><?php echo $rs[filename];?></a></td>
</tr>
<?php $_i=0;$rslist=(is_array($rslist))?$rslist:array();foreach($rslist AS  $key=>$value){$_i++; ?>
<tr class="tr_out" onMouseOver="over_tr(this)" onMouseOut="out_tr(this)">
	<td align='left' class="tc_left">&nbsp;<?php echo $value[picsubject];?>：<a href="javascript:js_copy('<?php echo $value[gdtype];?>_<?php echo $rs[id];?>');void(0);" class="btn copy" title="复制此链接"></a></td>
	<td align='left' class="tc_right">&nbsp;<a href="<?php echo $value[filename];?>" target="_blank" id="<?php echo $value[gdtype];?>_<?php echo $rs[id];?>"><?php echo $value[filename];?></a></td>
</tr>
<?php } ?>
</table>
</div>
<?php $APP->tpl->p("footer_open","","0");?>