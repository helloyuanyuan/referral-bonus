<?php if(!defined('PHPOK_SET')){die('<h3>Error...</h3>');}?><?php $APP->tpl->p("head","","0");?>
<style id="loading-style">html,body{width:100%;height:100%; overflow: hidden;}</style>
<section class="user-loader" style="background:url(<?php echo $_sys[logo];?>);background-size: 100% 100%;">
	<i class="icon-spin4 animate-spin"></i>
</section>
<div class="ad"><img src="<?php echo $_sys[sharetips];?>" alt="" /></div>
<section class="main animated">
	<div class="main-box">
		<?php if($_SESSION['user_id']){?>
		<div class="home-info border-box fn-clear">
			<figure class="figure-box">
				<img src="<?php if($urs[picture]){?><?php echo $urs[picture];?><?php }else{ ?>tpl/www/images/header.png<?php } ?>" alt="" />
			</figure>
			<h5><?php echo $urs[username];?>&nbsp;</h5>
			<div class="user-info">
				<label>总佣金</label>
				<p><i class="icon icon-money"></i><span><?php echo $money;?></span></p>
			</div>
			<div class="info-border"></div>
			<div class="user-info">
				<label>推荐人数</label>
				<p><i class="icon icon-users"></i><span><?php echo $total;?></span></p>
			</div>
			<?php if($urs[fxstatus]){?>
			<div class="user-ad-yes">
				<p><a href="<?php echo $_sys[shareyeslink];?>" title="<?php echo $_sys[sharegiftyes];?>"><?php echo $_sys[sharegiftyes];?></a></p>
			</div>
			<?php }else{ ?>
			<div class="user-ad">
				<p><a href="javascript:void(0)" id="dialog"><?php echo $_sys[sharegift];?></a></p>
			</div>
			<?php } ?>
			<a href="<?php if($_SESSION['user_id']){?><?php echo site_url('usercp');?><?php }else{ ?><?php echo site_url('login');?><?php } ?>" title="设置" class="jjr-setting"><i class="icon-setting"></i></a>
		</div>
		<?php }else{ ?>
		<div class="unregister">
			<figure><a href="<?php echo site_url('register');?>"><img src="tpl/www/images/unregister.jpg" alt="" /></a></figure>
		</div>
		<?php } ?>
		<ul class="home-nav fn-clear">
			<li class="nav-recommend"><a href="<?php if($_SESSION['user_id']){?><?php echo site_url('recommend');?><?php }else{ ?><?php echo site_url('register');?><?php } ?>" title="<?php echo $_sys[tj_title];?>"><?php echo $_sys[tj_title];?><label>hot</label><br /><span>Recommend</span></a></li>
			<li class="nav-rule"><a href="<?php if($_SESSION['user_id']){?><?php echo site_url('customer');?><?php }else{ ?><?php echo site_url('login');?><?php } ?>" title="<?php echo $_sys[kh_title];?>"><?php echo $_sys[kh_title];?><br /><span>Client</span></a></li>
			<li class="nav-commission"><a href="<?php if($_SESSION['user_id']){?><?php echo site_url('commission');?><?php }else{ ?><?php echo site_url('login');?><?php } ?>" title="<?php echo $_sys[yj_title];?>"><p><?php echo $_sys[yj_title];?><br /><span>Commission</span></p></a></li>
			<li class="nav-rule-detail"><a href="<?php echo site_url('msg','id=2');?>" title="<?php echo $_sys[xz_title];?>"><?php echo $_sys[xz_title];?><br /><span>Rule</span></a></li>
		</ul>
		<div class="sale-box">
			<h6><?php echo $_sys[itemtitle];?></h6>
			<div class="floor-box">
				<?php $item = phpok_m_list("projects",100,1);?>
				<?php $_i=0;$item[rslist]=(is_array($item[rslist]))?$item[rslist]:array();foreach($item[rslist] AS  $key=>$value){$_i++; ?>
				<a href="<?php if($value[link_url]){?><?php echo $value[link_url];?><?php }else{ ?><?php echo msg_url($value);?><?php } ?>" class="floor-detail" title="<?php echo $value[title];?>" target="<?php if($value[target]==1){?>_blank<?php }else{ ?>_self<?php } ?>">
                <figure class="floor-img"><img src="<?php echo $value[picture];?>" alt="<?php echo $value[title];?>" /></figure>
                <div class="floor">
                	<h5><?php echo $value[title];?></h5>
					<?php if($value[yongjin]){?>
                    <div class="award fn-clear">
                    	<label class="award-title">佣金</label>
						<div class="award-list"><span><?php echo $value[yongjin];?></span><br /></div>
                    </div>
					<?php } ?>
					<?php if($value[jili]){?>
                    <div class="award fn-clear">
                    		<label class="award-title">激励</label>
							<div class="award-list"><span><?php echo $value[jili];?></span><br /></div>
                    </div>
					<?php } ?>
                </div>
                </a>
				<?php } ?> 
				<?php unset($item);?>    
			</div>
		</div>
	</div>
