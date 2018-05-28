<marquee onmouseover="this.stop();" onmouseout="this.start();">
<?php foreach($articles as $a): ?>
	<span><a href="<?php echo site_url('content/'.$a['slug'])?>"><?php echo $a['title'];?></a></span> | 
    <?php endforeach;?>
</marquee>