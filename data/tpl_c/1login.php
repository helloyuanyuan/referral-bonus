<?php if(!defined('PHPOK_SET')){die('<h3>Error...</h3>');}?><?php $APP->tpl->p("head","","0");?>
<style>body{background:url(tpl/www/images/bg-loader.jpg) no-repeat; background-size:100% 100%;}.foot a{ color: #fff;}</style>
<section class="main animated fadeInDown">
	<div class="login-box">
		<h1 class="login-logo"></h1>
		<div class="login-regular login-input">
			<p class="fn-clear"><label for="user-name"><i class="icon-name"></i></label><input type="tel" class="input" value="" name="phone" id="phone" placeholder="请输入用户名" /></p>
			<p class="fn-clear"><label for="user-psw"><i class="icon-psw"></i></label><input type="password" pattern="[0-9]*" class="input" name="userpsw" id="userpsw" placeholder="请输入密码6~8个数字"  /></p>
		</div>
		<p class="login-btn"><input type="submit" value="登录" class="btn submit-btn" id="J_login" /></p>
	</div>
</section>
<?php $APP->tpl->p("foot","","0");?>