<!-- Footer
================================================== -->
<div class="margin-top-40"></div>

<div id="footer">
	<!-- Main -->
	<div class="container">

		<div class="seven columns">
		<?php 
		$id = Options::get('footer-content');
		$content = $this->doctrine->em->find('content\models\Content', $id);
		if($content){
			?>
			<h4><?php echo $content->getTitle()?></h4>
			<p><?php echo strip_tags(word_limiter($content->getBody(), 50));?></p>
			<a href="<?php echo site_url('content/'.$content->getSlug())?>" class="button">Read More »</a>
			<?php
		}
		?>
			
		</div>
		<?php 
		foreach(Modules::run('footer/_data') as $group){
			?>
			<div class="three columns">
				<h4><?php echo $group['name'] ?></h4>
				<ul class="footer-links">
					<?php
                        $_url = '';
                        foreach ($group['footers'] as $f) {
                            if ($f['type'] == 'internal') {
                                $page = CI::$APP->doctrine->em->find('content\models\Content', $f['url']);
                                if ($page) {
                                    $_url = site_url('content/' . $page->getSlug());
                                    unset($page);
                                }
                            } else $_url = $f['url'];
                            ?>
                            <li><a href="<?php echo $_url ?>"><?php echo ucfirst($f['title']); ?></a></li>
                        <?php } ?> 
				</ul>
			</div>
			<?php
		}
		?>
		

	</div>

	<!-- Bottom -->
	<div class="container">
		<div class="footer-bottom">
			<div class="sixteen columns">
				<h4>Follow Us</h4>
				<ul class="social-icons">
				<?php 
				$facebook = Options::get('facebook_id');
				$linkedin = Options::get('linkedIn_id');
				$twitter = Options::get('twitter_id');
				$google = Options::get('googleplus_id');
				if($facebook !=''){
					?>
					<li><a class="facebook" href="<?php echo $facebook; ?>"><i class="icon-facebook"></i></a></li>
					<?php
				}
				if($twitter !=''){
					?>
					<li><a class="twitter" href="<?php echo $facebook; ?>"><i class="icon-twitter"></i></a></li>
					<?php
				}
				if($google !=''){
					?>
					<li><a class="gplus" href="<?php echo $google; ?>"><i class="icon-gplus"></i></a></li>
					<?php
				}
				if($linkedin !=''){
					?>
					<li><a class="linkedin" href="<?php echo $linkedin; ?>"><i class="icon-linkedin"></i></a></li>
					<?php
				}
				?>
					
				</ul>
				<div class="copyrights"><?php echo Options::get('footer_slogan'); ?></div>
			</div>
		</div>
	</div>

</div>

<!-- Back To Top Button -->
<div id="backtotop"><a href="#"></a></div>

</div>
<!-- Wrapper / End -->


<!-- Scripts
================================================== -->
<script src="<?php echo theme_url()?>scripts/jquery-2.1.3.min.js"></script>
<script src="<?php echo theme_url()?>scripts/custom.js"></script>
<script src="<?php echo theme_url()?>scripts/jquery.superfish.js"></script>
<script src="<?php echo theme_url()?>scripts/jquery.themepunch.tools.min.js"></script>
<script src="<?php echo theme_url()?>scripts/jquery.themepunch.revolution.min.js"></script>
<script src="<?php echo theme_url()?>scripts/jquery.themepunch.showbizpro.min.js"></script>
<script src="<?php echo theme_url()?>scripts/jquery.flexslider-min.js"></script>
<script src="<?php echo theme_url()?>scripts/chosen.jquery.min.js"></script>
<script src="<?php echo theme_url()?>scripts/jquery.magnific-popup.min.js"></script>
<script src="<?php echo theme_url()?>scripts/waypoints.min.js"></script>
<script src="<?php echo theme_url()?>scripts/jquery.counterup.min.js"></script>
<script src="<?php echo theme_url()?>scripts/jquery.jpanelmenu.js"></script>
<script src="<?php echo theme_url()?>scripts/stacktable.js"></script>
<script src="<?php echo theme_url()?>scripts/owl.carousel.js"></script>
<script>
    $(document).ready(function() {
      $("#owl-demo").owlCarousel({
        autoPlay : 5000,
        stopOnHover : true,
        navigation:true,
        paginationSpeed : 1000,
        goToFirstSpeed : 2000,
        singleItem : true,
        autoHeight : true,
        transitionStyle:"backSlide"
      });
    });
    </script>

</body>
</html>