<?php if(!defined('PHPOK_SET')){die('<h3>Error...</h3>');}?><?php $APP->tpl->p("head","","0");?>
<section class="main animated fadeInDown">
	<div class="main-box">
		<div class="client-info fn-clear">
			<h1><?php echo $rs[username];?></h1>
            <div class="client-tel">
            	<p><i class="icon icon-phone"></i>电话号码<span><?php echo $rs[cellphone];?></span></p>
                <p><i class="icon icon-location"></i>意向楼盘<span><?php echo $rs[proname];?></span></p>
                <p><i class="icon icon-phone"></i>置业顾问<span><?php echo $rs[guwenname];?></span></p>                    
			</div>
		</div>
		<div class="call-to"><a href="tel:<?php echo $rs[cellphone];?>">呼叫Ta</a><a href="tel:<?php echo $rs[guwentel];?>">呼叫置业顾问</a></div>
		<div class="client-time border-box fn-clear">
			<div class="time-left">
				<i class="time-node<?php if(!$rs[daofang]){?>-no<?php } ?>"></i>
				<span class="time-line<?php if(!$rs[renchou]){?>-no<?php } ?>"></span><i class="time-node<?php if(!$rs[renchou]){?>-no<?php } ?>"></i>
				<span class="time-line<?php if(!$rs[rengou]){?>-no<?php } ?>"></span><i class="time-node<?php if(!$rs[rengou]){?>-no<?php } ?>"></i>
				<span class="time-line<?php if(!$rs[qianyue]){?>-no<?php } ?>"></span><i class="time-node<?php if(!$rs[qianyue]){?>-no<?php } ?>"></i>
				<span class="time-line<?php if(!$rs[huikuan]){?>-no<?php } ?>"></span><i class="time-node<?php if(!$rs[huikuan]){?>-no<?php } ?>"></i>
			</div>
			<div class="time-right">
				<ul>
					<li class="fn-clear"><div class="time-detail<?php if(!$rs[daofang]){?>-no<?php } ?>"><p class="time-event">到访</p><?php echo $rs[dfnote];?></div></li>
					<li class="fn-clear"><div class="time-detail<?php if(!$rs[renchou]){?>-no<?php } ?>"><p class="time-event">认筹</p><?php echo $rs[rcnote];?></div></li>
					<li class="fn-clear"><div class="time-detail<?php if(!$rs[rengou]){?>-no<?php } ?>"><p class="time-event">认购</p><?php echo $rs[rgnote];?></div></li>
					<li class="fn-clear"><div class="time-detail<?php if(!$rs[qianyue]){?>-no<?php } ?>"><p class="time-event">签约</p><?php echo $rs[qynote];?></div></li>
					<li class="fn-clear"><div class="time-detail<?php if(!$rs[huikuan]){?>-no<?php } ?>"><p class="time-event">回款</p><?php echo $rs[hknote];?></div></li>						
				</ul>
			</div>
		</div>
	</div>
</section>
<?php $APP->tpl->p("foot","","0");?>