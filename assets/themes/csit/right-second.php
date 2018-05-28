<div class="row">
    	<div class="post-container home">
        		<?php 
		    	$category = Options::get('home-category-first');
		    	// echo $category; exit;
		        $catdetail = $this->doctrine->em->getRepository('content\models\Content')->catDetails($category);
		        // show_pre($catdetail); exit;
		        $content = $this->doctrine->em->getRepository('content\models\Content')->findContentByCategorySlug($catdetail['slug'], 3, 0);
		        // show_pre($content); exit;
		        $contents = $content['contents'];
		        if($catdetail){
		        	?>
		        	<h3 class="margin-bottom-30"><?php echo $catdetail['name']?></h3>
		        	<?php
		        }
		        if($contents){
		        	?>
		        	
					<div class="post-img"><a href="<?php echo site_url('content/'.$contents[0]['slug'])?>"><img src="<?php echo base_url().'assets/upload/images/content/'.$contents[0]['image'] ?>" alt="<?php echo $contents[0]['title']?>"></a><div class="hover-icon"></div></div>
					<div class="post-content">
						<a href="#"><h3><?php $contents[0]['title']?></h3></a>
						<div class="meta-tags">
							<span><?php echo dateMysql_($contents[0]['created'])?></span>
							<span><a href="#">0 Comments</a></span>
						</div>
						<p><?php echo strip_tags(word_limiter($contents[0]['body'], 15))?></p>
						<a class="button" href="<?php echo site_url('content/'.$contents[0]['slug'])?>">Read More</a>
					</div>
		        	<?php
		        }
		    	?>
			</div>
    </div>