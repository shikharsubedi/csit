<div class="row">
    
            <?php 
    	$category = Options::get('home-category');
    	// echo $category; exit;
        $catdetail = $this->doctrine->em->getRepository('content\models\Content')->catDetails($category);
        // show_pre($catdetail); exit;
        $content = $this->doctrine->em->getRepository('content\models\Content')->findContentByCategorySlug($catdetail['slug'], 3, 0);
        // show_pre($content); exit;
        $contents = $content['contents'];
    	?>
            <h3 class="margin-bottom-20"><?php echo $catdetail['name']?></h3>
    
            <!-- Resume Table -->
            <dl class="resume-table">
            <?php 
            if($contents){
            	foreach($contents as $c){
            		?>
            		<dt>
	                    <small class="date"><?php echo $c['created']?></small>
	                    <strong><?php echo strip_tags(word_limiter($c['body'], 10))?></strong>
	                    <a href="<?php echo site_url('content/'.$c['slug'])?>">Read More »</a>
	                </dt>
            		<?php
            	}
            }
            ?>
    
        </div>