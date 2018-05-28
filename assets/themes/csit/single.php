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
					<li><?php echo $title;?></li>
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
		
		<!-- Company Info -->
		<?php 
		if($content){
			?>
			<h3><?php echo $title?></h3>
			<?php 
			if($image !=''){
				?>
				<p><img src="<?php echo base_url().'assets/upload/images/content/'.$image?>"></p>
				<?php
			}
			?>
			
			<?php echo $body?>
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
			


<?php echo get_footer();?>