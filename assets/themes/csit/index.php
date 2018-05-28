<?php echo get_header()?>


<!-- Slider
================================================== -->
<div class="fullwidthbanner-container">
	<div class="fullwidthbanner">
	<?php echo Modules::run('slider/index')?>
		
	</div>
</div>



<!-- Content
================================================== -->
<div class="container">

<?php 
	$id = Options::get('mid-first');
	$content =  $this->doctrine->em->find('content\models\Content', $id);
	if($content){
		?>
		<div class="one-third column">
			<div class="recent-post">
				
				

					<a href="<?php echo site_url('content/'.$content->getSlug())?>"><h4><?php echo $content->getTitle();?></h4></a>		
					<div class="recent-post-img"><a href="#"><img src="<?php echo base_url().'assets/upload/images/content/'.$content->getImage() ?>" alt=""></a></div>		
					<p>
						<?php echo word_limiter($content->getBody(), 15)?>
					</p>
					<a href="<?php echo site_url('content/'.$content->getSlug())?>" class="button">Read More »</a>
				

			</div>
		</div>
		<?php
	}
?>
<?php 
	$id = Options::get('mid-second');
	$content =  $this->doctrine->em->find('content\models\Content', $id);
	if($content){
		?>
		<div class="one-third column">
			<div class="recent-post">
				
				

					<a href="<?php echo site_url('content/'.$content->getSlug())?>"><h4><?php echo $content->getTitle();?></h4></a>		
					<div class="recent-post-img"><a href="#"><img src="<?php echo base_url().'assets/upload/images/content/'.$content->getImage() ?>" alt=""></a></div>		
					<p>
						<?php echo word_limiter($content->getBody(), 15)?>
					</p>
					<a href="<?php echo site_url('content/'.$content->getSlug())?>" class="button">Read More »</a>
				

			</div>
		</div>
		<?php
	}
?>
<?php 
	$id = Options::get('mid-third');
	$content =  $this->doctrine->em->find('content\models\Content', $id);
	if($content){
		?>
		<div class="one-third column">
			<div class="recent-post">
				
				

					<a href="<?php echo site_url('content/'.$content->getSlug())?>"><h4><?php echo $content->getTitle();?></h4></a>		
					<div class="recent-post-img"><a href="#"><img src="<?php echo base_url().'assets/upload/images/content/'.$content->getImage() ?>" alt=""></a></div>		
					<p>
						<?php echo word_limiter($content->getBody(), 15)?>
					</p>
					<a href="<?php echo site_url('content/'.$content->getSlug())?>" class="button">Read More »</a>
				

			</div>
		</div>
		<?php
	}
?>


	

</div>



<div class="container">

	<div class="five columns">
		<h3 class="margin-bottom-5">College List</h3>

		 <div class="span12">
		 	<div id="owl-demo" class="owl-carousel">
		 		<?php echo Modules::run('college/getCollegelist')?>
		 	</div>
		 </div>
		
		<!-- Showbiz Container -->
		

	</div>
    <div class="one column">&nbsp;</div>
    <div class="five columns">
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
	<div class="one column">&nbsp;</div>
    <div class="four columns">
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
               
    
            </dl>
    
        </div>

	
</div>


<?php echo get_footer()?>