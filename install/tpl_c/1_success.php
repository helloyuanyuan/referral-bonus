<?php if(!defined('PHPOK_SET')){die('<h3>Error...</h3>');}?><?php $APP->tpl->p("head","","0");?>
<div class="div_w m_top">
	<div class="left">
		<div class="model"><div class="bg">
			<h5>安装步骤</h5>
			<ol class="ol">
				<li><a href="index.php">安装说明</a></li>
				<li><a href="index.php?act=setconfig">配置安装参数</a></li>
				<li class="red">完成</li>
			</ol>
		</div></div>
		<div class="space"></div>
	</div>
	<div class="right">
		<div class="model"><div class="bg">
			<h5>安装成功</h5>
			<div class="msg" style="padding:5px 15px;">
				<button onclick="window.location.href='../index.php'" type="button" class="btn"><span><span>网站首页</span></span></button><br /><br />
				<button onclick="window.location.href='../admin.php'" type="button" class="btn"><span><span>后台管理</span></span></button>
			</div>
		</div></div>
	</div>
	<div class="clear"></div>
</div>
<?php $APP->tpl->p("foot","","0");?>