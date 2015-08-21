<?php if(!defined('PHPOK_SET')){die('<h3>Error...</h3>');}?><?php $APP->tpl->p("header","","0");?>
<div class="notice"><div class="p">
	<table width="100%" cellpadding="0" cellspacing="0">
	<tr>
		<td><span class="lead">&nbsp;&raquo; <a href="<?php echo site_url('user');?>">合伙人管理</a> &raquo; 添加/编辑信息</span></td>
	</tr>
	</table>
</div></div>

<form method="post" action="<?php echo site_url('user,setok');?>id=<?php echo $id;?>" onsubmit="return to_submit();">
<div class="table">
	<div class="left"><span class="red">*</span> 合伙人组别：</div>
	<select name="groupid" id="groupid" onchange="direct('<?php echo site_url('user,set');?>id=<?php echo $id;?>&groupid='+this.value);">
		<?php $_i=0;$grouplist=(is_array($grouplist))?$grouplist:array();foreach($grouplist AS  $key=>$value){$_i++; ?>
		<option value="<?php echo $value[id];?>"<?php if($value[id] == $groupid){?> selected<?php } ?>><?php echo $value[title];?><?php if($value[group_type] == "guest"){?>【游客组】<?php } ?></option>
		<?php } ?>
	</select>
	<span class="clue_on"> 注意，不要选择游客组，游客组仅限来访者权限</span>
</div>


<div class="table">
	<div class="left"><span class="red">*</span> 姓名：</div>
	<input type="text" name="username" id="username" value="<?php echo $rs[username];?>" />
</div>

<input type="hidden" name="thumb_id" id="thumb_id" value="<?php echo $rs[thumb_id];?>">
<div class="table">
	<div class="left">
		<div style="padding-bottom:3px;">会员头像：</div>
		<div style="padding-bottom:3px;"><input type="button" class="btn2" value="选择" onclick="phpjs_img('thumb_id','thumb_view');" /> &nbsp;</div>
		<input type="button" value="删除" class="btn2" onclick="phpjs_clear_img('thumb_id','thumb_view')" /> &nbsp;
	</div>
	<table cellpadding="0" cellspacing="0">
	<tr>
		<td align="left" id="thumb_view"><?php if($rs[picture]){?><img src="<?php echo $rs[picture];?>" width="80px" height="80px" border="0" /><?php }else{ ?><img src="./app/admin/view/images/nopic.gif" border="0" /><?php } ?></td>
	</tr>
	</table>
</div>

<div class="table">
	<div class="left"><?php if(!$id){?><span class="red">*</span> <?php } ?>密码：</div>
	<input type="text" name="pass" id="pass" value="" />
	<span class="clue_on"> <?php if($id){?>不修改密码请保留为空<?php }else{ ?>请填写密码<?php } ?></span>
</div>

<div class="table">
	<div class="left"><span class="red">*</span> 手机：</div>
	<input type="text" name="phone" id="phone" value="<?php echo $rs[phone];?>" />
</div>
<div class="table">
	<div class="left"><span class="red">*</span> 分享：</div>
	<select id="fxstatus" name="fxstatus" class="select">
        <option value="1"<?php if($rs[fxstatus]=='1'){?> selected='selected'<?php } ?>>已分享</option>
		<option value="0"<?php if($rs[fxstatus]=='0'){?> selected='selected'<?php } ?>>未分享</option>
	</select>	
</div>
<div class="table">
	<div class="left"><span class="red">*</span> 身份类型：</div>
	<select id="job" name="job" class="select">
        <option value="GSYG"<?php if($rs[job]=='GSYG'){?> selected='selected'<?php } ?>>公司员工</option>
		<option value="WXFS"<?php if($rs[job]=='WXFS'){?> selected='selected'<?php } ?>>大众经纪人</option>
		<option value="ZJGS"<?php if($rs[job]=='ZJGS'){?> selected='selected'<?php } ?>>中介公司</option>
		<option value="DLGS"<?php if($rs[job]=='DLGS'){?> selected='selected'<?php } ?>>代理公司</option>
		<option value="HZHB"<?php if($rs[job]=='HZHB'){?> selected='selected'<?php } ?>>合作伙伴</option> 
	</select>	
</div>
<div class="table">
	<div class="left">公司名称：</div>
	<input type="text" name="company" id="company" value="<?php echo $rs[company];?>" />
</div>
<div class="table">
	<div class="left">银行户名：</div>
	<input type="text" name="bankAccount" id="bankAccount" value="<?php echo $rs[bankAccount];?>" />
</div>
<div class="table">
	<div class="left">银行卡号：</div>
	<input type="text" name="cardCode" id="cardCode" value="<?php echo $rs[cardCode];?>" />
</div>
<div class="table">
	<div class="left">银行名称：</div>
	<input type="text" name="bankName" id="bankName" value="<?php echo $rs[bankName];?>" />
</div>
<div class="table">
	<div class="left">注册时间：</div>
	<input type="text" name="regdate" id="regdate" onfocus="show_date('regdate')" value="<?php echo $rs[regdate] ? date('Y-m-d H:i',$rs[regdate]) : date('Y-m-d H:i',$sys_app->system_time);?>">
</div>

<div class="table">
	<div class="left">&nbsp;</div>
	<input type="submit" class="btn3" id="_phpok_submit" name="article_submit" value=" 提交 ">
</div>
</form>

<script type="text/javascript">
function to_submit()
{
	var username= getid("username").value;
	if(!username)
	{
		alert("合伙人名不允许为空");
		getid("username").focus();
		return false;
	}
	var phone = getid("phone").value;
	if(!phone)
	{
		alert("电话不允许为空");
		getid("phone").focus();
		return false;
	}
	<?php if(!$id){?>
	var pass = getid("pass").value;
	if(!pass)
	{
		alert("密码不允许为空");
		getid("pass").focus();
		return false;
	}
	<?php } ?>

	//通过Ajax检测合伙人账号和邮箱是否重复
	var url = "<?php echo site_url('user,chk');?>id=<?php echo $id;?>&phone="+EncodeUtf8(phone)+"&usercard="+EncodeUtf8(usercard);
	var msg = get_ajax(url);
	if(!msg) msg = "error: 检测失败";
	if(msg != "ok")
	{
		alert(msg);
		return false;
	}
	getid("_phpok_submit").disabled = true;
}
</script>
<?php $APP->tpl->p("footer","","0");?>