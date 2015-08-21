<?php if(!defined('PHPOK_SET')){die('<h3>Error...</h3>');}?><?php $APP->tpl->p("header","","0");?>
<div class="notice"><div class="p">
	<table width="100%" cellpadding="0" cellspacing="0">
	<tr>
		<td><span class="lead">&nbsp;&raquo; <a href="<?php echo site_url('files');?>">附件列表</a> &raquo; 附件参数设置</span></td>
	</tr>
	</table>
</div></div>

<form method="post" action="<?php echo site_url('files,setok');?>" onsubmit="return to_submit();">
<div class="table">
	<div class="left">图片类型：</div>
	<input type="text" name="picture_type" id="picture_type" class="long_input" value="<?php echo $rs[picture_type];?>">
</div>

<div class="table">
	<div class="left">影音类型：</div>
	<input type="text" name="video_type" id="video_type" class="long_input" value="<?php echo $rs[video_type];?>">
</div>

<div class="table">
	<div class="left">文件类型：</div>
	<input type="text" name="file_type" id="file_type" class="long_input" value="<?php echo $rs[file_type];?>">
</div>

<div class="table">
	<div class="left">&nbsp;</div>
	<span class="clue_on">多种附件类型用英文逗号隔开</span>
</div>

<div class="table">
	<div class="left">存储方式：</div>
	<select name="file_save_type">
		<option value=""<?php if(!$rs[file_save_type]){?> selected<?php } ?>>附件目录/</option>
		<option value="Ym/d"<?php if($rs[file_save_type] == 'Ym/d'){?> selected<?php } ?>>附件目录/年月/日/</option>
		<option value="Ym"<?php if($rs[file_save_type] == 'Ym'){?> selected<?php } ?>>附件目录/年月/</option>
		<option value="Y/m/d"<?php if($rs[file_save_type] == 'Y/m/d'){?> selected<?php } ?>>附件目录/年/月/日/</option>
	</select>
</div>

<div class="table">
	<div class="left">附件上传方式：</div>
	<select name="file_uptype">
		<option value="swf"<?php if($rs[file_uptype] == "swf"){?> selected<?php } ?>>SWFUpload多文件上传</option>
		<option value="normal"<?php if($rs[file_uptype] == 'normal'){?> selected<?php } ?>>普通上传方式</option>
	</select>
</div>

<div class="table">
	<div class="left">&nbsp;</div>
	<input type="submit" class="btn2" id="_phpok_submit" name="article_submit" value="提交">
</div>

</form>

<script type="text/javascript">
function to_submit()
{
	getid("_phpok_submit").disabled = true;
}
</script>
<?php $APP->tpl->p("footer","","0");?>