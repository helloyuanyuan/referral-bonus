<?php if(!defined('PHPOK_SET')){die('<h3>Error...</h3>');}?><?php $APP->tpl->p("head","","0");?>
<style>body,html{ background: none; overflow: hidden;}</style>
<section class="main">
	<div id="J_slide" class="j-slider">
		<div class="viewport">
			<div class="item">
				<div class="element element-1">
					<div class="phone"></div>
			        <div class="hand"></div>
			        <div class="gold"></div>
			        <div class="gift"></div>
			        <div class="text"></div>
			     </div>
			</div>
			<div class="item">
				<div class="element element-2">
					<div class="phone"></div>
					<div class="building"></div>
					<div class="floor"></div>
					<div class="text"></div>
				</div>
			</div>
			<div class="item">
				<div class="element element-3">
					<div class="phone"></div>
					<div class="house"></div>
					<div class="handshake"></div>
					<div class="message"></div>
					<div class="text"></div>
				</div>
				<a class="btn-go" href="<?php echo site_url('home');?>"></a>    
			</div>
		</div>
		<div class="pointer pointer-static">						
			<span class="current"></span>
			<span></span>
			<span></span>
		</div>						
	</div>
</section>
<script src="http://g.tbcdn.cn/kissy/k/1.4.0/seed.js"></script>
<script src="js/mod.slide.js"></script>
</body>
</html>