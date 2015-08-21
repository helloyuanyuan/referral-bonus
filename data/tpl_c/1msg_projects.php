<?php if(!defined('PHPOK_SET')){die('<h3>Error...</h3>');}?><?php $APP->tpl->p("head","","0");?>
<section class="main animated fadeInDown">
	<div class="main-box">
		<div class="rule-detail border-box">
			<h1><?php echo $rs[title];?></h1>
			<div><?php echo $rs[content];?></div>
		</div>
	</div>
</section>
<?php $APP->tpl->p("foot","","0");?>