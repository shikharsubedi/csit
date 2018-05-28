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
					<li>College List</li>
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
	<h2>College List</h2>
		<div class="padding-right">
		<ul class="job-list full">
		<?php 
		if($college){
			foreach($college as $c){
				?>
				<li><a href="<?php echo site_url('college/collegeDetail/'.$c->getSlug())?>">
				<?php 
				if($c->getImage() !=''){
					?>
					<img src="<?php echo base_url().'assets/upload/college/'.$c->getImage()?>" title="<?php echo $c->getname();?> ">
					<?php
				}
				?>
					
					<div class="job-list-content">
						<h4><?php echo $c->getName()?></h4>
						<div class="job-icons">
							<?php 
							if($c->getAddress() !=''){
								?>
								<span><i class="fa fa-map-marker"></i><?php echo $c->getAddress()?></span>
								<?php
							}
							
							if($c->getContact() !=''){
								?>
								<span><i class="fa fa-phone"></i><?php echo $c->getContact()?></span>
								<?php
							}
							if($c->getEmail() !=''){
								?>
								<span><i class="fa fa-envelope"></i><?php echo $c->getEmail()?></span>
								<?php
							}
							if($c->getUniversity() !=''){
								?>
								<span><i class="fa fa-university"></i><?php echo $c->getUniversity()->getName();?></span>
								<?php
							}
							?>
							
	                        
							
						</div>
						<p><?php echo strip_tags(word_limiter($c->getDescription(), 50))?></p>
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
		

    	<?php echo get_rightsecond()?>

    	<?php echo get_rightthird()?>

	</div>
	<!-- Widgets / End -->


</div>
			


<?php echo get_footer()?>