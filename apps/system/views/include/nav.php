<div id="nav" class="container">
	<?php foreach($navigator as $nav):?>
    <?php echo anchor("{$nav['control']}/{$nav['action']}",$nav['name']);?>&gt;&gt;
    <?php endforeach;?>
</div>
<?php if(isset($tips)):foreach($tips as $t):?>
<div class="container"><p class="tips"><?php echo $t;?></p></div>
<?php endforeach;endif;?>
