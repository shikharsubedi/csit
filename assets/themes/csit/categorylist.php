<?php echo get_header()?>


<!-- Titlebar
================================================== -->
<div id="titlebar" class="single">
	<div class="container">

		<div class="sixteen columns">
			
			<nav id="breadcrumbs">
				<ul>
					<li>You are here:</li>
					<li><a href="<?php echo site_url()?>">Home</a></li>
					<li><?php echo $category->getName()?></li>
				</ul>
			</nav>
		</div>

	</div>
</div>




<!-- Content
================================================== -->
<div class="container">
	<!-- Recent Jobs -->
	<div class="eleven columns">
		<h2><?php echo $category->getName()?></h2>
		<div class="padding-right">
		<ul class="job-list full">
		<?php 
		if($contents){
			foreach($contents as $c){
				?>
				<li><a href="<?php echo site_url('content/'.$slug)?>">
				<?php 
				if($c['image'] !=''){
					?>
					<img src="<?php echo base_url().'assets/upload/images/content/'.$c['image']?>" title="<?php echo $c['title'];?> ">
					<?php
				}
				?>
					
					<div class="job-list-content">
						<h4><?php echo $c['title']?></h4>
						
						<p><?php echo strip_tags(word_limiter($c['body'], 50))?></p>
					</div>
					</a>
					<div class="clearfix"></div>
				</li>
				<?php
			}
		}
		?>
			
		</ul>
		<div class="clearfix"></div>
		 <?php if(isset($pagination)){ ?>
              <div class="pagination-container">
                <?php
                      echo $pagination;
                  ?>
                </div>
              <?php
              }
              ?>
		

	</div>
	</div>


	<!-- Widgets -->
	<div class="five columns">
		<?php echo get_rightfirst()?>

    	<?php echo get_rightsecond()?>

    	<?php echo get_rightthird()?>

	</div>
	<!-- Widgets / End -->


</div>
			


<?php echo get_footer()?>