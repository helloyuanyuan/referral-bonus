<?php if(!defined('PHPOK_SET')){die('<h3>Error...</h3>');}?><?php if($file_uptype == "swf"){?>
<script type="text/javascript" src="libs/swfupload/swfupload.js"></script>
<script type="text/javascript" src="libs/swfupload/swfupload.queue.js"></script>
<script type="text/javascript" src="libs/swfupload/fileprogress.js"></script>
<script type="text/javascript" src="libs/swfupload/handlers.js"></script>
<?php } ?>
<div class="notice"><div class="p">
	<table width="100%" cellpadding="0" cellspacing="0">
	<tr>
		<td><span class="lead">&nbsp;&raquo; 选择/上传</span></td>
		<form method="post" action="<?php echo $page_url;?>">
		<td>时间：<input type="text" name="postdate" id="postdate" onfocus="show_date('postdate')" style="width:75px;" value="<?php echo $postdate;?>"> 关键字：<input type="text" name="keywords" value="<?php echo $keywords;?>" id="keywords" style="width:65px;"> <input type="submit" value="搜索"  class="btn2"></td>
		</form>
		<td align="right">
			<table cellpadding="0" cellspacing="0">
			<form id="form1" action="<?php echo $page_url;?>" method="post" enctype="multipart/form-data">
			<tr>
				<td><div id="divStatus"></div></td>
				<td>&nbsp;</td>
				<td><span id="spanButtonPlaceHolder"></span></td>
				<td>&nbsp;</td>
				<td style="display:none;"><input id="btnCancel" type="button" value="取消上传" onclick="swfu.cancelQueue();" disabled="disabled" /></td>
			</tr>
			</form>
			</table>			
		</td>
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
<?php if($file_uptype == "swf"){?>
<script type="text/javascript">
var settings = {
	flash_url : "libs/swfupload/swfupload.swf",
	upload_url: "<?php echo site_url('open,upload','','&');?>",
	post_params: {"<?php echo SYS_SESSION_ID;?>" : "<?php echo $sys_app->session_lib->sessid();?>"},
	file_size_limit : "200 MB",
	file_types : "<?php echo $swfupload_filetype;?>",
	file_types_description : "<?php echo $swfupload_note;?>",
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