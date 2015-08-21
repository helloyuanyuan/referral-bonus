<?php if(!defined('PHPOK_SET')){die('<h3>Error...</h3>');}?><?php $APP->tpl->p("head","","0");?>
<div class="div_w m_top">
	<div class="left">
		<div class="model"><div class="bg">
			<h5>安装步骤</h5>
			<ol class="ol">
				<li><a href="index.php">安装说明</a></li>
				<li><a href="index.php?act=setconfig">配置安装参数</a></li>
				<li><a href="#">完成</a></li>
			</ol>
		</div></div>
		<div class="space"></div>
	</div>
	<div class="right">
		<div class="model"><div class="bg">
			<h5>友情提示</h5>
			<div class="msg" style="padding:5px 15px;"><?php echo $content;?></div>
		</div></div>
		<?php if($url){?>
		<div class="space"></div>
		<div align="right"><button onclick="window.location.href='<?php echo $url;?>'" type="button" class="btn"><span><span>返回！</span></span></button></div>
		<?php } ?>
	</div>
	<div class="clear"></div>
</div>
<?php $APP->tpl->p("foot","","0");?>