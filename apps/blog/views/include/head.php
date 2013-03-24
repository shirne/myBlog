<?php echo doctype('html5');?>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
	<?php echo meta(array(
		array('name' => 'Content-type', 'content' => 'text/html; charset=utf-8', 'type' => 'equiv'),
		array('name' => 'pragma', 'content' => 'no-cache', 'type' => 'equiv'),
        array('name' => 'description', 'content' => 'My Great Site'),
        array('name' => 'keywords', 'content' => 'love, passion, intrigue, deception'),
        array('name' => 'robots', 'content' => 'all'),
	));?> 
	
	<title><?php echo $site_title; ?></title>
	
	<?php echo link_tag('resource/blog/style/master.css'); ?>

</head>
<body>