<?php if(!defined('PHPOK_SET')){die('<h3>Error...</h3>');}?><?php $APP->tpl->p("head","","0");?>
<section class="main animated fadeInDown">
	<div class="main-box">
		<p class="rb-row"><input type="text" placeholder="请输入您的户名" class="input" id="bankAccount" value="<?php echo $rs[bankAccount];?>" /></p>
		<p class="rb-row"><input type="tel" placeholder="请输入您的银行卡号" class="input" id="cardCode" value="<?php echo $rs[cardCode];?>" /></p>
		<p class="rb-row"><input type="text" placeholder="请输入您的银行名称" class="input" id="bankName" value="<?php echo $rs[bankName];?>" /></p>
		<div class="recommend-tips">
			<h6>提示</h6>
			<p>为了您能快速结佣请提供详细的开户行信息,如招商银行新疆支行。</p>
		</div>
		<p class="rb-submit"><input type="button" value="保存" class="btn" id="J_saveCard" /></p>
	</div>
</section>
<?php $APP->tpl->p("foot","","0");?>