</section>
<footer class="foot"><a href="<?php echo $_sys[siteurl];?>">&copy; Powered by <?php echo $_sys[copyright];?></a></footer>
<script src="http://g.tbcdn.cn/kissy/k/1.4.0/seed.js"></script>
<script src="js/mod.jjr.js"></script>
<script src="js/jquery-1.8.2.min.js" type="text/javascript"></script>
<script type="text/javascript">
var _Conf = {
            img: "<?php echo $_sys[siteurl];?><?php echo $_sys[wx_logo];?>",
            w: 100,
            h: 100,
            url: '<?php echo $_sys[wx_link];?>',
            title: "<?php echo $_sys[wx_title];?>",
            desc: "<?php echo $_sys[wx_description];?>",
            appid: '' };

function _ShareFriend() {
    WeixinJSBridge.invoke('sendAppMessage',{
          'appid': _Conf.appid,
          'img_url': _Conf.img,
          'img_width': _Conf.w,
          'img_height': _Conf.h,
          'link': _Conf.url,
          'desc': _Conf.desc,
          'title': _Conf.title
          }, function(res){
				if(res.err_msg=="send_app_msg:ok"){
					var pars = "";
					var parsprams = "";
					var randomcode = Math.random() * 100000;
					parsprams = pars + "&code=" + randomcode + "&f=updategroup";
					$.ajax({
							url: 'index.php?c=home',
							type: "Get",
							data: parsprams,
							beforeSend: function () { },
							success: function (state) {
								alert(state);
							}
						});				
				}			  
            _report('send_msg', res.err_msg);
      })
}
function _ShareTL() {
    WeixinJSBridge.invoke('shareTimeline',{
          'img_url': _Conf.img,
          'img_width': _Conf.w,
          'img_height': _Conf.h,
          'link': _Conf.url,
          'desc': _Conf.desc,
          'title': _Conf.title
          }, function(res) {
				if(res.err_msg=="share_timeline:ok"){
					var pars = "";
					var parsprams = "";
					var randomcode = Math.random() * 100000;
					parsprams = pars + "&code=" + randomcode + "&f=updategroup";
					$.ajax({
							url: 'index.php?c=home',
							type: "Get",
							data: parsprams,
							beforeSend: function () { },
							success: function (state) {
								alert(state);
							}
						});				
				}			  
            _report('timeline', res.err_msg);
          });
}
function _ShareWB() {
    WeixinJSBridge.invoke('shareWeibo',{
          'content': _Conf.desc,
          'url': _Conf.url,
          }, function(res) {
			  
				if(res.err_msg=="share_weibo:ok"){
					var pars = "";
					var parsprams = "";
					var randomcode = Math.random() * 100000;
					parsprams = pars + "&code=" + randomcode + "&f=updategroup";
					$.ajax({
							url: 'index.php?c=home',
							type: "Get",
							data: parsprams,
							beforeSend: function () { },
							success: function (state) {
								alert(state);
							}
						});				
				}			  
            _report('weibo', res.err_msg);
          });
}
// 当微信内置浏览器初始化后会触发WeixinJSBridgeReady事件。
document.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {
	//隐藏下方工具栏，需要显示顶部导航栏，请把hideToolbar换成showToolbar
	WeixinJSBridge.call('showToolbar');
	//隐藏右上角菜单，需要显示请把hideOptionMenu换成showOptionMenu
	WeixinJSBridge.call('showOptionMenu');
        // 发送给好友
        WeixinJSBridge.on('menu:share:appmessage', function(argv){
            _ShareFriend();
      });
        // 分享到朋友圈
        WeixinJSBridge.on('menu:share:timeline', function(argv){
            _ShareTL();
            });
        // 分享到微博
        WeixinJSBridge.on('menu:share:weibo', function(argv){
            _ShareWB();
       });
}, false);
</script>
</body>
</html>