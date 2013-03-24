<?php include('include/head.php');?>
<script type="text/javascript">
if(top != window){
	top.location=window.location;
}
$(function(){
	$('html,body').css('overflow','hidden');
	$(window).bind('resize',function(){
		var w=$(window).width()-$('#left').width(),h=$(window).height()-$('#top').height()-5;
		$('#main').css({'width':w,'height':h});
		$('#left').css('height',h);
	}).trigger('resize');
	$('#left a.menu').click(function(){
	    var $c=$(this).siblings('ul');
	    if($c.css('display')=='none'){
	        $c.slideDown('fast');
	        $('ul.submenu:visible').not($c).slideUp('fast');
	    }else{
	        $c.slideUp('fast');
	    }
	    
	}).eq(0).trigger('click');
})
</script>
<div id="top">
    <?php echo anchor('','MyBlog后台管理系统',array('class'=>'logo'));?>
    <ul class="right">
        <li><?php echo anchor('main/logout','登出');?></li>
        <li><?php echo anchor('system/admindata','修改密码',array('target'=>'main'));?></li>
        <li><?php echo anchor('system/index','管理首页',array('target'=>'main'));?></li>
		<li><font color="white">欢迎您：</font><font color="yellow"><?php echo $username;?></font></li>
    </ul>
</div>
<div id="left">
    <ul class="menu">
        <?php foreach($menu as $m):?>
        <li class="split"></li>
        <li class="menu"><?php echo anchor("{$m['control']}/{$m['action']}",$m['name'],array('target'=>'main','class'=>'menu'));?>
            <ul class="submenu">
                <?php foreach($m['submenu'] as $s):?>
                <li class="subsplit"></li>
                <li class="submenu"><?php echo anchor("{$s['control']}/{$s['action']}",$s['name'],array('target'=>'main'));?></li>
                <?php endforeach;?>
            </ul>
        </li>
        <?php endforeach;?>
    </ul>
</div>
<div id="main">
    <iframe name="main" width="100%" src="<?php echo site_url('system/index')?>" frameborder="0"></iframe>
</div>
<script type="text/javascript">
function getcraft(){
    var a=$('#left a:contains("草稿箱")');
    if(a.length){
        $.get('<?php echo site_url('main/ajax/craft');?>',function(d){
            a.html('草稿箱('+d.message+')');
        },'json');
    }
}
getcraft();
</script>
<?php include('include/foot.php');?>
