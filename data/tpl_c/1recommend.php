<?php if(!defined('PHPOK_SET')){die('<h3>Error...</h3>');}?><?php $APP->tpl->p("head","","0");?>
<section class="main animated fadeInDown">
	<div class="main-box">
		<p class="rb-row"><input type="text" id="username" placeholder="客户姓名" class="input" value="" /></p>
		<p class="rb-row"><input type="tel" id="phone" placeholder="手机号码" class="input" value="" /></p>
		<p class="rb-row rb-select">
		<select id="floor" name="floor" class="select">
			<option value="">意向楼盘</option>
	         <?php $_i=0;$rslist=(is_array($rslist))?$rslist:array();foreach($rslist AS  $k=>$v){$_i++; ?>
            <option value="<?php echo $v[title];?>"><?php echo $v[title];?></option>
            <?php } ?>
		</select>
		<i class="icon-down-open-big"></i>
		</p>
		<p class="rb-row"><input type="input" id="selorderTime" placeholder="预约日期" class="input" value="" /></p>
		<p class="rb-row rb-select">
		<select id="selorderTime2" name="selorderTime2" class="select">
        	<option value="">请选择预约时段</option>
            <option value="10:30">10:30</option>
            <option value="11:00">11:00</option>
            <option value="12:00">12:00</option>
            <option value="13:00">13:00</option>
            <option value="14:00">14:00</option>
            <option value="15:00">15:00</option>
            <option value="16:00">16:00</option>
            <option value="17:00">17:00</option>
            <option value="18:00">18:00</option>
            <option value="19:00">19:00</option>
		</select>
		<i class="icon-down-open-big"></i>
		</p>
		<p class="rb-row"><input type="text" id="remark" placeholder="备注" class="input" value="" /></p>
		<div class="recommend-tips">
			<h6>提示</h6>
			<p>请务必提交真实的客户信息，若多次提交虚假信息，您的账号会被禁用。</p>
		</div>
		<p class="rb-submit"><input type="submit" value="马上推荐" class="btn" id="J_submitRec"/></p>
	</div>
</section>
<aside class="recommend-pop">
	<div class="recommend-box">
		<h1 class="recommend-title"></h1>
		<div class="recommend-icon"></div>
        <div class="recommend-text">
			<p>如果客户成交，您将获得佣金！</p>
			<p class="user-get"></p>
        </div>
		<a href="<?php echo site_url('customer');?>" class="recommend-submit"><i class="recommend-ok"></i></a>
	</div>
</aside>
<div class="pop-bg"></div>	
<?php $APP->tpl->p("foot","","0");?>