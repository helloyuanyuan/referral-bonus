<?php if(!defined('PHPOK_SET')){die('<h3>Error...</h3>');}?><?php $APP->tpl->p("header","","0");?>
<?php if($file_uptype == "swf"){?>
<script type="text/javascript" src="libs/swfupload/swfupload.js"></script>
<script type="text/javascript" src="libs/swfupload/swfupload.queue.js"></script>
<script type="text/javascript" src="libs/swfupload/fileprogress.js"></script>
<script type="text/javascript" src="libs/swfupload/handlers.js"></script>
<?php } ?>
<div class="notice"><div class="p">
	<table width="100%" cellpadding="0" cellspacing="0">
	<tr>
		<td width="150px">
			<table cellpadding="0" cellspacing="0">
			<form id="_phpok_action_upload" action="<?php echo $page_url;?>" method="post" enctype="multipart/form-data">
			<tr>
				<td><span class="lead">&nbsp;&raquo; 附件列表</span></td>
				<td><div id="divStatus"></div></td>
				<td>&nbsp;</td>
				<td><span id="spanButtonPlaceHolder"></span></td>
				<td>&nbsp;</td>
				<td style="display:none;"><input id="btnCancel" type="button" value="取消上传" onclick="swfu.cancelQueue();" disabled="disabled" /></td>
			</tr>
			</form>
			</table>			
		</td>
		<td>
			<table>
			<form method="post" action="<?php echo site_url('files');?>">
			<tr>
				<td>附件搜索：</td>
				<td>
					<select name="type" id="type">
						<option value="">全部，不限</option>
						<option value="img"<?php if($input_type == "img"){?> selected<?php } ?>>图片类</option>
						<option value="video"<?php if($input_type == "video"){?> selected<?php } ?>>影音类</option>
						<option value="download"<?php if($input_type == "download"){?> selected<?php } ?>>其他</option>
					</select>
				</td>
				<td>上传时间：</td>
				<td><input type="text" name="postdate" id="postdate" onfocus="show_date('postdate')" style="width:75px;" value="<?php echo $postdate;?>"></td>
				<td>&nbsp; 关键字：</td>
				<td><input type="text" name="keywords" value="<?php echo $keywords;?>" id="keywords"></td>
				<td><input type="submit" value="搜索" class="btn2"></td>
			</tr>
			</form>
			</table>
		</td>
		<td align="right"><a href="<?php echo site_url('files,set');?>" class="button">附件设置</a></td>
	</tr>
	</table>
</div></div>
<?php if($file_uptype != "swf"){?>
<div class="notice"><div class="p">
<table cellpadding="0" cellspacing="0">
<form method="post" action="<?php echo site_url('open,upok','','&');?>" enctype="multipart/form-data">
<input type="hidden" id="_go_back_url" name="_go_back_url" value="<?php echo $page_url;?>" />
<tr>
	<td>&nbsp;&raquo; 上传附件：</td>
	<td><input type="file" name="upload_file" id="upload_file" size="12"></td>
	<td>&nbsp;</td>
	<td><input type="submit" value="上传" class="btn2" /></td>
</tr>
</form>
</table>
</div></div>
<?php } ?>
<div id="fsUploadProgress" class="swfupload_progress"></div>
<div class="main">
<table width="100%" style="layout:fixed;" cellpadding="0" cellspacing="0">
<tr>
	<td class="t_sub" width="50%">名称</td>
	<td class="t_sub" width="50%">名称</td>
