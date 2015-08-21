<?php if(!defined('PHPOK_SET')){die('<h3>Error...</h3>');}?><?php $APP->tpl->p("head","","0");?>
<section class="main animated fadeInDown">
	<div class="main-box">
		<div class="client my-client-title">
			<ul class="rb-row fn-clear">
				<li>姓名</li>
				<li>意向楼盘</li>
				<li>电话</li>
				<li>状态</li>
			</ul>
		</div>
		<div class="client my-client-list">
			<?php $_i=0;$rslist=(is_array($rslist))?$rslist:array();foreach($rslist AS  $k=>$v){$_i++; ?>
			<a href="<?php echo site_url('customer,view');?>id=<?php echo $v[id];?>" class="rb-row my-client">
			<ul class="fn-clear">
				<li><?php echo $v[username];?></li>
				<li><?php echo $v[proname];?></li>
				<li><?php echo $v[cellphone];?></li>
				<li><span class="visit"><?php if($v[status]==1){?>已预约<?php }elseif($v[status]==2){ ?>已过期<?php }else{ ?>未审核<?php } ?></span></li>
			</ul>
			</a>
			<?php } ?>
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
		<div class="recommend-tips">
			<h6>提示</h6>
			<p>具体判客规则以“活动细则”里的相关说明为准！</p>
		</div>
	</div>
</section>
<?php $APP->tpl->p("foot","","0");?>