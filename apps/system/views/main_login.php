<?php include('include/head.php');?>
<script type="text/javascript">
if(top != window){
	top.location=window.location;
}
$(function(){
	$('form img').click(function(){
		var g=this;
		$.get('<?php echo site_url('main/checkcode');?>',function(d){g.src=d},'text');
	});
});
</script>
<div id="login">
	<?php echo form_open('main/dologin',array('name'=>'login','method'=>'post'));?>
        <p>
            <label>用户名：<input type="text" class="text" name="username" autofocus maxlength="20" /></label>
        </p>
        <p>
            <label>密　码：<input type="password" class="text" name="password" maxlength="30" /></label>
        </p>
        <p>
            <label>验证码：<input type="text" class="text" name="checkcode" maxlength="8" size="10" style="width:100px;min-width:80px" /></label>
            <img align="middle" src="<?php echo $checkcode?>" alt="点击刷新" /></p>
        <p> <input type="submit" class="button" value="登录" /> </p>
    </form>
</div>
<?php include('include/foot.php');?>