</tr>
<tr>
	<?php $_i=0;$rslist=(is_array($rslist))?$rslist:array();foreach($rslist AS  $key=>$value){$_i++; ?>
	<?php $ftype = ROOT."./app/admin/view/images/filetype-large/".$value[ftype].".jpg";?>
	<?php $thumb = file_exists($ftype) ? $value[ftype] : "unknown";?>
	<td class="<?php echo ($key)%2=='' ? 'tc_left' : 'tc_right';?>">
		<table width="100%" onMouseOver="over_tr(this)" onMouseOut="out_tr(this)">
		<tr>
			<td align="center" width="90px" height="90px"><a href="javascript:phpjs_preview(<?php echo $value[id];?>);void(0);"><?php if($value[thumb]){?><img src="<?php echo $value[thumb];?>" width="80px" height="80px" /><?php }else{ ?><img src="./app/admin/view/images/filetype-large/<?php echo $thumb;?>.jpg" width="80px" height="80px" /><?php } ?></a></td>
			<td>
				<?php if($thumb == "flv"){?>
				<div>封面：<input type="text" id="flv_pic_<?php echo $value[id];?>" value="<?php echo $value[flv_pic];?>" style="width:180px" /> <input type="button" value="选择" class="btn2" onclick="phpjs_onepic('flv_pic_<?php echo $value[id];?>')" /> <input type="button" class="btn2" value="清空" onclick="phpjs_onepic_clear('flv_pic_<?php echo $value[id];?>')">
				</div>
				<div style="padding-top:5px;">名称：<input type="text" id="tmpname_<?php echo $value[id];?>" value="<?php echo $value[title] ? $value[title] : basename($value[filename]);?>" style="width:180px" /> <input type="button" value="提交" onclick="update_name(<?php echo $value[id];?>);" class="btn2" /></div>
				<?php }else{ ?>
				<div>名称：<input type="text" id="tmpname_<?php echo $value[id];?>" value="<?php echo $value[title] ? $value[title] : basename($value[filename]);?>" style="width:180px" /> <input type="button" value="改名" onclick="update_name(<?php echo $value[id];?>);" class="btn2" /></div>
				<?php } ?>
				<div style="padding-top:5px;">时间：<?php echo date("Y-m-d H:i:s",$value[postdate]);?></div>
				<div style="padding-top:5px;">
					<table cellpadding="0" cellspacing="0">
					<tr>
						<td><input type="checkbox" value="<?php echo $value[id];?>" /></td>
						<td><a href="javascript:update_one(<?php echo $value['id'];?>);void(0);" class="btn pic_gd" title="更新图片规格"></a></td>
						<td><a href="javascript:copy_url(<?php echo $value['id'];?>);void(0);" class="btn piclink" title="链接"></a></td>
						<td><a href="javascript:to_delete(<?php echo $value['id'];?>);void(0);" class="btn pic_del" title="删除"></a></td>
						<td id="notice_<?php echo $value[id];?>" style="color:darkblue;"></td>
					</tr>
					</table>
				</div>
			</td>
		</tr>
		</table>
	</td>
	<?php if($_i%2===0){echo '</tr><tr>';}?>
	<?php } ?>
</tr>
</table>
</div>
<div class="table">
	<table width="100%">
	<tr>
		<td>
			<input type="button" value="全选" onclick="select_all()" class="btn2">
			<input type="button" value="全不选" onclick="select_none()" class="btn3">
			<input type="button" value="反选" onclick="select_anti()" class="btn2">
			&nbsp;
			<input type="button" value="批量更新" onclick="update_pl()" class="btn4">
			<input type="button" value="全部更新" onclick="update_all()" class="btn4">
			&nbsp;
			<input type="button" value="批量删除" onclick="del_pl()" class="btn4">
		</td>
		<td align="right"><?php echo $pagelist;?></td>
	</tr>
	</table>
