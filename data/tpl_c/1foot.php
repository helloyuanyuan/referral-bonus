<?php if(!defined('PHPOK_SET')){die('<h3>Error...</h3>');}?><footer class="foot"><a href="<?php echo $_sys[siteurl];?>">&copy; Powered by <?php echo $_sys[copyright];?></a></footer>
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
<div id="fixed">
    <ul id="fixed-foot">
    <li class="border-left-none"><a href="javascript:history.go(-1);"><span class="fixed-button icon_arr_back"></span></a></li>
    <li class="border-right-none"><a href="<?php echo site_url('home');?>"><span class="fixed-button icon_arr_home"></span></a></li>
    </ul>
</div>
</body>
</html>