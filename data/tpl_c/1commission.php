<?php if(!defined('PHPOK_SET')){die('<h3>Error...</h3>');}?><?php $APP->tpl->p("head","","0");?>
<section class="main animated fadeInDown">
	<div class="main-box">
		<div class="commission-header fn-clear">
			<div class="commission-box border-box">
				<p>可结佣（税前）</p>
				<p class="commission-text"><?php echo $totalcur_wj;?><span>元</span></p>
			</div>
			<div class="commission-box border-box">
				<p>已结佣</p>
				<p class="commission-text"><?php echo $totalcur_yj;?><span>元</span></p>
			</div>
		</div>
        <a href="<?php echo site_url('usercp,bank');?>" class="rb-row bank-card fn-clear">
        <i class="icon-credit-card"></i>
        <?php if($rs[bankAccount] && $rs[cardCode] && $rs[bankName]){?>
		<span>卡号&nbsp;&nbsp;&nbsp;<?php echo $rs[cardCode];?></span>
		<?php }else{ ?>
		<span>请绑定您的银行卡号</span>
		<?php } ?>
        <i class="icon-angle-right"></i>
        </a>
		
		<div class="commission-detail">
			<h6>账目明细</h6>
		<div class="client my-client-title">
			<ul class="rb-row fn-clear">
				<li>客户</li>
				<li>楼盘</li>
				<li>类别</li>
				<li>佣金</li>
			</ul>
		</div>
		<div class="client my-client-list">
			<?php $_i=0;$rslist=(is_array($rslist))?$rslist:array();foreach($rslist AS  $k=>$v){$_i++; ?>
			<a class="rb-row my-client">
			<ul class="fn-clear">
				<li><?php echo $v[username];?></li>
				<li><?php echo $v[proname];?></li>
				<li><?php echo $v[ctype];?></li>
				<li><?php echo $v[money];?></li>
			</ul>
			</a>
			<?php } ?>
		</div>
		</div>
		<div class="recommend-tips">
			<?php if($pagelist && is_array($pagelist) && count($pagelist)>0){?>
			<ul class="pagination">
				<?php $_i=0;$pagelist=(is_array($pagelist))?$pagelist:array();foreach($pagelist AS  $key=>$value){$_i++; ?>
				<li><a href="<?php echo $value[url];?>" class="<?php echo $value[status] ? 'm' : 'n';?>"><?php echo $value[name];?></a></li>
				<?php } ?>
			</ul>
			<?php } ?>
		</div>
	</div>
</section>
<?php $APP->tpl->p("foot","","0");?>