</div>
<script type="text/javascript">
var page_url = "<?php echo $page_url;?>";
</script>
<?php if($file_uptype == "swf"){?>
<script type="text/javascript">
var settings = {
	flash_url : "libs/swfupload/swfupload.swf",
	upload_url: "<?php echo site_url('open,upload','','&');?>",
	post_params: {"<?php echo SYS_SESSION_ID;?>" : "<?php echo $sys_app->session_lib->sessid();?>"},
	file_size_limit : "500 MB",
	file_types : "*.*",
	file_types_description : "全部文件",
	file_upload_limit : 100,
	file_queue_limit : 0,
	custom_settings : {
		progressTarget : "fsUploadProgress",
		cancelButtonId : "btnCancel"
	},
	debug: false,

	// Button settings
	button_image_url: "./app/admin/view/images/swfupload.png",
	button_placeholder_id : "spanButtonPlaceHolder",
	button_width: "62",
	button_height: "22",

	// The event handler functions are defined in handlers.js
	file_queued_handler : fileQueued,
	file_queue_error_handler : fileQueueError,
	file_dialog_complete_handler : fileDialogComplete,
	upload_start_handler : uploadStart,
	upload_progress_handler : uploadProgress,
	upload_error_handler : uploadError,
	upload_success_handler : uploadSuccess,
	upload_complete_handler : uploadComplete,
	queue_complete_handler : queueComplete	// Queue plugin event
};
swfu = new SWFUpload(settings);
</script>
<?php } ?>
<script type="text/javascript">
function update_one(id)
{
	var url = base_file + "?" + base_ctrl + "=open&" + base_func + "=pl&picid="+id;
	Layer.init(url,630,500);
}
function update_pl()
{
	var id = join_checkbox();
	if(!id)
	{
		alert("请选择要更新的附件");
		return false;
	}
	var url = base_file + "?" + base_ctrl + "=open&" + base_func + "=pl&picid="+id;
	Layer.init(url,630,500);
}
function update_all()
{
	var url = base_file + "?" + base_ctrl + "=open&" + base_func + "=pl&picid=all";
	Layer.init(url,630,500);
}
function del_pl()
{
	var id = join_checkbox();
	if(!id)
	{
		alert("请选择要批量删除的附件");
		return false;
	}
	var qc = confirm("确定要删除这些附件吗？删除后是不能恢复的！");
	if(qc == "0")
	{
		return false;
	}
	var url = base_url + base_func + "=del&id="+id;
	var msg = get_ajax(url);
	if(!msg) msg = "error!";
	if(msg == "ok")
	{
		direct(page_url);
	}
	else
	{
		alert(msg);
		return false;
	}
}
function to_delete(id)
{
	if(!id)
	{
		alert("没有指定ID！");
		return false;
	}
	var qc = confirm("确定要删除该附件吗？删除后是不能恢复的！");
	if(qc == "0")
	{
		return false;
	}
	var url = base_url + base_func + "=del&id="+id;
	var msg = get_ajax(url);
	if(!msg) msg = "error!";
	if(msg == "ok")
	{
		direct(page_url);
	}
	else
	{
		alert(msg);
		return false;
	}
}
function update_name(id)
{
	if(!id)
	{
		alert("获取ID错误！请检查！");
		return false;
	}
	var tname = getid("tmpname_"+id).value;
	if(!tname)
	{
		alert("名称不允许为空！");
		return false;
	}
	var url = base_url + base_func + "=update_name&id="+id+"&tmpname="+EncodeUtf8(tname);
	//判断是否有封面，如有，同时更新FLV封面信息
	if(getid("flv_pic_"+id))
	{
		var flv_pic = getid("flv_pic_"+id).value;
		url += "&flv_pic="+EncodeUtf8(flv_pic);
	}
	get_ajax(url,js_update_tmpname,id);
}
function js_update_tmpname(msg,id)
{
	if(msg == "ok")
	{
		getid("notice_"+id).innerHTML = "更名成功";
		eval_js(3,"js_clear_tmpname("+id+")");
		return true;
	}
	else
	{
		if(msg)
		{
			getid("notice_"+id).innerHTML = msg;
			return false;
		}
	}
}
function js_clear_tmpname(id)
{
	getid("notice_"+id).innerHTML = "";
}
function copy_url(id)
{
	var url = base_file + "?" + base_ctrl + "=open&" + base_func + "=copyurl&id="+id;
	Layer.init(url,630,500);
}
</script>
<?php $APP->tpl->p("footer","","0");?>