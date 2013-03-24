<?php echo doctype('xhtml1-trans');?>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
	<?php echo meta(array(
		array('name' => 'Content-type', 'content' => 'text/html; charset=utf-8', 'type' => 'equiv'),
		array('name' => 'pragma', 'content' => 'no-cache', 'type' => 'equiv')
	));?> 
	
	<title><?php echo $title; ?></title>
	
	<?php echo link_tag(RESOURCE.'style/master.css'); ?>
    <script type="text/javascript" src="<?php echo RESOURCE;?>script/jquery-1.7.min.js"></script>
    <script type="text/javascript" src="<?php echo RESOURCE;?>script/jquery.xupload.js"></script>
	<script type="text/javascript" src="<?php echo RESOURCE;?>script/function.js"></script>
</head>
<body>
