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
					<li>College Detail</li>
				</ul>
			</nav>
		</div>

	</div>
</div>




<!-- Content
================================================== -->
<div class="container">
	<!-- College -->
	<div class="eleven columns">
	<div class="padding-right">
		<h2>College Detail</h2>
		<!-- Company Info -->
		<?php 
		if($college){
			?>
			<div class="company-info">

				<img src="<?php echo base_url().'assets/upload/college/'.$college->getImage()?>" title="<?php echo $college->getName()?>">
				<div class="content">
					<h4><?php echo $college->getName()?></h4>
					<?php 
					if($college->getAddress() !=''){
						?>
						<span><i class="fa fa-map-marker"></i> <?php echo $college->getAddress()?></span>
						<?php
					}
					if($college->getContact() !=''){
						?>
						<span><i class="fa fa-phone"></i> <?php echo $college->getContact()?></span>
						<?php
					}
					if($college->getEmail() !=''){
						?>
						 <span><i class="fa fa-envelope"></i><?php echo $college->getEmail()?></span>
						<?php
					}
					?>
					
	               
				</div>
				<div class="clearfix"></div>
			</div>
				<?php
			}
			?>
			<?php 
			if($college->getDescription() !=''){
				echo $college->getDescription();
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
			


<?php echo get_footer();?>