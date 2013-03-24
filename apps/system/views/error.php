<?php include('include/head.php');?>
    <div id="errorblock">
        <dl>
            <dt><?php echo $tiptitle;?></dt>
            <dd><?php echo $message;?></dd>
        </dl>
    </div>
    <?php if(! empty($url)):?>
    <script type="text/javascript">
    setTimeout(function(){location.href='<?php echo $url;?>'},<?php echo $timeout;?>*1000);
    </script>
    <?php endif;?>
<?php include('include/foot.php');?>
