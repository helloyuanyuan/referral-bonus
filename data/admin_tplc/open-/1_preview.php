<?php if(!defined('PHPOK_SET')){die('<h3>Error...</h3>');}?><?php $APP->tpl->p("header","","0");?>
<div class="notice"><div class="p">
	<table width="100%" cellpadding="0" cellspacing="0">
	<tr>
		<td><span class="lead">&nbsp;&raquo; 预览 &nbsp; 上传时间：<?php echo date("Y-m-d H:i:s",$rs[postdate]);?></span></td>
		<td align="right"><img src='./app/admin/view/images/del.gif' border='0' onclick='parent.Layer.over();' title='点此关闭'>&nbsp;</td>
	</tr>
	</table>
</div></div>
<?php if($ftype == "video"){?>
<?php $pre_image = $rs[flv_pic] ? $rs[flv_pic] : $_sys[video_image];?>
<div id="video_player" style="text-align:center;"></div>
<script type="text/javascript">
var htmlmsg = Media.init("<?php echo $rs[filename];?>","<?php echo $_sys[video_width];?>","<?php echo $_sys[video_height];?>","<?php echo $pre_image;?>");
getid("video_player").innerHTML = htmlmsg;
</script>
<?php }elseif($ftype == "img"){ ?>
<div style="padding:1px 5px;"><img src="<?php echo $rs[filename];?>" /></div>
	<?php $_i=0;$rslist=(is_array($rslist))?$rslist:array();foreach($rslist AS  $key=>$value){$_i++; ?>
	<div style="padding:1px 5px;"><img src="<?php echo $value[filename];?>" /></div>
	<?php } ?>
<script type="text/javascript">
$(document).ready(function() {
	var maxwidth=520;
	$("img").each(function(){
		if (this.width>maxwidth) this.width = maxwidth;
	});
});
</script>
<?php }else{ ?>
<div style="padding:5px;">附件名：<?php echo $rs[title];?></div>
<div style="padding:5px;">上传时间：<?php echo date("Y-m-d H:i:s",$rs[postdate]);?></div>
<div style="padding:1px 5px;">附件路径：<a href="<?php echo $rs[filename];?>"><?php echo $rs[filename];?></a></div>
<div style="padding:3px 5px;color:red;">如需下载，请右键点击右存为即可！</div>
<?php } ?>

<?php $APP->tpl->p("footer_open","","0");?>